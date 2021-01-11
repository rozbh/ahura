<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_banner_box1 extends \Elementor\Widget_Base {
	use \ahura\app\traits\mw_elementor;
	
	public function get_name() {
		return 'ahura_banner_box1';
	}

	public function get_title() {
		return __( 'Banner Box 1', 'ahura' );
	}

	public function get_icon() {
		return 'fas fa-images';
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
			'box_title',
			[
				'label' => __("Box Title", 'ahura'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __("Box Title Here", 'ahura')
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __("Title", 'ahura'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __("Title Here", 'ahura')
			]
		);
		$this->add_control(
			'content',
			[
				'label' => __("Content", 'ahura'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __("Content Here", 'ahura')
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __("Title Typography","ahura"),
				'selector' => '{{WRAPPER}} .content_section .title',
				'fields_options' =>
				[
					'font_size' => [
						'default' => [
							'unit' => 'rem',
							'size' => '2.5'
						]
					]
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __("Content Typography","ahura"),
				'selector' => '{{WRAPPER}} .content_section .content',
				'fields_options' =>
				[
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '18'
						]
					]
				]
			]
		);
		$this->add_control(
			'title_box_background',
			[
				'label' => __("Title box background", 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#6EC1E4',
				'selectors' => [
					'{{WRAPPER}} .title_box .overlay' => 'background-color: {{VALUE}}'
					]
			]
		);
		$this->add_control(
			'show_btn',
			[
				'label' => __( 'Show Button', 'ahura' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ahura' ),
				'label_off' => __( 'Hide', 'ahura' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'cta_btn_popover',
			[
				'label' => __("Button", 'ahura'),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE
			]
		);
		$this->start_popover();
		$this->add_control(
			'btn_text',
			[
				'label' => __("Button Text", 'ahura'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __("More", 'ahura')
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label' => __("Button Text Color", 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#6EC1E4',
				'selectors' => [
					'{{WRAPPER}} .btn_cta' => 'color: {{VALUE}}',
					'{{WRAPPER}} .btn_cta:hover' => 'border-color: {{VALUE}}; background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'bnt_link',
			[
				'label' => __("Url", 'ahura'),
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [
					'url' => '#'
				]
			]
		);
		$this->end_popover();
		$this->add_control(
			'top_box_popover',
			[
				'label' => __("Top Box", 'ahura'),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE
			]
		);
		$this->start_popover();
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'top_box_image',
				'selector' => '{{WRAPPER}} .top_image',
				'fields_options' =>
				[
					'background' => 
					[
						'default' => 'classic'
					],
					'color' => [
						'default' => '#6EC1E4'
					]
				]
			]
		);
		$this->end_popover();
		$this->add_control(
			'bottom_box_popover',
			[
				'label' => __("Bottom Box", 'ahura'),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE
			]
		);
		$this->start_popover();
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'bottom_box_image',
				'selector' => '{{WRAPPER}} .bottom_image',
				'fields_options' =>
				[
					'background' => 
					[
						'default' => 'classic'
					],
					'color' => [
						'default' => '#6EC1E4'
					]
				]
			]
		);
		$this->end_popover();
		$this->add_control(
			'circular_box',
			[
				'label' => __('Circular Box', 'ahura'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'ahura'),
				'label_off' => __('No', 'ahura'),
				'return_value' => 1
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
		$this->add_inline_editing_attributes('box_title', 'none');
		$this->add_inline_editing_attributes('title', 'none');
		$this->add_inline_editing_attributes('content', 'none');
		$this->add_inline_editing_attributes('btn_text', 'none');
		$mode = isset($settings['circular_box']) && $settings['circular_box'] ? 'circle_mode' : '';
		?>
		<div class="banner-box1">
			<div class="image_section <?php echo $mode?>">
				<div class="top_image"></div>
				<div class="title_box"><h3 <?php echo $this->get_render_attribute_string('box_title');?> ><?php echo $settings['box_title']; ?></h3><div class="overlay"></div></div>
				<div class="bottom_image"></div>
			</div>
			<div class="content_section">
				<h3 class="title"><?php $this->render_inline_edit_data($settings['title'], 'title'); ?></h3>
				<p class="content"><?php $this->render_inline_edit_data($settings['content'], 'content'); ?></p>
				<?php if($settings['show_btn'] == 'yes'):?>
				<div class="btn_wrapper">
					<a <?php $this->render_link_attrs($settings['bnt_link'], 'btn_cta');?>><?php $this->render_inline_edit_data($settings['btn_text'], 'btn_text');?></a>
				</div>
				<?php endif;?>
			</div>
		</div>
		<?php
	}

}
