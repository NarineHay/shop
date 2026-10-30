<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { useRoute, useTrans } from '/resources/js/trans';
</script>

<template>
    <GuestLayout>
        <Head :title="useTrans('page.title')" />

        <section class="contact-style-2 pt-30 pb-35">
            <div class="container-fluid">
                <div class="row my-4">
                    <div class="col-lg-10 col-12 mx-auto">
                        <div class="contact2-title text-center mb-65">
                            <h2>{{ useTrans('page.title') }}</h2>
                            <h3 class="about-headline">{{ useTrans('page.headline') }}</h3>
                            <p>{{ useTrans('page.intro') }}</p>
                        </div>
                    </div>
                </div>

                <div class="row my-5">
                    <div class="contact2-title text-center mb-65">
                        <h2>{{ useTrans('page.values_title') }}</h2>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact-single-info mb-30 text-center">
                            <div class="contact-icon">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <h3>{{ useTrans('page.reliability_title') }}</h3>
                            <p>{{ useTrans('page.reliability_text') }}</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact-single-info mb-30 text-center">
                            <div class="contact-icon">
                                <i class="fa-regular fa-handshake"></i>
                            </div>
                            <h3>{{ useTrans('page.honesty_title') }}</h3>
                            <p>{{ useTrans('page.honesty_text') }}</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact-single-info mb-30 text-center">
                            <div class="contact-icon">
                                <i class="fa-regular fa-clock"></i>
                            </div>
                            <h3>{{ useTrans('page.responsibility_title') }}</h3>
                            <p>{{ useTrans('page.responsibility_text') }}</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-10 col-12 mx-auto">
                        <div class="about-copy mb-65">
                            <p>{{ useTrans('page.work') }}</p>
                            <p>{{ useTrans('page.himel') }}</p>
                            <p>{{ useTrans('page.approach') }}</p>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-lg-10 col-12 mx-auto">
                        <div class="contact2-title text-center mb-65">
                            <p class="about-cta-text">{{ useTrans('page.cta') }}</p>
                            <Link class="btn-cart d-inline-block text-white" :href="useRoute('contact_us')">
                                {{ useTrans('page.button') }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>

<style scoped>
.about-headline {
    margin-bottom: 20px;
    color: #333;
    font-size: 20px;
    font-weight: 600;
    line-height: 1.5;
}

.about-copy {
    max-width: 1000px;
    margin-right: auto;
    margin-left: auto;
}

.about-copy p {
    margin-bottom: 18px;
    line-height: 1.8;
}

.about-cta-text {
    color: #111;
    font-weight: 600;
}

.btn-cart {
    text-decoration: none;
}

@media (max-width: 767px) {
    .about-headline {
        font-size: 18px;
    }
}
</style>
