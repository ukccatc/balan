<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */

if (!function_exists('atelier_add_desc_tab')) {
	function atelier_add_desc_tab($tabs = array()) {
		global $post;
		$product_description = "";
		$pb_active = atelier_get_post_meta($post->ID, '_spb_status', true);
		if ($pb_active != "true") {
			$pb_active = atelier_get_post_meta($post->ID, '_spb_js_status', true);
			if ($pb_active != "true") {
				$pb_active = false;
			}
		}
		
		if ( $pb_active ) {
		$product_description = atelier_get_post_meta($post->ID, 'sf_product_description', true);
		} else {
		$product_description = get_the_content();
		}
		
		if ($product_description != "") {
			$tabs['description'] = array(
				'title'    => __( 'Description', 'atelier' ),
				'priority' => 10,
				'callback' => 'woocommerce_product_description_tab'
			);
		}
		return $tabs;
	}
	add_filter('woocommerce_product_tabs', 'atelier_add_desc_tab', 0);
}

$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

global $atelier_options;
//$enable_default_tabs = $atelier_options['enable_default_tabs'];
$enable_default_tabs = true;

if ( ! empty( $product_tabs ) ) : ?>

	<?php if ($enable_default_tabs) { ?>

	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="tabs wc-tabs" role="tablist">
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
					<a href="#tab-<?php echo esc_attr( $key ); ?>">
						<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
				<?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
				?>
			</div>
		<?php endforeach; ?>

		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>

	<?php } else { ?>

		<div class="panel-group" id="product-accordion">

			<?php foreach ( $product_tabs as $key => $tab ) : ?>
			<div class="panel">
				<div class="panel-heading">
					<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#product-accordion" href="#product-<?php echo esc_attr($key); ?>">
						<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
					</a>
		    	</div>
		    	<div id="product-<?php echo esc_attr($key); ?>" class="accordion-body collapse">
		      		<div class="accordion-inner">
		      			<?php
						if ( isset( $product_tab['callback'] ) ) {
							call_user_func( $product_tab['callback'], $key, $product_tab );
						}
						?>
		      		</div>
		  		</div>
			</div>
			<?php endforeach; ?>

		</div>

	<?php } ?>

<?php endif; ?>
