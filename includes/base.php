<?php

include_once( get_template_directory().'/includes/helpers/functions.php' );

class Hash_Base extends Hash_Functions
{
	public $path = '';
	public $url = '';
	public $inc = '';
	public $inc_url = '';
	public $page_settings;
	
	
	function __construct()
	{
		$this->path = get_template_directory().'/';
		$this->url = get_template_directory_uri().'/';
		$this->inc = $this->path.'includes/';
		$this->inc_url = $this->url.'includes/';
	}
	
	function __set_attrib( $attr = array() )
	{
		$res = ' ';
		foreach( $attr as $k => $v )
		{
			$res .= $k.'="'.$v.'" ';
		}
		
		return $res;
	}
	
	function option( $key = '' )
	{
		//$theme_options = get_option( 'wp_hash'.'_theme_options' );
		$theme_options = get_option('_cs_options');
		if( $key ) return hash_wow_sh_set( $theme_options, $key );
		
		return $theme_options;
	}
	
	function includes( $path = '' )
	{
		$child = get_stylesheet_directory().'/';
		if( file_exists( $child.$path ) ) return $child.$path;
		
		return $this->path.$path;
	}
	
	function get_meta( $key = '', $id = '' )
	{
		global $post, $post_type;
		$post_type = $post->post_type;//( $post_type ) ? $post_type : $post->post_type;
		
		$id = ( $id ) ? $id : hash_wow_sh_set( $post, 'ID' );
		
		$key = ( $key ) ? $key : '_sh_'.$post_type.'_settings';

		$meta = get_post_meta( $id, $key, true );
		
		return ( $meta ) ? $meta : false;
	}
	
	function set_meta_key( $post_type )
	{
		if( ! $post_type ) return;
		
		return '_sh_'.$post_type.'_settings';
		
	}
	
	function get_term_meta( $key = '' )
	{
		$object = get_queried_object();
		
		//$id = ( $id ) ? $id : hash_wow_sh_set( $post, 'ID' );
		$key = ( $key ) ? $key.$object->term_id : '_sh_'.$object->taxonomy.'_settings'.$object->term_id;
		
		$meta = get_option( $key );
		
		return ( $meta ) ? $meta : false;
	}
	
	function set_term_key( $post_type )
	{
		if( ! $post_type ) return;
		
		return '_sh_'.$post_type.'_settings';
		
	}
	
	function page_template( $tpl )
	{
		$page = get_pages(array('meta_key' => '_wp_page_template','meta_value' => $tpl));
		if($page) return current( (array)$page);
		else return false;
	}
	
	function user_extra( $extras = array() )
	{
		$this->extras = $extras;
		
		add_filter('user_contactmethods', array( $this, 'newuserfilter' ) );

		
	}

	function newuserfilter($old)
	{
		$array = $this->extras;
		
		$new = array_merge($array, $old);
		return $new;
	}

}

$GLOBALS['_sh_base'] = new Hash_Base;







