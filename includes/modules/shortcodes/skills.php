<div class="our_skills">
	<div class="single_our_skill">
		<div class="heading_progress">
			<div class="prog_h_left">
				<h2><?php echo esc_js($skill);?></h2>
			</div>
			<div class="prog_h_right">
				<p><?php echo esc_js($percentage);?>%</p>
			</div>
		</div>
		<div class="progress">
		   <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo esc_js($percentage);?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo esc_js($percentage);?>%;margin-right:2%">
			<span class="sr-only"><?php echo esc_js($percentage);?>% Complete</span>
		   </div>
		</div>
	</div>
</div>