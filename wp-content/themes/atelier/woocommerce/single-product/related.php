<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
		
if ( $related_products ) :

	global $atelier_options, $sf_carouselID, $woocommerce_loop, $atelier_product_display_type, $atelier_product_display_layout;

	if ($sf_carouselID == "") {
	$sf_carouselID = 1;
	} else {
	$sf_carouselID++;
	}

	$product_display_type = $atelier_options['product_display_type'];
	$product_display_gutters = $atelier_options['product_display_gutters'];
	$related_heading = __( $atelier_options['related_heading_text'] , 'atelier' );
	$related_product_display_type = $product_display_type;
	if ( isset($atelier_options['related_product_display_type']) ) {
		$related_product_display_type = $atelier_options['related_product_display_type'];
	}
	$woocommerce_loop['style-override'] = $related_product_display_type;

	// Set global
	$atelier_product_display_type = $related_product_display_type;

	$gutter_class = "";

	if (!$product_display_gutters && $related_product_display_type == "gallery") {
		$gutter_class = 'no-gutters';
	} else {
		$gutter_class = 'gutters';
	}

	$woocommerce_loop['columns'] = 4;

	?>

	<div class="product-carousel related-products spb_content_element carousel-wrap">

		<div class="title-wrap clearfix">
			<h3 class="spb-heading"><span><?php echo esc_attr($related_heading); ?></span></h3>
			<div class="carousel-arrows"><a href="#" class="carousel-prev"><i class="sf-icon-chevron-prev"></i></a><a href="#" class="carousel-next"><i class="sf-icon-chevron-next"></i></a></div>
		</div>

		<div class="related products carousel-items <?php echo esc_attr($gutter_class); ?> product-type-<?php echo esc_attr($related_product_display_type); ?>" id="carousel-<?php echo esc_attr($sf_carouselID); ?>" data-columns="4">
						
			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
				 	$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' ); ?>

			<?php endforeach; ?>

		</div>

	</div>

<?php endif;

global $sf_include_carousel, $sf_include_isotope;
$sf_include_carousel = true;
$sf_include_isotope = true;

wp_reset_postdata();
	