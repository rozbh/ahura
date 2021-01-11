<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


final class MihanWP_ahura_Elementor {
 const VERSION = '1';
 const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
 const MINIMUM_PHP_VERSION = '7.0';
 private static $_instance = null;
 public static function instance() {

   if ( is_null( self::$_instance ) ) {
     self::$_instance = new self();
   }
   return self::$_instance;

 }
 public function __construct() {

   add_action( 'init', [ $this, 'init' ] );

 }

 public function init() {
   add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
 }
 public function admin_notice_minimum_elementor_version() {

   if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

   $message = sprintf(
     esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'ahura' ),
     '<strong>' . esc_html__( 'ahura Elementor', 'ahura' ) . '</strong>',
     '<strong>' . esc_html__( 'Elementor', 'ahura' ) . '</strong>',
      self::MINIMUM_ELEMENTOR_VERSION
   );

   printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

 }
 public function admin_notice_minimum_php_version() {

   if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

   $message = sprintf(
     esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'ahura' ),
     '<strong>' . esc_html__( 'ahura Elementor', 'ahura' ) . '</strong>',
     '<strong>' . esc_html__( 'PHP', 'ahura' ) . '</strong>',
      self::MINIMUM_PHP_VERSION
   );

   printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

 }
 public function init_widgets() {
   require_once( __DIR__ . '/widgets/grid-posts.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Grid_Posts() );

   require_once( __DIR__ . '/widgets/grid-posts2.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Grid_Posts2() );

   require_once( __DIR__ . '/widgets/grid-posts3.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Grid_Posts3() );

   require_once( __DIR__ . '/widgets/grid-posts4.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Grid_Posts4() );

   require_once( __DIR__ . '/widgets/blog-box.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Blog_Box_Posts() );

   require_once( __DIR__ . '/widgets/blog-box-2.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Blog_Box_Posts2() );

   require_once( __DIR__ . '/widgets/post-archive.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Post_Archive() );

   require_once( __DIR__ . '/widgets/posts-carousel.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Post_Carousel() );

   require_once( __DIR__ . '/widgets/posts-carousel-2.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Post_Carousel2() );

   require_once( __DIR__ . '/widgets/posts-carousel-3.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Post_Carousel3() );

      require_once( __DIR__ . '/widgets/post-list.php' );
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Post_list() );

      require_once( __DIR__ . '/widgets/post-list-2.php' );
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Post_list2() );



   require_once( __DIR__ . '/widgets/shop-carousel.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_shop_Carousel() );

   require_once( __DIR__ . '/widgets/shop-category.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_shop_category() );

   require_once( __DIR__ . '/widgets/shop-category1.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_shop_category1() );

   require_once( __DIR__ . '/widgets/iconbox.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_iconbox() );

   require_once( __DIR__ . '/widgets/imgbox.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_imgbox() );

   require_once( __DIR__ . '/widgets/imgbox2.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_imgbox2() );

   require_once( __DIR__ . '/widgets/shop-countdown.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_mwcountdown() );

  require_once( __DIR__ . '/widgets/count-down.php' );
  \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_countdown() );

   require_once( __DIR__ . '/widgets/search.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_search_input() );

   require_once( __DIR__ . '/widgets/services-box.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_services_box() );

   require_once( __DIR__ . '/widgets/services-box2.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_services_box2() );

   require_once( __DIR__ . '/widgets/services-box3.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_services_box3() );

   require_once( __DIR__ . '/widgets/service-price-box.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_service_price_box() );

   require_once( __DIR__ . '/widgets/circular-box.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Circular_Box() );

   require_once( __DIR__ . '/widgets/testimonial-box1.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_testimonial_box1() );
   require_once( __DIR__ . '/widgets/testimonial-box2.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_testimonial_box2() );

   require_once( __DIR__ . '/widgets/banner-box1.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_banner_box1() );
   require_once( __DIR__ . '/widgets/notice.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_notice() );

   require_once( __DIR__ . '/widgets/typewriter.php' );
   \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_typewriter() );

 }

}

MihanWP_ahura_Elementor::instance();


function add_elementorahura_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'ahuraelements',
		[
			'title' => __( 'Ahura Elements', 'ahura' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'add_elementorahura_widget_categories' );
