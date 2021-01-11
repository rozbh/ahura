<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_iconbox extends \Elementor\Widget_Base {

	public function get_name() {
		return 'iconbox';
	}
  
	public function get_title() {
		return __( 'Icon Box', 'ahura' );
	}

	public function get_icon() {
		return 'fa fa-box';
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

    $categories = get_categories();
    $cats = array();
    $i = 0;
    foreach( $categories as $category ) {
        if( $i == 0 ){
            $default = $category->term_id;
            $i++;
        }
        $cats[$category->term_id] = $category->name;
    }
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'ahura' ),
				'type' => \Elementor\Controls_Manager::TEXT
			]
		);
		
		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'ahura' ),
				'type' => \Elementor\Controls_Manager::ICONS
			]
		);
		
		
		$this->add_control(
			'text',
			[
				'label' => __( 'Text', 'ahura' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA
			]
		);
    
    $this->add_control(
			'color',
			[
				'label' => __( 'Color', 'ahura' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'blue' => __( 'Blue', 'ahura' ),
					'red' => __( 'Red', 'ahura' ),
					'purple' => __( 'Purple', 'ahura' ),
					'yellow' => __( 'Yellow', 'ahura' ),
					'green' => __( 'Green', 'ahura' ),
					'pink' => __( 'Pink', 'ahura' ),
					'Orange' => __( 'Orange', 'ahura' )
				),
        'default' => 'blue'
			]
		);
		$this->add_control('url', [
			'label' => __('URL', 'ahura'),
			'type' => \Elementor\Controls_Manager::URL
		]);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$icon = $settings['icon'];
		$url_data = $settings['url'];
		$tag = 'div';
		$attr = '';
		if($url_data['url'])
		{
			$tag = 'a';
			$attr .= 'href="'.$url_data['url'].'" ';
			if($url_data['nofollow'])
			{
				$attr .= 'rel="nofollow" ';
			}
			if($url_data['is_external'])
			{
				$attr .= 'target="_blank" ';
			}
		}
		$attr .= 'class="iconbox-'.$settings['color'].' iconbox"';
		$render = '<' . $tag . " {$attr}>";
		$render .= '<div class="icon_wrapper">';
		$render .= '<i class="'.$icon['value'].' fa-4x"></i>';
		$render .= '<span>'.$settings['title'].'</span>';
		$render .= '</div>';
		$render .= '<p>'.$settings['text'].'</p>';
		$render .= "</{$tag}>";
		echo $render;
  }

}
