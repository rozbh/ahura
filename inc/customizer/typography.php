<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wp_customize->add_section( 'ahura_typography' , array(
      'title'      => __('Typography','ahura'),
      'priority'   => 1,
));
$wp_customize->add_setting('ahura_theme_font',[
    'default' => 'iranyekan',
    'sanitize_callback' => ['\ahura\app\mw_options', 'sanitize_select_field']
]);
$wp_customize->add_control('ahura_theme_font', [
    'section' => 'ahura_typography',
    'type' => 'select',
    'label' => __("Theme Font", 'ahura'),
    'choices' => [
        'iranyekan' => __('IranYekan', 'ahura'),
        'iransans' => __('IranSans', 'ahura')
    ]
]);
$wp_customize->add_setting('ahura_paragraph_alignment', ['default' => true]);
$wp_customize->add_control('ahura_paragraph_alignment', [
    'section' => 'ahura_typography',
    'type' => 'checkbox',
    'label' => __('Justify paragraph', 'ahura'),
]);