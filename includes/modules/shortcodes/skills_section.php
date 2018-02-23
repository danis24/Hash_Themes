<?php 
	$animation = ($animation) ? $animation : 'fadeInUp';
	$anim_speed = ($anim_speed) ? $anim_speed : '0.2';
?>
<section class="our_skills_exp_area  animated out" data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="our_skills_exp">
					<h2><?php echo esc_js($title);?></h2>
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<?php echo do_shortcode($contents); ?>
						</div>					
					</div>
				</div>
			</div>
		</div>
	</div>
</section>