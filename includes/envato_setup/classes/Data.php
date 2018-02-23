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

require_once dirname(__FILE__).'/Plugins.php';

if(!class_exists('_Wow_Themes_Envato_Data'))
{

	class _Wow_Themes_Envato_Data extends _Wow_Themes_Envato_Plugins
	//class _Wow_Themes_Envato_Data
	{
		
		function __construct()
		{
			add_action('init', array($this, 'data_init'));
		}

		function data_init()
		{

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




		private function _content_default_get() {

			$content = array();

			$content['pages'] = array(
				'title' => __( 'Pages', 'hash' ),
				'description' => __( 'This will create default pages as seen in the demo.', 'hash' ),
				'pending' => __( 'Pending.', 'hash' ),
				'installing' => __( 'Installing Default Pages.', 'hash' ),
				'success' => __( 'Success.', 'hash' ),
				'install_callback' => array( $this,'_content_install_pages' ),
			);
			/*$content['products'] = array(
				'title' => __( 'Products', 'hash' ),
				'description' => __( 'Insert default shop products and categories as seen in the demo.', 'hash' ),
				'pending' => __( 'Pending.', 'hash' ),
				'installing' => __( 'Installing Default Products.', 'hash' ),
				'success' => __( 'Success.', 'hash' ),
				'install_callback' => array( $this,'_content_install_products' ),
			);*/
			$content['widgets'] = array(
				'title' => __( 'Widgets', 'hash' ),
				'description' => __( 'Insert default sidebar widgets as seen in the demo.', 'hash' ),
				'pending' => __( 'Pending.', 'hash' ),
				'installing' => __( 'Installing Default Widgets.', 'hash' ),
				'success' => __( 'Success.', 'hash' ),
				'install_callback' => array( $this,'_content_install_widgets' ),
			);
			$content['menu'] = array(
				'title' => __( 'Menu', 'hash' ),
				'description' => __( 'Insert default menu as seen in the demo.', 'hash' ),
				'pending' => __( 'Pending.', 'hash' ),
				'installing' => __( 'Installing Default Menu.', 'hash' ),
				'success' => __( 'Success.', 'hash' ),
				'install_callback' => array( $this,'_content_install_menu' ),
			);
			$content['settings'] = array(
				'title' => __( 'Settings', 'hash' ),
				'description' => __( 'Configure default settings.', 'hash' ),
				'pending' => __( 'Pending.', 'hash' ),
				'installing' => __( 'Installing Default Settings.', 'hash' ),
				'success' => __( 'Success.', 'hash' ),
				'install_callback' => array( $this,'_content_install_settings' ),
			);

			return $content;

		}


		/**
		 * Page setup
		 */
		public function envato_setup_default_content() {
			?>
			<h1><?php _e( 'Default Content', 'hash' ); ?></h1>
			<form method="post">
				<p><?php printf( __( 'It\'s time to insert some default content for your new WordPress website. Choose what you would like inserted below and click Continue.', 'hash' ), '<a href="' . esc_url( admin_url( 'edit.php?post_type=page' ) ) . '" target="_blank">', '</a>' ); ?></p>
				<table class="envato-setup-pages" cellspacing="0">
					<thead>
					<tr>
						<td class="check"> </td>
						<th class="item"><?php _e( 'Item', 'hash' ); ?></th>
						<th class="description"><?php _e( 'Description', 'hash' ); ?></th>
						<th class="status"><?php _e( 'Status', 'hash' ); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ( $this->_content_default_get() as $slug => $default ) {  ?>
						<tr class="envato_default_content" data-content="<?php echo esc_attr( $slug );?>">
							<td>
								<input type="checkbox" name="default_content[pages]" class="envato_default_content" id="default_content_<?php echo esc_attr( $slug );?>" value="1" checked>
							</td>
							<td><label for="default_content_<?php echo esc_attr( $slug );?>"><?php echo $default['title']; ?></label></td>
							<td class="description"><?php echo $default['description']; ?></td>
							<td class="status"> <span><?php echo $default['pending'];?></span> <div class="spinner"></div></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>

				<p><?php _e( 'Once inserted, this content can be managed from the WordPress admin dashboard.', 'hash' ); ?></p>

				<p class="envato-setup-actions step">
					<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="button-primary button button-large button-next" data-callback="install_content"><?php _e( 'Continue', 'hash' ); ?></a>
					<a href="<?php echo esc_url( $this->get_next_step_link() ); ?>" class="button button-large button-next"><?php _e( 'Skip this step', 'hash' ); ?></a>
					<?php wp_nonce_field( 'envato-setup' ); ?>
				</p>
			</form>
			<?php
		}


		public function ajax_content() {

			$content = $this->_content_default_get();
			if ( ! check_ajax_referer( 'envato_setup_nonce', 'wpnonce' ) || empty( $_POST['content'] ) && isset( $content[ $_POST['content'] ] ) ) {
				wp_send_json_error( array( 'error' => 1, 'message' => __( 'No content Found','hash' ) ) );
			}

			$json = false;
			$this_content = $content[ $_POST['content'] ];

			if ( isset( $_POST['proceed'] ) ) {
				// install the content!

				if ( ! empty( $this_content['install_callback'] ) ) {
					
					if ( $result = call_user_func( $this_content['install_callback'] ) ) {
						$json = array(
							'done' => 1,
							'message' => $this_content['success'],
							'debug' => $result,
						);
					}
				}
			} else {

				$json = array(
					'url' => admin_url( 'admin-ajax.php' ),
					'action' => 'envato_setup_content',
					'proceed' => 'true',
					'content' => $_POST['content'],
					'_wpnonce' => wp_create_nonce( 'envato_setup_nonce' ),
					'message' => $this_content['installing'],
				);
			}

			if ( $json ) {
				$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
				wp_send_json( $json );
			} else {
				wp_send_json( array( 'error' => 1, 'message' => __( 'Error','hash' ) ) );
			}

			exit;

		}

		private function _import_wordpress_xml_file( $xml_file_path ) {
			global $wpdb;

			if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) { define( 'WP_LOAD_IMPORTERS', true ); }

			// Load Importer API
			require_once ABSPATH . 'wp-admin/includes/import.php';

			if ( ! class_exists( 'WP_Importer' ) ) {
				$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
				if ( file_exists( $class_wp_importer ) ) {
					require $class_wp_importer;
				}
			}

			if ( ! class_exists( 'WP_Import' ) ) {
				$class_wp_importer = dirname(__DIR__) .'/importer/wordpress-importer.php';
				if ( file_exists( $class_wp_importer ) ) {
					require $class_wp_importer; 
				}
			}

			if ( class_exists( 'WP_Import' ) ) {
				require_once dirname(__DIR__) .'/importer/envato-content-import.php';
				$wp_import = new envato_content_import();
				$wp_import->fetch_attachments = true;
				ob_start();
				$wp_import->import( $xml_file_path );
				$message = ob_get_clean();
				return array( $wp_import->check(),$message );
			}
			return false;
		}

		private function _content_install_pages() {

			return $this->_import_wordpress_xml_file( dirname(__DIR__) .'/content/demo.xml' );
		}
		private function _content_install_products() {
			if ( $this->_import_wordpress_xml_file( dirname(__DIR__) .'/content/products.xml' ) ) {
				return $this->_import_wordpress_xml_file( dirname(__DIR__) .'/content/variations.xml' );
			}
			return false;
		}
		private function _get_menu_ids() {
			$menus = get_terms( 'nav_menu' );
			//print_r($menus);exit;
			$menu_ids = array();
			foreach ( $menus as $menu ) {
				if ( $menu->name == 'Menu 1' ) {
					$menu_ids['main_menu'] = $menu->term_id;
				} else if ( $menu->name == 'mobile-menu' ) {
					$menu_ids['mobile_menu'] = $menu->term_id;
				}
			}
			return $menu_ids;
		}
		private function _content_install_menu() {
			//if($this->_import_wordpress_xml_file(__DIR__ ."/content/menu.xml")){
			$menu_ids = $this->_get_menu_ids();//print_r($menu_ids);exit;
			$save = array();
			if ( isset( $menu_ids['main_menu'] ) ) {
				$save['main_menu'] = $menu_ids['main_menu'];
			}
			if ( isset( $menu_ids['mobile_menu'] ) ) {
				$save['mobile_menu'] = $menu_ids['mobile_menu'];
			}
			if ( $save ) {
				set_theme_mod( 'nav_menu_locations', array_map( 'absint', $save ) );
				return true;
			}
			//}
			return false;
		}

		private function _content_install_widgets() {
			// todo: pump these out into the 'content/' folder along with the XML so it's a little nicer to play with
			
			$import_widget_positions = $this->_get_json( 'widgets_settings', false );
			$data = (array)json_decode($this->replace_pseudo($import_widget_positions));
			//print_r($data);exit;
			if( ! isset($data['settings']) || ! isset($data['sidebars'])) return;
			
			foreach($data['settings'] as $k=>$v)
			{
				
				update_option('widget_'.$k, $this->convertObjectToArray($v));
			}
			
			/** Now update sidebars settings */
			update_option('sidebars_widgets', $this->convertObjectToArray($data['sidebars']));

			
			/** Now Setup theme options */
			$import_widget_positions = $this->_get_json( 'theme_options_settings', false );
			$data = $this->convertObjectToArray(json_decode($this->replace_pseudo($import_widget_positions)) );
			
			
			update_option( '_cs_options', $data );
			

			return true;

		}
		private function _content_install_settings() {

			$custom_options = $this->_get_json( 'options.json' );

			// we also want to update the widget area manager options.
			foreach ( $custom_options as $option => $value ) {
				update_option( $option, $value );
			}
			// set full width page
			$aboutpage = get_page_by_title( 'Full Width Page' );
			if ( $aboutpage ) {
				//"wam__position_126_main":"pos_hidden"
				update_option( 'wam__position_' . $aboutpage->ID . '_main', 'pos_hidden' );
			}
			// set full sidebar widgets page on about
			$aboutpage = get_page_by_title( 'About' );
			if ( $aboutpage ) {
				update_option( 'wam__area_' . $aboutpage->ID . '_main', 'widget_area-6' );
			}
			// set the blog page and the home page.
			$shoppage = get_page_by_title( 'Shop' );
			if ( $shoppage ) {
				update_option( 'woocommerce_shop_page_id',$shoppage->ID );
			}
			$homepage = get_page_by_title( 'HOME ONE' );
			if ( $homepage ) {
				update_option( 'page_on_front', $homepage->ID );
				update_option( 'show_on_front', 'page' );
			}
			$blogpage = get_page_by_title( 'BLOG' );
			if ( $blogpage ) {
				update_option( 'page_for_posts', $blogpage->ID );
				update_option( 'show_on_front', 'page' );
			}

			return true;
		}
	}

}
new _Wow_Themes_Envato_Data;