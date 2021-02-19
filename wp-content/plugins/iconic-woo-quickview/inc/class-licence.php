<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Iconic_WQV_Licence.
 *
 * @class    Iconic_WQV_Licence
 * @version  1.0.0
 * @package  Iconic_WooThumbs
 * @category Class
 * @author   Iconic
 */
class Iconic_WQV_Licence {

	/**
	 * Run.
	 */
	public static function run() {
		self::configure();
		self::add_filters();
	}

	/**
	 * Configure.
	 */
	public static function configure() {

		global $iconic_woo_quickview_fs;

		if ( ! isset( $iconic_woo_quickview_fs ) ) {
			// Include Freemius SDK.
			require_once ICONIC_WQV_INC_PATH . 'freemius/start.php';

			$iconic_woo_quickview_fs = fs_dynamic_init( array(
				'id'                  => '1037',
				'slug'                => 'iconic-woo-quickview',
				'type'                => 'plugin',
				'public_key'          => 'pk_cbcb0552db131fd591137450c33d7',
				'is_premium'          => ! ICONIC_WQV_IS_ENVATO,
				'is_premium_only'     => ! ICONIC_WQV_IS_ENVATO,
				'has_premium_version' => ! ICONIC_WQV_IS_ENVATO,
				'has_paid_plans'      => ! ICONIC_WQV_IS_ENVATO,
				'has_addons'          => false,
				'is_org_compliant'    => false,
				'trial'               => array(
					'days'               => 14,
					'is_require_payment' => true,
				),
				'menu'                => array(
					'slug'    => 'jckqv-settings',
					'contact' => false,
					'support' => false,
					'account' => false,
					'pricing' => ! ICONIC_WQV_IS_ENVATO,
					'parent'  => array(
						'slug' => 'woocommerce',
					),
				),
			) );
		}

		return $iconic_woo_quickview_fs;

	}

	/**
	 * Add filters.
	 */
	public static function add_filters() {

		global $iconic_woo_quickview_fs;

		$iconic_woo_quickview_fs->add_filter( 'show_trial', '__return_false' );
		$iconic_woo_quickview_fs->add_filter( 'templates/account.php', array( __CLASS__, 'back_to_settings_link' ), 10, 1 );
		$iconic_woo_quickview_fs->add_filter( 'templates/billing.php', array( __CLASS__, 'back_to_settings_link' ), 10, 1 );
		add_filter( 'parent_file', array( __CLASS__, 'highlight_menu' ), 10, 1 );
		add_filter( 'plugin_action_links_' . ICONIC_WQV_BASENAME, array( __CLASS__, 'add_action_links' ) );

	}

	/**
	 * Highlight menu.
	 */
	public static function highlight_menu( $parent_file ) {
		global $plugin_page;

		$page = empty( $_GET['page'] ) ? false : $_GET['page'];

		if ( 'jckqv-settings-account' == $page ) {
			$plugin_page = 'jckqv-settings';
		}

		return $parent_file;
	}

	/**
	 * Account link.
	 */
	public static function account_link() {
		return sprintf( '<a href="%s" class="button button-secondary">%s</a>', admin_url( 'admin.php?page=jckqv-settings-account' ), __( 'Manage Licence', 'jckqv' ) );
	}

	/**
	 * Billing link.
	 */
	public static function billing_link() {
		return sprintf( '<a href="%s" class="button button-secondary">%s</a>', admin_url( 'admin.php?page=jckqv-settings-account&tab=billing' ), __( 'Manage Billing', 'jckqv' ) );
	}

	/**
	 * Contact link.
	 */
	public static function contact_link() {

		global $iconic_woo_quickview_fs;

		return sprintf( '<a href="%s" class="button button-secondary">%s</a>', $iconic_woo_quickview_fs->contact_url(), __( 'Create Support Ticket', 'jckqv' ) );

	}

	/**
	 * Get contact URL.
	 */
	public static function get_contact_url( $subject = false, $message = false ) {

		global $iconic_woo_quickview_fs;

		return $iconic_woo_quickview_fs->contact_url( $subject, $message );

	}

	/**
	 * Back to settings link.
	 */
	public static function back_to_settings_link( $html ) {
		return $html . sprintf( '<a href="%s" class="button button-secondary">&larr; %s</a>', admin_url( 'admin.php?page=jckqv-settings' ), __( 'Back to Settings', 'jckqv' ) );
	}

	/**
	 * Has valid licence.
	 *
	 * @return bool
	 */
	public static function has_valid_licence() {
		global $iconic_woo_quickview_fs;

		if ( ICONIC_WQV_IS_ENVATO || $iconic_woo_quickview_fs->can_use_premium_code() ) {
			return true;
		}

		return false;
	}

	/**
	 * Add changelog link.
	 *
	 * @param $links
	 *
	 * @return array
	 */
	public static function add_action_links( $links ) {
		$links[] = sprintf( '<a href="%s" target="_blank">%s</a>', 'https://iconicwp.com/products/woocommerce-quickview/changelog/?utm_source=iconic-woo-quickview&utm_medium=insideplugin', __( 'Changelog', 'jckqv' ) );

		return $links;
	}
}