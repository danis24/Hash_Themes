<?php
add_filter('widget_text', 'do_shortcode');

function HASH_WSH() {

    return $GLOBALS['_sh_base'];
}

function hash_wow_themes__parse_base64($str) {

    if (function_exists('_sh_parse_base64')) {

        return _sh_parse_base64($str);
    }

    return $str;
}

function hash_wow_themes_animation() {
    $result = array(
        array('value' => '', 'label' => 'Select'),
        array('value' => 'bounce', 'label' => 'Bounce'),
        array('value' => 'flash', 'label' => 'Flash'),
        array('value' => 'pulse', 'label' => 'Pulse'),
        array('value' => 'rubberBand', 'label' => 'RubberBand'),
        array('value' => 'shake', 'label' => 'Shake'),
        array('value' => 'headShake', 'label' => 'HeadShake'),
        array('value' => 'swing', 'label' => 'Swing'),
        array('value' => 'tada', 'label' => 'Tada'),
        array('value' => 'wobble', 'label' => 'Wobble'),
        array('value' => 'jello', 'label' => 'Jello'),
        array('value' => 'bounceIn', 'label' => 'BounceIn'),
        array('value' => 'bounceInDown', 'label' => 'BounceInDown'),
        array('value' => 'bounceInLeft', 'label' => 'BounceInLeft'),
        array('value' => 'bounceInRight', 'label' => 'BounceInRight'),
        array('value' => 'bounceInUp', 'label' => 'BounceInUp'),
        array('value' => 'bounceOut', 'label' => 'BounceOut'),
        array('value' => 'bounceOutDown', 'label' => 'BounceOutDown'),
        array('value' => 'bounceOutLeft', 'label' => 'BounceOutLeft'),
        array('value' => 'bounceOutRight', 'label' => 'BounceOutRight'),
        array('value' => 'bounceOutUp', 'label' => 'BounceOutUp'),
        array('value' => 'fadeIn', 'label' => 'FadeIn'),
        array('value' => 'fadeInDown', 'label' => 'FadeInDown'),
        array('value' => 'fadeInLeft', 'label' => 'FadeInLeft'),
        array('value' => 'fadeInRight', 'label' => 'FadeInRight'),
        array('value' => 'fadeInUp', 'label' => 'FadeInUp'),
        array('value' => 'fadeOut', 'label' => 'FadeOut'),
        array('value' => 'fadeOutDown', 'label' => 'FadeOutDown'),
        array('value' => 'fadeOutLeft', 'label' => 'FadeOutLeft'),
        array('value' => 'fadeOutRight', 'label' => 'FadeOutRight'),
        array('value' => 'fadeOutUp', 'label' => 'FadeOutUp'),
        array('value' => 'flipInX', 'label' => 'FlipInX'),
        array('value' => 'flipInY', 'label' => 'FlipInY'),
        array('value' => 'flipOutX', 'label' => 'FlipOutX'),
        array('value' => 'flipOutY', 'label' => 'FlipOutY'),
        array('value' => 'lightSpeedIn', 'label' => 'LightSpeedIn'),
        array('value' => 'lightSpeedOut', 'label' => 'LightSpeedOut'),
        array('value' => 'rotateIn', 'label' => 'RotateIn'),
        array('value' => 'rotateOut', 'label' => 'RotateOut'),
        array('value' => 'hinge', 'label' => 'Hinge'),
        array('value' => 'rollIn', 'label' => 'RollIn'),
        array('value' => 'rollOut', 'label' => 'RollOut'),
        array('value' => 'zoomIn', 'label' => 'ZoomIn'),
        array('value' => 'zoomInDown', 'label' => 'ZoomInDown'),
        array('value' => 'zoomInLeft', 'label' => 'ZoomInLeft'),
        array('value' => 'zoomInRight', 'label' => 'ZoomInRight'),
        array('value' => 'zoomInUp', 'label' => 'ZoomInUp'),
        array('value' => 'zoomOut', 'label' => 'ZoomOut'),
        array('value' => 'zoomOutDown', 'label' => 'ZoomOutDown'),
        array('value' => 'zoomOutLeft', 'label' => 'ZoomOutLeft'),
        array('value' => 'zoomOutRight', 'label' => 'ZoomOutRight'),
        array('value' => 'zoomOutUp', 'label' => 'ZoomOutUp'),
        array('value' => 'slideInDown', 'label' => 'SlideInDown'),
        array('value' => 'slideInLeft', 'label' => 'SlideInLeft'),
        array('value' => 'slideInRight', 'label' => 'SlideInRight'),
        array('value' => 'slideInUp', 'label' => 'SlideInUp'),
        array('value' => 'slideOutDown', 'label' => 'SlideOutDown'),
        array('value' => 'slideOutLeft', 'label' => 'SlideOutLeft'),
        array('value' => 'slideOutRight', 'label' => 'SlideOutRight'),
        array('value' => 'slideOutUp', 'label' => 'SlideOutUp'),
    );
    
    $vc_array = array();
    foreach( $result as $res )
    {
        $vc_array[$res['label']] = $res['value'];
    }
    return $vc_array;
}

