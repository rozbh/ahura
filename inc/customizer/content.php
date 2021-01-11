<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wp_customize->add_section( 'ahuraheader' , array(
      'title'      => __('Header','ahura'),
      'priority'   => 3,
) );

$wp_customize->add_setting('stickyheader', [ 'default' => true ]);
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'stickyheader', array(
    'label' => __('Sticky Header','ahura'),
    'section' => 'ahuraheader',
    'type'    => 'checkbox',
)));

$ahura_headers = \ahura\app\mw_options::get_default_headers();
$wp_customize->add_setting('ahura_default_header', [
    'default' => '2',
    'sanitize_callback' => ['\ahura\app\mw_options', 'sanitize_select_field']
]);
$wp_customize->add_control('ahura_default_header', [
    'label' => __("Default Header", 'ahura'),
    'type' => 'select',
    'section' => 'ahuraheader',
    'choices' => $ahura_headers
]);
$wp_customize->selective_refresh->add_partial('ahura_default_header',[
    'selector' => '.topbar .topbar-main']
);
$wp_customize->add_setting('openmenuinfrontpage');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'openmenuinfrontpage', array(
    'label' => __('Open Menu is Front Page','ahura'),
    'section' => 'ahuraheader',
    'settings' => 'openmenuinfrontpage',
    'default'  => true,
    'type'    => 'checkbox',
    'active_callback' => ['\ahura\app\mw_options', 'check_is_show_mega_menu_in_option']
)));

$wp_customize->add_setting('ahura_mega_menu_title',[
    'default' => __("Category Menu", 'ahura')
]);
$wp_customize->add_control('ahura_mega_menu_title', [
    'label' => __('Mega menu title', 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'check_is_show_mega_menu_in_option']
]);
$wp_customize->selective_refresh->add_partial('ahura_mega_menu_title',[
    'selector' => '.topbar .cats-list-title',
]);
$wp_customize->add_setting('ahura_header_cta_btn_text', [
    'default' => __("Let's Start", 'ahura')
]);
$wp_customize->add_control('ahura_header_cta_btn_text', [
    'label' => __("Button Text", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'check_is_cta_btn_in_show_header'],
]);
$wp_customize->selective_refresh->add_partial('ahura_header_cta_btn_text',[
    'selector' => '.topbar .panel_menu_wrapper .cta_button, .topbar .action-box #action_link'
]);
$wp_customize->add_setting('ahura_header_cta_btn_url', [
    'default' => '#'
]);
$wp_customize->add_control('ahura_header_cta_btn_url', [
    'label' => __("Button Url", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'check_is_cta_btn_in_show_header'],
    'type' => 'url'
]);
$wp_customize->add_setting('ahura_header_is_transparent', ['default' => false]);
$wp_customize->add_control('ahura_header_is_transparent', [
    'type' => 'checkbox',
    'label' => __('Transparent Header', 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'check_is_header_2_active']
]);
$wp_customize->add_setting('ahura_header_transparent_content_color');
$wp_customize->add_control('ahura_header_transparent_content_color', [
    'label' => __("Header content color", 'ahura'),
    'type' => 'color',
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'check_is_transparent_header']
]);
$wp_customize->add_setting('ahorua_transparent_logo');
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ahorua_transparent_logo', [
    'label' => __("Logo in transparent mode", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'check_is_transparent_header'],
    'description' => __( 'Recommended size: 304 X 98px', 'ahura' ),
]));
$wp_customize->add_setting('ahorua_header_mode_4_cta_background', ['default' => '#35495c']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahorua_header_mode_4_cta_background', [
    'label' => __("Button Background", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'header_mode_4_cta_background'],
]));
$wp_customize->add_setting('ahorua_header_mode_4_cta_text_color', ['default' => '#fff']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahorua_header_mode_4_cta_text_color', [
    'label' => __("Button Text Color", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'header_mode_4_cta_background'],
]));
$wp_customize->add_setting('ahorua_header_mode_4_menu_background', ['default' => '#35495c']);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ahorua_header_mode_4_menu_background', [
    'label' => __("Menu Background", 'ahura'),
    'section' => 'ahuraheader',
    'active_callback' => ['\ahura\app\mw_options', 'header_mode_4_cta_background'],
]));
$wp_customize->add_setting('ahorua_header_popup_login', ['default' => true]);
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ahorua_header_popup_login', [
    'label' => __("Show Header Popup Login", 'ahura'),
    'section' => 'ahuraheader',
    'type'  => 'checkbox'
]));
$wp_customize->add_setting('ahorua_show_mini_cart');
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ahorua_show_mini_cart', [
    'label' => __("Show Mini Cart", 'ahura'),
    'section' => 'ahuraheader',
    'type'  => 'checkbox'
]));