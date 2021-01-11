<?php
namespace ahura\app;
class mw_metabox
{
    static function testimonial_init()
    {
        add_meta_box('testimonial_author', __("Author", 'ahura'), [__CLASS__, 'testimonial_author'], 'testimonial', 'side');
    }
    static function pages_init()
    {
        add_meta_box('ahura_header', __('Header Options', 'ahura'), [__CLASS__, 'header_metabox_c'], 'page', 'side');
        add_meta_box('ahura_page_breadcrumb', __("Breadcrumb", 'ahura'), [__CLASS__, 'page_breadcrumb_c'], 'page', 'side');
    }
    static function testimonial_author($post)
    {
        $username = \ahura\app\mw_options::get_testimonial_username($post->ID);
        $sitename = \ahura\app\mw_options::get_testimonial_sitename($post->ID);
        ?>
        <p>
            <label for="mw_testimonial_username"><?php _e("User Displayname:", 'ahura');?></label>
        </p>
        <p>
            
            <input id="mw_testimonial_username" value="<?php echo $username ? $username : false?>" type="text" placeholder="e.g. John Doe" name="mw_testimonial_username">
        </p>
        <p>
            <label for="mw_testimonial_user_sitename"><?php _e("User Site Name:", 'ahura');?></label>
        </p>
        <p>
            <input type="text" value="<?php echo $sitename ? $sitename : '';?>" id="mw_testimonial_user_sitename" placeholder="e.g. Mihan Wordpress" name="mw_testimonial_user_sitename">
        </p>
        <?php
    }
    static function header_metabox_c($post)
    {
        $headers = \ahura\app\mw_options::get_default_headers();
        $pid = $post->ID;
        $header_mode = mw_options::get_page_header_mode($pid);
        $is_sticky_mode = mw_options::get_page_is_sticky_header($pid);
        $is_transparent_mode = mw_options::get_page_is_transparent_header($pid);
        if($headers):?>
        <p>
            <select name="ahura_page_header" id="ahura_page_header">
                <option value="0"><?php _e("Default Settings", 'ahura');?></option>
                <?php foreach($headers as $key => $name):?>
                    <option <?php selected($header_mode, $key)?> value="<?php echo $key?>"><?php echo $name;?></option>
                <?php endforeach;?>
            </select>
        </p>
        <div id="ahura_header_option_fields">
            <p header-1 header-2 header-3>
                <input <?php checked(1, $is_sticky_mode)?> type="checkbox" name="ahura_sticky_header" id="ahura_sticky_header">
                <label for="ahura_sticky_header"><?php _e("Sticky Header", 'ahura');?></label>
            </p>
            <p header-2>
                <input <?php checked(1, $is_transparent_mode)?> type="checkbox" name="ahura_transparent_header" id="ahura_transparent_header">
                <label for="ahura_transparent_header"><?php _e("Transparent Header", 'ahura');?></label>
            </p>
        </div>
            <?php else:?>
                <option value="0" disabled><?php _e("Not found anything", 'ahura');?></option>
            <?php endif;
    }
    static function page_breadcrumb_c($post)
    {
        $current = mw_options::get_page_breadcrumb_status($post->ID);
        ?>
        <p>
            <select name="page_breadcrumb" id="page_breadcrumb">
                <option value="0"><?php _e('Default Settings', 'ahura'); ?></option>
                <option <?php selected('show', $current); ?> value="show"><?php _e('Show Breadcrumb', 'ahura'); ?></option>
                <option <?php selected('hide', $current); ?> value="hide"><?php _e('Hide Breadcrumb', 'ahura');?></option>
            </select>
        </p>
        <?php
    }
    static function store_testimonial_metabox($post_id)
    {
        $username = isset($_POST['mw_testimonial_username']) && $_POST['mw_testimonial_username'] ? sanitize_text_field($_POST['mw_testimonial_username']) : false;
        $sitename = isset($_POST['mw_testimonial_user_sitename']) && $_POST['mw_testimonial_user_sitename'] ? sanitize_text_field($_POST['mw_testimonial_user_sitename']) : false;
        if($username)
        {
            \ahura\app\mw_options::set_testimonial_username($post_id, $username);
        }else{
            \ahura\app\mw_options::remove_testimonial_username($post_id);
        }
        if($sitename)
        {
            \ahura\app\mw_options::set_testimonial_sitename($post_id, $sitename);
        }else{
            \ahura\app\mw_options::remove_testimonial_sitename($post_id);
        }
    }
    static function store_page_metaboxes_data($pid)
    {
        self::store_page_header_metabox($pid);
        self::store_page_breadcrumb_metabox($pid);
    }
    static function store_page_header_metabox($pid)
    {
        $header = isset($_POST['ahura_page_header']) ? $_POST['ahura_page_header'] : false;
        if(!$header)
        {
            return false;
        }
        if(!intval($header))
        {
            mw_options::remove_page_header_mode($pid);
            mw_options::remove_page_is_sticky_header($pid);
            mw_options::remove_page_is_transparent_header($pid);
            return;
        }
        mw_options::set_page_header_mode($pid, $header);
        $is_sticky_mode = isset($_POST['ahura_sticky_header']) ? true : false;
        if($is_sticky_mode)
        {
            mw_options::set_page_is_sticky_header($pid);
        }else{
            mw_options::remove_page_is_sticky_header($pid);
        }
        $is_transparent_mode = isset($_POST['ahura_transparent_header']) ? true : false;
        if($is_transparent_mode && $header == 2)
        {
            mw_options::set_page_is_transparent_header($pid);
        }else{
            mw_options::remove_page_is_transparent_header($pid);
        }
    }
    static function store_page_breadcrumb_metabox($pid)
    {
        $page_breadcrumb = isset($_POST['page_breadcrumb']) ? $_POST['page_breadcrumb'] : false;
        if(!$page_breadcrumb)
        {
            // set deafult mode
            mw_options::remove_page_show_breadcrumb($pid);

        }
        if($page_breadcrumb == 'show')
        {
            mw_options::set_page_show_breadcrumb($pid);
        }elseif($page_breadcrumb == 'hide'){
            mw_options::set_page_hide_breadcrumb($pid);
        }
    }
}