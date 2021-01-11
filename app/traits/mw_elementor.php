<?php
namespace ahura\app\traits;
trait mw_elementor
{
    protected function render_inline_edit_data($setting_value, $setting_key)
	{
		if(is_admin())
		{
			echo '<span '.$this->get_render_attribute_string($setting_key).'>' . $setting_value . '</span>';
		}else{
			echo $setting_value;
		}
	}
}