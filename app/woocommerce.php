<?php
namespace ahura\app;
class woocommerce
{
    static function is_active()
    {
        return class_exists('WooCommerce');
    }
    static function is_woocommerce_page()
    {
        return self::is_active() && (is_woocommerce() || is_cart() || is_checkout() || is_account_page());
    }
    static function before_shop_loop_item()
    {
        $terms = wp_get_post_terms(get_the_ID(), 'product_cat', ['fields' => 'names', 'number' => 5]);
        $term_data = '<span class="mw_term_data">';
        foreach ($terms as $term_name) {
            $term_data .= '<span class="mw_term_item">'.$term_name.'</span>';
        }
        $term_data .= '</span>';
        echo '<span class="mw_overly"></span>';
        echo $term_data;
    }
    static function loop_shop_columns()
    {
        return 3;
    }
    static function load_assets()
    {
        if(self::is_woocommerce_page())
        {
            $version = \ahura\app\mw_tools::get_theme_version();

            if(is_cart() || is_product())
            {
                $woocommerce_js = get_template_directory_uri() . '/js/woocommerce.js';
                // woocommerce.js
                wp_enqueue_script('mw_woocommerce', $woocommerce_js, ['jquery'], $version, true);
            }
            
            // woocommerce.css
            wp_enqueue_style('mw_woocommerce', get_template_directory_uri() . '/css/woocommerce.css', null, $version);
            if(is_cart() || is_checkout())
            {
                $btn_style = '.woocommerce .button.alt{ background-color: var(--mw_primary_color) !important; color: #222 !important; }';
                wp_add_inline_style('style', $btn_style);
            }
        }
    }
    static function woocommerce_cart_item_thumbnail($thumbnail, $cart_item, $cart_item_key){
        $cart_image_id = $cart_item['data']->get_image_id();
        $image = wp_get_attachment_image($cart_image_id, 'thumbnail');
        return $image;
    }
    static function related_products_args($args)
    {
        $args['posts_per_page'] = 3;
        $args['columns'] = 3;
        return $args;
    }
    static function change_shop_item_count_per_page( $cols ) {
        // $cols contains the current number of products per page based on the value stored on Options –> Reading
        // Return the number of products you wanna show per page.
        $cols = get_theme_mod('ahura_shop_per_page', 9);
        return $cols;
    }
}