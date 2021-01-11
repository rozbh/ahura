<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_Post_Archive extends \Elementor\Widget_Base {

	public function get_name() {
		return 'postarchive';
	}

	public function get_title() {
		return __( 'Post Archive', 'ahura' );
	}

	public function get_icon() {
		return 'fa fa-inbox';
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
			'date',
			[
				'label'   => __( 'Show Date', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'yes' => [
						'title' => __( 'Yes', 'ahura' ),
						'icon'  => 'fa fa-check-circle'
					],
					'no'  => [
						'title' => __( 'No', 'ahura' ),
						'icon'  => 'fa fa-times-circle'
					]
				],
				'default' => 'yes'
			]
		);

		$this->add_control(
			'author',
			[
				'label'   => __( 'Show Author', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'yes' => [
						'title' => __( 'Yes', 'ahura' ),
						'icon'  => 'fa fa-check-circle'
					],
					'no'  => [
						'title' => __( 'No', 'ahura' ),
						'icon'  => 'fa fa-times-circle'
					]
				],
				'default' => 'yes'
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
			'postcount',
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
		$first_cat_id = $catidd && is_array($catidd) ? $catidd[0] : $catidd;
		$show_author = $settings['author'];
		$show_date = $settings['date'];
		$show_meta_tag = $show_author == 'yes' || $show_date == 'yes';
		?>
        <div class="postbox4">
            <h2 style="border-right-color:<?php echo $settings['color']; ?>;color:<?php echo $settings['color']; ?>"
                class="cat-name"><?php echo get_cat_name( $first_cat_id ) ?></h2><a
                    style="background-color:<?php echo $settings['color']; ?>;box-shadow:0 5px 20px <?php echo $settings['color']; ?>80"
                    class="cat-more-link"
                    href="<?php echo get_category_link( $catidd[0] ) ?>"><?php echo __( 'Show All', 'ahura' ); ?></a>
			<?php $postbox4 = new WP_Query ( array(
				'posts_per_page' => $settings['postcount'],
				'cat'            => $settings['catsid'],
                'order'         =>  $settings['post_order']
			) );
			if ( $postbox4->have_posts() ) : ?>
            <div class="clear"></div>
            <div class="flexed row">
				<?php while ( $postbox4->have_posts() ) : $postbox4->the_post(); ?>
                    <div class="col-md-4 col-lg-3">
                        <article>
                            <a class="fimage"
                               href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'stthumb' ); ?></a>
                            <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
							<?php if ( $settings['excerpt'] == 'yes' ) : ?>
								<div class="excerpt <?php echo $show_meta_tag ? 'has_margin' : ''; ?>">
									<?php the_excerpt();?>
								</div>
							<?php endif; ?>
							<?php if($show_meta_tag): ?>
								<div class="meta">
							<?php endif; ?>
							<?php if ( $show_author == 'yes' ) : ?>
                                <span class="post-author"><?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?><?php the_author(); ?></span>
							<?php endif; ?>
							<?php if ( $show_date == 'yes' ) : ?>
                                <span class="post-meta"><i
                                            class="far fa-clock"></i> <?php echo get_the_date( 'd F Y' ); ?></span>
							<?php endif; ?>
							<?php if($show_meta_tag): ?>
								</div>
							<?php endif; ?>
                        </article>
                    </div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
				<?php endif; ?>
            </div>
        </div>
        <div class="clear"></div>
		<?php
	}

}
