<?php
    /*
    *
    *	Footer Functions
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	atelier_footer_promo()
    *	atelier_footer_widgets()
    *	atelier_footer_copyright()
    *	atelier_one_page_nav()
    *	atelier_back_to_top()
    *	atelier_fw_video_area()
    *	atelier_inf_scroll_params()
    *	atelier_included()
    *	atelier_option_parameters()
    *	atelier_countdown_shortcode_locale()
    *	atelier_loveit_locale()
    *
    */

    /* NEWSLETTER/SUBSCRIBE BAR
    ================================================== */
    if ( ! function_exists( 'atelier_newsletter_bar' ) ) {
        function atelier_newsletter_bar() {
            global $atelier_options, $post;
			$enable_newsletter_sub_bar = $enable_newsletter_bar_page = false;

			if ( isset($atelier_options['enable_newsletter_sub_bar']) ) {
            	$enable_newsletter_sub_bar  = $atelier_options['enable_newsletter_sub_bar'];
            }

			if ( is_page() && $post ) {
            	$enable_newsletter_bar_page = atelier_get_post_meta($post->ID, 'sf_enable_newsletter_bar', true);
			}
			
			if ( !$enable_newsletter_bar_page && isset($atelier_options['enable_newsletter_sub_bar_global']) ) {
				$enable_newsletter_bar_page  = $atelier_options['enable_newsletter_sub_bar_global'];
			}

            if ( ( $enable_newsletter_sub_bar && ( is_home() || is_front_page() ) ) || $enable_newsletter_bar_page ) {
            	$sub_bar_text 				= __( $atelier_options['sub_bar_text'], 'atelier' );
            	$sub_bar_code 				= __( $atelier_options['sub_bar_code'], 'atelier' );
            	$fullwidth_header    		= $atelier_options['fullwidth_header'];
                $page_layout             = $atelier_options['page_layout'];
                if ( isset( $_GET['layout'] ) ) {
                    $page_layout = $_GET['layout'];
                }
                ?>
                <!--// OPEN #sf-newsletter-bar //-->
                <div id="sf-newsletter-bar">

                	<?php if ( !$fullwidth_header || $page_layout == "boxed" ) { ?>
                	<div class="container">
                	<?php } ?>
                		<h3 class="sub-text"><?php echo esc_attr($sub_bar_text); ?></h3>
                		<div class="sub-code"><?php echo do_shortcode($sub_bar_code); ?></div>
                		<a href="#" class="sub-close"><i class="sf-icon-close"></i></a>

                	<?php if ( !$fullwidth_header || $page_layout == "boxed" ) { ?>
                	</div>
                	<?php } ?>

                    <!--// CLOSE #sf-newsletter-bar //-->
                </div>
            <?php
            }

        }

        add_action( 'atelier_after_page_container', 'atelier_newsletter_bar', 30 );
    }


    /* FOOTER PROMO
    ================================================== */
    if ( ! function_exists( 'atelier_footer_promo' ) ) {
        function atelier_footer_promo() {
            global $atelier_options;

			$footer_promo_bar_text_size = "";
			$footer_promo_bar_button_type = "drop-shadow";

            $enable_footer_promo_bar        = $atelier_options['enable_footer_promo_bar'];
            $footer_promo_bar_type          = $atelier_options['footer_promo_bar_type'];
            $footer_promo_bar_text          = __( $atelier_options['footer_promo_bar_text'], 'atelier' );
            $footer_promo_bar_button_color  = $atelier_options['footer_promo_bar_button_color'];
            $footer_promo_bar_button_text   = __( $atelier_options['footer_promo_bar_button_text'], 'atelier' );
            $footer_promo_bar_button_link   = __( $atelier_options['footer_promo_bar_button_link'], 'atelier' );
            $footer_promo_bar_button_target = $atelier_options['footer_promo_bar_button_target'];

			if ( isset($atelier_options['footer_promo_bar_text_size']) ) {
				$footer_promo_bar_text_size	    = $atelier_options['footer_promo_bar_text_size'];
			}
			if ( isset($atelier_options['footer_promo_bar_button_type']) ) {
				$footer_promo_bar_button_type	    = $atelier_options['footer_promo_bar_button_type'];
			}

            if ( $enable_footer_promo_bar ) {
                ?>
                <!--// OPEN #base-promo //-->
                <div id="base-promo" class="sf-promo-bar promo-<?php echo esc_attr($footer_promo_bar_type); ?>">
                    <?php if ( $footer_promo_bar_type == "button" ) { ?>
                        <p class="<?php echo esc_attr($footer_promo_bar_text_size); ?>"><?php echo esc_attr($footer_promo_bar_text); ?></p>
                        <a href="<?php echo esc_url($footer_promo_bar_button_link); ?>"
                           target="<?php echo esc_attr($footer_promo_bar_button_target); ?>"
                           class="sf-button <?php echo esc_attr($footer_promo_bar_button_type); ?> <?php echo esc_attr($footer_promo_bar_button_color); ?>"><?php echo esc_attr($footer_promo_bar_button_text); ?></a>
                    <?php } else if ( $footer_promo_bar_type == "arrow" ) { ?>
                        <a href="<?php echo esc_url($footer_promo_bar_button_link); ?>"
                           target="<?php echo esc_attr($footer_promo_bar_button_target); ?>"><?php echo esc_attr($footer_promo_bar_text); ?>
                            <?php echo apply_filters( 'atelier_next_icon', '<i class="ss-navigateright"></i>' ); ?></a>
                    <?php } else { ?>
                        <a href="<?php echo esc_url($footer_promo_bar_button_link); ?>"
                           target="<?php echo esc_attr($footer_promo_bar_button_target); ?>" class="<?php echo esc_attr($footer_promo_bar_text_size); ?>"><?php echo esc_attr($footer_promo_bar_text); ?></a>
                    <?php } ?>
                    <!--// CLOSE #base-promo //-->
                </div>
            <?php
            }

        }

        add_action( 'atelier_main_container_end', 'atelier_footer_promo', 20 );
    }


    /* FOOTER WIDGET AREA
    ================================================== */
    if ( ! function_exists( 'atelier_footer_widgets' ) ) {
        function atelier_footer_widgets() {
            global $atelier_options;

            $enable_footer         = $atelier_options['enable_footer'];
            $enable_footer_divider = $atelier_options['enable_footer_divider'];
            $footer_config         = $atelier_options['footer_layout'];
            $footer_class          = "";
            if ( $enable_footer_divider ) {
                $footer_class = "footer-divider";
            }

            if ( $enable_footer ) {
                ?>
                <!--// OPEN #footer //-->
                <footer id="footer" class="<?php echo esc_attr($footer_class); ?>">
                    <div class="container">
                        <div id="footer-widgets" class="row clearfix">
                            <?php if ( $footer_config == "footer-1" ) { ?>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-3' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-4' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $footer_config == "footer-2" ) { ?>

                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-3' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $footer_config == "footer-3" ) { ?>

                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-3' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $footer_config == "footer-4" ) { ?>

                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-2' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $footer_config == "footer-5" ) { ?>

                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-3' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $footer_config == "footer-6" ) { ?>

                                <div class="col-sm-8">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-2' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $footer_config == "footer-7" ) { ?>

                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-8">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-2' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else if ( $footer_config == "footer-8" ) { ?>

                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-3' ); ?>
                                    <?php } ?>
                                </div>

                            <?php } else { ?>

                                <div class="col-sm-12">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-column-1' ); ?>
                                    <?php } ?>

                                </div>
                            <?php } ?>

                        </div>
                    </div>

                    <?php do_action( 'atelier_footer_wrap_after' ); ?>

                    <!--// CLOSE #footer //-->
                </footer>
            <?php
            }

        }

        add_action( 'atelier_footer_wrap_content', 'atelier_footer_widgets', 10 );
    }


    /* FOOTER COPYRIGHT
    ================================================== */
    if ( ! function_exists( 'atelier_footer_copyright' ) ) {
        function atelier_footer_copyright() {
            global $atelier_options;

            $enable_copyright         = $atelier_options['enable_copyright'];
            $enable_copyright_divider = $atelier_options['enable_copyright_divider'];
            $copyright_right          = $atelier_options['copyright_right'];
            $show_backlink            = $atelier_options['show_backlink'];
            $copyright_text           = __( $atelier_options['footer_copyright_text'], 'atelier' );
            $copyright_text_right     = __( $atelier_options['footer_copyright_text_right'], 'atelier' );
            $swiftideas_backlink      = $copyright_class = "";

            if ( $enable_copyright_divider ) {
                $copyright_class = "copyright-divider";
            }

            if ( $enable_copyright ) {
                ?>

                <!--// OPEN #copyright //-->
                <footer id="copyright" class="<?php echo esc_attr($copyright_class); ?>">
                    <div class="container">
                        <div
                            class="text-left"><?php echo do_shortcode( stripslashes( $copyright_text ) ); ?>
                            <?php if ( $show_backlink ) {
                                echo apply_filters( "swiftideas_link", " <a href='http://www.swiftideas.com' rel='nofollow'>Premium WordPress Themes by Swift Ideas</a>" );
                            }?></div>
                        <?php if ( $copyright_right == "menu" ) { ?>
                            <nav class="footer-menu std-menu">
                                <?php
                                    $footer_menu_args = array(
                                        'echo'           => true,
                                        'theme_location' => 'footer_menu',
                                        'walker'         => new atelier_alt_menu_walker,
                                        'fallback_cb'    => ''
                                    );
                                    wp_nav_menu( $footer_menu_args );
                                ?>
                            </nav>
                        <?php } else { ?>
                            <div
                                class="text-right"><?php echo do_shortcode( stripslashes( $copyright_text_right ) ); ?></div>
                        <?php } ?>
                    </div>
                    <!--// CLOSE #copyright //-->
                </footer>

            <?php
            }

        }

        add_action( 'atelier_footer_wrap_content', 'atelier_footer_copyright', 20 );
    }

    /* ONE PAGE NAV
    ================================================== */
    if ( ! function_exists( 'atelier_one_page_nav' ) ) {
        function atelier_one_page_nav() {
            global $enable_one_page_nav, $atelier_options;
            $onepagenav_type = $atelier_options['onepagenav_type'];
            if ( $enable_one_page_nav ) {
                ?>
                <!--// ONE PAGE NAV //-->
                <div id="one-page-nav" class="opn-<?php echo esc_attr($onepagenav_type); ?>"></div>
            <?php
            }
        }

        add_action( 'atelier_main_container_end', 'atelier_one_page_nav', 30 );
    }


    /* BACK TO TOP
    ================================================== */
    if ( ! function_exists( 'atelier_back_to_top' ) ) {
        function atelier_back_to_top() {
            global $atelier_options;
            $enable_backtotop = $atelier_options['enable_backtotop'];
            if ( $enable_backtotop ) {
                ?>
                <!--// BACK TO TOP //-->
                <div id="back-to-top" class="animate-top"><?php echo apply_filters( 'atelier_back_to_top_icon', '<i class="ss-navigateup"></i>' ); ?></div>
            <?php
            }
        }

        add_action( 'atelier_after_page_container', 'atelier_back_to_top', 20 );
    }


    /* FULL WIDTH VIDEO AREA
    ================================================== */
    if ( ! function_exists( 'atelier_fw_video_area' ) ) {
        function atelier_fw_video_area() { ?>
            <!--// FULL WIDTH VIDEO //-->
            <div class="fw-video-area">
                <div class="fw-video-close"><?php echo apply_filters( 'atelier_fullscreen_close_icon', '<i class="ss-delete"></i>' ); ?></div>
                <div class="fw-video-wrap"></div>
            </div>
            <div class="fw-video-spacer"></div>
        <?php
        }

        add_action( 'atelier_after_page_container', 'atelier_fw_video_area', 30 );
    }


    /* BACK TO TOP
    ================================================== */
    if ( ! function_exists( 'atelier_inf_scroll_params' ) ) {
        function atelier_inf_scroll_params() {
            global $sf_include_infscroll;
            if ( $sf_include_infscroll ) {
                ?>
                <!--// INFINITE SCROLL PARAMS //-->
                <div id="inf-scroll-params"
                     data-loadingimage="<?php echo get_template_directory_uri(); ?>/images/loader.gif"
                     data-msgtext="<?php _e( "Loading...", 'atelier' );
                     ?>" data-finishedmsg="<?php _e( "All items loaded", 'atelier' ); ?>"></div>
            <?php
            }
        }

        add_action( 'atelier_after_page_container', 'atelier_inf_scroll_params', 40 );
    }


    /* FRAMEWORK INLCUDES
    ================================================== */
    if ( ! function_exists( 'atelier_included' ) ) {
        function atelier_included() {
            ?>
            <!--// FRAMEWORK INCLUDES //-->
            <div id="sf-included" class="<?php echo atelier_global_include_classes(); ?>"></div>
        <?php
        }

        add_action( 'atelier_after_page_container', 'atelier_included', 50 );
    }

    /* PLUGIN OPTION PARAMS
    ================================================== */
    if ( ! function_exists( 'atelier_option_parameters' ) ) {
        function atelier_option_parameters() {
            global $atelier_options;
            $slider_slideshowSpeed    = $atelier_options['slider_slideshowSpeed'];
            $slider_animationSpeed    = $atelier_options['slider_animationSpeed'];
            $slider_autoplay          = $atelier_options['slider_autoplay'];
            $slider_loop 			  = false;
            if ( isset($atelier_options['slider_loop']) ) {
            	$slider_loop          = $atelier_options['slider_loop'];
            }
            $carousel_paginationSpeed = $atelier_options['carousel_paginationSpeed'];
            $carousel_slideSpeed      = $atelier_options['carousel_slideSpeed'];
            $carousel_autoplay        = $atelier_options['carousel_autoplay'];
            $carousel_pagination      = $atelier_options['carousel_pagination'];
            $lightbox_enabled 		  = true;
            if ( isset($atelier_options['lightbox_enabled']) ) {
            	$lightbox_enabled     = $atelier_options['lightbox_enabled'];
            }
            $lightbox_nav             = $atelier_options['lightbox_nav'];
            $lightbox_thumbs          = $atelier_options['lightbox_thumbs'];
            $lightbox_skin            = $atelier_options['lightbox_skin'];
            $lightbox_sharing         = $atelier_options['lightbox_sharing'];
            $product_slider_thumbs_pos = "bottom";
            $vertical_product_slider_height = "700";
            if ( isset( $atelier_options['product_slider_thumbs_pos'] ) ) {
           		$product_slider_thumbs_pos = $atelier_options['product_slider_thumbs_pos'];
            }
            if ( isset( $atelier_options['vertical_product_slider_height'] ) ) {
            	$vertical_product_slider_height = $atelier_options['vertical_product_slider_height'];
            }
            $quickview_text			  = __("Quickview", 'atelier');
            $cart_notification = "";
            if ( isset ($atelier_options['cart_notification']) ) {
            	$cart_notification        = $atelier_options['cart_notification'];
            }
            ?>
            <div id="sf-option-params" data-slider-slidespeed="<?php echo esc_attr($slider_slideshowSpeed); ?>"
                 data-slider-animspeed="<?php echo esc_attr($slider_animationSpeed); ?>"
                 data-slider-autoplay="<?php echo esc_attr($slider_autoplay); ?>"
                 data-slider-loop="<?php echo esc_attr($slider_loop); ?>"
                 data-carousel-pagespeed="<?php echo esc_attr($carousel_paginationSpeed); ?>"
                 data-carousel-slidespeed="<?php echo esc_attr($carousel_slideSpeed); ?>"
                 data-carousel-autoplay="<?php echo esc_attr($carousel_autoplay); ?>"
                 data-carousel-pagination="<?php echo esc_attr($carousel_pagination); ?>"
                 data-lightbox-enabled="<?php echo esc_attr($lightbox_enabled); ?>"
                 data-lightbox-nav="<?php echo esc_attr($lightbox_nav); ?>"
	             data-lightbox-thumbs="<?php echo esc_attr($lightbox_thumbs); ?>"
                 data-lightbox-skin="<?php echo esc_attr($lightbox_skin); ?>"
                 data-lightbox-sharing="<?php echo esc_attr($lightbox_sharing); ?>"
                 data-product-slider-thumbs-pos="<?php echo esc_attr($product_slider_thumbs_pos); ?>"
                 data-product-slider-vert-height="<?php echo esc_attr($vertical_product_slider_height); ?>"
                 data-quickview-text="<?php echo esc_attr($quickview_text); ?>"
	             data-cart-notification="<?php echo esc_attr($cart_notification); ?>"
	             data-username-placeholder="<?php _e( "Username", 'atelier' ); ?>"
	             data-email-placeholder="<?php _e( "Email", 'atelier' ); ?>"
	             data-password-placeholder="<?php _e( "Password", 'atelier' ); ?>"
	             data-username-or-email-placeholder="<?php _e( "Username or email address", 'atelier' ); ?>"
	             data-order-id-placeholder="<?php _e( "Order ID", 'atelier' ); ?>"
	             data-billing-email-placeholder="<?php _e( "Billing Email", 'atelier' ); ?>"></div>
        <?php
        }
        add_action( 'atelier_after_page_container', 'atelier_option_parameters', 60 );
    }

    /* LOVE IT LOCALE
    ================================================== */
    if ( ! function_exists( 'atelier_loveit_locale' ) ) {
        function atelier_loveit_locale() {
            $ajax_url              = admin_url( 'admin-ajax.php' );
            $nonce                 = wp_create_nonce( 'love-it-nonce' );
            $already_loved_message = __( 'You have already loved this item.', 'atelier' );
            $error_message         = __( 'Sorry, there was a problem processing your request.', 'atelier' );
            $logged_in             = is_user_logged_in() ? 'true' : 'false';

            ?>
            <div id="loveit-locale" data-ajaxurl="<?php echo esc_url($ajax_url); ?>" data-nonce="<?php echo esc_attr($nonce); ?>"
                 data-alreadyloved="<?php echo esc_attr($already_loved_message); ?>" data-error="<?php echo esc_attr($error_message); ?>"
                 data-loggedin="<?php echo esc_attr($logged_in); ?>"></div>
        <?php
        }

        add_action( 'atelier_after_page_container', 'atelier_loveit_locale', 80 );
    }

?>