<?php

add_action('after_setup_theme', 'hash_wow_themes_theme_setup');

function hash_wow_themes_theme_setup()
{
	
	global $wp_version;

	define( 'CS_ACTIVE_SHORTCODE',  false ); // default true
	define( 'CS_ACTIVE_CUSTOMIZE',  false ); // default true


	if(!defined('HASH_WOW_THEMES_VERSION')) define('HASH_WOW_THEMES_VERSION', '1.0');
	if( !defined( 'HASH_WOW_THEMES_NAME' ) ) define( 'HASH_WOW_THEMES_NAME', 'wp_hash' );
	if( !defined( 'HASH_WOW_THEMES_ROOT' ) ) define('HASH_WOW_THEMES_ROOT', get_template_directory().'/');
	if( !defined( 'HASH_WOW_THEMES_URL' ) ) define('HASH_WOW_THEMES_URL', get_template_directory_uri().'/');	
	include_once( get_template_directory().'/includes/loader.php' );
	
	
	load_theme_textdomain('hash', get_template_directory() . '/languages');
	add_editor_style(array('style.css'));

	//ADD THUMBNAIL SUPPORT
	add_theme_support('post-thumbnails');
	add_theme_support( 'post-formats', array( 'gallery', 'image', 'quote', 'video', 'audio' ) );
	add_theme_support('menus'); //Add menu support
	add_theme_support('automatic-feed-links'); //Enables post and comment RSS feed links to head.
	add_theme_support('widgets'); //Add widgets and sidebar support
	add_theme_support( "title-tag" );
	add_theme_support( "custom-background");
	// Header logo settings
	$header_args = array(
            'flex-width'    => true,
            'width'         => 980,
            'flex-height'    => true,
            'height'        => 200,
            'default-image' => get_template_directory_uri() . '/images/logo.png',
	);
	add_theme_support( 'custom-header', $header_args );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));


    // This theme uses its own gallery styles.
    add_filter('use_default_gallery_style', '__return_false');

	
	/** Register wp_nav_menus */
	if(function_exists('register_nav_menu'))
	{
		register_nav_menus(
			array(
				/** Register Main Menu location header */
				'main_menu' => esc_html__('Main Menu', 'hash'),
				'mobile_menu' => esc_html__('Mobile Menu', 'hash'),
			)
		);
	}
	if ( ! isset( $content_width ) ) $content_width = 960;
	
	add_image_size( 'hash_wow_themes_276x450', 276, 450, true );
	add_image_size( 'hash_wow_themes_332x223', 332, 223, true );
	add_image_size( 'hash_wow_themes_386x264', 386, 264, true );
	add_image_size( 'hash_wow_themes_728x90', 728, 90, true );
	add_image_size( 'hash_wow_themes_80x80', 80, 80, true );
	add_image_size( 'hash_wow_themes_162x104', 162, 104, true );
	add_image_size( 'hash_wow_themes_399x270', 399, 270, true );
	add_image_size( 'hash_wow_themes_399x280', 399, 280, true );
	add_image_size( 'hash_wow_themes_96x98', 96, 98, true );
	add_image_size( 'hash_wow_themes_530x450', 530, 450, true );
	add_image_size( 'hash_wow_themes_835x426', 835, 426, true );
	add_image_size( 'hash_wow_themes_604x262', 604, 262, true );
	add_image_size( 'hash_wow_themes_173x166', 173, 166, true );
	add_image_size( 'hash_wow_themes_859x344', 859, 344, true );
}


