<?php   if( !defined('ABSPATH') ) exit('Restricted Access');
$animation = ($animation) ? $animation : 'fadeInUp';
$anim_speed = ($anim_speed) ? $anim_speed : '0.2';
$query_args = array('post_type' => 'post' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
if( $cat ) $query_args['category_name'] = $cat;
$query = new WP_Query($query_args) ;

if( $query->have_posts() ):

$format_array = array('video' => 'fa fa-caret-right', 'audio' => 'fa fa-music', 'image' => 'fa fa-camera-o', 'quote' => 'fa fa-quote-left' );?>

<div class="h2_video_area_box">

	<?php $color = ($color) ? 'style= color:'.$color.';' : '';

	while($query->have_posts()): $query->the_post();
		global $post ;
		
		if( $query->current_post == 0 ):?>
	
			<div class="h2_video_up">
				<div class="bl_single_news bl_single_news_h2">
					<div class="bl_single_news_img">
						<div class="cc_im_box"><?php the_post_thumbnail('hash_wow_themes_604x262'); ?></div>
						<div class="br_cam">
							<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( hash_wow_themes_set( $format_array, get_post_format(), 'fa fa-camera' ) ); ?>"></a>
						</div>
					</div>
					<div class="bl_single_text">
						<span class="top_hp_span"><?php the_category('</span><span class="top_hp_span">'); ?></span>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><h4><?php the_title(); ?></h4></a>
						<span><i class="fa fa-clock-o"></i> 3 mins ago</span>
					</div>
				</div>
			</div>

		<?php else: ?>

			<?php if( $query->current_post == 1 ): ?>
			<div class="all_home_two_video_borrom">
			<?php endif; ?>
			
			<div class="home_two_video_borrom_content animated out" data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>">
				<div class="home_two_video_borrom">
					<div class="cc_im_box"><?php the_post_thumbnail('hash_wow_themes_173x166'); ?></div>
					<div class="br_cam">
						<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( hash_wow_themes_set( $format_array, get_post_format(), 'fa fa-camera' ) ); ?>"></a>
					</div>
				</div>
				<div class="h_t_m_text">
					<?php the_category(' , '); ?>
					<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
					<p>
						<i class="fa fa-clock-o"></i>
						1 hour ago
					</p>
				</div>
			</div>

			<?php if( $query->current_post == $num-1 ): ?>
				</div>
			<?php  endif;   ?>
		
		<?php endif;
	endwhile;?>

</div>
<div class="news_pagination">
	<?php hash_wow_themes_the_pagination(array('total' => $query->max_num_pages)); ?>
</div>
<?php endif;

wp_reset_postdata();