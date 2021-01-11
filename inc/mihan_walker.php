<?php
class Mihan_Walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $mega_state = get_post_meta($item->ID, 'mega_menu_state', true);
        $title = esc_attr($item->title);
        $icon_url = $item->mega_menu_icon ? $item->mega_menu_icon : '';
        $output .= '<li class="'.$mega_state.implode(' ', $item->classes).'">';
        $attrs = $item->attr_title ? ' title="' . $title . '"' : '';
        $attrs .= $item->target ? ' target="' . esc_attr($item->target) . '"' : '';
        $attrs .= $item->xfn ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attrs .= $item->url ? ' href="' . esc_attr($item->url) . '"' : '';

        $menu_item = $args->before;
        $menu_item .= '<a '.$attrs.' >';
        $item_icon = $icon_url ? '<img src="'.$icon_url.'"/>' : '';
        $menu_item .= $args->link_before . $item_icon . apply_filters('the_title', $title, $item->ID) . $args->link_after;
        $menu_item .= '</a>';
        $menu_item .= $item->subtitle;
        $menu_item .= $args->after;
        // $menu_item = '<a '.$attrs.'>' . $menu_item . ' ' .$description_render .'</a>';
        
        $output .= $menu_item;
        // $output .= apply_filters('walker_nav_menu_start_el', $output, $item, $depth, $args);

    }
    
    function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
    {
        if ( ! $element ) {
			return;
		}

		$id_field = $this->db_fields['id'];
		$id       = $element->$id_field;

		//display this element
		$this->has_children = ! empty( $children_elements[ $id ] );
		if ( isset( $args[0] ) && is_array( $args[0] ) ) {
			$args[0]['has_children'] = $this->has_children; // Back-compat.
		}

		$cb_args = array_merge( array( &$output, $element, $depth ), $args );
		call_user_func_array( array( $this, 'start_el' ), $cb_args );

		// descend only when the depth is right and there are childrens for this element
		if ( ( $max_depth == 0 || $max_depth > $depth + 1 ) && isset( $children_elements[ $id ] ) ) {

			foreach ( $children_elements[ $id ] as $child ) {

				if ( ! isset( $newlevel ) ) {
					$newlevel = true;
                    //start the child delimiter
                    // send wrapper menu id to get backgroud image
                    $cb_args = array_merge( array( &$output, $depth ), $args, [$id] );
                    // $cb_args = array_merge($cb_args, [$id]);
					call_user_func_array( array( $this, 'start_lvl' ), $cb_args );
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset( $children_elements[ $id ] );
		}

		if ( isset( $newlevel ) && $newlevel ) {
			//end the child delimiter
			$cb_args = array_merge( array( &$output, $depth ), $args );
			call_user_func_array( array( $this, 'end_lvl' ), $cb_args );
		}

		//end this element
		$cb_args = array_merge( array( &$output, $element, $depth ), $args );
		call_user_func_array( array( $this, 'end_el' ), $cb_args );    
    }

    function start_lvl(&$output, $depth = 0, $args = array(), $parent_id='')
    {
        $mega_menu_bg = get_post_meta($parent_id, 'mega_menu_bg', true);
        $output .= '<ul class="sub-menu" style="background-image: url(\''.$mega_menu_bg.'\')">';
    }
}