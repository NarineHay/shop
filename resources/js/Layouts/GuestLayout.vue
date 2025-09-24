<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'
import ResultModal from '@/Components/ResultModal.vue'

</script>

<template>
  <div>
    <Navbar />
    <main>
      <slot />
            <ResultModal />

    </main>
    <Footer />
  </div>
</template>