/** A function to fetch the categories from wordpress */
function hash_wow_themes_get_categories($arg = false, $by_slug = false, $vp = false) {

    global $wp_taxonomies;

    if (!empty($arg['taxonomy']) && !isset($wp_taxonomies[$arg['taxonomy']])) {

        //register_taxonomy( $arg['taxonomy'], 'sh_'.$arg['taxonomy']);
    }

    //printr($arg);

    $categories = get_terms(hash_wow_themes_set($arg, 'taxonomy', 'category'), $arg);

    $cats = array();

    if (!is_wp_error($categories)) {

        if ($vp)
            $cats[] = array('value' => '', 'label' => esc_html__('All Categories', 'hash'));
        else
            $cats[] = esc_html__('All Categories', 'hash');

        if ($vp) {

            foreach ($categories as $category) {

                if ($by_slug)
                    $cats[$category->term_id] = array('value' => $category->slug, 'label' => $category->name);
                else
                    $cats[$category->term_id] = array('value' => $category->term_id, 'label' => $category->name);
            }
        }else {

            foreach ($categories as $category) {

                if ($by_slug)
                    $cats[$category->slug] = $category->name;
                else
                    $cats[$category->term_id] = $category->name;
            }
        }
    }

    return $cats;
}

function hash_wow_themes_get_posts_array($post_type = 'post', $flip = false) {

    global $wpdb;

    $res = $wpdb->get_results($wpdb->prepare("SELECT `ID`, `post_title` FROM `" . $wpdb->prefix . "posts` WHERE `post_type` = %s AND `post_status` = %s ", array($post_type, 'publish')), ARRAY_A);

    $return = array();

    foreach ($res as $k => $r) {

        if ($flip) {

            if (isset($return[hash_wow_themes_set($r, 'post_title')]))
                $return[hash_wow_themes_set($r, 'post_title') . $k] = hash_wow_themes_set($r, 'ID');
            else
                $return[hash_wow_themes_set($r, 'post_title')] = hash_wow_themes_set($r, 'ID');
        } else
            $return[hash_wow_themes_set($r, 'ID')] = hash_wow_themes_set($r, 'post_title');
    }

    return $return;
}

