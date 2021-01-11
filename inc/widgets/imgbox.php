<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_imgbox extends \Elementor\Widget_Base {

	public function get_name() {
		return 'imagebox';
	}
  
	public function get_title() {
		return __( 'Image Box', 'ahura' );
	}

	public function get_icon() {
		return 'fa fa-image';
	}

	public function get_categories() {
		return [ 'ahuraelements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'ahura' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'ahura' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __("Title Here", 'ahura')
			]
		);
		
		$this->add_control(
		'subtitle',
		[
			'label' => __( 'Subtitle', 'ahura' ),
			'type' => \Elementor\Controls_Manager::TEXT,
			'default' => __('Subtitle Here', 'ahura')
		]
		);
    
		$this->add_control(
			'image',
			[
				'label' => __( 'Image', 'ahura' ),
				'type' => \Elementor\Controls_Manager::MEDIA
			]
		);
		
    
    $this->add_control(
			'color',
			[
				'label' => __( 'Color', 'ahura' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#6EC1E4',
			]
		);
    
    $this->add_control(
			'textcolor',
			[
				'label' => __( 'Text Color', 'ahura' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => 'white',
			]
		);

		$this->add_control(
			'boxurl',
			[
				'label' => __( 'URL', 'ahura' ),
				'type' => \Elementor\Controls_Manager::URL
			]
		);
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$bg_image = $settings['image']['url'];
		$this->add_inline_editing_attributes('title', 'none');
		$this->add_inline_editing_attributes('subtitle', 'none');
    ?>
<a href="<?php echo $settings['boxurl']['url'];?>" class="imgbox" style="background-color:<?php echo $settings['color'];?>;<?php echo $bg_image ? "background-image:url('".$bg_image."')" : ''; ?>">
	<span <?php echo $this->get_render_attribute_string('title');?> style="color:<?php echo $settings['textcolor'];?>"><?php echo $settings['title'];?></span>
	<p <?php echo $this->get_render_attribute_string('subtitle');?> style="color:<?php echo $settings['textcolor'];?>"><?php echo $settings['subtitle'];?></p>
</a>
	   <?php
  }

}
