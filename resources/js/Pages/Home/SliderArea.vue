<script setup>
import { onMounted, onUpdated, nextTick, watch } from 'vue';
import $ from 'jquery';
import 'slick-carousel';
import sliderImg4 from '../../../assets/img/slider/banner-9.png';
import sliderImg7 from '../../../assets/img/slider/banner-7.png';
import sliderImg8 from '../../../assets/img/slider/banner-8.png';
// import sliderImg9 from '../../../assets/img/slider/banner-9.png';

import { useTrans, useRoute, currentLocale } from '/resources/js/trans';
import { useReinitSlider } from '/resources/js/hooks/useReinitSlider'


useReinitSlider(
  '.hero-slider-active',
  ($el) => {
    $el.slick({
      dots: true,
      arrows: true,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 5000,

      prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
	  nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>',

    })
  },
  currentLocale
)
</script>

<template>
    <div class="slider-area">

         <div class="absolute h-12 w-full flex items-center justify-center">

        </div>
        <div class="hero-slider-active slick-dot-style slider-arrow-style">
            <div class="single-slider d-flex align-items-center"
            :style="{ backgroundImage: `url(${sliderImg4})` }">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 col-sm-8">
                            <div class="slider-text">
                                <h1>{{useTrans('page.slider_area.slider_1.h1')}}<br></h1>
                                <p>{{useTrans('page.slider_area.slider_1.p')}}</p>
                                <a class="btn-1 home-btn" href="#">{{useTrans('app.buttons.shop_now')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-slider d-flex align-items-center"
            :style="{ backgroundImage: `url(${sliderImg7})` }">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 col-sm-8">
                            <div class="slider-text">
                                <h1>{{useTrans('page.slider_area.slider_2.h1')}}</h1>
                                <p>{{useTrans('page.slider_area.slider_2.p')}}</p>
                                <a class="btn-1 home-btn" href="#">{{useTrans('app.buttons.shop_now')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-slider d-flex align-items-center"
            :style="{ backgroundImage: `url(${sliderImg8})` }">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 col-sm-8">
                            <div class="slider-text">
                                <h1>{{useTrans('page.slider_area.slider_3.h1')}}</h1>
                                <p>{{useTrans('page.slider_area.slider_3.p')}}</p>
                                <a class="btn-1 home-btn" href="#">{{useTrans('app.buttons.shop_now')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<style scoped>
.hero-slider-active {
    overflow: hidden; /* скрываем лишний контент */
    position: relative; /* чтобы стрелки позиционировались относительно слайдера */
}

</style>