function hash_wow_themes_widget_init()
{
	global $wp_registered_sidebars;
	$theme_options = HASH_WSH()->option();
	//print_r($theme_options);exit;
	if( class_exists( 'hash_wow_themes_About_Us' ) )register_widget( 'hash_wow_themes_About_Us' );
	if( class_exists( 'hash_wow_themes_ContactUs' ) )register_widget( 'hash_wow_themes_ContactUs' );
	if( class_exists( 'hash_wow_themes_SocialMedia' ) )register_widget( 'hash_wow_themes_SocialMedia' );
    if( class_exists( 'hash_wow_themes_Recent_Posts' ) ) register_widget( 'hash_wow_themes_Recent_Posts' );
    if( class_exists( 'hash_wow_themes_Latest_Review' ) ) register_widget( 'hash_wow_themes_Latest_Review' );
	if( class_exists( 'hash_wow_themes_NewsLetter' ) ) register_widget( 'hash_wow_themes_NewsLetter' );
	if( class_exists( 'hash_wow_themes_YoutubeVideos' ) ) register_widget( 'hash_wow_themes_YoutubeVideos' );
	if( class_exists( 'hash_wow_themes_PurchaseAdd' ) ) register_widget( 'hash_wow_themes_PurchaseAdd' );
	if( class_exists( 'hash_wow_themes_Blog_Posts' ) ) register_widget( 'hash_wow_themes_Blog_Posts' );
	if( class_exists( 'hash_wow_themes_Follow_Us' ) ) register_widget( 'hash_wow_themes_Follow_Us' );
	if( class_exists( 'hash_wow_themes_Image_Slider' ) ) register_widget( 'hash_wow_themes_Image_Slider' );

	register_sidebar(array(
	  'name' => esc_html__( 'Default Sidebar', 'hash' ),
	  'id' => 'default-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'hash' ),
	  'class'=>'',
	  'before_widget'=>'<div id="%1$s" class="widget clearfix %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<div class="widget-title clearfix"><h3>',
	  'after_title' => '</h3></div>'
	));
	register_sidebar(array(
	  'name' => esc_html__( 'Blog Sidebar', 'hash' ),
	  'id' => 'blog-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown on the Blog Page.', 'hash' ),
	  'class'=>'',
	  'before_widget'=>'<div id="%1$s" class="widget home_sidebar %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<div class="follow_us_side"><h2>',
	  'after_title' => '</h2></div>'
	));

	register_sidebar(array(
	  'name' => esc_html__( 'Top Sidebar', 'hash' ),
	  'id' => 'top-sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown on the header.', 'hash' ),
	  'class'=>'',
	  'before_widget'=>'<div id="%1$s" class="clearfix %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<h4>',
	  'after_title' => '</h4>'
	));
	
	register_sidebar(array(
	  'name' => esc_html__( 'Footer Sidebar Column one', 'hash' ),
	  'id' => 'footer-sidebar-1',
	  'description' => esc_html__( 'Widgets in this area will be shown on the footer Column one.', 'hash' ),
	  'class'=>'',
	  'before_widget'=>'<div id="%1$s" class="widget %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<h4>',
	  'after_title' => '</h4>'
	));
	
	register_sidebar(array(
	  'name' => esc_html__( 'Footer Sidebar Column two', 'hash' ),
	  'id' => 'footer-sidebar-2',
	  'description' => esc_html__( 'Widgets in this area will be shown on the footer Column two.', 'hash' ),
	  'class'=>'',
	  'before_widget'=>'<div id="%1$s" class="widget %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<h4>',
	  'after_title' => '</h4>'
	));
	
	register_sidebar(array(
	  'name' => esc_html__( 'Footer Sidebar Column three', 'hash' ),
	  'id' => 'footer-sidebar-3',
	  'description' => esc_html__( 'Widgets in this area will be shown on the footer Column three.', 'hash' ),
	  'class'=>'',
	  'before_widget'=>'<div id="%1$s" class="widget %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<h4>',
	  'after_title' => '</h4>'
	));
	
	if( !is_object( HASH_WSH() )  )  return;
	$sidebars = hash_wow_themes_set( $theme_options, 'dynamic_sidebar' ); 
	foreach( array_filter((array)$sidebars) as $sidebar)
	{
		if(hash_wow_themes_set($sidebar , 'topcopy')) continue ;
		
		$name = hash_wow_themes_set( $sidebar, 'sidebar_name' );
		if( ! $name ) continue;
		$slug = hash_wow_themes_slug( $name ) ;
		
		register_sidebar( array(
			'name' => $name,
			'id' =>  $slug ,
		    'before_widget' => '<div class="widget">',
	        'after_widget' => "</div>",
	        'before_title' => '<div class="widget-title"><h3><span class="divider"></span>',
	        'after_title' => '</h3></div>',
		) );		
	}
	
	update_option('wp_registered_sidebars' , $wp_registered_sidebars) ;
}

add_action( 'widgets_init', 'hash_wow_themes_widget_init' );



if( function_exists('vc_map')) {
	vc_set_shortcodes_templates_dir( get_template_directory().'/includes/modules/shortcodes' );
	vc_disable_frontend();
	
	add_action( 'vc_before_init', 'hash_wow_themes_prefix_vcSetAsTheme' );
	function hash_wow_themes_prefix_vcSetAsTheme() {
	    vc_set_as_theme(true);
	}
}


if ( ! function_exists( 'hash_wow_themes_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Fifteen.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function hash_wow_themes_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	
	$fonts[] = 'Exo:400,500,600,700';
	$fonts[] = 'Oxygen:400,300,700';
	$fonts[] = 'Lato:400,300,700,100';
	$fonts[] = 'Roboto:400,100,300,500,700';
	$fonts[] = 'Cabin:400,700,500italic,600';

	$opt = HASH_WSH()->option();
	
	if( hash_wow_sh_set( $opt, 'use_custom_font' ) ){
		
		if( $h1 = hash_wow_sh_set( $opt, 'h1_font_family' ) ) $fonts[$h1] = urlencode( $h1 ).':400,300,600,700,800';
		if( $h2 = hash_wow_sh_set( $opt, 'h2_font_family' ) ) $fonts[$h2] = urlencode( $h2 ).':400,300,600,700,800';
		if( $h3 = hash_wow_sh_set( $opt, 'h3_font_family' ) ) $fonts[$h3] = urlencode( $h3 ).':400,300,600,700,800';
	}
	
	if( hash_wow_sh_set( $opt, 'body_custom_font' ) ){
		if( $body = hash_wow_sh_set( $opt, 'body_font_family' ) ) $fonts[$body] = urlencode( $body ).':400,300,600,700,800';
	}
	

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;


require_once get_template_directory(). '/includes/envato_setup/envato_setup.php';

// Please don't forgot to change filters tag.
// It must start from your theme's name.
add_filter('hash_theme_setup_wizard_username', 'hash_wow_themes_set_theme_setup_wizard_username', 10);
if( ! function_exists('hash_wow_themes_set_theme_setup_wizard_username') ){
    function hash_wow_themes_set_theme_setup_wizard_username($username){
    	
        return 'wow_themes';
    }
}

add_filter('hash_theme_setup_wizard_oauth_script', 'hash_wow_themes_set_theme_setup_wizard_oauth_script', 10);
if( ! function_exists('hash_wow_themes_set_theme_setup_wizard_oauth_script') ){
    function hash_wow_themes_set_theme_setup_wizard_oauth_script($oauth_url){
        return 'http://envato.app.wow-themes.com/server-script.php';
    }
}
