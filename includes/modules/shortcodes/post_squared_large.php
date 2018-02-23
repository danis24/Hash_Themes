<?php   
	$animation = ($animation) ? $animation : 'fadeInUp';
	$anim_speed = ($anim_speed) ? $anim_speed : '0.2';
   $query_args = array('post_type' => 'post' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   if( $cat ) $query_args['category_name'] = $cat;
   $query = new WP_Query($query_args) ; 
   if( $query->have_posts() ):
   while($query->have_posts()): $query->the_post();
   global $post;
?>

<div class="hp_banner_left ht_banner_left animated out" data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>">
	<div class="bl_single_news post_squared_larges">
		<?php the_post_thumbnail('530x450', array('class' => 'img-responsive'));?>
		<div class="bl_single_text">
			<span class="top_hp_span">
			<?php
				$parentscategory ="";
				foreach((get_the_category()) as $category) {
					if ($category->category_parent == 0) {
					$parentscategory .= $category->name;
						}
					}
				echo substr($parentscategory,0); 
			?>			
			</span>
			<a href="<?php the_permalink(); ?>"><h4><?php the_title();?></h4></a>
			<span><i class="fa fa-clock-o"></i> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </span>
		</div>
	</div>
</div>

<?php
endwhile;
endif;
