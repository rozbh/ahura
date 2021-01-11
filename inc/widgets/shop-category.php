<?php

// Block direct access to the main plugin file.

use ahura\app\woocommerce;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_shop_category extends \Elementor\Widget_Base {

	public function get_name() {
		return 'shopcategory';
	}

	public function get_title() {
		return __( 'Products Category', 'ahura' );
	}

	public function get_icon() {
		return 'fa fa-shopping-cart';
	}

	public function get_categories() {
		return [ 'ahuraelements' ];
	}

	protected function _register_controls() {
		if(!woocommerce::is_active())
		{
			return false;
		}
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'ahura' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$categories = get_terms( array(
			'taxonomy' => 'product_cat',
			'hide_empty' => false,
		));
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
			'price',
			[
				'label'   => __( 'Show Price', 'ahura' ),
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
			'image',
			[
				'label'      => __( 'Image', 'ahura' ),
				'type'       => \Elementor\Controls_Manager::MEDIA
			]
		);

		$this->add_control(
			'product_order',
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

		if ( class_exists( 'WooCommerce' ) ) {

			$wc_query = new WP_Query( array(
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'posts_per_page' => $settings['count'],
				'tax_query' => array(
					array (
							'taxonomy' => 'product_cat',
							'field' => 'term_id',
							'terms' => $settings['catsid'],
					)
				),
        		'order'         =>  $settings['product_order']
			) );
			$first_cat_id = is_array($settings['catsid']) ? $settings['catsid'][0] : $settings['catsid'];
			if ( $wc_query->have_posts() ) : ?>
                <div class="productcategorybox">
                    <section style="background-color:<?php echo $settings['color'];?>" class="prcatboxtitle">
                        <img src="<?php echo $settings['image']['url'];?>"/>
                        <h2>
                            <?php $term = get_term_by( 'id', $first_cat_id, 'product_cat' ); 
                            echo $term->name; ?>
                        </h2>
                        <a href="<?php echo get_term_link( $term );?>"><?php _e('All Products', 'ahura'); ?></a>
                        <div class="clear"></div>
					</section>
					<?php if(is_admin()): ?>
						<div class="preload_widget_section">
							<h3><?php _e('Slider is here!', 'ahura'); ?></h3>
							<small><?php _e('To see slider please view page.', 'ahura'); ?></small>
						</div>
					<?php else: ?>
                    <div class="owl-carousel owl-car1">
						<?php while ( $wc_query->have_posts() ) : $wc_query->the_post(); ?>
                            <div>
                                <a class="fimage"
                                   href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'woocommerce_thumbnail' ); ?></a>
                                <a href="<?php the_permalink(); ?>">
                                    <h3><?php echo wp_trim_words( get_the_title(), 8, '...' ); ?></h3></a>
								<?php if ( $settings['price'] == 'yes' ) : ?>
                                    <div class="mwprprice">
										<?php
										$price = get_post_meta( get_the_ID(), '_price', true );
										echo wc_price( $price );
										?>
                                    </div>
								<?php endif; ?>
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
		}elseif(is_admin()){
			?>
			<div class="productcategorybox mw_elem_empty_box"><h3><?php _e('To use this element you must install woocommerce plugin.', 'ahura'); ?></h3></div>
			<?php
		}
	}

}
