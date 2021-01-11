<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wp_customize->add_section( 'ahura_logo' , array(
      'title'      => __('Logo & Style','ahura'),
      'priority'   => 1,
));
$wp_customize->add_setting('ahura_theme_logo');
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ahura_theme_logo',
array(
'label' => __( 'Your Logo', 'ahura' ),
'section' => 'ahura_logo',
'settings' => 'ahura_theme_logo',
'description' => __( 'Recommended size: 304 X 98px', 'ahura' ),
) ) );
$wp_customize->get_setting( 'ahura_theme_logo' )->transport   = 'postMessage';
$wp_customize->selective_refresh->add_partial( 'ahura_theme_logo', array(
            'selector' => '.logo',
            'render_callback' => '__return_false',
) );

$wp_customize->add_setting('theme_dark');
$wp_customize->add_control(
	new WP_Customize_Control(
	$wp_customize, 'theme_dark', array(
		'label'      => __( 'Dark Mode', 'ahura' ),
		'section'    => 'ahura_logo',
		'settings'   => 'theme_dark',
    'type' => 'checkbox',
	) )
);
$wp_customize->add_setting('bgcolor');
$wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize, 'bgcolor', array(
		'label'      => __( 'Background Color', 'ahura' ),
		'section'    => 'ahura_logo',
		'settings'   => 'bgcolor',
	) )
);
$wp_customize->add_setting('themecolor', ['default' => '#00b0ff']);
$wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize, 'themecolor', array(
		'label'      => __( 'Main Color', 'ahura' ),
		'section'    => 'ahura_logo',
		'settings'   => 'themecolor',
	) )
);
$wp_customize->selective_refresh->add_partial('themecolor',[
	'selector' => '.header-mode-1 .cats-list.isnotfront'
]);
$wp_customize->add_setting('ahura_secondary_color',[
    'default' => '#fff'
]);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'ahura_secondary_color',
        [
            'label' => __('Secondary Color', 'ahura'),
            'section' => 'ahura_logo'
        ]
    )
);
$wp_customize->add_setting('ahura_mini_cart_bg_color', ['default' => '#2aba5f']);
$wp_customize->add_control(new WP_Customize_Color_Control(
	$wp_customize,
	'ahura_mini_cart_bg_color',
	[
		'section' => 'ahura_logo',
		'label' => __("Cart Background Color", 'ahura'),
		'active_callback' => ['\ahura\app\mw_options', 'check_is_show_mini_cart_option']
	]
	));
$wp_customize->add_setting('ahura_mini_cart_color', ['default' => '#fff']);
$wp_customize->add_control(new WP_Customize_Color_Control(
	$wp_customize,
	'ahura_mini_cart_color',
	[
		'section' => 'ahura_logo',
		'label' => __("Cart Color", 'ahura'),
		'active_callback' => ['\ahura\app\mw_options', 'check_is_show_mini_cart_option']
	]
));
$wp_customize->selective_refresh->add_partial(
	'ahura_mini_cart_bg_color',
	[
		'selector' => '.header-mode-1 .mini-cart-header'
	]
);

$wp_customize->add_setting('ahura_border_sidebar_title_color',array(
  'default' => '#35495c',
));
$wp_customize->add_control(
  new WP_Customize_Color_Control( $wp_customize, 'ahura_border_sidebar_title_color',array(
    'label' => __('Border right sidebar title color','ahura'),
    'section' => 'ahura_logo',
    'setting' => 'ahura_border_sidebar_title_color',
  ) )
);

$wp_customize->add_setting('ahura_background_selctor_color',array(
  'default' => '#3390ff'
));
$wp_customize->add_control(
  new WP_Customize_Color_Control( $wp_customize, 'ahura_background_selctor_color',array(
    'label' => __('Background selection color','ahura'),
    'section' => 'ahura_logo',
    'setting' => 'ahura_background_selctor_color',
  ) )
);

$wp_customize->add_setting('ahura_background_selctor_text_color',array(
  'default' => '#ffffff'
));
$wp_customize->add_control(
  new WP_Customize_Color_Control( $wp_customize, 'ahura_background_selctor_text_color',array(
    'label' => __('Background selection text color','ahura'),
    'section' => 'ahura_logo',
    'setting' => 'ahura_background_selctor_text_color',
  ) )
);

$wp_customize->add_setting('ahura_content_radius',array(
  'default' => 10,
));
$wp_customize->add_control(
  new WP_Customize_Control( $wp_customize, 'ahura_content_radius',array(
    'label' => __('Content border radius','ahura'),
    'type' => 'number',
    'description' => __('Default 10px','ahura'),
    'section' => 'ahura_logo',
    'input_attrs' => array(
      'min' => 0,
      'max' => 100,
    ),
    'setting' => 'ahura_content_radius',
  ) )
);

$wp_customize->add_setting('ahura_sidebar_widget_radius',array(
  'default' => 10,
));
$wp_customize->add_control(
  new WP_Customize_Control( $wp_customize, 'ahura_sidebar_widget_radius',array(
    'label' => __('Widget box border radius','ahura'),
    'type' => 'number',
    'description' => __('Default 10px','ahura'),
    'section' => 'ahura_logo',
    'input_attrs' => array(
      'min' => 0,
      'max' => 100,
    ),
    'setting' => 'ahura_sidebar_widget_radius',
  ) )
);

$wp_customize->add_setting('ahura_cta_widget_radius',array(
  'default' => 50,
));
$wp_customize->add_control(
  new WP_Customize_Control( $wp_customize, 'ahura_cta_widget_radius',array(
    'label' => __('Header button border radius','ahura'),
    'type' => 'number',
    'description' => __('Default 50px','ahura'),
    'section' => 'ahura_logo',
    'input_attrs' => array(
      'min' => 0,
      'max' => 100,
    ),
    'setting' => 'ahura_cta_widget_radius',
  ) )
);

$wp_customize->add_setting('ahura_gototop_widget_radius',array(
  'default' => 5,
));
$wp_customize->add_control(
  new WP_Customize_Control( $wp_customize, 'ahura_gototop_widget_radius',array(
    'label' => __('Got to top border radius','ahura'),
    'type' => 'number',
    'description' => __('Default 5px','ahura'),
    'section' => 'ahura_logo',
    'input_attrs' => array(
      'min' => 0,
      'max' => 100,
    ),
    'setting' => 'ahura_gototop_widget_radius',
  ) )
);
