<?php
namespace ahura\app;
class mw_tools
{
    static function vd($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }
    static function validate_header_mode($header_mode)
    {
        $default = \ahura\app\mw_options::get_default_headers();
        if(!$header_mode)
        {
            return key($default);
        }
        $mode = $header_mode && in_array($header_mode, array_keys($default)) ? $header_mode : key($default);
        return $mode;
    }
    private static $_theme_data;
    static function get_theme_data()
    {
        if(!self::$_theme_data)
        {
            self::$_theme_data = wp_get_theme();
        }
        return self::$_theme_data;
    }
    static function get_theme_slug()
    {
        $data = self::get_theme_data();
        return $data->get_template();
    }
    public static function get_theme_version()
    {
        $data = self::get_theme_data();
        return $data->version;
    }
    static function is_woocommerce_active()
    {
        return class_exists('woocommerce');
    }
    static function admin_referer($action, $query_arg = '_wpnonce', $die_mode=false)
    {
        $admin_url = strtolower(admin_url());
        $refere = strtolower($_SERVER['HTTP_REFERER']);
        $result = isset($_REQUEST[$query_arg]) ? wp_verify_nonce($_REQUEST[$query_arg], $action) : false;
        
        do_action('check_admin_refere', $action, $result);
        if(strpos($refere, $admin_url) !== 0 || !$result)
        {
            if($die_mode)
            {
                wp_nonce_ays($action);
                die;
            }
            return false;
        }
        return $result;
    }
}