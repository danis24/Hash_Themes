<?php

/** Include the TGM_Plugin_Activation class. */
require_once dirname(__FILE__) . '/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'my_theme_register_required_plugins');

function my_theme_register_required_plugins() {

    $plugins = array(
        array(
            'name' => 'Contact form 7',
            'slug' => 'contact-form-7',
            'required' => true,
        ),
        array(
            'name' => 'Theme Support',
            'slug' => 'theme_support_hash',
            'source' => get_template_directory() . '/includes/thirdparty/tgm-plugin-activation/plugins/theme_support_hash.zip',
            'required' => true,
            'version' => '1.0.3',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => get_template_directory_uri() . '/includes/thirdparty/tgm-plugin-activation/plugins/theme_support_hash.zip',
            'file_path' => ABSPATH . 'wp-content/plugins/theme_support_hash/theme_support.php'
        ),
        array(
            'name' => 'WPBakery Visual Composer',
            'slug' => 'js_composer',
            'source' => HASH_WOW_THEMES_ROOT . '/includes/thirdparty/tgm-plugin-activation/plugins/js_composer.zip',
            'required' => true,
            'version' => '4.12',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => HASH_WOW_THEMES_URL . '/includes/thirdparty/tgm-plugin-activation/plugins/js_composer.zip',
            'file_path' => ABSPATH . 'wp-content/plugins/js_composer/js_composer.php'
        ),
        
        array(
            'name'                  => 'Envato Market Plugin',
            'slug'                  => 'envato-market',
            'source'                => 'http://envato.github.io/wp-envato-market/dist/envato-market.zip',
            'required'              => true
        ),
        array(
            'name'                  => 'Mailchimp for WP',
            'slug'                  => 'mailchimp-for-wp',
            'required'              => true
        ),
    );

    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'hash';

    $config = array(
        'domain' => $theme_text_domain, // Text domain - likely want to be the same as your theme.
        'default_path' => '', // Default absolute path to pre-packaged plugins
        //'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
        //'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
        'menu' => 'install-required-plugins', // Menu slug
        'has_notices' => true, // Show admin notices or not
        'is_automatic' => true, // Automatically activate plugins after installation or not
        'message' => '', // Message to output right before the plugins table
        
    );

    tgmpa($plugins, $config);
}
