<?php 

add_action( 'caribion_top_bar', 'caribion_top_bar' );
add_action( 'caribion_header_info', 'caribion_header_info' );

function caribion_top_bar()
{
	get_template_part('includes/modules/templates/topbar');
}

function caribion_header_info()
{
	get_template_part('includes/modules/templates/header_info');
}
function post_format_type($format)
{
	//print_r($format); 
	if($format=='video') { echo '<i class="fa fa-play"></i>';}  
	elseif ($format=='quote') { echo '<i class="fa fa-quote-lef"></i>';}
	elseif ($format=='audio') { echo '<i class="fa fa-music"></i>';}
	elseif ($format=='gallery') { echo '<i class="fa fa-image"></i>';}
	elseif ($format=='image') { echo '<i class="fa fa-camera"></i>';}
	else
	 { echo '<i class="fa fa-camera"></i>';}	
}

function hash_wow_themes_main_menu_output()
{
    ob_start();
    
    wp_nav_menu(array('theme_location' => 'main_menu', 'container_id' => 'navbar-collapse-1',
        'container_class' => 'navbar-collapse collapse',
        'menu_class' => 'nav navbar-nav navbar-right',
        'fallback_cb' => false,
        'items_wrap' => '%3$s',
        'container' => false,
        'walker' => new Hash_Bootstrap_walker()
    ));
    
    
    return ob_get_clean();
}


function hash_get_format_frame($meta, $uniqid)
{
	$format = get_post_format();

	ob_start();
	post_format_type($format);

	$icon = ob_get_clean();

	$output = '';

	$anchor = '';

	switch ($format) {
		case 'video':
			
			$video = hash_wow_sh_set( $meta, 'video' );

			if( $video ){
				$output = '<iframe id="feather'.esc_attr($uniqid).'" class="feather" src="'. esc_url($video) .'"  allowfullscreen></iframe>';

				$anchor = '<a data-featherlight="#feather'.esc_attr($uniqid).'" href="#">'.$icon.'</a>';
			}

			break;
		
		case 'audio':
			$audio = hash_wow_sh_set( $meta, 'audio_embed' );

			if( $audio ){
				$output = '<iframe id="feather'.esc_attr($uniqid).'" class="feather" src="'. esc_url($audio) .'"  allowfullscreen></iframe>';

				$anchor = '<a data-featherlight="#feather'.esc_attr($uniqid).'" href="#">'.$icon.'</a>';
			}

			break;
		
		default:
			
				$image_url = wp_get_attachment_url(get_post_thumbnail_id());
				$anchor = '<a data-featherlight="image" href="'.esc_url($image_url).'">'.$icon.'</a>';
			break;
	}

	$anchor = '<div class="br_cam br_vid_big play_btn">'.$anchor.'</div>';

	$output = ( $output ) ? '<div class="featherlight">'.$output.'</div>' : $output;

	return $output.$anchor;
}