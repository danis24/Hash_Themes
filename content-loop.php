
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="fs_news_left">
		<div class="single_fs_news_left_text">
			<div class="fs_news_left_img">
				<?php the_post_thumbnail($size);?>
				<?php echo hash_wow_themes_post_formate_icon(get_post_format(get_the_ID()));?>
				
			</div>
			<h4>
				<a href="<?php echo esc_url(get_permalink(get_the_ID()));?>"><?php the_title();?></a>
			</h4>
			<p class="post-meta-data"><i class="fa fa-clock-o"></i> <?php echo get_the_date(get_option('date_formate'), get_the_ID());?> <i class="fa fa-comment"></i> <?php comments_number();?></p>
			<?php the_excerpt(); ?>
		</div>
	</div>
</div>