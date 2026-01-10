<script setup lang="ts">
import { RouterView } from "vue-router";
import FooterBar from "./components/FooterBar.vue";
import HeaderBar from "./components/HeaderBar.vue";
import HelloWorld from "./components/HelloWorld.vue";
</script>

<template>
  <div class="min-h-screen bg-gray-50">
    <HeaderBar />
    <RouterView />
    <HelloWorld msg="You did it!" />
    <FooterBar />
  </div>
</template>
