		
		<header class="header header-landing">
			<div class="container clearfix">
				<div class="logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>">
						<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
					</a>
				</div> <!-- end .logo -->
				<div class="navigation clearfix">
					<nav class="main-nav">
						
						<?php wp_nav_menu(array('theme_location' => 'main_menu', 'container' => null, 'menu_class' => 'list-unstyled', 'fallback_cb'=>null, 'walker' => new SH_Bootstrap_walker())); ?>

					</nav> <!-- end .main-nav -->
					<a href="" class="responsive-menu-open"><i class="fa fa-bars"></i></a>
				</div> <!-- end .navigation -->
			</div> <!-- end .container -->
		</header> <!-- end .header -->
		<div class="responsive-menu">
			<a href="" class="responsive-menu-close"><i class="fa fa-times"></i></a>
			<nav class="responsive-nav"></nav> <!-- end .responsive-nav -->
		</div> <!-- end .responsive-menu -->