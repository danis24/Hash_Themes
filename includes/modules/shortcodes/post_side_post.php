<?php global $wp_query; 
	$animation = ($animation) ? $animation : 'fadeInUp';
	$anim_speed = ($anim_speed) ? $anim_speed : '0.2';
    $category = get_term_by( 'slug', $cat , 'category' );
	//if( !$category ) return;
	$child = get_terms( array('category'), array('parent'=>$category->term_id, 'hide_empty' => 0) );
?>
<div class="header_fasion">
	<div class="left_fashion main_nav_box animated out" data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>">
		<ul>
			<?php
			$bg_image = ( $image ) ? ' style=background-image:url('.wp_get_attachment_url($image, 'full').');' : '';
			$color = ($color) ? 'style= color:'.$color.';' : '';
			?>
				<li <?php echo balanceTags($bg_image);  ?> class="nav_fashion">
					<a <?php echo balanceTags($color);  ?> href="<?php echo get_category_link( $category->term_id ); ?>"><?php if($cat): echo balanceTags($category->name);  endif; ?>
					</a>
			    </li>
		</ul>
	</div>
	<div class="fasion_right animated out" data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>">
		<ul>
			<?php foreach ($child as $ca) : 
			 ?>
				<li>
					<a href="<?php echo get_category_link($ca->term_id); ?>"><?php echo  $ca->name;   ?>
					</a>
				</li>
			 <?php  endforeach; ?>
			 <li class="last_item">
				<a href="<?php echo get_category_link( $category->term_id ); ?>">
	                <?php if($doted_img == 'horizental' ) : ?>
				          ...
					<?php else: ?>
				         <img src="<?php echo get_template_directory_uri();  ?>/images/hor_dot.png" alt="img" />
                    <?php endif; ?>
				</a>
			</li>
		</ul>
	</div>
</div>
<?php 
    $paged = ( $pagination ) ? get_query_var('page') : get_query_var('paged');
   $query_args = array('post_type' => 'post' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order, 'paged'=>$paged);
   if( $cat ) $query_args['category_name'] = $cat;
   $query = new WP_Query($query_args) ;
   $paged = get_query_var('paged');
   
   $format_array = array('video' => 'fa fa-play', 'audio' => 'fa fa-music', 'image' => 'fa fa-camera-o', 'quote' => 'fa fa-quote-left' );
   if( $query->have_posts() ):
?>
<?php $color = ($color) ? 'style="background:rgba(255, 250, 240, 0.3) none repeat scroll 0 0"' : 'style="background:rgba(0, 0, 0, 0.2) none repeat scroll 0 0"' ; ?>
<div class="fashion_area_box">
	<div class="row">
<?php
	while($query->have_posts()): $query->the_post();
	$meta = HASH_WSH()->get_meta('_sh_single_post_options');
	$video = hash_wow_themes_set( $meta, 'video');
	global $post ;
	$unique_id = uniqid('feather');
	if( $query->current_post == 0 ):?>
		<div class="col-md-6 col-sm-6 col-xs-12  animated out <?php if ($style == 'style2'): echo 'pull-right'; else: ''; endif; ?>"  data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>">
			<div class="fs_news_left">
				<div class="single_fs_news_left_text">
					<div class="fs_news_left_img">
						
						<?php $image =wp_get_attachment_url( get_post_thumbnail_id(), 'hash_wow_themes_399x270' ); ?>
						<?php the_post_thumbnail('hash_wow_themes_399x270', array('class' => 'img-responsive'));?>
						
						<?php //if( $video && get_post_format() == 'video'); ?>
						
					    	<?php echo hash_get_format_frame($meta, $unique_id); ?>
					    
					    
					</div>
					<h4>
						<a href="<?php the_permalink(); ?>">
							<?php  the_title(); ?>
						</a>
					</h4>
					<p>
						<i class="fa fa-clock-o"></i> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> <i class="fa fa-comment"></i> <?php echo get_comments_number( $post->ID ); ?> 
					</p>
				</div>
			</div>
		</div>
		<?php else: ?>
		<?php if( $query->current_post == 1 ): ?>
		<div class="col-md-6 col-sm-6 col-xs-12 animated out"  data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>">
			<div class="all_news_right">
		<?php endif; ?>
				<div class="fs_news_right">
					<div class="single_fs_news_img">
						<?php the_post_thumbnail('hash_wow_themes_96x98', array('class' => 'img-responsive'));?>
						<?php echo hash_get_format_frame($meta, $unique_id); ?>
					</div>
					<div class="single_fs_news_right_text">
						<h4><a href="<?php the_permalink();  ?>">
							<?php the_title();  ?>
							</a></h4>
						<p>
							<?php
							$parentscategory ="";
							foreach((get_the_category()) as $category) {
							if ($category->category_parent == 0) {
							$parentscategory .= ' <a '.$color.' href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
								}
							}
							echo substr($parentscategory,0,-2); 
							  ?>
							| <i class="fa fa-clock-o"></i> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </p>
					</div>
				</div>
		<?php if( $query->current_post == $num-1 ): ?>
			</div>
		</div>
		<?php endif; ?>
		<?php endif; ?>
		<?php
endwhile;
?>
	</div>
</div>
<?php
	if($pagination):
?>
<div class=" animated out" data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>">
<?php
	hash_wow_themes_the_pagination(array('total'=>$query->max_num_pages));
?>
</div>
<?php
endif;
endif;
wp_reset_postdata();