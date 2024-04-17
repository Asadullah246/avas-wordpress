<?php
namespace AvasElements\Modules\Team;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-team';
	}

	public function get_widgets() {
		$widgets = [
			'Team',
		];

		return $widgets;
	}
}
