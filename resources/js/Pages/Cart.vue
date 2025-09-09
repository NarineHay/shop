<script setup>
import { ref } from 'vue';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { useTrans, useRoute } from "/resources/js/trans";
import { useCompareStore } from '@/Stores/compare';

const props = defineProps({
  //   categories: Array,
  products: Array,
  attributes: Array
});




</script>

<template>
    <GuestLayout>
        <Head :title="useTrans('page.title')" />

    </GuestLayout>
</template>



