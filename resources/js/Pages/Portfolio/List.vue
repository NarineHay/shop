<script setup>
import { onMounted, computed  } from 'vue'

import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue'
import Portfolio from '@/Components/SinglePortfolioItem.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useTrans, useRoute } from '/resources/js/trans';


const props = defineProps({
    portfolio: Array,
    locale: String
})

</script>

<template>
    <GuestLayout>
        <Head :title="useTrans('page.title')" />
            <div class="blog-area-wrapper pt-30 pb-65">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="blog-wrapper-inner">
                                <div class="row">
                                        <div v-for="item in props.portfolio" class="col-sm-6 col-lg-4">
                                            <Portfolio :portfolio='item' :locale="props.locale" />

                                        </div>

                                </div>
                            </div>
                            <div class="paginatoin-area text-center pt-40">
                                    <div class="row">
                                        <div class="col-12">
                                            <ul class="pagination-box">
                                                <li><a class="Previous" href="#">Previous</a>
                                                </li>
                                                <li class="active"><a href="#">1</a></li>
                                                <li><a href="#">2</a></li>
                                                <li><a href="#">3</a></li>
                                                <li>
                                                <a class="Next" href="#"> Next </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
    </GuestLayout>
</template>


