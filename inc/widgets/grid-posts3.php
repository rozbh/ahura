<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_Grid_Posts3 extends \Elementor\Widget_Base {

	public function get_name() {
		return 'gridposts3';
	}

	public function get_title() {
		return __( 'Grid Posts 3', 'ahura' );
	}

	public function get_icon() {
		return 'fa fa-th-large';
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
			'author',
			[
				'label'   => __( 'Author', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);

		$this->add_control(
			'time',
			[
				'label'   => __( 'Time', 'ahura' ),
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

	protected function render() {
		$settings = $this->get_settings_for_display();
		$catidd   = $settings['catsid'];
		$post_order = $settings['post_order'];
		$postbox1 = new WP_Query ( array(
			'posts_per_page' => 5,
			'cat'            => $catidd,
            'order'         =>  $post_order
		) );
		if ( $postbox1->have_posts() ) : ?>
		<div class="grid-post3">
			<?php $i=1; while($postbox1->have_posts()): $postbox1->the_post(); $bg_size = $i==5 ? 'full' : 'stthumb'; ?>
				<article style="background: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), $bg_size);?>')" class="item">
					<a href="<?php the_permalink(get_the_ID()); ?>">
						<h3><?php echo get_the_title(); ?></h3>
						<div class="post-meta">
							<?php if($settings['time']): ?>
								<span class="post-date"><i class="fa fa-clock"></i> <?php echo get_the_date('d F Y'); ?></span>
							<?php endif; if($settings['author']):?>
								<span class="post-author"><i class="fa fa-user"></i> <?php the_author() ?></span>
							<?php endif; ?>
						</div>
					</a>
				</article>
			<?php $i++;endwhile; ?>
			</div>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
        <div class="clear"></div>
		<?php
	}

}
