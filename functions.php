<?php

require_once get_parent_theme_file_path( '/wizard/tgmpa.php' );
require_once get_parent_theme_file_path( '/wizard/merlin/vendor/autoload.php' );
require_once get_parent_theme_file_path( '/wizard/merlin/class-merlin.php' );
require_once get_parent_theme_file_path( '/wizard/merlin-config.php' );

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


register_nav_menus(
        array(
            'topmenu' => __('Top Menu','ahura'),
            'mega_menu' => __('Mega Menu', 'ahura')
        )
    );
function rd_topmenu() {
    if(has_nav_menu('topmenu'))
    {
        wp_nav_menu(array(
            'menu' => __('Top Menu','ahura'),
            'theme_location' => 'topmenu',
                'menu_class'      => 'topmenu',
        ));
    }
}
function render_mega_menu()
{
    if(!has_nav_menu('mega_menu'))
    {
        return false;
    }
    if(!class_exists('Mihan_Walker'))
    {
        $mihan_walker_path = get_template_directory() . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'mihan_walker.php';
        require_once $mihan_walker_path;
    }
    $mihan_walker = new Mihan_Walker();
    wp_nav_menu([
        'menu' => __('Mega Menu', 'ahura'),
        'theme_location' => 'mega_menu',
        'walker' => $mihan_walker
    ]);
}

require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/elementor.php';

function wpdocs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );
function custom_excerpt_length( $length ) {
        return 30;
    }
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function ahura_footer_widget() {
	register_sidebar( array(
		'name'          => __('Footer','ahura'),
		'id'            => 'ahura_footer_widget',
		'before_widget' => '<div class="footer-widget col-md-3">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="footer-widget-title">',
		'after_title'   => '</span>',
	) );
}
add_action( 'widgets_init', 'ahura_footer_widget' );

function ahura_rightsidebar_widget() {
	register_sidebar( array(
		'name'          => __('Right Sidebar','ahura'),
		'id'            => 'ahura_rightsidebar_widget',
		'before_widget' => '<div class="sidebar-widget">',
		'after_widget'  => '</div><div class="clear"></div>',
		'before_title'  => '<span class="sidebar-widget-title">',
		'after_title'   => '</span>',
	) );
}
add_action( 'widgets_init', 'ahura_rightsidebar_widget' );

function ahura_leftsidebar_widget() {
	register_sidebar( array(
		'name'          => __('Left Sidebar','ahura'),
		'id'            => 'ahura_leftsidebar_widget',
		'before_widget' => '<div class="sidebar-widget">',
		'after_widget'  => '</div><div class="clear"></div>',
		'before_title'  => '<span class="sidebar-widget-title">',
		'after_title'   => '</span>',
	) );
}
add_action( 'widgets_init', 'ahura_leftsidebar_widget' );

function get_breadcrumb() {
    echo '<a href="'.home_url().'" rel="nofollow">', __('Home','ahura'), '</a>';
    if (is_category() || is_single()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        the_category(' &bull; ');
            if (is_single()) {
                echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
                the_title();
            }
    } elseif (is_page()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo the_title();
    } elseif (is_search()) {
        echo __('Search Results For ','ahura');
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}

function mihanwp_numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );

	echo '</ul></div>' . "\n";

}

add_action( 'set_comment_cookies', function( $comment, $user ) {
    setcookie( 'ta_comment_wait_approval', '1', 0, '/' );
}, 10, 2 );

add_action( 'init', function() {
    if( isset( $_COOKIE['ta_comment_wait_approval'] ) && $_COOKIE['ta_comment_wait_approval'] === '1' ) {
        setcookie( 'ta_comment_wait_approval', '0', 0, '/' );
        add_action( 'comment_form_before', function() {
            echo "<p id='wait_approval'><strong>";
            echo __('Your Comment has been sent successfully.','ahura');
            echo '</strong></p>';
        });
    }
});

add_filter( 'comment_post_redirect', function( $location, $comment ) {
    $location = get_permalink( $comment->comment_post_ID ) . '#wait_approval';
    return $location;
}, 10, 2 );


function ahura_modify_comment_fields($fields){
  $req = null;
  $aria_req = null;
  $commenter = null;
	$fields =  array(

	  'author' =>
	    '<p class="comment-form-author"><label for="author">' . __( 'Name (Required)', 'ahura' ) .
	    ( $req ? '' : '' ) . '</label>' .
	    '<input required oninvalid="this.setCustomValidity(\'?\')" oninput="setCustomValidity(\'\')" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
	    '" size="30"' . $aria_req . ' /></p>',

	  'email' =>
	    '<p class="comment-form-email"><label for="email">' . __( 'Email (Required)', 'ahura' ) .
	    ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
	    '<input required oninvalid="this.setCustomValidity(\'?\')" oninput="setCustomValidity(\'\')" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
	    '" size="30"' . $aria_req . ' /></p>',

	  'url' =>
	    '<p class="comment-form-url"><label for="url">' . __( 'Website', 'ahura' ) . '</label>' .
	    '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
	    '" size="30" /></p>',
	);
    return $fields;
}
add_filter('comment_form_default_fields','ahura_modify_comment_fields');

