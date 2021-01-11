<?php

namespace ahura\app\widgets;

class socials2 extends \WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'ahura_social2',
            __('Ahura: Social Accounts 2', 'ahura'),
            [
                'description' => __("Your social accounts link", 'ahura')
            ]
        );
    }
    public function form($instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        $title = isset($instance['title']) ? $instance['title'] : __('Social Accounts Link', 'ahura');
        $social = $instance['social2'];
?>
        <p>
            <label for="<?php echo $this->get_field_id('title') ?>"><?php _e("Title", 'ahura'); ?></label>
            <input value="<?php echo $title; ?>" type="text" class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title'); ?>">
        </p>
        <?php for ($i = 0; $i <= 7; $i++) : ?>
            <p>
                <select style="width: 100%;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,0.1);" id="<?php echo $this->get_field_id('social2') . '[' . $i . ']'.'[soicalselect]'; ?>" name="<?php echo $this->get_field_name('social2') . '[' . $i . ']'.'[soicalselect]'; ?>" type="text">
                    <option value="select" selected><?php echo __('Please Select Social','ahura');?></option>
                    <option value='Instagram' <?php echo ($social[$i]['soicalselect'] == 'Instagram') ? 'selected' : ''; ?>>
                        <?php echo __('Instagram', 'ahura'); ?>
                    </option>
                    <option value='Telegram' <?php echo ($social[$i]['soicalselect']== 'Telegram') ? 'selected' : ''; ?>>
                        <?php echo __('Telegram', 'ahura'); ?>
                    </option>
                    <option value='Youtube' <?php echo ($social[$i]['soicalselect'] == 'Youtube') ? 'selected' : ''; ?>>
                        <?php echo __('Youtube', 'ahura'); ?>
                    </option>
                    <option value='Facebook' <?php echo ($social[$i]['soicalselect'] == 'Facebook') ? 'selected' : ''; ?>>
                        <?php echo __('Facebook', 'ahura'); ?>
                    </option>
                    <option value='Twitter' <?php echo ($social[$i]['soicalselect'] == 'Twitter') ? 'selected' : ''; ?>>
                        <?php echo __('Twitter', 'ahura'); ?>
                    </option>
                    <option value='Linkedin' <?php echo ($social[$i]['soicalselect'] == 'Linkedin') ? 'selected' : ''; ?>>
                        <?php echo __('Linkedin', 'ahura'); ?>
                    </option>
                    <option value='Pinterest' <?php echo ($social[$i]['soicalselect'] == 'Pinterest') ? 'selected' : ''; ?>>
                        <?php echo __('Pinterest', 'ahura'); ?>
                    </option>
                    <option value='Aparat' <?php echo ($social[$i]['soicalselect'] == 'Aparat') ? 'selected' : ''; ?>>
                        <?php echo __('Aparat', 'ahura'); ?>
                    </option>
                </select>
            </p>
            <p>
            <input placeholder="<?php echo __('Address','ahura');?>" value="<?php echo isset($instance['social2'][$i]['url']) ? $instance['social2'][$i]['url'] : '';?>" class="widefat" type="text" name="<?php echo $this->get_field_name('social2') . '[' . $i . '][url]';?>" id="<?php echo $this->get_field_id('social2_url_' . $i)?>">
        </p>
        <?php endfor; ?>
    <?php
    }

    public function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
        if ($title) {
            echo $before_title . $title . $after_title;
        }
        $social = $instance['social2'];
    ?>
        <div class="social2-box">
            <?php
                foreach($social as $soc)
                {
                    if($soc['soicalselect'] != 'select'){
                        if($soc['url'] != ''){
                            switch($soc['soicalselect'])
                            {
                                case 'Instagram':
                                    echo '<a href="'.$soc['url'].'"><div class="ahura-social2 ahura-social2-instagram"><i class="fab fa-instagram"></i></div></a>';
                                break;
                                case 'Telegram':
                                    echo '<a href="'.$soc['url'].'"><div class="ahura-social2 ahura-social2-telegram"><i class="fab fa-telegram"></i></div></a>';
                                break;
                                case 'Youtube':
                                    echo '<a href="'.$soc['url'].'"><div class="ahura-social2 ahura-social2-youtube"><i class="fab fa-youtube"></i></div></a>';
                                break;
                                case 'Facebook':
                                    echo '<a href="'.$soc['url'].'"><div class="ahura-social2 ahura-social2-facebook"><i class="fab fa-facebook"></i></div></a>';
                                break;
                                case 'Twitter':
                                    echo '<a href="'.$soc['url'].'"><div class="ahura-social2 ahura-social2-twitter"><i class="fab fa-twitter"></i></div></a>';
                                break;
                                case 'Linkedin':
                                    echo '<a href="'.$soc['url'].'"><div class="ahura-social2 ahura-social2-linkedin"><i class="fab fa-linkedin"></i></div></a>';
                                break;
                                case 'Pinterest':
                                    echo '<a href="'.$soc['url'].'"><div class="ahura-social2 ahura-social2-pinterest"><i class="fab fa-pinterest"></i></div></a>';
                                break;
                                case 'Aparat':
                                    echo '<a href="'.$soc['url'].'"><div class="ahura-social2 ahura-social2-aparat"></div></a>';
                                break;
                            }
                        }
                    }
                }
            ?>
        </div>
<?php
        echo $after_widget;
    }
    public function update($new_instance, $old_instance)
    {
        $instance = [];
        // $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['social2'] = $new_instance['social2'];
        return $instance;
    }
}
