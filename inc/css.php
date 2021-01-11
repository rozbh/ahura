<style>
<?php

// Block direct access to the main plugin file.

use ahura\app\mw_options;
use ahura\app\woocommerce;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if( $theme_color = \ahura\app\mw_options::get_mod_theme_color() ):
  $secondary_color = \ahura\app\mw_options::get_mod_secondary_color();
  ?>
  .woocommerce span.onsale,.woocommerce-widget-layered-nav-list li span,
  .category-alt,.header-mode-1 .cats-list-title,
  .topbar .cats-list ul.menu>li>a::before,
  .header-mode-3 .panel_menu_wrapper .mini-cart-header .cart-icon::after,
  .header-mode-3 .panel_menu_wrapper .cta_button,
  .sidebar-widget .price_slider_wrapper .price_slider.ui-slider .ui-slider-range,
  #goto-top,
  .header-mode-2 .action-box #action_link:hover,
  .woocommerce ul.products li.product .button,
  .footer-center::before,
  input[type="submit"], button{
    background-color:<?php echo $theme_color;?> !important;
  }
  .woocommerce span.onsale,
  .woocommerce ul.products li.product .button,
  .header-mode-3 .panel_menu_wrapper .cta_button,
  input[type="submit"]
  {
    color: <?php echo $secondary_color;?> !important;
  }
  .woocommerce span.onsale{
    box-shadow:0 0 10px <?php echo $theme_color;?>90;
  }
  .header-mode-3 .panel_menu_wrapper .cta_button
  {
    box-shadow: 0 0 15px <?php echo $theme_color;?>;
  }
  .header-mode-1 .search-form #ajax_search_loading span,
  .header-mode-2 .action-box #action_link,
  .header-mode-3 .search-form #ajax_search_loading span,
  .footer-legend-inner h5,
  .website-footer .footer-widget span.footer-widget-title,
  .list-posts-widget li:hover p{
    color:<?php echo $theme_color;?>;
  }
  .cats-list .menu li:hover > a,.topmenu li ul li a:hover,.topmenu li ul li:hover > a,.topmenu li ul li:hover::after{
    color:<?php echo $theme_color;?>;
  }
  .topbar,
  .cats-list ul.menu.show_menu,
  .website-footer{
    border-top-color:<?php echo $theme_color;?> !important;
  }
  .footer-legend a{
    background:<?php echo $theme_color;?>;
  }
  .post-title h1 a:hover{
    color:<?php echo $theme_color;?>;
  }
  .related-posts-title {
    color:<?php echo $theme_color;?>;
    border-bottom-color:<?php echo $theme_color;?>;
  }
  input:focus,textarea:focus{
    border-color:<?php echo $theme_color;?>;
  }
  .comment-reply-link{
    color:<?php echo $theme_color;?>;
    border-color:<?php echo $theme_color;?>;
  }
  .authorabout span a{
    background:<?php echo $theme_color;?>;
  }
  .main-menu li:hover:after{
    color:<?php echo $theme_color;?>;
  }
  .navigation li a,
  .navigation li a:hover,
  .navigation li.active a,
  .navigation li.disabled {
    border-color:<?php echo $theme_color;?>;
    color:<?php echo $theme_color;?>;
  }
  .navigation li a:hover,
  .navigation li.active a {
    color:#fff;
    background-color:<?php echo $theme_color;?>;
  }
  .post-index h2.cat-name{
    color:<?php echo $theme_color;?> !important;
    border-bottom-color:<?php echo $theme_color;?> !important;
  }
  .woocommerce div.product form.cart .button{
    background-color:<?php echo $theme_color;?>;
    color: <?php echo $secondary_color;?>
  }
  .search .searchbtn:hover{
    color:<?php echo $theme_color;?>;
  }
  .mw_product_item:hover
  {
    box-shadow: 0 0 25px 0px <?php echo $theme_color?>;
  }
  .mw_product_item .mw_overly
  {
    background: <?php echo $theme_color; ?>;
    opacity: .7;
  }
  .mw_product_item:hover .woocommerce-loop-product__title, .mw_product_item:hover span.price *
  {
    color: <?php echo $secondary_color;?> !important;
  }
  .woocommerce .woocommerce-tabs.wc-tabs-wrapper .tabs.wc-tabs li.active
  {
      background-color: <?php echo $theme_color ?>;
      box-shadow: 0px 1px 10px 0px <?php echo $theme_color?>;
      color: <?php echo $secondary_color; ?>;
  }
  .ahura_contact_widget_item span{
    color:<?php echo $theme_color?> !important;
  }
