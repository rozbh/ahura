<?php
// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

 if ( get_theme_mod( 'theme_dark' ) ) : ?>
<style>
:root
{
  --main_soft_shadow: 0 10px 20px -10px #000;
  --auto_soft_shadow: 0 10px 20px -10px #000;
}
body{
  background:#333;
  color:#fff;
}
body, a, p, li, ul, input, form, span,.sharing,.postbox2post2 h4,.postbox2post1 h3,.owl-carousel .owl-item p{
  color:#fff;
}
#ajax_search_res p
{
  color: #35495C;
}
ul.menu li ul li a
{
  color: #1d1d1d;
}
.topmenu li:hover > a
{
  color: white;
}
.cats-list .menu
{
  background-color: #1d1d1d;
}
.woocommerce div.product
{
  background-color: #1d1d1d;
}
.woocommerce .quantity:not(.hidden)
{
  background-color: #1d1d1d;
  border-color: #333333;
}
.woocommerce button.button
{
  color: #1d1d1d;
}
.woocommerce-cart table.cart td.actions .coupon .input-text
{
  border-color: rgba(0,0,0,0.5);
}
<?php $theme_color = \ahura\app\mw_options::get_mod_theme_color(); ?>
.woocommerce-error, .woocommerce-info, .woocommerce-message
{
  background-color: #1d1d1d;
  color: white;
  border-top-color: <?php echo $theme_color;?>;
}
.woocommerce-message::before
{
  color: <?php echo $theme_color;?>;
}
.woocommerce ul.products
{
  background-color: transparent;
}
.woocommerce ul.products li.product, .woocommerce-page ul.products li.product
{
  background-color: #333333;
  border-color: #1d1d1d;
}
.topbar-main .mini-cart-header-content
{
  background-color: #1d1d1d;
}
.list-post,.topbar,.main-menu ul,.main-menu li ul li a,.postbox2,.postbox2,.postbox4 article,.owl-carousel .owl-item,.postbox6,.post-entry,.sidebar-widget,input, textarea{
  background:#1d1d1d;
}
.main-menu ul,.post-entry{
  border-bottom-color:#111;
}
.topmenu li a,.postbox6post2 h4,.post-meta li,.postbox6post1 h3,.owl-carousel .owl-item h3,.post-title h1 a,.postbox4 article h3,.postbox4 article p{
  color:#fff;
}
.main-menu li a,.owl-carousel .owl-item h3,.post-title h1 a,.sidebar-widget-title,.comments-area h3,.postbox4 article h3{
  border-bottom-color:rgba(0,0,0,0.2);
}
.commentlist .review, .commentlist .comment,input, textarea{
  border-color:rgba(0,0,0,0.5);
}
.search input[type="text"]{
  background:rgba(0,0,0,0.4);
}
.topmenu li ul,.topmenu li.current_page_item a{
  background:rgba(0,0,0,0.9);
}
.topmenu li ul li,.list-posts-widget li{
  border-bottom:1px solid rgba(0,0,0,0.9);
}

.elementor-inner .services_elem span,
.elementor-inner .services_elem_2 span,
.elementor-inner .services_elem_3 a
{
  color: inherit;
}
.elementor-inner .post-carousel-3,
.productcategorybox .owl-carousel,
.elementor-inner .banner-box1
{
  background-color: #222;
}
.owl-carousel .owl-next i,
.owl-carousel .owl-prev i
{
	background: rgba(0,0,0,0.5);
}
.elementor-inner .search_elem
{
  background-color: #1d1d1d;
}
.elementor-inner .banner-box1 .content_section .title,
.elementor-inner .post-carousel-3 .info_box .title,
.header-mode-3 .panel_menu_wrapper .mini-cart-header .mini-cart-header-content .woocommerce-mini-cart__buttons.buttons a:not(.checkout),
.topbar ul.menu li ul li a,
.header-mode-2 .action-box #action_link
{
  color: white;
}
.topbar .cats-list .menu li ul
{
  background-color: #2d2d2d;
}
.header-mode-2 .action-box #action_link:hover
{
  background-color: white;
  color: #1d1d1d;
}
.topbar .cats-list ul.menu>li>a::after
{
  border-color: #333333;
}
.elementor-inner .banner-box1 .content_section .btn_cta:hover
{
  color: #222;
}
.elementor-inner .search_elem input{
  color: white !important;
}
.post-entry .wp-block-quote p
{
  color: #35495C;
}
@media only screen and (min-width: 768px)
{
  .elementor-inner .post-carousel-3 .slide_box .owl-carousel .owl-next
  {
    background-image: linear-gradient(to left,#222 0%,transparent 100%);
  }
  .elementor-inner .post-carousel-3 .slide_box .owl-carousel .owl-prev
  {
      background-image: linear-gradient(to right,#222 0%,transparent 100%);
  }
  .owl-carousel .owl-prev{
    background-image:linear-gradient(to right,#333 0%,transparent 100%);
  }
  .owl-carousel .owl-next{
    background-image:linear-gradient(to left,#333 0%,transparent 100%);
  }
}
.product_title,.page-title{
  color: #fff;
}
.woocommerce-checkout-payment{
  background-color: #4c4c4c !important;
}
#add_payment_method #payment div.payment_box, .woocommerce-cart #payment div.payment_box, .woocommerce-checkout #payment div.payment_box{
  background-color: transparent;
}
.quantity input[type="number"]{
	color: #fff !important;
}
.quantity{
  justify-content: center;
}
.woocommerce .mw_qty_btn{
  display: flex;
  padding: 0 3px;
}
.woocommerce .mini-cart-header .mini-cart-header-content p.woocommerce-mini-cart__buttons a.wc-forward{
  color: #333;
}
.woocommerce .mini-cart-header .mini-cart-header-content .woocommerce-Price-amount bdi,.woocommerce .mini-cart-header .mini-cart-header-content .woocommerce-Price-amount span{
  color: #fff !important;
}
.woocommerce-mini-cart__buttons a.button.checkout:hover{
  background-color: #333 !important;
  color: #fff !important;
  box-shadow: none;
}
.woocommerce .single_add_to_cart_button{
  color: #fff !important;
}
.woocommerce .woocommerce-Tabs-panel h2,.comment-form-rating label[for="rating"],.woocommerce-Tabs-panel--additional_information table,.sidebar .sidebar-widget .product_list_widget li span.product-title{
  color: #fff;
}
.mgsiteside a{
  color:#fff !important;
}
.select2-container--default .select2-results__option[aria-selected=true], .select2-container--default .select2-results__option,.header-popup-login-form label,.header-popup-login-form span,span.required{
  color: #444 !important;
}
td.product-price *,td.product-subtotal *,.sidebar-widget *,.cart_totals *,#goto-top *,.header-mode-4 .topbar-main ul li a,.siteside-close,.woocommerce .price *,#reply-title{
  color: #fff !important;
}
.mgsiteside li ul.sub-menu li a{
  color: #000 !important;
}
</style>
<?php endif;?>