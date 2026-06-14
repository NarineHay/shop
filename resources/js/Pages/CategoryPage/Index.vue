<script setup>
import { ref, computed, watch } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { useTrans } from '/resources/js/trans';

const page = usePage()

const props = defineProps({
    categoryPage: Object,
    locale: String
})
console.log('CategoryPage props:', props.categoryPage)
// Banner dannye
const bannerImage = computed(() => {
    if (props.categoryPage?.banner_image) {
        return `/storage/${props.categoryPage.banner_image}`
    }
    return null
})

const bannerTitle = computed(() => {
    if (props.categoryPage?.translation_lang.banner_title) {
        return props.categoryPage.translation_lang.banner_title
    }
    if (props.categoryPage?.category?.translation?.name) {
        return props.categoryPage.category.translation.name
    }
    return useTrans('app.category')
})

const bannerText = computed(() => {
    if (props.categoryPage?.translation_lang.banner_text) {
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
        return `/${props.locale}/category-page/${category.translation?.slug}`
    }
    return `/${props.locale}/products/${category.translation?.slug}`
}

// Debug
console.log('Children categories:', childrenCategories.value)
</script>

<template>
    <GuestLayout>
        <Head :title="bannerTitle" />

        <!-- Banner Section -->
        <div v-if="bannerImage" class="banner-area-wrapper pt-30 pb-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="banner-container"
                             :style="{ backgroundImage: `linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url(${bannerImage})` }"
                             style="background-size: cover; background-position: center; border-radius: 15px; padding: 60px 40px;">
                            <div class="banner-content text-center">
                                <h1 v-if="bannerTitle" class="banner-title">
                                    {{ bannerTitle }}
                                </h1>
                                <p v-if="bannerText" class="banner-text">
                                    {{ bannerText }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2>{{ props.categoryPage.translation_lang.page_title }}</h2>
                    <p v-html="props.categoryPage.translation_lang.content"></p>
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

                                    <!-- Odna kartochka s odnim borderom -->
                                    <div class="single-blogg-item mb-30">
                                        <div class="blogg-thumb">
                                            <Link :href="getCategoryLink(category)">
                                                <img :src="mainImage(category)" :alt="category.translation?.name || category.name" class="img-fit">
                                            </Link>
                                        </div>

                                        <div class="blogg-content card-body fixed-content">
                                            <span>
                                                <Link class="btn-cart py-2 text-white" type="btn" :href="getCategoryLink(category)">
                                                    {{ useTrans('app.buttons.show_more') }}
                                                </Link>
                                            </span>

                                            <div class="title-wrapper mt-2">
                                                <h5>{{ category.translation?.name || category.name }}</h5>
                                            </div>

                                            <p class="text-truncate-3 mt-3">{{ category.translation?.description }}</p>
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
/* Banner styles */
.banner-container {
    transition: all 0.3s ease;
}

/* H1 стили - белый большой текст */
.banner-title {
    color: white !important;
    font-size: 48px !important;
    font-weight: bold !important;
    margin-bottom: 20px !important;
}

/* P стили */
.banner-text {
    color: white !important;
    font-size: 20px !important;
    max-width: 800px !important;
    margin: 0 auto !important;
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
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s ease;
    background: white;
}

.single-blogg-item:hover {
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.blogg-thumb {
    width: 100%;
    height: 200px;
    overflow: hidden;
}

.img-fit {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.3s ease;
}

.single-blogg-item:hover .img-fit {
    transform: scale(1.05);
}

/* Fiksiruem vysotu vsego kontenta */
.fixed-content {
    height: 220px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    overflow: hidden;
    padding: 15px;
}


/* Nazvanie: fiksirovannaya vysota i maksimum 2 stroki */
.title-wrapper {
    height: 48px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 100%;
    margin-bottom: 5px;
    border-bottom: 1px solid #f0f0f0;
}

.title-wrapper h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
}

.title-wrapper h5 a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s;
}

.title-wrapper h5 a:hover {
    color: #4a90e2;
}

h5::before {
    background: none;
}

/* Opisanie: maksimum 3 stroki */
.text-truncate-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #666;
    font-size: 14px;
    line-height: 1.5;
    margin-top: 10px;
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
    .banner-container {
        padding: 40px 20px !important;
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

    .fixed-content {
        height: 200px;
    }

    .title-wrapper {
        height: 40px;
    }
    
    h2 {
        font-size: 24px !important;
    }
}
</style>