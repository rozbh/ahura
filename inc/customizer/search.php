<?php
// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wp_customize->add_section('ahura_search', [
	'title' =>  __("Search Form", "ahura"),
	'description' => __("Search Form Settings", "ahura"),
	'priority'  =>  3
]);

$wp_customize->add_setting('ahura_is_active_ajax_search', ['default' => true]);
$wp_customize->add_control(
	new WP_Customize_Control($wp_customize, 'ahura_ajax_search_control', [
		'label' =>  __("Active ajax search", "ahura"),
		'section' => 'ahura_search',
		'settings' => 'ahura_is_active_ajax_search',
		'type' => 'checkbox',
		'default' => true
	])
);
$wp_customize->selective_refresh->add_partial('ahura_is_active_ajax_search',[
	'selector' => '.header-mode-1 .search-form, .header-mode-3 .search-form, .header-mode-2 .action-box #action_search'
]);