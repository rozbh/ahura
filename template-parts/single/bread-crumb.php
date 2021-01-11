<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
?>
<div class="post-header" style="background-image:url(<?php echo $thumb_url[0];?>)">
  <div class="cover">
    <header>
    <a><?php the_title(); ?></a>
    </header>
      <div class="clear"></div>
    <div class="breadcrumb"><?php get_breadcrumb(); ?></div><div class="clear"></div>
  </div>
    <div class="clear"></div>
</div>