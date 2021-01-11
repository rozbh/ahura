<?php
namespace ahura\app;
class mw_widgets
{
    static function init()
    {
        self::change_recent_post_widget();
        register_widget('\ahura\app\widgets\socials');
        /*Ahura Socials 2*/
        register_widget('\ahura\app\widgets\socials2');
        /*Show Posts*/
        register_widget('\ahura\app\widgets\show_posts');
        /*Contact*/
        register_widget('\ahura\app\widgets\contact');
    }
    static function change_recent_post_widget()
    {
        unregister_widget('WP_Widget_Recent_Posts');
        register_widget('\ahura\app\widgets\recent_posts');
    }
}