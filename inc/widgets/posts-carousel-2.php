<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_Post_Carousel2 extends \Elementor\Widget_Base {

	public function get_name() {
		return 'postcarousel2';
	}

	public function get_title() {
		return __( 'Post Carousel 2', 'ahura' );
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
				'default'	=>	$default
			]
		);

		$this->add_control(
			'date',
			[
				'label'   => __( 'Show Date', 'ahura' ),
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
		$postbox5 = new WP_Query ( array(
			'posts_per_page' => $settings['count'],
			'cat'            => $settings['catsid'],
            'order'         =>  $settings['post_order']
		) );
		if ( $postbox5->have_posts() ) : ?>
            <div class="post-carousel2">
			<?php if(is_admin()): ?>
						<div class="preload_widget_section">
							<h3><?php _e('Slider is here!', 'ahura'); ?></h3>
							<small><?php _e('To see slider please view page.', 'ahura'); ?></small>
						</div>
					<?php else: ?>
                <div class="owl-carousel owl-car2">
					<?php while ( $postbox5->have_posts() ) : $postbox5->the_post(); ?>
						<?php
						$thumb_id  = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src( $thumb_id, 'verthumb', true );
						?>
                        <div class="carousel2post grid-post-grey"
                             style="background-image:url('<?php echo $thumb_url[0]; ?>');">
                            <a href="<?php the_permalink(); ?>">
                                <h2><?php the_title(); ?></h2>
								<?php if ( $settings['date'] == 'yes' ) : ?>
                                    <span><i class="far fa-clock"></i> <?php echo get_the_date( 'd F Y' ); ?></span>
								<?php endif; ?>
                            </a>
                        </div>
					<?php endwhile; ?>
				</div>
		<?php endif; ?>
            </div>
			<?php wp_reset_postdata(); ?>
		<?php else: ?>
		<div class="productcategorybox mw_elem_empty_box"><h3><?php _e('No any post in this category!', 'ahura'); ?></h3></div>
		<?php endif; ?>
        <div class="clear"></div>
		<?php
	}

}
