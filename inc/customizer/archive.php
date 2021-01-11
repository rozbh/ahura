<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


$wp_customize->add_section( 'ahura_archive' , array(
      'title'      => __( 'Blog Settings', 'ahura' ),
      'priority'   => 6,
));
$wp_customize->add_setting('post-meta-time');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'post-meta-time', array(
    'label' => __( 'Show Time in Archive', 'ahura' ),
    'section' => 'ahura_archive',
    'settings' => 'post-meta-time',
    'default'  => true,
    'type'    => 'checkbox',
)));
$wp_customize->get_setting( 'post-meta-time' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'post-meta-time', array(
            'selector' => '.post-meta li:nth-child(1)',
            'render_callback' => '__return_false',
) );
$wp_customize->add_setting('post-meta-author');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'post-meta-author', array(
    'label' => __( 'Show Author', 'ahura' ),
    'section' => 'ahura_archive',
    'settings' => 'post-meta-author',
    'default'  => true,
    'type'    => 'checkbox',
)));
$wp_customize->get_setting( 'post-meta-author' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'post-meta-author', array(
            'selector' => '.post-meta li:nth-child(2)',
            'render_callback' => '__return_false',
) );
$wp_customize->add_setting('post-meta-comments');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'post-meta-comments', array(
    'label' => __( 'Show Comments Count', 'ahura' ),
    'section' => 'ahura_archive',
    'settings' => 'post-meta-comments',
    'default'  => true,
    'type'    => 'checkbox',
)));
$wp_customize->get_setting( 'post-meta-comments' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'post-meta-comments', array(
            'selector' => '.post-meta li:nth-child(3)',
            'render_callback' => '__return_false',
) );
