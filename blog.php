<?php
	$settings = get_option( 'wp_hash'.'_theme_options' );
	$format = get_post_format();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('blogs col-md-12'); ?>>
	
	<?php get_template_part('templates/list/format', $format ); ?>
	
	<div class="blog-down-text  animated out" data-animation="fadeInUp" data-delay="0.2">
		<h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
		
		<ul class="single_fs_news_left_text  animated out"  data-animation="fadeInUp" data-delay="0.2">
			<li><i class="fa fa-calendar"></i> <?php echo get_the_date();?></li>
			<li><i class="fa fa-bookmark-o"></i><?php the_tags(''); ?></li>
			<li><i class="fa fa-comment-o"></i><a href="<?php the_permalink();?>#comments"><?php comments_number();?></a></li>
		</ul>

		<?php the_excerpt();?>

	</div>
	<div class="blog-comments">
		
		<a href="<?php the_permalink(); ?>" class="btn btn-default pull-right"><?php esc_html_e('Read more', 'hash');?></a>
	</div>
</div>

 <!--Blog Row End-->