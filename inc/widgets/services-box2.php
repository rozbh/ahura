<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_services_box2 extends \Elementor\Widget_Base {
	use \ahura\app\traits\mw_elementor;
	public function get_name() {
		return 'ahoora_services_box2';
	}

	public function get_title() {
		return __( 'Services Box 2', 'ahura' );
	}

	public function get_icon() {
		return 'fas fa-boxes';
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
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'service_icon',
			[
				'label'    => __( 'Service Icon', 'ahura' ),
				'type'     => \Elementor\Controls_Manager::ICONS,
				'description' => __('Choose from font library or upload your own icon', 'ahura'),
				'default' => [
					'value' => 'fas fa-compass',
					'library' => 'fa-solid'
				]
			]
		);

		$repeater->add_control(
			'service_title',
			[
				'label'   => __( 'Service Title', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __('Service Title', 'ahura')
			]
		);

		$repeater->add_control(
			'service_description',
			[
				'label'   => __( 'Service Description', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __('Service description here', 'ahura')
			]
		);
		// icon style
		
		$repeater->add_control(
			'icon_background_color',
			[
				'label' => __('Icon Background Color', 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => 'white',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .icon_wrapper' => 'background-color: {{VALUE}}'
				]
			]
		);
		$repeater->add_control(
			'icon_color',
			[
				'label' => __('Icon Color', 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fd5e5e',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .service_icon' => 'color: {{VALUE}}'
				]
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'ah_icon_border',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .icon_wrapper',
				'fields_options' => [
					'border' => [
						'label' => __('Icon border', 'ahura'),
						'default' => 'solid'
					],
					'width' => [
						'default' => [
							'unit' => 'px',
							'top' => '10',
							'right' => '10',
							'bottom' => '10',
							'left' => '10',
						]
					],
					'color' => [
						'default' => '#fd5e5e'
					]
				]
			]
		);
		// end icon style

		// title style
		$repeater->add_control(
			'title_color',
			[
				'label' => __("Title Color", 'ahura'),
				'name' => 'title_color',
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fd5e5e',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .ah_title' => 'color: {{VALUE}}'
				]
			]
		);

		$repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => __('Title typography', 'ahura'),
				'name' => 'ah_title_typography',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .ah_title',
			]
		);
		// end title style

		// description style
		$repeater->add_control(
			'description_color',
			[
				'label' => __("Description Color", 'ahura'),
				'name' => 'title_color',
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fd5e5e',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .description' => 'color: {{VALUE}}'
				]
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => __('Description typography', 'ahura'),
				'name' => 'ah_description_typography',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .description',
			]
		);
		// end description

		$repeater->add_control(
			'scale',
			[
				'label' => __("Special Mode", 'ahura'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'ahura'),
				'label_of' => __("No", 'ahura'),
				'return_value' => '1',
				'default' => ''
			]
		);
		$repeater->add_control(
			'overlay_box_background',
			[
				'label' => __('Overlay box background color', 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fd5e5e',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .box_overlay' => 'background-color: {{VALUE}}'
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'scale',
							'value' => '1',
							'operator' => '=='
						]
					]
				]
			]
		);
		$repeater->add_control(
			'box_border_bottom_color',
			[
				'label' => __('Box bottom border color', 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}::after' => 'border-color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'services',
			[
				'type' => \Elementor\Controls_Manager::REPEATER,
				'label' => __("Services Box", 'ahura'),
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{service_title}}}',
				'default' => [
					[
						'service_title' => __("First Box", 'ahura'),
						'service_description' => __("Box 1 description here", 'ahura'),
						'ah_icon_border_border' => 'solid',
						'ah_icon_border_width' => [
							'unit' => 'px',
							'top' => '10',
							'right' => '10',
							'left' => '10',
							'bottom' => '10'
						],
						'ah_icon_border_color' => '#fd5e5e',
						'box_border_bottom_color' => '#fd5e5e'
					],
					[
						'service_title' => __("Second Box", 'ahura'),
						'service_description' => __("Box 2 description here", 'ahura'),
						'scale' => '1',
						'icon_color' => '#d84e4e',
						'title_color' => 'white',
						'description_color' => 'white',
						'ah_icon_border_border' => 'solid',
						'ah_icon_border_width' => [
							'unit' => 'px',
							'top' => '10',
							'right' => '10',
							'left' => '10',
							'bottom' => '10'
						],
						'ah_icon_border_color' => '#d84e4e',
						'box_border_bottom_color' => '#fd5e5e'
					],
					[
						'service_title' => __("Third Box", 'ahura'),
						'service_description' => __('Box 3 description here', 'ahura'),
						'ah_icon_border_border' => 'solid',
						'ah_icon_border_width' => [
							'unit' => 'px',
							'top' => '10',
							'right' => '10',
							'left' => '10',
							'bottom' => '10'
						],
						'ah_icon_border_color' => '#fd5e5e',
						'box_border_bottom_color' => '#fd5e5e'
					]
				]
			]
		);
		$this->end_controls_section();
	}
	protected function get_service_icon($settings)
	{
		if(isset($settings['service_icon']['library']) && $settings['service_icon']['library'] == 'svg')
		{
			$render = '<img src="'.$settings['service_icon']['value']['url'].'" />';
		}else{
			$render = '<span class="'.$settings['service_icon']['value'].'"></span>';
		}
		return $render;
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		echo '<div class="services_elem_2"><div class="row">';
		foreach($settings['services'] as $service_id => $service)
		{
			$icon = $this->get_service_icon($service);
			$repeater_title_key = $this->get_repeater_setting_key('service_title', 'services', $service_id);
			$repeater_description_key = $this->get_repeater_setting_key('service_description', 'services', $service_id);
			$this->add_inline_editing_attributes($repeater_title_key, 'none');
			$this->add_inline_editing_attributes($repeater_description_key, 'none');
			?>
			<div class="col-md-4 <?php echo $service['scale'] ? 'ah_bold' : ''; ?> service_item_wrapper elementor-repeater-item-<?php echo $service['_id'];?>">
				<div class="service_item">
					<div class="icon_wrapper">
						<span class="service_icon"><?php echo $icon;?></span>
					</div>
					<h3 class="ah_title"><?php echo $this->render_inline_edit_data($service['service_title'], $repeater_title_key);?></h3>
					<p class="description"><?php echo $this->render_inline_edit_data($service['service_description'], $repeater_description_key); ?></p>
					<div class="box_overlay"></div>

				</div>
			</div>
			<?php
		}
		echo '</div></div>';
	}

}
