<?php
namespace ahura\app;
class mw_options
{
    static $_tesimonial_username_option_name = 'ahura_testimonial_username';
    static $_tst_user_sitename = 'ahura_testimonial_sitename';
    static $_page_header_mode_option_name = 'ahura_page_header_mode';
    static $_page_is_sticky_header = 'ahura_page_is_sticky_header';
    static $_page_is_transparent_header = 'ahura_page_is_transparent_header';
    private static $_page_breadcrumb = 'ahura_page_breadcrumb';
    static function get_default_headers()
    {
        return [
            '1' =>  __("Header 1", 'ahura'),
            '2' =>  __("Header 2", 'ahura'),
            '3' =>  __("Header 3", 'ahura'),
            '4' =>  __('Header 4', 'ahura')
        ];
    }
    static function set_testimonial_username($pid, $value)
    {
        return update_post_meta($pid, self::$_tesimonial_username_option_name, $value);
    }
    static function get_testimonial_username($pid)
    {
        return get_post_meta($pid, self::$_tesimonial_username_option_name, true);
    }
    static function remove_testimonial_username($pid)
    {
        return delete_post_meta($pid, self::$_tesimonial_username_option_name);
    }

    static function set_testimonial_sitename($pid, $value)
    {
        return update_post_meta($pid, self::$_tst_user_sitename, $value);
    }
    static function get_testimonial_sitename($pid)
    {
        return get_post_meta($pid, self::$_tst_user_sitename, true);
    }
    static function remove_testimonial_sitename($pid)
    {
        return delete_post_meta($pid, self::$_tst_user_sitename);
    }
    static function set_page_header_mode($pid, $value)
    {
        return update_post_meta($pid, self::$_page_header_mode_option_name, $value);
    }
    static function get_page_header_mode($pid)
    {
        return get_post_meta($pid, self::$_page_header_mode_option_name, true);
    }
    static function remove_page_header_mode($pid)
    {
        return delete_post_meta($pid, self::$_page_header_mode_option_name);
    }
    static function set_page_is_sticky_header($pid)
    {
        return update_post_meta($pid, self::$_page_is_sticky_header, 1);
    }
    static function get_page_is_sticky_header($pid)
    {
        return get_post_meta($pid, self::$_page_is_sticky_header, true);
    }
    static function remove_page_is_sticky_header($pid)
    {
        return delete_post_meta($pid, self::$_page_is_sticky_header);
    }
    static function set_page_is_transparent_header($pid)
    {
        return update_post_meta($pid, self::$_page_is_transparent_header, 1);
    }
    static function get_page_is_transparent_header($pid)
    {
        return get_post_meta($pid, self::$_page_is_transparent_header, true);
    }
    static function remove_page_is_transparent_header($pid)
    {
        return delete_post_meta($pid, self::$_page_is_transparent_header);
    }
    static function set_page_show_breadcrumb($pid)
    {
        return update_post_meta($pid, self::$_page_breadcrumb, 'show');
    }
    static function set_page_hide_breadcrumb($pid)
    {
        return update_post_meta($pid, self::$_page_breadcrumb, 'hide');
    }
    static function get_page_breadcrumb_status($pid)
    {
        return get_post_meta($pid, self::$_page_breadcrumb, true);
    }
    static function remove_page_show_breadcrumb($pid)
    {
        return delete_post_meta($pid, self::$_page_breadcrumb);
    }
    static function get_mod_header_mode()
    {
        return get_theme_mod('ahura_default_header', '2');
    }
    static function get_mod_theme_logo()
    {
        $logo = get_theme_mod('ahura_theme_logo');
        if(!$logo)
        {
            $logo = get_template_directory_uri() . '/img/ahura-logo.png';
        }
        return $logo;
    }
    static function get_mod_is_ajax_search()
    {
        return get_theme_mod('ahura_is_active_ajax_search', true);
    }
    static function get_page_header(&$pid = false)
    {
        if(is_customize_preview() || !is_page() || is_front_page())
        {
            return false;
        }
        $pid = get_the_ID();
        $header_mode = self::get_page_header_mode($pid);
        return $header_mode ? mw_tools::validate_header_mode($header_mode) : false;
    }
    static function page_has_breadcsrumb()
    {
        if(!is_page() || is_front_page())
        {
            return get_theme_mod('show_breadcrumb');
        }
        $pid = get_the_ID();
        $breadcrumb = self::get_page_breadcrumb_status($pid);
        if(!$breadcrumb)
        {
            // return setting value
            return get_theme_mod('show_breadcrumb');
        }
        return $breadcrumb == 'show' ? true : false;
    }
    static function get_mod_is_stickyheader()
    {
        $page_header = self::get_page_header($pid);
        if($page_header)
        {
            // check is sticky from metabox option
            return self::get_page_is_sticky_header($pid);
        }
        return get_theme_mod('stickyheader', true);
    }
    static function get_mod_header_cta_btn_text()
    {
        return get_theme_mod('ahura_header_cta_btn_text', __("Let's Start", 'ahura'));
    }
    static function get_mod_header_cta_btn_url()
    {
        return get_theme_mod('ahura_header_cta_btn_url');
    }
    static function get_mod_header_cats_menu_title()
    {
        return get_theme_mod('ahura_mega_menu_title', __("Category Menu", 'ahura'));
    }
    static function get_mod_bg_color()
    {
        return get_theme_mod('bgcolor', 'white');
    }
    static function get_mod_theme_color()
    {
        return get_theme_mod('themecolor', '#00b0ff');
    }
    static function get_mod_secondary_color()
    {
        return get_theme_mod('ahura_secondary_color', 'white');
    }
    static function get_mod_theme_font()
    {
        return get_theme_mod('ahura_theme_font', 'iranyekan');
    }
    static function get_mod_transparent_header_content_color()
    {
        return get_theme_mod('ahura_header_transparent_content_color');
    }
    static function get_mod_ahorua_transparent_logo()
    {
        return get_theme_mod('ahorua_transparent_logo');
    }
    static function get_mod_theme_columns()
    {
        return get_theme_mod('ahura_columns', '2c');
    }
    static function get_mod_shop_columns()
    {
        return get_theme_mod('ahura_shop_columns', '2c');
    }
    static function get_mod_goto_top_btn_position()
    {
        return get_theme_mod('ahura_goto_top_position', 'right');
    }
    static function get_mod_is_justify_paragraph()
    {
        return get_theme_mod('ahura_paragraph_alignment', true);
    }
    static function check_is_cta_btn_in_show_header()
    {
        // check is header 1 or header 2 active
        $header_mode = self::get_mod_header_mode();
        return $header_mode == 2 || $header_mode == 3 || $header_mode ==4;
    }
    static function check_is_show_mega_menu_in_option()
    {
        // check is header 1 or header 3 active
        $header_mode = self::get_mod_header_mode();
        return $header_mode == 1 || $header_mode == 3;
    }
    static function check_is_show_mini_cart_option()
    {
        return woocommerce::is_active() && self::check_is_header_1_active();
    }
    static function check_is_header_1_active()
    {
        $header_mode = self::get_mod_header_mode();
        return $header_mode == 1;
    }
    static function check_is_header_2_active()
    {
        $header_mode = self::get_mod_header_mode();
        return $header_mode == 2;
    }
    static function check_is_transparent_header()
    {
        if(!is_customize_preview())
        {
            $page_header = self::get_page_header($pid);
            if($page_header && $page_header == 2)
            {
                $is_transparent = self::get_page_is_transparent_header($pid);
                return $is_transparent ? $is_transparent : false;
            }
        }
        return self::check_is_header_2_active() && get_theme_mod('ahura_header_is_transparent');
    }
    static function check_has_footer_bg()
    {
        $option = get_theme_mod('ahura_footer_bg');
        return $option ? true : false;
    }
    static function header_mode_4_cta_background()
    {
        $header_mode = self::get_mod_header_mode();
        return $header_mode == 4;
    }
    static function sanitize_select_field($input, $setting)
    {
        $input = sanitize_key($input);
        $choices = $setting->manager->get_control($setting->id)->choices;
        return array_key_exists($input, $choices) ? $input : $setting->default;
    }
}