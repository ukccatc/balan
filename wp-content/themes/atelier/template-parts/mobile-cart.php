<?php
global $woocommerce, $atelier_options;

$mobile_header_layout = $atelier_options['mobile_header_layout'];
$mobile_show_cart    = $atelier_options['mobile_show_cart'];
$mobile_show_account = $atelier_options['mobile_show_account'];
$login_url           = wp_login_url();
$logout_url          = wp_logout_url( home_url() );
$my_account_link     = get_admin_url();
$myaccount_page_id   = get_option( 'woocommerce_myaccount_page_id' );
if ( $myaccount_page_id ) {
    $my_account_link = get_permalink( $myaccount_page_id );
    $logout_url      = wp_logout_url( get_permalink( $myaccount_page_id ) );
    $login_url       = get_permalink( $myaccount_page_id );
    if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
        $logout_url = str_replace( 'http:', 'https:', $logout_url );
        $login_url  = str_replace( 'http:', 'https:', $login_url );
    }
}
$login_url        = apply_filters( 'atelier_header_login_url', $login_url );
$my_account_link  = apply_filters( 'atelier_header_myaccount_url', $my_account_link );
$fs_close_icon    = apply_filters( 'atelier_fullscreen_close_icon', '<i class="ss-delete"></i>' );
$mobile_menu_type = "slideout";
if ( isset( $atelier_options['mobile_menu_type'] ) ) {
    $mobile_menu_type = $atelier_options['mobile_menu_type'];
}

$mobile_cart_output = "";

if ( $mobile_show_cart && $woocommerce ) {
    if ( $mobile_header_layout == "left-logo" || $mobile_header_layout == "center-logo-alt" ) {
    	echo '<div id="mobile-cart-wrap" class="cart-is-left">';
    } else {
    	echo '<div id="mobile-cart-wrap" class="cart-is-right">';
    }

    if ( $mobile_menu_type == "overlay" ) {
        echo '<a href="#" class="mobile-overlay-close">'.$fs_close_icon.'</a>';
    }

    echo '<ul>';
    echo atelier_get_cart();
    echo '</ul>';
    if ( $mobile_show_account ) {
        echo '<ul class="mobile-cart-menu">';
        if ( is_user_logged_in() ) {
            echo '<li><a href="' . $my_account_link . '" class="admin-link">' . __( "My Account", 'atelier' ) . '</a></li>';
            echo '<li><a href="' . $logout_url . '">' . __( "Sign Out", 'atelier' ) . '</a></li>';
        } else {
            echo '<li><a href="' . $login_url . '">' . __( "Login", 'atelier' ) . '</a></li>';
        }
        echo '</ul>';
    }
    echo '</div>';
}
