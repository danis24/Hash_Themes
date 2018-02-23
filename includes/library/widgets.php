<?php 
class hash_wow_themes_About_Us extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'hash_wow_themes_About_Us', /* Name */esc_html__('Hash About us ','hash'), array(      'description' => esc_html__('About us widget ', 'hash' )) );
	}
	
	/** @see WP_Widget::widget */
    
	 function widget($args, $instance)
	 {
	    extract( $args );
		echo balanceTags($before_widget);
		 /*?>$title = apply_filters( 'widget_title', $instance['title'] );<?php */
		?>

		<div class="footer_top_left">
			<?php
				 $img_url =  esc_url($instance['logo_url']);
				 $img2_size = @getimagesize(esc_url($img_url)); 
			?>
			<img src="<?php echo esc_url($instance['logo_url']);?>" alt="Footer Logo" />
			<p><?php echo balanceTags($instance['box_text']);?></p>
		</div>
		<?php echo balanceTags($after_widget);
				
		 
	}
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['logo_url'] = $new_instance['logo_url'];
		$instance['box_text'] = $new_instance['box_text'];
		return $instance;
	}
	
	 function form($instance)
	{	
		$logo_url = ( $instance ) ? esc_attr($instance['logo_url']) : '';
		$box_text = ( $instance ) ? esc_attr($instance['box_text']) : '';
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('logo_url')); ?>">
				<?php esc_html_e('Icon Url: ', 'hash'); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('logo_url')); ?>" name="<?php echo esc_attr($this->get_field_name('logo_url')); ?>" type="text" value="<?php echo esc_attr($logo_url); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('box_text')); ?>">
				<?php esc_html_e('Enter the text:', 'hash'); ?>
			</label>
			<textarea id="<?php echo esc_attr($this->get_field_id('box_text')); ?>" class='widefat' name='<?php echo esc_attr($this->get_field_name('box_text')); ?>' rows="5" cols="5">
						<?php echo esc_textarea($box_text); ?>
					</textarea>
		</p>
		<?php 
	}
} 

// contact us
class hash_wow_themes_ContactUs extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'hash_wow_themes_ContactUs', /* Name */esc_html__('Hash Contact us','hash'), array( 'description' => esc_html__('Contact us', 'hash' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		echo balanceTags($before_widget);?>

		<div class="ft_contact">
			<h4><?php echo balanceTags($instance['title']);?></h4>
			<address>
			<p> <i class="fa fa-map-marker"></i><?php echo balanceTags($instance['address']);?></p>
			<a href="tel:javascript:void(0);"><i class="fa fa-phone"></i>
			<?php esc_html_e( 'Telephone :', 'hash' ); ?>
			<?php echo balanceTags($instance['phone']);?></a><br>
			<a href="mail-to:<?php echo balanceTags($instance['email']);?>"><i class="fa fa-envelope"></i>
			<?php esc_html_e( 'E-mail :', 'hash' ); ?>
			<?php echo balanceTags($instance['email']);?></a>
			</address>
		</div>
		
		<?php
		echo balanceTags($after_widget);
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['address'] = $new_instance['address'];
		$instance['phone'] = $new_instance['phone'];
		$instance['email'] = $new_instance['email'];

		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : esc_html__('Contact', 'hash');
		$address = ( $instance ) ? esc_attr($instance['address']) : '';
		$phone = ( $instance ) ? esc_attr($instance['phone']) : '';
		$email = ( $instance ) ? esc_attr($instance['email']) : '';
		
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
				<?php esc_html_e('Title:', 'hash'); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('address')); ?>">
				<?php esc_html_e('Address:', 'hash'); ?>
			</label>
			<textarea id="<?php echo esc_attr($this->get_field_id('address')); ?>" class='widefat' name='<?php echo esc_attr($this->get_field_name('address')); ?>' rows="5" cols="5">
						<?php echo esc_textarea($address); ?>
					</textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('phone')); ?>">
				<?php esc_html_e('Phone: ', 'hash'); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr($phone); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('email')); ?>">
				<?php esc_html_e('Email: ', 'hash'); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
		</p>
		<?php 
	}
}


