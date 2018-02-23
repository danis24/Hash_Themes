<?php
$meta = HASH_WSH()->get_meta('_sh_single_post_options');
$img_post = hash_wow_themes_set( $meta, 'gallery_2');

if( $img_post != "" ) {
	
	$img_post = ($img_post) ? explode(',', $img_post) : array();
	$format = get_post_format();
	$count = 0;

	?>
	<div class="blog-img">

		<div id="myCarousel" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
			<ol class="carousel-indicators">
				<?php foreach( (array)$img_post as $k => $field ): 
					
					$active = ( $k == 0 ) ? ' active' : ''; ?>
					
					<li data-target="#myCarousel" data-slide-to="<?php echo esc_attr( $k ); ?>" class="<?php echo esc_attr( $active ); ?>"></li>
					
				<?php endforeach; ?>
			</ol>
		   
		   <!-- Wrapper for slides -->
		   <div class="carousel-inner" role="listbox">
				<?php 
				//print_r($fields); exit();
				foreach( (array)$img_post as $k => $field ):
									 
					$active = ( $k == 0 ) ? ' active' : '';  ?>
					
					<div class="item<?php echo $active; ?>">
					  <?php echo wp_get_attachment_image($field, 'hash_wow_themes_835x426', '', array('class'=>'img-responsive', 'itemprop' => 'image')); ?>
					</div>
							
				<?php endforeach; ?>
			</div>
			
			<!-- Left and right controls -->
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
	<?php
} ?>