<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Iconic_WQV_Settings.
 *
 * Settings for Quickview.
 *
 * @class    Iconic_WQV_Settings
 * @version  1.0.0
 * @author   Iconic
 */
class Iconic_WQV_Settings {

	/*
	 * Variable to hold settings framework instance
	 *
	 * @var WordPressSettingsFramework
	 */
	public $settings_framework = null;

	/*
	 * Settings
	 *
	 * @var arr|null
	 */
	public $settings = null;

	/*
	 * Page Title
	 *
	 * @var str|null
	 */
	public $page_title = null;

	/*
	 * Menu Title
	 *
	 * @var str|null
	 */
	public $menu_title = null;

	/**
	 * Init settings
	 */
	public function __construct( $settings_path = null, $option_group = null, $page_title = null, $menu_title = null ) {

		self::transition_settings();

		$page_title and $this->page_title = $page_title;
		$menu_title and $this->menu_title = $menu_title;

		require_once( 'vendor/wp-settings-framework/wp-settings-framework.php' );

		$this->settings_framework = new WordPressSettingsFramework( $settings_path, $option_group );
		$this->settings           = $this->settings_framework->get_settings();

		// Add admin menu
		add_action( 'admin_menu', array( $this, 'add_settings_page' ), 20 );

		// Validate Settings
		add_filter( 'iconic_woo_quickview_settings_validate', array( $this, 'validate_settings' ), 10, 1 );

	}

	/**
	 * Settings: Transition old settings to new
	 */
	public static function transition_settings() {
		$new_settings = get_option( 'jckqv_settings' );
		$old_settings = get_option( 'jckqvsettings_settings' );

		if ( $old_settings && ! $new_settings ) {

			$new_settings = array();

			foreach ( $old_settings as $field_id => $value ) {

				$field_id = str_replace( array( 'popup_', 'trigger_' ), '', $field_id );

				$new_settings[ $field_id ] = $value;

			}

			update_option( 'jckqv_settings', $new_settings );

		}
	}

	/**
	 * Admin: Add settings menu item
	 */
	public function add_settings_page() {

		$this->settings_framework->add_settings_page( array(
			'parent_slug' => 'woocommerce',
			'page_title'  => $this->page_title,
			'menu_title'  => $this->menu_title,
			'capability'  => 'manage_woocommerce',
		) );

	}

	/**
	 * Admin: Validate Settings
	 *
	 * @param arr $settings Un-validated settings
	 *
	 * @return arr $validated_settings
	 */
	public function validate_settings( $settings ) {

		// add_settings_error( $setting, esc_attr( 'iconic-woothumbs-error' ), $message, 'error' );

		return $settings;

	}

	/**
	 * Documentation link.
	 */
	public static function documentation_link() {

		return sprintf( '<a href="http://docs.iconicwp.com/category/18-quickview" class="button button-secondary" target="_blank">%s</a>', __( 'Read Documentation', 'jckpc' ) );

	}
}