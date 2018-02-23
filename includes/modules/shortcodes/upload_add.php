<?php 
	$animation = ($animation) ? $animation : 'fadeInUp';
	$anim_speed = ($anim_speed) ? $anim_speed : '0.2';
?>
<div class="home_add_box animated out" data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>"> 
<a href="<?php echo esc_url($url);  ?>">
	<img src="<?php echo wp_get_attachment_url($image, 'full');?>" alt="add" />
</a> 
</div>