class hash_wow_themes_SocialMedia extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'hash_wow_themes_SocialMedia', /* Name */esc_html__('HAsh Social Media ','hash'), array(      'description' => esc_html__('Social Media', 'hash' )) );
	}
	
	/** @see WP_Widget::widget */
    
	 function widget($args, $instance)
	 {
	    extract( $args );
		echo balanceTags($before_widget);
		//$title = apply_filters( 'widget_title', $instance['title'] );
		?>
		<?php //echo balanceTags($before_title.$title.$after_title);
					 $options = HASH_WSH()->option();
					 $option_media =  hash_wow_sh_set( $options, 'social_media' );
					 ?>
		<?php if( hash_wow_sh_set($instance, 'showSocial') ):
						  		if($option_media):
						   ?>
		<div class="ft_connected">
			<h4><?php echo balanceTags($instance['title']);?></h4>
			<p><?php echo balanceTags($instance['box_text']);?></p>
			<ul>
				<?php foreach( $option_media as $social ):   ?>
				<li><a title="<?php echo hash_wow_sh_set($social, 'social_title');?>" class="fa <?php echo hash_wow_sh_set($social, 'social_icon');?>" href="<?php echo esc_url( hash_wow_sh_set( $social, 'social_link' ) ); ?>"></a></li>
				<?php endforeach;  ?>
			</ul>
		</div>
		<?php endif; endif;  ?>
		<?php echo balanceTags($after_widget); 
	
	}
	

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['box_text'] = $new_instance['box_text'];
		$instance['showSocial'] = $new_instance['showSocial'];
		
		return $instance;
	}
	
	 function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Stay connected', 'hash');
		$box_text = ( $instance ) ? esc_attr($instance['box_text']) :  esc_html__('Follow us on social media and be up to date with the latest happenings.', 'hash');
		$showSocial = ( $instance ) ? esc_attr($instance['showSocial']) : '';?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
				<?php esc_html_e('Title: ', 'hash'); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('box_text')); ?>">
				<?php esc_html_e('Enter the text:', 'hash'); ?>
			</label>
			<textarea id="<?php echo esc_attr($this->get_field_id('box_text')); ?>" class='widefat' name='<?php echo esc_attr($this->get_field_name('box_text')); ?>' rows="5" cols="5">
						<?php echo esc_textarea($box_text); ?>
					</textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('showSocial')); ?>">
				<?php esc_html_e('Show Social icons', 'hash'); ?>
			</label>
			<input class="widefat" <?php checked($instance['showSocial'], 'true');?> id="<?php echo esc_attr( $this->get_field_id('showSocial') ); ?>" name="<?php echo esc_attr( $this->get_field_name('showSocial') ); ?>" type="checkbox" value="true" />
		</p>
		<?php 
	}
} 


class hash_wow_themes_Recent_Posts extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'hash_wow_themes_Recent_Posts', /* Name */esc_html__('Hash Recent Posts ','hash'), array( 'description' => esc_html__('New items with images', 'hash' )) );
	}
	
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo balanceTags($before_widget);
		echo balanceTags($before_title.$title.$after_title);
		
		$query_string = 'posts_per_page='.$instance['number'].'&post_type=post';
		if( $instance['cat'] ) $query_string .= '&cat='.$instance['cat'];
		$query = new WP_Query( $query_string ); 
	
		$this->posts($query);
		wp_reset_postdata();
		
		echo balanceTags($after_widget);
	}
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Recent Posts', 'hash');
		$number = ( $instance ) ? esc_attr($instance['number']) : 3;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';	
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
				<?php esc_html_e('Title: ', 'hash'); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('number')); ?>">
				<?php esc_html_e('No. of Posts:', 'hash'); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('cat')); ?>">
				<?php esc_html_e('Category', 'hash'); ?>
			</label>
			<?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'hash'), 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
		</p>
		<?php 
	}
	
	function posts($query)
	{
		if( $query->have_posts() ):?>
		
		<?php $count = 0; ?>
		<div class="footer_top_middle">
			<div class="ftm_realted_post">
				<?php while( $query->have_posts() ): $query->the_post(); ?>
				<div class="single_related_post">
					<div class="srp_img"> <a href="<?php the_permalink();?>">
						<?php the_post_thumbnail('hash_wow_themes_80x80');?>
						</a> </div>
					<div class="rel_post_text"> <span><?php echo get_the_date('M d, Y');?></span>
						<p>
							<a href="<?php the_permalink(); ?>"> <?php the_title();?></a>
						</p>
					</div>
				</div>
				<?php endwhile;?>
			</div>

		</div>
		<?php endif;
    
    }
}

