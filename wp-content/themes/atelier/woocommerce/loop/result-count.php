<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/result-count.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $woocommerce, $wp_query, $atelier_options;

$products_per_page = $atelier_options['products_per_page'];

$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );

if ( is_tax( 'product_cat' ) ) {
    $product_category      = $wp_query->query_vars['product_cat'];
    $product_category_link = get_term_link( $product_category, 'product_cat' );

    if ( $product_category_link != "" ) {
        $shop_page_url = $product_category_link;
    } else {
        $shop_page_url = "";
    }
}

if ( ! woocommerce_products_will_display() ) {
    return;
}
?>
<div class="woocommerce-count-wrap">
    <p class="woocommerce-result-count">
        <?php
        if ( 1 === $total ) {
            _e( 'Showing the single result', 'atelier' );
        } elseif ( $total <= $per_page || -1 === $per_page ) {
            /* translators: %d: total results */
            printf( _n( 'Showing all %d result', 'Showing all %d results', $total, 'atelier' ), $total );
        } else {
            $first = ( $per_page * $current ) - $per_page + 1;
            $last  = min( $total, $per_page * $current );
            /* translators: 1: first result 2: last result 3: total results */
            printf( _nx( 'Showing %1$d&ndash;%2$d of %3$d result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, 'with first and last result', 'atelier' ), $first, $last, $total );
        }
        ?>
	</p>
    <?php if ( $total > $per_page && $current == 1 && is_numeric($products_per_page)) { ?>
    <p class="woocommerce-show-products">
        <span><?php _e( "View", 'atelier' ); ?> </span>
        <a class="show-products-link"
           href="?show_products=<?php echo esc_attr($products_per_page); ?>"><?php echo esc_attr($products_per_page); ?></a>/<a
            class="show-products-link"
            href="?show_products=<?php echo esc_attr($products_per_page * 2); ?>"><?php echo esc_attr($products_per_page * 2); ?></a>/<a
            class="show-products-link"
            href="?show_products=<?php echo esc_attr($total); ?>"><?php _e( "All", 'atelier' ); ?></a>
    </p>
    <?php } ?>
</div>