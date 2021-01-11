<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function ahura_import_files() {
	return array(
		array(
			'import_file_name'           => 'Classic',
			'categories'                 => array( 'Main' ),
			'import_file_url'            => 'https://mihanwp.com/demoimport/ahura/main.xml',
			'import_widget_file_url'     => 'https://mihanwp.com/demoimport/ahura/widgets.wie',
			'import_customizer_file_url' => 'https://mihanwp.com/demoimport/ahura/customizer.json',
			'import_preview_image_url'   => 'https://cdn.mihanwp.com/2019/12/ahura.jpg',
			'import_notice'              => __( 'Ready for a New Era?', 'ahura' ),
			'preview_url'                => 'http://demo.mihanwp.com/ahura/',
		)
	);
}
add_filter( 'pt-ocdi/import_files', 'ahura_import_files' );


function ahura_after_import_setup() {
	$main_menu = get_term_by( 'name', 'main', 'nav_menu' );
	$top_menu = get_term_by( 'name', 'منو بالایی', 'nav_menu' );
	set_theme_mod( 'nav_menu_locations', array(
			'topmenu' => $top_menu->term_id,
			'mega_menu' => $main_menu->term_id,
		)
	);
	$front_page_id = get_page_by_title( 'خانه' );
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'elementor_container_width', '1280' );
	update_option( 'elementor_default_generic_fonts', 'IRANSans' );
	update_option( 'elementor_disable_typography_schemes', 'yes' );
}
add_action( 'pt-ocdi/after_import', 'ahura_after_import_setup' );