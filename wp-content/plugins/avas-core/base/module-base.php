<?php
namespace AvasElements\Base;

use Elementor\Core\Base\Module;
use AvasElements\TX_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

abstract class Module_Base extends Module {

	public function get_widgets() {
		return [];
	}

	public function __construct() {
		add_action( 'elementor/widgets/register', [$this, 'init_widgets']);
	}

	public function init_widgets() {
		$widget_manager = TX_Load::elementor()->widgets_manager;

		foreach ( $this->get_widgets() as $widget ) {
			$class_name = $this->get_reflection()->getNamespaceName() . '\Widgets\\' . $widget;

			$widget_manager->register(new $class_name());
		}
	}
}
