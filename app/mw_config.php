<?php
namespace ahura\app;
class mw_config
{
    static function before_mini_cart()
    {
        echo '<div id="mcart-widget" class="mini-cart-header-content">';
    }
    static function after_minicart()
    {
        echo '</div>';
    }
    static function minicart_fragments()
    {
        ob_start();
        woocommerce_mini_cart();
        $fragments['#mcart-widget'] = ob_get_clean();
        return $fragments;
    }
    static function image_sizes()
    {
        add_image_size('stthumb',600,350, true);
        add_image_size('sqthumb',250,250, true);
        add_image_size('verthumb',500,600, true);
        add_image_size('smthumb',100,100, true);
    }
    static function after_setup_theme()
    {
        self::load_text_domain();
        self::theme_support();
        self::image_sizes();
        self::init_check_license_process();
    }
    static function load_text_domain()
    {
        load_theme_textdomain( 'ahura', get_template_directory() . '/languages' );
    }
    static function theme_support()
    {
        add_theme_support('title-tag');
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'woocommerce', array(
            'thumbnail_image_width' => 300,
            'single_image_width'    => 600,
            'product_grid'          => array(
                'default_rows'    => 4,
                'min_rows'        => 2,
                'max_rows'        => 8,
                'default_columns' => 3,
                'min_columns'     => 2,
                'max_columns'     => 3,
            ),
        ) );
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
    }
    static function reset_minicart_template_path($template, $template_name, $template_path)
    {
        if($template_name !== 'cart/mini-cart.php')
        {
            return $template;
        }
        $woocommerce_path = WC()->plugin_path();
        $default_path = $woocommerce_path . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR;
        // check is mini cart exists in theme
        $mini_cart_template = locate_template(
            [
                trailingslashit($template_path) . $template_name,
                $template_name
            ]
        );
        if(!$mini_cart_template)
        {
            $mini_cart_template = $default_path . $template_name;
        }
        return $mini_cart_template;
    }
    static function init_check_license_process()
    {
        if(!wp_next_scheduled('ahura_check_license'))
        {
            $hour = mt_rand(0, 23);
            $minute = mt_rand(0, 59);
            $second = mt_rand(0, 59);
            $time = strtotime("Y-m-d {$hour}:{$minute}:{$second}", strtotime('+1 day'));
            wp_schedule_event($time, 'daily', 'ahura_check_license');
        }
    }
}