<?php endif;?>
<?php if(mw_options::check_is_show_mini_cart_option()):
  $mini_cart_bg_color = get_theme_mod('ahura_mini_cart_bg_color', '#2aba5f');
  $mini_cart_color = get_theme_mod('ahura_mini_cart_color', '#fff');
  ?>
  .header-mode-1 .mini-cart-header
  {
    background-color: <?php echo $mini_cart_bg_color?>;
    box-shadow: 0 0 15px <?php echo $mini_cart_bg_color?>;
  }
  .header-mode-1 .mini-cart-header > a
  {
    color: <?php echo $mini_cart_color; ?>;
  }
<?php endif; ?>
<?php if ( get_theme_mod( 'bgcolor' ) ) : ?>
  body{
    background:<?php echo get_theme_mod( 'bgcolor' );?> !important;
  }
<?php endif;?>
<?php if ( \ahura\app\mw_options::get_mod_is_stickyheader() ) : ?>
  @media only screen and (min-width:1100px){
    .scrolled-topbar .menu-icon{
      background-color: <?php $theme_color = \ahura\app\mw_options::get_mod_theme_color(); echo $theme_color ? $theme_color : '#fed700';?>;
      color: <?php echo \ahura\app\mw_options::get_mod_secondary_color(); ?>;
    }
  }
  .topbar{
    position:fixed;
    z-index:999;
    right:0;
    top:0;
  }
  <?php if ( is_admin_bar_showing() ) :?>
    .topbar{
      top:32px;
    }
  <?php endif;?>
<?php endif;?>
<?php if ( get_theme_mod( 'ahura_legend_background' ) ) : ?>
  .footer-legend{
    background:url('<?php echo get_theme_mod( 'ahura_legend_background' ); ?>') no-repeat center center;
  }
<?php endif;?>
<?php $theme_columns = \ahura\app\mw_options::get_mod_theme_columns(); if ( $theme_columns == '1c' ) : ?>
  .ahura-post-single:not(.woocommerce) .post-box{width:100%;}
<?php endif;?>
<?php if ( $theme_columns == '3c' ) : ?>
  .ahura-post-single:not(.woocommerce) .post-entry{width:65%;float:left;}
  .ahura-post-single:not(.woocommerce) .related-posts{width:65%;float:left;}
  .ahura-post-single:not(.woocommerce) .related-posts article span{margin-top:5% !important}
<?php endif;?>
<?php if ( $theme_columns == '2cr' ) : ?>
  .ahura-post-single:not(.woocommerce) .sidebar{float:right}
  .ahura-post-single:not(.woocommerce) .post-box{float:left;}
<?php endif;?>
<?php $sohp_columns = \ahura\app\mw_options::get_mod_shop_columns(); if ( $sohp_columns == '1c' ) : ?>
  .ahura-1c-column.woocommerce .post-box{width:100% !important;}
<?php endif;?>
<?php if ( $sohp_columns == '3c' ) : ?>
  section.container.ahura-shop-single .post-box .post-entry{width:690px !important;float:left !important;}
<?php endif;?>
<?php if ( $sohp_columns == '2cr' ) : ?>
  section.container.ahura-shop-single .sidebar{float:right !important}
  section.container.ahura-shop-single .post-box{float:left !important;}
  .ahura-2cr-column .post-box{float:left !important;}
<?php endif;?>
<?php if ( get_theme_mod( 'ahura_footer_color' ) ) : ?>
  .website-footer {
    background-color:<?php echo get_theme_mod( 'ahura_footer_color' );?>
  }
<?php endif;?>
<?php if ( get_theme_mod( 'ahura_footer_bg' ) ) : ?>
  .website-footer {
    background-image:url('<?php echo get_theme_mod( 'ahura_footer_bg' );?>');
    background-size: <?php echo get_theme_mod('ahura_footer_bg_size', 'auto');?>;
  }
<?php endif;?>
<?php if ( get_theme_mod( 'ahura_footer_text_color' ) ) : ?>
  .website-footer .footer-widget span.footer-widget-title,.footer-copyright, .footer-legend-inner h5, .footer-copyright2,.website-footer .footer-widget * {
    color:<?php echo get_theme_mod( 'ahura_footer_text_color' );?>
  }
<?php endif;?>
<?php if(\ahura\app\mw_options::check_is_header_2_active() && \ahura\app\mw_options::check_is_transparent_header()): ?>
  <?php if($transparent_content_color = \ahura\app\mw_options::get_mod_transparent_header_content_color()): ?>
    .header-mode-2.ahura_transparent:not(.scrolled-topbar) .action-box #action_link,
    .header-mode-2.ahura_transparent:not(.scrolled-topbar) .action-box #action_search,
    .header-mode-2.ahura_transparent:not(.scrolled-topbar) .top-menu ul.topmenu>li>a,
    .header-mode-2.ahura_transparent:not(.scrolled-topbar) .top-menu ul.topmenu>li::after
    {
      color: <?php echo $transparent_content_color; ?> !important;
    }
    .header-mode-2.ahura_transparent:not(.scrolled-topbar) .action-box #action_link:hover
    {
      background-color: <?php echo $transparent_content_color; ?>;
      color: <?php echo \ahura\app\mw_options::get_mod_bg_color();?> !important;
    }
  <?php endif; ?>
  <?php if(\ahura\app\mw_options::get_mod_ahorua_transparent_logo()): ?>
    .header-mode-2.ahura_transparent:not(.scrolled-topbar) .logo img:not(.ahura_transparent_logo)
    {
      display: none;
    }
    .header-mode-2.ahura_transparent.scrolled-topbar .logo img.ahura_transparent_logo
    {
      display: none;
    }
  <?php endif; ?>
