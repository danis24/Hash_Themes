<?php
$animation = ($animation) ? $animation : 'fadeInUp';
$anim_speed = ($anim_speed) ? $anim_speed : '0.2';   
$options = HASH_WSH()->option();
$option_media =  hash_wow_sh_set( $options, 'social_media' );
//print_r($option_media);exit;
?>

<div class="header_top_right">
	<div class="social_header animated out" data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>">
		<ul>
			<?php if($option_media):
				foreach( $option_media as $social ):
			?>
					<li><a title="<?php echo hash_wow_sh_set($social, 'social_title');?>" class="fa <?php echo hash_wow_sh_set($social, 'social_icon');?>" href="<?php echo esc_url( hash_wow_sh_set( $social, 'social_link' ) ); ?>"></a></li>
				<?php endforeach;
			endif;
	 ?>
	 		<li><a class="fa fa-behance" href="javascript:void(0);"></a></li>
		</ul>
	</div>
	
	<div class="header_search_box">
		<form method="get" class="header_search hidden-xs" action="<?php echo home_url(); ?>">
			<input type="text" name="s" placeholder="<?php esc_html_e('Search', 'hash'); ?>">
			<input type="submit" value="">
		</form>
	</div>
	
</div>
		  