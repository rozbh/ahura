<?php
namespace ahura\app;
class mw_mega_menu
{
    static function get_fields()
    {
        return [
            'mega_menu_state' => [
                'title' => __('Menu Mode', 'ahura'),
                'type' => 'select',
                'data' => [
                    'simple' => __('Simple', 'ahura'),
                    'mega_menu' => __('Mega Menu', 'ahura')
                ]
                ],
                'mega_menu_icon' => [
                    'title' => __('Mega Menu Icon', 'ahura'),
                    'type' => 'media'
                ],
                'mega_menu_bg' => [
                    'title' => __('Mega Menu Background', 'ahura'),
                    'type' => 'media',                
                ]
        ];
    }
    static function render_field($item_id, $field_key, $field_data)
    {
        $method = 'render_field_' . $field_data['type'];
        if(!method_exists(__CLASS__, $method)){
            return false;
        }
        self::{$method}($item_id, $field_key, $field_data);
    }
    static function render_field_select($item_id, $field_key, $field_data)
    {
        $value = get_post_meta($item_id, $field_key, true);
        ?>
        <select
            class="widefat"
            name="<?php echo "{$field_key}[{$item_id}]" ?>"
            id="<?php echo "{$field_key}-for-{$item_id}"; ?>">
            <?php foreach($field_data['data'] as $data_key => $data_value): ?>
                <?php $select_state = $data_key == $value ? 'selected' : false;?>
                <option <?php echo $select_state?> value="<?php echo $data_key?>"><?php echo $data_value?></option>
            <?php endforeach; ?>
        </select>
        <?php
    }
    static function render_field_media($item_id, $field_key, $field_data)
    {
        $value = get_post_meta($item_id, $field_key, true);
        ?>
        <small><a class="mw_upload_media" href="#"><?php _e('Upload'); ?></a></small>
        <input
            class="widefat mw_media_url"
            type="text"
            name="<?php echo "{$field_key}[$item_id]"; ?>"
            value="<?php echo $value?>">
        <?php
    }
    static function add_admin_fields($item_id, $item)
    {
        $fields = self::get_fields();
        foreach($fields as $field_key => $field_data):
        ?>
        <p class="description description-wide">
            <label for="<?php echo esc_attr($field_key); ?>"><?php echo $field_data['title']; ?></label>
            <?php self::render_field($item_id, $field_key, $field_data); ?>
        </p>
        <?php
        endforeach;
    }
    static function update_data($menu_id, $menu_item_db_id, $menu_item_args)
    {
        if(defined('DOING_AJAX') && DOING_AJAX)
        {
            return false;
        }
        if(!mw_tools::admin_referer('update-nav_menu', 'update-nav-menu-nonce') && !mw_tools::admin_referer('import-wordpress'))
        {
            wp_nonce_ays('mw_theme_menu_data');
            die;
        }
        $fields = self::get_fields();
        foreach($fields as $field_key => $field_data)
        {
            $field = isset($_POST[$field_key][$menu_item_db_id]) && $_POST[$field_key][$menu_item_db_id] ? sanitize_text_field($_POST[$field_key][$menu_item_db_id]) : false;
            if($field)
            {
                // update option
                update_post_meta($menu_item_db_id, $field_key, $field);
            }else{
                // remove option
                delete_post_meta($menu_item_db_id, $field_key);
            }
        }
    }
}