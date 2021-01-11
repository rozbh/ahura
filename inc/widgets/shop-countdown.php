<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_mwcountdown extends \Elementor\Widget_Base {

	public function get_name() {
		return 'mwcountdown';
	}
  
	public function get_title() {
		return __( 'Shop CountDown', 'ahura' );
	}

	public function get_icon() {
		return 'fa fa-hourglass';
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
		$two_days_later = current_time('timestamp') + 172800;
		$this->add_control(
		'time',
		[
			'label' => __( 'Time', 'ahura' ),
			'type' => \Elementor\Controls_Manager::DATE_TIME,
			'default' => date('Y-m-d H:i:s', $two_days_later)
		]
		);
		
    
    $this->add_control(
			'color',
			[
				'label' => __( 'Color', 'ahura' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#4054B2',
				'selectors' =>
				[
					'{{WRAPPER}} .countdownbox' => 'background-color: {{VALUE}}'
				]
			]
		);
    
    $this->add_control(
			'textcolor',
			[
				'label' => __( 'Text Color', 'ahura' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => 'white',
				'selectors' => 
				[
					'{{WRAPPER}} .countdownbox span' => 'color: {{VALUE}}',
					'{{WRAPPER}} #mwtimercountdown li' => 'color: {{VALUE}}',
					'{{WRAPPER}} #mwtimercountdown li span' => 'color: {{VALUE}}'
				]
			]
		);

		$this->end_controls_section();

	}
	function __construct($data=[], $args=null)
	{
		parent::__construct($data, $args);
		$version = \ahura\app\mw_tools::get_theme_version();
		$src = get_template_directory_uri() . '/js/widget_shopcountdown.js';
		wp_register_script('ahura_shopcountdown_js', $src, ['jquery'], $version, true);
	}
	function get_script_depends()
	{
		return ['ahura_shopcountdown_js'];
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes('title', 'none');
		$el_id = $this->get_id();
    ?>
<div class="countdownbox" mm-date="<?php echo strtotime($settings['time']) . '000'?>">
	<span <?php echo $this->get_render_attribute_string('title');?>><?php echo $settings['title'];?></span>
	<ul id="mwtimercountdown"></ul>
  <script>
  jQuery(document).ready(function($){
	  countdown_init($('.elementor-element-<?php echo $el_id?> .countdownbox'))
  });
  </script>
</div>
	   <?php
  }

}
