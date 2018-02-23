<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options      = array();


// -----------------------------------------
// Post Metabox Options                    -
// -----------------------------------------
$options[]    = array(
  'id'        => '_sh_single_post_options',
  'title'     => esc_html__('Extra Post Options', 'hash'),
  'post_type' => 'post',
  'context'   => 'normal',
  'priority'  => 'default',
  'sections'  => array(

    array(
      'name'   => 'header_settings',
      'fields' => array(

        array(
          'id'        => 'layout',
          'type'      => 'image_select',
          'title'     => esc_html__('Post Layout', 'hash' ),
          'options'   => array(
            'left' => get_template_directory_uri().'/images/2cl.png',
            'full' => get_template_directory_uri().'/images/1col.png',
            'right' => get_template_directory_uri().'/images/2cr.png',
            
          ),
          'radio'        => true,
          'default'     => 'full'
        ),
        array(
          'id'           => 'post_sidebar',
          'type'         => 'select',
          'options'        => array(
            'primary'      => 'Primary Option',
            'secondary'    => 'Secondry Option',
            'tertiary'     => 'Tertiary Option',
          ),
          'title'      => esc_html__('Choose Sidebar', 'hash' ),
          'dependency'   => array( 'layout', '!=', 'full' ),
        ),
        array(
          'id'          => 'gallery_2',
          'type'        => 'gallery',
          'title'       => esc_html__('Gallery post format', 'hash' ),
          'add_title'   => esc_html__('Choose Images', 'hash' ),
          'edit_title'  => esc_html__('Edit Images', 'hash' ),
          'clear_title' => esc_html__('Remove Images', 'hash' ),
          'help'    => esc_html__('Choose image from media uploader only if the post format is Gallery', 'hash' )
        ),
        array(
          'id'       => 'video',
          'type'     => 'wysiwyg',
          'title'    =>  esc_html__('Video URL', 'hash' ),
          'help'    => esc_html__('Fill only if post format is video', 'hash' ),
          'desc'            => 'e.g https://www.youtube.com/embed/6v2L2UGZJAM',
          'settings' => array(
            'textarea_rows' => 5,
            'tinymce'       => false,
            'media_buttons' => false,
          )
        ),
        array(
          'id'       => 'audio_embed',
          'type'     => 'wysiwyg',
          'title'    =>  esc_html__('Audio Embed Code', 'hash' ),
          'help'    => esc_html__('Fill only if post format is audio', 'hash' ),
          'settings' => array(
            'textarea_rows' => 5,
            'tinymce'       => false,
            'media_buttons' => false,
          )
        ),

        array(
          'id'    => 'quote',
          'type'  => 'wysiwyg',
          'title' => esc_html__('Quote post format', 'hash' ),
          'help'    => esc_html__('Fill only if post format is quote', 'hash' )
        ),

      ),
    ),

  ),
);
// -----------------------------------------
// Team Metabox Options                    -
// -----------------------------------------
$options[]    = array(
  'id'        => '_sh_team_post_options',
  'title'     => esc_html__('Team Post Options', 'hash'),
  'post_type' => 'sh_team',
  'context'   => 'normal',
  'priority'  => 'default',
  'sections'  => array(

    array(
      'name'   => 'team_settings',
      'fields' => array(
          
          array(
          'id'    => 'desig',
          'type'  => 'text',
          'title' => 'Designation',
          ),
          array(
			  'id'              => 'social_media',
			  'type'            => 'group',
			  'title'           => 'Social Media',
			  'desc'            => 'This section is used to add Social Media.',
			  'button_title'    => 'Add More Social Media',
			  'accordion_title' => 'Social Media',
			  'fields'          => array(
			  
			  	/*array(
				  'id'      => 'hover_color',
				  'type'    => 'color_picker',
				  'title'   => 'Social media hover colour',
				  'desc'    => 'Choose the Custom color for social media hover.',
				  'default' => '#f4c212',
				),

				array(
				  'id'          => 'social_title',
				  'type'        => 'text',
				  'title'       => 'Title',
				  'description' => 'Enter the title of the social media.',
				),*/
				array(
				  'id'          => 'social_link',
				  'type'        => 'text',
				  'title'       => 'Link',
				  'description' => 'Enter the Link for Social Media.',
				  'default' => '#',
				),
				array(
				  'id'      => 'social_icon',
				  'type'    => 'icon',
				  'title'   => 'Icon',
				  'desc'    => 'Choose Icon for Social Media.',
				),

          )
        ),

      ),
    ),

  ),
);

CSFramework_Metabox::instance( $options );
