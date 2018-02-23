<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hash_Nav_Menu_Custom_Field{
	private static $_instance = null;
	/**
	 * Hook da stuff!
	 */
	function init() {
            
		add_action( 'wp_edit_nav_menu_walker', array( $this, 'edit_nav_menu_walker' ) );
		add_action( 'wp_update_nav_menu_item', array( $this, 'tocka_update_nav_menu_item' ), 10, 3 );
	}

	
	/**
	 * Change the admin menu walker class name.
	 * @param string $walker
	 * @return string
	 */
	function edit_nav_menu_walker( $walker ) {
		 new Hash_Custom_menu_field;
		//@TODO this should be loaded somewhere sooner... 
		//WST_View::get_instance()->library('Custom_menus_field', false);
		//require_once WST_ROOT.'core/application/library/Custom_menus_field.php';
		
		// swap the menu walker class only if it's the default wp class (just in case)
                
		if ( $walker === 'Walker_Nav_Menu_Edit' ) {
                    $walker = 'Hash_Custom_menu_field';
		}
		return $walker;
	}

	
	/**
	 * Save post meta. Menu items are just posts of type "menu_item".
	 * 
	 * 
	 * @param type $menu_id
	 * @param type $menu_item_id
	 * @param type $args
	 */
	function tocka_update_nav_menu_item($menu_id, $menu_item_id, $args) {
		//printr($_POST);
		
		if ( isset( $_POST[ "sh_menu_icon_field_$menu_item_id" ] ) ) {
		    $hover_field = isset( $_POST[ "sh_menu_icon_hover_field_$menu_item_id" ] ) ? $_POST[ "sh_menu_icon_hover_field_$menu_item_id" ] : '';
		    $color_field = isset( $_POST[ "sh_menu_color_field_$menu_item_id" ] ) ? $_POST[ "sh_menu_color_field_$menu_item_id" ] : '';
			update_post_meta( $menu_item_id, 'sh_menu_icon_field', $_POST[ "sh_menu_icon_field_$menu_item_id" ] );
			update_post_meta( $menu_item_id, 'sh_menu_icon_hover_field', $hover_field );
			update_post_meta( $menu_item_id, 'sh_menu_color_field', $color_field );
			
		} else {
			#mfmfmf("DEL");
			//delete_post_meta( $menu_item_id, 'sh_menu_icon_field' );
		}
                
	}
	
	static public function get_instance()
	{
		if( is_null( self::$_instance ) )
		{
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
}


