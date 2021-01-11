<?php get_header(); ?>
<section class="site-container">
<div class="postbox4 post-index">
<div class="clear"></div>
<div class="flexed row">
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
  <div class="col-md-4 col-lg-3"><article>
    <a class="fimage" href="<?php the_permalink();?>"><?php the_post_thumbnail( 'stthumb' );?></a>
    <a href="<?php the_permalink();?>"><h3><?php the_title();?></h3></a>
    <div class="excerpt has_margin">
      <?php the_excerpt();?>
    </div>
    <div class="meta">
      <span class="post-author"><?php echo get_avatar( get_the_author_meta( 'ID' ) , 48 ); ?><?php the_author(); ?></span>
      <span class="post-meta"><i class="far fa-clock"></i> <?php echo get_the_date('d F Y');?></span>
    </div>
  </article></div>
<?php endwhile; ?>
<?php else:?>
  <article style="width:100%;padding:30px;" class="post-entry">
  <header class="post-title">
  <h2><a href="#"><?php echo __('Posts Not Found!','ahura');?></a></h2>
  </header>
  <div class="error404">404</div>
  </article>
<?php endif; ?>
</div>
<div class="clear"></div>
<?php mihanwp_numeric_posts_nav(); ?>
</div>
<div class="clear"></div>
</section>
<?php get_footer(); ?>