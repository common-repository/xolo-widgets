<?php
/**
 * Xolo Widgets - Loader.
 *
 * @package Xolo Widget
 * @since 1.0.0
 */

if ( ! class_exists( 'Xolo_Widgets_Loader' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since 1.0.0
	 */
	class Xolo_Widgets_Loader {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {


			// Add Widget.
			require_once XOLO_WIDGETS_DIR . 'classes/widgets/class-social-icons.php';
			require_once XOLO_WIDGETS_DIR . 'classes/widgets/class-social-widget.php';
			require_once XOLO_WIDGETS_DIR . 'classes/widgets/class-widget-contact.php';

			 add_action( 'widgets_init', array( $this, 'register_xolo_widgets' ) );
			 add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			 add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		}
		
		function enqueue_scripts() {
				wp_enqueue_style( 'xolo-front-widget-css', XOLO_WIDGETS_URI . '/assets/css/widget.css', false );		
				wp_enqueue_style('font-awesome',XOLO_WIDGETS_URI .'/assets/css/font-awesome/css/font-awesome.min.css');
			}
			
		function enqueue_admin_scripts() {
			 wp_enqueue_style( 'wp-color-picker');
			 
			 wp_enqueue_script( 'xolo-social-icon-widget-js', XOLO_WIDGETS_URI .'/assets/js/main.js', array( 'jquery', 'jquery-ui-sortable' ) );
			 
			 wp_enqueue_style( 'xolo-social-icon-widget-css', XOLO_WIDGETS_URI . '/assets/css/admin.css', false );
			 
			 wp_enqueue_style('font-awesome',XOLO_WIDGETS_URI .'/assets/css/font-awesome/css/font-awesome.min.css');
			 
			 wp_enqueue_style( 'xolo-icon-picker-css', XOLO_WIDGETS_URI . '/assets/fonticonpicker/jquery.fonticonpicker.min.css', false );
			 
			 wp_enqueue_script( 'wp-color-picker');
			 
			 wp_enqueue_script( 'xolo-icon-picker-js', XOLO_WIDGETS_URI .'/assets/fonticonpicker/jquery.fonticonpicker.min.js', array( 'jquery', 'jquery-ui-sortable' ) );
		}
		
		/**
		 * Regiter List Icons widget
		 *
		 * @return void
		 */
		function register_xolo_widgets() {
			register_widget( 'xolo_social_icon_widget' );
			register_widget( 'xolo_contact_widget' );
		}
		
	}
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
Xolo_Widgets_Loader::get_instance();
