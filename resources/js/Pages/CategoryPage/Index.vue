<script setup>
import { ref, computed, watch } from 'vue'
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { useTrans } from '/resources/js/trans';

const props = defineProps({
    categoryPage: Object,
    locale: String
})
// Banner dannye
const bannerImage = computed(() => {
    if (props.categoryPage?.banner_image) {
        return `/storage/${props.categoryPage.banner_image}`
    }
    return null
})

const bannerTitle = computed(() => {
    if (props.categoryPage?.translation_lang?.banner_title) {
        return props.categoryPage.translation_lang.banner_title
    }
    if (props.categoryPage?.category?.translation?.name) {
        return props.categoryPage.category.translation.name
    }
    return useTrans('app.category')
})

const bannerText = computed(() => {
    if (props.categoryPage?.translation_lang?.banner_text) {
        return props.categoryPage.translation_lang.banner_text
    }
    return ''
})

// Poluchaem children iz category
const childrenCategories = ref([])

// Funksiya dlya obnovleniya detey
const updateChildren = () => {
    if (props.categoryPage?.category?.children && props.categoryPage.category.children.length) {
        childrenCategories.value = props.categoryPage.category.children
    } else if (props.categoryPage?.children && props.categoryPage.children.length) {
        childrenCategories.value = props.categoryPage.children
    } else {
        childrenCategories.value = []
    }
}

// Sledim za izmeneniem locale
watch(() => props.locale, () => {
    updateChildren()
}, { immediate: true })

// Sledim za izmeneniem categoryPage
watch(() => props.categoryPage, () => {
    updateChildren()
}, { immediate: true, deep: true })

// Pagination
const currentPage = ref(1)
const itemsPerPage = 6

const paginatedChildren = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage
    const end = start + itemsPerPage
    return childrenCategories.value.slice(start, end)
})

const totalPages = computed(() => {
    return Math.ceil(childrenCategories.value.length / itemsPerPage)
})

const goToPage = (page) => {
    if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page
        window.scrollTo({ top: 0, behavior: 'smooth' })
    }
}

// Poluchaem izobrazhenie dlya kategorii
const mainImage = (category) => {
    if (category.image) {
        return `/storage/${category.image}`
    }
    return ''
}

// Funktsiya dlya polucheniya ssylki
const getCategoryLink = (category) => {
    if (category.children && category.children.length > 0) {
        return `/${props.locale}/category/${category.translation?.slug}`
    }
    return `/${props.locale}/products/${category.translation?.slug}`
}
</script>

<template>
    <GuestLayout>
        <Head :title="bannerTitle" />

        <!-- Banner Section -->
        <div v-if="bannerImage" class="banner-area-wrapper pt-30 pb-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <img :src="bannerImage" :alt="bannerTitle" class="banner-image">
                    </div>
                </div>
            </div>
        </div>

        <div class="category-intro container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1 v-if="bannerTitle" class="banner-title">{{ bannerTitle }}</h1>
                    <p v-if="bannerText" class="banner-text">{{ bannerText }}</p>
                    <h2 v-if="props.categoryPage?.translation_lang?.page_title">
                        {{ props.categoryPage.translation_lang.page_title }}
                    </h2>
                    <div
                        v-if="props.categoryPage?.translation_lang?.content"
                        class="category-content"
                        v-html="props.categoryPage.translation_lang.content"
                    ></div>
                </div>
            </div>
        </div>

        <!-- Categories Children Section -->
        <div class="blog-area-wrapper pt-30 pb-65">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog-wrapper-inner">
                            <div class="row">
                                <div v-for="category in paginatedChildren"
                                     :key="category.id"
                                     class="col-sm-6 col-lg-4">

                                    <div class="single-blogg-item mb-30">
                                        <div class="blogg-thumb">
                                            <Link :href="getCategoryLink(category)">
                                                <img :src="mainImage(category)" :alt="category.translation?.name || category.name" class="img-fit">
                                            </Link>
                                        </div>

                                        <div class="blogg-content card-body">
                                            <h5>
                                                <Link :href="getCategoryLink(category)">
                                                    {{ category.translation?.name || category.name }}
                                                </Link>
                                            </h5>
                                            <Link
                                                class="btn-cart d-inline-block text-white"
                                                :href="getCategoryLink(category)"
                                            >
                                                {{ useTrans('app.buttons.show_more') }}
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div v-if="totalPages > 1" class="paginatoin-area text-center pt-40">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="pagination-box">
                                        <li>
                                            <a class="Previous" href="#" @click.prevent="goToPage(currentPage - 1)" :class="{ disabled: currentPage === 1 }">
                                                {{ useTrans('app.previous') }}
                                            </a>
                                        </li>
                                        <li v-for="page in totalPages"
                                            :key="page"
                                            :class="{ active: page === currentPage }">
                                            <a href="#" @click.prevent="goToPage(page)">{{ page }}</a>
                                        </li>
                                        <li>
                                            <a class="Next" href="#" @click.prevent="goToPage(currentPage + 1)" :class="{ disabled: currentPage === totalPages }">
                                                {{ useTrans('app.next') }}
                                            </a>
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

<style scoped>
.banner-image {
    display: block;
    width: 100%;
    height: auto;
    border-radius: 15px;
}

.category-intro {
    padding-bottom: 15px;
}

.banner-title {
    color: #333 !important;
    font-size: 48px !important;
    font-weight: bold !important;
    margin-bottom: 15px !important;
}

.banner-text {
    color: #555 !important;
    font-size: 20px !important;
    line-height: 1.6;
    margin-bottom: 25px !important;
}

/* H2 стили */
h2 {
    color: #333 !important;
    font-size: 32px !important;
    font-weight: 600 !important;
    margin-bottom: 15px !important;
}

/* Odna kartochka s odnim borderom */
.single-blogg-item {
    border: 1px solid #f0f0f0;
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
    background: white;
}

.single-blogg-item:hover {
    border-color: #c92829;
}

.blogg-thumb {
    width: 100%;
    height: 200px;
    overflow: hidden;
    background: #fff;
}

.img-fit {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
    transition: opacity 0.3s ease;
}

.single-blogg-item:hover .img-fit {
    opacity: 0.9;
}

/* Fiksiruem vysotu vsego kontenta */
.blogg-content {
    padding: 22px 15px 26px;
    text-align: left;
}

.blogg-content h5 {
    margin: 0;
    font-size: 15px;
    font-weight: 400;
    line-height: 22px;
}

.blogg-content h5 a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s;
}

.blogg-content h5 a:hover {
    color: #4a90e2;
}

.blogg-content h5::before {
    content: none;
}

/* Pagination - vash stil */
.pagination-box {
    display: flex;
    list-style: none;
    justify-content: center;
    gap: 10px;
    padding: 0;
}

.pagination-box li a {
    padding: 8px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    color: #333;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s;
}

.pagination-box li a:hover {
    background: #f5f5f5;
    border-color: #333;
}

.pagination-box li.active a {
    background: #333;
    color: white;
    border-color: #333;
}

.disabled {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
}

/* Responsive */
@media (max-width: 768px) {
    .banner-area-wrapper {
        padding-top: 15px;
        padding-bottom: 20px;
    }

    .banner-title {
        font-size: 32px !important;
    }

    .banner-text {
        font-size: 16px !important;
    }

    .blogg-thumb {
        height: 180px;
    }

    h2 {
        font-size: 24px !important;
    }
}
</style>