/*Hash Latest Review*/
class hash_wow_themes_Latest_Review extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'hash_wow_themes_Latest_Review', /* Name */esc_html__('Hash Latest Review','hash'), array( 'description' => esc_html__('Blog Latest Reviews', 'hash' )) );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		//$title = apply_filters( 'widget_title', $instance['title'] );
		echo balanceTags($before_widget);
		//echo balanceTags($before_title.$title.$after_title);
		
		$query_string = 'posts_per_page='.$instance['number'].'&post_type=post';
		if( $instance['cat'] ) $query_string .= '&cat='.$instance['cat'];
		$query = new WP_Query( $query_string ); ?>
		
		
	        <div class="cc_home_two_middle">
		        <h2><?php echo esc_attr( $instance['title'] ); ?></h2>
	
		<?php	$this->posts($query);
		wp_reset_postdata();?>

        	    <div class="cc_middle_h_two_add">
        			<img src="<?php echo esc_url($instance['image']);?>" alt="" />
        		</div>
        		<div class="cc_middle_h_two_blank"></div>
		    </div>
        
		<?php		echo balanceTags($after_widget);
	}
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		$instance['image'] = $new_instance['image'];
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Latest Review', 'hash');
		$number = ( $instance ) ? esc_attr($instance['number']) : 3;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';
		$image = ( $instance ) ? esc_attr($instance['image']) : '';
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
				<?php esc_html_e('Title: ', 'hash'); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('number')); ?>">
				<?php esc_html_e('No. of Posts:', 'hash'); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('cat')); ?>">
				<?php esc_html_e('Category', 'hash'); ?>
			</label>
			<?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'hash'), 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('image')); ?>">
				<?php esc_html_e('Add URL: ', 'hash'); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('image')); ?>" type="text" value="<?php echo esc_attr($image); ?>" />
		</p>
		<?php 
	}
	
	function posts($query)
	{
		
		if( $query->have_posts() ):?>
		<?php $count = 0; ?>

				<?php while( $query->have_posts() ): $query->the_post(); ?>
				<div class="single_h_two_middle_item">
					<div class="single_home_two_middle">
						<div class="cc_im_box"><?php the_post_thumbnail('hash_wow_themes_162x104');?></div>
						<div class="br_cam midd_br">
							<a class="<?php the_permalink();?>" href="">8.4</a>
						</div>
					</div>
					<?php echo hash_wow_themes_trim(get_the_excerpt(), 10); ?>
				</div>
				<?php endwhile;?>
				
			
		<?php endif;
    }
}


class hash_wow_themes_NewsLetter extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'hash_wow_themes_NewsLetter', /* Name */__('Hash News Letter','hash'), array( 'description' => esc_html__('News Letter', 'hash' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		//$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget);
		?>
		
		<div class="ftm_newsletter">
			
			<h4>
			    <?php echo esc_attr( $instance['title'] ); ?>
			</h4>
			<p>
				<?php echo esc_attr( $instance['text'] ); ?>
			</p>
			
			<?php $form_id = $instance['ID'];
			if( $form_id ) echo do_shortcode('[mc4wp_form id="'.$form_id.'"]'); 
			else _e('<p>Choose the mailchimp form from Widgets to see it functional</p>', 'hash');?>
		
		 </div>
		
		<?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = $new_instance['text'];
		$instance['ID'] = $new_instance['ID'];

		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : esc_html__('Newsletter', 'hash');
		$text = ( $instance ) ? esc_attr($instance['text']) : 'Sign up to hear and get our daily new update via email.';
		$ID = ($instance) ? esc_attr($instance['ID']) : 'wow_themes';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'hash'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php esc_html_e('Text:', 'hash'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo wp_kses_post($text); ?></textarea>
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('ID')); ?>"><?php esc_html_e('Choose Mailchimp Form:', 'hash'); ?></label>
            <?php $forms = get_posts(array('post_type'=>'mc4wp-form', 'posts_per_page'=>-1));
            if( !is_wp_error($forms) ): ?>
			
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('ID')); ?>" name="<?php echo esc_attr($this->get_field_name('ID')); ?>">
					<?php foreach( $forms as $form ): ?>
						<option value="<?php echo esc_attr($form->ID); ?>" <?php selected($ID, $form->ID); ?>><?php echo esc_attr($form->post_title); ?></option>
					<?php endforeach; ?>

				</select>
            
            <?php endif; ?>

        </p>
              
		<?php 
	}
}


