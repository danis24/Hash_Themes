<?php
	$animation = ($animation) ? $animation : 'fadeInUp';
	$anim_speed = ($anim_speed) ? $anim_speed : '0.2';
    $category = get_term_by( 'slug', $cat , 'category' );
	if( !$category ) return;
	$child = get_terms( array('category'), array('parent'=>$category->term_id, 'hide_empty' => 0) );
?>
<div class="header_fasion  animated out"  data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>">
	<div class="left_fashion main_nav_box">
		<ul>
		<?php
			$bg_image = ( $image ) ? ' style=background-image:url('.wp_get_attachment_url($image, 'full').');' : '';
			$color = ($color) ? 'style= color:'.$color.';' : '';
		?>
			<li <?php echo balanceTags($bg_image);  ?> class="nav_fashion"><a <?php echo balanceTags($color);  ?> href="<?php echo get_category_link( $category->term_id ); ?>">
				<?php if($cat): echo balanceTags($category->name);  endif; ?>
				</a>
			</li>
		</ul>
	</div>
	<div class="fasion_right">
		<ul>
			<?php foreach ($child as $ca) : 
		 ?>
			<li>
				<a href="<?php echo get_category_link($ca->term_id); ?>"><?php echo  $ca->name;   ?></a>
			</li>
			<?php  endforeach; ?>
			<li class="last_item"><a href="<?php echo get_category_link( $category->term_id ); ?>"><img src="<?php echo get_template_directory_uri();  ?>/images/hor_dot.png" alt="img" /></a>
			</li>
		</ul>
	</div>
</div>
<?php  
   $query_args = array('post_type' => 'post' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   if( $cat ) $query_args['category_name'] = $cat;
   $query = new WP_Query($query_args) ;
   if( $query->have_posts() ):
?>
<div class="fashion_area_box">
	<div class="row">
<?php
	while($query->have_posts()): $query->the_post();
	global $post ;
	if( $query->current_post == 0 ):?>
	
	<div class="col-md-8 col-sm-8 col-xs-12">
			<div class="fs_news_left ht_fs_news_left">
				<div class="single_fs_news_left_text">
					<div class="single_fs_news_img_h2">
						<?php the_post_thumbnail('hash_wow_themes_386x264', array('class' => 'img-responsive'));?>
						<div class="br_cam">
							<a class="fa fa-camera" href=""></a>
						</div>
					</div>
					<h4><a href="<?php  the_permalink();  ?>"><?php  the_title(); ?></a></h4>
					<p>
						<i class="fa fa-clock-o"></i>
						 <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
						<i class="fa fa-comment"></i>
						<?php echo get_comments_number( $post->ID ); ?>
					</p>
				</div>
			</div>
		</div>
		
		<?php else: ?>
		
		<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="all_news_right ht_all_news_right">
					<div class="fs_news_right">
						<div class="single_fs_news_img">
							<?php the_post_thumbnail('hash_wow_themes_173x166', array('class' => 'img-responsive'));?>
						</div>
						<div class="single_fs_news_right_text">
							<?php
								$parentscategory ="";
								foreach((get_the_category()) as $category) {
								if ($category->category_parent == 0) {
								$parentscategory .= ' <a '.$color.' href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
									}
								}
							echo substr($parentscategory,0,-2); 
							  ?>
							<h4><a href="<?php the_permalink(); ?>"><?php the_title();  ?></a></h4>
							<p>
								<i class="fa fa-clock-o"></i>
								<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
							</p>
						</div>
					</div>
				</div>
			</div>
			
		<?php endif; ?>
		<?php
endwhile;
?>
	</div>
</div>
<?php
endif;
wp_reset_postdata();