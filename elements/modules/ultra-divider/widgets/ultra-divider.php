<?php
namespace UltraElements\Modules\UltraDivider\Widgets;

/**
 * Ultra Divider Module
 *
 * @link       https://enriquechavez.co
 * @since      1.0.0
 *
 * @package    Elements
 * @subpackage Elements/public
 */

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class UltraDivider extends Widget_Base {

	public function get_name() {
		return 'ultra-divider';
	}

	public function get_title() {
		return __( 'Divider', 'ultra-elements' );
	}

	public function get_icon() {
		return 'eicon-divider';
	}

	public function get_categories() {
		return [ 'ultra-elements-category' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Icon', 'ultra-elements' ),
			]
		);

		$this->add_control(
			'icon',
			[
				'label'       => __( 'Icon', 'elementor' ),
				'type'        => Controls_Manager::ICON,
				'label_block' => true,
				'default'     => 'fa fa-circle',
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Icon Color', 'ultra-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#B2B2B2',
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .ultra-divider i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'alignment',
			[
				'label'   => __( 'Alignment', 'ultra-elements' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'left'   => __( 'Left', 'ultra-elements' ),
					'center' => __( 'Center', 'ultra-elements' ),
					'right'  => __( 'Right', 'ultra-elements' ),
				],
				'default' => 'left',
			]
		);

		$this->add_control(
			'icon_rounded',
			[
				'label'        => __( 'Rounded Icon', 'elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => 'Yes',
				'label_off'    => 'No',
				'return_value' => 'ultra-divider-rounded',
			]
		);

		$this->add_control(
			'icon_rounded_bg',
			[
				'label'     => __( 'Icon Background Color', 'ultra-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e0e0e0',
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'condition' => [
					'icon_rounded' => 'ultra-divider-rounded',
				],
				'selectors' => [
					'{{WRAPPER}} .ultra-divider.ultra-divider-rounded i' => 'background-color: {{VALUE}};'
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_line',
			[
				'label' => __( 'Line', 'ultra-elements' ),
			]
		);

		$this->add_control(
			'size',
			[
				'label'   => __( 'Size', 'ultra-elements' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'full'  => __( 'Full', 'ultra-elements' ),
					'short' => __( 'Short', 'ultra-elements' ),

				],
				'default' => 'full',
			]
		);

		$this->add_control(
			'line_color',
			[
				'label'     => __( 'Line Color', 'ultra-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#E5E5E5',
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .ultra-divider' => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_section();
	}

	protected function render() {
		$instance     = $this->get_settings();
		$alignment    = '';
		$size         = '';
		$icon         = $instance['icon'];
		$icon_rounded = $instance['icon_rounded'];
		$template     = '<div class="ultra-divider %s %s %s"><i class="%s"></i></div>';
		switch ( $instance['alignment'] ) {
			case 'center';
				$alignment .= 'ultra-divider-center';
				break;
			case 'right':
				$alignment .= 'ultra-divider-right';
				break;
		}

		switch ( $instance['size'] ) {
			case 'short':
				$size = 'ultra-divider-short';
		}
		echo sprintf( $template, $alignment, $size, $icon_rounded, $icon );
	}
}
