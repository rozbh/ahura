<?php
/*
Template Name: بدون سایدبار
*/

use ahura\app\mw_options;
use ahura\app\woocommerce;

?>
<?php get_header(); ?>
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
<?php if( !woocommerce::is_woocommerce_page() && mw_options::page_has_breadcsrumb() ):?>
  <?php include 'template-parts/single/bread-crumb.php';?>
<?php endif;?>
<section class="site-container">
<section style="width:100%" class="post-box">
<article class="post-entry">
<header class="post-title">
<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
</header>
<?php the_content(''); ?>
</article>
</section>
<?php endwhile; ?>
<?php endif; ?>
<div class="clear"></div>
</section>
<?php get_footer(); ?>