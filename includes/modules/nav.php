		<?php $theme_options = HASH_WSH()->option(); //printr(get_custom_header());?>
		<!-- Navigation -->
		<nav class="navbar fixed-enabled" role="navigation">
			<div class="container">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only"><?php esc_html_e('Toggle navigation', 'hash'); ?></span>
						<span class="fa fa-bars"></span>
					</button>
					<?php $logo_type = hash_wow_sh_set( $theme_options, 'logo_type', 'image' );
					  
					  if( $logo_type == 'text' )
					  {
						  //printr($theme_options);
						  $LogoStyle = sh_get_font_settings( array( 'logo_font_size' => 'font-size', 'logo_font_face' => 'font-family', 'logo_font_style' => 'font-style', 'logo_color' => 'color' ), ' style="', '"' );
						  $Logo = '<span>'.hash_wow_sh_set( $theme_options, 'logo_heading', get_bloginfo('name')).'</span>';
					  }
					  else
					  {
					  	  $height = (get_custom_header()->height) ? ' height="'.get_custom_header()->height.'"' : '';
					  	  $width = ( get_custom_header()->width ) ? ' width="'.get_custom_header()->width.'"' : '';
					  	  $LogoStyle = '';
						  $Logo = '<img src="'.get_header_image().'"'.$height.$width.' alt="'.get_bloginfo('name').'" />';
					  }
					  ?>
					  
					  <a class="navbar-brand h1 uppercase" href="<?php echo esc_url(home_url()); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>"<?php echo esc_attr($LogoStyle);?>>
						  <?php echo balanceTags($Logo);?>
						  <?php if( $slogan_heading = hash_wow_sh_set( $theme_options, 'slogan_heading' ) ): ?>
							<?php if( $logo_type == 'text' ): ?>
								<p><?php echo balanceTags($slogan_heading); ?></p>
							<?php endif; ?>
						  <?php endif; ?>
					  </a>

				</div>  <!-- / .navbar-header -->

				<div class="navbar-text navbar-right search-trigger visible-md visible-lg">
					<a id="search-trigger" href="javascript:void(0)"><i class="fa fa-search"></i></a>
				</div> <!-- / .search-trigger -->

				<div class="search-container">
					<form action="<?php echo esc_url(home_url()); ?>" method="get">
						<input type="text" name="s" placeholder="<?php esc_html_e('Search', 'hash'); ?>">
						<a class="close" href="javascript:void(0)"><i class="fa fa-times"></i></a>
					</form>
				</div>  <!-- / .search-container -->

				<div class="collapse navbar-collapse">
					<?php wp_nav_menu(array('theme_location' => 'main_menu', 'container' => null, 'menu_class' => 'nav navbar-nav navbar-right', 'fallback_cb'=>null, 'walker' => new SH_Bootstrap_walker())); ?>

                </div>
			</div>
		</nav>