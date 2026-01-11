<script setup lang="ts">
import { computed } from "vue";
import { getGenreNames } from "../utils/genres";

const props = defineProps({
  movie: {
    type: Object,
    required: true,
  },
  showGenres: {
    type: Boolean,
    default: false,
  },
});

const posterUrl = computed(() =>
  props.movie.poster_path ? `https://image.tmdb.org/t/p/w500${props.movie.poster_path}` : null
);

const formattedDate = computed(() => {
  if (!props.movie.release_date && !props.movie.created_at) return "Data desconhecida";
  const date = props.movie.release_date || props.movie.created_at;
  return new Date(date).toLocaleDateString("pt-BR");
});
</script>

<template>
  <div
    class="flex flex-col bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 h-full border border-gray-100"
  >
    <div class="relative h-96 bg-gray-200">
      <img
        v-if="posterUrl"
        :src="posterUrl"
        :alt="movie.title"
        class="w-full h-full object-cover"
      />
      <div v-else class="flex items-center justify-center h-full text-gray-400 flex-col">
        <span>Sem Imagem</span>
      </div>
    </div>

    <div class="p-4 flex-1 flex flex-col">
      <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ movie.title }}</h3>
      <p class="text-sm text-gray-600 mb-2">{{ formattedDate }}</p>

      <div v-if="showGenres && movie.genres" class="flex flex-wrap gap-1 mb-3">
        <span
          v-for="name in getGenreNames(movie.genres).slice(0, 2)"
          :key="name"
          class="text-[10px] bg-gray-100 text-gray-700 px-2 py-1 rounded-full"
          >{{ name }}
        </span>
      </div>

      <div v-else>
        <span class="text-[10px] text-gray-500">Sem gêneros</span>
      </div>

      <div class="mt-4">
        <slot name="actions" />
      </div>
    </div>
  </div>
</template>
