<script setup>
import { onMounted, onUpdated, nextTick, watch, ref } from 'vue';
import Product from '@/Components/Product.vue';
import { useTrans, useRoute, currentLocale } from '../../../../resources/js/trans';

const props = defineProps({
    products: Array
});

const products = ref(props.products)

watch(() => props.products, async (newVal) => {
  products.value = newVal
  await nextTick()
  initCarousel()
})

onMounted(() => {
  initCarousel()
})

function initCarousel() {
  // пример инициализации Owl Carousel
    $('.product-gallary-active').owlCarousel({
        items: 4,
        margin: 30,
        nav: true,
        dots: false,
        loop: true,
        responsive:{
				0:{
					items:1,
					nav:false
		        },
		        480:{
					items:2,
					nav:false
		        },
		        768:{
		            items:3
		        },
		        992:{
		            items:4
		        },
		       	1024:{
		            items:4
				},
				1600:{
		            items:7
		        }

		}
    })
}

</script>

<template>
    <div class="product-wrapper fix pb-70">
        <div class="container-fluid">
            <div class="section-title product-spacing hm-11">
                <h3><span>our</span> product</h3>
                <div class="boxx-tab">

                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="one" role="tabpanel" aria-labelledby="one-tab">
                    <div class="product-gallary-wrapper">
                        <div class="product-gallary-active owl-carousel owl-arrow-style product-spacing">
                            <template v-for="product in products" :key="product.id" >
                                <Product :product="product" />
                            </template>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>




