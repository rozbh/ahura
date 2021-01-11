<?php
namespace ahura\app;
class mw_partials
{
    static function current_header_mode()
    {
        $page_header = mw_options::get_page_header();
        if($page_header)
        {
            return $page_header;
        }
        $header_mode = \ahura\app\mw_options::get_mod_header_mode();
        return $header_mode ? \ahura\app\mw_tools::validate_header_mode($header_mode) : 1;
    }
    static function load_header()
    {
        $header_slug = self::current_header_mode();
        get_template_part('partials/header', $header_slug);
    }
}