<?php
$meta = HASH_WSH()->get_meta('_sh_single_post_options');
$quote_post = hash_wow_themes_set( $meta, 'quote');
$background = (wp_get_attachment_url(get_post_thumbnail_id())) ? ' style="background:url(' . wp_get_attachment_url(get_post_thumbnail_id()) . ')"' : '';
?>

<div class="bsqp_quote" <?php echo balanceTags($background); ?>>
    <div class="bsqp_quote_text">
        <img alt="blog quote post" src="<?php echo get_template_directory_uri();  ?>/images/quote_ico.png">
            <p><?php echo balanceTags($quote_post);  ?></p>
            <span><?php echo get_the_author_meta('display_name'); ?></span>
        </div>			
</div>