<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_Post_Carousel3 extends \Elementor\Widget_Base {

	public function get_name() {
		return 'postcarousel3';
	}

	public function get_title() {
		return __( 'Post Carousel 3', 'ahura' );
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
			'description',
			[
				'label' => __("Description", 'ahura'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __("Description", 'ahura')
			]
		);
		$this->add_control(
			'color',
			[
				'label'   => __( 'Color', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::COLOR,
				'default' => '#66bb6a',
				'selectors' =>
				[
					'{{WRAPPER}} .description::before' => 'border-color: {{VALUE}}'
				]
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
		$count = $settings['count'];
		$posts = new WP_Query ( array(
			'posts_per_page' => $count,
			'cat'            => $settings['catsid'],
			'order'         =>  $settings['post_order'],
		) );
		wp_reset_postdata();
		if($posts->have_posts()): ?>
			<div class="post-carousel-3">
				<div class="info_box">
					<h3 class="title"><?php echo get_cat_name($default_cat_id); ?></h3>
					<p class="description"><?php echo $settings['description']; ?></p>
				</div>
				<div class="slide_box">
					<?php if(is_admin()): ?>
						<div class="preload_widget_section">
							<h3><?php _e('Slider is here!', 'ahura'); ?></h3>
							<small><?php _e('To see slider please view page.', 'ahura'); ?></small>
						</div>
					<?php else: ?>
					<div class="owl-carousel">
						<?php while($posts->have_posts()): $posts->the_post();?>
							<a href="<?php the_permalink(get_the_ID()); ?>" class="item">
								<div class="img">
									<?php the_post_thumbnail('stthumb'); ?>
								</div>
								<h3><?php the_title(); ?></h3>
								<span><?php the_excerpt(); ?></span>
							</a>
						<?php endwhile; ?>
					</div>
					<?php endif;?>
				</div>
			</div>
		<?php endif; ?>
		<?php
	}

}