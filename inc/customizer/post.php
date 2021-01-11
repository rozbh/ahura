<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wp_customize->add_section( 'ahura_post' , array(
      'title'      => __( 'Single Post', 'ahura' ),
      'priority'   => 3,
));
$wp_customize->add_setting('show_breadcrumb');
$wp_customize->add_control('show_breadcrumb', [
    'label' => __('Show Breadcrumb', 'ahura'),
    'type' => 'checkbox',
    'section' => 'ahura_post'
]);
$wp_customize->add_setting('breadcrumb');
$wp_customize->add_control('breadcrumb', [
    'label' => __('Breadcrumb Dispaly Mode', 'ahura'),
    'type' => 'radio',
    'section' => 'ahura_post',
    'choices' => array(
        'one' => __('One','ahura'),
        'two' => __('Two','ahura'),
    )
]);
$wp_customize->add_setting('breadcrumb2');
$wp_customize->add_control('breadcrumb2', [
    'label' => __('Breadcrumb 2', 'ahura'),
    'type' => 'radio',
    'section' => 'ahura_post'
]);
$wp_customize->add_setting('show_tags');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'show_tags', array(
    'label' => __( 'Show Tags', 'ahura' ),
    'section' => 'ahura_post',
    'settings' => 'show_tags',
    'default'  => true,
    'type'    => 'checkbox',
)));
$wp_customize->get_setting( 'show_tags' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'show_tags', array(
            'selector' => '.post-entry #tags',
            'render_callback' => '__return_false',
) );
$wp_customize->add_setting('show_author');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'show_author', array(
    'label' => __( 'Show Post Author', 'ahura' ),
    'section' => 'ahura_post',
    'settings' => 'show_author',
    'default'  => true,
    'type'    => 'checkbox',
)));
$wp_customize->get_setting( 'show_author' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'show_author', array(
            'selector' => '.post-entry .authorbox',
            'render_callback' => '__return_false',
) );
$wp_customize->add_setting('show_relatedposts');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'show_relatedposts', array(
    'label' => __( 'Related Posts', 'ahura' ),
    'section' => 'ahura_post',
    'settings' => 'show_relatedposts',
    'default'  => true,
    'type'    => 'checkbox',
)));
$wp_customize->get_setting( 'show_relatedposts' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'show_relatedposts', array(
            'selector' => '.related-posts',
            'render_callback' => '__return_false',
) );

$wp_customize->add_setting('show_single_post_thumbnail',
array('default' => 'right')
);
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'show_single_post_thumbnail', array(
    'label' => __( 'Post Thumbnail in Content', 'ahura' ),
    'section' => 'ahura_post',
    'settings' => 'show_single_post_thumbnail',
    'type'    => 'radio',
    'default' => 'none',
    'choices' => array(
        'none' => __( 'Hide', 'ahura' ),
        'right' => __( 'Right', 'ahura' ),
        'left' => __( 'Left', 'ahura' ),
    ),
)));

$wp_customize->add_setting('post_paragraph_size');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'post_paragraph_size', array(
    'label' => __( 'Post paragraph font size', 'ahura' ),
    'section' => 'ahura_post',
    'description' => __('Default 16px','ahura'),
    'settings' => 'post_paragraph_size',
    'type'    => 'number',
)));

$wp_customize->add_setting('post_paragraph_a_size');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'post_paragraph_a_size', array(
    'label' => __( 'Post paragraph link font size', 'ahura' ),
    'section' => 'ahura_post',
    'description' => __('Default 16px','ahura'),
    'settings' => 'post_paragraph_a_size',
    'type'    => 'number',
)));

$wp_customize->add_setting('post_paragraph_color',['default' => '#35495c']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'post_paragraph_color', array(
    'label' => __( 'Post paragraph color', 'ahura' ),
    'section' => 'ahura_post',
    'settings' => 'post_paragraph_color',
)));

$wp_customize->add_setting('post_paragraph_a_color',['default' => '#35495c']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'post_paragraph_a_color', array(
    'label' => __( 'Post paragraph link color', 'ahura' ),
    'section' => 'ahura_post',
    'settings' => 'post_paragraph_a_color',
)));
