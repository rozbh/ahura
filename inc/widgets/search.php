<?php

// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class Elementor_search_input extends \Elementor\Widget_Base {

	public function get_name() {
		return 'search_input';
	}

	public function get_title() {
		return __( 'Search Input', 'ahura' );
	}

	public function get_icon() {
		return 'fa fa-search';
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
			'button_text',
			[
				'label'    => __( 'Button Text', 'ahura' ),
				'type'     => \Elementor\Controls_Manager::TEXT,
				'default' => __("Search", 'ahura')
			]
		);

		$this->add_control(
			'input_placeholder',
			[
				'label'   => __( 'Placeholder', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __('e.g. Best burger in this city', 'ahura')
			]
		);

		$this->add_control(
			'btn_style',
			[
				'label'   => __( 'Button Style', 'ahura' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
                    'success' => __('Success', 'ahura'),
                    'info' => __('Info', 'ahura'),
                    'warning' => __('Warning', 'ahura'),
                    'error' => __('Error', 'ahura'),
				],
				'default' => 'success'
			]
        );
        
		
		$this->end_controls_section();

	}

	protected function render() {
        $settings = $this->get_settings_for_display();
        $btn_text = $settings['button_text'];
		$place_holder = $settings['input_placeholder'];
		$style_mode = $settings['btn_style'];
        ?>
        <div class="search_elem">
            <form action="<?php echo home_url()?>">
                <input type="text" name="s" placeholder="<?php echo $place_holder; ?>" />
                <button type="submit" class="btn_<?php echo $style_mode; ?>_mode"><?php echo $btn_text?></button>
            </form>
        </div>
        <?php
	}

}
