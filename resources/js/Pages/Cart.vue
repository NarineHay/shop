<script setup>
import { ref, onMounted, watch } from 'vue';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { useTrans, useRoute } from "/resources/js/trans";
import { useCartStore } from '@/Stores/cart';


const props = defineProps({
  attributes: Array
});

const cart = useCartStore()
const page = usePage();
const user = page.props.auth.user;

console.log(cart, 444)
onMounted(() => {

    if (user) {
        cart.loadFromServer()  // авторизованные
    } else {
        cart.fetchProducts()   // неавторизованные, подтягиваем цены
    }

    console.log('👉 attributes:', JSON.stringify(props.attributes, null, 2))
})


function getAttributeName(attrId) {
    const attr = props.attributes.find(a => a.id === Number(attrId))
    return attr?.translation_lang?.name || '—'
}

function getAttributeValueName(attrId, valueId) {
    const attr = props.attributes.find(a => a.id === Number(attrId))
    const value = attr?.values?.find(v => v.id === Number(valueId))
    return value?.translation_lang?.name || '—'
}
</script>

<template>
    <GuestLayout>
        <Head :title="useTrans('page.title')" />
            <div class="shopping-cart-wrapper pb-70">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <main id="primary" class="site-main">
                        <div class="shopping-cart">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="section-title">
                                        <h3>{{useTrans('page.shopping_cart')}}</h3>
                                    </div>

                                    <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td>{{useTrans('page.image')}}</td>
                                                        <td>{{useTrans('page.product_name')}}</td>
                                                        <td>{{useTrans('page.params')}}</td>
                                                        <td>{{useTrans('page.quantity')}}</td>
                                                        <td>{{useTrans('page.unit_price')}}</td>
                                                        <td>{{useTrans('page.total')}}</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="item in cart.list" :key="item.id">
                                                        <td>
{{$page.props.locale}}
                                                             <Link :href="cart.getProductLink(item.id, $page.props.locale)">
                                                                <img :src="cart.getProductImage(item.id)" class="img-thumbnail" width="80" />
                                                            </Link>
                                                        </td>
                                                        <td>{{ cart.getProductName(item.id) }}</td>
                                                        <td>
                                                            <div v-if="item.params && Object.keys(item.params).length">
                                                                <div v-for="(valueId, attrId) in item.params" :key="attrId">
                                                                    {{ getAttributeName(attrId) }}:
                                                                    {{ getAttributeValueName(attrId, valueId) }}
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td  >
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <!-- Кнопка "-" -->
                                                                <button
                                                                @click="cart.decreaseQty(item.id, item.params)"
                                                                class="btn btn-warning rounded-start "
                                                                style="width:36px; height:36px; padding:0;"
                                                                >-</button>

                                                                <!-- Цифра -->
                                                                <span class="d-flex justify-content-center align-items-center border-top border-bottom"
                                                                    style="width:40px; height:36px;">
                                                                {{ item.qty }}
                                                                </span>

                                                                <!-- Кнопка "+" -->
                                                                <button
                                                                @click="cart.increaseQty(item.id, item.params)"
                                                                class="btn btn-warning rounded-end"
                                                                style="width:36px; height:36px; padding:0;"
                                                                >+</button>

                                                                <!-- Удаление -->
                                                                <button
                                                                @click="cart.remove(item.id, item.params)"
                                                                class="btn btn-danger ms-2"
                                                                style="width:36px; height:36px; padding:0 6px;"
                                                                >
                                                                <i class="fa fa-times-circle"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                        <td>{{ cart.getProduct(item.id)?.price }} ֏</td>
                                                        <td>{{ (cart.getProduct(item.id)?.price || 0) * item.qty }} ֏</td>
                                                    </tr>
                                                </tbody>
                                        </table>
                                    </div>

                                    <div class="cart-amount-wrapper">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-4 offset-md-8">
                                                <table class="table table-bordered">
                                                    <tbody>

                                                        <tr>
                                                            <td><strong>{{useTrans('page.total')}}:</strong></td>
                                                            <td><span class="color-primary">{{ cart.totalPrice }} ֏</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="cart-button-wrapper d-flex justify-content-between mt-4">
                                        <a href="shop-grid-left-sidebar.html" class="btn btn-secondary">{{useTrans('app.buttons.continue_shopping')}}</a>
                                        <a :href="useRoute('checkout')" class="btn btn-secondary dark align-self-end">{{useTrans('app.buttons.checkout')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end of shopping-cart -->
                    </main> <!-- end of #primary -->
                </div>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
            </div>
    </GuestLayout>
</template>

<style scoped>
.qty-btn {
  transition: background-color 0.2s, color 0.2s;
}

.qty-btn:hover {
  background-color: #ffc107; /* чуть ярче */
  color: #fff;
}

.btn:focus,
.btn:active {
  outline: none !important;
  box-shadow: none !important;
}
</style>

