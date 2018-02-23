<?php 

/**
 * Wow_Themes class to support Envato Wizard Class
 *
 * This class only import the xml data of given files.
 *
 * @author      wow_themes
 * @author      Shahbaz
 * @package     envato_wizard
 * @version     1.0.0
 *
 * Based off the WooThemes installer.
 *
*/

if(!class_exists('_Wow_Themes_Envato_Plugins'))
{

	//class _Wow_Themes_Envato_Plugins extends Envato_Theme_Setup_Wizard
	class _Wow_Themes_Envato_Plugins
	{

		/**
		 * TGMPA instance storage
		 *
		 * @var object
		 */
		protected $tgmpa_instance;

		/**
		 * TGMPA Menu slug
		 *
		 * @var string
		 */
		protected $tgmpa_menu_slug = 'tgmpa-install-plugins';

		/**
		 * TGMPA Menu url
		 *
		 * @var string
		 */
		//protected $tgmpa_url = 'themes.php?page=tgmpa-install-plugins';
		protected $tgmpa_url = 'themes.php?page=install-required-plugins';


		static $instance;
		protected $theme_name;
		
		function __construct()
		{
			# code...
		}


		/**
		 * Returns the singleton instance of the class.
		 *
		 * @since 1.0.0
		 *
		 * @return object The _Wow_themes_Envato_DAta object.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function convertObjectToArray($data) {
		    if (is_object($data)) {
		        $data = get_object_vars($data);
		    }

		    if (is_array($data)) {
		        return array_map(array($this, 'convertObjectToArray'), $data);
		    }

		    return $data;
		}

		protected function _get_json( $file, $decode = true ) {
			
			if ( is_file( dirname(__DIR__).'/content/'.basename( $file ) ) ) {

				if(!function_exists('WP_Filesystem')) require_once(ABSPATH . 'wp-admin/includes/file.php');
				WP_Filesystem();
				global $wp_filesystem;
				$file_name = dirname(__DIR__) . '/content/' . basename( $file );

				if ( file_exists( $file_name ) ) {

					if( !$decode ) return $wp_filesystem->get_contents( $file_name ); 
					return json_decode( $wp_filesystem->get_contents( $file_name ), true );
				}
			}

			if( !$decode ) return null;

			return array();
		}

		protected function replace_pseudo( $options ) {
			
			if( is_array( $options ) )
			{
				foreach((array)$options as $k=>$v)
				{
					if(is_array($v)) $options[$k] = $this->replace_pseudo($v);
					else
					{
						$options[$k] = str_replace(array('{SH_TH_URL}', '{HOME_URL}', '{ADMIN_EMAIL}'), array(SH_TH_URL, home_url(), get_option('admin_email')), $v);
					}
				}
			}else{
				$options = str_replace(array('{SH_TH_URL}', '{HOME_URL}', '{ADMIN_EMAIL}'), array(SH_TH_URL, home_url(), get_option('admin_email')), $options);
			}
		
			return $options;
		}		

		/**
		 * Get configured TGMPA instance
		 *
		 * @access public
		 * @since 1.1.2
		 */
		public function get_tgmpa_instanse(){
			$this->tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		}

		/**
		 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
		 *
		 * @access public
		 * @since 1.1.2
		 */
		public function set_tgmpa_url(){

			$this->tgmpa_menu_slug = ( property_exists($this->tgmpa_instance, 'menu') ) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
			$this->tgmpa_menu_slug = apply_filters($this->theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug);

			$tgmpa_parent_slug = ( property_exists($this->tgmpa_instance, 'parent_slug') && $this->tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';

			$this->tgmpa_url = apply_filters($this->theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug.'?page='.$this->tgmpa_menu_slug);

		}


		/**
		 * Page setup
		 */
		public function envato_setup_default_plugins() {

			tgmpa_load_bulk_installer();
			// install plugins with TGM.
			if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
				die( 'Failed to find TGM' );
			}
			$url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'envato-setup' );
			$plugins = $this->_get_plugins();

			// copied from TGM

			$method = ''; // Leave blank so WP_Filesystem can populate it as necessary.
			$fields = array_keys( $_POST ); // Extra fields to pass to WP_Filesystem.

			if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
				return true; // Stop the normal page form from displaying, credential request form will be shown.
			}

			// Now we have some credentials, setup WP_Filesystem.
			if ( ! WP_Filesystem( $creds ) ) {
				// Our credentials were no good, ask the user for them again.
				request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );

				return true;
			}

			/* If we arrive here, we have the filesystem */

			?>
			<h1><?php _e( 'Default Plugins', 'hash' ); ?></h1>
			<form method="post">

				<?php
				$plugins = $this->_get_plugins();
				if ( count( $plugins['all'] ) ) {
					?>
					<p><?php _e( 'Your website needs a few essential plugins. The following plugins will be installed:', 'hash' ); ?></p>
					<ul class="envato-wizard-plugins">
						<?php foreach ( $plugins['all'] as $slug => $plugin ) {  ?>
							<li data-slug="<?php echo esc_attr( $slug );?>"><?php echo esc_html( $plugin['name'] );?>
								<span>
    								<?php
								    $keys = array();
								    if ( isset( $plugins['install'][ $slug ] ) ) { $keys[] = 'Installation'; }
								    if ( isset( $plugins['update'][ $slug ] ) ) { $keys[] = 'Update'; }
								    if ( isset( $plugins['activate'][ $slug ] ) ) { $keys[] = 'Activation'; }
								    echo implode( ' and ',$keys ).' required';
								    ?>
    							</span>
								<div class="spinner"></div>
							</li>
						<?php } ?>
					</ul>
					<?php
				} else {
					echo '<p><strong>'._e( 'Good news! All plugins are already installed and up to date. Please continue.','hash' ).'</strong></p>';
				} ?>

				<p><?php _e( 'You can add and remove plugins later on from within WordPress.', 'hash' ); ?></p>

				<p class="envato-setup-actions step">
					<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="button-primary button button-large button-next" data-callback="install_plugins"><?php _e( 'Continue', 'hash' ); ?></a>
					<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="button button-large button-next"><?php _e( 'Skip this step', 'hash' ); ?></a>
					<?php wp_nonce_field( 'envato-setup' ); ?>
				</p>
			</form>
			<?php
		}


		public function ajax_plugins() {
			if ( ! check_ajax_referer( 'envato_setup_nonce', 'wpnonce' ) || empty( $_POST['slug'] ) ) {
				wp_send_json_error( array( 'error' => 1, 'message' => __( 'No Slug Found','hash' ) ) );
			}
			$json = array();
			// send back some json we use to hit up TGM
			$plugins = $this->_get_plugins();
			// what are we doing with this plugin?
			foreach ( $plugins['activate'] as $slug => $plugin ) {
				if ( $_POST['slug'] == $slug ) {
					$json = array(
						'url' => admin_url( $this->tgmpa_url ),
						'plugin' => array( $slug ),
						'tgmpa-page' => $this->tgmpa_menu_slug,
						'plugin_status' => 'all',
						'_wpnonce' => wp_create_nonce( 'bulk-plugins' ),
						'action' => 'tgmpa-bulk-activate',
						'action2' => -1,
						'message' => __( 'Activating Plugin','hash' ),
					);
					break;
				}
			}
			foreach ( $plugins['update'] as $slug => $plugin ) {
				if ( $_POST['slug'] == $slug ) {
					$json = array(
						'url' => admin_url( $this->tgmpa_url ),
						'plugin' => array( $slug ),
						'tgmpa-page' => $this->tgmpa_menu_slug,
						'plugin_status' => 'all',
						'_wpnonce' => wp_create_nonce( 'bulk-plugins' ),
						'action' => 'tgmpa-bulk-update',
						'action2' => -1,
						'message' => __( 'Updating Plugin','hash' ),
					);
					break;
				}
			}
			foreach ( $plugins['install'] as $slug => $plugin ) {
				if ( $_POST['slug'] == $slug ) {
					$json = array(
						'url' => admin_url( $this->tgmpa_url ),
						'plugin' => array( $slug ),
						'tgmpa-page' => $this->tgmpa_menu_slug,
						'plugin_status' => 'all',
						'_wpnonce' => wp_create_nonce( 'bulk-plugins' ),
						'action' => 'tgmpa-bulk-install',
						'action2' => -1,
						'message' => __( 'Installing Plugin','hash' ),
					);
					break;
				}
			}

			if ( $json ) {
				$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
				wp_send_json( $json );
			} else {
				wp_send_json( array( 'done' => 1, 'message' => __( 'Success','hash' ) ) );
			}
			exit;

		}

		private function _get_plugins() {
			$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
			$plugins = array(
				'all'      => array(), // Meaning: all plugins which still have open actions.
				'install'  => array(),
				'update'   => array(),
				'activate' => array(),
			);

			foreach ( $instance->plugins as $slug => $plugin ) {
				if ( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
					// No need to display plugins if they are installed, up-to-date and active.
					continue;
				} else {
					$plugins['all'][ $slug ] = $plugin;

					if ( ! $instance->is_plugin_installed( $slug ) ) {
						$plugins['install'][ $slug ] = $plugin;
					} else {
						if ( false !== $instance->does_plugin_have_update( $slug ) ) {
							$plugins['update'][ $slug ] = $plugin;
						}

						if ( $instance->can_plugin_activate( $slug ) ) {
							$plugins['activate'][ $slug ] = $plugin;
						}
					}
				}
			}
			return $plugins;
		}


	}

}