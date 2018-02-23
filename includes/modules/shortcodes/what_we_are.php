<?php 
	$animation = ($animation) ? $animation : 'fadeInUp';
	$anim_speed = ($anim_speed) ? $anim_speed : '0.2';
?>
<div class="about_main animated out" data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>">

	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="doing_what">
				<h2><?php echo wp_kses_post($title); ?></h2>
				<?php echo apply_filters('the_content', $contents ); ?>
				<div class="read_more_about">
				
				    <?php if( $btn1_text ): ?>
					    <a href="<?php echo esc_url($btn1_link); ?>" title="<?php echo esc_attr($btn1_text); ?>"><?php echo wp_kses_post($btn1_text); ?></a>
					<?php endif;
					
					if( $btn2_text ): ?>
					    <a href="<?php echo esc_url($btn2_link); ?>" title="<?php echo esc_attr($btn2_text); ?>"><?php echo wp_kses_post($btn2_text); ?></a>
					<?php endif; ?>
					
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			
			<?php $explode = explode(',', $images );
			
			if( $explode && is_array($explode) ):?>
    			
    			<div class="about_slider">
    			
    			    <div id="about_slider_r" class="carousel slide" data-ride="carousel">
    
        				<!-- Wrapper for slides -->
        				<div class="carousel-inner" role="listbox">
        				
        				    <?php foreach( $explode as $i => $exp ): 
            				    
            				    $active = ( $i == 0 ) ? ' active' : ''; ?>
            					<div class="item<?php echo esc_attr($active); ?>">
            					  <?php echo wp_get_attachment_image($exp, 'full' ); ?>
            					</div>
            					
        					<?php endforeach; ?>
        					
        				</div>
    
                        <!-- Controls -->
                        <a class="left carousel-control" href="#about_slider_r" role="button" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right carousel-control" href="#about_slider_r" role="button" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
    				</div>
    			
    			</div>
			
			<?php endif; ?>
		</div>
	</div>
	
</div>