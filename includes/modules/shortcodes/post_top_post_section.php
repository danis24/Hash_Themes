<?php
	$animation = ($animation) ? $animation : 'fadeInUp';
	$anim_speed = ($anim_speed) ? $anim_speed : '0.2';
    $category = get_term_by( 'slug', $cat , 'category' );
	if( !$category ) return;
	$child = get_terms( array('category'), array('parent'=>$category->term_id, 'hide_empty' => 0) );
?>
<div class="header_fasion">
	<div class="left_fashion main_nav_box  animated out" data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>">
		<ul>
		<?php
		$bg_image = ( $image ) ? ' style=background-image:url('.wp_get_attachment_url($image, 'full').');' : '';
		$color = ($color) ? 'style= color:'.$color.';' : '';
		?>
			<li <?php echo balanceTags($bg_image);  ?> class="nav_fashion"><a <?php echo balanceTags($color);  ?> href="<?php echo get_category_link( $category->term_id ); ?>"><?php if($cat): echo balanceTags($category->name);  endif; ?></a></li>
		</ul>
	</div>
	<div class="fasion_right  animated out" data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>">
		<ul>
		<?php foreach ($child as $ca) : 
		 ?>
			<li><a href="<?php echo get_category_link($ca->term_id); ?>"><?php echo  $ca->name;   ?></a></li>
		 <?php  endforeach; ?>
		 <li class="last_item"><a href="<?php echo get_category_link( $category->term_id ); ?>"><img src="<?php echo get_template_directory_uri();  ?>/images/hor_dot.png" alt="img" /></a></li>
		</ul>
	</div>
</div>

<div class="gadgets_area_box">
	<div class="row">
		<?php echo do_shortcode($contents); ?>
	</div>
</div>