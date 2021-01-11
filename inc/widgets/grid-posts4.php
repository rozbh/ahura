<?php

// Block direct access to the main plugin file.
defined('ABSPATH') or die('No script kiddies please!');


class Elementor_Grid_Posts4 extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'gridposts3';
    }

    public function get_title()
    {
        return __('Grid Posts 4', 'ahura');
    }

    public function get_icon()
    {
        return 'fa fa-th-large';
    }

    public function get_categories()
    {
        return ['ahuraelements'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'ahura'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $categories = get_categories();
        $cats       = array();
        foreach ($categories as $category) {
            $cats[$category->term_id] = $category->name;
        }
        $default = key($cats);
        $this->add_control(
            'catsid',
            [
                'label'    => __('Categories', 'ahura'),
                'type'     => \Elementor\Controls_Manager::SELECT2,
                'options'  => $cats,
                'label_block' => true,
                'multiple' => true,
                'default' => $default
            ]
        );

        $this->add_control(
            'author',
            [
                'label'   => __('Author', 'ahura'),
                'type'    => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'time',
            [
                'label'   => __('Time', 'ahura'),
                'type'    => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'post_order',
            [
                'label' => __('Sort', 'ahura'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'DESC',
                'options' => [
                    'ASC' => [
                        'title' => __('Ascending', 'ahura'),
                        'icon' => 'fa fa-arrow-up'
                    ],
                    'DESC' => [
                        'title' => __('Descending', 'ahura'),
                        'icon' => 'fa fa-arrow-down'
                    ],
                ],
                'toggle' => true
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $catidd   = $settings['catsid'];
        $post_order = $settings['post_order'];
        $postbox1 = new WP_Query(array(
            'posts_per_page' => 1,
            'cat'            => $catidd,
            'order'         =>  $post_order
        ));
        $postbox2 = new WP_Query(array(
            'posts_per_page' => 2,
            'cat'            => $catidd,
            'order'         =>  $post_order,
            'offset'         => 1
        ));
        if ($postbox1->have_posts()) : ?>
            <div class="grid-post4">
                <?php while ($postbox1->have_posts()) : $postbox1->the_post(); ?>
                    <a href="<?php the_permalink() ?>" style="background: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), $bg_size); ?>')" class="grid-post4-right">
                        <div class="grid-post4-data">
                            <?php if ($settings['author']) : ?>
                                <div class="grid-pots4-author">
                                    <i class="fa fa-user"></i> <?php the_author(); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($settings['time']) : ?>
                                <div class="grid-post4-time">
                                    <i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <h2 class="grid-post4-title"><?php the_title(); ?></h2>
                    </a>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
            <div class="grid-post4-left">
                <?php if ($postbox2->have_posts()) : ?>
                    <?php while ($postbox2->have_posts()) : $postbox2->the_post(); ?>
                        <a href="<?php the_permalink() ?>" style="background: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), $bg_size); ?>')" class="grid-post4-left-item">
                            <div class="grid-post4-data">
                                <?php if ($settings['author']) : ?>
                                    <div class="grid-pots4-author">
                                        <i class="fa fa-user"></i> <?php the_author(); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($settings['time']) : ?>
                                    <div class="grid-post4-time">
                                        <i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <h2 class="grid-post4-title"><?php the_title(); ?></h2>
                        </a>
                    <?php endwhile; ?>
            </div>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
<?php
    }
}
