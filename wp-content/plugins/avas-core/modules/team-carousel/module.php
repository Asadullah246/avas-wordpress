<?php
namespace AvasElements\Modules\TeamCarousel;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-team-carousel';
	}

	public function get_widgets() {
		$widgets = [
			'TeamCarousel',
		];

		return $widgets;
	}
}
