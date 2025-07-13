<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import NavbarGuest from '@/Components/NavbarGuest.vue'
import Footer from '@/Components/Footer.vue'
</script>

<template>
  <div>
    <NavbarGuest />
    <main>
      <slot />
    </main>
    <Footer />
  </div>
</template>
