<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { useRoute, useTrans } from '/resources/js/trans';

const services = [
    { key: 'electrical_installation', icon: 'fa-solid fa-bolt' },
    { key: 'industrial_automation', icon: 'fa-solid fa-gears' },
    { key: 'panel_assembly', icon: 'fa-solid fa-toolbox' },
    { key: 'equipment_supply', icon: 'fa-solid fa-boxes-stacked' },
    { key: 'technical_advice', icon: 'fa-solid fa-comments' },
    { key: 'maintenance_upgrades', icon: 'fa-solid fa-screwdriver-wrench' },
];
</script>

<template>
    <GuestLayout>
        <Head :title="useTrans('page.title')" />

        <section class="services-page">
            <div class="services-hero">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-12 text-center">
                            <span class="services-eyebrow">KASAMAN</span>
                            <h1>{{ useTrans('page.title') }}</h1>
                            <h2>{{ useTrans('page.headline') }}</h2>
                            <p>{{ useTrans('page.intro') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="services-list pt-70 pb-35">
                <div class="container-fluid">
                    <div class="row">
                        <div
                            v-for="(service, index) in services"
                            :key="service.key"
                            class="col-lg-4 col-md-6 col-12 mb-30"
                        >
                            <article class="service-card">
                                <div class="service-icon" aria-hidden="true">
                                    <i :class="service.icon"></i>
                                </div>
                                <div class="service-number" aria-hidden="true">
                                    {{ String(index + 1).padStart(2, '0') }}
                                </div>
                                <h3>{{ useTrans(`page.${service.key}_title`) }}</h3>
                                <p>{{ useTrans(`page.${service.key}_text`) }}</p>
                            </article>
                        </div>
                    </div>
                </div>
            </div>

            <div class="services-cta pb-70">
                <div class="container-fluid">
                    <div class="cta-panel text-center">
                        <h2>{{ useTrans('page.cta') }}</h2>
                        <div class="cta-actions">
                            <Link class="btn-cart services-button" :href="useRoute('contact_us')">
                                {{ useTrans('page.consultation_button') }}
                            </Link>
                            <a
                                class="btn-cart services-button services-button-outline"
                                href="mailto:kasamansolutions@gmail.com"
                            >
                                {{ useTrans('page.project_button') }}
                            </a>
                            <Link class="services-catalog-link" :href="`${useRoute('welcome')}#catalog`">
                                {{ useTrans('page.catalog_button') }}
                                <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>

<style scoped>
.services-page {
    background: #fff;
}

.services-hero {
    padding: 72px 0 66px;
    background: #fff;
    border-bottom: 1px solid #ececec;
}

.services-eyebrow {
    display: inline-block;
    margin-bottom: 12px;
    color: #c92829;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.18em;
}

.services-hero h1 {
    margin-bottom: 14px;
    color: #111;
    font-size: 42px;
    font-weight: 700;
    line-height: 1.2;
}

.services-hero h2 {
    margin-bottom: 18px;
    color: #333;
    font-size: 22px;
    font-weight: 600;
    line-height: 1.45;
}

.services-hero p {
    max-width: 880px;
    margin: 0 auto;
    font-size: 16px;
    line-height: 1.8;
}

.service-card {
    position: relative;
    height: 100%;
    min-height: 285px;
    padding: 35px 32px;
    overflow: hidden;
    background: #fff;
    border: 1px solid #e8e8e8;
    border-radius: 4px;
    box-shadow: 0 10px 30px rgba(17, 17, 17, 0.05);
    transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
}

.service-card::after {
    position: absolute;
    right: 0;
    bottom: 0;
    width: 0;
    height: 3px;
    background: #c92829;
    content: '';
    transition: width 0.3s ease;
}

.service-card:hover {
    border-color: rgba(201, 40, 41, 0.35);
    box-shadow: 0 16px 40px rgba(17, 17, 17, 0.1);
    transform: translateY(-5px);
}

.service-card:hover::after {
    width: 100%;
}

.service-icon {
    display: flex;
    width: 58px;
    height: 58px;
    margin-bottom: 25px;
    align-items: center;
    justify-content: center;
    color: #fff;
    background: #c92829;
    border-radius: 50%;
    font-size: 22px;
}

.service-number {
    position: absolute;
    top: 24px;
    right: 26px;
    color: #ededed;
    font-size: 42px;
    font-weight: 800;
    line-height: 1;
}

.service-card h3 {
    position: relative;
    margin-bottom: 12px;
    color: #111;
    font-size: 20px;
    font-weight: 600;
    line-height: 1.45;
}

.service-card p {
    position: relative;
    font-size: 15px;
    line-height: 1.75;
}

.cta-panel {
    padding: 55px 35px;
    color: #fff;
    background: #171717;
    border-radius: 4px;
}

.cta-panel h2 {
    max-width: 900px;
    margin: 0 auto 28px;
    color: #fff;
    font-size: 25px;
    font-weight: 600;
    line-height: 1.5;
}

.cta-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 14px 18px;
    align-items: center;
    justify-content: center;
}

.services-button {
    display: inline-block;
    margin-top: 0;
    line-height: 42px;
    text-decoration: none;
}

.services-button-outline {
    background: transparent;
    border: 1px solid #c92829;
}

.services-catalog-link {
    display: inline-flex;
    gap: 9px;
    align-items: center;
    padding: 10px 4px;
    color: #fff;
    font-weight: 600;
}

.services-catalog-link:hover {
    color: #c92829;
}

@media (max-width: 767px) {
    .services-hero {
        padding: 50px 0 45px;
    }

    .services-hero h1 {
        font-size: 32px;
    }

    .services-hero h2 {
        font-size: 19px;
    }

    .services-hero p {
        font-size: 15px;
    }

    .service-card {
        min-height: 0;
        padding: 30px 25px;
    }

    .cta-panel {
        padding: 42px 20px;
    }

    .cta-panel h2 {
        font-size: 21px;
    }

    .cta-actions {
        flex-direction: column;
    }
}
</style>
