<?php

// Block direct access to the main plugin file.
defined('ABSPATH') or die('No script kiddies please!');


class Elementor_typewriter extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'TypeWriter';
    }

    public function get_title()
    {
        return __('TypeWriter', 'ahura');
    }

    public function get_icon()
    {
        return 'fa fa-font';
    }

    public function get_categories()
    {
        return ['ahuraelements'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'ahura'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'text_fixed',
            [
                'label'    => __('Text Fixed', 'ahura'),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default' => __("Text Fixed", 'ahura')
            ]
        );

        $this->add_control(
            'text_one',
            [
                'label'   => __('Text One', 'ahura'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __('Text One', 'ahura')
            ]
        );

        $this->add_control(
            'text_two',
            [
                'label'   => __('Text Two', 'ahura'),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => __('Text Two', 'ahura')
            ]
        );
        $this->add_control(
            'text_fixed_style',
            [
                'label'   => __('Text Two', 'ahura'),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .typewriter-fixed' => 'color: {{VALUE}}'
                ],
                'default' => '#444'
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_fixed_typography',
				'label' => __("Text Fixed Typography","ahura"),
				'selector' => '{{WRAPPER}} .typewriter-fixed',
				'fields_options' =>
				[
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '16'
						]
					]
				]
			]
		);
        $this->add_control(
            'text_change_style',
            [
                'label'   => __('Text One And Two Color', 'ahura'),
                'type'    => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .Typewriter__wrapper' => 'color: {{VALUE}}'
                ],
                'default' => '#444'
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_change_typography',
				'label' => __("Text One And Two Typography","ahura"),
				'selector' => '{{WRAPPER}} .Typewriter__wrapper',
				'fields_options' =>
				[
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '16'
						]
					]
				]
			]
		);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>

        <span class="typewriter-fixed"><?php echo $settings['text_fixed']; ?></span>
        <div id="typewriter"></div>
        <script>
            var typewriter = document.getElementById('typewriter');

            var typewriter = new Typewriter(typewriter, {
                loop: true,
                delay: 75,
            });

            typewriter
                .pauseFor(2500)
                .typeString('<?php echo $settings['text_one']; ?>')
                .pauseFor(2500)
                .deleteAll()
                .pauseFor(2500)
                .typeString('<?php echo $settings['text_two']; ?>')
                .pauseFor(2500)
                .start();
        </script>
<?php
    }
}
