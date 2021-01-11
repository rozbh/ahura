<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_Blog_Box_Posts extends \Elementor\Widget_Base {

	public function get_name() {
		return 'blogbox';
	}

	public function get_title() {
		return __( 'Blog Box', 'ahura' );
	}

	public function get_icon() {
		return 'fa fa-copy';
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
				'label_block' => true,
				'options'  => $cats,
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
				'label'   => __( 'Time', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'yes' => [ 'title' => __( 'Yes', 'ahura' ), 'icon' => 'fa fa-check-circle' ],
					'no'  => [ 'title' => __( 'No', 'ahura' ), 'icon' => 'fa fa-times-circle' ]
				],
				'default' => 'yes'
			]
		);

		$this->add_control(
			'author',
			[
				'label'   => __( 'Author', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'yes' => [ 'title' => __( 'Yes', 'ahura' ), 'icon' => 'fa fa-check-circle' ],
					'no'  => [ 'title' => __( 'No', 'ahura' ), 'icon' => 'fa fa-times-circle' ]
				],
				'default' => 'yes'
			]
		);

		$this->add_control(
			'comments',
			[
				'label'   => __( 'Comments', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'yes' => [ 'title' => __( 'Yes', 'ahura' ), 'icon' => 'fa fa-check-circle' ],
					'no'  => [ 'title' => __( 'No', 'ahura' ), 'icon' => 'fa fa-times-circle' ]
				],
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
		$catsidd  = $settings['catsid'];
		$first_cat_id = $catsidd && is_array($catsidd) ? $catsidd[0] : $catsidd;
		?>
        <div class="postbox2">
            <h2 style="border-right-color:<?php echo $settings['color']; ?>;color:<?php echo $settings['color']; ?>"
                class="cat-name"><?php echo get_cat_name( $first_cat_id ) ?></h2><a
                    style="background-color:<?php echo $settings['color']; ?>;box-shadow:0 5px 20px <?php echo $settings['color']; ?>80"
                    class="cat-more-link"
                    href="<?php echo get_category_link( $first_cat_id ) ?>"><?php echo __( 'Show All', 'ahura' ); ?></a>
			<?php $postbox2one = new WP_Query ( array(
				'posts_per_page' => 1,
				'cat'            => $settings['catsid'],
                'order'         =>  $settings['post_order']
			) );
			if ( $postbox2one->have_posts() ) : ?>
                <div class="clear"></div>
                <div class="postbox2post1 row">
					<?php while ( $postbox2one->have_posts() ) : $postbox2one->the_post(); ?>
                        <div class="col-md-12">
                            <article>
                                <a class="fimage"
                                   href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'stthumb' ); ?></a>
                                <a href="<?php the_permalink(); ?>">
                                    <h3><?php echo wp_trim_words( get_the_title(), 7, '...' ); ?></h3></a>
                                <ul class="post-meta">
									<?php if ( $settings['date'] == 'yes' ) : ?>
                                        <li><i class="far fa-clock"></i> <?php echo get_the_date( 'd F Y' ); ?></li>
									<?php endif; ?>
									<?php if ( $settings['author'] == 'yes' ) : ?>
                                        <li><i class="far fa-user"></i> <?php the_author(); ?></li>
									<?php endif; ?>
									<?php if ( $settings['comments'] == 'yes' ) : ?>
                                        <li><i class="far fa-comments"></i> <?php comments_number( '0', '1', '%' );
											__( 'Comments', 'ahura' ); ?></li>
									<?php endif; ?>
                                </ul>
								<?php the_excerpt(); ?>
                            </article>
                        </div>
					<?php endwhile; ?>
                </div>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
			<?php $postbox2more = new WP_Query ( array(
				'offset'         => 1,
				'posts_per_page' => 3,
				'cat'            => $settings['catsid'],
			) );
			if ( $postbox2more->have_posts() ) : ?>
                <div class="postbox2post2 row">
					<?php while ( $postbox2more->have_posts() ) : $postbox2more->the_post(); ?>
                        <div class="col-md-4">
                            <article>
                                <a class="fimage"
                                   href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'stthumb' ); ?></a>
                                <a href="<?php the_permalink(); ?>">
                                    <h4><?php echo wp_trim_words( get_the_title(), 6, '...' ); ?></h4></a>
                            </article>
                        </div>
					<?php endwhile; ?>
                </div>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
        </div>
		<?php
	}

}
