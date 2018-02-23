<?php

if( !class_exists( 'SH_Base' ) ) include_once(get_template_directory().'/includes/base.php');

add_action( 'init', 'hash_wow_themes_theme_init');

if( !function_exists( 'hash_wow_themes_set' ) ) {
	function hash_wow_themes_set( $var, $key, $def = '' )
	{
		//if( !$var ) return false;
	
		if( is_object( $var ) && isset( $var->$key ) ) return $var->$key;
		elseif( is_array( $var ) && isset( $var[$key] ) ) return $var[$key];
		elseif( $def ) return $def;
		else return false;
	}
}



if( !function_exists('hash_wow_themes_printr' ) ) {
	function hash_wow_themes_printr($data)
	{
		echo '<pre>'; print_r($data);exit;
	}
}


if( !function_exists('hash_wow_themes_font_awesome' ) ) {
	function hash_wow_themes_font_awesome( $index )
	{
		$array = array_values($GLOBALS['_font_awesome']);
		if( $font = hash_wow_sh_set($array, $index )) return $font;
		else return false;
	}
}


if( !function_exists('hash_wow_themes_load_class' ) ) {
	function hash_wow_themes_load_class($class, $directory = 'libraries', $global = true, $prefix = 'Hash_')
	{
		$obj = &$GLOBALS['_sh_base'];
		$obj = is_object( $obj ) ? $obj : new stdClass;
	
		$name = FALSE;
	
		// Is the request a class extension?  If so we load it too
		$path = get_template_directory().'/includes/'.$directory.'/'.$class.'.php';
		if( file_exists($path) )
		{
			$name = $prefix.ucwords( $class );
	
			if (class_exists($name) === FALSE)	require($path);
		}
	
		// Did we find the class?
		if ($name === FALSE) exit('Unable to locate the specified class in theme: '.$class.'.php');
	
		if( $global ) $GLOBALS['_sh_base']->$class = new $name();
		else new $name();
	}
}

include_once(get_template_directory().'/includes/thirdparty/framework/cs-framework.php');
include_once(get_template_directory().'/includes/library/form_helper.php');
include_once(get_template_directory().'/includes/library/functions.php');
include_once(get_template_directory().'/includes/library/widgets.php');
include_once(get_template_directory().'/includes/library/custom_functions.php');
include_once(get_template_directory().'/includes/helpers/mega_menu_shortcode.php');
hash_wow_themes_load_class( 'enqueue', 'helpers', false );

hash_wow_themes_load_class( 'bootstrap_walker', 'helpers', false );
if( hash_wow_themes_set( $_GET, 'sh_shortcode_editor_action' ) ) {
	include_once(get_template_directory().'/includes/resource/shortcode_output.php');exit;
}



if( is_admin() ) {
	if(!class_exists('Walker_Nav_Menu_Edit')) include(ABSPATH.'wp-admin/includes/nav-menu.php');
        include_once(get_template_directory().'/includes/helpers/custom_menus_field.php');
        include_once(get_template_directory().'/includes/helpers/nav-menu-custom-field.php');
        Hash_Nav_Menu_Custom_Field::get_instance()->init();
	/** Plugin Activation */
	require_once(get_template_directory().'/includes/thirdparty'.DIRECTORY_SEPARATOR.'tgm-plugin-activation'.DIRECTORY_SEPARATOR.'plugins.php');
}


function hash_wow_themes_theme_init()
{
	
	global $pagenow;
	
	return;
}