<?php endif; ?>
.header-mode-1 .cats-list-title
{
  color: <?php echo \ahura\app\mw_options::get_mod_secondary_color(); ?>;
}
<?php if(\ahura\app\mw_options::get_mod_is_justify_paragraph()): ?>
  p{
    text-align:justify;
  }
<?php endif; ?>
<?php if(get_theme_mod('ahura_content_radius')) :?>
.woocommerce div.product{
  border-radius:<?php echo get_theme_mod('ahura_content_radius'); ?>px !important;
}
<?php endif; ?>
<?php if(get_theme_mod('ahura_sidebar_widget_radius')) :?>
.sidebar-widget{
  border-radius:<?php echo get_theme_mod('ahura_sidebar_widget_radius'); ?>px !important;
}
<?php endif; ?>
<?php if(get_theme_mod('ahura_cta_widget_radius')) :?>
#action_link,.panel_menu_wrapper .cta_button{
  border-radius: <?php echo get_theme_mod('ahura_cta_widget_radius') ;?>px !important;
}
<?php endif; ?>
<?php if(get_theme_mod('ahura_gototop_widget_radius')) :?>
#goto-top{
  border-radius: <?php echo get_theme_mod('ahura_gototop_widget_radius') ;?>px !important;
}
<?php endif; ?>
<?php if(get_theme_mod('ahura_product_regular_price_color')) :?>
.product span.price,.sale span.price del *{
  color:<?php echo get_theme_mod('ahura_product_regular_price_color'); ?> !important;
}
<?php endif; ?>

<?php if(get_theme_mod('ahura_product_sale_price_color')) :?>
.sale span.price ins *{
  color:<?php echo get_theme_mod('ahura_product_sale_price_color'); ?> !important;
}
<?php endif; ?>
<?php if(get_theme_mod('post_paragraph_size')) :?>
.post-custom p{
  font-size: <?php echo get_theme_mod('post_paragraph_size') ;?>px !important;
}
<?php endif; ?>
<?php if(get_theme_mod('post_paragraph_a_size')) :?>
.post-custom p a{
  font-size: <?php echo get_theme_mod('post_paragraph_a_size') ;?>px !important;
}
<?php endif; ?>
<?php if(get_theme_mod('post_paragraph_a_color')) :?>
.post-custom p a{
  color: <?php echo get_theme_mod('post_paragraph_a_color') ;?>;
}
<?php endif; ?>
<?php if(get_theme_mod('post_paragraph_color')) :?>
.post-custom p,.post-custom ul li{
  color: <?php echo get_theme_mod('post_paragraph_color') ;?>;
}
<?php endif; ?>
<?php if(get_theme_mod('ahura_border_sidebar_title_color')): ?>
.sidebar-widget-title::before{
  background-color: <?php echo get_theme_mod('ahura_border_sidebar_title_color'); ?>
}
<?php endif; ?>
<?php if(get_theme_mod('ahura_background_selctor_color')) :?>
::selection{
  background-color: <?php echo get_theme_mod('ahura_background_selctor_color'); ?>
}
::-moz-selection{
  background-color: <?php echo get_theme_mod('ahura_background_selctor_color'); ?>
}
<?php endif; ?>
<?php if(get_theme_mod('ahura_background_selctor_text_color')) :?>
::selection{
  color: <?php echo get_theme_mod('ahura_background_selctor_text_color'); ?>
}
::-moz-selection{
  color: <?php echo get_theme_mod('ahura_background_selctor_text_color'); ?>
}
<?php endif; ?>
<?php if(get_theme_mod('ahorua_header_mode_4_cta_background')):?>
.header-mode-4-cta{
  background-color: <?php echo get_theme_mod('ahorua_header_mode_4_cta_background');?>;
}
<?php endif; ?>
<?php if(get_theme_mod('ahorua_header_mode_4_cta_text_color')):?>
.header-mode-4-cta{
 color: <?php echo get_theme_mod('ahorua_header_mode_4_cta_text_color');?>;
}
<?php endif; ?>
<?php if(get_theme_mod('ahorua_header_mode_4_menu_background')):?>
.header-mode-4-menu-container{
 background-color: <?php echo get_theme_mod('ahorua_header_mode_4_menu_background');?>;
}
<?php endif; ?>
</style>
