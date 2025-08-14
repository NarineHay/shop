<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useTrans, useRoute } from '/resources/js/trans';


</script>

<template>
    <GuestLayout>
        <Head :title="useTrans('page.title')" />
            <section class="contact-style-2 pt-30 pb-35">
                <div class="container-fluid">
                    <div class="row my-4">
                        <div class="col-10 mx-auto">
                            <div class="contact2-title text-center mb-65 ">
                                <h2>{{useTrans('page.b1-h2')}}</h2>
                                <p> {{useTrans('page.b1-p1')}} </p>
                                <p> {{useTrans('page.b1-p2')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="contact2-title text-center mb-65 ">
                            <h2 class="text-center">{{useTrans('page.b2-h2')}}</h2>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="contact-single-info mb-30 text-center">
                                <div class="contact-icon">
                                    <i class="fa-solid fa-shield-halved"></i>
                                </div>
                                <h3>{{useTrans('page.b2-h3')}}</h3>
                                <p>{{useTrans('page.b2-p')}}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="contact-single-info mb-30 text-center">
                                <div class="contact-icon">
                                    <i class="fa-regular fa-handshake"></i>
                                </div>
                                <h3>{{useTrans('page.b3-h3')}}</h3>
                                <p>{{useTrans('page.b3-p')}}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="contact-single-info mb-30 text-center">
                                <div class="contact-icon">
                                    <i class="fa-regular fa-clock"></i>
                                </div>
                                <h3>{{useTrans('page.b4-h3')}} </h3>
                                <p> {{useTrans('page.b4-p')}}</p>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="contact2-title  mb-65">
                                <h2 class="text-center">{{useTrans('page.b5-h2')}}</h2>
                                <ul class="about-ul mx-auto col-4 ps-5">
                                    <li v-for="(item, index) in useTrans('page.b5-ul')" :key="index">
                                        {{ item }}
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="contact2-title text-center mb-65">
                                <p> {{useTrans('page.b6-p')}} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </GuestLayout>
</template>

<style scoped>
    .about-ul{
        padding-left: 9rem !important;
    }
    .about-ul li{
        list-style-type: circle !important;
    }
</style>
