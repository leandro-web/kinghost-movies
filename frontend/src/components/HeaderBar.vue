<script setup lang="ts">
import { RouterLink } from "vue-router";
</script>

<template>
  <header class="bg-gray-900 text-white shadow-lg">
    <nav class="container mx-auto p-4 flex justify-between items-center">
      <RouterLink to="/" class="text-xl font-bold text-blue-400">Streaming LWSA</RouterLink>
      <div class="space-x-4">
        <RouterLink to="/" class="hover:text-blue-300 transition">Busca</RouterLink>
        <RouterLink to="/favoritos" class="hover:text-blue-300 transition"
          >Meus Favoritos</RouterLink
        >
      </div>
    </nav>
  </header>
</template>
