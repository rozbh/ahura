<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_notice extends \Elementor\Widget_Base {
	use \ahura\app\traits\mw_elementor;
	
	public function get_name() {
		return 'ahura_notice';
	}

	public function get_title() {
		return __( 'Notice', 'ahura' );
	}

	public function get_icon() {
		return 'fas fa-flag';
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
			'notice_title',
			[
				'label' => __("Notice Title", 'ahura'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __("Notice Title Here", 'ahura')
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label' => __("Button Text", 'ahura'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __("Button", 'ahura')
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label' => __("Button Text Color", 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fd5e5e',
				'selectors' => [
					'{{WRAPPER}} .notice_box a.btn' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'notice_box_color',
			[
				'label' => __("Text Color", 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => 'white',
				'selectors' => [
					'{{WRAPPER}} .notice_box .text' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'btn_bgc',
			[
				'label' => __("Button Background Color", 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => 'white',
				'selectors' => [
					'{{WRAPPER}} .notice_box a.btn' => 'background-color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'notice_box_background',
			[
				'label' => __("Box background color", 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fd5e5e',
				'selectors' => [
					'{{WRAPPER}} .notice_box' => 'background-color: {{VALUE}}; color: {{VALUE}}'
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
		$this->end_controls_section();
	}
	protected function render_link_attrs($url_data)
	{
		$target = $url_data['is_external'] ? 'target="_blank"' : '';
		$nofollow = $url_data['nofollow'] ? 'rel="nofollow"' : '';
		$cu_attr = $url_data['custom_attributes'] ? $url_data['custom_attributes'] : false;
		$data = 'href="'.$url_data['url'].'" '.$target.' '.$nofollow.' '.$cu_attr;
		echo $data;
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes('notice_title', 'none');
		$this->add_inline_editing_attributes('btn_text', 'none');
		?>
		<div class="notice_box">
			<div class="text"><?php $this->render_inline_edit_data($settings['notice_title'], 'notice_title');?></div>
			<a <?php $this->render_link_attrs($settings['bnt_link'])?> class="btn"><?php $this->render_inline_edit_data($settings['btn_text'], 'btn_text');?></a>
		</div>
		<?php
	}

}
