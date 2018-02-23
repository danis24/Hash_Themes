<?php 

if( !defined('ABSPATH') ) 
	exit('Restricted Access'); ?>		

		<header class="header">
			
			<?php // Hookup with caribion_top_bar function in /includes/library/custom_functions.php
			do_action('caribion_top_bar'); ?>

			
			<div class="bottom">
				<div class="container clearfix">
					<div class="logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>">
							<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
						</a>
					</div> <!-- end .logo -->
					<div class="bottom-left">
						
						<?php // Hookup with caribion_header_info function in /includes/library/custom_functions.php
						do_action('caribion_header_info'); ?>

						<div class="navigation clearfix">

							<?php  //check if quote page is selected from theme options then show it.
							if( $quote_page = HASH_WSH()->option('header_quote_page') ): ?>
								<a href="<?php echo esc_url(get_permalink($quote_page)); ?>" title="<?php echo esc_attr(get_the_title($quote_page)); ?>" class="navigation-button">
									<?php echo wp_kses(get_the_title($quote_page), array('div', 'span')); ?>
								</a>
							<?php endif; ?>

							<nav class="main-nav">
								
								<?php wp_nav_menu(array('theme_location' => 'main_menu', 'container' => null, 'menu_class' => 'list-unstyled', 'fallback_cb'=>null, 'walker' => new SH_Bootstrap_walker())); ?>
								
							</nav> <!-- end .main-nav -->
							<a href="" class="responsive-menu-open"><i class="fa fa-bars"></i></a>
						</div> <!-- end .navigation -->
					</div> <!-- end .bottom-left -->
				</div> <!-- end .container -->
			</div> <!-- end .bottom -->
		</header> <!-- end .header -->
		<div class="responsive-menu">
			<a href="" class="responsive-menu-close"><i class="fa fa-times"></i></a>
			<nav class="responsive-nav"></nav> <!-- end .responsive-nav -->
		</div> <!-- end .responsive-menu -->