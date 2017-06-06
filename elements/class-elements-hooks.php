<?php

namespace UltraElements;

use Elementor;

/**
 * The elements Hooks Manager
 *
 * @link       https://enriquechavez.co
 * @since      1.0.0
 *
 * @package    Elements
 * @subpackage Elements/public
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Elements
 * @subpackage Elements/admin
 * @author     Enrique Chavez <me@enriquechavez.co>
 */
class Elements_Hooks {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Verify if Elementor is loaded and up to date
	 *
	 * @since    1.0.0
	 */
	public function verify_if_elementor_is_loaded() {
		$elementor_version_required = '1.4.0';

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'elementor_not_installed' ] );
		}

		if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'elementor_out_of_date' ] );
		}
	}

	/**
	 * Add the admin notice if elementor is not installed
	 *
	 * @since    1.0.0
	 */
	public function elementor_not_installed() {
		$class   = 'notice notice-error is-dismissible';
		$message = __( 'Irks! An error has occurred.', 'elements' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	}

	/**
	 * Add the admin notice if elementor is not up to date
	 *
	 * @since    1.0.0
	 */
	public function elementor_out_of_date() {
		$class   = 'notice notice-error is-dismissible';
		$message = __( 'Irks! An error has occurred out of date.', 'elements' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	}

	/**
	 * Add the Elements Category on the panel
	 *
	 * @since    1.0.0
	 */
	public function register_category() {
		if ( defined( 'ELEMENTOR_PATH' ) && class_exists( 'Elementor\Widget_Base' ) ) {
			$options = [
				'title' => __( 'Ultra Elements', 'elements' ),
				'icon'  => 'font',
			];

			Elementor\Plugin::instance()->elements_manager->add_category( 'ultra-elements-category', $options, 1 );
		}
	}

	public function register_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../assets/css/ultra-elements.min.css', array(), $this->version, 'all' );
	}

}
