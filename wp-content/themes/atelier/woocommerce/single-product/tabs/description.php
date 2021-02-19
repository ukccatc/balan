<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post;

$pb_active = atelier_get_post_meta($post->ID, '_spb_status', true);
if ($pb_active != "true") {
	$pb_active = atelier_get_post_meta($post->ID, '_spb_js_status', true);
	if ($pb_active != "true") {
		$pb_active = false;
	}
}

$product_description = atelier_get_post_meta($post->ID, 'sf_product_description', true);
if ($product_description == "") {
	$product_description = $post->post_excerpt;
}
if (substr($product_description, 0, 4) === '[spb') {
	$product_description = "";
	$pb_active = true;
}
?>

<?php 
if ($pb_active) {
	echo do_shortcode(atelier_add_formatting($product_description));
} else {
	the_content();
}
?>