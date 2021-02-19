<?php

	/*
	*
	*	Atelier Functions
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*/


	/* VARIABLE DEFINITIONS
	================================================== */
	define('ATELIER_TEMPLATE_PATH', get_template_directory());
	define('ATELIER_INCLUDES_PATH', ATELIER_TEMPLATE_PATH . '/includes');
	define('SWIFT_FRAMEWORK_PATH', ATELIER_TEMPLATE_PATH . '/swift-framework');
	define('ATELIER_LOCAL_PATH', get_template_directory_uri());

	/* PLUGIN INCLUDES
	================================================== */
	require_once(ATELIER_INCLUDES_PATH . '/plugins/aq_resizer.php');
	include_once(ATELIER_INCLUDES_PATH . '/plugin-includes.php');
	require_once(ATELIER_INCLUDES_PATH . '/theme_update_check.php');
	$AtelierUpdateChecker = new ThemeUpdateChecker(
	    'atelier',
	    'https://kernl.us/api/v1/theme-updates/564c90177ad3303b210d6b47/'
	);
	
	
	/* ENVATO REQUIREMENTS DATE
	================================================== */
	if ( get_option( 'envato_requirements' ) == false ) {
		update_option( 'envato_requirements', 'may2019' );
	}


	/* THEME SETUP
	================================================== */
	if (!function_exists('atelier_theme_setup')) {
		function atelier_theme_setup() {

			/* SF THEME OPTION CHECK
			================================================== */
			if ( get_option( 'sf_theme' ) == false ) {
				update_option( 'sf_theme', 'atelier' );
			}


			/* THEME SUPPORT
			================================================== */
			add_theme_support( 'structured-post-formats', array('audio', 'gallery', 'image', 'link', 'video') );
			add_theme_support( 'post-formats', array('aside', 'chat', 'quote', 'status') );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'title-tag' );
			add_theme_support( 'custom-logo' );
			add_theme_support( 'custom-background' );
			add_theme_support( 'woocommerce', array(
				'gallery_thumbnail_image_width' => 200,
			));
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
			
			add_theme_support( 'swiftframework', array(
				'font-awesome-v5'			=> true,
				'widgets'					=> true,
				'slideout-menu'				=> true,
				'page-heading-woocommerce'	=> false,
				'pagination-fullscreen'		=> false,
				'bordered-button'			=> true,
				'3drotate-button'			=> false,
				'rounded-button'			=> true,
				'product-inner-heading'		=> true,
				'product-summary-tabs'		=> false,
				'product-layout-opts'		=> true,
				'mobile-shop-filters' 		=> true,
				'mobile-logo-override'		=> true,
				'product-multi-masonry'		=> true,
				'product-preview-slider'	=> true,
				'super-search-config'		=> true,
				'advanced-row-styling'		=> true,
				'gizmo-icon-font'			=> false,
				'icon-mind-font'			=> true,
				'nucleo-general-font'		=> false,
				'nucleo-interface-font'		=> false,
				'menu-new-badge'			=> true,
				'advanced-map-styles'		=> true,
				'minimal-team-hover'		=> false,
				'pushnav-menu'				=> false,
				'split-nav-menu'			=> false,
				'max-mega-menu'				=> false,
				'page-heading-woo-description' => false,
				'header-aux-modals'			=> false,
				'hamburger-css' 			=> false,
				'alt-recent-post-list'		=> false,
			) );

			/* THUMBNAIL SIZES
			================================================== */
			set_post_thumbnail_size( 220, 150, true);
			add_image_size( 'widget-image', 94, 70, true);
			add_image_size( 'thumb-square', 250, 250, true);
			add_image_size( 'thumb-image', 600, 450, true);
			add_image_size( 'thumb-image-twocol', 900, 675, true);
			add_image_size( 'thumb-image-onecol', 1800, 1200, true);
			add_image_size( 'blog-image', 1280, 9999);
			add_image_size( 'gallery-image', 1000, 9999);
			add_image_size( 'large-square', 1200, 1200, true);
			add_image_size( 'full-width-image-gallery', 1280, 720, true);

			/* CONTENT WIDTH
			================================================== */
			if ( ! isset( $content_width ) ) $content_width = 1140;

			/* LOAD THEME LANGUAGE
			================================================== */
			load_theme_textdomain('atelier', ATELIER_TEMPLATE_PATH.'/language');


			atelier_migrate_old_theme_data();

		}
		add_action( 'after_setup_theme', 'atelier_theme_setup' );
	}


	/* MIGRATION
	================================================== */
	function atelier_migrate_old_theme_data() {
		$atelier_options = get_option('sf_atelier_options');

		// LOGO
		if (isset($atelier_options['logo_upload']) && !has_custom_logo()) {
			
			// get logo data
			$logo = $atelier_options['logo_upload'];
			if ( isset($logo['id']) ) {
				$logo_id = $logo['id'];

				// save to customizer
				set_theme_mod( 'custom_logo', $logo_id );
				set_theme_mod( 'delete_logo_option', true );
			}

		}
	}

	function atelier_delete_old_theme_opts() {
		global $reduxConfig;

		// delete logo
		if ( get_theme_mod('delete_logo_option') ) {
			$reduxConfig->ReduxFramework->set('logo_upload', '');
			remove_theme_mod('delete_logo_option');
		}
	}
	add_action('init', 'atelier_delete_old_theme_opts', 99);



	/* THEME FRAMEWORK FUNCTIONS
	================================================== */
	include_once(SWIFT_FRAMEWORK_PATH . '/core/sf-sidebars.php');
	require_once(ATELIER_INCLUDES_PATH . '/overrides/sf-theme-overrides.php');
	
	include_once(ATELIER_INCLUDES_PATH . '/meta-boxes.php');
	
	if (!function_exists('atelier_include_framework')) {
		function atelier_include_framework() {
			require_once(ATELIER_INCLUDES_PATH . '/overrides/sf-theme-functions.php');
			require_once(ATELIER_INCLUDES_PATH . '/sf-customizer-options.php');
			include_once(ATELIER_INCLUDES_PATH . '/sf-custom-styles.php');
			include_once(ATELIER_INCLUDES_PATH . '/sf-styleswitcher/sf-styleswitcher.php');
			require_once(ATELIER_INCLUDES_PATH . '/overrides/sf-spb-overrides.php');
			require_once(SWIFT_FRAMEWORK_PATH . '/swift-framework.php');			
			include_once(ATELIER_INCLUDES_PATH . '/overrides/sf-framework-overrides.php');
		}
		add_action('init', 'atelier_include_framework', 5);
	}


	/* THEME OPTIONS FRAMEWORK
	================================================== */
	if (!function_exists('atelier_include_theme_options')) {
		function atelier_include_theme_options() {
			require_once( ATELIER_INCLUDES_PATH . '/option-extensions/loader.php' );
			require_once( ATELIER_INCLUDES_PATH . '/sf-options.php' );
			global $sf_atelier_options, $atelier_options;
			$atelier_options = $sf_atelier_options;
		}
		add_action('init', 'atelier_include_theme_options', 10);
	}

	
	/* THEME OPTIONS VAR RETRIEVAL
	================================================== */
	if (!function_exists('atelier_get_theme_opts')) {
		function atelier_get_theme_opts() {
			global $atelier_options;
			return $atelier_options;
		}
	}
	
	
	/* LOVE IT INCLUDE
	================================================== */
	if (!function_exists('atelier_love_it_include')) {
		function atelier_love_it_include() {
			global $atelier_options;
			$disable_loveit = false;
			if (isset($atelier_options['disable_loveit'])) {
			$disable_loveit = $atelier_options['disable_loveit'];
			}

			if (!$disable_loveit) {
			include_once(ATELIER_INCLUDES_PATH . '/plugins/love-it-pro/love-it-pro.php');
			}
		}
		add_action('init', 'atelier_love_it_include', 20);
	}


	/* LOAD STYLESHEETS
	================================================== */
	if (!function_exists('atelier_enqueue_styles')) {
		function atelier_enqueue_styles() {

			global $atelier_options, $is_IE;
			$enable_responsive = $atelier_options['enable_responsive'];
			$enable_rtl = $atelier_options['enable_rtl'];
					
		    wp_enqueue_style('bootstrap', ATELIER_LOCAL_PATH . '/css/bootstrap.min.css', array(), '3.3.5', 'all');
		    wp_enqueue_style('font-awesome-v5', ATELIER_LOCAL_PATH .'/css/font-awesome.min.css', array(), '5.10.1', 'all');
		    wp_enqueue_style('font-awesome-v4shims', ATELIER_LOCAL_PATH .'/css/v4-shims.min.css', array(), NULL, 'all');
		    wp_enqueue_style('sf-main', ATELIER_LOCAL_PATH . '/css/main.css', array(), NULL, 'all');

		    if (atelier_woocommerce_activated()) {
		    	wp_enqueue_style('sf-woocommerce', ATELIER_LOCAL_PATH . '/css/sf-woocommerce.css', array(), NULL, 'all');
		    }
		    
		    if (atelier_edd_activated()) {
		    	wp_enqueue_style('sf-edd', ATELIER_LOCAL_PATH . '/css/sf-edd.css', array(), NULL, 'all');
		    }

		    if (is_rtl() || $enable_rtl || isset($_GET['RTL'])) {
		    	wp_enqueue_style('sf-rtl', ATELIER_LOCAL_PATH . '/rtl.css', array(), NULL, 'all');
		    }

		    if ($enable_responsive) {
		    	wp_enqueue_style('sf-responsive', ATELIER_LOCAL_PATH . '/css/responsive.css', array(), NULL, 'all');
		    }

			wp_enqueue_style('atelier-style', get_stylesheet_directory_uri() . '/style.css', array(), NULL, 'all');

		}
		add_action('wp_enqueue_scripts', 'atelier_enqueue_styles');
	}


	/* LOAD FRONTEND SCRIPTS
	================================================== */
	if (!function_exists('atelier_enqueue_scripts')) {
		function atelier_enqueue_scripts() {

			// Theme Options
			global $atelier_options;
		    $enable_rtl = $atelier_options['enable_rtl'];
			$post_type = get_query_var('post_type');
			$header_left_config  = $atelier_options['header_left_config'];
            $header_right_config = $atelier_options['header_right_config'];
			$lightbox_enabled 		  = true;
			if ( isset($atelier_options['lightbox_enabled']) ) {
				$lightbox_enabled     = $atelier_options['lightbox_enabled'];
			}
			$gmaps_api_key = get_option('sf_gmaps_api_key');

			// Enqueue
		    wp_enqueue_script('jquery');
		    wp_enqueue_script('js-cookie', ATELIER_LOCAL_PATH . '/js/lib/js.cookie.js', array(), NULL, TRUE);

			if ( is_singular() && comments_open() && get_option('thread_comments') ) {
				wp_enqueue_script( 'comment-reply' );
			}

    		wp_enqueue_script('modernizr', ATELIER_LOCAL_PATH . '/js/lib/modernizr.js', array(), NULL, TRUE);
    		wp_enqueue_script('prismjs', ATELIER_LOCAL_PATH . '/js/lib/prismjs.js', array(), NULL, TRUE);
    		wp_enqueue_script('greensock', ATELIER_LOCAL_PATH . '/js/lib/greensock.js', array(), NULL, TRUE);
    		wp_enqueue_script('bootstrap', ATELIER_LOCAL_PATH . '/js/lib/bootstrap.min.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-ui', ATELIER_LOCAL_PATH . '/js/lib/jquery-ui-1.11.4.custom.min.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('lightslider', ATELIER_LOCAL_PATH . '/js/lib/lightslider.min.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('imagesloaded', ATELIER_LOCAL_PATH . '/js/lib/imagesloaded.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-equalHeights', ATELIER_LOCAL_PATH . '/js/lib/jquery.equalHeights.js', array('jquery'), '1.01', TRUE);
    		wp_enqueue_script('jquery-smartresize', ATELIER_LOCAL_PATH . '/js/lib/jquery.smartresize.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-throttle-debounce', ATELIER_LOCAL_PATH . '/js/lib/jquery.ba-throttle-debounce.min.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-infinitescroll', ATELIER_LOCAL_PATH . '/js/lib/jquery.infinitescroll.min.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-stickyplugin', ATELIER_LOCAL_PATH . '/js/lib/jquery.stickyplugin.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-touchswipe', ATELIER_LOCAL_PATH . '/js/lib/jquery.touchSwipe.min.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-transit', ATELIER_LOCAL_PATH . '/js/lib/jquery.transit.min.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-appear', ATELIER_LOCAL_PATH . '/js/lib/jquery.appear.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-autoGrowInput', ATELIER_LOCAL_PATH . '/js/lib/jquery.auto-grow-input.min.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-waypoints', ATELIER_LOCAL_PATH . '/js/lib/jquery.waypoints.min.js', array('jquery'), NULL, TRUE);
			wp_enqueue_script('ilightbox', ATELIER_LOCAL_PATH . '/js/lib/ilightbox.min.js', 'jquery', NULL, TRUE);
			wp_enqueue_script('owlcarousel', ATELIER_LOCAL_PATH . '/js/lib/owl.carousel.min.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-isotope', ATELIER_LOCAL_PATH . '/js/lib/jquery.isotope.min.js', array('jquery'), NULL, TRUE);
			wp_enqueue_script('jquery-easypiechart', ATELIER_LOCAL_PATH . '/js/lib/jquery.easypiechart.min.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-countdown', ATELIER_LOCAL_PATH . '/js/lib/jquery.countdown.min.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-countTo', ATELIER_LOCAL_PATH . '/js/lib/jquery.countTo.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-dotdotdot', ATELIER_LOCAL_PATH . '/js/lib/jquery.dotdotdot.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-easing', ATELIER_LOCAL_PATH . '/js/lib/jquery.easing.1.3.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-fittext', ATELIER_LOCAL_PATH . '/js/lib/jquery.fittext.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-hoverIntent', ATELIER_LOCAL_PATH . '/js/lib/jquery.hoverIntent.min.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-parallax', ATELIER_LOCAL_PATH . '/js/lib/jquery.parallax.min.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-stellar', ATELIER_LOCAL_PATH . '/js/lib/jquery.stellar.min.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-stickem', ATELIER_LOCAL_PATH . '/js/lib/jquery.stickem.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-timeago', ATELIER_LOCAL_PATH . '/js/lib/jquery.timeago.js', array('jquery'), NULL, TRUE);
    		wp_enqueue_script('jquery-viewport', ATELIER_LOCAL_PATH . '/js/lib/jquery.viewport.js', array('jquery'), NULL, TRUE);
    		
    		if ( $gmaps_api_key != "" ) {
    			wp_enqueue_script('google-maps', '//maps.google.com/maps/api/js?key=' . $gmaps_api_key, array('jquery'), NULL, TRUE);
    		}

    		wp_enqueue_script('atelier-functions', ATELIER_LOCAL_PATH . '/js/functions.js', array('jquery'), NULL, TRUE);
		}
		add_action('wp_enqueue_scripts', 'atelier_enqueue_scripts');
	}


	/* LOAD BACKEND SCRIPTS
	================================================== */
	function atelier_admin_scripts() {
	    wp_enqueue_script('atelier_admin-functions', get_template_directory_uri() . '/js/sf-admin.js', 'jquery', '1.0', TRUE);
		
	}
	add_action('admin_enqueue_scripts', 'atelier_admin_scripts');


	/* WOO CHECKOUT BUTTON
	================================================== */
	if ( ! function_exists( 'atelier_button_proceed_to_checkout' ) ) {
		function atelier_button_proceed_to_checkout() {
			$checkout_url = wc_get_checkout_url();
			?>
			<a class="sf-button standard sf-icon-reveal checkout-button accent" href="<?php echo esc_url($checkout_url); ?>">
				<i class="fas fa-long-arrow-alt-right"></i>
				<span class="text"><?php _e( 'Proceed to Checkout', 'atelier' ); ?></span>
			</a>
			<?php
		}
	}

	/* CHECK THEME FEATURE SUPPORT
    ================================================== */
    if ( !function_exists( 'atelier_theme_supports' ) ) {
        function atelier_theme_supports( $feature ) {
        	$supports = get_theme_support( 'swiftframework' );
        	$supports = $supports[0];
    		if ( !isset($supports[ $feature ]) || $supports[ $feature ] == "") {
    			return false;
    		} else {
        		return isset( $supports[ $feature ] );
        	}
        }
    }

    /* SIDEBAR FILTERS
	================================================== */
	function atelier_sidebar_before_title() {
		return '<div class="widget-heading title-wrap clearfix"><h3 class="spb-heading widget-title"><span>';
	}
	add_filter('atelier_sidebar_before_title', 'atelier_sidebar_before_title');

	function atelier_sidebar_after_title() {
		return '</span></h3></div>';
	}
	add_filter('atelier_sidebar_after_title', 'atelier_sidebar_after_title');


	/* FOOTER FILTERS
	================================================== */
	function atelier_footer_before_title() {
		return '<div class="widget-heading title-wrap clearfix"><h3 class="spb-heading widget-title"><span>';
	}
	add_filter('atelier_footer_before_title', 'atelier_footer_before_title');

	function atelier_footer_after_title() {
		return '</span></h3></div>';
	}
	add_filter('atelier_footer_after_title', 'atelier_footer_after_title');


    /* ADJUST WOO TERM DESCRIPTION OUTPUT
    ================================================== */
    if ( ! function_exists( 'atelier_woocommerce_taxonomy_archive_description' ) ) {
        function atelier_woocommerce_taxonomy_archive_description() {
        	
        	if ( atelier_theme_supports( 'page-heading-woo-description' ) ) {
        		global $atelier_options;
        		$page_title_style = $atelier_options['woo_page_heading_style'];
        		if ( $page_title_style != "standard" ) {
        			return;
        		}
        	}
        	
            if ( is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) == 0 ) {
                $description = apply_filters( 'the_content', term_description() );
                if ( $description ) {
                    echo '<div class="term-description container">' . $description . '</div>';
                }
            }
        }
    }


    /* DEMO CONTENT IMPORTER
    ================================================== */
    function atelier_ocdi_import_files() {
	  return array(
		    array(
		      'import_file_name'           => 'Main Demo',
		      //'categories'                 => array( 'Category 1', 'Category 2' ),
		      'import_file_url'            => 'http://www.swiftideas.com/democontent/atelier/main/demo-content.xml',
		      'import_widget_file_url'     => 'http://www.swiftideas.com/democontent/atelier/main/widgets.wie',
		      'import_customizer_file_url' => 'http://www.swiftideas.com/democontent/atelier/main/customizer.dat',
		      'import_redux'               => array(
		        array(
		          'file_url'    => 'http://www.swiftideas.com/democontent/atelier/main/redux.json',
		          'option_name' => 'sf_atelier_options',
		        ),
		      ),
		      'import_preview_image_url'   => 'http://www.swiftideas.com/democontent/atelier/main/image.jpg',
		      'import_notice'              => '',
		      'preview_url'                => 'http://atelier.swiftideas.com',
		    ),
		    array(
		      'import_file_name'           => 'Form Demo',
		      //'categories'                 => array( 'Category 1', 'Category 2' ),
		      'import_file_url'            => 'http://www.swiftideas.com/democontent/atelier/form/demo-content.xml',
		      'import_widget_file_url'     => 'http://www.swiftideas.com/democontent/atelier/form/widgets.wie',
		      'import_customizer_file_url' => 'http://www.swiftideas.com/democontent/atelier/form/customizer.dat',
		      'import_redux'               => array(
		        array(
		          'file_url'    => 'http://www.swiftideas.com/democontent/atelier/form/redux.json',
		          'option_name' => 'sf_atelier_options',
		        ),
		      ),
		      'import_preview_image_url'   => 'http://www.swiftideas.com/democontent/atelier/form/image.jpg',
		      'import_notice'              => '',
		      'preview_url'                => 'http://atelier.swiftideas.com/form-demo',
		    ),
		    array(
		      'import_file_name'           => 'Union Demo',
		      //'categories'                 => array( 'Category 1', 'Category 2' ),
		      'import_file_url'            => 'http://www.swiftideas.com/democontent/atelier/union/demo-content.xml',
		      'import_widget_file_url'     => 'http://www.swiftideas.com/democontent/atelier/union/widgets.wie',
		      'import_customizer_file_url' => 'http://www.swiftideas.com/democontent/atelier/union/customizer.dat',
		      'import_redux'               => array(
		        array(
		          'file_url'    => 'http://www.swiftideas.com/democontent/atelier/union/redux.json',
		          'option_name' => 'sf_atelier_options',
		        ),
		      ),
		      'import_preview_image_url'   => 'http://www.swiftideas.com/democontent/atelier/union/image.jpg',
		      'import_notice'              => '',
		      'preview_url'                => 'http://atelier.swiftideas.com/union-demo',
		    ),
		    array(
		      'import_file_name'           => 'Convoy Demo',
		      //'categories'                 => array( 'Category 1', 'Category 2' ),
		      'import_file_url'            => 'http://www.swiftideas.com/democontent/atelier/convoy/demo-content.xml',
		      'import_widget_file_url'     => 'http://www.swiftideas.com/democontent/atelier/convoy/widgets.wie',
		      'import_customizer_file_url' => 'http://www.swiftideas.com/democontent/atelier/convoy/customizer.dat',
		      'import_redux'               => array(
		        array(
		          'file_url'    => 'http://www.swiftideas.com/democontent/atelier/convoy/redux.json',
		          'option_name' => 'sf_atelier_options',
		        ),
		      ),
		      'import_preview_image_url'   => 'http://www.swiftideas.com/democontent/atelier/convoy/image.jpg',
		      'import_notice'              => '',
		      'preview_url'                => 'http://atelier.swiftideas.com/convoy-demo',
		    ),
		    array(
		      'import_file_name'           => 'Tilt Demo',
		      //'categories'                 => array( 'Category 1', 'Category 2' ),
		      'import_file_url'            => 'http://www.swiftideas.com/democontent/atelier/tilt/demo-content.xml',
		      'import_widget_file_url'     => 'http://www.swiftideas.com/democontent/atelier/tilt/widgets.wie',
		      'import_customizer_file_url' => 'http://www.swiftideas.com/democontent/atelier/tilt/customizer.dat',
		      'import_redux'               => array(
		        array(
		          'file_url'    => 'http://www.swiftideas.com/democontent/atelier/tilt/redux.json',
		          'option_name' => 'sf_atelier_options',
		        ),
		      ),
		      'import_preview_image_url'   => 'http://www.swiftideas.com/democontent/atelier/tilt/image.jpg',
		      'import_notice'              => '',
		      'preview_url'                => 'http://atelier.swiftideas.com/tilt-demo',
		    ),
		    array(
		      'import_file_name'           => 'Lab Demo',
		      //'categories'                 => array( 'Category 1', 'Category 2' ),
		      'import_file_url'            => 'http://www.swiftideas.com/democontent/atelier/lab/demo-content.xml',
		      'import_widget_file_url'     => 'http://www.swiftideas.com/democontent/atelier/lab/widgets.wie',
		      'import_customizer_file_url' => 'http://www.swiftideas.com/democontent/atelier/lab/customizer.dat',
		      'import_redux'               => array(
		        array(
		          'file_url'    => 'http://www.swiftideas.com/democontent/atelier/lab/redux.json',
		          'option_name' => 'sf_atelier_options',
		        ),
		      ),
		      'import_preview_image_url'   => 'http://www.swiftideas.com/democontent/atelier/lab/image.jpg',
		      'import_notice'              => '',
		      'preview_url'                => 'http://atelier.swiftideas.com/lab-demo',
		    ),
		    array(
		      'import_file_name'           => 'Selby Demo',
		      //'categories'                 => array( 'Category 1', 'Category 2' ),
		      'import_file_url'            => 'http://www.swiftideas.com/democontent/atelier/selby/demo-content.xml',
		      'import_widget_file_url'     => 'http://www.swiftideas.com/democontent/atelier/selby/widgets.wie',
		      'import_customizer_file_url' => 'http://www.swiftideas.com/democontent/atelier/selby/customizer.dat',
		      'import_redux'               => array(
		        array(
		          'file_url'    => 'http://www.swiftideas.com/democontent/atelier/selby/redux.json',
		          'option_name' => 'sf_atelier_options',
		        ),
		      ),
		      'import_preview_image_url'   => 'http://www.swiftideas.com/democontent/atelier/selby/image.jpg',
		      'import_notice'              => '',
		      'preview_url'                => 'http://atelier.swiftideas.com/selby-demo',
		    ),
		    array(
		      'import_file_name'           => 'Emigre Demo',
		      //'categories'                 => array( 'Category 1', 'Category 2' ),
		      'import_file_url'            => 'http://www.swiftideas.com/democontent/atelier/emigre/demo-content.xml',
		      'import_widget_file_url'     => 'http://www.swiftideas.com/democontent/atelier/emigre/widgets.wie',
		      'import_customizer_file_url' => 'http://www.swiftideas.com/democontent/atelier/emigre/customizer.dat',
		      'import_redux'               => array(
		        array(
		          'file_url'    => 'http://www.swiftideas.com/democontent/atelier/emigre/redux.json',
		          'option_name' => 'sf_atelier_options',
		        ),
		      ),
		      'import_preview_image_url'   => 'http://www.swiftideas.com/democontent/atelier/emigre/image.jpg',
		      'import_notice'              => '',
		      'preview_url'                => 'http://atelier.swiftideas.com/emigre-demo',
		    ),
		    array(
		      'import_file_name'           => 'Bryant Demo',
		      //'categories'                 => array( 'Category 1', 'Category 2' ),
		      'import_file_url'            => 'http://www.swiftideas.com/democontent/atelier/bryant/demo-content.xml',
		      'import_widget_file_url'     => 'http://www.swiftideas.com/democontent/atelier/bryant/widgets.wie',
		      'import_customizer_file_url' => 'http://www.swiftideas.com/democontent/atelier/bryant/customizer.dat',
		      'import_redux'               => array(
		        array(
		          'file_url'    => 'http://www.swiftideas.com/democontent/atelier/bryant/redux.json',
		          'option_name' => 'sf_atelier_options',
		        ),
		      ),
		      'import_preview_image_url'   => 'http://www.swiftideas.com/democontent/atelier/bryant/image.jpg',
		      'import_notice'              => '',
		      'preview_url'                => 'http://atelier.swiftideas.com/bryant-demo',
		    ),
		    array(
		      'import_file_name'           => 'Arad Demo',
		      //'categories'                 => array( 'Category 1', 'Category 2' ),
		      'import_file_url'            => 'http://www.swiftideas.com/democontent/atelier/arad/demo-content.xml',
		      'import_widget_file_url'     => 'http://www.swiftideas.com/democontent/atelier/arad/widgets.wie',
		      'import_customizer_file_url' => 'http://www.swiftideas.com/democontent/atelier/arad/customizer.dat',
		      'import_redux'               => array(
		        array(
		          'file_url'    => 'http://www.swiftideas.com/democontent/atelier/arad/redux.json',
		          'option_name' => 'sf_atelier_options',
		        ),
		      ),
		      'import_preview_image_url'   => 'http://www.swiftideas.com/democontent/atelier/arad/image.jpg',
		      'import_notice'              => '',
		      'preview_url'                => 'http://atelier.swiftideas.com/arad-demo',
		    ),
		    array(
		      'import_file_name'           => 'Flock Demo',
		      //'categories'                 => array( 'Category 1', 'Category 2' ),
		      'import_file_url'            => 'http://www.swiftideas.com/democontent/atelier/flock/demo-content.xml',
		      'import_widget_file_url'     => 'http://www.swiftideas.com/democontent/atelier/flock/widgets.wie',
		      'import_customizer_file_url' => 'http://www.swiftideas.com/democontent/atelier/flock/customizer.dat',
		      'import_redux'               => array(
		        array(
		          'file_url'    => 'http://www.swiftideas.com/democontent/atelier/flock/redux.json',
		          'option_name' => 'sf_atelier_options',
		        ),
		      ),
		      'import_preview_image_url'   => 'http://www.swiftideas.com/democontent/atelier/flock/image.jpg',
		      'import_notice'              => '',
		      'preview_url'                => 'http://atelier.swiftideas.com/flock-demo',
		    ),
		    array(
		      'import_file_name'           => 'Porter Demo',
		      //'categories'                 => array( 'Category 1', 'Category 2' ),
		      'import_file_url'            => 'http://www.swiftideas.com/democontent/atelier/porter/demo-content.xml',
		      'import_widget_file_url'     => 'http://www.swiftideas.com/democontent/atelier/porter/widgets.wie',
		      'import_customizer_file_url' => 'http://www.swiftideas.com/democontent/atelier/porter/customizer.dat',
		      'import_redux'               => array(
		        array(
		          'file_url'    => 'http://www.swiftideas.com/democontent/atelier/porter/redux.json',
		          'option_name' => 'sf_atelier_options',
		        ),
		      ),
		      'import_preview_image_url'   => 'http://www.swiftideas.com/democontent/atelier/porter/image.jpg',
		      'import_notice'              => '',
		      'preview_url'                => 'http://atelier.swiftideas.com/porter-demo',
		    ),
		    array(
		      'import_file_name'           => 'Vario Demo',
		      //'categories'                 => array( 'Category 1', 'Category 2' ),
		      'import_file_url'            => 'http://www.swiftideas.com/democontent/atelier/vario/demo-content.xml',
		      'import_widget_file_url'     => 'http://www.swiftideas.com/democontent/atelier/vario/widgets.wie',
		      'import_customizer_file_url' => 'http://www.swiftideas.com/democontent/atelier/vario/customizer.dat',
		      'import_redux'               => array(
		        array(
		          'file_url'    => 'http://www.swiftideas.com/democontent/atelier/vario/redux.json',
		          'option_name' => 'sf_atelier_options',
		        ),
		      ),
		      'import_preview_image_url'   => 'http://www.swiftideas.com/democontent/atelier/vario/image.jpg',
		      'import_notice'              => '',
		      'preview_url'                => 'http://atelier.swiftideas.com/vario-demo',
		    ),
		    array(
		      'import_file_name'           => 'Rebel Demo',
		      //'categories'                 => array( 'Category 1', 'Category 2' ),
		      'import_file_url'            => 'http://www.swiftideas.com/democontent/atelier/rebel/demo-content.xml',
		      'import_widget_file_url'     => 'http://www.swiftideas.com/democontent/atelier/rebel/widgets.wie',
		      'import_customizer_file_url' => 'http://www.swiftideas.com/democontent/atelier/rebel/customizer.dat',
		      'import_redux'               => array(
		        array(
		          'file_url'    => 'http://www.swiftideas.com/democontent/atelier/rebel/redux.json',
		          'option_name' => 'sf_atelier_options',
		        ),
		      ),
		      'import_preview_image_url'   => 'http://www.swiftideas.com/democontent/atelier/rebel/image.jpg',
		      'import_notice'              => '',
		      'preview_url'                => 'http://atelier.swiftideas.com/rebel-demo',
		    ),
		    array(
		      'import_file_name'           => 'Alvar Demo',
		      //'categories'                 => array( 'Category 1', 'Category 2' ),
		      'import_file_url'            => 'http://www.swiftideas.com/democontent/atelier/alvar/demo-content.xml',
		      'import_widget_file_url'     => 'http://www.swiftideas.com/democontent/atelier/alvar/widgets.wie',
		      'import_customizer_file_url' => 'http://www.swiftideas.com/democontent/atelier/alvar/customizer.dat',
		      'import_redux'               => array(
		        array(
		          'file_url'    => 'http://www.swiftideas.com/democontent/atelier/alvar/redux.json',
		          'option_name' => 'sf_atelier_options',
		        ),
		      ),
		      'import_preview_image_url'   => 'http://www.swiftideas.com/democontent/atelier/alvar/image.jpg',
		      'import_notice'              => '',
		      'preview_url'                => 'http://atelier.swiftideas.com/alvar-demo',
		    ),
		);
	}
	add_filter( 'pt-ocdi/import_files', 'atelier_ocdi_import_files' );


	function atelier_ocdi_after_import_setup() {
		// Assign menus to their locations.
		if ( 'Arad Demo' === $selected_import['import_file_name'] || 'Alvar Demo' === $selected_import['import_file_name'] ) {
			$main_menu = get_term_by( 'name', 'Main', 'nav_menu' );

			set_theme_mod( 'nav_menu_locations', array(
					'main-menu' => $main_menu->term_id,
				)
			);
		} else if ( 'Flock Demo' === $selected_import['import_file_name'] || 'Porter Demo' === $selected_import['import_file_name'] || 'Vario Demo' === $selected_import['import_file_name'] || 'Rebel Demo' === $selected_import['import_file_name'] ) {
			$main_menu = get_term_by( 'name', 'main menu', 'nav_menu' );

			set_theme_mod( 'nav_menu_locations', array(
					'main-menu' => $main_menu->term_id,
				)
			);
		} else if ( 'Bryant Demo' !== $selected_import['import_file_name'] ) {
			$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

			set_theme_mod( 'nav_menu_locations', array(
					'main-menu' => $main_menu->term_id,
				)
			);
		}

		// Assign front page and posts page (blog page).
		$front_page_id = get_page_by_title( 'Home' );
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
	}
	add_action( 'pt-ocdi/after_import', 'atelier_ocdi_after_import_setup' );

	// Disable branding
	add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );


	/* META BOX MISSING FALLBACK
    ================================================== */
	if (!function_exists('rwmb_meta')) {
		function rwmb_meta($key, $args, $postID = null) {
			if (!$postID) {
				$postID = get_the_ID();
			}
			return get_post_meta($postID, $key, true);
		}
	}

	/* SWIFT FRAMEWORK CHECK
    ================================================== */
    if ( ! function_exists( 'atelier_swiftframework_check' ) ) {
        function atelier_swiftframework_check() {

        	if ( class_exists( 'swiftframework' ) || !( current_user_can('editor') || current_user_can('administrator') ) ) {
        		return;
        	}

            $class = 'notice notice-error';
            $message = __( 'Please install/activate the Swift Framework plugin. If you have not installed the plugin, please go to Appearance > Install Plugins.', 'atelier' );

            printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
        }
        add_action( 'admin_notices', 'atelier_swiftframework_check' );
    }
    
    /* REDUX CHECK
    ================================================== */
    if ( ! function_exists( 'atelier_redux_check' ) ) {
        function atelier_redux_check() {

        	if ( class_exists( 'ReduxFramework' ) || !( current_user_can('editor') || current_user_can('administrator') ) ) {
        		return;
        	}

            $class = 'notice notice-error';
            $message = __( 'Please install/activate the Redux Framework plugin. If you have not installed the plugin, please go to Appearance > Install Plugins.', 'atelier' );

            printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
        }
        add_action( 'admin_notices', 'atelier_redux_check' );
    }

    /* META BOX CHECK
    ================================================== */
    if ( ! function_exists( 'atelier_metabox_check' ) ) {
        function atelier_metabox_check() {

        	if ( class_exists( 'RW_Meta_Box' ) || !( current_user_can('editor') || current_user_can('administrator') ) ) {
        		return;
        	}

            $class = 'notice notice-error';
            $message = __( 'Please install/activate the Meta Box plugin. If you have not installed the plugin, please go to Appearance > Install Plugins.', 'atelier' );

            printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
        }
        add_action( 'admin_notices', 'atelier_metabox_check' );
    }

