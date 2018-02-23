<?php 
	$animation = ($animation) ? $animation : 'fadeInUp';
	$anim_speed = ($anim_speed) ? $anim_speed : '0.2';
	$query_args = array('post_type' => 'post');   
   //if( $cat ) $query_args['category'] = $cat;
   $query = new WP_Query($query_args) ; 
?>

<div class="header_top_left animated out" data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>">
	<div class="news_twiks">
		<h4>
			<?php esc_html_e('Breaking', 'hash'); ?>
		</h4>
	</div>
	<div class="news_twiks_items">
		<div id="carousel-example-generic1" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner" role="listbox">
				<?php
				while($query->have_posts()): $query->the_post();
				$active = ($query->current_post == 0) ? ' active' : '';
				?>
				<div class="item<?php echo esc_attr($active); ?>">
					<a href="<?php the_permalink(); ?>">
						<?php the_title();?>
					</a>
				</div>
				<?php
				endwhile;
			?>
			</div>
		</div>
	</div>
</div>
<?php 
