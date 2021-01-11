<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_testimonial_box2 extends \Elementor\Widget_Base {

	public function get_name() {
		return 'ahura_testimonial_box2';
	}

	public function get_title() {
		return __( 'Testimonial Box 2', 'ahura' );
	}

	public function get_icon() {
		return 'fa fa-comment-alt';
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
		$args = [
			'post_type' => 'testimonial',
			'number' => '-1'
		];
		$data = new WP_Query($args);
		$options = [];
		if($data->have_posts())
		{
			while($data->have_posts())
			{
				$data->the_post();
				$options[get_the_ID()] = get_the_title(get_the_ID());
			}
		}
		wp_reset_postdata();
		$default = $options && is_array($options) ? key($options) : false;
		$this->add_control(
			'tst_id',
			[
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label' => __("Testimonial", 'ahura'),
				'label_block' => true,
				'options' => $options,
				'default' => $default
			]
		);
		$this->add_control(
			'cover_settings',
			[
				'label' => __('Cover', 'ahorua'),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE
			]
		);
		$this->start_popover();
		$this->add_control(
			'cover_overlay_background',
			[
				'label' => __("Cover overlay background color", 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cover .overlay' => 'background-color: {{VALUE}}'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'cover_background',
				'selector' => '{{WRAPPER}} .cover',
				'fields_options' =>
				[
					'background' => [
						'default' => 'classic'
					],
					'color' =>
					[
						'default' => '#304980'
					]
				]
			]
		);
		$this->end_popover();
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
			'user_data_alignment',
			[
				'label' => __('User Data Alignment', 'ahura'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => is_rtl() ? $alignment_option : array_reverse($alignment_option)
			]
		);
		$this->add_control(
			'txt_color',
			[
				'label' => __("Text Color", 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => 'white',
				'selectors' => [
					'{{WRAPPER}} .content_wrapper *' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'box_background_color',
			[
				'label' => __('Background Color', 'ahura'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#3A5EAF',
				'selectors' => [
					'{{WRAPPER}} .content_wrapper' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .avatar' => 'color: {{VALUE}}'
				]
			]
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$pid = $settings['tst_id'];
		$content = get_post_field('post_content', $pid);
		$user_display_name = \ahura\app\mw_options::get_testimonial_username($pid);
		$sitename = \ahura\app\mw_options::get_testimonial_sitename($pid);
		$thumbnail_url = get_the_post_thumbnail_url($pid, 'thumbnail');
		?>
		<div class="testimonial-box2">
			<div class="cover">
				<div class="avatar" style="background-image: url('<?php echo $thumbnail_url; ?>')"></div>
				<div class="overlay"></div>
			</div>
			<div class="content_wrapper">
				<div class="content">
					<p><?php echo $content;?></p>
				</div>
				<div class="meta ah_align_<?php echo $settings['user_data_alignment']; ?>">
					<span class="username"><?php echo $user_display_name?></span>
					<span class="sitename"><?php echo $sitename?></span>
				</div>
			</div>
		</div>
		<?php
	}

}
