<?php
    /*
    *
    *	Head Tag Functions
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	atelier_head_meta()
    *	atelier_page_classes()
    *	atelier_tracking()
    *
    */


    /* HEAD META
    ================================================== */
    if ( ! function_exists( 'atelier_head_meta' ) ) {
        function atelier_head_meta() {

            global $atelier_options;

            $enable_responsive = $atelier_options['enable_responsive'];
            global $post, $remove_promo_bar, $enable_one_page_nav;
            if ( $post ) {
                $remove_promo_bar    = atelier_get_post_meta($post->ID, 'sf_remove_promo_bar', true );
                $enable_one_page_nav = atelier_get_post_meta($post->ID, 'sf_enable_one_page_nav', true );
            }
            ?>

            <!--// SITE META //-->
            <meta charset="<?php bloginfo( 'charset' ); ?>"/>
            <?php if ( $enable_responsive ) { ?>
            	<?php $viewport_content = apply_filters( 'atelier_viewport_content' , "width=device-width, initial-scale=1.0" ); ?>
                <meta name="viewport" content="<?php echo esc_attr($viewport_content); ?>"/>
            <?php } ?>

            <!--// PINGBACK & FAVICON //-->
            <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>

        <?php
        }

        add_action( 'wp_head', 'atelier_head_meta', 0 );
    }


    /* SOCIAL META
    ================================================== */
    if ( ! function_exists( 'atelier_social_meta' ) ) {
        function atelier_social_meta() {
            global $post, $atelier_options;

            $logo = array();
            if ( isset( $atelier_options['logo_upload'] ) ) {
                $logo = $atelier_options['logo_upload'];
            }
            $disable_social_meta = false;
            if ( isset( $atelier_options['disable_social_meta'] ) ) {
                $disable_social_meta = $atelier_options['disable_social_meta'];
            }

            if ( ! $post || ! is_singular() || class_exists( 'WPSEO_Admin' ) || $disable_social_meta ) {
                return;
            }

            $title             = strip_tags( get_the_title() );
            $permalink         = get_permalink();
            $site_name         = get_bloginfo( 'name' );
            $excerpt = '';
            $custom_excerpt = get_post_meta( $post->ID, 'sf_custom_excerpt', true );
            if ( $custom_excerpt != "" ) {
            $excerpt = wp_strip_all_tags($custom_excerpt);
            } elseif ( has_excerpt( $post->ID ) ) {
            $excerpt = wp_strip_all_tags(get_the_excerpt());
            }
            $twitter_author    = $atelier_options['twitter_author_username'];
            $googleplus_author = $atelier_options['googleplus_author'];
            $og_type = 'article';
            if ( function_exists( 'is_product' ) && is_product() ) {
                $og_type = 'product';
                $product_description       = atelier_get_post_meta( $post->ID, 'sf_product_description', true );
                $product_short_description = atelier_get_post_meta( $post->ID, 'sf_product_short_description', true );
                if ( $product_description != "" ) {
                    $excerpt = wp_strip_all_tags( $product_description );
                } else if ( $product_short_description != "" ) {
                    $excerpt = wp_strip_all_tags( $product_short_description );
                }
            }

            $image_url = "";
            if ( has_post_thumbnail( $post->ID ) ) {
                $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                $image_url = esc_attr( $thumbnail[0] );
            } else if ( isset( $logo['url'] ) && $logo['url'] != "" ) {
                $image_url = $logo['url'];
            }

            echo "" . "\n";
            echo '<!-- Facebook Meta -->' . "\n";
            echo '<meta property="og:title" content="' . $title . ' - ' . $site_name . '"/>' . "\n";
            echo '<meta property="og:type" content="' . $og_type . '"/>' . "\n";
            echo '<meta property="og:url" content="' . $permalink . '"/>' . "\n";
            echo '<meta property="og:site_name" content="' . $site_name . '"/>' . "\n";
            echo '<meta property="og:description" content="' . $excerpt . '">' . "\n";
            if ( $image_url != "" ) {
                echo '<meta property="og:image" content="' . $image_url . '"/>' . "\n";
            }
            if ( function_exists( 'is_product' ) && is_product() ) {
                $product = new WC_Product( $post->ID );
                $product_price = method_exists( $product, 'get_price' ) ? $product->get_price() : $product->price;
                echo '<meta property="og:price:amount" content="' . $product_price . '" />' . "\n";
                echo '<meta property="og:price:currency" content="' . get_woocommerce_currency() . '" />' . "\n";
            }

            echo "" . "\n";
            echo '<!-- Twitter Card data -->' . "\n";
            echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
            echo '<meta name="twitter:title" content="' . $title . '">' . "\n";
            echo '<meta name="twitter:description" content="' . $excerpt . '">' . "\n";
            if ( $twitter_author != "" ) {
                echo '<meta name="twitter:site" content="@' . $twitter_author . '">' . "\n";
                echo '<meta name="twitter:creator" content="@' . $twitter_author . '">' . "\n";
            }
            if ( $image_url != "" ) {
                echo '<meta property="twitter:image:src" content="' . $image_url . '"/>' . "\n";
            }
            if ( function_exists( 'is_product' ) && is_product() ) {
                $product = new WC_Product( $post->ID );
                $product_price = method_exists( $product, 'get_price' ) ? $product->get_price() : $product->price;
                echo '<meta name="twitter:data1" content="' . $product_price . '">' . "\n";
                echo '<meta name="twitter:label1" content="Price">' . "\n";
            }
            echo "" . "\n";

            echo "" . "\n";
            if ( $googleplus_author != "" ) {
                echo '<!-- Google Authorship and Publisher Markup -->' . "\n";
                echo '<link rel="author" href="https://plus.google.com/' . $googleplus_author . '/posts"/>' . "\n";
                echo '<link rel="publisher" href="https://plus.google.com/' . $googleplus_author . '"/>' . "\n";
            }
        }

        add_action( 'wp_head', 'atelier_social_meta', 5 );
    }


    /* PAGE CLASS
    ================================================== */
    if ( ! function_exists( 'atelier_page_classes' ) ) {
        function atelier_page_classes() {

            // Get options
            global $atelier_options, $post, $atelier_catalog_mode;

            $enable_responsive = $atelier_options['enable_responsive'];
            $is_responsive     = "responsive-fluid";
            if ( ! $enable_responsive ) {
                $is_responsive = "responsive-fixed";
            }
            $enable_rtl   = $atelier_options['enable_rtl'];
            $design_style = atelier_get_option( 'design_style_type', 'minimal' );

            $page_header_type = $page_slider = $page_header_alt_logo = $page_style = $page_design_style = $app_header_style = $sticky_header_transparent = "";
            $header_layout    = $atelier_options['header_layout'];
            if ( isset( $_GET['header'] ) ) {
                $header_layout = $_GET['header'];
            }
            if ( $header_layout == '' ) {
                $header_layout = 'header-1';
            }
            $page_layout             = $atelier_options['page_layout'];
            $enable_page_shadow      = $atelier_options['enable_page_shadow'];
            $enable_page_transitions = $atelier_options['enable_page_transitions'];
            $page_transition         = $atelier_options['page_transition'];
            $enable_header_shadow    = false;
            $mobile_two_click        = false;
            if ( isset( $atelier_options['enable_header_shadow'] ) ) {
                $enable_header_shadow = $atelier_options['enable_header_shadow'];
            }
            $product_image_shadows = true;
            if ( isset( $atelier_options['product_image_shadows'] ) ) {
            	$product_image_shadows 	   = $atelier_options['product_image_shadows'];
            }
            if ( isset( $atelier_options['enable_mobile_two_click'] ) ) {
                $mobile_two_click = $atelier_options['enable_mobile_two_click'];
            }
            $enable_mini_header        = $atelier_options['enable_mini_header'];
            $enable_mini_header_resize = $atelier_options['enable_mini_header_resize'];
            $header_search_type        = $atelier_options['header_search_type'];
            $mobile_header_layout      = $atelier_options['mobile_header_layout'];
            $mobile_header_shown       = $atelier_options['mobile_header_shown'];
            $mobile_header_sticky      = $atelier_options['mobile_header_sticky'];
            $mobile_menu_type          = "slideout";
            $enable_sticky_header_hide = false;
            $enable_newsletter_sub_bar = $enable_newsletter_sub_bar_page = false;
            if ( isset( $atelier_options['mobile_menu_type'] ) ) {
                $mobile_menu_type = $atelier_options['mobile_menu_type'];
            }
            $enable_articleswipe = 0;
            if ( isset( $atelier_options['enable_articleswipe'] ) ) {
                $enable_articleswipe = $atelier_options['enable_articleswipe'];
            }
            $home_preloader = false;
            if ( isset( $atelier_options['home_preloader'] ) ) {
                $home_preloader = $atelier_options['home_preloader'];
            }
            if ( isset( $atelier_options['enable_sticky_header_hide'] ) ) {
            	$enable_sticky_header_hide = $atelier_options['enable_sticky_header_hide'];
            }
            if ( isset($atelier_options['enable_newsletter_sub_bar']) ) {
            	$enable_newsletter_sub_bar  = $atelier_options['enable_newsletter_sub_bar'];
            }

            if ( $post && is_singular() && !is_search() ) {
                $page_header_type     = atelier_get_post_meta($post->ID, 'sf_page_header_type', true );
                $page_header_alt_logo = atelier_get_post_meta($post->ID, 'sf_page_header_alt_logo', true );
                $page_slider          = atelier_get_post_meta($post->ID, 'sf_page_slider', true );
                $page_design_style 	  = atelier_get_post_meta($post->ID, 'sf_page_design_style', true );
				$enable_newsletter_sub_bar_page = atelier_get_post_meta($post->ID, 'sf_enable_newsletter_bar', true);
				$app_header_style	  = atelier_get_post_meta($post->ID, 'sf_page_header_app_style', true );
				$sticky_header_transparent = atelier_get_post_meta($post->ID, 'sf_sticky_header_transparent', true );
            }
            if ( isset($atelier_options['enable_newsletter_sub_bar_global']) ) {
            	$enable_newsletter_sub_bar_page  = $atelier_options['enable_newsletter_sub_bar_global'];
            }
            $page_header_alt_logo = apply_filters( 'atelier_page_header_alt_logo', $page_header_alt_logo );

            // Shop page check
            $shop_page = false;
            if ( ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_category' ) && is_product_category() ) ) {
                $shop_page = true;
            }

            if ( $shop_page ) {
                if ( isset($atelier_options['woo_page_header']) ) {
                    $page_header_type = $atelier_options['woo_page_header'];
                }
            }

            if ( ( $page_header_type == "naked-light" || $page_header_type == "naked-dark" ) && ( $header_layout == "header-vert" || $header_layout == "header-vert-right" ) ) {
                $header_layout = apply_filters( 'atelier_naked_default_header', "header-1" );
            }

            // Create variables
            $page_class = $header_wrap_class = $logo_class = $shop_icon_style = "";

            // Design Style
            if ( isset( $_GET['design_style'] ) ) {
                $design_style = $_GET['design_style'];
            }
            $page_class .= $design_style . "-design ";

			// Theme Specific
			if ( atelier_theme_opts_name() == "sf_atelier_options" ) {
				//$page_class .= 'ss-parallax-disabled ';
			}

            // Header Layout
            if ( $page_header_type == "standard-overlay" ) {
                $page_class .= "header-overlay ";
            } else if ( $header_layout == "header-5" ) {
                $page_class .= "header-5-overlay ";
            }
            if ( $header_layout == "header-vert" ) {
                $page_class .= "vertical-header ";
            }
            if ( $header_layout == "header-vert-right" ) {
                $page_class .= "vertical-header vertical-header-right ";
            }
            if ( $header_layout == "header-3" || $header_layout == "header-4" || $header_layout == "header-5" || $header_layout == "header-split" || $header_layout == "header-4-alt" ) {
                $header_wrap_class = " full-center";
            }
            if ( $header_layout == "header-3" || $header_layout == "header-4" || $header_layout == "header-5" || $header_layout == "header-7" || $header_layout == "header-8" || $header_layout == "header-split" || $header_layout == "header-4-alt" ) {
                $header_wrap_class .= " full-header-stick";
            }
            if ( atelier_theme_opts_name() == "sf_atelier_options" ) {
            	if ( $header_layout == "header-1" || $header_layout == "header-2" ) {
            	    $header_wrap_class .= " full-header-stick";
            	}
            }

            // Mobile Header Layout
            $page_class .= "mobile-header-" . $mobile_header_layout . " ";
            $page_class .= "mhs-" . $mobile_header_shown . " ";
            if ( $mobile_header_sticky ) {
                $page_class .= "mh-sticky ";
            }
            $page_class .= 'mh-' . $mobile_menu_type . ' ';

            // Catalog Mode
            if ( isset( $atelier_options['enable_catalog_mode'] ) ) {
                $enable_catalog_mode = $atelier_options['enable_catalog_mode'];

                if ( isset( $_GET['catalog_mode'] ) ) {
                    $enable_catalog_mode = $_GET['catalog_mode'];
                }

                if ( $enable_catalog_mode ) {
                    $atelier_catalog_mode = true;
                    $page_class .= "catalog-mode ";
                }
            }

            // Responsive class
            $page_class .= $is_responsive . ' ';

            // RTL class
            if ( is_rtl() || $enable_rtl || isset( $_GET['RTL'] ) ) {
                $page_class .= 'rtl ';
            }

            // Mini header
            if ( $enable_mini_header && ! ( $header_layout == "header-vert" || $header_layout == "header-vert-right" ) ) {
                $page_class .= "sticky-header-enabled ";
                if ( $enable_mini_header_resize ) {
                    $page_class .= "sh-dynamic ";
                }
            	if ( $enable_sticky_header_hide ) {
            		$page_class .= "sh-show-hide ";
            	}
            } else {
            	$page_class .= "sticky-header-disabled ";
            }

            // Page Shadow
            if ( $enable_page_shadow ) {
                $page_class .= "page-shadow ";
            }

            // Mobile 2 Click
            if ( $mobile_two_click ) {
                $page_class .= "mobile-two-click ";
            }

            // Page Transtions
            if ( $enable_page_transitions ) {
                $page_class .= "page-transitions page-transition-" .$page_transition. " ";
                if ( $page_transition == "loading-bar" ) {
                    $page_class .= "loading-bar-transition ";
                }
            }

            // Page Style
            if ( $page_design_style != "" ) {
            	$page_class .= $page_design_style . ' ';
            }

            // Header Shadow
            if ( $enable_header_shadow ) {
                $page_class .= "header-shadow ";
            }

            // Product Shadow
            if ( $product_image_shadows ) {
            	$page_class .= "product-shadows ";
            }

            // Page Header Type
            if ( $page_header_type != "" ) {
                $page_class .= 'header-' . $page_header_type . ' ';
            }
            
            // Header Style
            if ( $enable_mini_header && $app_header_style && ! ( $header_layout == "header-vert" || $header_layout == "header-vert-right" ) ) {
            	$page_class .= 'app-header ';
            }
            
            // Transparent sticky header
            if ( $enable_mini_header && $sticky_header_transparent && !$app_header_style && ! ( $header_layout == "header-vert" || $header_layout == "header-vert-right" ) ) {
            	$page_class .= 'sticky-header-transparent ';
            }

            // Page Header Logo
            if ( $page_header_alt_logo ) {
                $page_class .= 'logo-alt-version ';
            }

            if ( is_singular( 'post' ) && $post ) {
                $post_header_type = atelier_get_post_meta($post->ID, 'sf_page_header_type', true );
                $fw_media_display = atelier_get_post_meta($post->ID, 'sf_fw_media_display', true );
                $page_title_style = atelier_get_post_meta($post->ID, 'sf_page_title_style', true );
				$page_title_style = apply_filters( 'atelier_page_title_style', $page_title_style );
				
                if ( $page_title_style == "fancy" || $fw_media_display == "fw-media-title" || $fw_media_display == "fw-media" ) {
                    $page_class .= 'header-' . $post_header_type . ' ';
                }
            }

            if ( function_exists( 'is_product' ) && is_product() ) {
                $product_layout = atelier_get_post_meta( $post->ID, 'sf_product_layout', true );
                $page_class .= 'product-' . $product_layout . ' ';
            }

            // Layout
            if ( isset( $_GET['layout'] ) ) {
                $page_layout = $_GET['layout'];
            }
            $page_class .= "layout-" . $page_layout . " ";


            // Article Swipe
            if ( $enable_articleswipe ) {
                $page_class .= 'article-swipe ';
            }

            if ( $home_preloader && ( is_home() || is_front_page() ) && ! is_paged() ) {
                $page_class .= 'sf-preloader ';
            }

            if ( ( $enable_newsletter_sub_bar && ( is_home() || is_front_page() ) && ! is_paged() ) || $enable_newsletter_sub_bar_page ) {
            	$page_class .= 'has-newsletter-bar ';
            }

            // Page Heading
            if ( $post && is_singular() ) {
                $show_page_title       = atelier_get_post_meta($post->ID, 'sf_page_title', true );
                $remove_breadcrumbs    = atelier_get_post_meta($post->ID, 'sf_no_breadcrumbs', true );
                $page_title_style      = atelier_get_post_meta($post->ID, 'sf_page_title_style', true );
                $page_title_style 	   = apply_filters( 'atelier_page_title_style', $page_title_style );
                if ( function_exists( 'is_product' ) && is_product() && atelier_theme_supports( 'product-inner-heading' ) && $page_title_style == "fancy-tabbed" ) {
                	$page_title_style = "fancy";
                }
            	if ( $show_page_title ) {
            		$page_class .= 'page-heading-' . $page_title_style . ' ';
            	}
            }
            $shop_page = false;
            if ( ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_category' ) && is_product_category() ) ) {
                $shop_page = true;
            }

            if ( $shop_page ) {
            	$show_page_title       = $atelier_options['woo_show_page_heading'];
            	$page_title_style      = $atelier_options['woo_page_heading_style'];
            	$page_title_style 	   = apply_filters( 'atelier_page_title_style', $page_title_style );
            	if ( $show_page_title ) {
            		$page_class .= 'page-heading-' . $page_title_style . ' ';
            	}
            }
            if ( atelier_woocommerce_activated() ) {
            	if ( isset($atelier_options['shop_icon_style']) ) {
            		$shop_icon_style = $atelier_options['shop_icon_style'];
            	}
            	$page_class .= 'shop-icon-' . $shop_icon_style . ' ';

            	if ( isset($atelier_options['minimal_checkout']) ) {

	            	if ( $atelier_options['minimal_checkout'] ) {
		            	$page_class .= 'minimal-checkout ';
	            	}
            	}
            }


	        if ( $atelier_options['disable_mobile_animations'] ) {
	            $page_class .= "disable-mobile-animations ";
	        }
	        
	        $global_filters = false;
	        if ( isset($atelier_options['enable_woo_global_filters']) ) {
	        	$global_filters = $atelier_options['enable_woo_global_filters'];
	        	
	        	if ( $global_filters ) {
	        		$page_class .= 'woo-global-filters-enabled ';
	        	}
	        }
	        
	        
	        // Check for Quickview
	        if ( class_exists( 'jckqv' ) ) {
	        	$quickview_opts = get_option('jckqv_settings');
	        	$quickview_pos = $quickview_opts['trigger_position_position'];
	        	
	        	if ( $quickview_pos == "afteritem" ) {
	        		$page_class .= 'has-quickview-hover-btn ';
	        	}
	        }

            // Return array of classes
            $class_array = array(
                "page-layout"   => $page_layout,
                "page"          => $page_class,
                "header-layout" => $header_layout,
                "header-wrap"   => $header_wrap_class,
                "logo"          => $logo_class,
                "search-type"   => $header_search_type
            );

            return $class_array;
        }
    }
		

    /* TRACKING
    ================================================== */
    if ( ! function_exists( 'atelier_tracking' ) ) {
        function atelier_tracking() {
            if ( get_option('sf_atelier_options')['google_analytics'] != "" ) {
                echo get_option('sf_atelier_options')['google_analytics'];
            }
        }

        add_action( 'wp_head', 'atelier_tracking', 90 );
    }
?>
