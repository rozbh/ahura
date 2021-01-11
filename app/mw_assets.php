<?php
namespace ahura\app;
class mw_assets
{
    static function init()
    {
        $version = mw_tools::get_theme_version();
        wp_enqueue_style( 'style', get_stylesheet_uri() , array(), $version);
        function is_elementor(){
            global $post;
            return \Elementor\Plugin::$instance->db->is_built_with_elementor($post->ID);
          }
        if( !is_elementor() ) {
            wp_enqueue_style( 'all', get_template_directory_uri() . '/css/all.css', array(), $version);
        }
        wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array(), $version);
        wp_enqueue_style( 'flipclock', get_template_directory_uri() . '/css/flip-clock.css', array(), $version);
        wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), $version);
        wp_enqueue_script('ahura_carousel_min', get_template_directory_uri(). '/js/owl.carousel.min.js' , ['jquery'], $version , true);
        wp_enqueue_script('modaljs', get_template_directory_uri(). '/js/jquery.modal.min.js' , ['jquery'], $version , true);
        wp_enqueue_script('ahura_carousel', get_template_directory_uri(). '/js/carousel.js' , ['jquery'], $version , true);
        wp_enqueue_script('menujs', get_template_directory_uri(). '/js/menu.js' , ['jquery'], $version , true);
        wp_enqueue_script('typewriter', get_template_directory_uri(). '/js/typewriter.js' , $version , false);
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
        if(\ahura\app\mw_options::get_mod_is_ajax_search())
        {
            wp_enqueue_script('mw_ajax_search', get_template_directory_uri() . '/js/ajax_search.js', ['jquery'], $version, true);
            wp_localize_script('mw_ajax_search', 'ahura_data', ['au' => admin_url('admin-ajax.php')]);
        }
        self::load_font_assets();
        if(mw_options::get_mod_is_stickyheader())
        {
            self::load_sticky_header();
        }
    }
    static function load_head_assets()
    {
        require_once get_template_directory() . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'css.php';
        require_once get_template_directory() . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'dark.php';
    }
    static function load_sticky_header()
    {
        $sticky_header = get_template_directory_uri() . '/js/sticky-header.js';
        $version = mw_tools::get_theme_version();
        wp_enqueue_script('ahura_sticky_header', $sticky_header, ['jquery'], $version, true);
    }
    static function load_admin_assets($hook_suffix)
    {
        self::load_widgets_management_assets($hook_suffix);
        self::load_nav_menus_assets($hook_suffix);
    }
    static function load_font_assets()
    {
        $theme_font = \ahura\app\mw_options::get_mod_theme_font();
        $font_url = '';
        switch($theme_font)
        {
            case 'iransans':
                $font_url = get_template_directory_uri() . '/css/fonts/iransans.css';
            break;
            case 'iranyekan':
                $font_url = get_template_directory_uri() . '/css/fonts/iranyekan.css';
            break;
        }
        if(!$font_url)
        {
            return false;
        }
        $version = \ahura\app\mw_tools::get_theme_version();
        wp_enqueue_style('ahura_font', $font_url, null, $version);
    }
    static function load_widgets_management_assets($hook_suffix)
    {
        if($hook_suffix !== 'widgets.php')
        {
            return false;
        }
        $version = \ahura\app\mw_tools::get_theme_version();
        $admin_widget_js = get_template_directory_uri() . '/js/admin_widgets.js';
        self::load_media_uploader();
        wp_enqueue_script('ahura_widget_manage', $admin_widget_js, ['jquery'], $version, true);
    }
    static function load_media_uploader()
    {
        wp_enqueue_media();
    }
    static function load_elementor_editor_assets()
    {
        $elementor = get_template_directory_uri() .'/css/fonts/elementor.css';
        wp_enqueue_style('ahura_elementor_style', $elementor);
    }
    static function load_woocommerce_mini_cart()
    {
        if(woocommerce::is_active())
        {
            $cart_js = get_template_directory_uri() . '/js/cart.js';
            $version = \ahura\app\mw_tools::get_theme_version();
            wp_enqueue_script('ahura_cart', $cart_js, ['jquery'], $version, true);
            wp_localize_script('ahura_cart', 'ahura_cart', ['au' => admin_url('admin-ajax.php')]);
        }
    }
    static function load_header_metabox_assets()
    {
        $post_type = get_post_type();
        if($post_type !== 'page')
        {
            return false;
        }
        $version = mw_tools::get_theme_version();
        $header_js = get_template_directory_uri() . '/js/metabox_header.js';
        wp_enqueue_script('ahura_metabox_header', $header_js, ['jquery'], $version, true);
    }
    static function load_nav_menus_assets($hook_suffix)
    {
        if($hook_suffix !== 'nav-menus.php')
        {
            return false;
        }
        self::load_media_uploader();
        $media_uploader =get_template_directory_uri() . '/js/mw_uploader.js';
        wp_enqueue_script('mw_nav_media_uploader', $media_uploader, ['jquery'], mw_tools::get_theme_version(), true);
    }
    static function load_elem_styles()
    {
        $elem = get_template_directory_uri() . '/css/elem.css';
        wp_enqueue_style('mw_elem', $elem, null, mw_tools::get_theme_version());
    }
}
