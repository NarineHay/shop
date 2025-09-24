<script setup>
import { onMounted, computed, ref  } from 'vue'

import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useTrans, useRoute } from '/resources/js/trans';
import { initProductLargeSlider } from '@/product-large-slider'
import { useCartStore } from '@/Stores/cart'
import { useModalStore } from '@/Stores/modalStore'
import { useCompareStore } from '@/Stores/compare';
import Product from '@/Components/Product.vue';

const props = defineProps({
    product: Object,
    releatedProducts: Array
})

const product = props.product
const cartStore = useCartStore()
const modal = useModalStore()
const compare = useCompareStore();
// выбранные значения атрибутов
const selectedAttributes = ref({})
// выбранное количество
const qty = ref(1)

// группируем attribute_values по attribute_id
const groupedAttributes = computed(() => {
    const groups = {}
    const av = product.attribute_values ?? []
    av.forEach(item => {
        if (!groups[item.attribute_id]) groups[item.attribute_id] = []
        groups[item.attribute_id].push(item)
    })
    return groups
})

// Автозаполнение выбранных атрибутов с единственным значением
function autoSelectSingleAttributes() {
    Object.values(groupedAttributes.value ?? {}).forEach(values => {
        if (values.length === 1) {
            selectedAttributes.value[values[0].attribute_id] = values[0].id
        }
    })
}

// пользователь выбирает вариант
function selectAttribute(attributeId, valueId) {
    selectedAttributes.value[attributeId] = valueId
}

// проверка, все ли обязательные атрибуты выбраны
// если атрибут имеет больше одного значения → обязательный
const allRequiredSelected = computed(() => {
    return Object.values(groupedAttributes.value ?? {}).every(values => {
        if (values.length > 1) {
            return selectedAttributes.value[values[0].attribute_id] !== undefined
        }
        return true
    })
})

// добавление в корзину
function addToCart() {
    if (!allRequiredSelected.value) return
    cartStore.add(product.id, selectedAttributes.value, qty.value)
    modal.showSuccess('Товар добавлен в корзину')

}

// увеличение/уменьшение количества
function increaseQty() {
    qty.value++
}
function decreaseQty() {
    if (qty.value > 1) qty.value--
}

onMounted(() => {
    initProductLargeSlider()
    autoSelectSingleAttributes()
})


</script>

<template>
    <GuestLayout>
        <Head :title="useTrans('app.portfolio')" />
            <div class="product-details-main-wrapper pb-50">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="product-large-slider mb-4">
                                <div v-for="(img, index) in product.images" :key="index"  class="pro-large-img">
                                    <img :src="img.path_url" alt="" />
                                </div>
                            </div>
                            <div class="pro-nav">
                                <div v-for="(img, index) in product.images" :key="index" class="pro-nav-thumb">
                                    <img :src="img.path_url" alt="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="product-details-inner">
                                <div class="product-details-contentt">
                                    <div class="pro-details-name mb-10">
                                        <h3>{{product.translation_lang.name}}</h3>
                                    </div>

                                    <div class="price-box mb-15">
                                        <span class="regular-price"><span class="special-price">{{product.price}}</span></span>

                                    </div>
                                    <div class="product-detail-sort-des pb-4">
                                        <p>{{product.translation_lang.description}}</p>
                                    </div>

                                    <div class="product-availabily-option mt-15 mb-15" v-if="product.attribute_values.length">
                                        <h3>Available Options</h3>
                                        <div v-for="(values, attributeId) in groupedAttributes" :key="attributeId" class="attribute-group mb-3">
                                            <h4>
                                                <sup>*</sup>{{ values[0].attribute.translation_lang.name }}
                                                <span v-if="values.length > 1">(обязательно)</span>
                                            </h4>
                                            <div class="attribute-values">
                                                <div
                                                    v-for="val in values"
                                                    :key="val.id"
                                                    class="attribute-square"
                                                    :class="{ active: selectedAttributes[val.attribute_id] === val.id, 'color-square': val.attribute.slug === 'color' }"
                                                    :style="val.attribute.slug === 'color' ? { backgroundColor: val.code } : {}"
                                                    @click="selectAttribute(val.attribute_id, val.id)"
                                                    :title="val.translation_lang.name"
                                                >
                                                    <template v-if="val.attribute.slug !== 'color'">
                                                    {{ val.translation_lang.name }}
                                                    </template>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="pro-quantity-box mb-30">
                                        <div class="qty-boxx">
                                            <label>qty :</label>
                                            <!-- <input type="text" placeholder="0"> -->
                                            <input type="number" v-model.number="qty" min="1" class="qty-input" />

                                            <button class="btn-cart lg-btn"
                                            :disabled="!allRequiredSelected"
                                            :class="['btn-cart', { 'disabled': !allRequiredSelected }]"
                                            @click.prevent="addToCart">add to cart</button>
                                        </div>
                                    </div>
                                    <div class="useful-links mb-4">
                                        <ul>

                                            <li>
                                                <a href="#" @click.prevent="compare.add(product.id)"><i class="fa fa-refresh"></i>compare this product</a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--  Start related-product -->
            <div v-if="props.releatedProducts.length > 0" class="related-product-area mb-40">
                <div class="container-fluid">
                    <div class="section-title">
                        <h3><span>Related</span> product </h3>
                    </div>
                    <div class="flash-sale-active4 owl-carousel owl-arrow-style">
                        <template v-for="relProduct in props.releatedProducts" :key="relProduct.id" >
                            <Product :product="relProduct" />
                        </template>

                    </div>
                </div>
            </div>
            <!--  end related-product -->
    </GuestLayout>
</template>

<style scoped>
.attribute-values {
  display: flex;
  gap: 8px;
}

.attribute-square {
  display: flex;
  justify-content: center;
  align-items: center;
  min-width: 40px;
  min-height: 40px;
  padding: 4px;
  border: 2px solid #ccc;
  border-radius: 4px;
  cursor: pointer;
  text-align: center;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  transition: all 0.2s;
}

.attribute-square.active {
  border-color: #fedc19;
}

.color-square {
  padding: 0;
  width: 40px;
  height: 40px;
  color: transparent; /* текст не отображаем */
}

.btn-cart.disabled {
  background-color: #ccc;
  cursor: not-allowed;
}
</style>

