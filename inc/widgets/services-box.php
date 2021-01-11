<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_services_box extends \Elementor\Widget_Base {
	use \ahura\app\traits\mw_elementor;
	public function get_name() {
		return 'ahoora_services_box';
	}

	public function get_title() {
		return __( 'Services Box', 'ahura' );
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
		
		$this->add_control(
			'service_icon',
			[
				'label'    => __( 'Service Icon', 'ahura' ),
				'type'     => \Elementor\Controls_Manager::ICONS,
				'description' => __('Choose from font library or upload your own icon', 'ahura'),
				'default' => [
					'value' => 'fas fa-concierge-bell',
					'library' => 'fa-solid'
				]
			]
		);

		$this->add_control(
			'service_title',
			[
				'label'   => __( 'Service Title', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __('Service Title', 'ahura')
			]
		);

		$this->add_control(
			'service_description',
			[
				'label'   => __( 'Service Description', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __('Service Description', 'ahura')
			]
		);
		$this->add_control(
			'service_link',
			[
				'type' => \Elementor\Controls_Manager::URL,
				'label' => __('Service Link', 'ahura')
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'color_style_section',
			[
				'label' => __('Color', 'ahura'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'icon_background_color',
			[
				'label' => __('Icon Background Color', 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fd5e5e',
				'selectors' => [
					'{{WRAPPER}} .icon_section' => 'background-color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __('Icon Color', 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => 'white',
				'selectors' => [
					'{{WRAPPER}} .icon_section' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __("Title Color", 'ahura'),
				'name' => 'title_color',
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#35495C',
				'selectors' => [
					'{{WRAPPER}} .ah_title' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'description_color',
			[
				'label' => __("Description Color", 'ahura'),
				'name' => 'title_color',
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#35495C',
				'selectors' => [
					'{{WRAPPER}} .description' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'	=>	'ah_background_color',
				'type' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .services_elem',
				'fields_options' =>
				[
					'background' =>
					[
						'default' => 'classic'
					],
					'color' =>
					[
						'default' => 'white'
					]
				]
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'other_setting',
			[
				'label' => __('Other', 'ahura'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'ah_icon_border',
				'selector' => '{{WRAPPER}} .icon_section',
				'fields_options' =>
				[
					'border' =>
					[
						'label' => __('Icon border', 'ahura'),
					]
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'ah_box_border',
				'selector' => '{{WRAPPER}} .services_elem',
				'fields_options' =>
				[
					'border' =>
					[
						'label' => __('Box border settings', 'ahura'),
					]
				]
			]
		);
		$this->add_control(
			'ah_no_icon_padding',
			[
				'label' => __('No Icon Padding', 'ahura'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'ahura'),
				'label_of' => __("No", 'ahura'),
				'return_value' => '1',
				'default' => ''
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => __('Title typography', 'ahura'),
				'name' => 'ah_title_typography',
				'selector' => '{{WRAPPER}} .ah_title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => __('Description typography', 'ahura'),
				'name' => 'ah_description_typography',
				'selector' => '{{WRAPPER}} .description',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'label' => __('Boxshadow', 'ahura'),
				'name' => 'ah_wrapper_boxshadow',
				'selector' => '{{WRAPPER}} .services_elem'
			]
		);
		$alignment_option = [
			'right' => [
				'title' => __("Right", 'ahura'),
				'icon' => 'fa fa-align-right'
			],
			'center' => [
				'title' => __("Center", 'ahura'),
				'icon' => 'fa fa-align-center'
			],
			'left'	=>	[
				'title' => __('Left', 'ahura'),
				'icon'	=>	'fa fa-align-left'
			]
		];
		$this->add_control(
			'alignment',
			[
				'label' => __("Alignment", "ahura"),
				'type'	=>	\Elementor\Controls_Manager::CHOOSE,
				'options'	=>	is_rtl() ? $alignment_option : array_reverse($alignment_option),
				'default' => 'right',
				'toggle' => false
			]
		);
		$this->add_control(
			'scale',
			[
				'label' => __("Box Scale", 'ahura'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'ahura'),
				'label_of' => __("No", 'ahura'),
				'return_value' => '1',
			]
		);
		$this->end_controls_section();
	}
	protected function get_wrapper_tag($settings)
	{
		$scale_class = $settings['scale'] ? 'scale' : '';
		$class = 'class="services_elem '.$scale_class.' ah_align_'.$settings['alignment'].'"';
		if(!$settings['service_link']['url'])
		{
			$tag['open'] = '<div '.$class.'>';
			$tag['close'] = '</div>';
			return $tag;
		}
		$target = $settings['service_link']['is_external'] ? 'target="_blank"' : '';
		$nofollow = $settings['service_link']['nofollow'] ? 'rel="nofollow"' : '';
		$cu_attr = $settings['service_link']['custom_attributes'] ? $settings['service_link']['custom_attributes'] : false;
		$tag['open'] = '<a '.$class.' href="'.$settings['service_link']['url'].'" '.$target.' '.$nofollow.' '.$cu_attr.'>';
		$tag['close'] = '</a>';
		return $tag;
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
		$icon = $this->get_service_icon($settings);
		$title = $settings['service_title'];
		$content = $settings['service_description'];
		$wrapper_tag = $this->get_wrapper_tag($settings);
		$this->add_inline_editing_attributes('service_title', 'none');
		$this->add_inline_editing_attributes('service_description', 'none');
		echo $wrapper_tag['open']
		?>
			<div class="icon_wrapper">
				<div class="icon_section" <?php echo $settings['ah_no_icon_padding'] ? 'style="padding: 0;"' : ''?>>
					<?php echo $icon; ?>
				</div>
			</div>
			<div class="ah_title"><?php echo $this->render_inline_edit_data($title, 'service_title'); ?></div>
			<p class="description"><?php echo $this->render_inline_edit_data($content, 'service_description');?></p>
		<?php
		echo $wrapper_tag['close'];
	}

}
