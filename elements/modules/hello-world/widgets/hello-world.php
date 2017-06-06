<?php
namespace UltraElements\Modules\HelloWorld\Widgets;

use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class HelloWorld extends Widget_Base {

	public function get_name() {
		return 'helloworld';
	}

	public function get_title() {
		return __( 'HelloWorld', 'ultra-elements' );
	}

	public function get_icon() {
		return 'eicon-countdown';
	}

	public function get_categories() {
		return [ 'ultra-elements-category' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_countdown',
			[
				'label' => __( 'Hello World', 'ultra-elements' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$instance = $this->get_settings();
		?>
        <h1>Go the Hell!!!</h1>
		<?php
	}
}
