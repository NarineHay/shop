export function initProductLargeSlider() {
    const $slider = $('.product-large-slider');
    const $nav = $('.pro-nav');

    if ($slider.length) {
        if ($slider.hasClass('slick-initialized')) {
            $slider.slick('unslick');
        }
        $slider.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            arrows: false,
            asNavFor: '.pro-nav'
        });
    }

    if ($nav.length) {
        if ($nav.hasClass('slick-initialized')) {
            $nav.slick('unslick');
        }
        $nav.slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            prevArrow: '<button type="button" class="arrow-prev"><i class="fa fa-long-arrow-left"></i></button>',
            nextArrow: '<button type="button" class="arrow-next"><i class="fa fa-long-arrow-right"></i></button>',
            asNavFor: '.product-large-slider',
            centerMode: true,
            arrows: true,
            centerPadding: 0,
            focusOnSelect: true
        });
    }

    // modal fix
    // $('.modal').on('shown.bs.modal', function () {
    //     $('.pro-nav').resize();
    // });

    $('.modal').on('shown.bs.modal', function () {
    const $slider = $('.pro-nav');
    if ($slider.hasClass('slick-initialized')) {
        $slider.slick('setPosition');
    }
});
}
