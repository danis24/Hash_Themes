<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hash_Custom_menu_field extends Walker_Nav_Menu_Edit {
	
	
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
           
		// append next menu element to $output
		parent::start_el($output, $item, $depth, $args);
		// now let's add a custom form field
		
		if ( ! class_exists( 'phpQuery') ) {
			// load phpQuery at the last moment, to minimise chance of conflicts (ok, it's probably a bit too defensive)
			require_once HASH_WOW_THEMES_ROOT.'includes/helpers/phpQuery-onefile.php';
		}
		libxml_use_internal_errors(true);
		$_doc = phpQuery::newDocumentHTML( $output );
		$_li = phpQuery::pq( 'li.menu-item:last' );
		// ":last" is important, because $output will contain all the menu elements before current element
		
		// if the last <li>'s id attribute doesn't match $item->ID something is very wrong, don't do anything
		// just a safety, should never happen...
		$menu_item_id = str_replace( 'menu-item-', '', $_li->attr( 'id' ) );
		
		if( $menu_item_id != $item->ID ) {
			return;
		}
		
		// fetch previously saved meta for the post (menu_item is just a post type)
		$mega_val = esc_attr( get_post_meta( $menu_item_id, 'sh_menu_icon_field', TRUE ) );
		$hover_val = esc_attr( get_post_meta( $menu_item_id, 'sh_menu_icon_hover_field', TRUE ) );
		$color_val = esc_attr( get_post_meta( $menu_item_id, 'sh_menu_color_field', TRUE ) );
                
                //echo '<pre>';print_r($mega_val);exit;
        
        if( is_admin() ) { 
         
            // Add the color picker css file       
            wp_enqueue_style( 'wp-color-picker' ); 
             
            // Include our custom jQuery file with WordPress Color Picker dependency
            wp_enqueue_script( array( 'wp-color-picker' ) ); 
        } 
               
		// by means of phpQuery magic, inject a new input field
		if($depth == 0){
            
            $menu_simple_icon = '<p class=" description-wide"><label>'.__('Menu Icon Image URL', 'hash').'</label><br /><input class="widefat" type="text" value="'.esc_attr($mega_val).'" name="sh_menu_icon_field_'.$menu_item_id.'" /></p><p class="description-wide">'.__('Please enter menu icon image link here.', 'hash').'</p>';
            $menu_hover_icon = '<p class=" description-wide"><label>'.__('Menu Hover Icon URL', 'hash').'</label><br /><input class="widefat" type="text" value="'.esc_attr($hover_val).'" name="sh_menu_icon_hover_field_'.$menu_item_id.'" /></p><p class="description-wide">'.__('Please enter icon image link to show on menu hover.', 'hash').'</p>';
            $menu_color = '<p class=" description-wide"><label>'.__('Menu Color', 'hash').'</label><br /><input class="widefat _menu-color-field" type="text" value="'.esc_attr($color_val).'" name="sh_menu_color_field_'.$menu_item_id.'" /></p><p class="description-wide">'.__('Please choose the color for menu.', 'hash').'</p>';
            
            $menu_color_script = '<script type="text/javascript">
                                    jQuery(document).ready(function( $ ) {
 
                                        $(function() {
                                            $("._menu-color-field").wpColorPicker();
                                        });
                                         
                                    });
                                </script>';
            
			$_li->find( '.menu-item-actions.submitbox' )
			->before(  $menu_simple_icon.$menu_hover_icon.$menu_color.$menu_color_script );
		}
		
		// swap the $output
		$output = $_doc->html();
		
	}

}



new Hash_Custom_menu_field();
