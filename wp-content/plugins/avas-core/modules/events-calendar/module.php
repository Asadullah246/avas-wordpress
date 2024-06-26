<?php
namespace AvasElements\Modules\EventsCalendar;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-events-calendar';
	}

	public function get_widgets() {
		$widgets = [
			'EventsCalendar',
		];

		return $widgets;
	}
}
