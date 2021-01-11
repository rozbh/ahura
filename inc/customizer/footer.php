<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wp_customize->add_section( 'ahura_footer' , array(
      'title'      => __('Footer','ahura'),
      'priority'   => 6,
));

$wp_customize->add_setting('ahura_footer_color');
$wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize, 'ahura_footer_color', array(
		'label'      => __( 'Background Color', 'ahura' ),
		'section'    => 'ahura_footer',
		'settings'   => 'ahura_footer_color',
	) )
);

$wp_customize->add_setting('ahura_footer_text_color');
$wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize, 'ahura_footer_text_color', array(
		'label'      => __( 'Text Color', 'ahura' ),
		'section'    => 'ahura_footer',
		'settings'   => 'ahura_footer_text_color',
	) )
);

$wp_customize->add_setting('ahura_footer_bg');
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ahura_footer_bg',
    array(
    'label' => __( 'Footer Background', 'ahura' ),
    'section' => 'ahura_footer',
    'settings' => 'ahura_footer_bg',
)));
$wp_customize->add_setting('ahura_footer_bg_size', ['default' => 'auto']);
$wp_customize->add_control('ahura_footer_bg_size', [
    'type' => 'radio',
    'section' => 'ahura_footer',
    'label' => __("Background Size", 'ahura'),
    'choices' => [
        'auto' => __("Auto", 'ahura'),
        'contain' => __('Contain', 'ahura'),
        'cover' => __('Cover', 'ahura')
    ],
    'active_callback' => ['\ahura\app\mw_options', 'check_has_footer_bg']
]);

$wp_customize->add_setting('ahura_legend');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ahura_legend', array(
    'label' => __( 'Footer Slogan', 'ahura' ),
    'section' => 'ahura_footer',
    'settings' => 'ahura_legend',
    'default'  => true,
    'type'    => 'checkbox',
)));
$wp_customize->get_setting( 'ahura_legend' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'ahura_legend', array(
            'selector' => '.footer-legend',
            'render_callback' => '__return_false',
) );
$wp_customize->add_setting('ahura_legend_text');
$wp_customize->add_control( 'ahura_legend_text',
array(
'label' => __( 'Footer Slogan Text', 'ahura' ),
'section' => 'ahura_footer',
'settings' => 'ahura_legend_text',
) );
$wp_customize->get_setting( 'ahura_legend_text' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'ahura_legend_text', array(
            'selector' => '.footer-legend h5',
            'render_callback' => '__return_false',
) );
$wp_customize->add_setting('ahura_legend_ctalink');
$wp_customize->add_control( 'ahura_legend_ctalink',
array(
'label' => __( 'Footer Slogan Link', 'ahura' ),
'section' => 'ahura_footer',
'settings' => 'ahura_legend_ctalink',
) );
$wp_customize->get_setting( 'ahura_legend_ctalink' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'ahura_legend_ctalink', array(
            'selector' => '.footer-legend a',
            'render_callback' => '__return_false',
) );
$wp_customize->add_setting('ahura_legend_ctatext');
$wp_customize->add_control( 'ahura_legend_ctatext',
array(
'label' => __( 'Footer Slogan Button Text', 'ahura' ),
'section' => 'ahura_footer',
'settings' => 'ahura_legend_ctatext',
) );
$wp_customize->add_setting('ahura_legend_background');
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ahura_legend_background',
array(
'label' => __( 'Footer Slogan Background', 'ahura' ),
'section' => 'ahura_footer',
'settings' => 'ahura_legend_background',
)));

$wp_customize->add_setting('footer-copyright');
$wp_customize->add_control( 'footer-copyright',
array(
'label' => __( 'Footer Right Copyright', 'ahura' ),
'section' => 'ahura_footer',
'settings' => 'footer-copyright',
) );
$wp_customize->get_setting( 'footer-copyright' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'footer-copyright', array(
            'selector' => '.footer-copyright',
            'render_callback' => '__return_false',
) );



$wp_customize->add_setting('footer-copyright2');
$wp_customize->add_control( 'footer-copyright2',
array(
'label' => __( 'Footer Left Copyright', 'ahura' ),
'section' => 'ahura_footer',
'settings' => 'footer-copyright2',
) );
$wp_customize->get_setting( 'footer-copyright2' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'footer-copyright2', array(
            'selector' => '.footer-copyright2',
            'render_callback' => '__return_false',
) );

$wp_customize->add_setting('footer_namad_check',['default' => false]);
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_namad_check',
    array(
    'label' => __( 'Show Footer Symbol', 'ahura' ),
    'type'  =>'checkbox',
    'section' => 'ahura_footer',
    'settings' => 'footer_namad_check',
)));

$wp_customize->add_setting('show_symbol1',['default' => true]);
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_symbol1',
    array(
    'label' => __( 'Show Footer Symbol 1', 'ahura' ),
    'type'  =>'checkbox',
    'section' => 'ahura_footer',
    'settings' => 'show_symbol1',
)));

$wp_customize->add_setting('show_symbol2',['default' => true]);
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_symbol2',
    array(
    'label' => __( 'Show Footer Symbol 2', 'ahura' ),
    'type'  =>'checkbox',
    'section' => 'ahura_footer',
    'settings' => 'show_symbol2',
)));

$wp_customize->add_setting('footer_namad1');
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_namad1',
    array(
    'label' => __( 'Footer Symbol 1', 'ahura' ),
    'section' => 'ahura_footer',
    'settings' => 'footer_namad1',
)));

$wp_customize->add_setting('footer_namad1_url',['default' => '#']);
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_namad1_url',
    array(
    'label' => __( 'Footer Symbol 1 Url', 'ahura' ),
    'section' => 'ahura_footer',
    'settings' => 'footer_namad1_url',
    'type'  => 'url'
)));

$wp_customize->add_setting('footer_namad2');
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_namad2',
    array(
    'label' => __( 'Footer Symbol 2', 'ahura' ),
    'section' => 'ahura_footer',
    'settings' => 'footer_namad2',
)));

$wp_customize->add_setting('footer_namad2_url', ['default' => '#']);
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_namad2_url',
    array(
    'label' => __( 'Footer Symbol 2 Url', 'ahura' ),
    'section' => 'ahura_footer',
    'settings' => 'footer_namad2_url',
    'type'  => 'url'
)));