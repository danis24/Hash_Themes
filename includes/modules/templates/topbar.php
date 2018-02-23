<?php 

if( !defined('ABSPATH') ) 
	exit('Restricted Access');

$options = HASH_WSH()->option(); ?>

<?php if( HASH_WSH()->set($options, 'topbarstatus') ): ?>
	
			<div class="top">
				<div class="container">

					<?php if( $res = HASH_WSH()->set($options, 'topbar_text') ): ?>
						<span class="left"><?php echo wp_kses($res, array('div', 'span')); ?></span>
					<?php endif; ?>

					<?php if( $res = HASH_WSH()->set($options, 'topbar_address') ): ?>
						<span class="right"><i class="icon-pointer"></i><?php echo wp_kses($res, array('div', 'span')); ?></span>
					<?php endif; ?>
					
				</div> <!-- end .container -->
			</div> <!-- end .top -->

<?php endif; ?>