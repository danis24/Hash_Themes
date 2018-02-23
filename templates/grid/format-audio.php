<?php
$meta = HASH_WSH()->get_meta('_sh_single_post_options');
$audio_post = hash_wow_themes_set( $meta, 'audio_embed');
$audio_post = '<iframe width="560" height="315" src="'.$audio_post.'" allowfullscreen></iframe>';
?>
<div class="sp_audio_box sp_video_box" itemscope itemtype="http://schema.org/AudioObject">
	<?php echo $audio_post; ?>
</div>