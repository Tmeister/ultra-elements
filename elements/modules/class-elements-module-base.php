<?php
namespace UltraElements\Base;

/**
 * The Module Base Class
 *
 * @link       https://enriquechavez.co
 * @since      1.0.0
 *
 * @package    Elements
 * @subpackage Elements/public
 */
abstract class Module_Base {

	/**
	 * @var \ReflectionClass
	 */
	private $reflection;

	private $components = [];

	/**
	 * @var Module_Base
	 */
	protected static $_instances = [];

	/**
	 * Throw error on object clone
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'elementor-pro' ), '1.0.0' );
	}

	/**
	 * Disable unserializing of the class
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'elementor-pro' ), '1.0.0' );
	}

	public static function class_name() {
		return get_called_class();
	}

	/**
	 * @return static
	 */
	public static function instance() {
		if ( empty( static::$_instances[ static::class_name() ] ) ) {
			static::$_instances[ static::class_name() ] = new static();
		}

		return static::$_instances[ static::class_name() ];
	}

	abstract public function get_name();

	public function get_assets_url() {
		return plugin_dir_url( __FILE__ ) . 'elements/modules/' . $this->get_name() . '/assets/';
	}

	public function get_widgets() {
		return [];
	}

	public function __construct() {
		$this->reflection = new \ReflectionClass( $this );

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
	}

	public function init_widgets() {
		$widget_manager = \Elementor\Plugin::instance()->widgets_manager;

		require plugin_dir_path( dirname( __FILE__ ) ) . 'modules/' . $this->get_name() . '/widgets/' . $this->get_name() . '.php';
		foreach ( $this->get_widgets() as $widget ) {
			$class_name = $this->reflection->getNamespaceName() . '\Widgets\\' . $widget;
			$widget_manager->register_widget_type( new $class_name() );
		}
	}

	public function add_component( $id, $instance ) {
		$this->components[ $id ] = $instance;
	}

	public function get_component( $id ) {
		if ( isset( $this->components[ $id ] ) ) {
			return $this->components[ $id ];
		}

		return false;
	}
}
