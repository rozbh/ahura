<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_Post_Carousel extends \Elementor\Widget_Base {

	public function get_name() {
		return 'postcarousel';
	}

	public function get_title() {
		return __( 'Post Carousel', 'ahura' );
	}

	public function get_icon() {
		return 'fa fa-caret-right';
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
			'color',
			[
				'label'   => __( 'Color', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#66bb6a'
			]
		);

		$this->add_control(
			'excerpt',
			[
				'label'   => __( 'Show Excerpt', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'yes' => [ 'title' => __( 'Yes', 'ahura' ), 'icon' => 'fa fa-check-circle' ],
					'no'  => [ 'title' => __( 'No', 'ahura' ), 'icon' => 'fa fa-times-circle' ]
				],
				'default' => 'yes'
			]
		);


		$this->add_control(
			'count',
			[
				'label'      => __( 'Number of posts', 'ahura' ),
				'type'       => \Elementor\Controls_Manager::NUMBER,
				'default'    => 8
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
		$default_cat_id = is_array($catidd) ? reset($catidd) : $catidd;
		$postbox5 = new WP_Query ( array(
			'posts_per_page' => $settings['count'],
			'cat'            => $catidd,
            'order'         =>  $settings['post_order']
		) );
		if ( $postbox5->have_posts() ) : ?>
            <div class="postbox5">
				<h2 style="border-right-color:<?php echo $settings['color']; ?>;color:<?php echo $settings['color']; ?>"
					class="cat-name"><?php echo get_cat_name( $default_cat_id ) ?></h2><a
						style="background-color:<?php echo $settings['color']; ?>;box-shadow:0 5px 20px <?php echo $settings['color']; ?>80"
						class="cat-more-link"
						href="<?php echo get_category_link( $default_cat_id ) ?>"><?php echo __( 'Show All', 'ahura' ); ?></a>
				<div class="clear"></div>
				<?php if(is_admin()): ?>
					<div class="preload_widget_section">
						<h3><?php _e('Slider is here!', 'ahura'); ?></h3>
						<small><?php _e('To see slider please view page.'); ?></small>
					</div>
					<?php else: ?>
                <div class="owl-carousel owl-car1">
					<?php while ( $postbox5->have_posts() ) : $postbox5->the_post(); ?>
                        <div>
                            <a class="fimage"
                               href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'stthumb' ); ?></a>
                            <a href="<?php the_permalink(); ?>">
                                <h3><?php echo wp_trim_words( get_the_title(), 8, '...' ); ?></h3></a>
							<?php if ( $settings['excerpt'] == 'yes' ) : ?>
								<?php the_excerpt(); ?>
							<?php endif; ?>
                        </div>
					<?php endwhile; ?>
				</div>
				<?php endif; ?>
            </div>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
        <div class="clear"></div>
		<?php
	}

}
