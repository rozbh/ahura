<?php

// Block direct access to the main plugin file.

use ahura\app\woocommerce;

defined('ABSPATH') or die('No script kiddies please!');


class Elementor_shop_category1 extends \Elementor\Widget_Base
{

	public function get_name()
	{
		return 'shopcategory1';
	}

	public function get_title()
	{
		return __('Products Category 1', 'ahura');
	}

	public function get_icon()
	{
		return 'fa fa-shopping-cart';
	}

	public function get_categories()
	{
		return ['ahuraelements'];
	}

	protected function _register_controls()
	{
		if (!woocommerce::is_active()) {
			return false;
		}
		$this->start_controls_section(
			'content_section',
			[
				'label' => __('Content', 'ahura'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$categories = get_terms(array(
			'taxonomy' => 'product_cat',
			'hide_empty' => false,
		));
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
				'multiple' => false,
				'default' => $default
			]
		);

		$this->add_control(
			'price',
			[
				'label'   => __('Show Price', 'ahura'),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'yes' => ['title' => __('Yes', 'ahura'), 'icon' => 'fa fa-check-circle'],
					'no'  => ['title' => __('No', 'ahura'), 'icon' => 'fa fa-times-circle']
				],
				'default' => 'yes'
			]
		);

		$this->add_control(
			'count',
			[
				'label'      => __('Number of posts', 'ahura'),
				'type'       => \Elementor\Controls_Manager::NUMBER,
				'default'    => 8
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

		$this->add_control(
			'border_color',
			[
				'label'      => __('Border Color', 'ahura'),
				'type'       => \Elementor\Controls_Manager::COLOR,
				'default'    => '#444',
				'selectors' => [
					'{{WRAPPER}} .mw_shop_cat_title_border' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		if (class_exists('WooCommerce')) {

			$wc_query = new WP_Query(array(
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'posts_per_page' => $settings['count'],
				'tax_query' => array(
					array(
						'taxonomy' => 'product_cat',
						'field' => 'term_id',
						'terms' => $settings['catsid'],
					)
				),
				'order'         =>  $settings['product_order']
			));
			$first_cat_id = is_array($settings['catsid']) ? $settings['catsid'][0] : $settings['catsid'];
			if ($wc_query->have_posts()) : ?>
				<div class="mw_shop_cat">
					<div class="mw_shop_cat_title_border"></div>
					<h2><?php $term = get_term_by('id', $first_cat_id, 'product_cat');echo $term->name;?>
					</h2>
					
					<?php while ($wc_query->have_posts()) : $wc_query->the_post(); ?>
					<a href="<?php the_permalink();?>" class="mw_shop_cat_item">
					<?php if ( get_post_meta( get_the_ID(),'_sale_price',true) != null ):?>
							<div class="mw_shop_cat_item_off_over">
								<i class="fa fa-star"></i>
							</div>
					<?php endif;?>
							<div class="mw_shop_cat_item_pic">
								<?php the_post_thumbnail('woocommerce_thumbnail'); ?>
							</div>
							<div class="mw_shop_cat_item_data">
								<h3><?php the_title();?></h3>
								<?php if ( $settings['price'] == 'yes' ) : ?>
                                    <div class="mw_shop_cat_item_price">
										<?php if ( get_post_meta( get_the_ID(),'_sale_price',true) != null ):?>
											<span><span class="mw_shop_cat_item_data_regular_price"><?php echo get_post_meta( get_the_ID(),'_regular_price',true);echo get_woocommerce_currency_symbol();?></span><?php echo get_post_meta( get_the_ID(),'_sale_price',true);echo get_woocommerce_currency_symbol();?></span>
											<?php else:?>
											<span><?php echo get_post_meta( get_the_ID(),'_regular_price',true);?> <?php echo get_woocommerce_currency_symbol();?></span>
											<?php endif;?>
                                    </div>
								<?php endif; ?>
							</div>
					</a>

					<?php endwhile; ?>

				</div>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<h3><?php _e('No any post in this category!', 'ahura'); ?></h3>
			<?php endif; ?>
			<div class="clear"></div>
<?php
		}
	}
}
