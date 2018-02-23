<?php
	$animation = ($animation) ? $animation : 'fadeInUp';
	$anim_speed = ($anim_speed) ? $anim_speed : '0.2';
?>
<div class="contact_address animated out" data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>">
	<h2><?php echo esc_attr( $title ); ?></h2>
	<p><?php echo esc_attr( $description ); ?></p>
	 <div class="visit_us_contact">
		<ul>
			<li>
				<div class="visit_img"><img src="<?php echo get_template_directory_uri(); ?>/images/map_ico.png" alt="map ico" /></div>
				<div class="visit_text"><?php echo esc_attr( $address ); ?></div>
			</li>
			<li>
				<div class="visit_img"><img src="<?php echo get_template_directory_uri(); ?>/images/ph_ico.png" alt="map ico" /></div>
				<div class="visit_text"><?php esc_html_e('Telephone :', 'hash');?> <?php echo esc_attr( $phone ); ?></div>
			</li>
			<li>
				<a href="mail-to:<?php echo esc_attr( $email ); ?>"></a>
				<div class="visit_img"><img src="<?php echo get_template_directory_uri(); ?>/images/msg_ico.png" alt="map ico" /></div>
				<div class="visit_text"><?php esc_html_e('E-mail :', 'hash');?> <?php echo esc_attr( $email ); ?></div>
			</li>
		</ul>
	 </div>
</div>