class hash_wow_themes_YoutubeVideos extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'hash_wow_themes_YoutubeVideos', /* Name */esc_html__('Hash Youtube Video','hash'), array( 'description' => esc_html__('Fetch the Youtube Video', 'hash' )) );
	}
	
		 function widget($args, $instance)
	 {
	    extract( $args );
		echo balanceTags($before_widget);
		 /*?>$title = apply_filters( 'widget_title', $instance['title'] );<?php */
?>
	<div class="ftr_video">
		<h4><?php echo balanceTags($instance['title']);?></h4>
		<div class="results_video embed-responsive embed-responsive-16by9">
			<iframe class="embed-responsive-item" width="560" height="350" src="<?php echo esc_url($instance['video_url']);?>" allowfullscreen></iframe>
		</div>
	</div>
	
<?php echo balanceTags($after_widget);	
		 
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['video_url'] = $new_instance['video_url'];
		return $instance;
	}
	
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('video of the day', 'hash');
		$video_url = ( $instance ) ? esc_attr($instance['video_url']) : '';
		
?>
<p>
	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
		<?php esc_html_e('Title: ', 'hash'); ?>
	</label>
	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>
	<label for="<?php echo esc_attr($this->get_field_id('video_url')); ?>">
		<?php esc_html_e('Video Url: ', 'hash'); ?>
	</label>
	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('video_url')); ?>" name="<?php echo esc_attr($this->get_field_name('video_url')); ?>" type="text" value="<?php echo esc_attr($video_url); ?>" />
</p>
<?php 
	}
}


class hash_wow_themes_PurchaseAdd extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'hash_wow_themes_PurchaseAdd', /* Name */esc_html__('Hash Purchase Banner','hash'), array( 'description' => esc_html__('Purchase Banner', 'hash' )) );
	}
	
		 function widget($args, $instance)
	 {
	    extract( $args );
		echo balanceTags($before_widget);
		 /*?>$title = apply_filters( 'widget_title', $instance['title'] );<?php */
?>

	 <div class="purchase_sidebar">
	<div class="purchase_sidebar_img"> <img src="<?php echo esc_url($instance['img_url']);?>" alt="" />
	  <div class="purchase_overlay"></div>
	  <div class="purchase_sidebar_text">
		<h2><?php echo balanceTags($instance['title']);?></h2>
		<p><?php echo balanceTags($instance['description']);?></p>
		<div class="purchase_s"> <a href="<?php echo balanceTags($instance['add_url']);?>"><?php esc_html_e('Purchase ', 'hash'); ?></a> </div>
	  </div>
	</div>
  </div>
	
<?php echo balanceTags($after_widget);	
		 
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['img_url'] = $new_instance['img_url'];
		$instance['title'] = $new_instance['title'];
		$instance['description'] = $new_instance['description'];
		$instance['add_url'] = $new_instance['add_url'];
		return $instance;
	}
	
	function form($instance)
	{
		$img_url = ( $instance ) ? esc_attr($instance['img_url']) : '';
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('HASH', 'hash');
		$description = ( $instance ) ? esc_attr($instance['description']) : '';
		$add_url = ( $instance ) ? esc_attr($instance['add_url']) : '';
		
?>
<p>
	<label for="<?php echo esc_attr($this->get_field_id('logo_url')); ?>">
		<?php esc_html_e('Icon Url: ', 'hash'); ?>
	</label>
	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('img_url')); ?>" name="<?php echo esc_attr($this->get_field_name('img_url')); ?>" type="text" value="<?php echo esc_attr($img_url); ?>" />
