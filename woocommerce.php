<?php get_header(); ?>
<?php $shop_columns = \ahura\app\mw_options::get_mod_shop_columns(); ?>
<section class="site-container ahura-<?php echo $shop_columns;?>-column ahura-post-single woocommerce <?php echo is_rtl() ? 'mw_rtl' : 'mw_ltr'; ?>">
<?php if ( $shop_columns == '2cr' ):?>
  <?php include 'rightsidebar.php';?>
  <?php endif; ?>
<section class="post-box">
  <?php if ( $shop_columns == '3c' ):?>
  <?php include 'rightsidebar.php';?>
  <?php endif; ?>
  <div class="ahura_woocommerce_content_wrapper">
  <?php woocommerce_content(''); ?>
  </div>
</section>
<?php if ( $shop_columns == '2c' || $shop_columns == '3c' ):?>
<?php include 'leftsidebar.php';?>
<?php endif; ?>
<div class="clear"></div>
</section>
<?php get_footer(); ?>