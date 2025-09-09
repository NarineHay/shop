<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'
import ResultModal from '@/Components/ResultModal.vue'

const showingNavigationDropdown = ref(false);
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
