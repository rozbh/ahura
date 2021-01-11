<?php
/*
Template Name: صفحه ساز
*/
?>
<?php get_header(); ?>
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
<?php the_content(''); ?>
<?php endwhile; ?>
<?php endif; ?>
<div class="clear"></div>
<?php get_footer(); ?>