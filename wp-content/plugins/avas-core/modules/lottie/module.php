<?php
namespace AvasElements\Modules\Lottie;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-lottie';
	}

	public function get_widgets() {
		$widgets = [
			'Lottie',
		];

		return $widgets;
	}
}
