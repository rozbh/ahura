<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wp_customize->add_section('ahura_shop',array(
  'title' => __( 'Shop Settings', 'ahura' ),
  'priority' => '2',
) );
$wp_customize->add_setting('ahura_shop_columns',array(
  'default' => '2c',
));
$wp_customize->add_control('ahura_shop_columns',array(
  'type' => 'radio',
  'section' => 'ahura_shop',
  'description' => __( 'Shop Sidebars', 'ahura' ),
  'choices' => array(
      '1c' => __( 'No Sidebar', 'ahura' ),
      '2c' => __( 'Left Sidebar', 'ahura' ),
      '2cr' => __( 'Right Sidebar', 'ahura' ),
      '3c' => __( 'Two Sidebars', 'ahura' ),
  ),
));

$wp_customize->add_setting('ahura_shop_show_peoduct_tags',['default' => true]);
$wp_customize->add_control('ahura_shop_show_peoduct_tags',array(
  'type' => 'checkbox',
  'section' => 'ahura_shop',
  'label' => __( 'Show product tags', 'ahura' ),
));

$wp_customize->add_setting('ahura_shop_show_product_related',['default' => true]);
$wp_customize->add_control('ahura_shop_show_product_related',array(
  'type' => 'checkbox',
  'section' => 'ahura_shop',
  'label' => __( 'Show product related', 'ahura' ),
));

$wp_customize->add_setting('ahura_product_regular_price_color',['default' => '#66BB6A']);
$wp_customize->add_control(
  new WP_Customize_Color_Control($wp_customize,'ahura_product_regular_price_color',array(
  'section' => 'ahura_shop',
  'setting' => 'ahura_product_regular_price_color',
  'label' => __( 'Product regular price color', 'ahura' ),
))
);

$wp_customize->add_setting('ahura_product_sale_price_color',['default' => '#66BB6A']);
$wp_customize->add_control(
  new WP_Customize_Color_Control($wp_customize,'ahura_product_sale_price_color',array(
  'section' => 'ahura_shop',
  'setting' => 'ahura_product_sale_price_color',
  'label' => __( 'Product sale price color', 'ahura' ),
))
);

$wp_customize->add_setting('ahura_shop_per_page',['default' => '9']);
$wp_customize->add_control(
  new WP_Customize_Control($wp_customize,'ahura_shop_per_page',array(
  'section' => 'ahura_shop',
  'type' => 'number',
  'setting' => 'ahura_shop_per_page',
  'label' => __( 'Shop product per page', 'ahura' ),
))
);
