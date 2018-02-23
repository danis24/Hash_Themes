<?php 
	$animation = ($animation) ? $animation : 'fadeInUp';
	$anim_speed = ($anim_speed) ? $anim_speed : '0.2';   
   $query_args = array('post_type' => 'post' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   if( $cat ) $query_args['category_name'] = $cat;
   $query = new WP_Query($query_args) ;
   if( $query->have_posts() ):
   ?>
 
   <div class="col-md-6 col-sm-6 col-xs-12  animated out"  data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>">
   		<div class="fs_news_left fs_gadgets_news_left">
   <?php
   $color = ($color) ? 'style= color:'.$color.';' : '';
	while($query->have_posts()): $query->the_post();
	global $post ;
	$unique_id = uniqid('feather');

	$meta = HASH_WSH()->get_meta('_sh_single_post_options');
	$video = hash_wow_themes_set( $meta, 'video');
	if( $query->current_post == 0 ):?>
				<div class="fs_news_left_img_g"> <?php the_post_thumbnail('hash_wow_themes_399x280', array('class' => 'img-responsive'));?>
					<?php if($show_icon): ?>
					   <?php //$video =   wp_oembed_get(hash_wow_themes_single_post_format(get_the_ID()) ); ?>
					    <?php echo hash_get_format_frame($meta, $unique_id); ?>
						
					<?php endif; ?>
				</div>
				<div class="single_fs_news_left_text">
					<h4><a href="<?php the_permalink(); ?>"><?php  the_title(); ?></a></h4>
					<p> <i class="fa fa-clock-o"></i> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> <i class="fa fa-comment"></i> <?php echo get_comments_number( $post->ID ); ?> </p>
				</div>
	<?php else: ?>
	<?php if( $query->current_post == 1 ): ?>
			    <div class="all_news_right">
	<?php endif; ?>
				
					<div class="fs_news_right">
						<div class="single_fs_news_img news2"> <?php the_post_thumbnail('hash_wow_themes_96x98', array('class' => 'img-responsive')); ?> 
									<?php echo hash_get_format_frame($meta, $unique_id); ?>
						</div>
						 
						<div class="single_fs_news_right_text">
							<h4><a href="<?php the_permalink(); ?>"><?php  the_title(); ?></a></h4>
							<p>
							<?php
							$parentscategory ="";
							foreach((get_the_category()) as $category) {
							if ($category->category_parent == 0) {
							$parentscategory .= ' <a '.$color.' href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
								}
							}
							echo substr($parentscategory,0,-2); 
							  ?>| <i class="fa fa-clock-o"></i> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </p>
						</div>
					</div>
	<?php if( $query->current_post == $num-1 ): ?>
				</div>
	<?php  endif;   ?>
<?php
endif;
endwhile;
?>
	</div>
</div>
<?php
endif;
wp_reset_postdata();