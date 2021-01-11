<?php
namespace ahura\app;
class mihanwpUpdater
{
    private static $_base_api_server;
    private static $_license_key;
    private static $_item_id;
    private static $_current_version;
    private static $_theme_slug;

    private static $_new_version;
    private static $_package_url;
    
    static function init($args=[])
    {
        self::$_base_api_server = isset($args['base_api_server']) ? trailingslashit($args['base_api_server']) : false;
        self::$_license_key = isset($args['license_key']) ? $args['license_key'] : false;
        self::$_item_id = isset($args['item_id']) ? intval($args['item_id']) : false;
        self::$_current_version = isset($args['current_version']) ? $args['current_version'] : false;
        self::$_theme_slug = isset($args['theme_slug']) ? $args['theme_slug'] : false;
        self::setHooks();
    }
    static function setHooks()
    {
        add_filter('pre_set_site_transient_update_themes', [__CLASS__, 'checkUpdate']);
    }
    static function checkUpdate($transient)
    {
        if(empty($transient->checked))
        {
            return $transient;
        }
        // check is new version available
        if(self::checkNewVersion())
        {
            $transient->response[self::$_theme_slug] = [
                'new_version' => self::$_new_version,
                'package' => self::$_package_url,
                'url' => self::$_base_api_server
            ];
        }
        return $transient;
    }
    static function checkNewVersion()
    {
        $url = self::$_base_api_server;
        $url .= 'api/v2/' . self::$_license_key . '/update/info';
        $args = [
            'body' => [
                'product_id' => self::$_item_id
            ],
            'timeout' => 300
        ];
        $remote = wp_remote_get($url, $args);
        if(wp_remote_retrieve_response_code($remote) != 200)
        {
            return false;
        }
        $response = json_decode(wp_remote_retrieve_body($remote));
        self::$_new_version = isset($response->version) ? $response->version : false;
        self::$_package_url = isset($response->download_url) ? $response->download_url : false;
        return version_compare(self::$_new_version, self::$_current_version) == 1;
    }
}