if (!function_exists('hash_wow_themes_slug')) {

    function hash_wow_themes_slug($string) {

        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

}

function hash_wow_themes_get_sidebars($multi = false) {

    global $wp_registered_sidebars;

    $sidebars = !($wp_registered_sidebars) ? get_option('wp_registered_sidebars') : $wp_registered_sidebars;

    if ($multi)
        $data[] = array('value' => '', 'label' => 'No Sidebar');
    else
        $data = array('' => esc_html__('No Sidebar', 'hash'));

    foreach ((array) $sidebars as $sidebar) {

        if ($multi)
            $data[] = array('value' => hash_wow_themes_set($sidebar, 'id'), 'label' => hash_wow_themes_set($sidebar, 'name'));
        else
            $data[hash_wow_themes_set($sidebar, 'id')] = hash_wow_themes_set($sidebar, 'name');
    }

    return $data;
}

if (!function_exists('hash_wow_themes_character_limiter')) {

    function hash_wow_themes_character_limiter($str, $n = 500, $end_char = '&#8230;', $allowed_tags = false) {

        if ($allowed_tags)
            $str = strip_tags($str, $allowed_tags);

        if (strlen($str) < $n)
            return $str;

        $str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

        if (strlen($str) <= $n)
            return $str;

        $out = "";

        foreach (explode(' ', trim($str)) as $val) {

            $out .= $val . ' ';

            if (strlen($out) >= $n) {

                $out = trim($out);

                return ( strlen($out) == strlen($str)) ? $out : $out . $end_char;
            }
        }
    }

}

function hash_wow_themes_get_social_icons() {

    $options = HASH_WSH()->option('social_media'); //printr($options);

    $output = '';

    if (hash_wow_themes_set($options, 'social_media') && is_array(hash_wow_themes_set($options, 'social_media'))) {

        foreach (hash_wow_themes_set($options, 'social_media') as $social_icon) {

            if (isset($social_icon['tocopy']))
                continue;

            $title = hash_wow_themes_set($social_icon, 'title');

            $link = hash_wow_themes_set($social_icon, 'social_link');

            $icon = hash_wow_themes_set($social_icon, 'social_icon');

            $output .= '

				<a class="fa ' . $icon . '" data-toggle="tooltip" target="_blank" data-placement="top" title="' . esc_attr($title) . '" href="' . esc_url($link) . '"></a>' . "\n";
        }
    }

    return $output;
}

function hash_wow_themes_get_the_breadcrumb() {

    global $wp_query;

    $queried_object = get_queried_object();

    $breadcrumb = '';

    $delimiter = '';

    $before = '<li>';

    $after = '</li>';

    if (!is_home() || $wp_query->is_posts_page) {

        $breadcrumb .= '<li><a href="' . home_url() . '" title="' . get_bloginfo('name') . '">' . esc_html__('Home', 'hash') . '</a> /</li>';

        /** If category or single post */
        if (is_category()) {

            $cat_obj = $wp_query->get_queried_object();

            $this_category = get_category($cat_obj->term_id);

            if ($this_category->parent != 0) {

                $parent_category = get_category($this_category->parent);

                $breadcrumb .= get_category_parents($parent_category, TRUE, $delimiter);
            }

            $breadcrumb .= $delimiter . $before . '<a href="' . get_category_link(get_query_var('cat')) . '">' . single_cat_title('', FALSE) . '</a>' . $after;
        } elseif (is_tax()) {

            $breadcrumb .= $delimiter . $before . '<a href="' . get_term_link($queried_object) . '">' . $queried_object->name . '</a>' . $after;
        } elseif (is_page()) /** If WP pages */ {

            global $post;

            if ($post->post_parent) {

                $anc = get_post_ancestors($post->ID);

                foreach ($anc as $ancestor) {

                    $breadcrumb .= $delimiter . $before . '<a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a>' . $after;
                }

                $breadcrumb .= $delimiter . $before . get_the_title($post->ID) . $after;
            } else
                $breadcrumb .= $delimiter . $before . '' . get_the_title() . '' . $after;
        }

        elseif (is_singular()) {

            if ($category = wp_get_object_terms(get_the_ID(), get_taxonomies())) {

                if (!is_wp_error($category)) {

                    $breadcrumb .= $delimiter . $before . '<a href="' . get_term_link(hash_wow_themes_set($category, '0')) . '">' . hash_wow_themes_set(hash_wow_themes_set($category, '0'), 'name') . '</a>' . $after;

                    $breadcrumb .= $delimiter . $before . '' . get_the_title() . '' . $after;
                } else
                    $breadcrumb .= $delimiter . $before . '' . get_the_title() . '' . $after;
            }else {

                $breadcrumb .= $delimiter . $before . '' . get_the_title() . '' . $after;
            }
        } elseif (is_tag())
            $breadcrumb .= $delimiter . $before . '<a href="' . get_term_link($queried_object) . '">' . single_tag_title('', FALSE) . '</a>' . $after; /*             * If tag template */

        elseif (is_day())
            $breadcrumb .= $delimiter . $before . '<a href="">' . esc_html__('Archive for ', 'hash') . get_the_time('F jS, Y') . '</a>' . $after;/** If daily Archives */

        elseif (is_month())
            $breadcrumb .= $delimiter . $before . '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . esc_html__('Archive for ', 'hash') . get_the_time('F, Y') . '</a>' . $after;/** If montly Archives */

        elseif (is_year())
            $breadcrumb .= $delimiter . $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . esc_html__('Archive for ', 'hash') . get_the_time('Y') . '</a>' . $after;/** If year Archives */

        elseif (is_author())
            $breadcrumb .= $delimiter . $before . '<a href="' . esc_url(get_author_posts_url(get_the_author_meta("ID"))) . '">' . esc_html__('Archive for ', 'hash') . get_the_author() . '</a>' . $after;/** If author Archives */

        elseif (is_search())
            $breadcrumb .= $delimiter . $before . '' . esc_html__('Search Results for ', 'hash') . get_search_query() . '' . $after;/** if search template */

        elseif (is_404())
            $breadcrumb .= $delimiter . $before . '' . esc_html__('404 - Not Found', 'hash') . '' . $after;/** if search template */

        elseif (is_post_type_archive('product')) {

            $shop_page_id = woocommerce_get_page_id('shop');

            if (get_option('page_on_front') !== $shop_page_id) {

                $shop_page = get_post($shop_page_id);

                $_name = woocommerce_get_page_id('shop') ? get_the_title(woocommerce_get_page_id('shop')) : '';

                if (!$_name) {

                    $product_post_type = get_post_type_object('product');

                    $_name = $product_post_type->labels->singular_name;
                }

                if (is_search()) {

                    $breadcrumb .= $before . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . $delimiter . esc_html__('Search results for &ldquo;', 'hash') . get_search_query() . '&rdquo;' . $after;
                } elseif (is_paged()) {

                    $breadcrumb .= $before . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . $after;
                } else {

                    $breadcrumb .= $before . $_name . $after;
                }
            }
        } else
            $breadcrumb .= $delimiter . $before . '<a href="' . get_permalink() . '">' . get_the_title() . '</a>' . $after;/** Default value */
    }

    return '<ul>' . $breadcrumb . '</ul>';
}

function hash_wow_themes_register_user($data) {

    //printr($data);

    $user_name = hash_wow_themes_set($data, 'user_login');

    $user_email = hash_wow_themes_set($data, 'user_email');

    $user_pass = hash_wow_themes_set($data, 'user_password');

    $policy = hash_wow_themes_set($data, 'policy_agreed');

    $user_id = username_exists($user_name);

    $message = '<div class="alert-error" style="margin-bottom:10px;padding:10px"><h5>' . esc_html__('You must agreed the policy', 'hash') . '</h5></div>';

    ;

    if (!$policy)
        $message = '';

    if (!$user_id && email_exists($user_email) == false) {

        if ($policy) {

            $random_password = ( $user_pass ) ? $user_pass : wp_generate_password($length = 12, $include_standard_special_chars = false);

            $user_id = wp_create_user($user_name, $random_password, $user_email);

            if (is_wp_error($user_id) && is_array($user_id->get_error_messages())) {

                foreach ($user_id->get_error_messages() as $message)
                    $message .= '<div class="alert-error" style="margin-bottom:10px;padding:10px"><h5>' . $message . '</h5></div>';
            } else
                $message = '<div class="alert-success" style="margin-bottom:10px;padding:10px"><h5>' . esc_html__('Registration Successful - An email is sent', 'hash') . '</h5></div>';
        }
    } else {

        $message .= '<div class="alert-error" style="margin-bottom:10px;padding:10px"><h5>' . esc_html__('Username or email already exists.  Password inherited.', 'hash') . '</h5></div>';
    }

    return $message;
}

function hash_wow_themes_list_comments($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment;
    ?>
    
    <div itemprop="comment" id="comment-<?php echo comment_ID(); ?>" class="comment<?php echo ($depth > 1) ? ' single_comment_child' : ''; ?>">

        <div class="single_comment<?php echo ($depth > 1) ? ' single_comment_middle' : ''; ?>">

            <div class="single_comment_pic">

        <?php echo get_avatar($comment, 102); ?>

            </div>

            <div class="single_comment_text">

                <div class="sp_title">

                    <?php echo esc_url(comment_author_link()); ?>

                    <p><?php echo get_comment_date(); ?></p>

                </div>

                <div class="comment_text"><?php comment_text();/** print our comment text */ ?></div>

                <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>

            </div>

        </div>
    <?php
    //endif;
}

/**

 * returns the formatted form of the comments

 *

 * @param	array	$args		an array of arguments to be filtered

 * @param	int		$post_id	if form is called within the loop then post_id is optional

 *

 * @return	string	Return the comment form

 */
function hash_wow_themes_comment_form($args = array(), $post_id = null, $review = false) {

    if (null === $post_id)
        $post_id = get_the_ID();
    else
        $id = $post_id;

    $commenter = wp_get_current_commenter();

    $user = wp_get_current_user();

    $user_identity = $user->exists() ? $user->display_name : '';

    $args = wp_parse_args($args);

    if (!isset($args['format']))
        $args['format'] = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';

    $req = get_option('require_name_email');

    $aria_req = ( $req ? " aria-required='true'" : '' );

    $html5 = 'html5' === $args['format'];

    $fields = array(
        'author' => '<input id="author" placeholder="' . esc_html__('Your Name', 'hash') . '" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' />',
        'email' => '<input id="email" placeholder="' . esc_html__('Your Email', 'hash') . '" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' />',
        'url' => '<input id="url" placeholder="' . esc_html__('Your Website', 'hash') . '" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr($commenter['comment_author_url']) . '" size="30" />',
    );

    $required_text = sprintf(' ' . esc_html__('Required fields are marked %s', 'hash'), '<span class="required">*</span>');

    /**

     * Filter the default comment form fields.

     *

     * @since 3.0.0

     *

     * @param array $fields The default comment fields.

     */
    $fields = apply_filters('comment_form_default_fields', $fields);

    $message_class = is_user_logged_in() ? 'col-sm-12' : 'col-sm-6';

    $defaults = array(
        'fields' => $fields,
        'comment_field' => '<textarea id="comment"  placeholder="' . esc_html__('Your Comment', 'hash') . '" name="comment" cols="45" rows="8" aria-required="true"></textarea>',
        'must_log_in' => '<p>' . sprintf(__('You must be <a href="%s">logged in</a> to post a comment.', 'hash'), wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
        'logged_in_as' => '<p>' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'hash'), get_edit_user_link(), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
        'id_form' => 'comments_form',
        'id_submit' => 'submit',
        'title_reply' => esc_html__('LEAVE A COMMENT', 'hash'),
        'title_reply_to' => esc_html__('LEAVE A COMENT to %s', 'hash'),
        'cancel_reply_link' => esc_html__('CANCEL COMMENT', 'hash'),
        'label_submit' => esc_html__('SEND MESSAGE', 'hash'),
        'format' => 'xhtml',
    );

    /**

     * Filter the comment form default arguments.

     *

     * Use 'comment_form_default_fields' to filter the comment fields.

     *

     * @since 3.0.0

     *

     * @param array $defaults The default comment form arguments.

     */
    $args = wp_parse_args($args, apply_filters('comment_form_defaults', $defaults));
    ?>

        <?php if (comments_open($post_id)) : ?>

            <?php
            /**

             * Fires before the comment form.

             *

             * @since 3.0.0

             */
            do_action('comment_form_before');
            ?>

            <div id="respond" class="comment-form">

                <h2><?php comment_form_title($args['title_reply'], $args['title_reply_to']); ?> <small><?php cancel_comment_reply_link($args['cancel_reply_link']); ?></small></h2>

                <div class="comments_form">

            <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>

                <?php echo blanaceTags($args['must_log_in']); ?>

                <?php
                /**

                 * Fires after the HTML-formatted 'must log in after' message in the comment form.

                 *

                 * @since 3.0.0

                 */
                do_action('comment_form_must_log_in_after');
                ?>

            <?php else : ?>

                        <form action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post" id="<?php echo esc_attr($args['id_form']); ?>" class="comment-form"<?php echo esc_attr($html5) ? ' novalidate' : ''; ?>>

                <?php
                /**

                 * Fires at the top of the comment form, inside the <form> tag.

                 *

                 * @since 3.0.0

                 */
                do_action('comment_form_top');
                ?>

                <?php if (is_user_logged_in()) : ?>

                    <?php
                    /**

                     * Filter the 'logged in' message for the comment form for display.

                     *

                     * @since 3.0.0

                     *

                     * @param string $args['logged_in_as'] The logged-in-as HTML-formatted message.

                     * @param array  $commenter            An array containing the comment author's username, email, and URL.

                     * @param string $user_identity        If the commenter is a registered user, the display name, blank otherwise.

                     */
                    echo apply_filters('comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity);
                    ?>

                    <?php
                    /**

                     * Fires after the is_user_logged_in() check in the comment form.

                     *

                     * @since 3.0.0

                     *

                     * @param array  $commenter     An array containing the comment author's username, email, and URL.

                     * @param string $user_identity If the commenter is a registered user, the display name, blank otherwise.

                     */
                    do_action('comment_form_logged_in_after', $commenter, $user_identity);
                    ?>

            <?php else : ?>

                <?php //echo balanceTags($args['comment_notes_before']);  ?>

                                <div class="inp_name">

                            <?php
                            /**

                             * Fires before the comment fields in the comment form.

                             *

                             * @since 3.0.0

                             */
                            do_action('comment_form_before_fields');

                            foreach ((array) $args['fields'] as $name => $field) {

                                /**

                                 * Filter a comment form field for display.

                                 *

                                 * The dynamic portion of the filter hook, $name, refers to the name

                                 * of the comment form field. Such as 'author', 'email', or 'url'.

                                 *

                                 * @since 3.0.0

                                 *

                                 * @param string $field The HTML-formatted output of the comment form field.

                                 */
                                echo apply_filters("comment_form_field_{$name}", $field) . "\n";
                            }

                            /**

                             * Fires after the comment fields in the comment form.

                             *

                             * @since 3.0.0

                             */
                            do_action('comment_form_after_fields');
                            ?>

                                </div>

                            <?php endif; ?>

            <?php
            /**

             * Filter the content of the comment textarea field for display.

             *

             * @since 3.0.0

             *

             * @param string $args['comment_field'] The content of the comment textarea field.

             */
            echo apply_filters('comment_form_field_comment', $args['comment_field']);
            ?>

                            <?php //echo balanceTags($args['comment_notes_after']);  ?>

                            <input name="submit" type="submit" class="btn btn-default" id="<?php echo esc_attr($args['id_submit']); ?>" value="<?php echo esc_attr($args['label_submit']); ?>" />

                                <?php comment_id_fields($post_id); ?>

                                <?php
                                /**

                                 * Fires at the bottom of the comment form, inside the closing </form> tag.

                                 *

                                 * @since 1.5.2

                                 *

                                 * @param int $post_id The post ID.

                                 */
                                do_action('comment_form', $post_id);
                                ?>

                        </form>

                            <?php endif; ?>

                </div>

            </div><!-- #respond -->

                            <?php
                            /**

                             * Fires after the comment form.

                             *

                             * @since 3.0.0

                             */
                            do_action('comment_form_after');

                        else :

                            /**

                             * Fires after the comment form if comments are closed.

                             *

                             * @since 3.0.0

                             */
                            do_action('comment_form_comments_closed');

                        endif;
                    }

                    function hash_wow_themes_blog_excerpt_more($more) {

                        return '';
                    }

                    add_filter('excerpt_more', 'hash_wow_themes_blog_excerpt_more');

                   /* function hash_wow_themes_the_pagination($args = array(), $echo = 1) {

                        global $wp_query;

                        $default = array('base' => str_replace(99999, '%#%', esc_url(get_pagenum_link(99999))), 'format' => '?paged=%#%', 'show_all' => 'False', 'current' => max(1, get_query_var('paged')),
                            'total' => $wp_query->max_num_pages, 'next_text' => '<i class="fa fa-angle-right"></i>', 'prev_text' => '<i class="fa fa-angle-left"></i>', 'type' => 'list');

                        $args = wp_parse_args($args, $default);

                        $pagination = '<div class="scroll-buttons text-center">' . str_replace('<ul class=\'page-numbers\'>', '<ul class="pagination">', paginate_links($args)) . '</div>';

                        if (paginate_links(array_merge(array('type' => 'array'), $args))) {

                            if ($echo)
                                echo balanceTags($pagination);

                            return $pagination;
                        }
                    }*/
                    
                    
                    function hash_wow_themes_the_pagination($args = array(), $echo = 1) {







                        global $wp_query;







                        $default = array('base' => str_replace(99999, '%#%', esc_url(get_pagenum_link(99999))), '' => '?paged=%#%', 'show_all' => 'False', 'current' => max(1, get_query_var('paged')),
                            'total' => $wp_query->max_num_pages, 'next_text' => 'Next', 'prev_text' => 'previous', 'type' => 'list');







                        $args = wp_parse_args($args, $default);







                        $pagination = '<div class="news_pagination">' . str_replace('<ul class=\'page-numbers\'>', '<ul class="news_pagi">', paginate_links($args)) . '</div>';







                        if (paginate_links(array_merge(array('type' => 'array'), $args))) {



                            if ($echo)
                                echo balanceTags($pagination);



                            return $pagination;
                        }
                    }

                    function hash_wow_themes_post_format_output($settings = array()) {

                        global $post;

                        if (!$settings)
                            return;

                        $format = get_post_format();

                        $output = '';

                        switch ($format) {

                            case 'standard':

                            case 'image':

                                $output = get_the_post_thumbnail(get_the_id(), '1750x1143');

                                break;

                            case 'gallery':

                                $attachments = get_posts('post_type=attachment&post_parent=' . get_the_id());

                                if ($attachments) {

                                    $output = '<div id="myCarousel" class="carousel slide">

                                <div class="carousel-inner">';

                                    foreach ($attachments as $k => $att) {

                                        $active = ( $k == 0 ) ? ' active' : '';

                                        $output .= '<div class="item' . $active . '">' . wp_get_attachment_image($att->ID, 'full') . '</div>';
                                    }

                                    $output .= '</div>

                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">

                                        <span class="icon-prev"></span>

                                    </a>

                                    <a class="right carousel-control" href="#myCarousel" data-slide="next">

                                        <span class="icon-next"></span>  

                                    </a>

                                </div>';
                                }

                                break;

                            case 'video':

                                $output = '<div class="js-video [vimeo, widescreen]">' . hash_wow_themes_set($settings, 'video') . '</div>';

                                break;

                            case 'audio_embed':

                                $output = '<div class="js-video [vimeo, widescreen]">' . hash_wow_themes_set($settings, 'audio_embed') . '</div>';

                                break;

                            case 'quoted':

                            case 'link':

                                break;

                            default:

                                $output = get_the_post_thumbnail(get_the_id(), '1750x1143');

                                break;
                        }

                        return $output;
                    }

                    function hash_wow_themes_font_settings($FontSettings = array(), $StyleBefore = '', $StyleAfter = '') {

                        $i = 1;

                        $settings = HASH_WSH()->option();

                        $Style = '';

                        foreach ($FontSettings as $k => $v) {

                            if ($value = hash_wow_themes_set($settings, $k))
                                $Style .= $v . ' : ' . $value . ' !important; ';
                        }

                        return (!empty($Style) ) ? $StyleBefore . $Style . $StyleAfter . "\n" : '';
                    }

                    function hash_wow_themes_register_dynamic_sidebar() {

                        $theme_options = get_option('wp_hash' . '_theme_options');

                        $sidebars = hash_wow_themes_set(hash_wow_themes_set($theme_options, 'dynamic_sidebar'), 'dynamic_sidebar');

                        if ($sidebars && is_array($sidebars)) {

                            foreach ($sidebars as $sidebar) {

                                if (isset($sidebar['tocopy']))
                                    continue;

                                register_sidebar(array(
                                    'name' => $sidebar['sidebar_name'],
                                    'id' => sh_slug($sidebar['sidebar_name']),
                                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                                    'after_widget' => "</div>",
                                    'before_title' => '<h4 class="title"><span>',
                                    'after_title' => '</span></h4>',
                                ));
                            }
                        }
                    }

                    function hash_wow_themes_gravatar_url($email, $width = 80) {

                        $hash = md5(strtolower(trim($email)));

                        return 'http://gravatar.com/avatar/' . $hash . '&s=' . $width;
                    }

                    function hash_wow_themes_star_rating($dis = false) {

                        $ip = $_SERVER['REMOTE_ADDR'];

                        $meta = get_post_meta(get_the_id(), '_download_rating', true);

                        $count = count($meta) ? count($meta) : 1;

                        $titles = array(esc_html__('Poor', 'hash'), esc_html__('Satisfactory', 'hash'), esc_html__('Good', 'hash'), esc_html__('Better', 'hash'), esc_html__('Awesome', 'hash'));

                        $evg = array_sum((array) $meta) / $count;

                        if ($dis) {

                            foreach (array_reverse(range(0, 4)) as $rang) {

                                $checked = ( ( $rang + 1 ) <= round($evg) ) ? 'fa-star' : 'fa-star-o';

                                echo '<i class="fa ' . esc_attr($checked) . '" title="' . esc_attr($titles[$rang]) . '" data-post-id="' . esc_attr(get_the_ID()) . '"/></i>' . "\n";
                            }
                        } else {

                            $disabled = isset($meta[$ip]) ? ' disabled="disabled"' : '';

                            echo '<div class="clearfix center">' . "\n";

                            foreach (range(0, 4) as $rang) {

                                $checked = ( ( $rang + 1 ) == round($evg) ) ? ' checked="checked"' : '';

                                echo '<input class="download-star" type="radio" name="download-2-rating-1"' . $disabled . $checked . ' value="' . ( $rang + 1 ) . '" title="' . $titles[$rang] . '" data-post-id="' . get_the_ID() . '"/>' . "\n";
                            }

                            echo '</div>' . "\n";

                            printf(esc_html__('Average Rating %s', 'hash'), $evg);
                        }
                    }

                    function hash_wow_themes_trim($text, $len) {

                        $text = strip_shortcodes($text);

                        $text = apply_filters('the_content', $text);

                        $text = str_replace(']]>', ']]&gt;', $text);

                        //$excerpt_length = apply_filters( 'excerpt_length', $len );

                        $excerpt_length = $len;

                        $excerpt_more = apply_filters('excerpt_more', ' ' . '[&hellip;]');

                        $text = wp_trim_words($text, $excerpt_length, $excerpt_more);

                        return $text;
                    }

                    function hash_wow_themes_page_by_template($tmpl, $index = 0) {

                        $pages = get_posts(array(
                            'post_type' => 'page',
                            'meta_key' => '_wp_page_template',
                            'meta_value' => $tmpl
                        ));

                        if ($pages) {

                            return $pages[$index];
                        }

                        return false;
                    }

                    add_action('sh_header_menus', 'hash_wow_themes_header_menus');

                    function hash_wow_themes_header_menus() {
                        
                    }

                    function hash_wow_themes_post_formate_icon($formate) {

                        if ($formate == 'video') {

                            return '<div class="br_cam br_vid_big_s">

                        <a href="" class="fa fa-file-video-o">

                        </a>

                    </div>';
                        } elseif ($formate == 'audio_embed') {

                            return '<div class="br_cam br_vid_big_s">

                        <a href="" class="fa fa-file-audio-o">

                        </a>

                    </div>';
                        } elseif ($formate == 'gallery') {

                            return '<div class="br_cam br_vid_big_s">

                        <a href="" class="fa fa-folder-open">

                        </a>

                    </div>';
                        } elseif ($formate == 'quote') {

                            return '<div class="br_cam br_vid_big_s">

                        <a href="" class="fa fa-commenting-o">

                        </a>

                    </div>';
                        } else {

                            return '<div class="br_cam br_vid_big_s">

                        <a href="" class="fa fa-camera">

                        </a>

                    </div>';
                        }
                    }

                    function hash_wow_themes_social_share_output($shares = array(), $color = false) {

                        $permalink = get_permalink(get_the_ID());

                        $titleget = get_the_title();

                        $color = (hash_wow_themes_set($shares, 'icon_color')) ? ' style="background:' . hash_wow_themes_set($shares, 'icon_color') . ';"' : '';

                        ob_start();

                        if (in_array('facebook', $shares)) {
                            ?>

            <li><a<?php echo balanceTags($color); ?> class="fa fa-facebook" itemprop="url" onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo esc_url($permalink) ?>', 'Facebook', 'width=600,height=300,left=' + (screen.availWidth / 2 - 300) + ',top=' + (screen.availHeight / 2 - 150) + '');

                    return false;" href="http://www.facebook.com/sharer.php?u=<?php echo esc_url($permalink) ?>">

                </a></li>

        <?php } ?>

        <?php
        if (in_array('twitter', $shares)) {
            ?>

            <li><a<?php echo balanceTags($color); ?> class="fa fa-twitter" itemprop="url" onClick="window.open('http://twitter.com/share?url=<?php echo esc_url($permalink) ?>&amp;text=<?php echo str_replace(" ", "%20", $titleget); ?>', 'Twitter share', 'width=600,height=300,left=' + (screen.availWidth / 2 - 300) + ',top=' + (screen.availHeight / 2 - 150) + '');

                    return false;" href="http://twitter.com/share?url=<?php echo esc_url($permalink) ?>&amp;text=<?php echo str_replace(" ", "%20", $titleget); ?>">

                </a></li>

        <?php } ?>

        <?php
        if (in_array('gplus', $shares)) {
            ?>

            <li><a<?php echo balanceTags($color); ?> class="fa fa-google-plus" itemprop="url" onClick="window.open('https://plus.google.com/share?url=<?php echo esc_url($permalink) ?>', 'Google plus', 'width=585,height=666,left=' + (screen.availWidth / 2 - 292) + ',top=' + (screen.availHeight / 2 - 333) + '');

                    return false;" href="https://plus.google.com/share?url=<?php echo esc_url($permalink) ?>">

                </a></li>

        <?php } ?>

        <?php
        if (in_array('digg', $shares)) {
            ?>

            <li><a<?php echo balanceTags($color); ?> class="fa fa-digg" itemprop="url" onClick="window.open('http://www.digg.com/submit?url=<?php echo esc_url($permalink) ?>', 'Digg', 'width=715,height=330,left=' + (screen.availWidth / 2 - 357) + ',top=' + (screen.availHeight / 2 - 165) + '');

                    return false;" href="http://www.digg.com/submit?url=<?php echo esc_url($permalink) ?>">

                </a></li>

        <?php } ?>

        <?php
        if (in_array('reddit', $shares)) {
            ?>

            <li><a<?php echo balanceTags($color); ?> class="fa fa-reddit" itemprop="url" onClick="window.open('http://reddit.com/submit?url=<?php echo esc_url($permalink) ?>&amp;title=<?php echo str_replace(" ", "%20", $titleget); ?>', 'Reddit', 'width=617,height=514,left=' + (screen.availWidth / 2 - 308) + ',top=' + (screen.availHeight / 2 - 257) + '');

                    return false;" href="http://reddit.com/submit?url=<?php echo esc_url($permalink) ?>&amp;title=<?php echo str_replace(" ", "%20", $titleget); ?>">

                </a></li>

        <?php } ?>

        <?php
        if (in_array('linkedin', $shares)) {
            ?>

            <li><a<?php echo balanceTags($color); ?> class="fa fa-linkedin" itemprop="url" onClick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url($permalink) ?>', 'Linkedin', 'width=863,height=500,left=' + (screen.availWidth / 2 - 431) + ',top=' + (screen.availHeight / 2 - 250) + '');

                    return false;" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url($permalink) ?>">

                </a></li>

        <?php } ?>

        <?php
        if (in_array('pinterest', $shares)) {
            ?>

            <li><a<?php echo balanceTags($color); ?> class="fa fa-pinterest" itemprop="url" href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());'>

                </a></li>

        <?php } ?>

        <?php
        if (in_array('stumbleupon', $shares)) {
            ?>

            <li><a<?php echo balanceTags($color); ?> class="fa fa-stumbleupon" itemprop="url" onClick="window.open('http://www.stumbleupon.com/submit?url=<?php echo esc_url($permalink) ?>&amp;title=<?php echo str_replace(" ", "%20", $titleget); ?>', 'Stumbleupon', 'width=600,height=300,left=' + (screen.availWidth / 2 - 300) + ',top=' + (screen.availHeight / 2 - 150) + '');

                    return false;" href="http://www.stumbleupon.com/submit?url=<?php echo esc_url($permalink) ?>&amp;title=<?php echo str_replace(" ", "%20", $titleget); ?>">

                </a></li>

        <?php } ?>

        <?php
        if (in_array('tumblr', $shares)) {

            $str = $permalink;

            $str = preg_replace('#^https?://#', '', $str);
            ?>

            <li><a<?php echo balanceTags($color); ?> class="fa fa-tumblr" itemprop="url" onClick="window.open('http://www.tumblr.com/share/link?url=<?php echo esc_url($str); ?>&amp;name=<?php echo str_replace(" ", "%20", $titleget); ?>', 'Tumblr', 'width=600,height=300,left=' + (screen.availWidth / 2 - 300) + ',top=' + (screen.availHeight / 2 - 150) + '');

                    return false;" href="http://www.tumblr.com/share/link?url=<?php echo esc_url($str); ?>&amp;name=<?php echo str_replace(" ", "%20", $titleget); ?>">

                </a></li>

        <?php } ?>

        <?php
        if (in_array('email', $shares)) {
            ?>

            <li><a<?php echo balanceTags($color); ?> class="fa fa-envelope-o" itemprop="url" href="mailto:?Subject=<?php echo str_replace(" ", "%20", $titleget); ?>&amp;Body=<?php echo esc_url($permalink) ?>"></a></li>

            <?php
        }

        return ob_get_clean();
    }

    function hash_wow_themes_social_share_array() {

        $share = array('facebook', 'twitter', 'gplus', 'digg', 'reddit', 'linkedin', 'pinterest', 'stumbleupon', 'tumblr', 'email');

        $shares = array();

        foreach ($share as $media) {

            $data[$media] = ucfirst($media);
        }

        return $data;
    }

    function hash_wow_themes_get_post_view($postID) {

        $view = get_post_meta($postID, 'sh_post_views_count', true);

        if ($view != '') {

            return $view;
        } else {

            return 0;
        }
    }

    function hash_wow_themes_set_post_view($postID) {

        $count_key = 'sh_post_views_count';

        $count = get_post_meta($postID, $count_key, true);

        $count++;

        update_post_meta($postID, $count_key, $count);
    }

    function hash_wow_themes_get_tags() {

        $tags = get_the_tags();

        if ($tags):

            foreach ($tags as $tag):

                echo '<li><a itemprop="url" href="' . get_tag_link(hash_wow_themes_set($tag, 'term_id')) . '" title="' . hash_wow_themes_set($tag, 'slug') . '">' . hash_wow_themes_set($tag, 'name') . '</a></li>';

            endforeach;

        endif;
    }

    function hash_wow_themes_single_post_format($postid) {

        $post_meta = get_post_meta($postid, '_sh_single_post_options', true);

        $post_format = get_post_format($postid);

        $output = '';

        if ($post_format == 'video') {

            $output .= '<div class="sp_video_box">

                        <div class="embed-responsive embed-responsive-16by9">' . hash_wow_themes_set($post_meta, 'video') . '

                        </div>

            </div>';
        } elseif ($post_format == 'audio') {

            $output .= '<div class="sp_audio_box sp_video_box">' . hash_wow_themes_set($post_meta, 'audio_embed') . '</div>';
        } elseif ($post_format == 'quote') {

            $background = (wp_get_attachment_url(get_post_thumbnail_id($postid))) ? ' style="background:url(' . wp_get_attachment_url(get_post_thumbnail_id($postid)) . ')"' : '';

            $output .= '<div class="bsqp_quote"' . $background . '">

                            <div class="bsqp_quote_text">

                                        <img alt="blog quote post" src="' . get_template_directory_uri() . '/images/quote_ico.png">

                                        <p>' . hash_wow_themes_set($post_meta, 'quote') . '</p>

                                        <span>' . get_the_author_meta('display_name') . '</span>

                                </div>          

                    </div>';
        } elseif ($post_format == 'gallery') {

            $images = hash_wow_themes_set($post_meta, 'gallery_2');

            $images = explode(',', $images);
            //echo '<pre>';print_r($post_meta);exit;
            $output .= '<div class="bsp_img">';

            if (!empty($images)) {

                $output .= '<div id="postcarousel" class="carousel slide" data-ride="carousel">
                <div role="listbox" class="carousel-inner">';

                $i=1;
                foreach ($images as $image) {
                    $class = ($i==1) ? ' active' : '';
                    $output .= '<div class="item'.$class.'">' . wp_get_attachment_image($image, '835x426') . '</div>';
                
                    $i++;
                }

                $output .= '</div></div>';
            }

            $output .= '</div>';
        } else {

            $output .= '
            ';
        }

        return $output;
    }
    

    if (!function_exists('hash_wow_sh_set')) {

        function hash_wow_sh_set($var, $key, $def = '') {

            if (is_object($var) && isset($var->$key))
                return $var->$key;

            elseif (is_array($var) && isset($var[$key]))
                return $var[$key];

            elseif ($def)
                return $def;
            else
                return false;
        }

    }
    

    