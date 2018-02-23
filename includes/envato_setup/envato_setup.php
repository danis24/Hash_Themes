<?php
/**
 * Envato Theme Setup Wizard Class
 *
 * Takes new users through some basic steps to setup their ThemeForest theme.
 *
 * @author      dtbaker
 * @author      vburlak
 * @package     envato_wizard
 * @version     1.1.4
 *
 * Based off the WooThemes installer.
 *
 */

require_once dirname(__FILE__).'/classes/Data.php';


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Envato_Theme_Setup_Wizard' ) ) {
	/**
	 * Envato_Theme_Setup_Wizard class
	 */
	class Envato_Theme_Setup_Wizard extends _Wow_Themes_Envato_Data {

		/**
		 * The class version number.
		 *
		 * @since 1.1.1
		 * @access private
		 *
		 * @var string
		 */
		protected $version = '1.1.4';

		/** @var string Current theme name, used as namespace in actions. */
		public $theme_name = 'ecom';

		/** @var string Theme author username, used in check for oauth. */
		protected $envato_username = 'wow_themes';

		/** @var string Full url to server-script.php (available from https://gist.github.com/dtbaker ) */
		protected $oauth_script = '';

		/** @var string Current Step */
		protected $step   = '';

		/** @var array Steps for the setup wizard */
		protected $steps  = array();

		/**
		 * Relative plugin path
		 *
		 * @since 1.1.2
		 *
		 * @var string
		 */
		protected $plugin_path = '';

		/**
		 * Relative plugin url for this plugin folder, used when enquing scripts
		 *
		 * @since 1.1.2
		 *
		 * @var string
		 */
		protected $plugin_url = '';

		/**
		 * The slug name to refer to this menu
		 *
		 * @since 1.1.1
		 *
		 * @var string
		 */
		protected $page_slug;

		
		/**
		 * The slug name for the parent menu
		 *
		 * @since 1.1.2
		 *
		 * @var string
		 */
		protected $page_parent;

		/**
		 * Complete URL to Setup Wizard
		 *
		 * @since 1.1.2
		 *
		 * @var string
		 */
		protected $page_url;


		/**
		 * Holds the current instance of the theme manager
		 *
		 * @since 1.1.3
		 * @var Envato_Theme_Setup_Wizard
		 */
		public static $instance = null;

		/**
		 * @since 1.1.3
		 *
		 * @return Envato_Theme_Setup_Wizard
		 */
		public static function get_instance() {
			if ( ! self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * A dummy constructor to prevent this class from being loaded more than once.
		 *
		 * @see Envato_Theme_Setup_Wizard::instance()
		 *
		 * @since 1.1.1
		 * @access private
		 */
		public function __construct() {
			$this->init_globals();
			$this->init_actions();
		}

		/**
		 * Setup the class globals.
		 *
		 * @since 1.1.1
		 * @access private
		 */
		public function init_globals() {
			$current_theme = wp_get_theme();
			$this->theme_name = strtolower( preg_replace( '#[^a-zA-Z]#','',$current_theme->get( 'Name' ) ) );
			$this->envato_username = apply_filters( $this->theme_name . '_theme_setup_wizard_username', 'wow_themes' );
			$this->oauth_script = apply_filters( $this->theme_name . '_theme_setup_wizard_oauth_script', 'http://envato.app.wow-themes.com/server-script.php' );
			$this->page_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_page_slug', $this->theme_name.'-setup' );
			$this->parent_slug = apply_filters( $this->theme_name . '_theme_setup_wizard_parent_slug', '' );

			//If we have parent slug - set correct url
			if( $this->parent_slug !== '' ){
				$this->page_url = 'admin.php?page='.$this->page_slug;
			}else{
				$this->page_url = 'themes.php?page='.$this->page_slug;
			}
			$this->page_url = apply_filters( $this->theme_name . '_theme_setup_wizard_page_url', $this->page_url );

			//set relative plugin path url
			$this->plugin_path = trailingslashit( $this->cleanFilePath( dirname( __FILE__ ) ) );
			$relative_url = str_replace( $this->cleanFilePath( get_template_directory() ), '', $this->plugin_path );
			$this->plugin_url = trailingslashit( get_template_directory_uri() . $relative_url );
		}

		/**
		 * Setup the hooks, actions and filters.
		 *
		 * @uses add_action() To add actions.
		 * @uses add_filter() To add filters.
		 *
		 * @since 1.1.1
		 * @access private
		 */
		public function init_actions() {
			if ( apply_filters( $this->theme_name . '_enable_setup_wizard', true ) && current_user_can( 'manage_options' )  ) {
				add_action( 'after_switch_theme', array( $this, 'switch_theme' ) );

				if(class_exists( 'TGM_Plugin_Activation' ) && isset($GLOBALS['tgmpa'])) {
					$instance = call_user_func( array( '_Wow_Themes_Envato_Plugins', 'get_instance' ) );
					add_action( 'init', array( $instance, 'get_tgmpa_instanse' ), 30 );
					add_action( 'init', array( $instance, 'set_tgmpa_url' ), 40 );
				}

				add_action( 'admin_menu', array( $this, 'admin_menus' ) );
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
				add_action( 'admin_init', array( $this, 'admin_redirects' ), 30 );
				add_action( 'admin_init', array( $this, 'init_wizard_steps' ), 30 );
				add_action( 'admin_init', array( $this, 'setup_wizard' ), 30 );
				add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
				add_action( 'wp_ajax_envato_setup_plugins', array( $this, 'ajax_plugins' ) );
				add_action( 'wp_ajax_envato_setup_content', array( $this, 'ajax_content' ) );
			}
			if ( function_exists( 'envato_market' ) ) {
				add_action( 'admin_init', array( $this, 'envato_market_admin_init' ), 20 );
				add_filter( 'http_request_args', array( $this, 'envato_market_http_request_args' ), 10, 2 );
			}
		}

		public function enqueue_scripts() {
		}
		public function tgmpa_load( $status ) {
			return is_admin() || current_user_can( 'install_themes' );
		}

		public function switch_theme() {
			set_transient( '_'.$this->theme_name.'_activation_redirect', 1 );
		}
		public function admin_redirects() {
			ob_start();
			if ( ! get_transient( '_'.$this->theme_name.'_activation_redirect' ) ) {
				return;
			}
			delete_transient( '_'.$this->theme_name.'_activation_redirect' );
			wp_safe_redirect( admin_url( $this->page_url ) );
			exit;
		}

		

		/**
		 * Add admin menus/screens.
		 */
		public function admin_menus() {

			if( $this->is_submenu_page() ){
				//prevent Theme Check warning about "themes should use add_theme_page for adding admin pages"
				$add_subpage_function = 'add_submenu'.'_page';
				$add_subpage_function( $this->parent_slug, __( 'Setup Wizard','hash' ), __( 'Setup Wizard','hash' ), 'manage_options', $this->page_slug, array( $this, 'setup_wizard' ) );
			}else{
				add_theme_page( __( 'Setup Wizard','hash' ), __( 'Setup Wizard','hash' ), 'manage_options', $this->page_slug, array( $this, 'setup_wizard' ) );
			}

		}


		/**
		 * Setup steps.
		 *
		 * @since 1.1.1
		 * @access public
		 * @return array
		 */
		public function init_wizard_steps() {

			$this->steps = array(
				'introduction' => array(
					'name'    => __( 'Introduction', 'hash' ),
					'view'    => array( $this, 'envato_setup_introduction' ),
					'handler' => '',
				),
			);
			if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
				$this->steps['default_plugins'] = array(
					'name' => __( 'Plugins', 'hash' ),
					'view' => array( $this, 'envato_setup_default_plugins' ),
					'handler' => '',
				);
			}
			$this->steps['default_content'] = array(
				'name'    => __( 'Content', 'hash' ),
				'view'    => array( $this, 'envato_setup_default_content' ),
				'handler' => '',
			);
			$this->steps['design'] = array(
				'name'    => __( 'Logo & Design', 'hash' ),
				'view'    => array( $this, 'envato_setup_logo_design' ),
				'handler' => array( $this, 'envato_setup_logo_design_save' ),
			);
			$this->steps['updates'] = array(
				'name'    => __( 'Updates', 'hash' ),
				'view'    => array( $this, 'envato_setup_updates' ),
				'handler' => array( $this, 'envato_setup_updates_save' ),
			);
			$this->steps['customize'] = array(
				'name'    => __( 'Customize', 'hash' ),
				'view'    => array( $this, 'envato_setup_customize' ),
				'handler' => '',
			);
			$this->steps['help_support'] = array(
				'name'    => __( 'Support', 'hash' ),
				'view'    => array( $this, 'envato_setup_help_support' ),
				'handler' => '',
			);
			$this->steps['next_steps'] = array(
				'name'    => __( 'Ready!', 'hash' ),
				'view'    => array( $this, 'envato_setup_ready' ),
				'handler' => '',
			);

			return apply_filters(  $this->theme_name . '_theme_setup_wizard_steps', $this->steps );

		}

		/**
		 * Show the setup wizard
		 */
		public function setup_wizard() {
			if ( empty( $_GET['page'] ) || $this->page_slug !== $_GET['page'] ) {
				return;
			}
			ob_end_clean();

			$this->step = isset( $_GET['step'] ) ? sanitize_key( $_GET['step'] ) : current( array_keys( $this->steps ) );

			wp_register_script( 'jquery-blockui', $this->plugin_url . '/js/jquery.blockUI.js', array( 'jquery' ), '2.70', true );
			wp_register_script( 'envato-setup', $this->plugin_url . '/js/envato-setup.js', array( 'jquery', 'jquery-blockui' ), $this->version );
			wp_localize_script( 'envato-setup', 'envato_setup_params', array(
				'tgm_plugin_nonce'            => array(
					'update' => wp_create_nonce( 'tgmpa-update' ),
					'install' => wp_create_nonce( 'tgmpa-install' ),
				),
				'tgm_bulk_url' => admin_url( $this->tgmpa_url ),
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'wpnonce' => wp_create_nonce( 'envato_setup_nonce' ),
				'verify_text' => __( '...verifying','hash' ),
			) );

			//wp_enqueue_style( 'envato_wizard_admin_styles', $this->plugin_url . '/css/admin.css', array(), $this->version );
			wp_enqueue_style( 'envato-setup', $this->plugin_url . '/css/envato-setup.css', array( 'dashicons', 'install' ), $this->version );

			//enqueue style for admin notices
			wp_enqueue_style( 'wp-admin' );

			wp_enqueue_media();
			wp_enqueue_script( array('media') );

			ob_start();
			$this->setup_wizard_header();
			$this->setup_wizard_steps();
			$show_content = true;
			echo '<div class="envato-setup-content">';
			if ( ! empty( $_REQUEST['save_step'] ) && isset( $this->steps[ $this->step ]['handler'] ) ) {
				$show_content = call_user_func( $this->steps[ $this->step ]['handler'] );
			}
			if ( $show_content ) {
				$this->setup_wizard_content();
			}
			echo '</div>';
			$this->setup_wizard_footer();
			exit;
		}

		public function get_step_link( $step ) {
			return  add_query_arg( 'step', $step, admin_url( 'admin.php?page=' .$this->page_slug ) );
		}
		public function get_next_step_link() {
			$keys = array_keys( $this->steps );
			return add_query_arg( 'step', $keys[ array_search( $this->step, array_keys( $this->steps ) ) + 1 ], remove_query_arg( 'translation_updated' ) );
		}

		/**
		 * Setup Wizard Header
		 */
	public function setup_wizard_header() {
		?>
		<!DOCTYPE html>
		<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
		<head>
			<meta name="viewport" content="width=device-width" />
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<!--title><?php _e( 'Theme &rsaquo; Setup Wizard', 'hash' ); ?></title-->
			<?php wp_print_scripts( 'envato-setup' ); ?>
			<?php do_action( 'admin_print_styles' ); ?>
			<?php do_action( 'admin_print_scripts' ); ?>
			<?php do_action( 'admin_head' ); ?>
		</head>
		<body class="envato-setup wp-core-ui">
		<h1 id="wc-logo">
			<a href="#" target="_blank"><?php
				$image_url = get_theme_mod( 'logo_header_image', get_template_directory_uri().'/images/logo.png' );
				if ( $image_url ) {
					$image = '<img class="site-logo" src="%s" alt="%s" style="width:%s; height:auto" />';
					printf(
						$image,
						$image_url,
						get_bloginfo( 'name' ),
						'200px'
					);
				} else { ?>
					<img src="<?php echo $this->plugin_url; ?>/images/logo.png" alt="Envato install wizard" /><?php
				} ?></a>
		</h1>
		<?php
		}

		/**
		 * Setup Wizard Footer
		 */
		public function setup_wizard_footer() {
		?>
		<?php if ( 'next_steps' === $this->step ) : ?>
			<a class="wc-return-to-dashboard" href="<?php echo esc_url( admin_url() ); ?>"><?php _e( 'Return to the WordPress Dashboard', 'hash' ); ?></a>
		<?php endif; ?>
		</body>
		<?php
		@do_action( 'admin_footer' ); // this was spitting out some errors in some admin templates. quick @ fix until I have time to find out what's causing errors.
		do_action( 'admin_print_footer_scripts' );
		?>
		</html>
		<?php
	}

		/**
		 * Output the steps
		 */
		public function setup_wizard_steps() {
			$ouput_steps = $this->steps;
			array_shift( $ouput_steps );
			?>
			<ol class="envato-setup-steps">
				<?php foreach ( $ouput_steps as $step_key => $step ) : ?>
					<li class="<?php
					$show_link = false;
					if ( $step_key === $this->step ) {
						echo 'active';
					} elseif ( array_search( $this->step, array_keys( $this->steps ) ) > array_search( $step_key, array_keys( $this->steps ) ) ) {
						echo 'done';
						$show_link = true;
					}
					?>"><?php
						if ( $show_link ) {
							?>
							<a href="<?php echo esc_url( $this->get_step_link( $step_key ) );?>"><?php echo esc_html( $step['name'] );?></a>
							<?php
						} else {
							echo esc_html( $step['name'] );
						}
						?></li>
				<?php endforeach; ?>
			</ol>
			<?php
		}

		/**
		 * Output the content for the current step
		 */
		public function setup_wizard_content() {
			isset( $this->steps[ $this->step ] ) ? call_user_func( $this->steps[ $this->step ]['view'] ) : false;
		}

		/**
		 * Introduction step
		 */
		public function envato_setup_introduction() {
			if ( isset( $_REQUEST['export'] ) ) {

				// find the ID of our menu names so we can import them into default menu locations and also the widget positions below.
				$menus = get_terms( 'nav_menu' );
				$menu_ids = array();
				foreach ( $menus as $menu ) {
					if ( $menu->name == 'Main Menu' ) {
						$menu_ids['primary'] = $menu->term_id;
					} else if ( $menu->name == 'Quick Links' ) {
						$menu_ids['footer_quick'] = $menu->term_id;
					}
				}
				// used for me to export my widget settings.
				$widget_positions = get_option( 'sidebars_widgets' );
				$widget_options = array();
				$my_options = array();
				foreach ( $widget_positions as $sidebar_name => $widgets ) {
					if ( is_array( $widgets ) ) {
						foreach ( $widgets as $widget_name ) {
							$widget_name_strip = preg_replace( '#-\d+$#','',$widget_name );
							$widget_options[ $widget_name_strip ] = get_option( 'widget_'.$widget_name_strip );
						}
					}
				}
				// choose which custom options to load into defaults
				$all_options = wp_load_alloptions();
				foreach ( $all_options as $name => $value ) {
					if ( stristr( $name, '_widget_area_manager' ) ) { $my_options[ $name ] = $value; }
					if ( stristr( $name, 'wam_' ) ) { $my_options[ $name ] = $value; }
				}
				$my_options['travel_settings'] = array( 'api_key' => 'AIzaSyBsnYWO4SSibatp0SjsU9D2aZ6urI-_cJ8' );
				$my_options['tt-font-google-api-key'] = 'AIzaSyBsnYWO4SSibatp0SjsU9D2aZ6urI-_cJ8';
				?>
				<h1>Current Settings:</h1>
				<p>Widget Positions:</p>
				<textarea style="width:100%; height:80px;"><?php echo json_encode( $widget_positions );?></textarea>
				<p>Widget Options:</p>
				<textarea style="width:100%; height:80px;"><?php echo json_encode( $widget_options );?></textarea>
				<p>Menu IDs:</p>
				<textarea style="width:100%; height:80px;"><?php echo json_encode( $menu_ids );?></textarea>
				<p>Custom Options:</p>
				<textarea style="width:100%; height:80px;"><?php echo json_encode( $my_options );?></textarea>
				<p>Copy these values into your PHP code when distributing/updating the theme.</p>
				<?php
			} else {
				?>
				<h1><?php _e( 'Welcome to the setup wizard for Beautiful!','hash' ); ?></h1>
				<p><?php _e( 'Thank you for choosing the Beautiful theme from ThemeForest. This quick setup wizard will help you configure your new website. This wizard will install the required WordPress plugins, default content, logo and tell you a little about Help &amp; Support options. <br/>It should only take 5 minutes.','hash' ); ?></p>
				<p><?php _e( 'No time right now? If you don\'t want to go through the wizard, you can skip and return to the WordPress dashboard. Come back anytime if you change your mind!','hash' ); ?></p>
				<p class="envato-setup-actions step">
					<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>"
					   class="button-primary button button-large button-next"><?php _e( 'Let\'s Go!','hash' ); ?></a>
					<a href="<?php echo esc_url( wp_get_referer() && ! strpos( wp_get_referer(),'update.php' ) ? wp_get_referer() : admin_url( '' ) ); ?>"
					   class="button button-large"><?php _e( 'Not right now','hash' ); ?></a>
				</p>
				<?php
			}
		}


		
		/**
		 * Logo & Design
		 */
		public function envato_setup_logo_design() {

			?>
			<h1><?php _e( 'Logo &amp; Design', 'hash' ); ?></h1>
			<form method="post">
				<p><?php echo sprintf( __( 'Please add your logo below. For best results, the logo should be a transparent PNG ( 466 by 277 pixels). The logo can be changed at any time from the Appearance > Customize area in your dashboard. Try %sEnvato Studio%s if you need a new logo designed.' ,'hash' ), '<a href="" target="_blank">','</a>' ); ?></p>

				<table>
					<tr>
						<td>
							<div id="current-logo">
								<?php $image_url = get_theme_mod( 'logo_header_image', get_template_directory_uri().'/images/'.get_theme_mod( 'beautiful_site_color','pink' ).'/logo.png' );
								if ( $image_url ) {
									$image = '<img class="site-logo" src="%s" alt="%s" style="width:%s; height:auto" />';
									printf(
										$image,
										$image_url,
										get_bloginfo( 'name' ),
										'200px'
									);
								} ?>
							</div>
						</td>
						<td>
							<a href="#" class="button button-upload"><?php _e( 'Upload New Logo', 'hash' ); ?></a>
						</td>
					</tr>
				</table>


				<p><?php _e( 'Please choose the color scheme for this website. The color scheme (along with font colors &amp; styles) can be changed at any time from the Appearance > Customize area in your dashboard.' ,'hash' ); ?></p>

				<div class="theme-presets">
					<ul>
						<?php
						$current_demo = get_theme_mod( 'beautiful_site_color','pink' );
						$demo_styles = apply_filters( 'beautiful_default_styles',array() );
						foreach ( $demo_styles as $demo_name => $demo_style ) {
							?>
							<li<?php echo $demo_name == $current_demo ? ' class="current" ' : '';?>>
								<a href="#" data-style="<?php echo esc_attr( $demo_name );?>"><img src="<?php echo esc_url( $demo_style['image'] );?>"></a>
							</li>
						<?php } ?>
					</ul>
				</div>

				<p><em>Please Note: Advanced changes to website graphics/colors may require extensive PhotoShop and Web Development knowledge. We recommend hiring an expert from <a href="" target="_blank">Author Profile</a> to assist with any advanced website changes.</em></p>
				
				<input type="hidden" name="new_logo_id" id="new_logo_id" value="">
				<input type="hidden" name="new_style" id="new_style" value="">

				<p class="envato-setup-actions step">
					<input type="submit" class="button-primary button button-large button-next" value="<?php esc_attr_e( 'Continue', 'hash' ); ?>" name="save_step" />
					<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="button button-large button-next"><?php _e( 'Skip this step', 'hash' ); ?></a>
					<?php wp_nonce_field( 'envato-setup' ); ?>
				</p>
			</form>
			<?php
		}

		/**
		 * Save logo & design options
		 */
		public function envato_setup_logo_design_save() {
			check_admin_referer( 'envato-setup' );

			$new_logo_id = (int) $_POST['new_logo_id'];
			// save this new logo url into the database and calculate the desired height based off the logo width.
			// copied from dtbaker.theme_options.php
			if ( $new_logo_id ) {
				$attr = wp_get_attachment_image_src( $new_logo_id, 'full' );
				if ( $attr && ! empty( $attr[1] ) && ! empty( $attr[2] ) ) {
					set_theme_mod( 'logo_header_image',$attr[0] );
					// we have a width and height for this image. awesome.
					$logo_width = (int) get_theme_mod( 'logo_header_image_width', '467' );
					$scale = $logo_width / $attr[1];
					$logo_height = $attr[2] * $scale;
					if ( $logo_height > 0 ) {
						set_theme_mod( 'logo_header_image_height', $logo_height );
					}
				}
			}

			$new_style = $_POST['new_style'];
			$demo_styles = apply_filters( 'beautiful_default_styles',array() );
			if ( isset( $demo_styles[ $new_style ] ) ) {
				set_theme_mod( 'beautiful_site_color',$new_style );
			}

			wp_redirect( esc_url_raw( $this->get_next_step_link() ) );
			exit;
		}

		/**
		 * Payments Step
		 */
		public function envato_setup_updates() {
			?>
			<h1><?php _e( 'Theme Updates', 'hash' ); ?></h1>
			<?php if ( function_exists( 'envato_market' ) ) { ?>
				<form method="post">
					<?php
					$option = envato_market()->get_options();

					//echo '<pre>';print_r($option);echo '</pre>';
					$my_items = array();
					if ( $option && ! empty( $option['items'] ) ) {
						foreach ( $option['items'] as $item ) {
							if ( ! empty( $item['oauth'] ) && ! empty( $item['token_data']['expires'] ) && $item['oauth'] == $this->envato_username && $item['token_data']['expires'] >= time() ) {
								// token exists and is active
								$my_items[] = $item;
							}
						}
					}
					if ( count( $my_items ) ) {
						?>
						<p>Thanks! Theme updates have been enabled for the following items: </p>
						<ul>
							<?php foreach ( $my_items as $item ) {  ?>
								<li><?php echo esc_html( $item['name'] );?></li>
							<?php } ?>
						</ul>
						<p>When an update becomes available it will show in the Dashboard with an option to install.</p>
						<p>Change settings from the 'Envato Market' menu in the WordPress Dashboard.</p>

						<p class="envato-setup-actions step">
							<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="button button-large button-next button-primary"><?php _e( 'Continue', 'hash' ); ?></a>
						</p>
						<?php
					} else {
						?>
						<p><?php _e( 'Please login using your ThemeForest account to enable Theme Updates. We update themes when a new feature is added or a bug is fixed. It is highly recommended to enable Theme Updates.', 'hash' ); ?></p>
						<p>When an update becomes available it will show in the Dashboard with an option to install.</p>
						<p>
							<em>On the next page you will be asked to Login with your ThemeForest account and grant permissions to enable Automatic Updates. If you have any questions please <a href="" target="_blank">contact us</a>.</em>
						</p>
						<p class="envato-setup-actions step">
							<input type="submit" class="button-primary button button-large button-next" value="<?php esc_attr_e( 'Login with Envato', 'hash' ); ?>" name="save_step" />
							<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="button button-large button-next"><?php _e( 'Skip this step', 'hash' ); ?></a>
							<?php wp_nonce_field( 'envato-setup' ); ?>
						</p>
					<?php } ?>
				</form>
			<?php } else { ?>
				Please ensure the Envato Market plugin has been installed correctly. <a href="<?php echo esc_url( $this->get_step_link( 'default_plugins' ) );?>">Return to Required Plugins installer</a>.
			<?php } ?>
			<?php
		}

		/**
		 * Payments Step save
		 */
		public function envato_setup_updates_save() {
			check_admin_referer( 'envato-setup' );

			// redirect to our custom login URL to get a copy of this token.
			$url = $this->get_oauth_login_url( $this->get_step_link( 'updates' ) );

			wp_redirect( esc_url_raw( $url ) );
			exit;
		}


		public function envato_setup_customize() {
			?>

			<h1>Theme Customization</h1>
			<p>
				Most changes to the website can be made through the Appearance > Customize menu from the WordPress dashboard. These include:
			</p>
			<ul>
				<li>Typography: Font Sizes, Style, Colors (over 200 fonts to choose from) for various page elements.</li>
				<li>Logo: Upload a new logo and adjust its size.</li>
				<li>Background: Upload a new background image.</li>
				<li>Layout: Enable/Disable responsive layout, page and sidebar width.</li>
			</ul>
			<p>To change the Sidebars go to Appearance > Widgets. Here widgets can be "drag &amp; droped" into sidebars. To control which "widget areas" appear, go to an individual page and look for the "Left/Right Column" menu. Here widgets can be chosen for display on the left or right of a page. More details in documentation.</p>
			<p>
				<em>Advanced Users: If you are going to make changes to the theme source code please use a <a href="https://codex.wordpress.org/Child_Themes" target="_blank">Child Theme</a> rather than modifying the main theme HTML/CSS/PHP code. This allows the parent theme to receive updates without overwriting your source code changes. <br/> See <code>child-theme.zip</code> in the main folder for a sample.</em>
			</p>

			<p class="envato-setup-actions step">
				<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="button button-primary button-large button-next"><?php _e( 'Continue', 'hash' ); ?></a>
			</p>

			<?php
		}
		public function envato_setup_help_support() {
			?>
			<h1>Help and Support</h1>
			<p>This theme comes with 6 months item support from purchase date (with the option to extend this period). This license allows you to use this theme on a single website. Please purchase an additional license to use this theme on another website.</p>
			
			<ul>
				<li>Availability of the author to answer questions</li>
				<li>Answering technical questions about item features</li>
				<li>Assistance with reported bugs and issues</li>
				<li>Help with bundled 3rd party plugins</li>
			</ul>

			<p>Item Support <strong>DOES NOT</strong> Include:</p>
			<ul>
				<li>Customization services (this is available through <a href="http://themeforest.net/user/wptech#contact" target="_blank">Author Profile</a>)</li>
				<li>Installation services (this is available through <a href="http://themeforest.net/user/wptech#contact" target="_blank">Author Profile</a>)</li>
				<li>Help and Support for non-bundled 3rd party plugins (i.e. plugins you install yourself later on)</li>
			</ul>
			<p>More details about item support can be found in the ThemeForest <a href="" target="_blank">Item Support Polity</a>. </p>
			<p class="envato-setup-actions step">
				<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="button button-primary button-large button-next"><?php _e( 'Agree and Continue', 'hash' ); ?></a>
				<?php wp_nonce_field( 'envato-setup' ); ?>
			</p>
			<?php
		}

		/**
		 * Final step
		 */
		public function envato_setup_ready() {
			?>
			<a href="" class="twitter-share-button" data-url="http://themeforest.net/user/wptech/portfolio?ref=wptech" data-text="<?php echo esc_attr( 'I just installed the Beautiful #WordPress theme from #ThemeForest' ); ?>" data-via="EnvatoMarket" data-size="large">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

			<h1><?php _e( 'Your Website is Ready!', 'hash' ); ?></h1>

			<p>Congratulations! The theme has been activated and your website is ready. Login to your WordPress dashboard to make changes and modify any of the default content to suit your needs.</p>
			<p>Please come back and <a href="" target="_blank">leave a 5-star rating</a> if you are happy with this theme. <br/>Follow <a  href="https://twitter.com/wowtheme" target="_blank">@wowtheme</a> on Twitter to see updates. Thanks! </p>

			<div class="envato-setup-next-steps">
				<div class="envato-setup-next-steps-first">
					<h2><?php _e( 'Next Steps', 'hash' ); ?></h2>
					<ul>
						<li class="setup-product"><a class="button button-primary button-large" href="https://twitter.com/wowtheme" target="_blank"><?php _e( 'Follow @wowtheme on Twitter', 'hash' ); ?></a></li>
						<li class="setup-product"><a class="button button-next button-large" href="<?php echo esc_url( home_url() ); ?>"><?php _e( 'View your new website!', 'hash' ); ?></a></li>
					</ul>
				</div>
				<div class="envato-setup-next-steps-last">
					<h2><?php _e( 'More Resources', 'hash' ); ?></h2>
					<ul>
						<li class="documentation"><a href="" target="_blank"><?php _e( 'Read the Theme Documentation', 'hash' ); ?></a></li>
						<li class="howto"><a href="https://wordpress.org/support/" target="_blank"><?php _e( 'Learn how to use WordPress', 'hash' ); ?></a></li>
						<li class="rating"><a href="" target="_blank"><?php _e( 'Leave an Item Rating', 'hash' ); ?></a></li>
						<li class="support"><a href="" target="_blank"><?php _e( 'Get Help and Support', 'hash' ); ?></a></li>
					</ul>
				</div>
			</div>
			<?php
		}

		public function envato_market_admin_init() {

			if(!function_exists('envato_market'))return;

			global $wp_settings_sections;
			if ( ! isset( $wp_settings_sections[ envato_market()->get_slug() ] ) ) {
				// means we're running the admin_init hook before envato market gets to setup settings area.
				// good - this means our oauth prompt will appear first in the list of settings blocks
				register_setting( envato_market()->get_slug(), envato_market()->get_option_name() );
			}

			// pull our custom options across to envato.
			$option = get_option( 'envato_setup_wizard' , array() );
			$envato_options = envato_market()->get_options();
			$envato_options = $this->_array_merge_recursive_distinct($envato_options, $option);
			update_option( envato_market()->get_option_name(), $envato_options );

			//add_thickbox();

			if ( ! empty( $_POST['oauth_session'] ) && ! empty( $_POST['bounce_nonce'] ) && wp_verify_nonce( $_POST['bounce_nonce'], 'envato_oauth_bounce_' . $this->envato_username ) ) {
				// request the token from our bounce url.
				$my_theme = wp_get_theme();
				$oauth_nonce = get_option( 'envato_oauth_'.$this->envato_username );
				if ( ! $oauth_nonce ) {
					// this is our 'private key' that is used to request a token from our api bounce server.
					// only hosts with this key are allowed to request a token and a refresh token
					// the first time this key is used, it is set and locked on the server.
					$oauth_nonce = wp_create_nonce( 'envato_oauth_nonce_' . $this->envato_username );
					update_option( 'envato_oauth_'.$this->envato_username, $oauth_nonce );
				}
				$response = wp_remote_post( $this->oauth_script, array(
						'method' => 'POST',
						'timeout' => 15,
						'redirection' => 1,
						'httpversion' => '1.0',
						'blocking' => true,
						'headers' => array(),
						'body' => array(
							'oauth_session' => $_POST['oauth_session'],
							'oauth_nonce' => $oauth_nonce,
							'get_token' => 'yes',
							'url' => home_url(),
							'theme' => $my_theme->get( 'Name' ),
							'version' => $my_theme->get( 'Version' ),
						),
						'cookies' => array(),
					)
				);
				if ( is_wp_error( $response ) ) {
					$error_message = $response->get_error_message();
					$class = 'error';
					echo "<div class=\"$class\"><p>".sprintf( __( 'Something went wrong while trying to retrieve oauth token: %s','hash' ), $error_message ).'</p></div>';
				} else {

					$token = @json_decode( wp_remote_retrieve_body( $response ), true );
					$result = false;
					if ( is_array( $token ) && ! empty( $token['access_token'] ) ) {
						$token['oauth_session'] = $_POST['oauth_session'];
						$result = $this->_manage_oauth_token( $token );
					}
					if ( $result !== true ) {
						echo 'Failed to get oAuth token. Please go back and try again';
						exit;
					}
				}
			}

			add_settings_section(
				envato_market()->get_option_name() . '_' . $this->envato_username  . '_oauth_login',
				sprintf( __( 'Login for %s updates', 'hash' ), $this->envato_username ),
				array( $this, 'render_oauth_login_description_callback' ),
				envato_market()->get_slug()
			);
			// Items setting.
			add_settings_field(
				$this->envato_username  . 'oauth_keys',
				__( 'oAuth Login', 'hash' ),
				array( $this, 'render_oauth_login_fields_callback' ),
				envato_market()->get_slug(),
				envato_market()->get_option_name() . '_' . $this->envato_username  . '_oauth_login'
			);
		}

		private static $_current_manage_token = false;

		private function _manage_oauth_token( $token ) {
			if ( is_array( $token ) && ! empty( $token['access_token'] ) ) {
				if ( self::$_current_manage_token == $token['access_token'] ) {
					return false; // stop loops when refresh auth fails.
				}
				self::$_current_manage_token = $token['access_token'];
				// yes! we have an access token. store this in our options so we can get a list of items using it.
				$option = get_option( 'envato_setup_wizard', array() );
				if ( ! is_array( $option ) ) {
					$option = array();
				}
				if ( empty( $option['items'] ) ) {
					$option['items'] = array();
				}
				// check if token is expired.
				if ( empty( $token['expires'] ) ) {
					$token['expires'] = time() + 3600;
				}
				if ( $token['expires'] < time() + 120 && ! empty( $token['oauth_session'] ) ) {
					// time to renew this token!
					$my_theme = wp_get_theme();
					$oauth_nonce = get_option( 'envato_oauth_'.$this->envato_username );
					$response = wp_remote_post( $this->oauth_script, array(
							'method' => 'POST',
							'timeout' => 10,
							'redirection' => 1,
							'httpversion' => '1.0',
							'blocking' => true,
							'headers' => array(),
							'body' => array(
								'oauth_session' => $token['oauth_session'],
								'oauth_nonce' => $oauth_nonce,
								'refresh_token' => 'yes',
								'url' => home_url(),
								'theme' => $my_theme->get( 'Name' ),
								'version' => $my_theme->get( 'Version' ),
							),
							'cookies' => array(),
						)
					);
					if ( is_wp_error( $response ) ) {
						$error_message = $response->get_error_message();
						echo "Something went wrong while trying to retrieve oauth token: $error_message";
					} else {
						$new_token = @json_decode( wp_remote_retrieve_body( $response ), true );
						$result = false;
						if ( is_array( $new_token ) && ! empty( $new_token['new_token'] ) ) {
							$token['access_token'] = $new_token['new_token'];
							$token['expires'] = time() + 3600;
						}
					}
				}
				// use this token to get a list of purchased items
				// add this to our items array.
				$response = envato_market()->api()->request( 'https://api.envato.com/v3/market/buyer/purchases', array(
					'headers' => array(
						'Authorization' => 'Bearer ' . $token['access_token'],
					),
				) );
				self::$_current_manage_token = false;
				if ( is_array( $response ) && is_array( $response['purchases'] ) ) {
					// up to here, add to items array
					foreach ( $response['purchases'] as $purchase ) {
						// check if this item already exists in the items array.
						$exists = false;
						foreach ( $option['items'] as $id => $item ) {
							if ( ! empty( $item['id'] ) && $item['id'] == $purchase['item']['id'] ) {
								$exists = true;
								// update token.
								$option['items'][ $id ]['token'] = $token['access_token'];
								$option['items'][ $id ]['token_data'] = $token;
								$option['items'][ $id ]['oauth'] = $this->envato_username;
								if ( ! empty( $purchase['code'] ) ) {
									$option['items'][ $id ]['purchase_code'] = $purchase['code'];
								}
							}
						}
						if ( ! $exists ) {
							$option['items'][] = array(
								'id' => '' . $purchase['item']['id'], // item id needs to be a string for market download to work correctly.
								'name' => $purchase['item']['name'],
								'token' => $token['access_token'],
								'token_data' => $token,
								'oauth' => $this->envato_username,
								'type' => ! empty( $purchase['item']['wordpress_theme_metadata'] ) ? 'theme' : 'plugin',
								'purchase_code' => ! empty( $purchase['code'] ) ? $purchase['code'] : '',
							);
						}
					}
				} else {
					return false;
				}
				if ( ! isset( $option['oauth'] ) ) {
					$option['oauth'] = array();
				}
				// store our 1 hour long token here. we can refresh this token when it comes time to use it again (i.e. during an update)
				$option['oauth'][ $this->envato_username ] = $token;
				update_option( 'envato_setup_wizard', $option );

				$envato_options = envato_market()->get_options();
				$envato_options = $this->_array_merge_recursive_distinct($envato_options, $option);
				update_option( envato_market()->get_option_name(), $envato_options );
				envato_market()->items()->set_themes( true );
				envato_market()->items()->set_plugins( true );
				return true;
			} else {
				return false;
			}
		}

		/**
		 * @param $array1
		 * @param $array2
		 *
		 * @return mixed
		 *
		 *
		 * @since    1.1.4
		 */
		private function _array_merge_recursive_distinct( $array1, $array2 ) {
			$merged = $array1;
			foreach ( $array2 as $key => &$value ) {
				if ( is_array( $value ) && isset ( $merged [ $key ] ) && is_array( $merged [ $key ] ) ) {
					$merged [ $key ] = $this->_array_merge_recursive_distinct( $merged [ $key ], $value );
				} else {
					$merged [ $key ] = $value;
				}
			}
			return $merged;
		}

		/**
		 * @param $args
		 * @param $url
		 * @return mixed
		 *
		 * Filter the WordPress HTTP call args.
		 * We do this to find any queries that are using an expired token from an oAuth bounce login.
		 * Since these oAuth tokens only last 1 hour we have to hit up our server again for a refresh of that token before using it on the Envato API.
		 * Hacky, but only way to do it.
		 */
		public function envato_market_http_request_args( $args, $url ) {
			if ( strpos( $url,'api.envato.com' ) && function_exists( 'envato_market' ) ) {
				// we have an API request.
				// check if it's using an expired token.
				if ( ! empty( $args['headers']['Authorization'] ) ) {
					$token = str_replace( 'Bearer ','',$args['headers']['Authorization'] );
					if ( $token ) {
						// check our options for a list of active oauth tokens and see if one matches, for this envato username.
						$option = envato_market()->get_options();
						if ( $option && ! empty( $option['oauth'][ $this->envato_username ] ) && $option['oauth'][ $this->envato_username ]['access_token'] == $token && $option['oauth'][ $this->envato_username ]['expires'] < time() + 120 ) {
							// we've found an expired token for this oauth user!
							// time to hit up our bounce server for a refresh of this token and update associated data.
							$this->_manage_oauth_token( $option['oauth'][ $this->envato_username ] );
							$updated_option = envato_market()->get_options();
							if ( $updated_option && ! empty( $updated_option['oauth'][ $this->envato_username ]['access_token'] ) ) {
								// hopefully this means we have an updated access token to deal with.
								$args['headers']['Authorization'] = 'Bearer '.$updated_option['oauth'][ $this->envato_username ]['access_token'];
							}
						}
					}
				}
			}
			return $args;
		}
		public function render_oauth_login_description_callback() {
			echo 'If you have purchased items from ' . esc_html($this->envato_username).' on ThemeForest or CodeCanyon please login here for quick and easy updates.';

		}

		public function render_oauth_login_fields_callback() {
			$option = envato_market()->get_options();
			?>
			<div class="oauth-login" data-username="<?php echo esc_attr( $this->envato_username ); ?>">
				<a href="<?php echo esc_url( $this->get_oauth_login_url( admin_url( 'admin.php?page=' . envato_market()->get_slug() . '#settings' ) ) ); ?>"
				   class="oauth-login-button button button-primary">Login with Envato to activate updates</a>
			</div>
			<?php
		}

		/// a better filter would be on the post-option get filter for the items array.
		// we can update the token there.

		public function get_oauth_login_url( $return ) {
			return $this->oauth_script . '?bounce_nonce=' . wp_create_nonce( 'envato_oauth_bounce_' . $this->envato_username ) . '&wp_return=' . urlencode( $return );
		}

		/**
		 * Helper function
		 * Take a path and return it clean
		 *
		 * @param string $path
		 *
		 * @since    1.1.2
		 */
		public static function cleanFilePath( $path ) {
			$path = str_replace( '', '', str_replace( array( "\\", "\\\\" ), '/', $path ) );
			if ( $path[ strlen( $path ) - 1 ] === '/' ) {
				$path = rtrim( $path, '/' );
			}
			return $path;
		}

		public function is_submenu_page(){
			return ( $this->parent_slug == '' ) ? false : true;
		}
	}

}// if !class_exists

/**
 * Loads the main instance of Envato_Theme_Setup_Wizard to have
 * ability extend class functionality
 *
 * @since 1.1.1
 * @return object Envato_Theme_Setup_Wizard
 */
add_action( 'after_setup_theme', 'envato_theme_setup_wizard', 10 );
if ( ! function_exists( 'envato_theme_setup_wizard' ) ) :
	function envato_theme_setup_wizard() {
		Envato_Theme_Setup_Wizard::get_instance();
		
	}
endif;