</p>
<p>
	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
		<?php esc_html_e('Title: ', 'hash'); ?>
	</label>
	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>
	<label for="<?php echo esc_attr($this->get_field_id('description')); ?>">
		<?php esc_html_e('Description:', 'hash'); ?>
	</label>
	<textarea id="<?php echo esc_attr($this->get_field_id('description')); ?>" class='widefat' name='<?php echo esc_attr($this->get_field_name('description')); ?>' rows="5" cols="5">
				<?php echo esc_textarea($description); ?>
			</textarea>
</p>
<p>
	<label for="<?php echo esc_attr($this->get_field_id('add_url')); ?>">
		<?php esc_html_e('Add Url: ', 'hash'); ?>
	</label>
	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('add_url')); ?>" name="<?php echo esc_attr($this->get_field_name('add_url')); ?>" type="text" value="<?php echo esc_attr($add_url); ?>" />
</p>
<?php 
	}
}

class hash_wow_themes_Blog_Posts extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'hash_wow_themes_Blog_Posts', /* Name */esc_html__('Hash Recent Blog Posts ','hash'), array( 'description' => esc_html__('Recent Blog Posts', 'hash' )) );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo balanceTags($before_widget);
		echo balanceTags($before_title.$title.$after_title);
		
		$query_string = 'posts_per_page='.$instance['number'].'&post_type=post';
		if( $instance['cat'] ) $query_string .= '&cat='.$instance['cat'];
		$query = new WP_Query( $query_string ); 
	
		$this->posts($query);
		wp_reset_postdata();
		
		echo balanceTags($after_widget);
	}
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Latest Post', 'hash');
		$number = ( $instance ) ? esc_attr($instance['number']) : 3;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';	
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
				<?php esc_html_e('Title: ', 'hash'); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('number')); ?>">
				<?php esc_html_e('No. of Posts:', 'hash'); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('cat')); ?>">
				<?php esc_html_e('Category', 'hash'); ?>
			</label>
			<?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'hash'), 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
		</p>
		<?php 
	}
	
	function posts($query)
	{
		if( $query->have_posts() ):?>
		<?php $count = 0; ?>
		 <div class="all_news_right">
				<?php while( $query->have_posts() ): $query->the_post(); ?>
				<div class="fs_news_right">
					<div class="single_fs_news_img">
						<?php the_post_thumbnail('hash_wow_themes_80x80');?>
					</div>
					<div class="single_fs_news_right_text">
						 <h4>
						 	<a href="<?php the_permalink();?>"><?php the_title();?></a>
						</h4>
						 <p>
						<?php
							$parentscategory ="";
							foreach((get_the_category()) as $category) {
							if ($category->category_parent == 0) {
							$parentscategory .= ' <a href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
								}
							}
							echo substr($parentscategory,0,-2); 
						?>
					 <i class="pipe">|</i><i class="fa fa-clock-o"></i> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </p>
					</div>
		        </div>
				<?php endwhile;?>
		</div>
		<?php endif;
    }
}

