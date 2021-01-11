<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_service_price_box extends \Elementor\Widget_Base {
	use \ahura\app\traits\mw_elementor;
	public function get_name() {
		return 'ahoora_service_price_box';
	}

	public function get_title() {
		return __( 'Service Price Box', 'ahura' );
	}

	public function get_icon() {
		return 'fas fa-tags';
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
		$this->add_control(
			'service_box_special_mode',
			[
				'label' => __("Special Mode", 'ahura'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __("Yes", 'ahura'),
				'label_off' => __("No", 'ahura'),
				'return_value' => '1'
			]
		);
		$this->add_control(
			'icon_settings',
			[
				'label' => __("Icon Settings", 'ahura'),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				
			]
		);
		$this->start_popover();
		$this->add_control(
			'service_icon',
			[
				'type' => \Elementor\Controls_Manager::ICONS,
				'label' => __('Service Icon', 'ahura'),
				'description' => __('Choose from font library', 'ahura'),
				'skin'	=>	'inline',
				'exclude_inline_options' => ['svg'],
				'default' => [
					'value' => 'fab fa-apple',
					'library' => 'fa-solid'
				]
			]
		);
		$this->add_control(
			'service_icon_background',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __("Icon Background", 'ahura'),
				'default' => 'transparent',
				'selectors' =>
				[
					'{{WRAPPER}} .icon_wrapper' => 'background-color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'service_icon_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __("Icon Color", 'ahura'),
				'default' => 'white',
				'selectors' =>
				[
					'{{WRAPPER}} .icon_wrapper' => 'color: {{VALUE}}'
				]
			]
		);
		$this->end_popover();
		$this->add_control(
			'box_style_popover',
			[
				'label' => __("Box Style", 'ahura'),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE
			]
		);
		$this->start_popover();
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'service_box_background',
				'selector' => '{{WRAPPER}} .service_colorize_box',
				'fields_options' => 
				[
					'background' => [
						'default' => 'gradient'
					],
					'color' => [
						'default' => '#b67dfb'
					],
					'color_b' => [
						'default' => '#6068f2'
					]
				]
			]
		);
		$this->end_popover();
		$this->add_control(
			'title',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => __('Title', 'ahura'),
				'default' => __("Service Title", 'ahura'),
			]
		);
		$this->add_control(
			'sub_title',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => __('Sub Title', 'ahura'),
				'default' => __("Service Sub Title", 'ahura'),
			]
		);
		
		$this->add_control(
			'button_popover',
			[
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label' => __("Button Settings", 'ahura')
			]
		);
		$this->start_popover();
		$this->add_control(
			'btn_text',
			[
				'label' => __('Button Text', 'ahura'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __("Checkout", 'ahura')
			]
		);
		$this->add_control(
			'btn_bg_color',
			[
				'label' => __("Button Background", 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#6068f2',
				'selectors' =>
				[
					'{{WRAPPER}} .service_link_btn' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .prev-icon i' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label' => __('Button text color', 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => 'white',
				'selectors' => [
					'{{WRAPPER}} .service_link_btn' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'btn_bg_color_on_hover',
			[
				'label' => __("Button Background on hover", 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => 'white',
				'selectors' =>
				[
					'{{WRAPPER}} .service_link_btn:hover' => 'background-color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'btn_color_on_hover',
			[
				'label' => __('Button text color on hover', 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#6068f2',
				'selectors' => [
					'{{WRAPPER}} .service_link_btn:hover' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'url',
			[
				'type' => \Elementor\Controls_Manager::URL,
				'label' => __('Url', 'ahura'),
				'default' => [
					'url' => '#'
				]
			]
		);
		$this->end_popover();
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'item_title',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => __('Item Title', 'ahura'),
				'default' => __("Know More", 'ahura')
			]
		);
		$box_default_data = [
			'item_title' => __("Item Title", 'ahura')
		];
		$this->add_control(
			'service_items_data',
			[
				'type' => \Elementor\Controls_Manager::REPEATER,
				'label' => __("Services Box", 'ahura'),
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{item_title}}}',
				'default' => [
					$box_default_data,
					$box_default_data,
					$box_default_data
				]
			]
		);
		$this->end_controls_section();
	}
	protected function render_link_attrs($url_data, $classes=false)
	{
		$class = $classes ? $classes : false;
		$target = $url_data['is_external'] ? 'target="_blank"' : '';
		$nofollow = $url_data['nofollow'] ? 'rel="nofollow"' : '';
		$cu_attr = $url_data['custom_attributes'] ? $url_data['custom_attributes'] : false;
		$data = 'class="'.$class.'" href="'.$url_data['url'].'" '.$target.' '.$nofollow.' '.$cu_attr;
		echo $data;
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$type = $settings['service_box_special_mode'] ? 1 : 2;
		$this->add_inline_editing_attributes('title', 'none');
		$this->add_inline_editing_attributes('sub_title', 'none');
		$this->add_inline_editing_attributes('btn_text', 'none');
		?>
		<div class="service_price_wrapper">
			<div class="service_price_item <?php echo $type==1 ? 'service_colorize_box' : ''; ?> type-<?php echo $type;?>">
				<div class="head_section <?php echo $type==2 ? 'service_colorize_box' : '';?>">
					<div class="icon_wrapper">
						<?php \Elementor\Icons_Manager::render_icon($settings['service_icon']); ?>
					</div>
					<h3 class="title"><?php echo $this->render_inline_edit_data($settings['title'], 'title');?></h3>
					<span class="sub_title"><?php echo $this->render_inline_edit_data($settings['sub_title'], 'sub_title');?></span>
				</div>
				<ul class="service_items">
					<?php foreach($settings['service_items_data'] as $item_id => $item):
					$repeater_item_key = $this->get_repeater_setting_key('item_title', 'service_items_data', $item_id);
					$this->add_inline_editing_attributes($repeater_item_key, 'none');
						?>
						<li>
							<?php echo $type==2 ? '<span class="prev-icon"><i class="fas fa-check-square"></i></span>' : '';?>
							<span <?php echo $this->get_render_attribute_string($repeater_item_key);?>><?php echo $item['item_title']; ?></span></li>
					<?php endforeach; ?>
				</ul>
				<a <?php $this->render_link_attrs($settings['url'], 'service_link_btn')?>><?php echo $this->render_inline_edit_data($settings['btn_text'], 'btn_text'); ?></a>
			</div>
		</div>
		<?php
	}

}
