<?php
	$animation = ($animation) ? $animation : 'fadeInUp';
	$anim_speed = ($anim_speed) ? $anim_speed : '0.2';
?>
<div class="panel-body animated out" data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>">
    <div class="exppert_contents">
    	<div class="experience_img">
    		<img alt="Accordian Image" src="<?php echo wp_get_attachment_url($image, 'full'); ?>">
    	</div>
    	<div class="experience_text_right">
    		<h4><?php echo balanceTags($auth); ?></h4>
    		<p><?php echo balanceTags($text); ?></p>
    	</div>
    </div>
</div>