class hash_wow_themes_Follow_Us extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'hash_wow_themes_Follow_Us', /* Name */esc_html__('Hash Follow Us ','hash'), array( 'description' => esc_html__('Follow us widget with follower stat from Theme Options', 'hash' )) );
	}
	
	
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo balanceTags($before_widget);
		echo wp_kses_post($before_title.$title.$after_title);
		
		$options = HASH_WSH()->option();
		
	    $data = hash_wow_themes_set( $options, 'social_media_widget' ); ?>
	    
	    <div class="all_single_follow">
		    <?php $this->social($data); ?>
		</div>
		
		<?php echo balanceTags($after_widget);
	}
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['number'] = $new_instance['number'];
		
		return $instance;
	}
	
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Latest Post', 'hash');
		$number = ( $instance ) ? esc_attr($instance['number']) : 3;?>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
        		<?php esc_html_e('Title: ', 'hash'); ?>
        	</label>
        	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('number')); ?>">
        		<?php esc_html_e('No. of Posts:', 'hash'); ?>
        	</label>
        	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
        </p>
        
        <?php 
	}
	
	function social( $data = array() )
	{
	 
	    if( !$data || !is_array($data) ) return;
	    
		foreach( $data as $dat ):
		
		    $link = hash_wow_themes_set( $dat, 'social_link', '#' );
		    $color = hash_wow_themes_set( $dat, 'hover_color' );
		    $title = hash_wow_themes_set( $dat, 'social_title', 'Fans' );
		    $count = hash_wow_themes_set( $dat, 'social_count', '0' );
		    $icon = hash_wow_themes_set( $dat, 'social_icon', 'fa fa-facebook' );?>
		    
            <div class="single_follow_us" style="background-color: <?php echo esc_attr($color); ?>"> 
                <a href="<?php echo esc_url( $link ); ?>"> 
                    <i class="<?php echo esc_attr($icon); ?>"></i><br>
                    <?php echo esc_attr($count); ?><br>
                    <?php echo esc_attr( $title ); ?> 
                </a> 
            </div>
        <?php endforeach;
    }
}

class hash_wow_themes_Image_Slider extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'hash_wow_themes_Image_Slider', /* Name */esc_html__('Hash Image Slider ','hash'), array( 'description' => esc_html__('Show image slider / carousel', 'hash' )) );
	
	    add_action( 'sidebar_admin_setup', array( $this, 'admin_setup' ) );
	}
	
	
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo balanceTags($before_widget);
		echo wp_kses_post($before_title.$title.$after_title);
		
		$options = HASH_WSH()->option();
		
	    $data = hash_wow_themes_set( $options, 'gallery_widget_images' ); //print_r($options);exit;?>
	    
	    <div class="all_single_follow">
		    <?php $this->slider($data); ?>
		</div>
		
		<?php echo balanceTags($after_widget);
	}
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['number'] = $new_instance['number'];
		
		return $instance;
	}
	
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Latest Post', 'hash');
		$number = ( $instance ) ? esc_attr($instance['number']) : 3;?>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
        		<?php esc_html_e('Title: ', 'hash'); ?>
        	</label>
        	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('number')); ?>">
        		<?php esc_html_e('No. of Posts:', 'hash'); ?>
        	</label>
        	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
        </p>
        
        <?php 
	}
	
	function slider($data)
	{
	    $explode = explode(',', $data);
	    if( !array_filter( $explode ) ) return;
	    ?>
	    
	    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
            
            <!-- Indicators -->
            <ol class="carousel-indicators">
            
                <?php foreach( $explode as $i => $exp ):
                    $active = ( $i == 0 ) ? 'active' : 'inactive'; ?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo esc_attr($i); ?>" class="<?php echo esc_attr( $active ); ?>"></li>
                <?php endforeach; ?>
            </ol>
        
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
            
                <?php foreach( $explode as $i => $exp ):
                    $active = ( $i == 0 ) ? ' active' : ''; ?>
                    
                    <div class="item<?php echo esc_attr( $active ); ?>">
                        <div class="br_single_news"> 
                            <?php echo wp_get_attachment_image( $exp, 'full' ); ?>
                            <div class="br_cam"> 
                                <a class="fa fa-camera" href=""></a> 
                            </div>
                        </div>
                    </div>
                
                <?php endforeach; ?>
                
            </div>
        </div>
          
         <?php
	}
	
	function admin_setup() {
		wp_enqueue_media();
		wp_enqueue_script( 'hash-image-widget', get_template_directory_uri().'/js/widget-img.js', array( 'jquery', 'media-upload', 'media-views' ) );

		wp_localize_script( 'hash-image-widget', 'HashImageWidget', array(
			'frame_title' => esc_html__( 'Select an Image', 'hash' ),
			'button_title' => esc_html__( 'Insert Into Widget', 'hash' ),
		) );
	}
}
