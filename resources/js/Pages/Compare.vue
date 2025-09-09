<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useTrans, useRoute } from '/resources/js/trans';


const props = defineProps({
    //   categories: Array,
    products: Array,
})

const getProductImage = (product) => {
  if (!product.images || product.images.length === 0) {
    return '/images/no-image.png' // 🔹 твоя заглушка
  }

  const main = product.images.find(i => i.is_main === 1)
  return main ? main.path_url : product.images[0].path_url
}

console.log(props.products,'++++++++')

</script>

<template>
    <GuestLayout>
        <Head :title="useTrans('page.title')" />
        <div class="comparison-wrapper pb-50">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <main id="primary" class="site-main">
                            <div class="comparison">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="section-title">
                                            <h3>Product Comparison</h3>
                                        </div>
                                        <form action="#">
                                            <div v-if="props.products.length" class="table-responsive  text-center">
                                                <table class="table table-bordered compare-style">
                                                    <thead>
                                                        <tr>
                                                            <td colspan="4"><strong>Product Details</strong></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="product-title">Product</td>
                                                            <td v-for="p in props.products" :key="p.id">
                                                                <a href="product-details.html"><strong>{{p.translation_lang.name}}</strong></a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="product-title">Image</td>
                                                            <td v-for="p in props.products" :key="p.id">
                                                                <div class="compare-image d-flex justify-content-center align-items-center">
                                                                    <img :src="getProductImage(p)" alt="" class="img-thumbnail">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="product-title">Price</td>
                                                            <td v-for="p in props.products" :key="p.id">
                                                                <span>{{ p.price }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="product-title">Model</td>
                                                            <td>2</td>
                                                            <td>3</td>
                                                            <td>4</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="product-title">Brands</td>
                                                            <td><a class="text-color" href="#">Studio Design</a></td>
                                                            <td><a class="text-color" href="#">Graphic Corner</a></td>
                                                            <td><a class="text-color" href="#">Graphic Corner</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="product-title">Summary</td>
                                                            <td v-for="p in props.products" :key="p.id" class="description">{{ p.translation_lang.description }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="product-title">Weight</td>
                                                            <td>0.90kg</td>
                                                            <td>1.00kg</td>
                                                            <td>146.40g</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="product-title">Dimensions (L x W x H)</td>
                                                            <td>0.00cm x 0.00cm x 0.00cm</td>
                                                            <td>0.00cm x 0.00cm x 0.00cm</td>
                                                            <td>0.00cm x 0.00cm x 0.00cm</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="product-title">Actions</td>
                                                            <td>
                                                                <a href="cart.html" class="btn btn-secondary mb-2 mb-lg-0 mr-xl-2">Add to Cart</a>
                                                                <a href="#" class="btn btn-secondary">Remove</a>
                                                            </td>
                                                            <td>
                                                                <a href="cart.html" class="btn btn-secondary mb-2 mb-lg-0 mr-xl-2">Add to Cart</a>
                                                                <a href="#" class="btn btn-secondary">Remove</a>
                                                            </td>
                                                            <td>
                                                                <a href="cart.html" class="btn btn-secondary mb-2 mb-lg-0 mr-xl-2">Add to Cart</a>
                                                                <a href="#" class="btn btn-secondary">Remove</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- end of comparison -->
                        </main> <!-- end of #primary -->
                    </div>
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div>
    </GuestLayout>
</template>

<style scoped>
    .compare-image {
        width: 120px;
        height: 120px;
        border: 1px solid #ddd;
        border-radius: 6px;
        background: #f9f9f9;
        overflow: hidden;
    }

    .compare-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
</style>


