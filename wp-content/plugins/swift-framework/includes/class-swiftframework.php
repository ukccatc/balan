<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://swiftideas.com/swift-framework
 * @since      1.0.0
 *
 * @package    swift-framework
 * @subpackage swift-framework/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    swift-framework
 * @subpackage swift-framework/includes
 * @author     Swift Ideas
 */
class SwiftFramework {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      SwiftFramework_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $SwiftFramework    The string used to uniquely identify this plugin.
	 */
	protected $SwiftFramework;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->SwiftFramework = 'swift-framework';
		$this->version = '2.7.26';
		$this->current_theme = get_option('sf_theme');
		$this->envato_requirements = get_option('envato_requirements');
		$this->sf_custom_enabled = get_option('sf_custom_theme');
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

		global $sf_opts;
		$sf_opts = get_option('swift_framework_opts');

		$this->include_image_resizer();

		// DISABLE CHECK
		$disable_spb = $disable_ss = $safety = true;
		if ( $this->current_theme != "" || $this->sf_custom_enabled ) {

			$disable_spb = $sf_opts['disable_spb'];
			$disable_ss = $sf_opts['disable_ss'];
			
			$safety = false;
		}

		// CUSTOM POST TYPES
		$this->include_cpts();

		// WIDGETS
		if ($this->current_theme == 'atelier' ||
			$this->current_theme == 'uplift' ||
			$this->current_theme == 'nota' ||
			$this->current_theme == 'cardinal' ||
			$this->current_theme == 'joyn') {
			$this->include_widgets();
		}

		// Migration
		if ($this->current_theme == 'atelier' && $this->envato_requirements == 'may2019') {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/theme-compatibility/atelier.php';
		}
		if ($this->current_theme == 'cardinal' && $this->envato_requirements == 'may2019') {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/theme-compatibility/cardinal.php';
		}
		if ($this->current_theme == 'joyn' && $this->envato_requirements == 'may2019') {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/theme-compatibility/joyn.php';
		}
		if ($this->current_theme == 'nota' && $this->envato_requirements == 'may2019') {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/theme-compatibility/nota.php';
		}
		if ($this->current_theme == 'uplift' && $this->envato_requirements == 'may2019') {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/theme-compatibility/uplift.php';
		}

		// PAGE BUILDER
		$disable_gutenberg = true;
		if ( ! $disable_spb ) {
			if (isset($sf_opts['disable_gutenberg'])) {
				$disable_gutenberg = $sf_opts['disable_gutenberg'];
			}
			if ( $disable_gutenberg ) {
				add_filter('use_block_editor_for_post', '__return_false');
			}
			$this->include_swiftpagebuilder();
		}

		// SWIFT SLIDER
		if ( ! $disable_ss ) {
			$this->include_swiftslider();
		}

		// SHORTCODES
		if ( ! $safety ) {
			$this->include_shortcodes();
		}

		$youtube_nocookie = false;

		if (isset($sf_opts['youtube_nocookie'])) {
			$youtube_nocookie = $sf_opts['youtube_nocookie'];
			if ($youtube_nocookie) {
				$this->loader->add_filter( 'spb_youtube_base_domain', $this, 'spb_youtube_nocookie' );
			}
		}

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - SwiftFramework_Loader. Orchestrates the hooks of the plugin.
	 * - SwiftFramework_i18n. Defines internationalization functionality.
	 * - SwiftFramework_Admin. Defines all hooks for the admin area.
	 * - SwiftFramework_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-swiftframework-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-swiftframework-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-swiftframework-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-swiftframework-public.php';

		/**
		 * Options framework
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/options/admin-init.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/option-extensions/loader.php';

		/**
		 * Meta Box framework
		 */
		if ( $this->sf_custom_enabled ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/metabox/meta-setup.php';
		}

