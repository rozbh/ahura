<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_countdown extends \Elementor\Widget_Base {

	public function get_name() {
		return 'countdown';
	}

	public function get_title() {
		return __( 'Shop CountDown2', 'ahura' );
	}

	public function get_icon() {
		return 'fa fa-clock-o';
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
			'backgroundcolor',
			[
				'label' => __( 'Background Color', 'ahura' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' =>
				[
					'{{WRAPPER}} .flip-clock-box' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'titlecolor',
			[
				'label' => __( 'Title Color', 'ahura' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#35495c',
				'selectors' =>
				[
					'{{WRAPPER}} .flip-clock-box-title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .flip-clock-wrapper ul li a div' => 'color: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'labelcolor',
			[
				'label' => __( 'Label Color', 'ahura' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' =>
				[
					'{{WRAPPER}} .flip-clock-label' => 'color: {{VALUE}}',
				]
			]
		);

		$this->end_controls_section();

	}
	function __construct($data=[], $args=null)
	{
		parent::__construct($data, $args);
		$version = \ahura\app\mw_tools::get_theme_version();
		wp_register_script( 'flipjs', '/wp-content/themes/ahura/js/flipclock.min.js', [ 'elementor-frontend' ], '1.0.0', true );
	}
	function get_script_depends()
	{
		return ['flipjs'];
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes('title', 'none');
		$el_id = $this->get_id();
    ?>
    <script type="text/javascript">
		jQuery(document).ready(function($) {
			var clock, currentDate, diff, futureDate, setcount;
			currentDate = new Date;
			futureDate = new Date('<?php echo $settings['time'] ?>');
			diff = futureDate.getTime() / 1000 - (currentDate.getTime() / 1000);
			if (diff > -1) {
				setcount = diff;
			} else {
				setcount = 0;
			}
			clock = $('.clock').FlipClock(setcount, {
				clockFace: 'DailyCounter',
				countdown: true
			});
			if (diff < setcount) {
						document.getElementById('flipclock').innerHTML = 'به اتمام رسیده!'
			}
		});
    </script>
		<div class="flip-clock-box">
		<h2 class="flip-clock-box-title"><?php echo $settings['title']; ?></h2>
		<div class="box" id="flipclock">
		  <div class="clock"></div>
		</div>
	</div>
	   <?php
  }

}
