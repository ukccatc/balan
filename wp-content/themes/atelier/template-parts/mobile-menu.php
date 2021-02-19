<?php
global $post, $woocommerce, $atelier_options;

$header_search_pt = $atelier_options['header_search_pt'];
$mobile_header_layout = $atelier_options['mobile_header_layout'];
$mobile_show_translation = $atelier_options['mobile_show_translation'];
$mobile_show_search      = $atelier_options['mobile_show_search'];
$mobile_menu_type        = "slideout";
$fs_close_icon = apply_filters( 'atelier_fullscreen_close_icon', '<i class="ss-delete"></i>' );
if ( isset( $atelier_options['mobile_menu_type'] ) ) {
    $mobile_menu_type = $atelier_options['mobile_menu_type'];
}
$page_menu = "";

if ( $post && !is_search() ) {
    $page_menu = atelier_get_post_meta($post->ID, 'sf_page_menu', true );
}

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
$register_url     = apply_filters( 'atelier_header_register_url', wp_registration_url() );
$my_account_link  = apply_filters( 'atelier_header_myaccount_url', $my_account_link );

if ( get_option( 'woocommerce_enable_myaccount_registration' ) && $myaccount_page_id ) {
    $register_url = apply_filters( 'atelier_header_register_url', $my_account_link );
}

$mobile_menu_args = array(
    'echo'           => false,
    'theme_location' => 'mobile_menu',
    'walker'         => new atelier_alt_menu_walker,
    'fallback_cb'    => '',
    'menu'           => $page_menu
);

$mobile_menu_output = "";

if ( $mobile_header_layout == "left-logo" || $mobile_header_layout == "center-logo-alt" ) {
    echo '<div id="mobile-menu-wrap" class="menu-is-right">';
} else {
    echo '<div id="mobile-menu-wrap" class="menu-is-left">';
}

if ( $mobile_menu_type == "overlay" ) {
    echo '<a href="#" class="mobile-overlay-close">'.$fs_close_icon.'</a>';
}

if ( $mobile_show_translation && ( function_exists( 'pll_the_languages' ) || function_exists( 'icl_get_languages' ) ) ) {
    echo '<ul class="mobile-language-select">' . atelier_language_flags() . '</ul>';
}
if ( $mobile_show_search ) {
    echo '<form method="get" class="mobile-search-form" action="' . home_url() . '/">';
    echo '<a href="#" class="mobile-search-trigger"><i class="sf-icon-search"></i></a>';
    echo '<input type="text" placeholder="' . __( "Search", 'atelier' ) . '" name="s" autocomplete="off" />';
    
    if ( $header_search_pt != "any" ) {
        echo '<input type="hidden" name="post_type" value="' . $header_search_pt . '" />';
        do_action( 'wpml_add_language_form_field' );
    }

    echo '</form>';
}
echo '<nav id="mobile-menu" class="clearfix">';

if ( function_exists( 'wp_nav_menu' ) ) {
    echo wp_nav_menu( $mobile_menu_args );
}

echo '<ul class="alt-mobile-menu">';

if ( atelier_woocommerce_activated() ) {

    if ( $mobile_show_cart ) {
        echo atelier_get_cart();
    }

    echo atelier_get_wishlist();

    if ( $mobile_show_account ) {
        if ( is_user_logged_in() ) {
            echo '<li><a href="' . $my_account_link . '" class="admin-link">' . __( "My Account", 'atelier' ) . '</a></li>';
            echo '<li><a href="' . $logout_url . '">' . __( "Logout", 'atelier' ) . '</a></li>';
        } else {
            if ( $login_url == $register_url ) {
                echo '<li><a href="' . $login_url . '">' . __( "Login / Sign Up", 'atelier' ) . '</a></li>';
            } else {
                echo '<li><a href="' . $login_url . '">' . __( "Login", 'atelier' ) . '</a></li>';
                echo '<li><a href="' . $register_url . '">' . __( "Sign Up", 'atelier' ) . '</a></li>';                     
            }
        }
    }

}

echo '</ul>';

echo '</nav>';
echo '</div>';
