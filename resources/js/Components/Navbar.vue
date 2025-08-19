
<script setup>
import { onMounted, computed } from 'vue'
import { initMeanMenu } from '@/main.js'
import CategoryItem from '@/Components/CategoryItem.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { useTrans, useRoute } from '/resources/js/trans';

const page = usePage();
const categories = page.props.categories;
const user = page.props.auth.user;

const breadcrumbs = computed(() => page.props.breadcrumbs || [])
const showBreadcrumbs = computed(() => {
    return breadcrumbs.value.length && route().current() !== 'welcome'
})

onMounted(async () => {
  const $ = await import('jquery')
  window.$ = window.jQuery = $.default

  initMeanMenu()
})

// Текущий путь без локали
const fullPath = page.url // например: /en/dashboard
const parts = fullPath.split('/').slice(2)

const currentPath = parts.length ? '/' + parts.join('/') : ''

function localizedUrl(lang) {

    return currentPath ? `/${lang}${currentPath}` : `/${lang}`
}



</script>


<template>
   <!-- header area start -->
    <header class="header-pos">
        <div class="header-top black-bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="header-top-left">
                            <ul>
                                <li><span>Email: </span>kasamansolutions@gmail.com</li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="box box-right">
                            <ul>
                                <li class="settings">
                                    <button type="button" class="ha-toggle">{{ useTrans('navbar.my_profile') }}<span class="lnr lnr-chevron-down"></span></button>
                                    <ul v-if="user" class="box-dropdown ha-dropdown">
                                        <li>
                                            <Link :href="useRoute('dashboard')">{{ useTrans('navbar.my_profile') }}</Link>
                                        </li>
                                        <li>
                                            <Link
                                                :href="useRoute('logout')"
                                                method="post"
                                                class="text-body"
                                                >{{ useTrans('navbar.logout') }}
                                            </Link>
                                        </li>
                                    </ul>
                                    <ul v-else class="box-dropdown ha-dropdown">
                                        <li>
                                            <Link
                                                :href="useRoute('register')"
                                                class="text-center"
                                                >{{ useTrans('form.register') }}
                                            </Link>
                                        </li>
                                        <li>
                                            <Link
                                                :href="useRoute('login')"
                                                class="text-center"
                                                >{{ useTrans('form.sign_in') }}</Link
                                            >
                                        </li>
                                    </ul>
                                </li>
                                <li class="settings">
                                    <button type="button" class="ha-toggle"> {{ $page.props.locale.toUpperCase()}}<span class="lnr lnr-chevron-down"></span></button>
                                    <ul class="box-dropdown ha-dropdown">
                                        <li>
                                            <Link :href="localizedUrl('hy')">
                                                Armenian
                                            </Link>
                                        </li>
                                        <li>
                                            <Link :href="localizedUrl('en')">
                                                English
                                            </Link>
                                        </li>
                                        <li>
                                            <Link :href="localizedUrl('ru')">
                                                Russian
                                            </Link>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-4 col-sm-4 col-12">
                        <div class="logo">
                            <a href="index.html"><img src="/assets/img/logo/logo-3.png" alt="brand-logo"></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12 order-sm-last">
                        <div class="header-middle-inner">
                            <form action="method">
                                <div class="top-cat hm1">
                                    <div class="search-form">
                                    </div>
                                </div>
                                <input type="text" class="top-cat-field" placeholder="Search entire store here">
                                <input type="button" class="top-search-btn" value="Search">
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8 col-12 col-sm-8 order-lg-last">
                        <div class="mini-cart-option">
                            <ul>
                                <li class="compare">
                                    <a class="ha-toggle" href="compare.html"><span class="lnr lnr-sync"></span>Product compare</a>
                                </li>
                                <li class="wishlist">
                                    <a class="ha-toggle" href="wishlist.html"><span class="lnr lnr-heart"></span><span class="count">1</span>wishlist</a>
                                </li>
                                <li class="my-cart">
                                    <button type="button" class="ha-toggle"><span class="lnr lnr-cart"></span><span class="count">2</span>my cart</button>
                                    <ul class="mini-cart-drop-down ha-dropdown">
                                        <li class="mb-30">
                                            <div class="cart-img">
                                                <a href="product-details.html"><img alt="" src="../../assets/img/cart/cart-1.jpg"></a>
                                            </div>
                                            <div class="cart-info">
                                                <h4><a href="product-details.html">Koss Porta Pro On Ear  Headphones </a></h4>
                                                <span> <span>1 x </span>£165.00</span>
                                            </div>
                                            <div class="del-icon">
                                                <i class="fa fa-times-circle"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="subtotal-text">Sub-total: </div>
                                            <div class="subtotal-price">£48.94</div>
                                        </li>
                                        <li>
                                            <div class="subtotal-text">Eco Tax (-2.00): </div>
                                            <div class="subtotal-price">£1.51</div>
                                        </li>
                                        <li>
                                            <div class="subtotal-text">Vat (20%): </div>
                                            <div class="subtotal-price">£9.79</div>
                                        </li>
                                        <li>
                                            <div class="subtotal-text">Total: </div>
                                            <div class="subtotal-price"><span>£60.24</span></div>
                                        </li>
                                        <li class="mt-30">
                                            <a class="cart-button" href="cart.html">view cart</a>
                                        </li>
                                        <li>
                                            <a class="cart-button" href="checkout.html">checkout</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-top-menu theme-bg sticker">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-main-menu">
                            <div class="categories-menu-bar">
                                <div class="categories-menu-btn ha-toggle">
                                    <div class="left">
                                        <i class="lnr lnr-text-align-left"></i>
                                        <span>{{useTrans('navbar.categories')}}</span>
                                    </div>
                                    <div class="right">
                                        <i class="lnr lnr-chevron-down"></i>
                                    </div>
                                </div>
                                <nav class="categorie-menus ha-dropdown">
                                    <ul id="menu2">
                                        <CategoryItem
                                            v-for="category in categories"
                                            :key="category.id"
                                            :category="category"
                                        />
                                        <!-- <li v-for="category in categories" :key="category.id" >
                                            <a href="shop-grid-left-sidebar.html">{{category.translation.name}}<span class="lnr lnr-chevron-right"></span></a>
                                            <ul v-if="category.children" class="cat-submenu">
                                                <li v-for="subCategory in category.children" :key="subCategory.id">
                                                    <a href="shop-grid-left-sidebar.html">{{subCategory.translation.name}}<span class="lnr lnr-chevron-right"></span></a>
                                                    <ul  v-if="subCategory.children" class="cat-submenu">
                                                        <li v-for="subSubCategory in subCategory.children" :key="subSubCategory.id">
                                                            <a href="shop-grid-left-sidebar.html">{{subSubCategory.translation.name}}</a></li>

                                                    </ul>
                                                </li>
                                                <li><a href="shop-grid-left-sidebar.html">Blu-ray Disc Players 4444</a></li>

                                            </ul>
                                        </li> -->
                                        <!-- <li class="category-item-parent hidden"><a href="shop-grid-left-sidebar.html">Smart Watches</a></li> -->
                                        <li class="category-item-parent"><a class="more-btn" href="#">More Categories</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="main-menu">
                                <nav id="mobile-menu">
                                    <ul>
                                        <!-- <li><a href="#">HOME<span class="lnr lnr-chevron-down"></span></a>
                                            <ul class="dropdown">
                                                <li><a href="index.html">Home Version 1</a></li>
                                                <li><a href="index-2.html">Home Version 2</a></li>
                                                <li><a href="index-3.html">Home Version 3</a></li>
                                                <li><a href="index-4.html">Home Version 4</a></li>
                                            </ul>
                                        </li> -->
                                        <li><a href="contact-us.html">{{useTrans('navbar.our_services')}}</a></li>
                                        <li><a href="contact-us.html">{{useTrans('navbar.portfolio')}}</a></li>
                                        <li>
                                            <Link :href="useRoute('about_us')">{{useTrans('navbar.about_us')}}</Link>
                                        </li>
                                        <li><a href="contact-us.html">{{useTrans('navbar.contact_us')}}</a></li>


                                    </ul>
                                </nav>
                            </div> <!-- </div> end main menu -->
                            <div class="header-call-action">
                                <p><span class="lnr lnr-phone"></span>Hotline : <strong>+37455522511</strong></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-block d-lg-none">
                        <div class="mobile-menu"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header area end -->
    <div class="breadcrumb-area"  v-if="showBreadcrumbs">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li v-for="(crumb, index) in breadcrumbs" :key="index" class="breadcrumb-item" :class="{ active: index === breadcrumbs.length - 1 }">
                                    <template v-if="crumb.href && index !== breadcrumbs.length - 1">
                                        <a :href="crumb.href">{{ useTrans(crumb.label) }}</a>
                                    </template>
                                    <template v-else>
                                        {{ useTrans(crumb.label) }}
                                    </template>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