// Add iransans font to wordpress admin panel
function mihanwp_custom_css() {
  echo '<style>
  @font-face {
  	font-family: IRANSans;
  	font-style: normal;
  	font-weight: 900;
  	font-display: swap;
  	src: url(../wp-content/themes/ahura/fonts/eot/IRANSansWeb_Black.eot);
  	src: url(../wp-content/themes/ahura/fonts/eot/IRANSansWeb_Black.eot?#iefix) format("embedded-opentype"), url(../wp-content/themes/ahura/fonts/woff2/IRANSansWeb_Black.woff2) format("woff2"), url(../wp-content/themes/ahura/fonts/woff/IRANSansWeb_Black.woff) format("woff"), url(../wp-content/themes/ahura/fonts/ttf/IRANSansWeb_Black.ttf) format("truetype")
  }

  @font-face {
  	font-family: IRANSans;
  	font-style: normal;
  	font-weight: 700;
  	font-display: swap;
  	src: url(../wp-content/themes/ahura/fonts/eot/IRANSansWeb_Bold.eot);
  	src: url(../wp-content/themes/ahura/fonts/eot/IRANSansWeb_Bold.eot?#iefix) format("embedded-opentype"), url(../wp-content/themes/ahura/fonts/woff2/IRANSansWeb_Bold.woff2) format("woff2"), url(../wp-content/themes/ahura/fonts/woff/IRANSansWeb_Bold.woff) format("woff"), url(../wp-content/themes/ahura/fonts/ttf/IRANSansWeb_Bold.ttf) format("truetype")
  }

  @font-face {
  	font-family: IRANSans;
  	font-style: normal;
  	font-display: swap;
  	font-weight: 500;
  	src: url(../wp-content/themes/ahura/fonts/eot/IRANSansWeb_Medium.eot);
  	src: url(../wp-content/themes/ahura/fonts/eot/IRANSansWeb_Medium.eot?#iefix) format("embedded-opentype"), url(../wp-content/themes/ahura/fonts/woff2/IRANSansWeb_Medium.woff2) format("woff2"), url(../wp-content/themes/ahura/fonts/woff/IRANSansWeb_Medium.woff) format("woff"), url(../wp-content/themes/ahura/fonts/ttf/IRANSansWeb_Medium.ttf) format("truetype")
  }

  @font-face {
  	font-family: IRANSans;
  	font-style: normal;
  	font-display: swap;
  	font-weight: 300;
  	src: url(../wp-content/themes/ahura/fonts/eot/IRANSansWeb_Light.eot);
  	src: url(../wp-content/themes/ahura/fonts/eot/IRANSansWeb_Light.eot?#iefix) format("embedded-opentype"), url(../wp-content/themes/ahura/fonts/woff2/IRANSansWeb_Light.woff2) format("woff2"), url(../wp-content/themes/ahura/fonts/woff/IRANSansWeb_Light.woff) format("woff"), url(../wp-content/themes/ahura/fonts/ttf/IRANSansWeb_Light.ttf) format("truetype")
  }

  @font-face {
  	font-family: IRANSans;
  	font-style: normal;
  	font-weight: 200;
  	font-display: swap;
  	src: url(../wp-content/themes/ahura/fonts/eot/IRANSansWeb_UltraLight.eot);
  	src: url(../wp-content/themes/ahura/fonts/eot/IRANSansWeb_UltraLight.eot?#iefix) format("embedded-opentype"), url(../wp-content/themes/ahura/fonts/woff2/IRANSansWeb_UltraLight.woff2) format("woff2"), url(../wp-content/themes/ahura/fonts/woff/IRANSansWeb_UltraLight.woff) format("woff"), url(../wp-content/themes/ahura/fonts/ttf/IRANSansWeb_UltraLight.ttf) format("truetype")
  }

  @font-face {
  	font-family: IRANSans;
  	font-style: normal;
  	font-weight: 400;
  	font-display: swap;
  	src: url(../wp-content/themes/ahura/fonts/eot/IRANSansWeb.eot);
  	src: url(../wp-content/themes/ahura/fonts/eot/IRANSansWeb.eot?#iefix) format("embedded-opentype"), url(../wp-content/themes/ahura/fonts/woff2/IRANSansWeb.woff2) format("woff2"), url(../wp-content/themes/ahura/fonts/woff/IRANSansWeb.woff) format("woff"), url(../wp-content/themes/ahura/fonts/ttf/IRANSansWeb.ttf) format("truetype")
  }
  body,a,h1,h2,h3,h5,h6,h4,span,td,tr,input,p,textarea,.rtl h1, .rtl h2, .rtl h3, .rtl h4, .rtl h5, .rtl h6,.editor-post-title__block .editor-post-title__input{
    font-family:IRANSans;
  }

  </style>';
}
add_action('admin_head', 'mihanwp_custom_css');

function ahura_add_settings_menu() {
    add_menu_page(
        __( 'Theme Settings', 'ahura' ),
        __( 'Theme Settings', 'ahura' ),
        'manage_options',
        'customize.php',
        '',
        get_template_directory_uri() . '/img/mihanwp.png'
    );
}
add_action( 'admin_menu', 'ahura_add_settings_menu' );

function ahura_admin_css() {
  echo '
  <style>
    .wp-menu-image img{
      width:20px;
      height:20px;
    }
  </style>
  ';
}
add_action('admin_head', 'ahura_admin_css');

require_once get_template_directory() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'app.php';

function add_font_to_wp_customize(){
	echo '
		<style>
			*{
				font-family:IRANYekan !important;
			 }
			 .dashicons, .dashicons-before:before{
				font-family: dashicons !important;
			 }
		</style>
	';
}
add_action('customize_controls_head','add_font_to_wp_customize');
function headerpopup(){
	if ( class_exists( 'woocommerce' ) ) {
		echo '<div class="header-popup-login-form">';
		woocommerce_login_form();
		echo '</div>';
	} 
	else
	 {
		echo '<div class="header-popup-login-form">';
		wp_login_form();
		echo '</div>';
}
}