		$this->loader = new SwiftFramework_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the SwiftFramework_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new SwiftFramework_i18n();
		$plugin_i18n->set_domain( 'swift-framework-plugin' );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new SwiftFramework_Admin( $this->get_SwiftFramework(), $this->get_version() );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_swiftframework_menu' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $this, 'unregister_post_types' );
		$this->loader->add_action( 'add_meta_boxes', $this, 'register_meta_box_holder' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		$plugin_public = new SwiftFramework_Public( $this->get_SwiftFramework(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'body_class', $this, 'spb_body_class' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_SwiftFramework() {
		return $this->SwiftFramework;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    SwiftFramework_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
		
	/**
     * Include Custom Post Types
     * @since    1.0.0
	 */
    public function include_image_resizer() {
        include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/image-resize/spb_image_resizer.php' );
    }

	/**
     * Include Custom Post Types
     * @since    1.0.0
	 */
    public function include_cpts() {
        include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/custom-post-types/portfolio-type.php' );
        include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/custom-post-types/galleries-type.php' );
        include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/custom-post-types/team-type.php' );
        include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/custom-post-types/clients-type.php' );
        include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/custom-post-types/testimonials-type.php' );
        include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/custom-post-types/faqs-type.php' );
        include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/custom-post-types/directory-type.php' );
        include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/custom-post-types/spb-section-type.php' );
        include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/custom-post-types/sf-post-type-permalinks.php' );
    }

    /**
     * Include Widgets
     * @since    1.0.0
	 */
    public function include_widgets() {
        include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/widget-twitter.php' );
		include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/widget-flickr.php' );
		include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/widget-instagram.php' );
		include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/widget-video.php' );
		include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/widget-posts.php' );
		include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/widget-portfolio.php' );
		include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/widget-portfolio-grid.php' );
		include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/widget-advertgrid.php' );
		include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/widget-infocus.php' );
		include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/widget-comments.php' );
		include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/widget-mostloved.php' );
    }

    /**
     * Include Swift Slider
     * @since    1.0.0
	 */
    public function include_swiftslider() {
    	include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/swift-slider/swift-slider.php' );
    }

	/**
	 * Include Swift Page Builder
	 * @since    1.0.0
	 */
	public function include_swiftpagebuilder() {
	    include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/page-builder/sf-page-builder.php' );
	}

	/**
	 * Include Shortcodes
	 * @since    1.0.0
	 */
	public function include_shortcodes() {
	    include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/shortcodes/sf-shortcodes.php' );
	}

	/**
	 * Unregister Custom Post Types
	 * @since    1.5.0
	 */
	public function unregister_post_types( $post_type, $slug = '' ) {
        global $sf_opts, $wp_post_types;
        if ( isset( $sf_opts['cpt-disable'] ) ) {
            $cpt_disable = $sf_opts['cpt-disable'];
            if ( ! empty( $cpt_disable ) ) {
                foreach ( $cpt_disable as $post_type => $cpt ) {
                    if ( $cpt == 1 && isset( $wp_post_types[ $post_type ] ) ) {
                        unset( $wp_post_types[ $post_type ] );
                    }
                }
            }
        }
    }

    /**
	 * Add body class
	 * @since    2.5.45
	 */
   	public function spb_body_class( $classes ) {

   		/* Plugin Version */
        $classes[] = 'swift-framework-v' . $this->get_version();

        /* Theme Name + Version */
        $theme = wp_get_theme();
        $theme_name = strtolower( $theme->get( 'Name' ) );
        $theme_name = preg_replace('#[ -]+#', '-', $theme_name );
        $theme_version = $theme->get( 'Version' );

        $classes[] = $theme_name . "-v" . $theme_version;

        return $classes;
    }


    /**
	 * Adjust YouTube URLs
	 * @since    2.5.55
	 */
   	public function spb_youtube_nocookie() {
        return 'www.youtube-nocookie.com';
    }

    /**
	 * Register Meta Box Holder
	 * @since    2.5.55
	 */
   	public function register_meta_box_holder() {
        add_meta_box( 'sf_meta_box', __( 'Meta Options', 'swift-framework-plugin' ), array( $this, 'sf_build_meta_box_tabs' ), '', 'normal', 'high' );
    }

 	public function sf_build_meta_box_tabs() {
		echo'<div class="sf-meta-tabs-wrap"><div id="sf-tabbed-meta-boxes"></div></div>';
	}

}
