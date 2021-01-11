<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="fontiran.com:license" content="N6T6N">
<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' />
<?php wp_head(); ?>
</head>
<?php $direction_mode = is_rtl() ? 'mw_rtl' : 'mw_ltr';?>
<body id="ah_body" <?php body_class($direction_mode)?>>
<?php wp_body_open();?>
<div id="siteside" class="siteside">
    <span class="fa fa-window-close siteside-close" id="menu-close"></span>
    <?php rd_topmenu(); ?>
</div>
<div id="mgsiteside" class="mgsiteside">
<div class="cats-list">
<span class="mg-cat-title" style="background-color:<?php echo \ahura\app\mw_options::get_mod_theme_color();?>;color:<?php echo \ahura\app\mw_options::get_mod_secondary_color();?>; "><?php echo \ahura\app\mw_options::get_mod_header_cats_menu_title(); ?></span>
<?php wp_nav_menu( array( 'theme_location' => 'mega_menu' ) ); ?>
</div>
</div>
<?php \ahura\app\mw_partials::load_header();?>