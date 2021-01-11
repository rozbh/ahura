<?php
namespace ahura\app\widgets;

class socials extends \WP_Widget
{
    public function __construct() {
        // actual widget processes
        parent::__construct(
            'ahura_social', // id
            __("Ahura: Social Accounts", 'ahura'),
            [
                'description' => __("Your social accounts link", 'ahura')
            ]
        );
    }
 
    public function widget( $args, $instance ) {
        // outputs the content of the widget
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
        if($title)
        {
            echo $before_title . $title . $after_title;
        }
        $social = isset($instance['social']) ? $instance['social'] : '';
        if($social):
        ?>
        <div class="ahura_social_widget">
            <?php foreach($social as $item): if($item['icon']):?>
                <a href="<?php echo isset($item['url']) && $item['url'] ? $item['url'] : ''; ?>"><img src="<?php echo $item['icon']; ?>" alt="#"></a>
            <?php endif; endforeach; ?>
        </div>
        <?php
        endif;
        echo $after_widget;
    }
 
    public function form( $instance ) {
        // outputs the options form in the admin
        $title = isset($instance['title']) ? $instance['title'] : __('Social Accounts Link', 'ahura');
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title')?>"><?php _e("Title", 'ahura');?></label>
            <input value="<?php echo $title;?>" type="text" class="widefat" id="<?php echo $this->get_field_id('title')?>" name="<?php echo $this->get_field_name('title');?>">
        </p>
        <?php for($i=1; $i <= 4; $i++): ?>
            <p>
                <label for="<?php echo $this->get_field_id('social_icon_' . $i);?>"><span><?php _e("Social Account Icon", 'ahura');?></span><a class="ahura_social_upload" href="#"><?php _e("Upload media", 'ahura');?></a></label>
                <input value="<?php echo isset($instance['social'][$i]['icon']) ? $instance['social'][$i]['icon'] : '';?>" class="widefat" type="text" name="<?php echo $this->get_field_name('social') . '['.$i.'][icon]'?>" id="<?php echo $this->get_field_id('social_icon_' . $i)?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('social_url_' . $i);?>"><?php _e("Social Account URL", 'ahura');?></label>
                <input value="<?php echo isset($instance['social'][$i]['url']) ? $instance['social'][$i]['url'] : '';?>" class="widefat" type="text" name="<?php echo $this->get_field_name('social') . '[' . $i . '][url]';?>" id="<?php echo $this->get_field_id('social_url_' . $i)?>">
            </p>
        <?php endfor;
    }
 
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
        $instance = [];
        $instance['title'] = $new_instance['title'] ? strip_tags($new_instance['title']) : '';
        $instance['social'] = $new_instance['social'];
        return $instance;
    }
}