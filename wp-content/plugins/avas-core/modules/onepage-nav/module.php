<?php
namespace AvasElements\Modules\OnepageNav;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-onepage-nav';
	}

	public function get_widgets() {
		$widgets = [
			'OnepageNav',
		];

		return $widgets;
	}
}
