<?php

namespace NoxfolioToolkit\ElementorAddon\Helper;

defined('ABSPATH') || exit;

class Noxfolio_Icons_Manager
{

	protected static $instance = null;

	public static function instance()
	{
		if (null === self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct()
	{
		add_filter('elementor/icons_manager/additional_tabs', [$this, 'add_icons_tab']);
	}

	public function add_icons_tab($tabs)
	{
		$icon_css = NT_VENDOR . '/flaticon/flaticon_noxfolio.css';

		$tabs['noxfolio-flaticon'] = [
			'name'          => 'noxfolio-flaticon',
			'label'         => esc_html__('Noxfolio Icons', 'noxfolio-toolkit'),
			'url'           => $icon_css,
			'prefix'        => '',
			'displayPrefix' => '',
			'labelIcon'     => 'far fa-folder-open',
			'ver'           => '1.0',
			'icons'         => $this->icon_list(),
			'native'        => true,
		];

		return $tabs;
	}

	public function icon_list()
	{
		return [
			"flaticon-check-mark",
			"flaticon-idea",
			"flaticon-vector",
			"flaticon-web-designing",
			"flaticon-editor",
			"flaticon-asterisk",
			"flaticon-email-marketing",
			"flaticon-sustainability",
			"flaticon-double-quotes",
			"flaticon-add",
			"flaticon-ads"

		];
	}
}

Noxfolio_Icons_Manager::instance();
