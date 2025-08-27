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
import { initStickyClass } from '@/sticky.js'


const props = defineProps({
    portfolio: Array,
})

const portfolio = props.portfolio;

onMounted(() => {
    initStickyClass()
    console.log(888888)
  console.log(props.portfolio, 11111)
})



</script>

<template>
    <GuestLayout>
        <Head :title="useTrans('page.title')" />
            <div class="product-details-main-wrapper pb-50">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="product-large-slider-sticky mb-20">
                                <div v-for="image in props.portfolio.images" class="pro-large-img mb-30">
                                    <img :src="image.path_url" alt="">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 order-first order-md-last" style="position: relative;">
                            <div class="product-details-inner is-stickyy" style=""><div class="inner-wrapper-sticky" style="position: relative;">
                                <div class="product-details-contentt">
                                    <div class="pro-details-name mb-10">
                                        <h3>{{portfolio.translation_lang.name}}</h3>
                                    </div>


                                    <div class="product-detail-sort-des pb-20">
                                        <p>{{portfolio.translation_lang.description}}</p>
                                    </div>
                                    <div v-if="portfolio.translation_lang.technologies" class="pro-details-list pt-5">
                                        <h4>Technologies</h4>
                                        <p>{{portfolio.translation_lang.technologies}}</p>
                                    </div>


                                </div>
                            <div dir="ltr" class="resize-sensor" style="pointer-events: none; position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden; max-width: 100%;"><div class="resize-sensor-expand" style="pointer-events: none; position: absolute; left: 0px; top: 0px; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden; max-width: 100%;"><div style="position: absolute; left: 0px; top: 0px; transition: all; width: 649px; height: 707px;"></div></div><div class="resize-sensor-shrink" style="pointer-events: none; position: absolute; left: 0px; top: 0px; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden; max-width: 100%;"><div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%"></div></div></div></div></div>
                        <div dir="ltr" class="resize-sensor" style="pointer-events: none; position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden; max-width: 100%;"><div class="resize-sensor-expand" style="pointer-events: none; position: absolute; left: 0px; top: 0px; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden; max-width: 100%;"><div style="position: absolute; left: 0px; top: 0px; transition: all; width: 673px; height: 2889px;"></div></div><div class="resize-sensor-shrink" style="pointer-events: none; position: absolute; left: 0px; top: 0px; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden; max-width: 100%;"><div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%"></div></div></div></div>
                    </div>
                </div>
            </div>
    </GuestLayout>
</template>


