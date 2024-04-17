<?php
namespace AvasElements\Modules\Breadcrumbs;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-breadcrumbs';
	}

	public function get_widgets() {
		$widgets = [
			'Breadcrumbs',
		];

		return $widgets;
	}
}
