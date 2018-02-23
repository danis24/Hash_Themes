<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if (post_password_required())
    return;
?>
<?php if (have_comments()) : ?>
    <div itemscope itemtype="http://schema.org/Comment" id="comments-single" class="sp-comments-box">
        <h2 id="comments" itemprop="reviewCount"><?php comments_number(); ?></h2>
            <?php
            wp_list_comments(array(
                'style' => 'div',
                'short_ping' => true,
                'avatar_size' => 74,
                'callback' => 'hash_wow_themes_list_comments'
            ));
            ?>

        <?php
        // Are there comments to navigate through?
            if (get_comment_pages_count() > 1 && get_option('page_comments')) :
        ?>

            <nav class="navigation comment-navigation" role="navigation">
                <h1 class="screen-reader-text section-heading"><?php esc_html_e('Comment navigation', 'hash'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link(esc_html__('&larr; Older Comments', 'hash')); ?></div>
                <div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments &rarr;', 'hash')); ?></div>
            </nav><!-- .comment-navigation -->

        <?php endif; // Check for comment navigation  ?>

        <?php if (!comments_open() && get_comments_number()) : ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'hash'); ?></p>
    <?php endif; ?>
    </div><!-- #comments -->	
<?php endif; // have_comments()  ?>

<?php if (comments_open()) : ?>
    <?php hash_wow_themes_comment_form(); ?> 
<?php endif; ?>


