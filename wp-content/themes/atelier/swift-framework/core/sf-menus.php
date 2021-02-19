<?php

    /*
    *
    *	Swift Framework Menu Functions
    *	------------------------------------------------
    *	Swift Framework v3.0
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	atelier_setup_menus()
    *
    */


    /* CUSTOM MENU SETUP
    ================================================== */
    register_nav_menus( array(
        'main_navigation' => __( 'Main Menu', 'atelier' ),
        'overlay_menu'    => __( 'Overlay Menu', 'atelier' ),
        'mobile_menu'     => __( 'Mobile Menu', 'atelier' ),
        'top_bar_menu'    => __( 'Top Bar Menu', 'atelier' ),
        'footer_menu'     => __( 'Footer Menu', 'atelier' )
    ) );
    
    
    /* SLIDEOUT MENU SETUP
    ================================================== */
    if ( atelier_theme_supports( 'slideout-menu' ) ) {
	    register_nav_menus( array(
	        'slideout_menu'   => __( 'Slideout Menu', 'atelier' ),
	    ) );
    }
    
    /* PUSHNAV MENU SETUP
    ================================================== */
    if ( atelier_theme_supports( 'pushnav-menu' ) ) {
        register_nav_menus( array(
            'pushnav_menu'   => __( 'Push Nav Menu', 'atelier' ),
        ) );
    }
    
    /* SPLIT HEADER MENU SETUP
    ================================================== */
    if ( atelier_theme_supports( 'split-nav-menu' ) ) {
        register_nav_menus( array(
            'split_nav_left'   => __( 'Split Nav Left', 'atelier' ),
            'split_nav_right'   => __( 'Split Nav Right', 'atelier' ),
        ) );
    }


?>
