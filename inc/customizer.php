<?php
// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


function mw_theme_new_customizer_settings($wp_customize) {

require get_template_directory() . '/inc/customizer/style.php';
require get_template_directory() . '/inc/customizer/search.php';
require get_template_directory() . '/inc/customizer/content.php';
require get_template_directory() . '/inc/customizer/archive.php';
require get_template_directory() . '/inc/customizer/footer.php';
require get_template_directory() . '/inc/customizer/post.php';
require get_template_directory() . '/inc/customizer/layout.php';
require get_template_directory() . '/inc/customizer/shop.php';
require get_template_directory() . '/inc/customizer/typography.php';
}
add_action('customize_register', 'mw_theme_new_customizer_settings');
