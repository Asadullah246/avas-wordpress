<?php
namespace AvasElements\Modules\PostList;

use AvasElements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'avas-post-list';
	}

	public function get_widgets() {
		$widgets = [
			'PostList',
		];

		return $widgets;
	}
}
