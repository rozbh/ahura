<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_Post_list extends \Elementor\Widget_Base {

	public function get_name() {
		return 'postlist';
	}

	public function get_title() {
		return __( 'Post List', 'ahura' );
	}

	public function get_icon() {
		return 'fa fa-list';
	}

	public function get_categories() {
		return [ 'ahuraelements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'ahura' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$categories = get_categories();
		$cats       = array();
		foreach ( $categories as $category ) {
			$cats[ $category->term_id ] = $category->name;
		}
		$default = key($cats);
		$this->add_control(
			'catsid',
			[
				'label'    => __( 'Categories', 'ahura' ),
				'type'     => \Elementor\Controls_Manager::SELECT2,
				'options'  => $cats,
				'label_block' => true,
				'multiple' => true,
				'default' => $default
			]
		);

		$this->add_control(
			'postcount',
			[
				'label'      => __( 'Number of posts', 'ahura' ),
				'type'       => \Elementor\Controls_Manager::NUMBER,
				'default'    => 4
			]
		);

		$this->add_control(
			'color',
			[
				'label'   => __( 'Color', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#66bb6a'
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

	protected function render() {
		$settings = $this->get_settings_for_display();
		$catidd   = $settings['catsid'];
		$first_cat_id = $catidd && is_array($catidd) ? $catidd[0] : $catidd;
		$postbox1 = new WP_Query ( array(
			'posts_per_page' => $settings['postcount'],
			'cat'            => $catidd,
            'order'         =>  $settings['post_order']
		) );
		if ( $postbox1->have_posts() ) : ?>
            <div>
                <h2 style="border-right-color:<?php echo $settings['color']; ?>;color:<?php echo $settings['color']; ?>"
                    class="cat-name"><?php echo get_cat_name( $first_cat_id ) ?></h2><a
                        style="background-color:<?php echo $settings['color']; ?>;box-shadow:0 5px 20px <?php echo $settings['color']; ?>80"
                        class="cat-more-link"
                        href="<?php echo get_category_link( $first_cat_id ) ?>"><?php echo __( 'Show All', 'ahura' ); ?></a>
                <div class="clear"></div>
                <div class="post-list row">
					<?php while ( $postbox1->have_posts() ) : $postbox1->the_post(); ?>
                        <div class="col-lg-4">
                            <article class="list-post row">
                                <div class="col-md-4">
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'verthumb' ); ?></a>
                                </div>
                                <div class="col-md-8">
                                    <a href="<?php the_permalink(); ?>">
                                        <h3><?php echo wp_trim_words( get_the_title(), 8, '...' ); ?></h3></a>
                                </div>
                            </article>
                        </div>
					<?php endwhile; ?>
                </div>
            </div>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
        <div class="clear"></div>
		<?php
	}

}
