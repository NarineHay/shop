<script setup>
import { ref, onMounted, watch } from 'vue';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { useTrans, useRoute } from "/resources/js/trans";
import { useCartStore } from '@/Stores/cart';

const props = defineProps({
  //   categories: Array,
  products: Array,
  attributes: Array
});

const cart = useCartStore()

onMounted(() => {
    if (cart.userId) {
        cart.loadFromServer()  // авторизованные
    } else {
        cart.fetchProducts()   // неавторизованные, подтягиваем цены
    }

      console.log('👉 cart.list:', cart.list)
  console.log('👉 cart.products:', cart.products)
  console.log('👉 cart.all:', cart.all)
  console.log('👉 cart.totalPrice:', cart.totalPrice)
  console.log('👉 cart.count:', cart.count)
})


watch(
  () => cart.products,
  (newVal) => {
    console.log('✅ cart.products обновились:', newVal)
  },
  { deep: true }
)


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
                                        <h3>Shopping Cart</h3>
                                    </div>
                                    <form action="#">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
  <thead>
    <tr>
      <td>Image</td>
      <td>Product Name</td>
      <td>Model</td>
      <td>Quantity</td>
      <td>Unit Price</td>
      <td>Total</td>
    </tr>
  </thead>
  <tbody>
    <tr v-for="product in cart.products" :key="product.id">
      <td>
        <a :href="`/product/${product.slug}`">
          <img :src="product.image" alt="Cart Product Image" class="img-thumbnail">
        </a>
      </td>
      <td>
        <a :href="`/product/${product.slug}`">{{ product.name }}</a>
        <span v-if="product.options?.delivery_date">Delivery Date: {{ product.options.delivery_date }}</span>
        <span v-if="product.options?.color">Color: {{ product.options.color }}</span>
        <span v-if="product.options?.reward_points">Reward Points: {{ product.options.reward_points }}</span>
      </td>
      <td>{{ product.model }}</td>
      <td>
        <div class="input-group btn-block">
          <div class="product-qty me-3">
            <input type="text" v-model="product.quantity">
            <span class="dec qtybtn" @click="cart.decrease(product)"> <i class="fa fa-minus"></i> </span>
            <span class="inc qtybtn" @click="cart.increase(product)"> <i class="fa fa-plus"></i> </span>
          </div>
          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary" @click="cart.update(product)"><i class="fa fa-refresh"></i></button>
            <button type="button" class="btn btn-danger pull-right" @click="cart.remove(product)"><i class="fa fa-times-circle"></i></button>
          </span>
        </div>
      </td>
      <td>{{ product.price }} ֏</td>
      <td>{{ product.total }} ֏</td>
    </tr>
  </tbody>
</table>

                                            <!-- <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td>Image</td>
                                                        <td>Product Name</td>
                                                        <td>Model</td>
                                                        <td>Quantity</td>
                                                        <td>Unit Price</td>
                                                        <td>Total</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <a href="product-details.html"><img src="/assets/img/product/pro-layout-img5.jpg" alt="Cart Product Image" title="Compete Track Tote" class="img-thumbnail"></a>
                                                        </td>
                                                        <td>
                                                            <a href="product-details.html">Compete Track Tote</a>
                                                            <span>Delivery Date: 2019-09-22</span>
                                                            <span>Color: Brown</span>
                                                            <span>Reward Points: 300</span>
                                                        </td>
                                                        <td>3</td>
                                                        <td>
                                                            <div class="input-group btn-block">
                                                                <div class="product-qty me-3">
                                                                    <input type="text" value="0">
                                                                <span class="dec qtybtn"><i class="fa fa-minus"></i></span><span class="inc qtybtn"><i class="fa fa-plus"></i></span></div>
                                                                <span class="input-group-btn">
                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i></button>
                                                                    <button type="button" class="btn btn-danger pull-right"><i class="fa fa-times-circle"></i></button>
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>$200.00</td>
                                                        <td>$200.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="product-details.html"><img src="/assets/img/product/pro-layout-img4.jpg" alt="Cart Product Image" title="Rival Field Messenger 6" class="img-thumbnail"></a>
                                                        </td>
                                                        <td>
                                                            <a href="product-details.html">Rival Field Messenger 6</a>
                                                            <span>Color: Dark Blue</span>
                                                        </td>
                                                        <td>10</td>
                                                        <td>
                                                            <div class="input-group btn-block">
                                                                <div class="product-qty me-3">
                                                                    <input type="text" value="0">
                                                                <span class="dec qtybtn"><i class="fa fa-minus"></i></span><span class="inc qtybtn"><i class="fa fa-plus"></i></span></div>
                                                                <span class="input-group-btn">
                                                                    <button type="submit" data-toggle="tooltip" data-direction="top" class="btn btn-primary" data-original-title="Update"><i class="fa fa-refresh"></i></button>
                                                                    <button type="button" data-toggle="tooltip" data-direction="top" class="btn btn-danger pull-right" data-original-title="Remove"><i class="fa fa-times-circle"></i></button>
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>$480.00</td>
                                                        <td>$480.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="product-details.html"><img src="/assets/img/product/pro-layout-img3.jpg" alt="Cart Product Image" title="Fusion Backpack" class="img-thumbnail"></a>
                                                        </td>
                                                        <td>
                                                            <a href="product-details.html">Fusion Backpack</a>
                                                            <span>Select: White</span>
                                                            <span>Color: Brown</span>
                                                            <span>Reward Points: 200</span>
                                                        </td>
                                                        <td>2</td>
                                                        <td>
                                                            <div class="input-group btn-block">
                                                                <div class="product-qty me-3">
                                                                    <input type="text" value="0">
                                                                <span class="dec qtybtn"><i class="fa fa-minus"></i></span><span class="inc qtybtn"><i class="fa fa-plus"></i></span></div>
                                                                <span class="input-group-btn">
                                                                    <button type="submit" data-toggle="tooltip" data-direction="top" class="btn btn-primary" data-original-title="Update"><i class="fa fa-refresh"></i></button>
                                                                    <button type="button" data-toggle="tooltip" data-direction="top" class="btn btn-danger pull-right" data-original-title="Remove"><i class="fa fa-times-circle"></i></button>
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>$180.00</td>
                                                        <td>$180.00</td>
                                                    </tr>
                                                </tbody>
                                            </table> -->
                                        </div>
                                    </form>


                                    <div class="cart-amount-wrapper">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-4 offset-md-8">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>Sub-Total:</strong></td>
                                                            <td>$860.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Total:</strong></td>
                                                            <td><span class="color-primary">$860.00</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="cart-button-wrapper d-flex justify-content-between mt-4">
                                        <a href="shop-grid-left-sidebar.html" class="btn btn-secondary">Continue Shopping</a>
                                        <a href="checkout.html" class="btn btn-secondary dark align-self-end">Checkout</a>
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



