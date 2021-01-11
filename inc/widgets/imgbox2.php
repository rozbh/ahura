<?php

// Block direct access to the main plugin file.
defined('ABSPATH') or die('No script kiddies please!');


class Elementor_imgbox2 extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'imagebox2';
    }
  
    public function get_title()
    {
        return __('Image Box 2', 'ahura');
    }

    public function get_icon()
    {
        return 'fa fa-image';
    }

    public function get_categories()
    {
        return [ 'ahuraelements' ];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'ahura'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'ahura'),
                'type' => \Elementor\Controls_Manager::TEXT,
                "default" => __("Title Here", 'ahura')
            ]
        );
        
        $this->add_control(
            'subtitle',
            [
            'label' => __('Subtitle', 'ahura'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __("Subtitle Here", 'ahura')
        ]
        );
    
        $this->add_control(
            'image',
            [
                'label' => __('Image', 'ahura'),
                'type' => \Elementor\Controls_Manager::MEDIA
            ]
		);
		$this->add_control(
			'backgrounc-color',
			[
				'label' => __('Background Color', 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' =>
				[
					'{{WRAPPER}} .imgbox2' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'hover_bg_color',
			[
				'label' => __("Hover Background Color", 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f34b59',
				'selectors' =>
				[
					'{{WRAPPER}} a.imgbox2:hover' => 'background-color: {{VALUE}};box-shadow:0 0 20px {{VALUE}};'
				]
			]
		);
        $this->add_control(
            'textcolor',
            [
                'label' => __('Text Color', 'ahura'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#35495C'
            ]
		);
		$this->add_control(
			'hover_text_color',
			[
				'label' => __("Hover Text Color", 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
				'selectors' =>
				[
					'{{WRAPPER}} a.imgbox2:hover *' => 'color: {{VALUE}};'
				]
			]
		);
        $this->add_control(
            'boxurl',
            [
                'label' => __('URL', 'ahura'),
                'type' => \Elementor\Controls_Manager::URL
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $img = $settings['image']['url'];
        $this->add_inline_editing_attributes('title', 'none');
        $this->add_inline_editing_attributes('subtitle', 'none'); ?>
<a href="<?php echo $settings['boxurl']['url']; ?>" class="imgbox imgbox2">
	<?php if ($img): ?><img src="<?php echo $img; ?>"/><?php endif; ?>
	<span <?php echo $this->get_render_attribute_string('title')?>><?php echo $settings['title']; ?></span>
	<p <?php echo $this->get_render_attribute_string('subtitle')?>><?php echo $settings['subtitle']; ?></p>
</a>
	   <?php
    }
}
