<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_Grid_Posts2 extends \Elementor\Widget_Base {

	public function get_name() {
		return 'gridposts2';
	}

	public function get_title() {
		return __( 'Grid Posts 2', 'ahura' );
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
				'default'	=>	$default
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
			'posts_per_page' => 1,
			'cat'            => $catidd,
            'order'         =>  $post_order
		) );
		$postbox2 = new WP_Query ( array(
			'posts_per_page' => 1,
			'offset'         => 1,
			'cat'            => $catidd,
            'order'         =>  $post_order
		) );
		$postbox3 = new WP_Query ( array(
			'posts_per_page' => 1,
			'offset'         => 2,
			'cat'            => $catidd,
            'order'         =>  $post_order
		) );
		$postbox4 = new WP_Query ( array(
			'posts_per_page' => 1,
			'offset'         => 3,
			'cat'            => $catidd,
            'order'         =>  $post_order
		) );
		$postbox5 = new WP_Query ( array(
			'posts_per_page' => 1,
			'offset'         => 4,
			'cat'            => $catidd,
            'order'         =>  $post_order
		) );
		if ( $postbox1->have_posts() ) : ?>
            <div class="row grid-post2">
                <div class="col-md-6">
					<?php while ( $postbox1->have_posts() ) : $postbox1->the_post(); ?>
						<?php
						$thumb_id  = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src( $thumb_id, 'full', true );
						?>
                        <article class="mb-4 grid-post grid-post-red"
                                 style="background-image:url('<?php echo $thumb_url[0]; ?>');">
                            <a href="<?php the_permalink(); ?>" style="height:524px">
                                <div class="grid-information">
                                    <h2><?php the_title(); ?></h2>
									<?php if ( $settings['time'] == 'yes' ): ?>
                                        <span><i class="far fa-clock"></i> <?php echo get_the_date( 'd F Y' ); ?></span>
									<?php endif; ?>
									<?php if ( $settings['author'] == 'yes' ): ?>
                                        <span class="post-author"><i
                                                    class="far fa-user"></i> <?php the_author(); ?></span>
									<?php endif; ?>
                                </div>
                            </a>
                        </article>
					<?php endwhile; ?>
                </div>

                <div class="col-md-3">
					<?php while ( $postbox2->have_posts() ) : $postbox2->the_post(); ?>
						<?php
						$thumb_id  = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src( $thumb_id, 'stthumb', true );
						?>
                        <article class="mb-4 grid-post grid-post-green grid-post-small"
                                 style="background-image:url('<?php echo $thumb_url[0]; ?>');">
                            <a href="<?php the_permalink(); ?>" style="height:200px">
                                <div class="grid-information">
                                    <h2><?php the_title(); ?></h2>
									<?php if ( $settings['time'] == 'yes' ): ?>
                                        <span><i class="far fa-clock"></i> <?php echo get_the_date( 'd F Y' ); ?></span>
									<?php endif; ?>
									<?php if ( $settings['author'] == 'yes' ): ?>
                                        <span class="post-author"><i
                                                    class="far fa-user"></i> <?php the_author(); ?></span>
									<?php endif; ?>
                                </div>
                            </a>
                        </article>
					<?php endwhile; ?>
					<?php while ( $postbox3->have_posts() ) : $postbox3->the_post(); ?>
						<?php
						$thumb_id  = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src( $thumb_id, 'verthumb', true );
						?>
                        <article class="mb-4 grid-post grid-post-purple grid-post-small"
                                 style="background-image:url('<?php echo $thumb_url[0]; ?>');">
                            <a href="<?php the_permalink(); ?>" style="height:300px">
                                <div class="grid-information">
                                    <h2><?php the_title(); ?></h2>
									<?php if ( $settings['time'] == 'yes' ): ?>
                                        <span><i class="far fa-clock"></i> <?php echo get_the_date( 'd F Y' ); ?></span>
									<?php endif; ?>
									<?php if ( $settings['author'] == 'yes' ): ?>
                                        <span class="post-author"><i
                                                    class="far fa-user"></i> <?php the_author(); ?></span>
									<?php endif; ?>
                                </div>
                            </a>
                        </article>
					<?php endwhile; ?>
                </div>


                <div class="col-md-3">
					<?php while ( $postbox4->have_posts() ) : $postbox4->the_post(); ?>
						<?php
						$thumb_id  = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src( $thumb_id, 'verthumb', true );
						?>
                        <article class="mb-4 grid-post grid-post-orange grid-post-small"
                                 style="background-image:url('<?php echo $thumb_url[0]; ?>');">
                            <a href="<?php the_permalink(); ?>" style="height:300px">
                                <div class="grid-information">
                                    <h2><?php the_title(); ?></h2>
									<?php if ( $settings['time'] == 'yes' ): ?>
                                        <span><i class="far fa-clock"></i> <?php echo get_the_date( 'd F Y' ); ?></span>
									<?php endif; ?>
									<?php if ( $settings['author'] == 'yes' ): ?>
                                        <span class="post-author"><i
                                                    class="far fa-user"></i> <?php the_author(); ?></span>
									<?php endif; ?>
                                </div>
                            </a>
                        </article>
					<?php endwhile; ?>
					<?php while ( $postbox5->have_posts() ) : $postbox5->the_post(); ?>
						<?php
						$thumb_id  = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src( $thumb_id, 'stthumb', true );
						?>
                        <article class="mb-4 grid-post grid-post-blue grid-post-small"
                                 style="background-image:url('<?php echo $thumb_url[0]; ?>');">
                            <a href="<?php the_permalink(); ?>" style="height:200px">
                                <div class="grid-information">
                                    <h2><?php the_title(); ?></h2>
									<?php if ( $settings['time'] == 'yes' ): ?>
                                        <span><i class="far fa-clock"></i> <?php echo get_the_date( 'd F Y' ); ?></span>
									<?php endif; ?>
									<?php if ( $settings['author'] == 'yes' ): ?>
                                        <span class="post-author"><i
                                                    class="far fa-user"></i> <?php the_author(); ?></span>
									<?php endif; ?>
                                </div>
                            </a>
                        </article>
					<?php endwhile; ?>
                </div>

            </div>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
        <div class="clear"></div>
		<?php
	}

}
