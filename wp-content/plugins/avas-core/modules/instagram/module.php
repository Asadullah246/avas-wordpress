<?php
namespace AvasElements\Modules\Instagram;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-instagram';
	}

	public function get_widgets() {
		$widgets = [
			'Instagram',
		];

		return $widgets;
	}
}
