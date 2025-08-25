<script setup>
import sliderImg4 from '../../../assets/img/slider/banner-4.png';
import sliderImg7 from '../../../assets/img/slider/banner-7.png';
import sliderImg8 from '../../../assets/img/slider/banner-8.png';

import { useTrans, useRoute } from '/resources/js/trans';

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
                                <h1>Trusted quality Low prices<br></h1>
                                <p>Fast delivery and affordable prices</p>
                                <a class="btn-1 home-btn" href="#">shop now</a>
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
                                <h1>The best home electrical solutions</h1>
                                <p>Modern design, high quality, affordable price</p>
                                <a class="btn-1 home-btn" href="#">shop now</a>
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
                                <h1>Turn on the quality.</h1>
                                <p>Switches, lamps, plugs, extension cords - all in one place</p>
                                <a class="btn-1 home-btn" href="#">shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>


