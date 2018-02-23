<?php 

if( !defined('ABSPATH') ) 
	exit('Restricted Access');

$options = HASH_WSH()->option(); ?>						


						<div class="header-contact">
							<?php if( $res = HASH_WSH()->set($options, 'header_phone_number') ): ?>
								<a href="#" class="item"><i class="icon-call-end"></i><?php esc_html_e( 'Call Us : ', 'hash' ); ?> 
									<?php echo esc_attr($res); ?>
								</a>
							<?php endif; ?>

							<?php if( $res = HASH_WSH()->set($options, 'header_email_id') ): ?>
								<a href="mailto:<?php echo sanitize_email($res); ?>" class="item">
									<i class="icon-envelope"></i><?php esc_html_e('Mail Us :', 'hash' ); ?> 
									<?php echo sanitize_email($res); ?>
								</a>
							<?php endif; ?>

						</div>