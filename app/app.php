<?php

class mw_ahura_theme
{
    private static $_instance;
    static function get_instance()
    {
        if(!self::$_instance)
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    function __construct()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
        \ahura\app\mw_hooks::init();
        self::handleUpdater();
    }
    static function handleUpdater()
    {
        define('MW_AHURA_UPDATER_ITEM_ID', 946456);
        $updaterArgs = [
            'base_api_server' => 'https://mihanwp.com/',
            'license_key' => \ahura\app\license::get_license_key(),
            'item_id' => MW_AHURA_UPDATER_ITEM_ID,
            'current_version' => \ahura\app\mw_tools::get_theme_version(),
            'theme_slug' => \ahura\app\mw_tools::get_theme_slug()
        ];
        \ahura\app\mihanwpUpdater::init($updaterArgs);
    }
    static function autoload($class_name)
    {
        if(strpos($class_name, 'ahura') !== false)
        {
            $class_name = str_replace('ahura\\', '', $class_name);
            // $class_name = strtolower($class_name);
            $class_name = str_replace('.', DIRECTORY_SEPARATOR, $class_name);
            $class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
            $class_path = get_template_directory() . DIRECTORY_SEPARATOR . $class_name . '.php';
            if(file_exists($class_path) && is_readable($class_path))
            {
                include $class_path;
            }
        }
    }
}
mw_ahura_theme::get_instance();
