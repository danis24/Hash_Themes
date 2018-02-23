<?php

if (!defined('ABSPATH')) {
    die;
}
// Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings = array(
    'menu_title' => esc_html__('Theme Options', 'hash'),
    'menu_type' => 'add_theme_page',
    'menu_slug' => 'wp_hash' . '_options',
    'ajax_save' => false,
);

// =====================================================Blog=========================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();


// ------------------------------
// GENERAL SETTINGS   -
// ------------------------------
$options[] = array(
    'name' => 'gen_settings',
    'title' => 'GENERAL SETTINGS',
    'icon' => 'fa fa-cogs',
    'sections' => array(
        // -----------------------------
        // begin: General Settings         -
        // -----------------------------
        array(
            'name' => 'general_settings',
            'title' => 'General Settings',
            'icon' => 'fa fa-cog',
            // begin: fields
            'fields' => array(
                // begin: color scheme heading
/*                array(
                    'type' => 'heading',
                    'content' => 'Color Scheme',
                ),
                array(
                    'id' => 'color_schemes',
                    'type' => 'color_picker',
                    'title' => 'Color Scheme',
                    'desc' => 'Choose the Custom color scheme for the theme.',
                    'default' => 'rgba(0, 0, 255, 0.25)',
                ),*/
                // begin: Boxed Version Settings
/*                array(
                    'type' => 'heading',
                    'content' => 'Boxed Version Settings',
                ),
                array(
                    'id' => 'boxed_version_settings',
                    'type' => 'switcher',
                    'title' => 'Boxed Version Settings',
                    'desc' => 'This section contain the information about boxed version settings.',
                    'label' => 'Yes, Please do it.',
                ),*/
                // begin: RTL Settings
                array(
                    'type' => 'heading',
                    'content' => 'RTL Settings',
                ),
                array(
                  'id'    => 'rtl',
                  'type'  => 'switcher',
                  'title' => 'Enable RTL',
                  'desc'  => 'Enable / Disable rtl ( Right to Left ).',
                ),
                // begin: color Twitter Settings
                array(
                    'type' => 'heading',
                    'content' => 'Twitter Settings',
                ),
                array(
                    'id' => 'twitter_api',
                    'type' => 'text',
                    'title' => 'API Key',
                    'desc' => 'To get the API keys visist',
                    'attributes' => array(
                        'style' => 'width: 604px; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'twitter_api_secret',
                    'type' => 'text',
                    'title' => 'API Secret key',
                    'desc' => 'Enter api secret key.',
                    'attributes' => array(
                        'style' => 'width: 604px; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'twitter_token',
                    'type' => 'text',
                    'title' => 'Token',
                    'desc' => 'Enter generated token.',
                    'attributes' => array(
                        'style' => 'width: 604px; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'twitter_token_secret',
                    'type' => 'text',
                    'title' => 'Token secret key',
                    'desc' => 'enter token secret.',
                    'attributes' => array(
                        'style' => 'width: 604px; height: 40px;'
                    ),
                ),
                // begin: Purchase Information
                array(
                    'type' => 'heading',
                    'content' => 'Purchase Information',
                ),
                array(
                    'id' => 'purchase_information',
                    'type' => 'text',
                    'title' => 'Purchase Information',
                    'desc' => 'To get the auto theme updates provide purchase information.',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'sh_purchase_code',
                    'type' => 'text',
                    'title' => 'Purchase Code',
                    'desc' => 'To find the purchase code to TF downloads tab click on Download then choose "License and Purchase code.',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
            ), // end: fields
        ), // end: General Settings
        // -----------------------------
        // begin: Header Settings     -
        // -----------------------------
        array(
            'name' => 'header_settings',
            'title' => 'Header Settings',
            'icon' => 'fa fa-hand-o-right',
            'fields' => array(
                // begin: Favicon

                array(
                    'type' => 'heading',
                    'content' => 'Header Settings',
                ),
                array(
                    'id' => 'site_favicon',
                    'type' => 'upload',
                    'title' => 'Upload the favicon, should be 16x16',
                    'attributes' => array(
                        'style' => 'width: 485px;'
                    ),
                    'settings' => array(
                        'button_title' => 'Upload Favicon',
                        'frame_title' => 'Choose a image',
                        'insert_title' => 'Use this image',
                    ),
                ),
                array(
                    'id' => 'logo_type',
                    'type' => 'upload',
                    'title' => 'Upload the Logo',
                    'attributes' => array(
                        'style' => 'width: 502px;'
                    ),
                    'settings' => array(
                        'button_title' => 'Upload Logo',
                        'frame_title' => 'Choose a image',
                        'insert_title' => 'Use this image',
                    ),
                ),
                array(
                    'id' => 'header_add',
                    'type' => 'upload',
                    'title' => 'Upload Header Add',
                    'disc' => 'Add Size Should be 728x90',
                    'attributes' => array(
                        'style' => 'width: 502px;'
                    ),
                    'settings' => array(
                        'button_title' => 'Upload Add',
                        'frame_title' => 'Choose a image',
                        'insert_title' => 'Use this image',
                    ),
                ),
                array(
                    'id' => 'add_url',
                    'type' => 'text',
                    'title' => 'Add URL',
                    'desc' => 'Enter Header Add URL',
                    'default' => '',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                /* 		array(
                  'id'    => 'searchbox',
                  'type'  => 'switcher',
                  'title' => 'Show Search Box',
                  'desc'  => 'Show or hide search box in header.',
                  'label' => 'Yes, Please do it.',
                  ), */
                array(
                    'id' => 'header_css',
                    'type' => 'textarea',
                    'title' => 'Header CSS',
                    'desc' => 'Write your custom css to include in header.',
                    'default' => '',
                ),
            ),
        ), // end: header settings
        // -----------------------------
        // begin: Footer Settings     -
        // -----------------------------
        array(
            'name' => 'footer_settings',
            'title' => 'Footer Settings',
            'icon' => 'fa fa-hand-o-right',
            'fields' => array(
                // begin: Footer Settings

                array(
                    'type' => 'heading',
                    'content' => 'Footer Settings',
                ),
                array(
                    'id' => 'show_footer',
                    'type' => 'switcher',
                    'title' => 'Show/Hide whole footer',
                    'desc' => 'Show or hide whole footer.',
                    'label' => 'Yes, Please do it.',
                ),
                /* 		array(
                  'id'      => 'footer_bg',
                  'attributes' => array(
                  'style'    => 'width: 536px;'
                  ),
                  'type'    => 'upload',
                  'title'   => 'Footer Background',
                  'desc'    => 'choose the Footer Background.',
                  'help'    => 'choose the Footer Background.',
                  ), */
                array(
                    'id' => 'footer_address',
                    'type' => 'textarea',
                    'title' => 'Footer Address',
                    'desc' => 'Enter Address to show on footer.',
                    'default' => '123 South corner street, Melbourne.',
                ),
                array(
                    'id' => 'footer_phone',
                    'type' => 'text',
                    'title' => 'Footer Phone',
                    'desc' => 'Enter Phone to show on footer.',
                    'default' => '+61 012 345 6789',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'footer_email',
                    'type' => 'text',
                    'title' => 'Footer Email',
                    'desc' => 'Enter Email to show on footer.',
                    'default' => 'info@agile.com',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'copy_right',
                    'type' => 'textarea',
                    'title' => 'Copy Right Text',
                    'desc' => 'Enter the Copy Right Text.',
                    'default' => '&copy; COPY RIGHTS 2015 All Rights Reserved. ',
                ),
            ),
        ), // end: footer settings
        // -----------------------------
        // begin: Permalinks Settings       -
        // -----------------------------
        array(
            'name' => 'permalinks_settings',
            'title' => 'Permalinks Settings',
            'icon' => 'fa fa-link',
            'fields' => array(
                array(
                    'type' => 'heading',
                    'content' => 'Post Type Permalinks',
                ),
                array(
                    'id' => 'team_permalink',
                    'type' => 'text',
                    'title' => 'Team Permalink',
                    'desc' => 'Enter Slug for Team Post Type.',
                    'default' => '',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'services_permalink',
                    'type' => 'text',
                    'title' => 'Services Permalink',
                    'desc' => 'Enter Slug for Services Post Type.',
                    'default' => '',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'projects_permalink',
                    'type' => 'text',
                    'title' => 'Projects Permalink',
                    'desc' => 'Enter Permalink for Projects Post Type.',
                    'default' => '',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'testimonial_permalink',
                    'type' => 'text',
                    'title' => 'Testimonial Permalink',
                    'desc' => 'Enter Permalink for Testimonial Post Type.',
                    'default' => '',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'type' => 'heading',
                    'content' => 'Category Permalinks',
                ),
                array(
                    'id' => 'team_category_permalink',
                    'type' => 'text',
                    'title' => 'Team Category Permalink',
                    'desc' => 'Enter Slug for Team Taxonomy.',
                    'default' => '',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'services_category_permalink',
                    'type' => 'text',
                    'title' => 'Services Category Permalink',
                    'desc' => 'Enter Slug for Services Taxonomy.',
                    'default' => '',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'projects_category_permalink',
                    'type' => 'text',
                    'title' => 'Projects Category Permalink',
                    'desc' => 'Enter Permalink for Projects Taxonomy.',
                    'default' => '',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'testimonial_category_permalink',
                    'type' => 'text',
                    'title' => 'Testimonial Category Permalink',
                    'desc' => 'Enter Permalink for Testimonial Taxonomy.',
                    'default' => '',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
            ),
        ), // end: other options
    )
);

// ------------------------------
// a seperator                  -
// ------------------------------
// ------------------------------
// GENERAL SETTINGS   -
// ------------------------------
$options[] = array(
    'name' => 'page_settings',
    'title' => 'Page Settings',
    'icon' => 'fa fa-file',
    'sections' => array(
        // -----------------------------
        // begin: Blog Page Settings         -
        // -----------------------------
        array(
            'name' => 'single_post_settings',
            'title' => 'Single Post Page',
            'icon' => 'fa fa-cog',
            // begin: fields
            'fields' => array(
                // begin: color scheme heading
                array(
                    'type' => 'heading',
                    'content' => 'Post Detail Page Settings',
                ),
                array(
                    'id' => 'single_post_categories',
                    'type' => 'switcher',
                    'title' => 'Enable Post Categories',
                    'desc' => 'Enable to show post categories on post detail page',
                    'label' => '',
                ),
                array(
                    'id' => 'single_post_author',
                    'type' => 'switcher',
                    'title' => 'Enable Post Author',
                    'desc' => 'Enable to show post author on post detail page',
                    'label' => '',
                ),
                array(
                    'id' => 'single_post_views',
                    'type' => 'switcher',
                    'title' => 'Enable Post Views',
                    'desc' => 'Enable to show post views counter on post detail page',
                    'label' => '',
                ),
                array(
                    'id' => 'single_post_comment',
                    'type' => 'switcher',
                    'title' => 'Enable Post Commnets Counter',
                    'desc' => 'Enable to show post comments counter on post detail page',
                    'label' => '',
                ),
                array(
                    'id' => 'single_post_tags',
                    'type' => 'switcher',
                    'title' => 'Enable Post Tags',
                    'desc' => 'Enable to show post tags on post detail page',
                    'label' => '',
                ),
                array(
                    'id' => 'single_post_navigation',
                    'type' => 'switcher',
                    'title' => 'Enable Post Navigation',
                    'desc' => 'Enable to show post navigation on post detail page',
                    'label' => '',
                ),
                array(
                    'id' => 'single_post_social',
                    'type' => 'switcher',
                    'title' => 'Enable Social Media',
                    'desc' => 'Enable to show social media for post sharing on post detail page',
                    'label' => '',
                ),
                array(
                    'id' => 'single_post_social_media',
                    'type' => 'group',
                    'title' => 'Single Post Social Media',
                    'button_title' => 'Add Social Media',
                    'desc' => 'This section is used to add social media for single post sharing',
                    'accordion_title' => 'Social Media',
                    'fields' => array(
                        array(
                            'id' => 'icon_color',
                            'type' => 'color_picker',
                            'title' => 'Social media colour',
                            'desc' => 'Choose the Custom color for social media icon',
                            'default' => 'rgba(0, 0, 255, 0.25)',
                        ),
                        array(
                            'id' => 'social_title',
                            'type' => 'text',
                            'title' => 'Title',
                            'desc' => 'Enter the title of the social media.',
                            'attributes' => array(
                                'style' => 'width: 100%; height: 40px;'
                            ),
                        ),
                        array(
                            'id' => 'single_social_media_type',
                            'type' => 'select',
                            'title' => 'Select with Chosen',
                            'options' => hash_wow_themes_social_share_array()
                        ),
                    )
                ), // end: group options
            ), // end: fields
        ), // end: General Settings
        // -----------------------------
        // begin: Blog Page Settings         -
        // -----------------------------
        array(
            'name' => 'blog_page_settings',
            'title' => 'Blog Page',
            'icon' => 'fa fa-cog',
            // begin: fields
            'fields' => array(
                // begin: color scheme heading
                array(
                    'type' => 'heading',
                    'content' => 'Blog Page Settings',
                ),
                array(
                    'id' => 'blog_page_title',
                    'type' => 'text',
                    'title' => 'Blog Page Title',
                    'desc' => 'Enter the Title you want to show on blog page.',
                    'default' => 'Blog',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'blog_page_sidebar',
                    'type' => 'select',
                    'title' => 'Select with Chosen',
                    'options' => hash_wow_themes_get_sidebars()
                ),
                array(
                    'id' => 'blog_page_layout',
                    'type' => 'image_select',
                    'title' => 'Page Layout',
                    'options' => array(
                        'left' => HASH_WOW_THEMES_URL . '/includes/thirdparty/framework/assets/images/2cl.png',
                        'right' => HASH_WOW_THEMES_URL . '/includes/thirdparty/framework/assets/images/2cr.png',
                        'full' => HASH_WOW_THEMES_URL . '/includes/thirdparty/framework/assets/images/1col.png',
                    ),
                    'radio' => true,
                    'default' => 'right'
                ),
                array(
                    'type' => 'select',
                    'id' => 'blog_grids_cols',
                    'title' => esc_html__('Blog Grids Columns', 'hash'),
                    'description' => esc_html__('Select blog listing grids columns', 'hash'),
                    'options' => array(
                        '6' => esc_html__('Two Columns', 'hash'),
                        '4' => esc_html__('Three Columns', 'hash'),
                        '3' => esc_html__('Four Columns', 'hash'),
                    )
                ),
            ), // end: fields
        ), // end: General Settings
        // -----------------------------
        // begin: Search Page Settings         -
        // -----------------------------
        array(
            'name' => 'search_page_settings',
            'title' => 'Search Page',
            'icon' => 'fa fa-search',
            // begin: fields
            'fields' => array(
                // begin: color scheme heading
                array(
                    'type' => 'heading',
                    'content' => 'Search Page Settings',
                ),
                array(
                    'id' => 'search_page_title',
                    'type' => 'text',
                    'title' => 'Blog Search Page Title',
                    'desc' => 'Enter the Title you want to show on blog search page.',
                    'default' => 'Blog',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'search_page_sidebar',
                    'type' => 'select',
                    'title' => 'Select with Chosen',
                    'options' => hash_wow_themes_get_sidebars()
                ),
                array(
                    'id' => 'search_page_layout',
                    'type' => 'image_select',
                    'title' => 'Page Layout',
                    'options' => array(
                        'left' => HASH_WOW_THEMES_URL . '/includes/thirdparty/framework/assets/images/2cl.png',
                        'right' => HASH_WOW_THEMES_URL . '/includes/thirdparty/framework/assets/images/2cr.png',
                        'full' => HASH_WOW_THEMES_URL . '/includes/thirdparty/framework/assets/images/1col.png',
                    ),
                    'radio' => true,
                    'default' => 'full'
                ),
            ), // end: fields
        ), // end: General Settings
        // -----------------------------
        // begin: Archive Page Settings     -
        // -----------------------------
        array(
            'name' => 'archive_page_settings',
            'title' => 'Archive Page',
            'icon' => 'fa fa-archive',
            'fields' => array(
                // begin: Favicon

                array(
                    'type' => 'heading',
                    'content' => 'Header Settings',
                ),
                array(
                    'id' => 'archive_page_title',
                    'type' => 'text',
                    'title' => 'Archive Page Title',
                    'desc' => 'Enter the Title you want to show on blog archive page.',
                    'default' => 'Archive Page',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'archive_page_sidebar',
                    'type' => 'select',
                    'title' => 'Select with Chosen',
                    'options' => hash_wow_themes_get_sidebars()
                ),
                array(
                    'id' => 'archive_page_layout',
                    'type' => 'image_select',
                    'title' => 'Page Layout',
                    'options' => array(
                        'left' => HASH_WOW_THEMES_URL . '/includes/thirdparty/framework/assets/images/2cl.png',
                        'right' => HASH_WOW_THEMES_URL . '/includes/thirdparty/framework/assets/images/2cr.png',
                        'full' => HASH_WOW_THEMES_URL . '/includes/thirdparty/framework/assets/images/1col.png',
                    ),
                    'radio' => true,
                    'default' => 'full'
                ),
            ),
        ), // end: Archive Page settings
        // -----------------------------
        // begin: Author Page Settings     -
        // -----------------------------
        array(
            'name' => 'author_page_settings',
            'title' => 'Author Page',
            'icon' => 'fa fa-user',
            'fields' => array(
                // begin: Footer Settings

                array(
                    'type' => 'heading',
                    'content' => 'Footer Settings',
                ),
                array(
                    'id' => 'author_page_title',
                    'type' => 'text',
                    'title' => 'Author Page Title',
                    'desc' => 'Enter the Title you want to show on author page.',
                    'default' => 'Author Page',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'author_page_sidebar',
                    'type' => 'select',
                    'title' => 'Select with Chosen',
                    'options' => hash_wow_themes_get_sidebars()
                ),
                array(
                    'id' => 'author_page_layout',
                    'type' => 'image_select',
                    'title' => 'Page Layout',
                    'options' => array(
                        'left' => HASH_WOW_THEMES_URL . '/includes/thirdparty/framework/assets/images/2cl.png',
                        'right' => HASH_WOW_THEMES_URL . '/includes/thirdparty/framework/assets/images/2cr.png',
                        'full' => HASH_WOW_THEMES_URL . '/includes/thirdparty/framework/assets/images/1col.png',
                    ),
                    'radio' => true,
                    'default' => 'full'
                ),
            ),
        ), // end: Author Page settings
        // -----------------------------
        // begin: Category Page Settings         -
        // -----------------------------
        array(
            'name' => 'category_page_settings',
            'title' => 'Category Page',
            'icon' => 'fa fa-cog',
            // begin: fields
            'fields' => array(
                // begin: color scheme heading
                array(
                    'type' => 'heading',
                    'content' => 'Category Page Settings',
                ),
                array(
                    'id' => 'category_page_sidebar',
                    'type' => 'select',
                    'title' => 'Select with Chosen',
                    'options' => hash_wow_themes_get_sidebars()
                ),
                array(
                    'id' => 'category_page_layout',
                    'type' => 'image_select',
                    'title' => 'Page Layout',
                    'options' => array(
                        'left' => HASH_WOW_THEMES_URL . '/includes/thirdparty/framework/assets/images/2cl.png',
                        'right' => HASH_WOW_THEMES_URL . '/includes/thirdparty/framework/assets/images/2cr.png',
                        'full' => HASH_WOW_THEMES_URL . '/includes/thirdparty/framework/assets/images/1col.png',
                    ),
                    'radio' => true,
                    'default' => 'full'
                ),
            ), // end: fields
        ), // end: General Settings
        // -----------------------------
        // begin: Tag Page Settings         -
        // -----------------------------
        array(
            'name' => 'tags_page_settings',
            'title' => 'Tags Page',
            'icon' => 'fa fa-cog',
            // begin: fields
            'fields' => array(
                // begin: color scheme heading
                array(
                    'type' => 'heading',
                    'content' => 'Tags Page Settings',
                ),
                array(
                    'id' => 'tag_page_sidebar',
                    'type' => 'select',
                    'title' => 'Select with Chosen',
                    'options' => hash_wow_themes_get_sidebars()
                ),
                array(
                    'id' => 'tag_page_layout',
                    'type' => 'image_select',
                    'title' => 'Page Layout',
                    'options' => array(
                        'left' => HASH_WOW_THEMES_URL . '/includes/thirdparty/framework/assets/images/2cl.png',
                        'right' => HASH_WOW_THEMES_URL . '/includes/thirdparty/framework/assets/images/2cr.png',
                        'full' => HASH_WOW_THEMES_URL . '/includes/thirdparty/framework/assets/images/1col.png',
                    ),
                    'radio' => true,
                    'default' => 'full'
                ),
            ), // end: fields
        ), // end: General Settings
        // -----------------------------
        // begin: 404 page Settings       -
        // -----------------------------
        array(
            'name' => '404_page_settings',
            'title' => '404 Page Settings',
            'icon' => 'fa fa-exclamation-triangle',
            'fields' => array(
                array(
                    'type' => 'heading',
                    'content' => '404 Page Settings',
                ),
                array(
                    'id' => '404_page_title',
                    'type' => 'text',
                    'title' => 'Page Title',
                    'desc' => 'Enter the Title you want to show on 404 page.',
                    'default' => '404 Page not Found',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => '404_page_text',
                    'type' => 'textarea',
                    'title' => '404 Page Text',
                    'desc' => 'Enter the Text you want to show on 404 page.',
                    'default' => '',
                ),
                array(
                    'id' => '404_page_bg',
                    'type' => 'upload',
                    'title' => 'Header Background  Image',
                    'desc' => 'Upload Image for 404 Page Background.',
                    'attributes' => array(
                        'style' => 'width: 81.9%;'
                    ),
                    'settings' => array(
                        'button_title' => 'Header Image',
                        'frame_title' => 'Choose a image',
                        'insert_title' => 'Use this image',
                    ),
                ),
            ),
        ), // end: other options
    )
);



// ------------------------------
// GENERAL SETTINGS   -
// ------------------------------
$options[] = array(
    'name' => 'sidebar_settings',
    'title' => 'Sidebar Settings',
    'icon' => 'fa fa-bars',
    'fields' => array(
        array(
            'type' => 'heading',
            'content' => 'Add Sidebar'
        ),
        array(
            'id' => 'dynamic_sidebar',
            'type' => 'group',
            'title' => 'Dynamic Sidebar',
            'button_title' => 'Add Dynamic Sidebar',
            'desc' => 'This section is used to add more dynamic sidebars.',
            'accordion_title' => 'Add New Field',
            'fields' => array(
                array(
                    'id' => 'sidebar_name',
                    'type' => 'text',
                    'title' => 'Sidebar Name',
                    'desc' => 'Add Sidebar From Here.',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
            )
        ), // end: group options
    ),
);



$options[] = array(
    'name' => 'social_media',
    'title' => 'Social Media',
    'icon' => 'fa fa-share-square',
    'fields' => array(
        array(
            'type' => 'heading',
            'content' => 'Add Social Media'
        ),
        array(
            'id' => 'social_media',
            'type' => 'group',
            'title' => 'Social Media',
            'button_title' => 'Add Social Media',
            'desc' => 'This section is used to add social media.',
            'accordion_title' => 'Social Media',
            'fields' => array(
                array(
                    'id' => 'hover_color',
                    'type' => 'color_picker',
                    'title' => 'Social media hover colour',
                    'desc' => 'Choose the Custom color for social media hover..',
                    'default' => 'rgba(0, 0, 255, 0.25)',
                ),
                array(
                    'id' => 'social_title',
                    'type' => 'text',
                    'title' => 'Title',
                    'desc' => 'Enter the title of the social media.',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'social_link',
                    'type' => 'text',
                    'title' => 'Link',
                    'desc' => 'Enter the Link for Social Media.',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'social_icon',
                    'type' => 'icon',
                    'title' => 'Icon',
                    'desc' => 'Choose Icon for Social Media.',
                ),
            )
        ), // end: group options
        
        array(
            'id' => 'social_media_widget',
            'type' => 'group',
            'title' => 'Social Media for Widget',
            'button_title' => 'Add Social Media',
            'desc' => 'This section is used to add social media to show in follow us widget.',
            'accordion_title' => 'Widget Social Media',
            'fields' => array(
                array(
                    'id' => 'hover_color',
                    'type' => 'color_picker',
                    'title' => 'Social media BG color',
                    'desc' => 'Choose the Custom color for social media background..',
                    'default' => 'rgba(0, 0, 255, 0.25)',
                ),
                array(
                    'id' => 'social_title',
                    'type' => 'text',
                    'title' => 'Title',
                    'desc' => 'Enter the title of the social media.',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'social_count',
                    'type' => 'number',
                    'title' => esc_html__('Title', 'hash' ),
                    'desc' => esc_html__('Enter the title of the social media.', 'hash' )
                    
                ),
                array(
                    'id' => 'social_link',
                    'type' => 'text',
                    'title' => 'Link',
                    'desc' => 'Enter the Link for Social Media.',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'social_icon',
                    'type' => 'icon',
                    'title' => 'Icon',
                    'desc' => 'Choose Icon for Social Media.',
                ),
            )
        ), // end: group options
    ),
);



$options[] = array(
    'name' => 'font_settings',
    'title' => 'Font Settings',
    'icon' => 'fa fa-font',
    'sections' => array(
        array(
            'name' => 'font_settings',
            'title' => 'Font Settings',
            'icon' => 'fa fa-hand-o-right',
            'fields' => array(
                array(
                    'type' => 'heading',
                    'content' => 'Heading Font',
                ),
                array(
                    'id' => 'dummy_1',
                    'type' => 'notice',
                    'class' => 'info',
                    'content' => 'Done, this text option have something.',
                    'dependency' => array('dep_1', '!=', ''),
                ),
                // ------------------------------------
                // ------------------------------------
                array(
                    'id' => 'use_custom_font',
                    'type' => 'switcher',
                    'title' => 'Use Custom Font',
                    'desc' => 'Use custom font or not.',
                ),
                array(
                    'id' => 'dummy_2',
                    'type' => 'notice',
                    'class' => 'success',
                    'content' => 'You have Selected Custom Fonts!',
                    'dependency' => array('use_custom_font', '==', 'true'),
                ),
            ),
        ), // end: group options
        array(
            'name' => 'body_font_settings',
            'title' => 'Body Font',
            'icon' => 'fa fa-hand-o-right',
            'fields' => array(
                array(
                    'type' => 'heading',
                    'content' => 'Body Font',
                ),
                array(
                    'id' => 'dummy_1',
                    'type' => 'notice',
                    'class' => 'info',
                    'content' => 'Done, this text option have something.',
                    'dependency' => array('dep_1', '!=', ''),
                ),
                // ------------------------------------
                // ------------------------------------
                array(
                    'id' => 'body_custom_font',
                    'type' => 'switcher',
                    'title' => 'Use Custom Font',
                    'desc' => 'Use custom font or not.',
                ),
                array(
                    'id' => 'dummy_2',
                    'type' => 'notice',
                    'class' => 'success',
                    'content' => 'You have Selected Custom Body Fonts!',
                    'dependency' => array('body_custom_font', '==', 'true'),
                ),
            ),
        ), // end: group options
    ),
);



$options[] = array(
    'name' => 'brand_or_client',
    'title' => 'Clients',
    'icon' => 'fa fa-star',
    'fields' => array(
        array(
            'type' => 'heading',
            'content' => 'Add Clients'
        ),
        array(
            'id' => 'brand_or_client',
            'type' => 'group',
            'title' => 'Clients',
            'button_title' => 'Add More Clients',
            'desc' => 'Add as many clients as you want.',
            'accordion_title' => 'Clients',
            'fields' => array(
                array(
                    'id' => 'title',
                    'type' => 'text',
                    'title' => 'Name',
                    'desc' => 'Enter company name.',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'text',
                    'type' => 'textarea',
                    'title' => 'Client Description',
                    'desc' => 'Enter Client Description.',
                    'default' => '',
                ),
                array(
                    'id' => 'link',
                    'type' => 'text',
                    'title' => 'Link',
                    'desc' => 'Enter company website link.',
                    'attributes' => array(
                        'style' => 'width: 100%; height: 40px;'
                    ),
                ),
                array(
                    'id' => 'img',
                    'type' => 'upload',
                    'title' => 'Company Image',
                    'desc' => 'choose the client logo.',
                    'attributes' => array(
                        'style' => 'width: 71.9%;'
                    ),
                    'settings' => array(
                        'button_title' => 'Upload Image',
                        'frame_title' => 'Choose a image',
                        'insert_title' => 'Use this image',
                    ),
                ),
            )
        ), // end: group options
    ),
);



$options[] = array(
    'name' => 'gallery_widget',
    'title' => 'Gallery Widget',
    'icon' => 'fa fa-gallery',
    'fields' => array(
        array(
            'type' => 'heading',
            'content' => 'Gallery Widget Settings'
        ),
        array(
          'id'          => 'gallery_widget_images',
          'type'        => 'gallery',
          'title'       => esc_html__('Choose Images', 'hash' ),
          'add_title'   => esc_html__('Add Images', 'hash' ),
          'edit_title'  => esc_html__('Edit Images', 'hash' ),
          'clear_title' => esc_html__('Remove Images', 'hash' )
        ),
        
    ),
);



// ------------------------------
// backup                       -
// ------------------------------
$options[] = array(
    'name' => 'backup_section',
    'title' => 'Backup',
    'icon' => 'fa fa-shield',
    'fields' => array(
        array(
            'type' => 'notice',
            'class' => 'warning',
            'content' => 'You can save your current options. Download a Backup and Import.',
        ),
        array(
            'type' => 'backup',
        ),
    )
);

CSFramework::instance($settings, $options);
