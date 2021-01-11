<?php

namespace ahura\app\widgets;

class contact extends \WP_Widget
{
    public function __construct()
    {
        // actual widget processes
        parent::__construct(
            'ahura_contact', // id
            __("Ahura: Contact", 'ahura'),
            [
                'description' => __("Ahura Show Contact info", 'ahura')
            ]
        );
    }

    public function widget($args, $instance)
    {
        // outputs the content of the widget
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
        if ($title) {
            echo $before_title . $title . $after_title;
        }
        $contact = $instance['contact'];

?>
        <div class="ahura_contact_widget">

            <?php
            foreach ($instance['contact'] as $key => $value) {
                switch ($key) {
                    case 'email':
                        echo '<div class="ahura_contact_widget_item">';
                        echo '<span>' . __('Email Address', 'ahura') . ' :</span>';
                        echo '<p>' . $instance['contact']['email'] . '</p>';
                        echo '</div>';
                        break;
                    case 'phone1':
                        echo '<div class="ahura_contact_widget_item">';
                        echo '<span>' . __('Phone Number 1', 'ahura') . ' :</span>';
                        echo '<p>' . $instance['contact']['phone1'] . '</p>';
                        echo '</div>';
                        break;
                    case 'phone2':
                        echo '<div class="ahura_contact_widget_item">';
                        echo '<span>' . __('Phone Number 2', 'ahura') . ' :</span>';
                        echo '<p>' . $instance['contact']['phone2'] . '</p>';
                        echo '</div>';
                        break;
                    case 'postalcode':
                        echo '<div class="ahura_contact_widget_item">';
                        echo '<span>' . __('Postal Code', 'ahura') . ' :</span>';
                        echo '<p>' . $instance['contact']['postalcode'] . '</p>';
                        echo '</div>';
                        break;
                    case 'fax':
                        echo '<div class="ahura_contact_widget_item">';
                        echo '<span>' . __('Fax', 'ahura') . ' :</span>';
                        echo '<p>' . $instance['contact']['fax'] . '</p>';
                        echo '</div>';
                        break;
                    case 'branch1':
                        echo '<div class="ahura_contact_widget_item">';
                        echo '<span>' . __('Branch 1', 'ahura') . ' :</span>';
                        echo '<p>' . $instance['contact']['branch1'] . '</p>';
                        echo '</div>';
                        break;
                    case 'branch2':
                        echo '<div class="ahura_contact_widget_item">';
                        echo '<span>' . __('Branch 2', 'ahura') . ' :</span>';
                        echo '<p>' . $instance['contact']['branch2'] . '</p>';
                        echo '</div>';
                        break;
                }
            }
            ?>


        </div>
    <?php
        echo $after_widget;
    }

    public function form($instance)
    {
        // outputs the options form in the admin
        $title = isset($instance['title']) ? $instance['title'] : __('Contact', 'ahura');
        $contact = $instance['contact'];
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title') ?>"><?php _e("Title", 'ahura'); ?></label>
            <input value="<?php echo $title; ?>" type="text" class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title'); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('contact') . '[email]'; ?>"><?php echo __("Email Address", 'ahura'); ?></label>
            <input value="<?php echo isset($instance['contact']['email']) ? $instance['contact']['email'] : ''; ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('contact') . '[email]'; ?>" id="<?php echo $this->get_field_id('contact') . '[email]'; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('contact') . '[phone1]'; ?>"><?php echo __("Phone Number 1", 'ahura'); ?></label>
            <input value="<?php echo isset($instance['contact']['phone1']) ? $instance['contact']['phone1'] : ''; ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('contact') . '[phone1]'; ?>" id="<?php echo $this->get_field_id('contact') . '[phone1]'; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('contact') . '[phone2]'; ?>"><?php echo __("Phone Number 2", 'ahura'); ?></label>
            <input value="<?php echo isset($instance['contact']['phone2']) ? $instance['contact']['phone2'] : ''; ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('contact') . '[phone2]'; ?>" id="<?php echo $this->get_field_id('contact') . '[phone2]'; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('contact') . '[postalcode]'; ?>"><?php echo __("Postal Code", 'ahura'); ?></label>
            <input value="<?php echo isset($instance['contact']['postalcode']) ? $instance['contact']['postalcode'] : ''; ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('contact') . '[postalcode]'; ?>" id="<?php echo $this->get_field_id('contact') . '[postalcode]'; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('contact') . '[fax]' ?>"><?php echo __("Fax", 'ahura'); ?></label>
            <input value="<?php echo isset($instance['contact']['fax']) ? $instance['contact']['fax'] : ''; ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('contact') . '[fax]'; ?>" id="<?php echo $this->get_field_id('contact') . '[fax]'; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('contact') . '[branch1]'; ?>"><?php echo __("Branch 1", 'ahura'); ?></label>
            <input value="<?php echo isset($instance['contact']['branch1']) ? $instance['contact']['branch1'] : ''; ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('contact') . '[branch1]'; ?>" id="<?php echo $this->get_field_id('contact') . '[branch1]'; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('contact') . '[branch2]'; ?>"><?php echo __("Branch 2", 'ahura'); ?></label>
            <input value="<?php echo isset($instance['contact']['branch1']) ? $instance['contact']['branch2'] : ''; ?>" class="widefat" type="text" name="<?php echo $this->get_field_name('contact') . '[branch2]'; ?>" id="<?php echo $this->get_field_id('contact') . '[branch2]'; ?>">
        </p>
<?php
    }
    public function update($new_instance, $old_instance)
    {
        // processes widget options to be saved
        $instance = [];
        $instance['title'] = $new_instance['title'] ? strip_tags($new_instance['title']) : '';
        $instance['contact'] = $new_instance['contact'];
        return $instance;
    }
}
