<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { onMounted, computed  } from 'vue'
// layout для гостей
import Layout from '@/Layouts/GuestLayout.vue'
import SliderArea from './Home/SliderArea.vue';
import OurProduct from './Home/OurProduct.vue';

import { useTrans, useRoute } from '/resources/js/trans';


defineOptions({
  layout: Layout
})

const props = defineProps({
    //   categories: Array,
    products: Array,
})

onMounted(() => {
    console.log(888888)
  console.log(props.products, 11111)
})

</script>


<template>
    <!-- slider area start -->
    <SliderArea />
    <!-- slider area end -->

    <!-- feature area start -->
    <div class="feature-style-one pt-70 pb-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="feature-inner fix">
                        <div class="col">
                            <div class="feature-item px-5">
                                <div class="feature-icon">
                                    <!-- <img src="../../assets/img/icon/wrapper1.png" alt=""> -->
                                       <i class="fa-solid fa-shield-halved about-icons"></i>
                                </div>
                                <div class="feature-content ">
                                    <h4>{{useTrans('page.about_us.reliability')}}</h4>
                                    <p>{{useTrans('page.about_us.reliability_p')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="feature-item px-5">
                                <div class="feature-icon">
                                    <!-- <img src="../../assets/img/icon/wrapper2.png" alt=""> -->
                                    <i class="fa-regular fa-handshake about-icons"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>{{useTrans('page.about_us.honesty')}}</h4>
                                    <p>{{useTrans('page.about_us.honesty_p')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="feature-item px-5">
                                <div class="feature-icon">
                                    <!-- <img src="../../assets/img/icon/wrapper3.png" alt=""> -->
                                    <i class="fa-regular fa-clock about-icons"></i>
                                </div>
                                <div class="feature-content ">
                                    <h4>{{useTrans('page.about_us.responsibility')}}</h4>
                                    <p>{{useTrans('page.about_us.responsibility_p')}}</p>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <img src="../../assets/img/icon/wrapper4.png" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>90 Days Return</h4>
                                    <p>If goods have problems</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <img src="../../assets/img/icon/wrapper5.png" alt="">
                                </div>
                                <div class="feature-content">we
                                    <h4>Payment Secure</h4>
                                    <p>We ensure secure payment</p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- feature area end -->

    <!-- product wrapper area start -->
    <OurProduct :products="props.products" />
    <!-- product wrapper area start -->

    <!-- featured categories area start -->
    <div class="featured-categories-area">
        <div class="container-fluid">
            <div class="section-title hm-12">
                <h3><span>Featured</span> product</h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="featured-cat-active owl-carousel owl-arrow-style">
                        <div class="pro-layout-two-single-item">
                            <div class="product-layout-two mb-30">
                                <div class="product-layout-info">
                                    <h4 class="pro-name"><a href="shop-grid-left-sidebar.html">Audio & Home Theater</a></h4>
                                    <p class="total-items"> 9 products </p>
                                    <a href="shop-grid-left-sidebar.html" class="shop-btn">+ shop now</a>
                                </div>
                                <div class="product-layout-thumb">
                                    <a href="shop-grid-left-sidebar.html"><img src="../../assets/img/product/pro-layout-img1.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="product-layout-two mb-30">
                                <div class="product-layout-info">
                                    <h4 class="pro-name"><a href="shop-grid-left-sidebar.html">Cellphones & Accessories</a></h4>
                                    <p class="total-items"> 6 products </p>
                                    <a href="shop-grid-left-sidebar.html" class="shop-btn">+ shop now</a>
                                </div>
                                <div class="product-layout-thumb">
                                    <a href="shop-grid-left-sidebar.html"><img src="../../assets/img/product/pro-layout-img2.jpg" alt=""></a>
                                </div>
                            </div>
                        </div> <!-- </ end single item -->
                        <div class="pro-layout-two-single-item">
                            <div class="product-layout-two mb-30">
                                <div class="product-layout-info">
                                    <h4 class="pro-name"><a href="shop-grid-left-sidebar.html">Camera, Photo & Video</a></h4>
                                    <p class="total-items"> 5 products </p>
                                    <a href="shop-grid-left-sidebar.html" class="shop-btn">+ shop now</a>
                                </div>
                                <div class="product-layout-thumb">
                                    <a href="shop-grid-left-sidebar.html"><img src="../../assets/img/product/pro-layout-img3.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="product-layout-two mb-30">
                                <div class="product-layout-info">
                                    <h4 class="pro-name"><a href="shop-grid-left-sidebar.html">Audio & Home Theater</a></h4>
                                    <p class="total-items"> 12 products </p>
                                    <a href="shop-grid-left-sidebar.html" class="shop-btn">+ shop now</a>
                                </div>
                                <div class="product-layout-thumb">
                                    <a href="shop-grid-left-sidebar.html"><img src="../../assets/img/product/pro-layout-img4.jpg" alt=""></a>
                                </div>
                            </div>
                        </div> <!-- </ end single item -->
                        <div class="pro-layout-two-single-item">
                            <div class="product-layout-two mb-30">
                                <div class="product-layout-info">
                                    <h4 class="pro-name"><a href="shop-grid-left-sidebar.html">Smart Watch & Accessories</a></h4>
                                    <p class="total-items"> 10 products </p>
                                    <a href="shop-grid-left-sidebar.html" class="shop-btn">+ shop now</a>
                                </div>
                                <div class="product-layout-thumb">
                                    <a href="shop-grid-left-sidebar.html"><img src="../../assets/img/product/pro-layout-img5.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="product-layout-two mb-30">
                                <div class="product-layout-info">
                                    <h4 class="pro-name"><a href="shop-grid-left-sidebar.html">Laptop & Computere</a></h4>
                                    <p class="total-items"> 18 products </p>
                                    <a href="shop-grid-left-sidebar.html" class="shop-btn">+ shop now</a>
                                </div>
                                <div class="product-layout-thumb">
                                    <a href="shop-grid-left-sidebar.html"><img src="../../assets/img/product/pro-layout-img6.jpg" alt=""></a>
                                </div>
                            </div>
                        </div> <!-- </ end single item -->
                        <div class="pro-layout-two-single-item">
                            <div class="product-layout-two mb-30">
                                <div class="product-layout-info">
                                    <h4 class="pro-name"><a href="shop-grid-left-sidebar.html">Headphones & Accessories</a></h4>
                                    <p class="total-items"> 0 products </p>
                                    <a href="shop-grid-left-sidebar.html" class="shop-btn">+ shop now</a>
                                </div>
                                <div class="product-layout-thumb">
                                    <a href="shop-grid-left-sidebar.html"><img src="../../assets/img/product/pro-layout-img7.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="product-layout-two mb-30">
                                <div class="product-layout-info">
                                    <h4 class="pro-name"><a href="shop-grid-left-sidebar.html">Network Devices</a></h4>
                                    <p class="total-items"> 5 products </p>
                                    <a href="shop-grid-left-sidebar.html" class="shop-btn">+ shop now</a>
                                </div>
                                <div class="product-layout-thumb">
                                    <a href="shop-grid-left-sidebar.html"><img src="../../assets/img/product/pro-layout-img8.jpg" alt=""></a>
                                </div>
                            </div>
                        </div> <!-- </ end single item -->
                        <div class="pro-layout-two-single-item">
                            <div class="product-layout-two mb-30">
                                <div class="product-layout-info">
                                    <h4 class="pro-name"><a href="shop-grid-left-sidebar.html">Video Games Cosoles</a></h4>
                                    <p class="total-items"> 0 products </p>
                                    <a href="shop-grid-left-sidebar.html" class="shop-btn">+ shop now</a>
                                </div>
                                <div class="product-layout-thumb">
                                    <a href="shop-grid-left-sidebar.html"><img src="../../assets/img/product/pro-layout-img9.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="product-layout-two mb-30">
                                <div class="product-layout-info">
                                    <h4 class="pro-name"><a href="shop-grid-left-sidebar.html">Quadcopters & Accessories</a></h4>
                                    <p class="total-items"> 4 products </p>
                                    <a href="shop-grid-left-sidebar.html" class="shop-btn">+ shop now</a>
                                </div>
                                <div class="product-layout-thumb">
                                    <a href="shop-grid-left-sidebar.html"><img src="../../assets/img/product/pro-layout-img10.jpg" alt=""></a>
                                </div>
                            </div>
                        </div> <!-- </ end single item -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- featured categories area end -->

    <!-- home banner statics area -->
    <div class="banner-statics">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="single-banner-statics">
                        <a href="shop-grid-left-sidebar.html"><img src="/assets/img/banner/b-1.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-banner-statics">
                        <a href="shop-grid-left-sidebar.html"><img src="/assets/img/banner/b-2.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- home banner statics end -->

    <!-- home product module four start -->
    <div class="home-module-four">
        <div class="container-fluid">
            <div class="section-title">
                <h3><span>Laptop</span> & computer</h3>
            </div>
            <div class="pro-module-four-active owl-carousel owl-arrow-style">
                <div class="product-module-four-item">
                    <div class="product-module-caption">
                        <div class="manufacture-com">
                            <p><a href="shop-grid-left-sidebar.html">apple</a></p>
                        </div>
                        <div class="product-module-name">
                            <h4><a href="product-details.html">jony XB10 Portable  Wireless Speaker</a></h4>
                        </div>
                        <div class="ratings">
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                        </div>
                        <div class="price-box-module">
                            <span class="regular-price"><span class="special-price">£30.00</span></span>
                            <span class="old-price"><del>£450.00</del></span>
                        </div>
                    </div>
                    <div class="product-module-thumb">
                        <a href="product-details.html">
                            <img src="../../assets/img/product/product-14.jpg" alt="">
                        </a>
                    </div>
                </div> <!-- end single item -->
                <div class="product-module-four-item">
                    <div class="product-module-caption">
                        <div class="manufacture-com">
                            <p><a href="shop-grid-left-sidebar.html">Walton</a></p>
                        </div>
                        <div class="product-module-name">
                            <h4><a href="product-details.html">Koss Porta Pro On Ear  Headphones </a></h4>
                        </div>
                        <div class="ratings">
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                        </div>
                        <div class="price-box-module">
                            <span class="regular-price">£30.31</span>
                        </div>
                    </div>
                    <div class="product-module-thumb">
                        <a href="product-details.html">
                            <img src="../../assets/img/product/product-3.jpg" alt="">
                        </a>
                    </div>
                </div> <!-- end single item -->
                <div class="product-module-four-item">
                    <div class="product-module-caption">
                        <div class="manufacture-com">
                            <p><a href="shop-grid-left-sidebar.html">Jamuna</a></p>
                        </div>
                        <div class="product-module-name">
                            <h4><a href="product-details.html">JBL Flip 3 Portable Bluetooth</a></h4>
                        </div>
                        <div class="ratings">
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                        </div>
                        <div class="price-box-module">
                            <span class="regular-price"><span class="special-price">£40.00</span></span>
                            <span class="old-price"><del>£60.00</del></span>
                        </div>
                    </div>
                    <div class="product-module-thumb">
                        <a href="product-details.html">
                            <img src="../../assets/img/product/product-10.jpg" alt="">
                        </a>
                    </div>
                </div> <!-- end single item -->
                <div class="product-module-four-item">
                    <div class="product-module-caption">
                        <div class="manufacture-com">
                            <p><a href="shop-grid-left-sidebar.html">apple</a></p>
                        </div>
                        <div class="product-module-name">
                            <h4><a href="product-details.html">jony KD55X72 55-Inch  4k Ultra HD</a></h4>
                        </div>
                        <div class="ratings">
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                        </div>
                        <div class="price-box-module">
                            <span class="regular-price">£30.31</span>
                        </div>
                    </div>
                    <div class="product-module-thumb">
                        <a href="product-details.html">
                            <img src="../../assets/img/product/product-11.jpg" alt="">
                        </a>
                    </div>
                </div> <!-- end single item -->
            </div>
        </div>
    </div>
    <!-- home product module four end -->

    <!-- home product module five start -->
    <div class="home-module-five">
        <div class="container-fluid">
            <div class="section-title">
                <h3><span>Headphones</span> & Accessories </h3>
            </div>
            <div class="pro-module-four-active owl-carousel owl-arrow-style">
                <div class="product-module-four-item">
                    <div class="product-module-caption">
                        <div class="manufacture-com">
                            <p><a href="shop-grid-left-sidebar.html">jony</a></p>
                        </div>
                        <div class="product-module-name">
                            <h4><a href="product-details.html">Beats EP Wired Headphone-Black</a></h4>
                        </div>
                        <div class="ratings">
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                        </div>
                        <div class="price-box-module">
                            <span class="regular-price"><span class="special-price">£30.00</span></span>
                            <span class="old-price"><del>£450.00</del></span>
                        </div>
                    </div>
                    <div class="product-module-thumb">
                        <a href="product-details.html">
                            <img src="../../assets/img/product/product-8.jpg" alt="">
                        </a>
                    </div>
                </div> <!-- end single item -->
                <div class="product-module-four-item">
                    <div class="product-module-caption">
                        <div class="manufacture-com">
                            <p><a href="shop-grid-left-sidebar.html">apple</a></p>
                        </div>
                        <div class="product-module-name">
                            <h4><a href="product-details.html">JBL Flip 3 Portable Bluetooth</a></h4>
                        </div>
                        <div class="ratings">
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                        </div>
                        <div class="price-box-module">
                            <span class="regular-price">£30.31</span>
                        </div>
                    </div>
                    <div class="product-module-thumb">
                        <a href="product-details.html">
                            <img src="../../assets/img/product/product-4.jpg" alt="">
                        </a>
                    </div>
                </div> <!-- end single item -->
                <div class="product-module-four-item">
                    <div class="product-module-caption">
                        <div class="manufacture-com">
                            <p><a href="shop-grid-left-sidebar.html">sumsang</a></p>
                        </div>
                        <div class="product-module-name">
                            <h4><a href="product-details.html">Marshall Portable  Bluetooth Speaker</a></h4>
                        </div>
                        <div class="ratings">
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                        </div>
                        <div class="price-box-module">
                            <span class="regular-price"><span class="special-price">£40.00</span></span>
                            <span class="old-price"><del>£60.00</del></span>
                        </div>
                    </div>
                    <div class="product-module-thumb">
                        <a href="product-details.html">
                            <img src="../../assets/img/product/product-6.jpg" alt="">
                        </a>
                    </div>
                </div> <!-- end single item -->
                <div class="product-module-four-item">
                    <div class="product-module-caption">
                        <div class="manufacture-com">
                            <p><a href="shop-grid-left-sidebar.html">walton</a></p>
                        </div>
                        <div class="product-module-name">
                            <h4><a href="product-details.html">jony XB10 Portable  Wireless Speaker</a></h4>
                        </div>
                        <div class="ratings">
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                            <span><i class="lnr lnr-star"></i></span>
                        </div>
                        <div class="price-box-module">
                            <span class="regular-price">£30.31</span>
                        </div>
                    </div>
                    <div class="product-module-thumb">
                        <a href="product-details.html">
                            <img src="../../assets/img/product/product-2.jpg" alt="">
                        </a>
                    </div>
                </div> <!-- end single item -->
            </div>
        </div>
    </div>
    <!-- home product module five end -->


    <!-- brand sale area start -->
    <div class="brand-area pb-70">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3><span>Brand</span> sale</h3>
                    </div>
                </div>
                <div class="col-12">
                    <ul class="nav brand-active owl-carousel">
                        <li>
                            <a class="active" href="#brand-one" data-toggle="tab">
                                <img src="../../assets/img/brand/brand1.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#brand-two" data-toggle="tab">
                                <img src="../../assets/img/brand/brand2.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#brand-three" data-toggle="tab">
                                <img src="../../assets/img/brand/brand3.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#brand-one" data-toggle="tab">
                                <img src="../../assets/img/brand/brand4.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#brand-three" data-toggle="tab">
                                <img src="../../assets/img/brand/brand5.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#brand-two" data-toggle="tab">
                                <img src="../../assets/img/brand/brand6.png" alt="">
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- brand sale area end -->

    <!-- scroll to top -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div> <!-- /End Scroll to Top -->
</template>



<style scoped>
.welcome-page {
  background-color: #f9f9f9;
  min-height: 80vh;
}

.about-icons{
    color: #c92829;
    font-size: 50px;
}
</style>
