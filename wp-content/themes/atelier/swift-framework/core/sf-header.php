<?php
    /*
    *
    *	Header Functions
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	atelier_framework_check()
    *	atelier_site_loading()
    *	atelier_header_wrap()
    *	atelier_header()
    *	atelier_header_aux()
    *	atelier_logo()
    *	atelier_main_menu()
    *	atelier_mobile_cart()
    *	atelier_mobile_header()
    *	atelier_mobile_menu()
    *	atelier_woocommercelinks()
    * 	atelier_get_cart()
    *	atelier_get_wishlist()
    *	atelier_get_account()
    *	atelier_ajaxsearch()
    *	atelier_overlay_menu()
    *   atelier_add_to_wishlist()
    */

    /* SITE LOADING
    ================================================== */
    if ( ! function_exists( 'atelier_site_loading' ) ) {
        function atelier_site_loading() {
            echo atelier_loading_animation( 'site-loading' );
        }

        add_action( 'atelier_before_page_container', 'atelier_site_loading', 5 );
    }


    /* HEADER WRAP
    ================================================== */
    if ( ! function_exists( 'atelier_header_wrap' )) {
	    function atelier_header_wrap($header_layout) {
		    global $post, $atelier_options;

		    $page_classes     = atelier_page_classes();
		    $header_layout    = $page_classes['header-layout'];
		    $page_header_type = "standard";

		    if ( is_page() && $post ) {
		        $page_header_type = atelier_get_post_meta($post->ID, 'sf_page_header_type', true );
		    } else if ( is_singular( 'post' ) && $post ) {
		        $post_header_type = atelier_get_post_meta($post->ID, 'sf_page_header_type', true );
		        $fw_media_display = atelier_get_post_meta($post->ID, 'sf_fw_media_display', true );
		        $page_title_style = atelier_get_post_meta($post->ID, 'sf_page_title_style', true );
		        if ( $page_title_style == "fancy" || $fw_media_display == "fw-media-title" || $fw_media_display == "fw-media" ) {
		            $page_header_type = $post_header_type;
		        }
		    }  else if (is_singular('portfolio') && $post) {
				$port_header_type = atelier_get_post_meta($post->ID, 'sf_page_header_type', true);
				$fw_media_display = atelier_get_post_meta($post->ID, 'sf_fw_media_display', true);
				$page_title = atelier_get_post_meta($post->ID, 'sf_page_title', true);
				$page_title_style = atelier_get_post_meta($post->ID, 'sf_page_title_style', true);
				if ($page_title_style == "fancy" || !$page_title) {
					$page_header_type = $port_header_type;
				}
			}

		    $fullwidth_header    = $atelier_options['fullwidth_header'];
		    $enable_tb           = $atelier_options['enable_tb'];
			$enable_sticky_tb = false;
			if ( isset( $atelier_options['enable_sticky_topbar'] ) ) {
				$enable_sticky_tb = $atelier_options['enable_sticky_topbar'];	
			}
		    $header_left_config  = __($atelier_options['header_left_config'], 'atelier');
		    $header_right_config = __($atelier_options['header_right_config'], 'atelier');
			
		    if ( ( $page_header_type == "naked-light" || $page_header_type == "naked-dark" ) && ( $header_layout == "header-vert" || $header_layout == "header-vert-right" ) ) {
		        $header_layout = apply_filters( 'atelier_naked_default_header', "header-1" );
		        $enable_tb     = false;
		    }
		    
		    $top_bar_class = "";
		    if ($enable_sticky_tb) {
		    	$top_bar_class = "sticky-top-bar";
		    }
		?>
		<?php if ($enable_tb) { ?>
		<!--// TOP BAR //-->
		<div id="top-bar" class="<?php echo esc_attr($top_bar_class); ?>">
		<?php if ($fullwidth_header) { ?>
		<div class="container fw-header">
		    <?php } else { ?>
		    <div class="container">
		        <?php } ?>
		        <div class="col-sm-6 tb-left"><?php atelier_get_template_part('top-bar-left'); ?></div>
                <div class="col-sm-6 tb-right"><?php atelier_get_template_part('top-bar-right'); ?></div>
		    </div>
		</div>
		<?php } ?>

		<!--// HEADER //-->
		<div class="header-wrap <?php echo esc_attr($page_classes['header-wrap']); ?> page-header-<?php echo esc_attr($page_header_type); ?>">
			
			<?php do_action('atelier_before_header_section'); ?>
			
		    <div id="header-section" class="<?php echo esc_attr($header_layout); ?> <?php echo esc_attr($page_classes['logo']); ?>">
		    	<?php do_action('atelier_header_section_start'); ?>
		        <?php echo atelier_header( $header_layout ); ?>
		        <?php do_action('atelier_header_section_end'); ?>
		    </div>
		    
		    <?php do_action('atelier_after_header_section'); ?>

		    <?php
		        // Overlay Menu
		        if ( $header_left_config == "overlay-menu" || $header_right_config == "overlay-menu" ) {
		            echo atelier_overlay_menu();
		        }
		    ?>

		    <?php
		        // Contact Slideout
		        if ( $header_left_config == "contact" || $header_right_config == "contact" ) {
		            echo atelier_contact_slideout();
		        }
		    ?>

		</div>

		<?php
	    }
	    add_action( 'atelier_container_start', 'atelier_header_wrap', 20 );
    }


    /* HEADER
    ================================================== */
    if ( ! function_exists( 'atelier_header' ) ) {
        function atelier_header( $header_layout ) {
			
			$header = "";
			
			$header .= do_action('atelier_before_header_layout');
			
            // Get layout and return output
            $header .= atelier_get_header_layout( $header_layout );
            
            $header .= do_action('atelier_after_header_layout');
            
            return $header;

        }
    }


    /* HEADER AUX
    ================================================== */
    if ( ! function_exists( 'atelier_header_aux' ) ) {
        function atelier_header_aux( $aux ) {

            global $atelier_options;
			$page_classes       = atelier_page_classes();
			
            $show_cart           = $atelier_options['show_cart'];
            $show_wishlist       = $atelier_options['show_wishlist'];
            $header_layout      = $page_classes['header-layout'];
            $header_left_config  = __($atelier_options['header_left_config'], 'atelier');
            $header_right_config = __($atelier_options['header_right_config'], 'atelier');
            $header_left_text    = __( $atelier_options['header_left_text'], 'atelier' );
            $header_right_text   = __( $atelier_options['header_right_text'], 'atelier' );
            $fullwidth_header    = $atelier_options['fullwidth_header'];
            $contact_icon        = apply_filters( 'atelier_header_contact_icon', '<i class="ss-mail"></i>' );

            if ( $aux == "left" ) {
                $header_left_output = "";
                if ( $header_left_config == "social" ) {
                    $header_left_output .= do_shortcode( '[social]' ) . "\n";
                } else if ( $header_left_config == "aux-links" ) {
                    $header_left_output .= atelier_aux_links( 'header-menu', true, $header_layout ) . "\n";
                } else if ( $header_left_config == "overlay-menu" ) {
                    $header_left_output .= '<a href="#" class="overlay-menu-link"><span>' . __( "Menu", 'atelier' ) . '</span></a>' . "\n";
                } else if ( $header_left_config == "contact" ) {
                    $header_left_output .= '<a href="#" class="contact-menu-link">' . $contact_icon . '</a>' . "\n";
                } else if ( $header_left_config == "currency-switcher" ) {
                	$aux_output .= '<div class="aux-item aux-currency"><nav class="std-menu currency"><ul class="menu">'. "\n";
                	$aux_output .= atelier_get_currency_switcher();
                	$aux_output .= '</ul></nav></div>'. "\n";
                } else if ( $header_left_config == "search" ) {
                    $header_left_output .= '<nav class="std-menu">' . "\n";
                    $header_left_output .= '<ul class="menu">' . "\n";
                    $header_left_output .= atelier_get_search( 'aux' );
                    $header_left_output .= '</ul>' . "\n";
                    $header_left_output .= '</nav>' . "\n";
                } else {
                    $header_left_output .= '<div class="text">' . do_shortcode( $header_left_text ) . '</div>' . "\n";
                }

                return $header_left_output;
            } else if ( $aux == "right" ) {
                $header_right_output = "";
                if ( $header_right_config == "social" ) {
                    $header_right_output .= do_shortcode( '[social]' ) . "\n";
                } else if ( $header_right_config == "aux-links" ) {
                    $header_right_output .= atelier_aux_links( 'header-menu', true, $header_layout ) . "\n";
                } else if ( $header_right_config == "overlay-menu" ) {
                    $header_right_output .= '<a href="#" class="overlay-menu-link"><span>' . __( "Menu", 'atelier' ) . '</span></a>' . "\n";
                } else if ( $header_right_config == "contact" ) {
                    $header_right_output .= '<a href="#" class="contact-menu-link">' . $contact_icon . '</a>' . "\n";
                } else if ( $header_right_config == "currency-switcher") {
                	$aux_output .= '<div class="aux-item aux-currency"><nav class="std-menu currency"><ul class="menu">'. "\n";
                	$aux_output .= atelier_get_currency_switcher();
                	$aux_output .= '</ul></nav></div>'. "\n";
                } else if ( $header_right_config == "search" ) {
                    $header_right_output .= '<nav class="std-menu">' . "\n";
                    $header_right_output .= '<ul class="menu">' . "\n";
                    $header_right_output .= atelier_get_search( 'aux' );
                    $header_right_output .= '</li>' . "\n";
                    $header_right_output .= '</ul>' . "\n";
                    $header_right_output .= '</nav>' . "\n";
                } else {
                    $header_right_output .= '<div class="text">' . do_shortcode( $header_right_text ) . '</div>' . "\n";
                }

                return $header_right_output;
            }
        }
    }


    /* LOGO
    ================================================== */
    if ( ! function_exists( 'atelier_logo' ) ) {
        function atelier_logo( $logo_class, $logo_id = "logo" ) {

            //VARIABLES
            global $post, $atelier_options;
            $show_cart = false;
            $sticky_header_transparent = false;
            if ( isset($atelier_options['show_cart']) ) {
            $show_cart            = $atelier_options['show_cart'];
            }
            $light_logo = $dark_logo = $alt_logo = array();
            $header_type = "standard";
            $page_header_alt_logo = false;
            $custom_logo_id = get_theme_mod( 'custom_logo' );

            $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );

            if ( function_exists('is_checkout') && is_checkout() ) {
            	if ( $atelier_options['minimal_checkout'] && $logo_class != "logo-left checkout-logo" ) {
            		return;
            	}
            }

            if ( $post && !is_search() ) {
                $header_type = atelier_get_post_meta($post->ID, 'sf_page_header_type', true );
                $page_header_alt_logo = atelier_get_post_meta($post->ID, 'sf_page_header_alt_logo', true );
                $sticky_header_transparent = atelier_get_post_meta($post->ID, 'sf_sticky_header_transparent', true );
            }
            $page_header_alt_logo = apply_filters( 'atelier_page_header_alt_logo', $page_header_alt_logo );
            
            // Shop page check
            $shop_page = false;
            if ( ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_category' ) && is_product_category() ) ) {
                $shop_page = true;
            }

            if ( $shop_page ) {
                if ( isset($atelier_options['woo_page_header']) ) {
                    $header_type = $atelier_options['woo_page_header'];
                }
            }

            // Light Logo
            if ( isset( $atelier_options['light_logo_upload'] ) ) {
                $light_logo = $atelier_options['light_logo_upload'];
            }
            if ( isset( $light_logo['url'] ) && $light_logo['url'] != "" && ( $header_type == "naked-light" || $header_type == "naked-dark" || $sticky_header_transparent ) ) {
                $logo_class .= " has-light-logo";
            }

            // Dark Logo
            if ( isset( $atelier_options['dark_logo_upload'] ) ) {
                $dark_logo = $atelier_options['dark_logo_upload'];
            }
            if ( isset( $dark_logo['url'] ) && $dark_logo['url'] != "" && ( $header_type == "naked-light" || $header_type == "naked-dark" || $sticky_header_transparent ) ) {
                $logo_class .= " has-dark-logo";
            }

            // Alt Logo
            if ( isset( $atelier_options['alt_logo_upload'] ) && $page_header_alt_logo ) {
                $alt_logo = $atelier_options['alt_logo_upload'];
            }

            if ( has_custom_logo() ) {
                $logo_class .= " has-img";
            } else {
                $logo_class .= " no-img";
            }
            $logo_output         = "";
            $logo_alt            = get_bloginfo( 'name' );
            $logo_tagline        = get_bloginfo( 'description' );
            $logo_link_url       = apply_filters( 'atelier_logo_link_url', home_url() );
            $enable_logo_tagline = false;
            if ( isset( $atelier_options['enable_logo_tagline'] ) ) {
                $enable_logo_tagline = $atelier_options['enable_logo_tagline'];
            }
            
            // Animation
            $logo_anim = "";
            if ( isset( $atelier_options['logo_hover_anim'] ) ) {
                $logo_anim = $atelier_options['logo_hover_anim'];
            }


            /* LOGO OUTPUT
            ================================================== */
            $logo_output .= '<div id="' . $logo_id . '" class="' . $logo_class . ' clearfix" data-anim="' . $logo_anim . '">' . "\n";
            $logo_output .= '<a href="' . $logo_link_url . '">' . "\n";

            if ( $logo_id == "mobile-logo" && atelier_theme_supports('mobile-logo-override') ) {

	            $mobile_logo = "";

	            if ( isset( $atelier_options['mobile_logo_upload'] ) ) {
					$mobile_logo = $atelier_options['mobile_logo_upload'];
				}


				// Standard Mobile Logo
	            if ( isset( $mobile_logo['url'] ) && $mobile_logo['url'] != "" ) {
	                $logo_output .= '<img class="standard" src="' . esc_url($mobile_logo['url']) . '" alt="' . esc_attr($logo_alt) . '" height="' . esc_attr($mobile_logo['height']) . '" width="' . esc_attr($mobile_logo['width']) . '" />' . "\n";
	            } else if ( has_custom_logo() ) {
                    $logo_output .= '<img class="standard" src="' . esc_url( $logo['0'] ) . '" alt="' . esc_attr($logo_alt) . '" width="' . esc_attr($logo['1']) . '" height="' . esc_attr($logo['2']) . '" />' . "\n";
	            }

	            // Alt Logo
	            if ( isset( $alt_logo['url'] ) && $alt_logo['url'] != "" && $page_header_alt_logo ) {
	                $logo_output .= '<img class="alt-logo" src="' . $alt_logo['url'] . '" alt="' . $logo_alt . '" height="' . $alt_logo['height'] . '" width="' . $alt_logo['width'] . '" />' . "\n";
	            }

	            // Text Logo
	            $logo_output .= '<div class="text-logo">';
	            $h1_output = '';
	            if ( !has_custom_logo() ) {
	                $h1_output = '<h1 class="logo-h1 standard">' . $logo_alt . '</h1>' . "\n";
	            }
	            $logo_output .= $h1_output;
	            if ( $enable_logo_tagline && $logo_tagline != "" ) {
	                $logo_output .= '<h2 class="logo-h2">' . $logo_tagline . '</h2>' . "\n";
	            }
	            $logo_output .= '</div>' . "\n";

            } else {

		        // Standard Logo
	            if ( has_custom_logo() ) {
                    $logo_output .= '<img class="standard" src="' . esc_url( $logo['0'] ) . '" alt="' . esc_attr($logo_alt) . '" width="' . esc_attr($logo['1']) . '" height="' . esc_attr($logo['2']) . '" />' . "\n";
                }

	            // Light Logo
	            if ( isset( $light_logo['url'] ) && $light_logo['url'] != "" && ( $header_type == "naked-light" || $header_type == "naked-dark" || $sticky_header_transparent ) ) {
	                $logo_output .= '<img class="light-logo" src="' . $light_logo['url'] . '" alt="' . $logo_alt . '" height="' . $light_logo['height'] . '" width="' . $light_logo['width'] . '" />' . "\n";
	            }

	            // Dark Logo
	            if ( isset( $dark_logo['url'] ) && $dark_logo['url'] != "" && ( $header_type == "naked-light" || $header_type == "naked-dark" || $sticky_header_transparent ) ) {
	                $logo_output .= '<img class="dark-logo" src="' . $dark_logo['url'] . '" alt="' . $logo_alt . '" height="' . $dark_logo['height'] . '" width="' . $dark_logo['width'] . '" />' . "\n";
	            }

	            // Alt Logo
	            if ( isset( $alt_logo['url'] ) && $alt_logo['url'] != "" && $page_header_alt_logo ) {
	                $logo_output .= '<img class="alt-logo" src="' . $alt_logo['url'] . '" alt="' . $logo_alt . '" height="' . $alt_logo['height'] . '" width="' . $alt_logo['width'] . '" />' . "\n";
	            }

	            // Text Logo
	            $logo_output .= '<div class="text-logo">';
	            $h1_output = '';
	            if ( !has_custom_logo() ) {
                    $h1_output = '<h1 class="logo-h1 standard">' . $logo_alt . '</h1>' . "\n";
                }
	            $logo_output .= $h1_output;
	            if ( $enable_logo_tagline && $logo_tagline != "" ) {
	                $logo_output .= '<h2 class="logo-h2">' . $logo_tagline . '</h2>' . "\n";
	            }
	            $logo_output .= '</div>' . "\n";

            }

            $logo_output .= '</a>' . "\n";
            $logo_output .= '</div>' . "\n";


            // LOGO RETURN
            return $logo_output;
        }
    }

    /* TOP BAR MENU
    ================================================== */
    if ( ! function_exists( 'atelier_top_bar_menu' ) ) {
        function atelier_top_bar_menu() {

            $tb_menu_args = array(
                'echo'           => false,
                'theme_location' => 'top_bar_menu',
                'walker'         => new atelier_alt_menu_walker,
                'fallback_cb'    => '',
            );

            // MENU OUTPUT
            $tb_menu_output = '<nav class="std-menu clearfix">' . "\n";

            if ( function_exists( 'wp_nav_menu' ) ) {
                if ( has_nav_menu( 'top_bar_menu' ) ) {
                    $tb_menu_output .= wp_nav_menu( $tb_menu_args );
                } else {
                    $tb_menu_output .= '<div class="no-menu">' . __( "Please assign a menu to the Top Bar Menu in Appearance > Menus", 'atelier' ) . '</div>';
                }
            }
            $tb_menu_output .= '</nav>' . "\n";

            return $tb_menu_output;
        }
    }

    /* MENU
    ================================================== */
    if ( ! function_exists( 'atelier_main_menu' ) ) {
        function atelier_main_menu( $id, $layout = "" ) {

            // VARIABLES
            global $atelier_options, $post;

			$show_cart = false;
			if ( isset($atelier_options['show_cart']) ) {
			$show_cart            = $atelier_options['show_cart'];
			}
            $show_wishlist        = $atelier_options['show_wishlist'];
            $header_search_type   = $atelier_options['header_search_type'];
            $vertical_header_text = __( $atelier_options['vertical_header_text'], 'atelier' );
            $page_menu            = $menu_output = $menu_full_output = $menu_with_search_output = $menu_float_output = $menu_vert_output = "";

            if ( $post && !is_search() ) {
                $page_menu = atelier_get_post_meta($post->ID, 'sf_page_menu', true );
            }
            $main_menu_args = array(
                'echo'           => false,
                'theme_location' => 'main_navigation',
                'walker'         => new atelier_mega_menu_walker,
                'fallback_cb'    => '',
                'menu'           => $page_menu
            );


            // MENU OUTPUT
            $menu_output .= '<nav id="' . $id . '" class="std-menu clearfix">' . "\n";

            if ( function_exists( 'wp_nav_menu' ) ) {
                if ( has_nav_menu( 'main_navigation' ) ) {
                    $menu_output .= wp_nav_menu( $main_menu_args );
                } else {
                    $menu_output .= '<div class="no-menu">' . __( "Please assign a menu to the Main Menu in Appearance > Menus", 'atelier' ) . '</div>';
                }
            }
            $menu_output .= '</nav>' . "\n";


            // FULL WIDTH MENU OUTPUT
            if ( $layout == "full" ) {

                $menu_full_output .= '<div class="container">' . "\n";
                $menu_full_output .= '<div class="row">' . "\n";
                $menu_full_output .= '<div class="menu-left">' . "\n";
                $menu_full_output .= $menu_output . "\n";
                $menu_full_output .= '</div>' . "\n";
                $menu_full_output .= '<div class="menu-right">' . "\n";
                $menu_full_output .= '<nav class="std-menu">' . "\n";
                $menu_full_output .= '<ul class="menu">' . "\n";
                $menu_full_output .= atelier_get_search( $header_search_type );
                if ( $show_cart ) {
                    $menu_full_output .= atelier_get_cart();
                }
                if ( class_exists( 'YITH_WCWL_UI' ) && $show_wishlist ) {
                    $menu_full_output .= atelier_get_wishlist();
                }
                $menu_full_output .= '</ul>' . "\n";
                $menu_full_output .= '</nav>' . "\n";
                $menu_full_output .= '</div>' . "\n";
                $menu_full_output .= '</div>' . "\n";
                $menu_full_output .= '</div>' . "\n";

                $menu_output = $menu_full_output;			
				
            } else if ( $layout == "with-search" ) {

                $menu_with_search_output .= '<nav class="search-nav std-menu">' . "\n";
                $menu_with_search_output .= '<ul class="menu">' . "\n";
                $menu_with_search_output .= atelier_get_search( $header_search_type );
                $menu_with_search_output .= '</ul>' . "\n";
                $menu_with_search_output .= '</nav>' . "\n";
                $menu_with_search_output .= $menu_output . "\n";

                $menu_output = $menu_with_search_output;

            } else if ( $layout == "float" || $layout == "float-2" ) {

                $menu_float_output .= '<div class="float-menu container">' . "\n";
                $menu_float_output .= $menu_output . "\n";
                if ( $layout == "float-2" ) {
                    $menu_float_output .= '<nav class="std-menu float-alt-menu">' . "\n";
                    $menu_float_output .= '<ul class="menu">' . "\n";
                    $menu_float_output .= atelier_get_search( $header_search_type );
                    if ( $show_cart ) {
                        $menu_float_output .= atelier_get_cart();
                    }
                    if ( class_exists( 'YITH_WCWL_UI' ) && $show_wishlist ) {
                        $menu_float_output .= atelier_get_wishlist();
                    }
                    $menu_float_output .= '</ul>' . "\n";
                    $menu_float_output .= '</nav>' . "\n";
                }
                $menu_float_output .= '</div>' . "\n";

                $menu_output = $menu_float_output;

            } else if ( $layout == "vertical" ) {

                $menu_vert_output .= $menu_output . "\n";
                $menu_vert_output .= '<div class="vertical-menu-bottom">' . "\n";
                $menu_vert_output .= atelier_header_aux('right');
                $menu_vert_output .= '<div class="copyright">' . do_shortcode( stripslashes( $vertical_header_text ) ) . '</div>' . "\n";
                $menu_vert_output .= '</div>' . "\n";

                $menu_output = $menu_vert_output;
            }

            // MENU RETURN
            return $menu_output;
        }
    }


    /* MOBILE HEADER
    ================================================== */
    if ( ! function_exists( 'atelier_mobile_header' ) ) {
        function atelier_mobile_header() {
            atelier_get_template_part('mobile-header');
        }

        add_action( 'atelier_container_start', 'atelier_mobile_header', 10 );
    }


    /* MOBILE MENU
    ================================================== */
    if ( ! function_exists( 'atelier_mobile_menu' ) ) {
        function atelier_mobile_menu() {
            atelier_get_template_part('mobile-menu');
        }

        add_action( 'atelier_before_page_container', 'atelier_mobile_menu', 10 );
    }

    /* MOBILE MENU
    ================================================== */
    if ( ! function_exists( 'atelier_mobile_cart' ) ) {
        function atelier_mobile_cart() {
            atelier_get_template_part('mobile-cart');
        }

        add_action( 'atelier_before_page_container', 'atelier_mobile_cart', 20 );
    }


    /* WOO LINKS
    ================================================== */
    if ( ! function_exists( 'atelier_woocommercelinks' ) ) {
        function atelier_woocommercelinks( $position = "", $config = "" ) {

            // VARIABLES
            global $atelier_options;

            $tb_search_text   = $atelier_options['tb_search_text'];
            $woo_links_output = $ss_enable = "";
			$supersearch_icon = apply_filters('atelier_header_supersearch_icon', '<i class="ss-zoomin"></i>');

            if ( isset( $atelier_options['ss_enable'] ) ) {
                $ss_enable = $atelier_options['ss_enable'];
            } else {
                $ss_enable = true;
            }

            // WOO LINKS OUTPUT
            $woo_links_output .= '<nav class="' . $position . '">' . "\n";
            $woo_links_output .= '<ul class="menu">' . "\n";
            if ( is_user_logged_in() ) {
                $current_user = wp_get_current_user();
                $woo_links_output .= '<li class="tb-welcome">' . __( "Welcome", 'atelier' ) . " " . $current_user->display_name . '</li>' . "\n";
            } else {
                $woo_links_output .= '<li class="tb-welcome">' . __( "Welcome", 'atelier' ) . '</li>' . "\n";
            }
            if ( $ss_enable ) {
                if ( $position == "top-menu" ) {
                    $woo_links_output .= '<li class="tb-woo-custom clearfix"><a class="swift-search-link" href="#">'.$supersearch_icon.'<span>' . do_shortcode( $tb_search_text ) . '</span></a></li>' . "\n";
                } else {
                    $woo_links_output .= '<li class="hs-woo-custom clearfix"><a class="swift-search-link" href="#">'.$supersearch_icon.'<span>' . do_shortcode( $tb_search_text ) . '</span></a></li>' . "\n";
                }
            }
            $woo_links_output .= '</ul>' . "\n";
            $woo_links_output .= '</nav>' . "\n";

            // RETURN
            return $woo_links_output;
        }
    }


    /* AUX LINKS
    ================================================== */
    if ( ! function_exists( 'atelier_aux_links' ) ) {
        function atelier_aux_links( $position, $alt_version = false, $header_version = "" ) {

            // VARIABLES
            $login_url         = wp_login_url();
            $logout_url        = wp_logout_url( home_url() );
            $my_account_link   = get_admin_url();
            $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
            if ( $myaccount_page_id ) {
                $my_account_link = get_permalink( $myaccount_page_id );
                $logout_url      = wp_logout_url( get_permalink( $myaccount_page_id ) );
                $login_url       = get_permalink( $myaccount_page_id );
                if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
                    $logout_url = str_replace( 'http:', 'https:', $logout_url );
                    $login_url  = str_replace( 'http:', 'https:', $login_url );
                }
            }
            $login_url       = apply_filters( 'atelier_header_login_url', $login_url );
            $my_account_link = apply_filters( 'atelier_header_myaccount_url', $my_account_link );

            global $atelier_options;

            $show_sub         = $atelier_options['show_sub'];
            $show_translation = $atelier_options['show_translation'];
            $sub_code         = __( $atelier_options['sub_code'], 'atelier' );
            $show_account     = $atelier_options['show_account'];
            $show_cart = $show_wishlist = false;
            if ( isset($atelier_options['show_cart']) ) {
            $show_cart            = $atelier_options['show_cart'];
            }
            if ( isset($atelier_options['show_wishlist']) ) {
            $show_wishlist            = $atelier_options['show_wishlist'];
            }
            $ss_enable        = $atelier_options['ss_enable'];
            $aux_links_output = $ss_enable = "";


            // LINKS + SEARCH OUTPUT
            $aux_links_output .= '<nav class="std-menu ' . $position . '">' . "\n";
            $aux_links_output .= '<ul class="menu">' . "\n";
            if ( $show_account ) {
                if ( is_user_logged_in() ) {
                    $aux_links_output .= '<li><a href="' . $logout_url . '">' . __( "Sign Out", 'atelier' ) . '</a></li>' . "\n";
                    $aux_links_output .= '<li><a href="' . $my_account_link . '" class="admin-link">' . __( "My Account", 'atelier' ) . '</a></li>' . "\n";
                } else {
                    $aux_links_output .= '<li><a href="' . $login_url . '">' . __( "Login", 'atelier' ) . '</a></li>' . "\n";
                }
            }
            if ( $show_sub ) {
                $aux_links_output .= '<li class="parent"><a href="#">' . __( "Subscribe", 'atelier' ) . '</a>' . "\n";
                $aux_links_output .= '<ul class="sub-menu">' . "\n";
                $aux_links_output .= '<li><div class="header-subscribe clearfix">' . "\n";
                $aux_links_output .= do_shortcode( $sub_code ) . "\n";
                $aux_links_output .= '</div></li>' . "\n";
                $aux_links_output .= '</ul>' . "\n";
                $aux_links_output .= '</li>' . "\n";
            }
            if ( $show_translation ) {
                $aux_links_output .= '<li class="parent aux-languages"><a href="#">' . __( "Language", 'atelier' ) . '</a>' . "\n";
                $aux_links_output .= '<ul class="header-languages sub-menu">' . "\n";
                if ( function_exists( 'atelier_language_flags' ) ) {
                    $aux_links_output .= atelier_language_flags();
                }
                $aux_links_output .= '</ul>' . "\n";
                $aux_links_output .= '</li>' . "\n";
            }
            if ( $header_version != "header-1" ) {
                if ( $show_cart ) {
                    $aux_links_output .= atelier_get_cart();
                }
                if ( class_exists( 'YITH_WCWL_UI' ) && $show_wishlist ) {
                    $aux_links_output .= atelier_get_wishlist();
                }
            }
            $aux_links_output .= '</ul>' . "\n";
            $aux_links_output .= '</nav>' . "\n";

            // RETURN
            return $aux_links_output;
        }
    }


    /* SEARCH DROPDOWN
    ================================================== */
    if ( ! function_exists( 'atelier_get_search' ) ) {
        function atelier_get_search( $type ) {

            if ( $type == "search-off" ) {
                return;
            }

            global $atelier_options;

            $header_search_pt = $atelier_options['header_search_pt'];
            $ajax_url         = admin_url( 'admin-ajax.php' );
            $search_icon 	  = apply_filters( 'atelier_header_search_icon' , '<i class="ss-search"></i>' );

            $search_output = "";

            if ($header_search_pt == '') {
                $header_search_pt = 'any';
            }

            $search_output .= '<li class="menu-search parent"><a href="#" class="header-search-link-alt">'.$search_icon.'</a>' . "\n";
            $search_output .= '<div class="ajax-search-wrap" data-ajaxurl="' . $ajax_url . '"><div class="ajax-loading"></div><form method="get" class="ajax-search-form" action="' . home_url() . '/">';
            if ( $header_search_pt != "any" ) {
                $search_output .= '<input type="hidden" name="post_type" value="' . $header_search_pt . '" />';
            }
            $search_output .= '<input type="text" placeholder="' . __( "Search", 'atelier' ) . '" name="s" autocomplete="off" /></form><div class="ajax-search-results"></div></div>' . "\n";
            $search_output .= '</li>' . "\n";

            return $search_output;
        }
    }


    /* CART DROPDOWN
    ================================================== */
    if ( ! function_exists( 'atelier_get_cart' ) ) {
        function atelier_get_cart() {

            $cart_output = "";

            // Check if WooCommerce is active
            if ( atelier_woocommerce_activated() ) {

                global $woocommerce, $atelier_options;

                $show_cart_count = false;
                if ( isset( $atelier_options['show_cart_count'] ) ) {
                    $show_cart_count = $atelier_options['show_cart_count'];
                }
				
				if ( atelier_theme_opts_name() == "sf_atelier_options" ) {
					$cart_total = '<span class="menu-item-title">' . __( "Cart" , 'atelier' ) . '</span>';
				} else {
					$cart_total =  WC()->cart->get_cart_subtotal();
				}
				
                $cart_count          = WC()->cart->cart_contents_count;
                $cart_count_text     = atelier_product_items_text( $cart_count );
                $cart_count_text_alt = atelier_product_items_text( $cart_count, true );
				$view_cart_icon 	 = apply_filters( 'atelier_view_cart_icon', '<i class="ss-view"></i>' );
				$checkout_icon 	 	 = apply_filters( 'atelier_checkout_icon', '<i class="ss-creditcard"></i>' );
				$go_to_shop_icon  	 = apply_filters( 'atelier_go_to_shop_icon', '<i class="ss-cart"></i>' );

                if ( $show_cart_count ) {
                    $cart_output .= '<li class="parent shopping-bag-item"><a class="cart-contents" href="' . wc_get_cart_url() . '" title="' . __( "View your shopping cart", 'atelier' ) . '">'. apply_filters( 'atelier_header_cart_icon', '<i class="ss-cart"></i>' ) . '<span class="cart-text">' . __( "Cart", 'atelier' ) . '</span>' . $cart_total . '<span class="num-items cart-count-enabled">' . $cart_count_text_alt . '</span></a>';
                } else {
                    $cart_output .= '<li class="parent shopping-bag-item"><a class="cart-contents" href="' . wc_get_cart_url() . '" title="' . __( "View your shopping cart", 'atelier' ) . '">'. apply_filters( 'atelier_header_cart_icon', '<i class="ss-cart"></i>' ) . '<span class="cart-text">' . __( "Cart", 'atelier' ) . '</span>' . $cart_total . '<span class="num-items">' . $cart_count_text_alt . '</span></a>';
                }
                $cart_output .= '<ul class="sub-menu">';
                $cart_output .= '<li>';

                $cart_output .= '<div class="shopping-bag" data-empty-bag-txt="' . __( 'Your cart is empty.', 'atelier' ) . '" data-singular-item-txt="' . __( 'item in the cart', 'atelier' ) . '" data-multiple-item-txt="' . __( 'items in the cart', 'atelier' ) .'">';

                $cart_output .= '<div class="loading-overlay"><i class="sf-icon-loader"></i></div>';

                if ( $cart_count != "0" ) {

                    $cart_output .= '<div class="bag-header">' . $cart_count_text . ' ' . __( 'in the cart', 'atelier' ) . '</div>';

                    $cart_output .= '<div class="bag-contents">';

                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

                        $_product     		 = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                        $variation_id_class = $variation_id = '';
                                        
                        if ( $cart_item['variation_id'] > 0 ) {
                             $variation_id_class = ' product-var-id-' .  $cart_item['variation_id']; 
                             $variation_id = $cart_item['variation_id'];
                        }
                        
						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						
							$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							$product_title     = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							$product_short_title = ( strlen( $product_title ) > 25 ) ? substr( $product_title, 0, 22 ) . '...' : $product_title;
							
                            $cart_output .= '<div class="bag-product clearfix product-id-' . $cart_item['product_id'] . ' ' . esc_attr( $variation_id_class ) . '">';
                            $cart_output .= '<figure><a class="bag-product-img" href="' . get_permalink( $cart_item['product_id'] ) . '">' . $_product->get_image() . '</a></figure>';
                            $cart_output .= '<div class="bag-product-details">';
                            $cart_output .= '<div class="bag-product-title"><a href="' . get_permalink( $cart_item['product_id'] ) . '">' . apply_filters( 'woocommerce_cart_widget_product_title', $product_short_title, $_product ) . '</a></div>';
                            $cart_output .= '<div class="bag-product-price">' . __( "Unit Price:", 'atelier' ) . '
	                        ' . $product_price . '</div>';
                            $cart_output .= '<div class="bag-product-quantity">' . __( 'Quantity:', 'atelier' ) . ' ' . apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ) . '</div>';
                            $cart_output .= '</div>';
                            if (function_exists('wc_get_cart_remove_url')) {
                                $cart_output .= apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                    '<a href="%s" class="remove remove-product" title="%s" data-ajaxurl="'.admin_url( 'admin-ajax.php' ).'" data-product-qty="'. $cart_item['quantity'] .'"  data-product-id="%s" data-product_sku="%s" data-variation-id="%s">&times;</a>',
                                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                    __( 'Remove this item', 'atelier' ),
                                    esc_attr( $product_id ),
                                    esc_attr( $_product->get_sku() ),
                                    esc_attr( $variation_id )
                                ), $cart_item_key );
                            } else {
                                $cart_output .= apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                    '<a href="%s" class="remove remove-product" title="%s" data-ajaxurl="'.admin_url( 'admin-ajax.php' ).'" data-product-qty="'. $cart_item['quantity'] .'"  data-product-id="%s" data-product_sku="%s" data-variation-id="%s">&times;</a>',
                                    esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                                    __( 'Remove this item', 'atelier' ),
                                    esc_attr( $product_id ),
                                    esc_attr( $_product->get_sku() ),
                                    esc_attr( $variation_id )
                                ), $cart_item_key );
                            }

                            $cart_output .= '</div>';
                        }
                    }

                    $cart_output .= '</div>';

                    if ( atelier_theme_opts_name() == "sf_atelier_options" || atelier_theme_opts_name() == "sf_atelier_options" ) {

	                    $cart_output .= '<div class="bag-total">';
	                    if ( class_exists( 'Woocommerce_German_Market' ) ) {
	                    $cart_output .= '<span class="total-title">' . __( "Total incl. tax", 'atelier' ) . '</span>';
	                    } else {
	                    $cart_output .= '<span class="total-title">' . __( "Total", 'atelier' ) . '</span>';
	                    }
	                    $cart_output .= '<span class="total-amount">' .  WC()->cart->get_cart_subtotal() . '</span>';
	                    $cart_output .= '</div>';

                    }

                    $cart_output .= '<div class="bag-buttons">';

                    $cart_output .= '<a class="sf-button standard sf-icon-reveal bag-button" href="' . esc_url( wc_get_cart_url() ) . '">'.$view_cart_icon.'<span class="text">' . __( 'View cart', 'atelier' ) . '</span></a>';

                    $cart_output .= '<a class="sf-button standard sf-icon-reveal checkout-button" href="' . esc_url( wc_get_checkout_url() ) . '">'.$checkout_icon.'<span class="text">' . __( 'Checkout', 'atelier' ) . '</span></a>';

                    $cart_output .= '</div>';

                } else {

                    $cart_output .= '<div class="bag-empty">' . __( 'Your cart is empty.', 'atelier' ) . '</div>';

                }

                $cart_output .= '</div>';
                $cart_output .= '</li>';
                $cart_output .= '</ul>';
                $cart_output .= '</li>';
                
            } else if ( atelier_edd_activated() ) {
            
            	global $atelier_options;
            	
                $show_cart_count = false;
                if ( isset( $atelier_options['show_cart_count'] ) ) {
                    $show_cart_count = $atelier_options['show_cart_count'];
                }
				
				if ( atelier_theme_opts_name() == "sf_atelier_options" ) {
					$cart_total = '<span class="menu-item-title">' . __( "Cart" , 'atelier' ) . '</span>';
				} else {
					$cart_total =  html_entity_decode( edd_currency_filter( edd_format_amount( edd_get_cart_total() ) ), ENT_COMPAT, 'UTF-8' );
				}
				
				$cart_items    = edd_get_cart_contents();
				$cart_quantity = edd_get_cart_quantity();				
                $cart_count_text     = atelier_product_items_text( $cart_quantity );
                $cart_count_text_alt = atelier_product_items_text( $cart_quantity, true );
                $cart_url = "";
                $checkout_url = edd_get_checkout_uri();
				$view_cart_icon 	 = apply_filters( 'atelier_view_cart_icon', '<i class="ss-view"></i>' );
				$checkout_icon 	 	 = apply_filters( 'atelier_checkout_icon', '<i class="ss-creditcard"></i>' );
				$go_to_shop_icon  	 = apply_filters( 'atelier_go_to_shop_icon', '<i class="ss-cart"></i>' );

                if ( $show_cart_count ) {
                    $cart_output .= '<li class="parent shopping-bag-item edd-shopping-bag-item"><a class="edd-cart-contents" href="' . $cart_url . '" title="' . __( "View your shopping cart", 'atelier' ) . '">'. apply_filters( 'atelier_header_cart_icon', '<i class="ss-cart"></i>' ) . '<span class="cart-text">' . __( "Cart", 'atelier' ) . '</span>' . $cart_total . '<span class="num-items cart-count-enabled">' . $cart_count_text_alt . '</span></a>';
                } else {
                    $cart_output .= '<li class="parent shopping-bag-item edd-shopping-bag-item"><a class="edd-cart-contents" href="' . $cart_url . '" title="' . __( "View your shopping cart", 'atelier' ) . '">'. apply_filters( 'atelier_header_cart_icon', '<i class="ss-cart"></i>' ) . '<span class="cart-text">' . __( "Cart", 'atelier' ) . '</span>' . $cart_total . '<span class="num-items">' . $cart_count_text_alt . '</span></a>';
                }
                $cart_output .= '<ul class="sub-menu">';
                $cart_output .= '<li>';

                $cart_output .= '<div class="shopping-bag" data-empty-bag-txt="' . __( 'Your cart is empty.', 'atelier' ) . '" data-singular-item-txt="' . __( 'item in the cart', 'atelier' ) . '" data-multiple-item-txt="' . __( 'items in the cart', 'atelier' ) .'">';
            	
            	
	            	// get cart widget
	            	ob_start();
	            	the_widget( 'edd_cart_widget' );
	            	$widget = ob_get_contents();
	            	ob_end_clean();
	            		
	            	$cart_output .= $widget;
            	            	          
                $cart_output .= '</div>';
                $cart_output .= '</li>';
                $cart_output .= '</ul>';
                $cart_output .= '</li>';
            
            }

            return $cart_output;
        }
    }


    /* WISHLIST DROPDOWN
    ================================================== */
    if ( ! function_exists( 'atelier_get_wishlist' ) ) {
        function atelier_get_wishlist() {

            global $wpdb, $yith_wcwl, $woocommerce;

            if ( ! $yith_wcwl || ! $woocommerce ) {
                return;
            }

            $wishlist_output = "";

            if ( is_user_logged_in() ) {
                $user_id = get_current_user_id();
            }

            $wishlist_icon = apply_filters( 'atelier_view_wishlist_icon', '<i class="ss-star"></i>' );
            $count = YITH_WCWL()->count_products();

            if ( atelier_theme_opts_name() == "sf_atelier_options" || atelier_theme_opts_name() == "sf_atelier_options" ) {
				$wishlist_output .= '<li class="parent wishlist-item"><a class="wishlist-link" href="' . $yith_wcwl->get_wishlist_url() . '" title="' . __( "View your wishlist", 'atelier' ) . '"><span class="menu-item-title">' . __( "Wishlist", 'atelier' ) . '</span> ' . apply_filters( 'atelier_wishlist_menu_icon', '<i class="ss-star"></i>' ) . '<span class="count">' . $count . '</span><span class="star"></span></a>';
            } else {
	            $wishlist_output .= '<li class="parent wishlist-item"><a class="wishlist-link" href="' . $yith_wcwl->get_wishlist_url() . '" title="' . __( "View your wishlist", 'atelier' ) . '">' . apply_filters( 'atelier_wishlist_menu_icon', '<i class="ss-star"></i>' ) . '<span class="count">' . $count . '</span><span class="star"></span></a>';
            }
            $wishlist_output .= '<ul class="sub-menu">';
            $wishlist_output .= '<li>';
            $wishlist_output .= '<div class="wishlist-bag">';

            $current_page = 1;
            $limit_sql    = '';
            $count_limit  = 0;

            $is_user_owner = false;
            $query_args = array();

            if( ! empty( $user_id ) ){
                $query_args[ 'user_id' ] = $user_id;
                $query_args[ 'is_default' ] = 1;

                if( get_current_user_id() == $user_id ){
                    $is_user_owner = true;
                }
            }
            elseif( ! is_user_logged_in() ){
                if( empty( $wishlist_id ) ){
                    $query_args[ 'wishlist_id' ] = false;
                    $is_user_owner = true;
                }
                else{
                    $is_user_owner = false;

                    $query_args[ 'wishlist_token' ] = $wishlist_id;
                    $query_args[ 'wishlist_visibility' ] = 'visible';
                }
            }
            else{
                if( empty( $wishlist_id ) ){
                    $query_args[ 'user_id' ] = get_current_user_id();
                    $query_args[ 'is_default' ] = 1;
                    $is_user_owner = true;
                }
                else{
                    $wishlist = YITH_WCWL()->get_wishlist_detail_by_token( $wishlist_id );
                    $is_user_owner = $wishlist['user_id'] == get_current_user_id();

                    $query_args[ 'wishlist_token' ] = $wishlist_id;

                    if( ! empty( $wishlist ) && $wishlist['user_id'] != get_current_user_id() ){
                        $query_args[ 'user_id' ] = false;
                        if( ! current_user_can( apply_filters( 'yith_wcwl_view_wishlist_capability', 'manage_options' ) ) ){
                            $query_args[ 'wishlist_visibility' ] = 'visible';
                        }
                    }
                }
            }

            $wishlist_output .= '<div class="bag-contents">';

            $wishlist_output .= do_action( 'yith_wcwl_before_wishlist' );

            $wishlist_items = YITH_WCWL()->get_products($query_args);

            if ( !empty( $wishlist_items ) ) :

                foreach ( $wishlist_items as $values ) :

                    if ( $count_limit < 3 ) {

                        if ( ! is_user_logged_in() ) {
                            if ( isset( $values['add-to-wishlist'] ) && is_numeric( $values['add-to-wishlist'] ) ) {
                                $values['prod_id'] = $values['add-to-wishlist'];
                                $values['ID']      = $values['add-to-wishlist'];
                            } else {
                            	if ( isset($values['product_id'] )){
								   $values['prod_id'] = $values['product_id'];
                                   $values['ID']      = $values['product_id'];	
								}else{
									 $values['ID']      = $values['prod_id'];	
								}
                                
                            }
                        }

                        $product_obj = wc_get_product( $values['prod_id'] );

                        if ( $product_obj !== false && $product_obj->exists() ) :

                            $wishlist_output .= '<div id="wishlist-' . $values['ID'] . '" class="bag-product clearfix prod-' .  $values['prod_id'] . '">';

                            $wishlist_output .= '<figure><a class="bag-product-img" href="' . esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $values['prod_id'] ) ) ) . '">' . $product_obj->get_image() . '</a></figure>';

                            $wishlist_output .= '<div class="bag-product-details">';
                            $wishlist_output .= '<div class="bag-product-title"><a href="' . esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $values['prod_id'] ) ) ) . '">' . apply_filters( 'woocommerce_in_cartproduct_obj_title', $product_obj->get_title(), $product_obj ) . '</a></div>';

                            $wishlist_output .= $product_obj->get_price() ? $product_obj->get_price_html() : apply_filters( 'yith_free_text', __( 'Free!', 'atelier' ) );
                            
                            $wishlist_output .= '</div>';
                            $wishlist_output .= '</div>';

                        endif;

                        $count_limit ++;
                    }

                endforeach;

            else :
                $wishlist_output .= '<div class="wishlist-empty">' . __( 'Your wishlist is empty.', 'atelier' ) . '</div>';
            endif;

            $wishlist_output .= '</div>';

            if ( !empty( $wishlist_items ) ) {
				$wishlist_output .= '<div class="bag-buttons">';
			} else {
				$wishlist_output .= '<div class="bag-buttons no-items">';
			}
            $wishlist_output .= '<a class="sf-button standard sf-icon-reveal wishlist-button" href="' . $yith_wcwl->get_wishlist_url() . '">'.$wishlist_icon.'<span class="text">' . __( 'View Wishlist', 'atelier' ) . '</span></a>';

            $wishlist_output .= '</div>';

            $wishlist_output .= '</div>';
            $wishlist_output .= '</li>';
            $wishlist_output .= '</ul>';
            $wishlist_output .= '</li>';

            return $wishlist_output;
        }
    }

	/* CURRENCY DROPDOWN
	================================================== */
	if ( ! function_exists( 'atelier_get_currency_switcher' ) ) {
	    function atelier_get_currency_switcher() {
	    	$currency_switch_output = "";
	    	if ( class_exists('WCML_Multi_Currency') ) {
	    		$currency_code = get_option('woocommerce_currency');
	    		$currency_switch_output .= '<li class="parent currency-switch-item">';
	    		$currency_switch_output .= '<span class="current-currency">' . get_woocommerce_currency_symbol() . '</span>';
	    		$currency_switch_output .= do_shortcode('[currency_switcher switcher_style="dropdown" format="%code% (%symbol%)"]'); 
	    		$currency_switch_output .= '</li>';
	    		return $currency_switch_output;
	    	} else {
	    		$currency_switch_output = '<li><span class="current-currency">&times;</span><ul class="sub-menu"><li><span>WPML + WooCommerce Multilingual plugins are required for this functionality.</span></li></ul></li>';
	    		return $currency_switch_output;
	    	}
	    }
	}

    /* ACCOUNT
    ================================================== */
    if ( ! function_exists( 'atelier_get_account' ) ) {
        function atelier_get_account( $aux = "" ) {

        	// VARIABLES
            $login_url         = wp_login_url();
            $logout_url        = wp_logout_url( home_url() );
            $my_account_link   = get_admin_url();
            $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
            if ( $myaccount_page_id ) {
                $my_account_link = get_permalink( $myaccount_page_id );
                $logout_url      = wp_logout_url( get_permalink( $myaccount_page_id ) );
                $login_url       = get_permalink( $myaccount_page_id );
                if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
                    $logout_url = str_replace( 'http:', 'https:', $logout_url );
                    $login_url  = str_replace( 'http:', 'https:', $login_url );
                }
            }
            $login_url       = apply_filters( 'atelier_header_login_url', $login_url );
            $register_url	 = apply_filters( 'atelier_header_register_url', wp_registration_url() );
            $my_account_link = apply_filters( 'atelier_header_myaccount_url', $my_account_link );

			if ( get_option( 'woocommerce_enable_myaccount_registration' ) && $myaccount_page_id ) {
				$register_url = apply_filters( 'atelier_header_register_url', $my_account_link );
			}

            global $atelier_options;

            $show_sub         = $atelier_options['show_sub'];
            $show_translation = false;
            if ( isset($atelier_options['show_translation']) ) {
            	$show_translation = $atelier_options['show_translation'];
            }
            $sub_code         = __( $atelier_options['sub_code'], 'atelier' );
            $account_output = "";


            // LINKS + SEARCH OUTPUT
            $account_output .= '<nav class="std-menu">' . "\n";
            $account_output .= '<ul class="menu">' . "\n";
            $account_output .= '<li class="parent account-item">' . "\n";
            
            if ( $aux == "aux-text" ) {
            	$account_output .= '<a href="#">' . __( "My Account", 'atelier' ) . '</a>' . "\n";  
            } else {
				$account_output .= '<a href="#"><i class="sf-icon-account"></i></a>' . "\n";            
            }
            
			$account_output .= '<ul class="sub-menu">' . "\n";
            if ( is_user_logged_in() ) {
                $account_output .= '<li class="menu-item"><a href="' . $my_account_link . '" class="admin-link">' . __( "My Account", 'atelier' ) . '</a></li>' . "\n";
                
                if ( function_exists('bp_loggedin_user_domain') ) {
                	$account_output .= '<li class="menu-item aux-bp-profile"><a href="' . bp_loggedin_user_domain() . '">' . __( "Profile", 'atelier' ) . '</a>
                	</li>' . "\n";
                }
                if ( function_exists('bp_is_active') && bp_is_active('messages') ) {
                	$account_output .= '<li class="menu-item aux-bp-messages"><a href="' . bp_loggedin_user_domain() . 'messages/">' . sprintf( __( "Messages (%d)", 'atelier' ), messages_get_unread_count() ) . '</a>
                	</li>' . "\n";
                }
                if ( function_exists('bp_loggedin_user_domain') ) {
                	$user_id = bp_loggedin_user_id();
                	$notificaiton_count = bp_notifications_get_unread_notification_count( bp_loggedin_user_id() ); 	
					$account_output .= '<li class="menu-item aux-bp-notifications"><a href="' . bp_loggedin_user_domain() . 'notifications/">' . sprintf( __( "Notifications (%d)", 'atelier' ), $notificaiton_count ) . '</a>
					</li>' . "\n";
					
                	$account_output .= '<li class="menu-item aux-bp-settings"><a href="' . bp_loggedin_user_domain() . 'settings/">' . __( "Settings", 'atelier' ) . '</a>
                	</li>' . "\n";
                }
                
                $account_output .= '<li class="menu-item"><a href="' . $logout_url . '">' . __( "Sign Out", 'atelier' ) . '</a></li>' . "\n";
            } else {
                $account_output .= '<li class="menu-item"><a href="' . $login_url . '">' . __( "Login", 'atelier' ) . '</a></li>' . "\n";
                $account_output .= '<li class="menu-item"><a href="' . $register_url . '">' . __( "Sign Up", 'atelier' ) . '</a></li>' . "\n";
            }
            if ( $show_sub && $sub_code != "" ) {
                $account_output .= '<li class="parent"><a href="#">' . __( "Subscribe", 'atelier' ) . '</a>' . "\n";
                $account_output .= '<ul class="sub-menu">' . "\n";
                $account_output .= '<li><div class="header-subscribe clearfix">' . "\n";
                $account_output .= do_shortcode( $sub_code ) . "\n";
                $account_output .= '</div></li>' . "\n";
                $account_output .= '</ul>' . "\n";
                $account_output .= '</li>' . "\n";
            }
            if ( $show_translation ) {
                $account_output .= '<li class="parent aux-languages"><a href="#">' . __( "Language", 'atelier' ) . '</a>' . "\n";
                $account_output .= '<ul class="header-languages sub-menu">' . "\n";
                if ( function_exists( 'atelier_language_flags' ) ) {
                    $account_output .= atelier_language_flags();
                }
                $account_output .= '</ul>' . "\n";
                $account_output .= '</li>' . "\n";
            }
            $account_output .= '</ul>' . "\n";
            $account_output .= '</li>' . "\n";
            $account_output .= '</ul>' . "\n";
            $account_output .= '</nav>' . "\n";

            // RETURN
            return $account_output;

        }
    }
	
	
	/* LANGUAGE
    ================================================== */
    if ( ! function_exists( 'atelier_get_language_aux' ) ) {
        function atelier_get_language_aux( $aux = "" ) {

            $language_output = "";

            $language_output .= '<nav class="std-menu">' . "\n";
            $language_output .= '<ul class="menu">' . "\n";
            $language_output .= '<li class="parent language-item">' . "\n";
            
            if ( $aux == "aux-text" ) {
            	$language_output .= '<a href="#">' . __( "Language", 'atelier' ) . '</a>' . "\n";  
            } else {
				$language_output .= '<a href="#"><i class="sf-icon-uk"></i></a>' . "\n";            
            }
            
            $language_output .= '<ul class="header-languages sub-menu">' . "\n";
            if ( function_exists( 'atelier_language_flags' ) ) {
                $language_output .= atelier_language_flags();
            }
            $language_output .= '</ul>' . "\n";
            $language_output .= '</li>' . "\n";
            $language_output .= '</ul>' . "\n";
            $language_output .= '</nav>' . "\n";

            // RETURN
            return $language_output;
        }
    }
    

    /* AJAX SEARCH
    ================================================== */
    if ( ! function_exists( 'atelier_ajaxsearch' ) ) {
        function atelier_ajaxsearch() {
            atelier_get_template_part('search-results');
            die();
        }

        add_action( 'wp_ajax_atelier_ajaxsearch', 'atelier_ajaxsearch' );
        add_action( 'wp_ajax_nopriv_atelier_ajaxsearch', 'atelier_ajaxsearch' );
    }


    /* OVERLAY MENU
    ================================================== */
    if ( ! function_exists( 'atelier_overlay_menu' ) ) {
        function atelier_overlay_menu() {

			global $post;

            $overlayMenu = $page_menu = "";

            if ( $post && !is_search() ) {
                $page_menu = atelier_get_post_meta($post->ID, 'sf_page_menu', true );
            }

            $overlay_menu_args = array(
                'echo'           => false,
                'theme_location' => 'overlay_menu',
                'fallback_cb'    => '',
                'menu'			 => $page_menu
            );

            $overlayMenu .= '<div id="overlay-menu">';
            $overlayMenu .= '<nav>';
            if ( function_exists( 'wp_nav_menu' ) ) {
                $overlayMenu .= wp_nav_menu( $overlay_menu_args );
            }
            $overlayMenu .= '</nav>';
            $overlayMenu .= '</div>';


            return $overlayMenu;
        }
    }


    /* CONTACT SLIDEOUT
    ================================================== */
    if ( ! function_exists( 'atelier_contact_slideout' ) ) {
        function atelier_contact_slideout() {

            global $atelier_options;

            $contact_slideout_page = __( $atelier_options['contact_slideout_page'], 'atelier' );
			$contact_slideout_page = apply_filters('wpml_object_id', $contact_slideout_page, 'page', true);
            $contact_slideout = "";

            $contact_slideout .= '<div id="contact-slideout">';
            $contact_slideout .= '<div class="container">';
            if ( $contact_slideout_page ) {
                $page    = get_post( $contact_slideout_page );
                $content = apply_filters( 'the_content', $page->post_content );
                $contact_slideout .= do_shortcode($content);
            } else {
                $contact_slideout .= __( "Please select a page for the Contact Slideout in Theme Options > Header Options", 'atelier' );
            }
            $contact_slideout .= '</div>';
            $contact_slideout .= '</div>';

            return $contact_slideout;
        }
    }


	 /* WISHLIST PRODUCT HTML
    ================================================== */
    if ( ! function_exists( 'atelier_get_wishlist_product' ) ) {
        function atelier_get_wishlist_product($product_id) {
            global $yith_wcwl, $woocommerce;
            $wishlist_output = "";
            $product_obj = new WC_Product( $product_id );

             $wishlist_icon = apply_filters( 'atelier_view_wishlist_icon', '<i class="ss-star"></i>' );

             if ( $product_obj !== false && $product_obj->exists() ) {

                $wishlist_output .= '<div id="wishlist-' . $product_id . '" class="bag-product clearfix">';

                if ( has_post_thumbnail( $product_id ) ) {
                    $image_link = wp_get_attachment_url( get_post_thumbnail_id( $product_id ) );
                    $image      = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'thumbnail' );

                    if ( $image ) {
                          $wishlist_output .= '<figure><a class="bag-product-img" href="' . esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $product_id  ) ) ) . '"><img itemprop="image" src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" /></a></figure>';
                    }
                }

                $wishlist_output .= '<div class="bag-product-details">';
                $wishlist_output .= '<div class="bag-product-title"><a href="' . esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $product_id ) ) ) . '">' . apply_filters( 'woocommerce_in_cartproduct_obj_title', $product_obj->get_title(), $product_obj ) . '</a></div>';

                if ( get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' ) {
                    $wishlist_output .= '<div class="bag-product-price">' . apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_obj->get_price_excluding_tax() ), '' ) . '</div>';
                } else {
                    $wishlist_output .= '<div class="bag-product-price">' . apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_obj->get_price() ), '' ) . '</div>';
                }
                $wishlist_output .= '</div>';
                $wishlist_output .= '</div>';

            }

            return $wishlist_output;

		}

	}


	 /* WISHLIST UPDATE
    ================================================== */
    if ( ! function_exists( 'atelier_add_to_wishlist' ) ) {
        function atelier_add_to_wishlist() {

        	if ( ! empty( $_REQUEST['product_id'] ) ) {
                $product_id = $_REQUEST['product_id'];
            }

            $wishlist_itens = array();
           	$wishlist_itens['wishlist_output'] = atelier_get_wishlist_product($product_id);

            echo json_encode( $wishlist_itens );
            die();

		}
		add_action( 'wp_ajax_atelier_add_to_wishlist', 'atelier_add_to_wishlist' );
	    add_action( 'wp_ajax_nopriv_atelier_add_to_wishlist', 'atelier_add_to_wishlist' );
	}


	/* GLOBAL HEADER BANNER
    ================================================== */
    if ( ! function_exists( 'atelier_header_banner_bar' ) ) {
        function atelier_header_banner_bar() {
            global $atelier_options, $post;
			$enable_global_banner = false;

			if ( isset($atelier_options['enable_global_banner']) ) {
            	$enable_global_banner  = $atelier_options['enable_global_banner'];
            }

            if ( $enable_global_banner ) {
            	$gb_layout 			= $atelier_options['global_banner_layout'];
            	$fullwidth_header   = $atelier_options['fullwidth_header'];

                ?>
                <!--// OPEN #sf-header-banner //-->
                <?php if ( $fullwidth_header ) { ?>
	            <div id="sf-header-banner" class="banner-fw-header clearfix">
                <?php } else { ?>
                <div id="sf-header-banner" class="clearfix">
				<?php } ?>

                	<div class="container">

                		<div id="sf-banner-widgets" class="row clearfix">
                            <?php if ( $gb_layout == "gb-1" ) { ?>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-3' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-4' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $gb_layout == "gb-2" ) { ?>

                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-3' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $gb_layout == "gb-3" ) { ?>

                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-3' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $gb_layout == "gb-4" ) { ?>

                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-2' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $gb_layout == "gb-5" ) { ?>

                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-3' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $gb_layout == "gb-6" ) { ?>

                                <div class="col-sm-8">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-2' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $gb_layout == "gb-7" ) { ?>

                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-8">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-2' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $gb_layout == "gb-8" ) { ?>

                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-3' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else { ?>

                                <div class="col-sm-12">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'gb-column-1' ); ?>
                                    <?php } ?>

                                </div>
                            <?php } ?>

                		</div>

                	</div>

                    <!--// CLOSE #sf-header-banner //-->
                </div>
            <?php
            }

        }

        add_action( 'atelier_container_start', 'atelier_header_banner_bar', 30 );
    }

?>
