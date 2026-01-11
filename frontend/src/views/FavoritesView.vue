<script setup>
import { ref, computed, onMounted } from "vue";
import { apiLaravel } from "../services/api";
import { tmdbGenres } from "../utils/genres";
import MovieCard from "../components/MovieCard.vue";
import BaseButton from "../components/BaseButton.vue";

const favorites = ref([]);
const loading = ref(true);
const selectedGenre = ref("");

// Carrega dados
const loadFavorites = async () => {
  try {
    const response = await apiLaravel.get("/favorites");
    favorites.value = response.data;
  } catch (error) {
    console.error(error);
    alert("Erro ao carregar favoritos");
  } finally {
    loading.value = false;
  }
};

const removeFavorite = async (tmdb_id) => {
  if (!confirm("Remover este filme?")) return;
  try {
    await apiLaravel.delete(`/favorites/${tmdb_id}`);
    favorites.value = favorites.value.filter((m) => m.tmdb_id !== tmdb_id);
  } catch (error) {
    console.error(error);
    alert("Erro ao remover");
  }
};

const availableGenres = computed(() => {
  const ids = new Set();
  favorites.value.forEach((movie) => {
    if (movie.genres) movie.genres.forEach((id) => ids.add(id));
  });
  return Array.from(ids)
    .map((id) => ({ id, name: tmdbGenres[id] }))
    .filter((g) => g.name);
});

const filteredFavorites = computed(() => {
  if (!selectedGenre.value) return favorites.value;
  return favorites.value.filter(
    (movie) => movie.genres && movie.genres.includes(Number(selectedGenre.value))
  );
});

onMounted(loadFavorites);
</script>

<template>
  <div class="p-6 max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
      <h1 class="text-3xl font-bold text-gray-800">Meus Favoritos</h1>

      <select
        v-model="selectedGenre"
        class="border border-gray-300 rounded-lg p-2 text-gray-700 focus:ring-2 focus:ring-blue-500"
      >
        <option value="">Todos os Gêneros</option>
        <option v-for="genre in availableGenres" :key="genre.id" :value="genre.id">
          {{ genre.name }}
        </option>
      </select>
    </div>

    <div v-if="loading" class="text-center py-10">Carregando...</div>
    <div v-else-if="filteredFavorites.length === 0" class="text-center py-20 bg-gray-50 rounded-lg">
      <p class="text-xl text-gray-500">Nenhum filme encontrado.</p>
    </div>

    <div v-else class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <MovieCard
        v-for="movie in filteredFavorites"
        :key="movie.tmdb_id"
        :movie="movie"
        :show-genres="true"
      >
        <template #actions>
          <BaseButton variant="danger" @click="removeFavorite(movie.tmdb_id)"> Remover </BaseButton>
        </template>
      </MovieCard>
    </div>
  </div>
</template>
