<?php

namespace ahura\app\widgets;

class show_posts extends \WP_Widget
{
    public function __construct()
    {
        // actual widget processes
        parent::__construct(
            'ahura_posts', // id
            __("Ahura: Show Posts", 'ahura'),
            [
                'description' => __("Ahura Show Posts", 'ahura')
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
        $cat = $instance['category'];
        $count = $instance['count'];
        $author = $instance['author'];
        $date = $instance['date'];
?>
        <?php if ($cat != 'random') : ?>
            <?php $the_query = new \WP_Query(array('cat' => $cat, 'posts_per_page' => $count)); ?>
            <?php if ($the_query->have_posts()) : ?>
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <div class="ahura-show-posts">
                        <article>
                            <a class="ahura-show-posts-box" href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="ahura-show-posts-thumbnail"><?php the_post_thumbnail('smthumb'); ?></div>
                                <?php else : ?>
                                    <div class="ahura-show-posts-thumbnail"><img width="100" src="<?php bloginfo('template_url'); ?>/img/default.png" alt=""></div>
                                <?php endif ?>
                                <span><?php the_title(); ?></span>
                                <?php
                                if ($author) {
                                    echo '<span class="fa fa-user ahura-show-posts-author"> : ' . get_the_author() . '</span>';
                                }
                                if ($date) {
                                    echo '<span class="fa fa-calendar ahura-show-posts-date"> : ' . get_the_date() . '</span>';
                                }
                                ?>
                            </a>
                            <div class="clear"></div>
                        </article>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p><?php echo __('Nothing Found!', 'ahura'); ?></p>
            <?php endif; ?>
        <?php else : ?>
     <?php
        $args = array(
            'post_type' => 'post',
            'orderby'=> 'rand',
            'posts_per_page' => 5,
            );
            $the_query = new \WP_Query( $args );
            if ( $the_query->have_posts() ) :
            ?>
            <ul>
                    <div class="ahura-show-posts">
                        <article>
                            <a class="ahura-show-posts-box" href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="ahura-show-posts-thumbnail"><?php the_post_thumbnail('smthumb'); ?></div>
                                <?php else : ?>
                                    <div class="ahura-show-posts-thumbnail"><img width="100" src="<?php bloginfo('template_url'); ?>/img/default.png" alt=""></div>
                                <?php endif ?>
                                <span><?php the_title(); ?></span>
                                <?php
                                if ($author) {
                                    echo '<span class="fa fa-user ahura-show-posts-author"> : ' . get_the_author() . '</span>';
                                }
                                if ($date) {
                                    echo '<span class="fa fa-calendar ahura-show-posts-date"> : ' . get_the_date() . '</span>';
                                }
                                ?>
                            </a>
                            <div class="clear"></div>
                        </article>
                    </div>
            </ul>
         <?php else:?>
            <p><?php echo __('Nothing Found!', 'ahura'); ?></p>
     <?php
     endif;
    endif;
    ?>
    <?php
        echo $after_widget;
    }

    public function form($instance)
    {
        // outputs the options form in the admin
        $title = isset($instance['title']) ? $instance['title'] : __('Show Posts', 'ahura');
        $cat = $instance['category'];
        $count = $instance['count'];
        $author = $instance['author'];
        $date = $instance['date'];
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title') ?>"><?php _e("Title", 'ahura'); ?></label>
            <input value="<?php echo $title; ?>" type="text" class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title'); ?>">
        </p>
        <p>
            <?php

            $args = array(
                'show_option_all'    => __('All Categories', 'ahura'),
                'show_option_none'   => __('Show Random', 'ahura'),
                'option_none_value'  => 'random',
                'orderby'            => 'NAME',
                'order'              => 'ASC',
                'show_count'         => 0,
                'hide_empty'         => 1,
                'child_of'           => 0,
                'exclude'            => 1,
                'echo'               => 1,
                'selected'           => $instance['category'],
                'hierarchical'       => 1,
                'name'               => $this->get_field_name('category'),
                'id'                 => $this->get_field_id('category'),
                'class'              => 'widefat'
            );
            wp_dropdown_categories($args);
            ?>
        </p>
        <p>
            <input min="1" placeholder="<?php echo __('Count', 'ahura'); ?>" value="<?php if (isset($count)) {
                                                                                echo $count;
                                                                            } else {
                                                                                echo 3;
                                                                            } ?>" type="number" class="widefat" id="<?php echo $this->get_field_id('count') ?>" name="<?php echo $this->get_field_name('count'); ?>">
        </p>
        <p>
            <input type="checkbox" name="<?php echo $this->get_field_name('author'); ?>" id="<?php echo $this->get_field_id('author'); ?>" <?php if (isset($author)) {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?>>
            <label for="<?php echo $this->get_field_id('author'); ?>"><?php echo __('Show Author', 'ahura'); ?></label>
        </p>
        <p>
            <input type="checkbox" name="<?php echo $this->get_field_name('date'); ?>" id="<?php echo $this->get_field_id('date'); ?>" <?php if (isset($date)) {
                                                                                                                                            echo 'checked';
                                                                                                                                        } ?>>
            <label for="<?php echo $this->get_field_id('date'); ?>"><?php echo __('Show Date', 'ahura'); ?></label>
        </p>
<?php
    }

    public function update($new_instance, $old_instance)
    {
        // processes widget options to be saved
        $instance = [];
        $instance['title'] = $new_instance['title'] ? strip_tags($new_instance['title']) : '';
        $instance['category'] = $new_instance['category'];
        $instance['count'] = $new_instance['count'];
        $instance['author'] = $new_instance['author'];
        $instance['date'] = $new_instance['date'];
        return $instance;
    }
}
