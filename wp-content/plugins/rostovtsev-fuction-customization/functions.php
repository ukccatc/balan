<?php
/**
 * Plugin Name: rostovtsev customization
 */

/* Changing home link for breadcrumbs nav
================================================== */
add_filter('bcn_breadcrumb_title', 'my_breadcrumb_title_swapper', 3, 10);
function my_breadcrumb_title_swapper($title, $type, $id)
{
    if(in_array('home', $type))
    {
        $title = __('Home');
    }
    return $title;
}
/* Rostovtsev locale
================================================== */
add_action( 'after_setup_theme', 'rostovtsev');
function rostovtsev(){
    load_theme_textdomain( 'rostovtsev', WP_CONTENT_DIR . 'plugins/rostovtsev-fuction-customization/languages' );
}
