<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import { useCompareStore } from '@/Stores/compare';
import { useCartStore } from '@/Stores/cart';


const props = defineProps({
    product: Object
});

const compare = useCompareStore();
const cart = useCartStore();

// сортируем картинки: сначала главная, потом остальные
const sortedImages = computed(() => {
    if (!props.product?.images?.length) return [];

    // ищем главную
    const main = props.product.images.find(img => img.is_main);
    if (main) {
        return [main, ...props.product.images.filter(img => img !== main)];
    }

    // если главной нет → возвращаем как есть
    return props.product.images;
});


</script>

<template>
    <div  class="product-item">
        <div class="product-thumb">
            <a href="product-details.html">
                <img
                    v-for="(img, index) in sortedImages"
                    :key="img.id || img.path_url"
                    :src="img.path_url"
                    :class="index === 0 ? 'pri-img' : 'sec-img'"
                    alt=""
                >
            </a>
            <div class="box-label">
                <div class="label-product label_new">
                    <span>new</span>
                </div>
            </div>

            <div class="action-links">
                <a href="#" title="Wishlist"><i class="lnr lnr-heart"></i></a>
                <a href="#" title="Compare" @click.prevent="compare.add(product.id)"><i class="lnr lnr-sync"></i></a>
                <a href="#" title="Quick view" data-bs-target="#quickk_view" data-bs-toggle="modal"><i class="lnr lnr-magnifier"></i></a>
            </div>
        </div>
        <div class="product-caption ">
            <div class="product-name">
                <h4><a href="product-details.html">{{product.translation_lang?.name}}</a></h4>
            </div>

            <div class="price-box mt-2">
                <span class="regular-price">{{product.price}} ֏</span>
            </div>
            <button class="btn-cart" type="button" @click.prevent="cart.add(product.id)">add to cart</button>
        </div>
    </div>

</template>
<style scoped>
    .product-thumb {
    width: 100%;
    height: 250px; /* фиксированная высота карточки */
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    }

    .product-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* обрезает картинку и заполняет блок */
    }

    .product-name {
        min-height: 48px; /* под 2 строки текста (примерно 2 × 24px) */
        max-height: 48px; /* чтобы больше тоже не вылезало */
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
</style>
