<?php

use ahura\app\mw_options;

get_header(); ?>
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
 <?php if(get_theme_mod('breadcrumb') == 'one'){
          if(mw_options::page_has_breadcsrumb()){
            include 'template-parts/single/bread-crumb.php';
          }
      }
?>

  <?php $theme_columns = \ahura\app\mw_options::get_mod_theme_columns(); ?>
<section class="site-container ahura-<?php echo $theme_columns;?>-column ahura-post-single">
<?php if ( $theme_columns == '2cr' ):?>
  <?php include 'rightsidebar.php';?>
  <?php endif; ?>
<section class="post-box">
  <?php
    if(get_theme_mod('breadcrumb') == 'two'){
      if(mw_options::page_has_breadcsrumb()){
        include 'template-parts/single/bread-crumb2.php';
      }
    }
  ?>
  <?php if ( $theme_columns == '3c' ):?>
  <?php include 'rightsidebar.php';?>
  <?php endif; ?>
<article class="post-entry post-entry-custom">
<header class="post-title">
<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
</header>
<ul class="post-meta">
  <?php if ( get_theme_mod( 'post-meta-time' ) ) :?>
    <li><i class="far fa-clock"></i> <?php echo get_the_date('d F Y');?></li>
  <?php endif; ?>
  <?php if ( get_theme_mod( 'post-meta-author' ) ) :?>
    <li><i class="far fa-user"></i> <?php the_author(); ?></li>
  <?php endif; ?>
  <?php if(get_comments_number()): ?>
    <li><i class="far fa-comments"></i> <?php
    			printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'ahura' ), number_format_i18n( get_comments_number() ) );
    ?></li>
  <?php endif; ?>
</ul>
<?php
if ( get_theme_mod('show_star_rating')):
if (empty( get_post_meta( $post->ID, '_post_star_meta', true ))):
$post_rating = 5;
else:
$post_rating = get_post_meta( $post->ID, '_post_star_meta', true );
endif;
$args = array(
   'rating' => $post_rating,
   'type' => 'rating',
   'number' => 1234,
);
require_once( ABSPATH . 'wp-admin/includes/template.php' );
wp_star_rating( $args );
endif;
?>
<?php if( get_theme_mod('show_single_post_thumbnail') != 'none'):?>
<div class="single-post-thumbnail<?php if( get_theme_mod('show_single_post_thumbnail') == 'right'):?>-right<?php elseif ( get_theme_mod('show_single_post_thumbnail') == 'left' ): ?>-left<?php endif;?>"><?php the_post_thumbnail( 'stthumb' );?></div>
<?php endif;?>
<?php the_content(''); ?>
<?php if( get_theme_mod('show_post_sharing')):?>
<div class="sharing">
<?php echo __('Share ...','ahura');?>
<div class="clear"></div>
<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url');?>/img/social/facebook.svg"/></a>
<a target="_blank" href="https://twitter.com/home?status=<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url');?>/img/social/twitter.svg"/></a>
<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=&source=<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url');?>/img/social/linkedin.svg"/></a>
<a target="_blank" href="https://telegram.me/share/url?url=<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url');?>/img/social/telegram.png"/></a>
<a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url');?>/img/social/pinterest.svg"/></a>
<a target="_blank" href="whatsapp://send?text=<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url');?>/img/social/whatsapp.svg"/></a>
<a target="_blank" href="mailto:?subject=Hello,Please Check.&amp;body=<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url');?>/img/social/email.svg"/></a>
</div>
<?php endif;?>
<?php if ( get_theme_mod('show_author')):?>
<div class="clear"></div>
<div class="authorbox">
<div class="authorimg">
<?php echo get_avatar( get_the_author_meta('email'), '125' ); ?>
</div>
<div class="authorabout">
  <?php $author_url = get_the_author_meta('url'); ?>
<span><?php the_author(); if($author_url): ?> <a target="_blank" rel="nofollow" href="<?php echo $author_url; ?>"><?php echo __('Website','ahura');?></a><?php endif; ?></span>
<div class="authortxt">
<?php the_author_meta('description'); ?>
</div>
</div>
</div>
<?php endif;?>
<div class="clear"></div>
<?php if ( get_theme_mod('show_tags')):?>
<div id="tags">
<?php the_tags('#',' #',''); ?>
</div>
<?php endif;?>
</article>
<?php if ( get_theme_mod('show_relatedposts')):?>
<div class="related-posts">
<span class="related-posts-title"><?php echo __('Related Articles','ahura');?></span>
<div class="postbox1posts row">
  <?php
  $related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 4, 'post__not_in' => array($post->ID) ) );
  if( $related ) foreach( $related as $post ) {
  setup_postdata($post); ?>
  <?php
  $thumb_id = get_post_thumbnail_id();
  $thumb_url = wp_get_attachment_image_src($thumb_id,'verthumb', true);
  ?>
    <div class="col-md-3">
      <article class="grid-post grid-post-grey" style="background-image:url('<?php echo $thumb_url[0];?>');">
      <a href="<?php the_permalink();?>">
          <span><?php the_title();?></span>
      </a>
    </article>
  </div>
  <?php }
  wp_reset_postdata(); ?>
</div>
<div class="clear"></div>
</div>
<?php endif;?>
<div class="post-entry">
<?php comments_template(); ?>
</div>
</section>
<?php endwhile; ?>
<?php endif; ?>
<?php if ( $theme_columns == '2c' || $theme_columns == '3c' ):?>
<?php include 'leftsidebar.php';?>
<?php endif; ?>
<div class="clear"></div>
</section>
<?php get_footer(); ?>
