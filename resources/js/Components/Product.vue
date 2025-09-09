<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import { useCompareStore } from '@/Stores/compare';

const props = defineProps({
    product: Object
});

const compare = useCompareStore();
// Добавление в compare
// const addToCompare = (productId) => {
//     let compareList = JSON.parse(localStorage.getItem('compare_products') || '[]');

//     // Проверка — нет ли уже такого продукта
//     if (!compareList.includes(productId)) {
//         compareList.push(productId);
//     }

//     localStorage.setItem('compare_products', JSON.stringify(compareList));
//     alert('Товар добавлен в сравнение');
// };

</script>

<template>
    <div  class="product-item">
        <div class="product-thumb">
            <a href="product-details.html">
                <img v-for="img in product.images" :src="img.path_url" :class="img.is_main ? 'pri-img' : 'sec-img'" alt="">
            </a>
            <div class="box-label">
                <div class="label-product label_new">
                    <span>new</span>
                </div>
            </div>

            <div class="action-links">
                <a href="#" title="Wishlist"><i class="lnr lnr-heart"></i></a>
                <a href="#" title="Compare" @click.capture.prevent.stop="compare.add(product.id); $event.stopImmediatePropagation()"><i class="lnr lnr-sync"></i></a>
                <a href="#" title="Quick view" data-bs-target="#quickk_view" data-bs-toggle="modal"><i class="lnr lnr-magnifier"></i></a>
            </div>
        </div>
        <div class="product-caption ">
            <div class="manufacture-product">
                <p><a href="shop-grid-left-sidebar.html">apple</a></p>
            </div>
            <div class="product-name">
                <h4><a href="product-details.html">{{product.translation_lang?.name}}</a></h4>
            </div>

            <div class="price-box">
                <span class="regular-price">{{product.price}} ֏</span>
            </div>
            <button class="btn-cart" type="button">add to cart</button>
        </div>
    </div>

</template>
