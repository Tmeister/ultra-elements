<?php
namespace UltraElements;

/**
 * The elements Modules Manager
 *
 * @link       https://enriquechavez.co
 * @since      1.0.0
 *
 * @package    Elements
 * @subpackage Elements/public
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

final class Elements_Manager {

	private $_modules = null;

	/**
	 * Elements_Manager constructor.
	 *
	 * Load all the modules according with the array
	 *
	 * since: 1.0.0
	 */
	public function __construct() {
		$modules = [
			'ultra-divider'
		];

		// Fetch all modules data
		foreach ( $modules as $module ) {
			$this->_modules[ $module ] = require plugin_dir_path( dirname( __FILE__ ) ) . 'elements/modules/' . $module . '/module.php';
		}

		foreach ( $this->_modules as $module_id => $module_data ) {
			$class_name = str_replace( '-', ' ', $module_id );
			$class_name = str_replace( ' ', '', ucwords( $class_name ) );
			$class_name = __NAMESPACE__ . '\\Modules\\' . $class_name . '\Module';

			$class_name::instance();
		}
	}
}
