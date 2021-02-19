<?php 
global $woocommerce, $atelier_options;

$mobile_header_layout = $atelier_options['mobile_header_layout'];
$mobile_top_text      = __( $atelier_options['mobile_top_text'], 'atelier' );
$mobile_menu_icon     = apply_filters( 'atelier_mobile_menu_icon', '<span class="menu-bars"></span>' );
$mobile_cart_icon     = apply_filters( 'atelier_mobile_cart_icon', '<i class="ss-cart"></i>' );
$mobile_show_cart     = $atelier_options['mobile_show_cart'];

$mobile_header_class = "";
$mobile_header_output = "";

if ( $mobile_top_text != "" ) {
    echo '<div id="mobile-top-text">' . do_shortcode( $mobile_top_text ) . '</div>';
}

echo '<header id="mobile-header" class="mobile-' . $mobile_header_layout . ' clearfix">';

if ( $mobile_header_layout == "right-logo" ) {
    echo '<div class="mobile-header-opts">';
    echo '<a href="#" class="mobile-menu-link menu-bars-link">' . $mobile_menu_icon . '</a>';
    if ( $mobile_show_cart && $woocommerce != "" ) {
        echo '<nav class="std-menu float-alt-menu">';
	    echo '<ul class="menu">';
		echo atelier_get_cart();
		echo '</ul>';
	    echo '</nav>';
    }
    echo '</div>';
    echo atelier_logo( 'logo-right', 'mobile-logo' );
} else if ( $mobile_header_layout == "center-logo" ) {
    echo '<div class="mobile-header-opts opts-left">';
    echo '<a href="#" class="mobile-menu-link menu-bars-link">' . $mobile_menu_icon . '</a>';
    echo '</div>';
    echo atelier_logo( 'logo-center', 'mobile-logo' );
    echo '<div class="mobile-header-opts opts-right">';
    if ( $mobile_show_cart && $woocommerce != "" ) {
        echo '<nav class="std-menu float-alt-menu">';
	    echo '<ul class="menu">';
		echo atelier_get_cart();
		echo '</ul>';
	    echo '</nav>';
    }
    echo '</div>';
} else if ( $mobile_header_layout == "center-logo-alt" ) {
    echo '<div class="mobile-header-opts opts-left">';
    if ( $mobile_show_cart && $woocommerce != "" ) {
        echo '<nav class="std-menu float-alt-menu">';
	    echo '<ul class="menu">';
		echo atelier_get_cart();
		echo '</ul>';
	    echo '</nav>';
    }
    echo '</div>';
    echo atelier_logo( 'logo-center', 'mobile-logo' );
    echo '<div class="mobile-header-opts opts-right">';
    echo '<a href="#" class="mobile-menu-link menu-bars-link">' . $mobile_menu_icon . '</a>';
    echo '</div>';
} else {
    echo atelier_logo( 'logo-left', 'mobile-logo' );
    echo '<div class="mobile-header-opts">';
    echo '<a href="#" class="mobile-menu-link menu-bars-link">' . $mobile_menu_icon . '</a>';
    if ( $mobile_show_cart && $woocommerce != "" ) {
        echo '<nav class="std-menu float-alt-menu">';
	    echo '<ul class="menu">';
		echo atelier_get_cart();
		echo '</ul>';
	    echo '</nav>';
    }
    echo '</div>';
}
echo '</header>';
