<script setup>
import { ref } from 'vue';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { useTrans, useRoute } from "/resources/js/trans";
import { useCompareStore } from '@/Stores/compare';

const props = defineProps({
  //   categories: Array,
  products: Array,
  attributes: Array
});

const compare = useCompareStore();

const localProducts = ref([...props.products]);

const removeProduct = (id) => {

    compare.remove(id);
    localProducts.value = localProducts.value.filter(p => p.id !== id);
};

const getProductImage = (product) => {
    if (!product.images || product.images.length === 0) {
        return "/images/no-image.png"; // 🔹 твоя заглушка
    }

    const main = product.images.find((i) => i.is_main === 1);
    return main ? main.path_url : product.images[0].path_url;
};


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
                                        <h3>{{useTrans('page.title_h3')}}</h3>
                                    </div>
                                    <form action="#">
                                        <div
                                            v-if="localProducts.length"
                                            class="table-responsive text-center"
                                        >
                                            <table class="table table-bordered compare-style">
                                                <thead>
                                                    <tr >
                                                        <td colspan="4">
                                                            <strong>{{useTrans('page.product_details')}}</strong>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="product-title">{{useTrans('page.product')}}</td>
                                                        <td v-for="p in localProducts" :key="p.id">
                                                            <a href="product-details.html"
                                                            ><strong>{{
                                                                p.translation_lang.name
                                                            }}</strong></a
                                                            >
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="product-title">{{useTrans('page.image')}}</td>
                                                        <td v-for="p in localProducts" :key="p.id">
                                                            <div
                                                            class="compare-image m-auto d-flex justify-content-center align-items-center"
                                                            >
                                                            <img
                                                                :src="getProductImage(p)"
                                                                alt=""
                                                                class="img-thumbnail"
                                                            />
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="product-title">{{useTrans('page.price')}}</td>
                                                        <td v-for="p in localProducts" :key="p.id">
                                                            <span>{{ p.price }} ֏</span>
                                                        </td>
                                                    </tr>

                                                    <tr v-for="attr in props.attributes" :key="attr.id">
                                                        <!-- Название атрибута берём из attributes -->
                                                        <td class="product-title">{{ attr.translation_lang?.name }}</td>

                                                        <!-- Значения для каждого продукта -->
                                                        <td v-for="p in localProducts" :key="p.id">
                                                            {{
                                                            (() => {
                                                            // все значения продукта для текущего атрибута
                                                            const matches = (p.attribute_values ?? [])
                                                                .filter(av => av.attribute_id === attr.id);


                                                            const names = matches
                                                                .map(av => av.translation_lang?.name)
                                                                .filter(Boolean);

                                                            return names.length ? names.join(', ') : '-';
                                                            })()
                                                            }}
                                                        </td>
                                                    </tr>



                                                    <tr>
                                                        <td class="product-title">{{useTrans('page.summary')}}</td>
                                                        <td
                                                            v-for="p in localProducts" :key="p.id"
                                                            class="description"
                                                        >
                                                            {{ p.translation_lang.description ?? '-' }}
                                                        </td>
                                                    </tr>


                                                    <tr >
                                                        <td class="product-title">{{useTrans('page.actions')}}</td>
                                                        <td v-for="p in localProducts" :key="p.id">
                                                            <a
                                                            href="cart.html"
                                                            class="btn btn-secondary mb-2 mb-lg-0 mr-xl-2"
                                                            >Add to Cart</a
                                                            >
                                                            <a href="#" class="btn btn-secondary" @click.prevent="removeProduct(p.id)">Remove</a>
                                                        </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div v-else>aprenqner chkaan</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end of comparison -->
                        </main>
                        <!-- end of #primary -->
                    </div>
                </div>
                <!-- end of row -->
            </div>
        <!-- end of container -->
        </div>
    </GuestLayout>
</template>

<style scoped>
.compare-image {
  width: 120px;
  height: 120px;
  border-radius: 6px;
  overflow: hidden;
}

.compare-image img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}
</style>


