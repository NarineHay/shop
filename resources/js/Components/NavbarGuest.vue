
<script setup>
import { onMounted } from 'vue'
import { initMeanMenu } from '@/main.js'

onMounted(async () => {
  const $ = await import('jquery')
  window.$ = window.jQuery = $.default
//   await import('../../assets/js/main.js')



  initMeanMenu()
})
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
                                <li><span>Email: </span>support@sinrato.com</li>
                                <li>Free Shipping for all Order of $99</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="box box-right">
                            <ul>
                                <li class="settings">
                                    <button type="button" class="ha-toggle">My Account<span class="lnr lnr-chevron-down"></span></button>
                                    <ul class="box-dropdown ha-dropdown">
                                        <li><a href="register.html">Register</a></li>
                                        <li><a href="login.html">Login</a></li>
                                    </ul>
                                </li>
                                <li class="settings">
                                    <button type="button" class="ha-toggle">Language<span class="lnr lnr-chevron-down"></span></button>
                                    <ul class="box-dropdown ha-dropdown">
                                        <li><a href="login.html"><img src="../../assets/img/icon/en.png" alt=""> English</a></li>
                                        <li><a href="login.html"><img src="../../assets/img/icon/ge.png" alt=""> Germany</a></li>
                                    </ul>
                                </li>
                                <li class="currency">
                                    <button type="button" class="ha-toggle">Currency<span class="lnr lnr-chevron-down"></span></button>
                                    <ul class="box-dropdown ha-dropdown">
                                        <li><a href="login.html">€ Euro</a></li>
                                        <li><a href="login.html">$ US Doller</a></li>
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
                            <a href="index.html"><img src="../../assets/img/logo/logo-sinrato.png" alt="brand-logo"></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12 order-sm-last">
                        <div class="header-middle-inner">
                            <form action="method">
                                <div class="top-cat hm1">
                                    <div class="search-form">
                                         <select>
                                            <optgroup label="Electronics">
                                                <option value="volvo">Laptop</option>
                                                <option value="saab">watch</option>
                                                <option value="saab">air cooler</option>
                                                <option value="saab">audio</option>
                                                <option value="saab">speakers</option>
                                                <option value="saab">amplifires</option>
                                            </optgroup>
                                            <optgroup label="Fashion">
                                                <option value="mercedes">Womens tops</option>
                                                <option value="audi">Jeans</option>
                                                <option value="audi">Shirt</option>
                                                <option value="audi">Pant</option>
                                                <option value="audi">Watch</option>
                                                <option value="audi">Handbag</option>
                                            </optgroup>
                                        </select>
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
                                        <span>Browse categories</span>
                                    </div>
                                    <div class="right">
                                        <i class="lnr lnr-chevron-down"></i>
                                    </div>
                                </div>
                                <nav class="categorie-menus ha-dropdown">
                                    <ul id="menu2">
                                        <li><a href="shop-grid-left-sidebar.html">Audio & Home Theater <span class="lnr lnr-chevron-right"></span></a>
                                            <ul class="cat-submenu">
                                                <li><a href="shop-grid-left-sidebar.html">Home Audio <span class="lnr lnr-chevron-right"></span></a>
                                                    <ul class="cat-submenu">
                                                        <li><a href="shop-grid-left-sidebar.html">CD Players & Turntables</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Home Theater Systems</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Receivers & Amplifiers</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Speakers</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Wireless  Audio</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="shop-grid-left-sidebar.html">Blu-ray Disc Players</a></li>
                                                <li><a href="shop-grid-left-sidebar.html">Curved TVs<span class="lnr lnr-chevron-right"></span></a>
                                                    <ul class="cat-submenu">
                                                        <li><a href="shop-grid-left-sidebar.html">CD Players & Turntables</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Home Theater Systems</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Receivers & Amplifiers</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Speakers</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Wireless  Audio</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="shop-grid-left-sidebar.html">Streaming Media Players</a></li>
                                                <li><a href="shop-grid-left-sidebar.html">OLED TVs</a></li>
                                                <li><a href="shop-grid-left-sidebar.html">LED & LCD TVs</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="shop-grid-left-sidebar.html">Video & Home Theater<span class="lnr lnr-chevron-right"></span></a>
                                            <ul class="cat-submenu category-mega">
                                                <li class="cat-mega-title"><a href="#">Security Cameras</a>
                                                    <ul>
                                                        <li><a href="shop-grid-left-sidebar.html">DSLR Cameras</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Lense Camera</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Digital Cameras</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Mirrorless Cameras</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Point</a></li>
                                                    </ul>
                                                </li>
                                                <li class="cat-mega-title"><a href="#">Mirrorless Cameras</a>
                                                    <ul>
                                                        <li><a href="shop-grid-left-sidebar.html">DSLR Cameras</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Lense Camera</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Digital Cameras</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Mirrorless Cameras</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Point</a></li>
                                                    </ul>
                                                </li>
                                                <li class="cat-mega-title"><a href="#">Digital Cameras</a>
                                                    <ul>
                                                        <li><a href="shop-grid-left-sidebar.html">DSLR Cameras</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Lense Camera</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Digital Cameras</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Mirrorless Cameras</a></li>
                                                        <li><a href="shop-grid-left-sidebar.html">Point</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="shop-grid-left-sidebar.html">Cellphones & Accessories<span class="lnr lnr-chevron-right"></span></a>
                                            <ul class="cat-submenu">
                                                <li><a href="shop-grid-left-sidebar.html">CD Players & Turntables</a></li>
                                                <li><a href="shop-grid-left-sidebar.html">Home Theater Systems</a></li>
                                                <li><a href="shop-grid-left-sidebar.html">Receivers & Amplifiers</a></li>
                                                <li><a href="shop-grid-left-sidebar.html">Speakers</a></li>
                                                <li><a href="shop-grid-left-sidebar.html">Wireless  Audio</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="shop-grid-left-sidebar.html">Top Item</a></li>
                                        <li><a href="shop-grid-left-sidebar.html">Video Games Consoles</a></li>
                                        <li><a href="shop-grid-left-sidebar.html">Business & Office</a></li>
                                        <li><a href="shop-grid-left-sidebar.html">Headphones & Accessories</a></li>
                                        <li><a href="shop-grid-left-sidebar.html">Quadcopters & Accessories</a></li>
                                        <li><a href="shop-grid-left-sidebar.html">Network Devices</a></li>
                                        <li class="category-item-parent hidden"><a href="shop-grid-left-sidebar.html">Smart Watches</a></li>
                                        <li class="category-item-parent"><a class="more-btn" href="#">More Categories</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="main-menu">
                                <nav id="mobile-menu">
                                    <ul>
                                        <li><a href="#">HOME<span class="lnr lnr-chevron-down"></span></a>
                                            <ul class="dropdown">
                                                <li><a href="index.html">Home Version 1</a></li>
                                                <li><a href="index-2.html">Home Version 2</a></li>
                                                <li><a href="index-3.html">Home Version 3</a></li>
                                                <li><a href="index-4.html">Home Version 4</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">SHOP<span class="lnr lnr-chevron-down"></span></a>
                                            <ul class="dropdown">
                                                <li><a href="#">Shop Grid Layout <span class="lnr lnr-chevron-right"></span></a>
                                                    <ul class="dropdown">
                                                        <li><a href="shop-grid-left-sidebar.html">Shop grid left sidebar</a></li>
                                                        <li><a href="shop-grid-right-sidebar.html">Shop grid right sightbar</a></li>
                                                        <li><a href="shop-grid-left-sidebar-4-column.html">shop grid left sidebar 4 col</a></li>
                                                        <li><a href="shop-grid-right-sidebar-4-column.html">shop grid right sidebar 4 col</a></li>
                                                        <li><a href="shop-grid-full-width-3-column.html">shop grid full width 3 col</a></li>
                                                        <li><a href="shop-grid-full-width-4-column.html">shop grid full width 4 col</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">Shop List Layout <span class="lnr lnr-chevron-right"></span></a>
                                                    <ul class="dropdown">
                                                        <li><a href="shop-list-left-sidebar.html">Shop list left sidebar</a></li>
                                                        <li><a href="shop-list-right-sidebar.html">Shop list right sidebar</a></li>
                                                        <li><a href="shop-list-full-width.html">Shop list full width</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">Product Details <span class="lnr lnr-chevron-right"></span></a>
                                                    <ul class="dropdown">
                                                        <li><a href="product-details.html">Product Details</a></li>
                                                        <li><a href="product-details-variable.html">Product Details Variable</a></li>
                                                        <li><a href="product-details-external.html">Product Details External</a></li>
                                                        <li><a href="product-details-group.html">Product Details Group</a></li>
                                                        <li><a href="tab-style-one.html">tab style one</a></li>
                                                        <li><a href="product-details-gallery-left.html">product details gallery left</a></li>
                                                        <li><a href="product-details-gallery-right.html">product details gallery right</a></li>
                                                        <li><a href="sticky-left-sidebar.html">sticky left sidebar</a></li>
                                                        <li><a href="sticky-right-sidebar.html">sticky right sidebar</a></li>
                                                        <li><a href="product-details-slider-box.html">product details slider box</a></li>
                                                        <li><a href="product-details-slider-box.html">product details slider box</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="static"><a href="#">Pages<span class="lnr lnr-chevron-down"></span></a>
                                            <ul class="mega-menu mega-full">
                                                <li class="mega-title"><a href="#">Column one</a>
                                                    <ul>
                                                        <li><a href="shop-grid-left-sidebar.html">Shop grid left sidebar</a></li>
                                                        <li><a href="shop-grid-right-sidebar.html">Shop grid right sightbar</a></li>
                                                        <li><a href="shop-grid-full-width-4-column.html">Shop grid full width</a></li>
                                                        <li><a href="shop-list-full-width.html">Shop list full width</a></li>
                                                    </ul>
                                                </li>
                                                <li class="mega-title"><a href="#">Column two</a>
                                                    <ul>
                                                        <li><a href="checkout.html">Check Out</a></li>
                                                        <li><a href="cart.html">Cart</a></li>
                                                        <li><a href="wishlist.html">Wishlist</a></li>
                                                        <li><a href="compare.html">Compare</a></li>
                                                    </ul>
                                                </li>
                                                <li class="mega-title"><a href="#">Column Three</a>
                                                    <ul>
                                                        <li><a href="product-details.html">Product Details</a></li>
                                                        <li><a href="product-details-variable.html">Product Details Variable</a></li>
                                                        <li><a href="product-details-external.html">Product Details External</a></li>
                                                        <li><a href="product-details-group.html">Product Details Group</a></li>
                                                    </ul>
                                                </li>
                                                <li class="mega-title"><a href="#">Column Four</a>
                                                    <ul>
                                                        <li><a href="login.html">login</a></li>
                                                        <li><a href="register.html">register</a></li>
                                                        <li><a href="my-account.html">my account</a></li>
                                                        <li><a href="contact-us.html">contact us</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="#">BLOG<span class="lnr lnr-chevron-down"></span></a>
                                            <ul class="dropdown">
                                                <li><a href="blog-left-sidebar-3.html">Blog Left Sidebar 3 col</a></li>
                                                <li><a href="blog-left-sidebar-4.html">Blog left Sidebar 4 col</a></li>
                                                <li><a href="blog-right-sidebar-3.html">Blog Right Sidebar 3 col</a></li>
                                                <li><a href="blog-right-sidebar-4.html">Blog Right Sidebar 4 col</a></li>
                                                <li><a href="blog-full-3-column.html">Blog full width 3 col</a></li>
                                                <li><a href="blog-full-4-column.html">Blog full width 4 col</a></li>
                                                <li><a href="blog-full-5-column.html">Blog full width 5 col</a></li>
                                                <li><a href="blog-details.html">Blog Details</a></li>
                                                <li><a href="blog-details-audio.html">Blog Details audio</a></li>
                                                <li><a href="blog-details-gallery.html">Blog Details gallery</a></li>
                                                <li><a href="blog-details-video.html">Blog Details video</a></li>
                                                <li><a href="blog-details-right-sidebar.html">Blog Details right sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact-us.html">CONTACT US</a></li>
                                    </ul>
                                </nav>
                            </div> <!-- </div> end main menu -->
                            <div class="header-call-action">
                                <p><span class="lnr lnr-phone"></span>Hotline : <strong>1-001-234-5678</strong></p>
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

</template>


