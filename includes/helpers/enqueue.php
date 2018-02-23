<?php
class Hash_Enqueue
{
	
	function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'sh_enqueue_scripts' ) );
		add_action( 'wp_head', array( $this, 'wp_head' ) );
		add_action( 'wp_footer', array( $this, 'wp_footer' ) );
		
	}


	function sh_enqueue_scripts()
	{
		global $post;
		$options = HASH_WSH()->option();
		$rtl = hash_wow_sh_set($options,'rtl');
		$color = hash_wow_sh_set($options, 'custom_color_scheme', '#fb724e');
		$color = str_replace('#', '', $color);

		$protocol = is_ssl() ? 'https' : 'http';
		$styles = array( 
						 'wow_themes_google_fonts' => hash_wow_themes_fonts_url(),
						 'font-awesome'	=> 'css/font-awesome.css',
						 'main-style'	=> 'style.css',
						 'featherlight'	=> 'css/featherlight.css',
						 'animate'	=> 'css/animate.css',
						 'custom'	=> 'css/custom.css',
						 //'color_scheme' => 'css/color.php',
					   );
		
		//$styles = $this->custom_fonts($styles); //Load google fonts that user choose from theme options
		
		if ($rtl){
		   $styles['rtl-style'] = 'css/rtl.css';
		}

		foreach( $styles as $name => $style )
		{

			if(strstr($style, 'http') || strstr($style, 'https') || strstr($style, '//fonts.googleapis.com') ) 
			{
				wp_enqueue_style( $name, $style);
			}

			else wp_enqueue_style( $name, HASH_WOW_THEMES_URL.$style);
		}

		$scripts = array( 
						  	'bootstrap'				=> 'js/bootstrap.min.js',
						  	'owl_carousel'  		=> 'js/owl.carousel.min.js',
						  	'featherlight'  		=> 'js/featherlight.js',
						    'main-scripts'	=> 'js/main.js',
						    'jquery-appear'			=> 'js/jquery.appear.js',
						 );
						 
		foreach( $scripts as $name => $js )
		{
			wp_register_script( $name, HASH_WOW_THEMES_URL.$js, '', '', true);
		}
		
		wp_enqueue_script( array( 'jquery', 'jquery-ui', 'bootstrap', 'main-scripts', 'owl_carousel', 'featherlight', 'jquery-appear'));

		if( is_singular() ) wp_enqueue_script('comment-reply');

	}
	
	function wp_head()
	{
		$options = HASH_WSH()->option();

		echo '<script type="text/javascript"> if( ajaxurl === undefined ) var ajaxurl = "'.admin_url('admin-ajax.php').'";</script>';?>
		<style type="text/css">
		<?php
			
			if( hash_wow_themes_set( $options, 'body_custom_font' ) )
			echo hash_wow_themes_font_settings( array( 'body_font_family' => 'font-family', 'body_font_color' => 'color' ), 'body, p { ', ' }' );
			
			if( hash_wow_themes_set( $options, 'use_custom_font' ) ) {
				
				echo hash_wow_themes_font_settings( array( 'h1_font_family' => 'font-family', 'h1_font_color' => 'color' ), 'h1 { ', ' }' );
				echo hash_wow_themes_font_settings( array( 'h2_font_family' => 'font-family', 'h2_font_color' => 'color'  ), 'h2 { ', ' }' );
				echo hash_wow_themes_font_settings( array( 'h3_font_family' => 'font-family', 'h3_font_color' => 'color'  ), 'h3 { ', ' }' );
				echo hash_wow_themes_font_settings( array( 'h4_font_family' => 'font-family', 'h4_font_color' => 'color'  ), 'h4 { ', ' }' );
				echo hash_wow_themes_font_settings( array( 'h5_font_family' => 'font-family', 'h5_font_color' => 'color'  ), 'h5 { ', ' }' );
				echo hash_wow_themes_font_settings( array( 'h6_font_family' => 'font-family', 'h6_font_color' => 'color'  ), 'h6 { ', ' }' );
			}
		?>
			<?php if( $banner_image = hash_wow_sh_set( $options, 'subpages_banner' ) ): ?>
				.info-section-parallax-path {
					background: url("<?php echo esc_url($banner_image); ?>") repeat fixed center top rgba(0, 0, 0, 0);
				}
			<?php endif; ?>
			
		
            <?php if( isset( HASH_WSH()->head_menu_style ) && HASH_WSH()->head_menu_style != "" ) {
				echo implode("\n", HASH_WSH()->head_menu_style);
			} ?>
        
        </style>                    
		<?php 

		$custom_css = hash_wow_themes_set($options , 'custom_css');
		
	}
	
	function wp_footer()

	{

		$theme_options = HASH_WSH()->option();
		
		if( hash_wow_themes_set( $theme_options, 'footer_analytics' ) ): ?>
			<script type="text/javascript">
                <?php echo hash_wow_sh_set( $theme_options, 'footer_analytics' );?>
            </script>
        <?php endif;

	}

	function custom_fonts( $styles )
	{
		$opt = HASH_WSH()->option();
		$protocol = ( is_ssl() ) ? 'https' : 'http';
		$font = array();
		//$font_options = array('h1_font_family', 'h2_font_family', 'h3_font_family');
		
		if( hash_wow_themes_set( $opt, 'use_custom_font' ) ){
			
			if( $h1 = hash_wow_themes_set( $opt, 'h1_font_family' ) ) $font[$h1] = urlencode( $h1 ).':400,300,600,700,800';
			if( $h2 = hash_wow_themes_set( $opt, 'h2_font_family' ) ) $font[$h2] = urlencode( $h2 ).':400,300,600,700,800';
			if( $h3 = hash_wow_themes_set( $opt, 'h3_font_family' ) ) $font[$h3] = urlencode( $h3 ).':400,300,600,700,800';
		}
		
		if( hash_wow_themes_set( $opt, 'body_custom_font' ) ){
			if( $body = hash_wow_themes_set( $opt, 'body_font_family' ) ) $font[$body] = urlencode( $body ).':400,300,600,700,800';
		}
		
		if( $font ) $styles['sh_google_custom_font'] = $protocol.'://fonts.googleapis.com/css?family='.implode('|', $font);
		
		return $styles;
	}
	
	

}