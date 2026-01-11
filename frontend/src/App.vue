<script setup lang="ts">
import { RouterView } from "vue-router";
import FooterBar from "./components/FooterBar.vue";
import HeaderBar from "./components/HeaderBar.vue";
</script>

<template>
  <div class="min-h-screen bg-gray-50">
    <HeaderBar />
    <RouterView />
    <FooterBar />
  </div>
</template>
