<?php
namespace ahura\app;
class mw_hooks
{
    static function init()
    {
        add_action('after_setup_theme', ['\ahura\app\mw_config', 'after_setup_theme']);
        add_action('ahura_check_license', ['\ahura\app\license', 'check_license']);
        add_action('init', ['\ahura\app\mw_post_type', 'init']);
        add_action('init', ['\ahura\app\license', 'init']);
        add_action('add_meta_boxes_testimonial', ['\ahura\app\mw_metabox', 'testimonial_init']);
        add_action('save_post_testimonial', ['\ahura\app\mw_metabox', 'store_testimonial_metabox']);

        add_action('add_meta_boxes_page', ['\ahura\app\mw_metabox', 'pages_init']);
        add_action('admin_print_scripts-post.php', ['\ahura\app\mw_assets', 'load_header_metabox_assets']);
        add_action('admin_print_scripts-post-new.php', ['\ahura\app\mw_assets', 'load_header_metabox_assets']);
        add_action('save_post_page', ['\ahura\app\mw_metabox', 'store_page_metaboxes_data']);

        add_action('woocommerce_before_mini_cart', ['\ahura\app\mw_config', 'before_mini_cart']);
        add_action('woocommerce_after_mini_cart', ['\ahura\app\mw_config', 'after_minicart']);
        add_filter('woocommerce_add_to_cart_fragments', ['\ahura\app\mw_config', 'minicart_fragments']);

        add_action('wp_nav_menu_item_custom_fields', ['\ahura\app\mw_mega_menu', 'add_admin_fields'], 10, 2);
        add_action('wp_update_nav_menu_item', ['\ahura\app\mw_mega_menu', 'update_data'], 10, 3);
        add_action('wp_enqueue_scripts', ['\ahura\app\mw_assets', 'init']);
        add_action('widgets_init', ['\ahura\app\mw_widgets', 'init']);
        add_action('admin_enqueue_scripts', ['\ahura\app\mw_assets', 'load_admin_assets']);

        if(mw_options::get_mod_is_ajax_search())
        {
            add_action('wp_ajax_mw_search_ajax', ['\ahura\app\ajax', 'search_result']);
            add_action('wp_ajax_nopriv_mw_search_ajax', ['\ahura\app\ajax', 'search_result']);
        }

        add_action('elementor/preview/enqueue_styles', ['\ahura\app\mw_assets', 'load_elem_styles']);
        add_action('elementor/editor/after_enqueue_scripts', ['\ahura\app\mw_assets', 'load_elementor_editor_assets']);
        if(woocommerce::is_active())
        {
            add_action('woocommerce_before_shop_loop_item', ['\ahura\app\woocommerce', 'before_shop_loop_item']);
            add_filter('loop_shop_columns', ['\ahura\app\woocommerce', 'loop_shop_columns']);
            add_action('wp_enqueue_scripts', ['\ahura\app\woocommerce', 'load_assets']);
            add_filter('woocommerce_cart_item_thumbnail', ['\ahura\app\woocommerce', 'woocommerce_cart_item_thumbnail'], 10, 3);
            add_filter( 'woocommerce_output_related_products_args', ['\ahura\app\woocommerce', 'related_products_args'], 20 );

            add_action('wp_ajax_nopriv_ahura_update_mini_cart_btn', ['\ahura\app\ajax', 'update_mini_cart_btn']);
            add_action('wp_ajax_ahura_update_mini_cart_btn', ['\ahura\app\ajax', 'update_mini_cart_btn']);
            add_filter('woocommerce_locate_template', ['\ahura\app\mw_config', 'reset_minicart_template_path'], 999, 3);
            //Change number of products displayed per page
            add_filter( 'loop_shop_per_page', ['\ahura\app\woocommerce', 'change_shop_item_count_per_page'], 20 );
        }
        add_action('wp_head', ['\ahura\app\mw_assets', 'load_head_assets']);
    }
}
