<?php
$meta = HASH_WSH()->get_meta('_sh_single_post_options');
$video_post = hash_wow_themes_set( $meta, 'video');
$video_post = '<iframe width="560" height="315" src="'.$video_post.'" allowfullscreen></iframe>';
?> 

<div class="sp_video_box">
    <div class="embed-responsive embed-responsive-16by9" itemprop="video" itemscope itemtype="http://schema.org/VideoObject"> 
		<?php echo $video_post; ?> 
	</div>
</div>

