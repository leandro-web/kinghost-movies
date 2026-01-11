<script setup lang="ts">
import { ref, onMounted } from "vue";
import { apiLaravel } from "../Services/api";
import MovieCard from "../components/MovieCard.vue";
import BaseButton from "../components/BaseButton.vue";

const searchQuery = ref("");
const movies = ref([]);
const loading = ref(false);

const loadPopularMovies = async () => {
  loading.value = true;
  try {
    const response = await apiLaravel.get("/movies/popular");
    movies.value = response.data.results;
  } catch (error) {
    console.error("Erro ao carregar filmes populares:", error);
  } finally {
    loading.value = false;
  }
};

const searchMovies = async () => {
  if (!searchQuery.value) {
    loadPopularMovies();
    return;
  }

  loading.value = true;
  try {
    const response = await apiLaravel.get("/movies/search", {
      params: { query: searchQuery.value },
    });
    movies.value = response.data.results;
  } catch (error) {
    console.error("Erro ao buscar filmes:", error);
  } finally {
    loading.value = false;
  }
};

const addToFavorites = async (movie) => {
  try {
    await apiLaravel.post("/favorites", {
      tmdb_id: movie.id,
      title: movie.title,
      poster_path: movie.poster_path,
      overview: movie.overview,
      release_date: movie.release_date,
      genres: movie.genre_ids,
    });
    alert("Filme adicionado aos favoritos com sucesso!");
  } catch (error) {
    console.error(error);
    alert("Erro ao adicionar filme aos favoritos:");
  }
};

onMounted(async () => {
  await loadPopularMovies();
});
</script>

<template>
  <div class="p-6 max-w-7xl mx-auto">
    <h1 class="text-3x1 font-bold mb-6 text-gray-800 border-b pb-2">
      {{ searchQuery ? "Resultado da busca:" : "Filmes Populares" }}
    </h1>

    <div class="flex gap-2 mb-8">
      <input
        type="text"
        v-model="searchQuery"
        @keyup.enter="searchMovies"
        placeholder="Pesquisar filme"
        class="flex-1 p-2 border border-gray-300 rounded shadow-sm focus:ring-2 focus:ring-blue-500"
      />
      <button
        @click="searchMovies"
        class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition"
      >
        Pesquisar
      </button>
    </div>

    <div v-if="loading" class="flex justify-center items-center h-40">Carregando...</div>

    <div v-else class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <MovieCard v-for="movie in movies" :key="movie.id" :movie="movie" :show-genres="true">
        <template #actions>
          <BaseButton
            @click="addToFavorites(movie)"
            :disabled="movie.is_favorite"
            :variant="movie.is_favorite ? 'disabled' : 'primary'"
          >
            {{ movie.is_favorite ? "Salvo" : "Favoritar" }}
          </BaseButton>
        </template>
      </MovieCard>
    </div>
  </div>
</template>
