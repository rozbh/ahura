<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wp_customize->add_section('ahura_layout',array(
  'title' => __( 'Theme Layout', 'ahura' ),
  'priority' => '2',
) );
$wp_customize->add_setting('ahura_columns',array(
  'default' => '2c',
));
$wp_customize->add_control('ahura_columns',array(
  'type' => 'radio',
  'section' => 'ahura_layout',
  'description' => __( 'Website Columns', 'ahura' ),
  'choices' => array(
      '1c' => __( 'Full Width', 'ahura' ),
      '2c' => __( 'Left Sidebar', 'ahura' ),
      '2cr' => __( 'Right Sidebar', 'ahura' ),
      '3c' => __( '3 Columns', 'ahura' ),
  ),
));
$wp_customize->add_setting('ahura_goto_top_position', ['default' => 'right']);
$wp_customize->add_control('ahura_goto_top_position', [
  'type' => 'radio',
  'section' => 'ahura_layout',
  'label' => __("Goto-top button position", 'ahura'),
  'choices' => [
    'right' => __("Right", 'ahura'),
    'left' => __("Left", 'ahura')
  ]
]);