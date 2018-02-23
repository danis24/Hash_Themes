<?php
	$animation = ($animation) ? $animation : 'fadeInUp';
	$anim_speed = ($anim_speed) ? $anim_speed : '0.2';   
   $query_args = array('post_type' => 'post' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   if( $cat ) $query_args['category_name'] = $cat;
   $query = new WP_Query($query_args) ; 
   if( $query->have_posts() ):?>
   <div class="hp_banner_right ht_banner_middle">
<?php   while($query->have_posts()): $query->the_post();
   global $post;
?>

<div class="br_single_news animated out" data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>"> 
		<?php the_post_thumbnail('hash_wow_themes_332x223', array('class' => 'img-responsive')); 
	 	$color = ( ($query->current_post) == 1) ? 'style="background-color:#337ab7"' : '';
	 ?>
	<div class="br_single_text"><a href="<?php the_permalink(); ?>" class="btn-cat" <?php echo $color;  ?>> 
		<?php
			$parentscategory ="";
			foreach((get_the_category()) as $category) {
				if ($category->category_parent == 0) {
				$parentscategory .= $category->name;
					}
				}
			echo substr($parentscategory,0); 
		?>
		</a> <a href="<?php the_permalink(); ?>">
		<h4>
			<?php the_title();?>
		</h4>
		</a> </div>
	<div class="br_cam"> <a href="<?php the_permalink(); ?>" class="fa fa-camera"></a> </div>
</div>
<?php
endwhile; ?>
</div>
<?php
endif;
