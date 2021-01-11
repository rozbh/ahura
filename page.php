<?php

use ahura\app\mw_options;
use ahura\app\woocommerce;

get_header(); ?>
<?php $is_woocommerce_page = woocommerce::is_woocommerce_page();
?>
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
<?php if ( !$is_woocommerce_page && mw_options::page_has_breadcsrumb()) :?>
  <?php include 'template-parts/single/bread-crumb.php';?>
<?php endif;
if($is_woocommerce_page)
{
  $theme_columns = mw_options::get_mod_shop_columns();
}else{
  $theme_columns = mw_options::get_mod_theme_columns();
}
?>
<section class="site-container ahura-<?php echo $theme_columns;?>-column ahura-post-single <?php echo $is_woocommerce_page ? 'woocommerce' : '';?> <?php echo is_rtl() ? 'mw_rtl' : 'mw_ltr'; ?>">
<?php if ( $theme_columns == '2cr' ):?>
<?php include 'rightsidebar.php';?>
<?php endif; ?>
<section class="post-box">
  <?php if ( $theme_columns == '3c' ):?>
  <?php include 'rightsidebar.php';?>
  <?php endif; ?>
<article class="post-entry <?php echo class_exists( 'WooCommerce' ) && is_woocommerce() ? 'mw_woocommerce_entry' : ''; ?>">
<header class="post-title">
<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
</header>
<?php the_content(''); ?>
</article>
</section>
<?php endwhile; ?>
<?php endif; ?>
<?php if ( $theme_columns == '2c' || $theme_columns == '3c' ):?>
<?php include 'leftsidebar.php';?>
<?php endif; ?>
<div class="clear"></div>
</section>
<?php get_footer(); ?>