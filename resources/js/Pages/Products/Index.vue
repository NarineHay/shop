<script setup>
import { onMounted, computed, ref, watch  } from 'vue'

import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { useTrans, useRoute } from '/resources/js/trans';
import { useCartStore } from '@/Stores/cart'
import { useModalStore } from '@/Stores/modalStore'
import { useCompareStore } from '@/Stores/compare';
import Product from '@/Components/Product.vue';

const props = defineProps({
    products: Array,
    attributes: Array,
    categorychildren: Array,
    filters: Object
})

const products = computed(() => props.products?.data || [])
const forPages = props.products
const attributes = props.attributes
const categorychildren = props.categorychildren
const selectedCategories = ref(props.filters.categories || [])
const selectedAttributes = ref(props.filters.attributes || [])
const priceMin = ref(props.filters.price_min || 0)
const priceMax = ref(props.filters.price_max || 10000)


const cartStore = useCartStore()
const modal = useModalStore()
const compare = useCompareStore();


const priceMinMax = ref([0, 10000])

watch(priceMinMax, (val) => {
  priceMin.value = val[0]
  priceMax.value = val[1]
})


function applyFilter () {


  router.get(route('products', {
      locale: route().params.locale,
      category_slug: route().params.category_slug
    }),
    {
      categories: selectedCategories.value,
      attributes: selectedAttributes.value,
      price_min: priceMin.value,
      price_max: priceMax.value
    },
    { preserveState: true, replace: true })
  // сюда фильтрацию products или запрос к серверу
}

const resetFilter = () => {
   selectedCategories.value = []
   selectedAttributes.value = []
   priceMin.value = 0
   priceMax.value = 10000
   applyFilter() // ✅ правильная функция
}

</script>

<template>
    <GuestLayout>
        <Head :title="useTrans('page.title')" />
            <div class="main-wrapper pt-35">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="shop-sidebar-inner mb-30">
                                <!-- filter-price-content start -->

                                <div class="single-sidebar mb-45">
                                <div class="sidebar-inner-title mb-25">
                                    <h3>{{useTrans('page.filters')}}</h3>
                                </div>
                                <div class="sidebar-content-box">

                                    <!-- ===== Цена ===== -->
                                    <div class="single-sidebar mb-25">
                                    <div class="sidebar-inner-title mb-25">
                                        <h3>{{useTrans('page.price')}}</h3>
                                    </div>
                                    <div class="filter-price-content">
                                        <div class="d-flex gap-2">
                                        <div class="custom-checkbox w-100">
                                            <label class="form-check-label">{{useTrans('page.min')}}</label>
                                            <input
                                            type="number"
                                            class="form-control mt-1 rounded border-gray-300 text-sm focus:ring-indigo-500"
                                            v-model="priceMin"
                                            min="0"
                                            placeholder="0"
                                            />
                                        </div>
                                        <div class="custom-checkbox w-100">
                                            <label class="form-check-label">{{useTrans('page.max')}}</label>
                                            <input
                                            type="number"
                                            class="form-control mt-1 rounded border-gray-300 text-sm focus:ring-indigo-500"
                                            v-model="priceMax"
                                            min="0"
                                            placeholder="9999"
                                            />
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                                    <!-- ===== Категории ===== -->
                                    <div class="single-sidebar mb-25">
                                    <div class="sidebar-inner-title mb-25">
                                        <h3>{{useTrans('page.categories')}}</h3>
                                    </div>
                                    <div class="sidebar-content-box">
                                        <ul>
                                        <li v-for="item in categorychildren" :key="item.id" class="mb-2">
                                            <div class="custom-checkbox">
                                            <input
                                                type="checkbox"
                                                class="form-check-input"
                                                :id="'cat-' + item.id"
                                                v-model="selectedCategories"
                                                :value="item.id"
                                            />
                                            <span class="checkmark"></span>
                                            <label class="form-check-label ml-2" :for="'cat-' + item.id">
                                                {{ item.translation.name }}
                                            </label>
                                            </div>
                                        </li>
                                        </ul>
                                    </div>
                                    </div>

                                    <!-- ===== Атрибуты ===== -->
                                    <div v-for="attribute in attributes" :key="attribute.id" class="single-sidebar mb-25">
                                    <div class="sidebar-inner-title mb-25">
                                        <h3>{{ attribute.translation_lang.name }}</h3>
                                    </div>
                                    <div class="sidebar-content-box">
                                        <ul>
                                        <li v-for="value in attribute.values" :key="value.id" class="mb-2">
                                            <div class="custom-checkbox">
                                            <input
                                                type="checkbox"
                                                class="form-check-input"
                                                :id="'attr-' + value.id"
                                                v-model="selectedAttributes"
                                                :value="value.id"
                                            />
                                            <span class="checkmark"></span>
                                            <label class="form-check-label ml-2" :for="'attr-' + value.id">
                                                {{ value.translation_lang.name }}
                                            </label>
                                            </div>
                                        </li>
                                        </ul>
                                    </div>
                                    </div>

                                    <!-- ===== Кнопки ===== -->
                                    <div class="d-flex gap-2 mt-4">
                                    <button
                                        type="button"
                                        class="btn btn-warning text-white fw-bold"
                                        @click="applyFilter"
                                    >
                                        {{useTrans('page.filter')}}
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary"
                                        @click="resetFilter"
                                    >
                                       {{useTrans('page.cancel')}}
                                    </button>
                                    </div>

                                </div>
                                </div>

                            </div>
                            <!-- sidebar promote picture start -->
                            <div class="single-sidebar mb-30">
                                <div class="sidebar-thumb">
                                    <a href="#"><img src="/assets/img/banner/img-static-sidebar.jpg" alt=""></a>
                                </div>
                            </div>
                                <!-- sidebar promote picture end -->
                        </div>
                        <div class="col-lg-9 order-first order-lg-last">
                            <div class="product-shop-main-wrapper mb-50">
                                <div class="shop-baner-img mb-70">
                                    <a href="#"><img src="/assets/img/banner/category-image.webp" alt=""></a>
                                </div>

                                <div class="shop-product-wrap row column_3">
                                    <template v-for="product in products" :key="product.id" >
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <Product :product="product" />
                                        </div>
                                    </template>

                                </div>


                                <div v-if="forPages.last_page > 1" class="paginatoin-area style-2 pt-35 pb-20 mt-5" >
                                    <div class="row">
                                        <div class="col-sm-6">
                                        <div class="pagination-area">
                                            <p>{{paginationText}}


                                            {{ useTrans('page.paginat', {
                                                from: forPages.from,
                                                to: forPages.to,
                                                of: forPages.total,
                                                pages: forPages.last_page
                                                })
                                             }}
                                            </p>
                                        </div>
                                        </div>

                                        <div class="col-sm-6">
                                        <ul class="pagination-box pagination-style-2">
                                            <li v-for="link in forPages.links" :key="link.label"
                                                :class="{ active: link.active, disabled: !link.url }">
                                            <Link
                                                v-if="link.url"
                                                :href="link.url"
                                                v-html="link.label"
                                            />
                                            <span v-else v-html="link.label"></span>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>


                                <!-- <div class="paginatoin-area style-2 pt-35 pb-20">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="pagination-area">
                                                <p>Showing 1 to 9 of 9 (1 Pages)</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <ul class="pagination-box pagination-style-2">
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
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </GuestLayout>
</template>



