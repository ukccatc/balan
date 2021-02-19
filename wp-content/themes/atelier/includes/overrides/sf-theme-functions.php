<?php

	/*
	*
	*	Swift Framework Theme Functions
	*	------------------------------------------------
	*	Swift Framework v3.0
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*	atelier_run_migration()
	*	atelier_theme_opts_name()
	*	atelier_theme_activation()
	*	atelier_html5_ie_scripts()
	*	atelier_add_portfolio_category_meta()
	*	atelier_edit_portfolio_category_meta()
	*	atelier_save_portfolio_category_meta()
	*	atelier_fullscreen_search()
	*	atelier_nextprev_navigation()
	*	atelier_get_typekit_id()
	*	atelier_get_typekit_json_response()
	*	atelier_get_typekit_kit()
	*	atelier_create_typekit_font_family_array()
	*	atelier_add_typekit_to_redux_custom_fonts()
	*	atelier_typekit_enqueue_script()
	*	atelier_typekit_inline_script()
	*	atelier_typekit_admin_css()
	*
	*
	*	OVERRIDES
	*	atelier_get_thumb_type
	*	atelier_header_wrap
	*	atelier_top_bar
	*	atelier_main_menu
	*	atelier_get_search
	*	atelier_header_aux
	*	atelier_ajaxsearch
	*	atelier_overlay_menu
	*	atelier_mobile_menu
	*	atelier_get_post_details
	*	atelier_get_masonry_post
	*	atelier_product_meta
	*	atelier_product_share
	*	atelier_woocommercehelp_bar
	*	atelier_post_top_author
	*	atelier_post_info
	*	atelier_post_pagination
	*
	*/
	
	/* CUSTOMIZER COLOUR MIGRATION
	================================================== */
    function atelier_run_migration() {
        $GLOBALS['sf_customizer']['design_style_type'] = get_option('design_style_type', 'minimal');
        $GLOBALS['sf_customizer']['accent_color'] = get_option('accent_color', '#fe504f');
        $GLOBALS['sf_customizer']['accent_alt_color'] = get_option('accent_alt_color', '#ffffff');
        $GLOBALS['sf_customizer']['secondary_accent_color'] = get_option('secondary_accent_color', '#222222');
        $GLOBALS['sf_customizer']['secondary_accent_alt_color'] = get_option('secondary_accent_alt_color', '#ffffff');
        $GLOBALS['sf_customizer']['page_bg_color'] = get_option('page_bg_color', '#222222');
        $GLOBALS['sf_customizer']['inner_page_bg_transparent'] = get_option('inner_page_bg_transparent', 'color');
        $GLOBALS['sf_customizer']['inner_page_bg_color'] = get_option('inner_page_bg_color', '#FFFFFF');
        $GLOBALS['sf_customizer']['section_divide_color'] = get_option('section_divide_color', '#e4e4e4');
        $GLOBALS['sf_customizer']['alt_bg_color'] = get_option('alt_bg_color', '#f7f7f7');
        $GLOBALS['sf_customizer']['topbar_bg_color'] = get_option('topbar_bg_color', '#ffffff');
        $GLOBALS['sf_customizer']['topbar_text_color'] = get_option('topbar_text_color', '#222222');
        $GLOBALS['sf_customizer']['topbar_link_color'] = get_option('topbar_link_color', '#666666');
        $GLOBALS['sf_customizer']['topbar_link_hover_color'] = get_option('topbar_link_hover_color', '#fe504f');
        $GLOBALS['sf_customizer']['topbar_divider_color'] = get_option('topbar_divider_color', '#e3e3e3');
        $GLOBALS['sf_customizer']['header_bg_color'] = get_option('header_bg_color', '#ffffff');
        $GLOBALS['sf_customizer']['header_bg_transparent'] = get_option('header_bg_transparent', 'color');
        $GLOBALS['sf_customizer']['header_border_color'] = get_option('header_border_color', '#e4e4e4');
        $GLOBALS['sf_customizer']['header_text_color'] = get_option('header_text_color', '#222');
        $GLOBALS['sf_customizer']['header_link_color'] = get_option('header_link_color', '#222');
        $GLOBALS['sf_customizer']['header_link_hover_color'] = get_option('header_link_hover_color', '#fe504f');
        $GLOBALS['sf_customizer']['header_divider_style'] = get_option('header_divider_style', 'divider');
        $GLOBALS['sf_customizer']['mobile_menu_bg_color'] = get_option('mobile_menu_bg_color', '#222');
        $GLOBALS['sf_customizer']['mobile_menu_divider_color'] = get_option('mobile_menu_divider_color', '#444');
        $GLOBALS['sf_customizer']['mobile_menu_text_color'] = get_option('mobile_menu_text_color', '#e4e4e4');
        $GLOBALS['sf_customizer']['mobile_menu_link_color'] = get_option('mobile_menu_link_color', '#fff');
        $GLOBALS['sf_customizer']['mobile_menu_link_hover_color'] = get_option('mobile_menu_link_hover_color', '#fe504f');
        $GLOBALS['sf_customizer']['nav_hover_style'] = get_option('nav_hover_style', 'standard');
        $GLOBALS['sf_customizer']['nav_bg_color'] = get_option('nav_bg_color', '#fff');
        $GLOBALS['sf_customizer']['nav_text_color'] = get_option('nav_text_color', '#252525');
        $GLOBALS['sf_customizer']['nav_bg_hover_color'] = get_option('nav_bg_hover_color', '#f7f7f7');
        $GLOBALS['sf_customizer']['nav_text_hover_color'] = get_option('nav_text_hover_color', '#fe504f');
        $GLOBALS['sf_customizer']['nav_selected_bg_color'] = get_option('nav_selected_bg_color', '#e3e3e3');
        $GLOBALS['sf_customizer']['nav_selected_text_color'] = get_option('nav_selected_text_color', '#fe504f');
        $GLOBALS['sf_customizer']['nav_pointer_color'] = get_option('nav_pointer_color', '#07c1b6');
        $GLOBALS['sf_customizer']['nav_sm_bg_color'] = get_option('nav_sm_bg_color', '#FFFFFF');
        $GLOBALS['sf_customizer']['nav_sm_text_color'] = get_option('nav_sm_text_color', '#666666');
        $GLOBALS['sf_customizer']['nav_sm_bg_hover_color'] = get_option('nav_sm_bg_hover_color', '#f7f7f7');
        $GLOBALS['sf_customizer']['nav_sm_text_hover_color'] = get_option('nav_sm_text_hover_color', '#000000');
        $GLOBALS['sf_customizer']['nav_sm_selected_text_color'] = get_option('nav_sm_selected_text_color', '#000000');
        $GLOBALS['sf_customizer']['nav_divider'] = get_option('nav_divider', 'solid');
        $GLOBALS['sf_customizer']['nav_divider_color'] = get_option('nav_divider_color', '#f0f0f0');
        $GLOBALS['sf_customizer']['overlay_menu_bg_color'] = get_option('overlay_menu_bg_color', '#fe504f');
        $GLOBALS['sf_customizer']['overlay_menu_link_color'] = get_option('overlay_menu_link_color', '#ffffff');
        $GLOBALS['sf_customizer']['overlay_menu_link_hover_color'] = get_option('overlay_menu_link_hover_color', '#fe504f');
        $GLOBALS['sf_customizer']['overlay_menu_link_hover_bg_color'] = get_option('overlay_menu_link_hover_bg_color', '#ffffff');
        $GLOBALS['sf_customizer']['promo_bar_bg_color'] = get_option('promo_bar_bg_color', '#e4e4e4');
        $GLOBALS['sf_customizer']['promo_bar_text_color'] = get_option('promo_bar_text_color', '#222');
        $GLOBALS['sf_customizer']['breadcrumb_bg_color'] = get_option('breadcrumb_bg_color', '#e4e4e4');
        $GLOBALS['sf_customizer']['breadcrumb_text_color'] = get_option('breadcrumb_text_color', '#666666');
        $GLOBALS['sf_customizer']['breadcrumb_link_color'] = get_option('breadcrumb_link_color', '#999999');
        $GLOBALS['sf_customizer']['page_heading_bg_color'] = get_option('page_heading_bg_color', '#f7f7f7');
        $GLOBALS['sf_customizer']['page_heading_text_color'] = get_option('page_heading_text_color', '#222222');
        $GLOBALS['sf_customizer']['page_heading_text_align'] = get_option('page_heading_text_align', 'left');
        $GLOBALS['sf_customizer']['body_color'] = get_option('body_color', '#222222');
        $GLOBALS['sf_customizer']['body_alt_color'] = get_option('body_alt_color', '#222222');
        $GLOBALS['sf_customizer']['link_color'] = get_option('link_color', '#444444');
        $GLOBALS['sf_customizer']['link_hover_color'] = get_option('link_hover_color', '#999999');
        $GLOBALS['sf_customizer']['h1_color'] = get_option('h1_color', '#222222');
        $GLOBALS['sf_customizer']['h2_color'] = get_option('h2_color', '#222222');
        $GLOBALS['sf_customizer']['h3_color'] = get_option('h3_color', '#222222');
        $GLOBALS['sf_customizer']['h4_color'] = get_option('h4_color', '#222222');
        $GLOBALS['sf_customizer']['h5_color'] = get_option('h5_color', '#222222');
        $GLOBALS['sf_customizer']['h6_color'] = get_option('h6_color', '#222222');
        $GLOBALS['sf_customizer']['overlay_bg_color'] = get_option('overlay_bg_color', '#fe504f');
        $GLOBALS['sf_customizer']['overlay_text_color'] = get_option('overlay_text_color', '#ffffff');
        $GLOBALS['sf_customizer']['article_review_bar_alt_color'] = get_option('article_review_bar_alt_color', '#f7f7f7');
        $GLOBALS['sf_customizer']['article_review_bar_color'] = get_option('article_review_bar_color', '#2e2e36');
        $GLOBALS['sf_customizer']['article_review_bar_text_color'] = get_option('article_review_bar_text_color', '#fff');
        $GLOBALS['sf_customizer']['article_extras_bg_color'] = get_option('article_extras_bg_color', '#f7f7f7');
        $GLOBALS['sf_customizer']['article_np_bg_color'] = get_option('article_np_bg_color', '#444');
        $GLOBALS['sf_customizer']['article_np_text_color'] = get_option('article_np_text_color', '#fff');
        $GLOBALS['sf_customizer']['input_bg_color'] = get_option('input_bg_color', '#f7f7f7');
        $GLOBALS['sf_customizer']['input_text_color'] = get_option('input_text_color', '#222222');
        $GLOBALS['sf_customizer']['icon_container_bg_color'] = get_option('icon_container_bg_color', '#1dc6df');
        $GLOBALS['sf_customizer']['atelier_icon_color'] = get_option('sf_icon_color', '#1dc6df');
        $GLOBALS['sf_customizer']['icon_container_hover_bg_color'] = get_option('icon_container_hover_bg_color', '#222');
        $GLOBALS['sf_customizer']['atelier_icon_alt_color'] = get_option('sf_icon_alt_color', '#ffffff');
        $GLOBALS['sf_customizer']['boxed_content_color'] = get_option('boxed_content_color', '#07c1b6');
        $GLOBALS['sf_customizer']['share_button_bg'] = get_option('share_button_bg', '#fe504f');
        $GLOBALS['sf_customizer']['share_button_text'] = get_option('share_button_text', '#ffffff');
        $GLOBALS['sf_customizer']['bold_rp_bg'] = get_option('bold_rp_bg', '#e3e3e3');
        $GLOBALS['sf_customizer']['bold_rp_text'] = get_option('bold_rp_text', '#222');
        $GLOBALS['sf_customizer']['bold_rp_hover_bg'] = get_option('bold_rp_hover_bg', '#fe504f');
        $GLOBALS['sf_customizer']['bold_rp_hover_text'] = get_option('bold_rp_hover_text', '#ffffff');
        $GLOBALS['sf_customizer']['tweet_slider_bg'] = get_option('tweet_slider_bg', '#1dc6df');
        $GLOBALS['sf_customizer']['tweet_slider_text'] = get_option('tweet_slider_text', '#ffffff');
        $GLOBALS['sf_customizer']['tweet_slider_link'] = get_option('tweet_slider_link', '#339933');
        $GLOBALS['sf_customizer']['tweet_slider_link_hover'] = get_option('tweet_slider_link_hover', '#ffffff');
        $GLOBALS['sf_customizer']['testimonial_slider_bg'] = get_option('testimonial_slider_bg', '#1dc6df');
        $GLOBALS['sf_customizer']['testimonial_slider_text'] = get_option('testimonial_slider_text', '#ffffff');
        $GLOBALS['sf_customizer']['footer_bg_color'] = get_option('footer_bg_color', '#222222');
        $GLOBALS['sf_customizer']['footer_text_color'] = get_option('footer_text_color', '#cccccc');
        $GLOBALS['sf_customizer']['footer_link_color'] = get_option('footer_link_color', '#ffffff');
        $GLOBALS['sf_customizer']['footer_link_hover_color'] = get_option('footer_link_hover_color', '#cccccc');
        $GLOBALS['sf_customizer']['footer_border_color'] = get_option('footer_border_color', '#333333');
        $GLOBALS['sf_customizer']['copyright_bg_color'] = get_option('copyright_bg_color', '#222222');
        $GLOBALS['sf_customizer']['copyright_text_color'] = get_option('copyright_text_color', '#999999');
        $GLOBALS['sf_customizer']['copyright_link_color'] = get_option('copyright_link_color', '#ffffff');
        $GLOBALS['sf_customizer']['copyright_link_hover_color'] = get_option('copyright_link_hover_color', '#cccccc');
        update_option( 'sf_customizer', $GLOBALS['sf_customizer']);
    }

    if (!isset($GLOBALS['sf_customizer'])) {
        $GLOBALS['sf_customizer'] = get_option('sf_customizer', array());
        if (empty($GLOBALS['sf_customizer'])) {
            atelier_run_migration();
        }
    }
	

	/* THEME OPTIONS NAME
	================================================== */
	if (!function_exists('atelier_theme_opts_name')) {
		function atelier_theme_opts_name() {
			return 'sf_atelier_options';
		}
	}

	/* THEME ACTIVATION
	================================================== */
	if (!function_exists('atelier_theme_activation')) {
		function atelier_theme_activation() {
			global $pagenow;
			if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
				// Update sf_theme for framework plugin
				update_option( 'sf_theme', 'atelier' );

				// provide hook so themes can execute theme specific functions on activation
				do_action('atelier_theme_activation');

				// flush rewrite rules
				flush_rewrite_rules();

				// redirect to options page
				header( 'Location: '.admin_url().'themes.php?page=tgmpa-install-plugins' ) ;
			}
		}
		add_action('after_switch_theme', 'atelier_theme_activation');
	}

	/* THEME DEACTIVATION
	================================================== */
	if (!function_exists('atelier_theme_deactivation')) {
		function atelier_theme_deactivation() {
			// Delete sf_theme
			delete_option( 'sf_theme' );
		}
		add_action('switch_theme', 'atelier_theme_deactivation');
	}

	/* PORTFOLIO CATEGORY META
	================================================== */
	function atelier_add_portfolio_category_meta() {
		?>
		<div class="form-field">
			<label for="term_meta[icon]"><?php _e( 'Category Icon', 'atelier' ); ?></label>
			<input type="text" name="term_meta[icon]" id="term_meta[icon]" value="">
			<p class="description"><?php _e( 'Enter a Font Awesome or Gizmo class name to display an icon next to the category in the portfolio filter.','atelier' ); ?></p>
		</div>
	<?php
	}
	add_action( 'portfolio-category_add_form_fields', 'atelier_add_portfolio_category_meta', 10, 2 );

	// Edit term page
	function atelier_edit_portfolio_category_meta($term) {
		$t_id = $term->term_id;
		$term_meta = get_option( "portfolio-category_$t_id" );
		?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="term_meta[icon]"><?php _e( 'Category Icon', 'atelier' ); ?></label></th>
			<td>
				<input type="text" name="term_meta[icon]" id="term_meta[icon]" value="<?php echo esc_attr( $term_meta['icon'] ) ? esc_attr( $term_meta['icon'] ) : ''; ?>">
				<p class="description"><?php _e( 'Enter a Font Awesome or Gizmo class name to display an icon next to the category in the portfolio filter.','atelier' ); ?></p>
			</td>
		</tr>
	<?php
	}
	add_action( 'portfolio-category_edit_form_fields', 'atelier_edit_portfolio_category_meta', 10, 2 );

	// Save extra taxonomy fields callback function.
	function atelier_save_portfolio_category_meta( $term_id ) {
		if ( isset( $_POST['term_meta'] ) ) {
			$t_id = $term_id;
			$term_meta = get_option( "portfolio-category_$t_id" );
			$cat_keys = array_keys( $_POST['term_meta'] );
			foreach ( $cat_keys as $key ) {
				if ( isset ( $_POST['term_meta'][$key] ) ) {
					$term_meta[$key] = $_POST['term_meta'][$key];
				}
			}
			// Save the option array.
			update_option( "portfolio-category_$t_id", $term_meta );
		}
	}
	add_action( 'edited_portfolio-category', 'atelier_save_portfolio_category_meta', 10, 2 );
	add_action( 'create_portfolio-category', 'atelier_save_portfolio_category_meta', 10, 2 );


	/* ANIMATIONS LIST
	================================================== */
	if ( ! function_exists( 'atelier_get_animations_list' ) ) {
		function atelier_get_animations_list($return_array = false) {
		    $anim_array = array(
		        __( "None", 'atelier' )              	=> "none",
		        __( "Bounce", 'atelier' )            	=> "bounce",
		        __( "Flash", 'atelier' )             	=> "flash",
		        __( "Pulse", 'atelier' )             	=> "pulse",
		        __( "Rubberband", 'atelier' )        	=> "rubberBand",
		        __( "Shake", 'atelier' )             	=> "shake",
		        __( "Swing", 'atelier' )             	=> "swing",
		        __( "TaDa", 'atelier' )              	=> "tada",
		        __( "Wobble", 'atelier' )            	=> "wobble",
		        __( "Bounce In", 'atelier' )         	=> "bounceIn",
		        __( "Bounce In Down", 'atelier' )     => "bounceInDown",
		        __( "Bounce In Left", 'atelier' )     => "bounceInLeft",
		        __( "Bounce In Right", 'atelier' )    => "bounceInRight",
		        __( "Bounce In Up", 'atelier' )       => "bounceInUp",
		        __( "Fade In", 'atelier' )            => "fadeIn",
		        __( "Fade In Down", 'atelier' )       => "fadeInDown",
		        __( "Fade In Down Big", 'atelier' )   => "fadeInDownBig",
		        __( "Fade In Left", 'atelier' )       => "fadeInLeft",
		        __( "Fade In Left Big", 'atelier' )   => "fadeInLeftBig",
		        __( "Fade In Right", 'atelier' )      => "fadeInRight",
		        __( "Fade In Right Big", 'atelier' )  => "fadeInRightBig",
		        __( "Fade In Up", 'atelier' )         => "fadeInUp",
		        __( "Fade In Up Big", 'atelier' )     => "fadeInUpBig",
		        __( "Flip", 'atelier' )             	=> "flip",
		        __( "Flip In X", 'atelier' )          => "flipInX",
		        __( "Flip In Y", 'atelier' )          => "flipInY",
		        __( "Lightspeed In", 'atelier' )      => "lightSpeedIn",
		        __( "Rotate In", 'atelier' )          => "rotateIn",
		        __( "Rotate In Down Left", 'atelier' ) => "rotateInDownLeft",
		        __( "Rotate In Down Right", 'atelier' ) => "rotateInDownRight",
		        __( "Rotate In Up Left", 'atelier' )  => "rotateInUpLeft",
		        __( "Rotate In Up Right", 'atelier' ) => "rotateInUpRight",
		        __( "Roll In", 'atelier' )            => "rollIn",
		        __( "Zoom In", 'atelier' )            => "zoomIn",
		        __( "Zoom In Down", 'atelier' )       => "zoomInDown",
		        __( "Zoom In Left", 'atelier' )       => "zoomInLeft",
		        __( "Zoom In Right", 'atelier' )      => "zoomInRight",
		        __( "Zoom In Up", 'atelier' )         => "zoomInUp",
		        __( "Slide In Down", 'atelier' )      => "slideInDown",
		        __( "Slide In Left", 'atelier' )      => "slideInLeft",
		        __( "Slide In Right", 'atelier' )     => "slideInRight",
		        __( "Slide In Up", 'atelier' )        => "slideInUp",
		    );

		    if ( $return_array ) {
		    	return $anim_array;
		    } else {
		        $anim_opts = "";

		        foreach ($anim_array as $anim_name => $anim_class) {
		        	$anim_opts .= '<option value="'.$anim_class.'">'.$anim_name.'</option>';
		        }

		        return $anim_opts;
		    }

		}
	}

	/* HOME PRELOADER
	================================================== */
	if (!function_exists('atelier_home_preloader')) {
		function atelier_home_preloader() {

			global $atelier_options;
			$home_preloader = false;
			if (isset($atelier_options['home_preloader'])) {
			$home_preloader = $atelier_options['home_preloader'];
			}

			if (!$home_preloader || is_paged() || !(is_home() || is_front_page())) {
				return;
			}

			$logo = $alt_logo = array();
//			if (isset($atelier_options['logo_upload'])) {
//			$logo = $atelier_options['logo_upload'];
//			}
//			$logo_alt = get_bloginfo( 'name' );
			{ ?>

				<div id="sf-home-preloader">

					<?php if (isset($logo['url']) && $logo['url'] != "") { ?>
						<div id="preload-logo">
							<img class="standard" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo_alt); ?>" height="<?php echo esc_attr($logo['height']); ?>" width="<?php echo esc_attr($logo['width']); ?>" />
						</div>
					<?php } ?>

					<?php echo atelier_loading_animation('preloader-loading', 'preloader'); ?>

				</div>

			<?php }
		}
		add_action('atelier_before_page_container', 'atelier_home_preloader', 4);
	}


	/* FULLSCREEN SEARCH
	================================================== */
	if (!function_exists('atelier_fullscreen_search')) {
		function atelier_fullscreen_search() {

			global $atelier_options;
			$header_search_type = $atelier_options['header_search_type'];
			$header_search_pt = $atelier_options['header_search_pt'];

			// Overlay Search
			if ($header_search_type == "fs-search-on") { ?>

				<div id="fullscreen-search">

					<a href="#" class="fs-overlay-close"><?php echo apply_filters( 'atelier_fullscreen_close_icon', '<i class="ss-delete"></i>' ); ?></a>

					<div class="search-wrap" data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>">

						<div class="fs-search-bar">
							<form method="get" class="ajax-search-form" action="<?php echo esc_url(home_url()); ?>/">
								<input id="fs-search-input" type="text" name="s" placeholder="<?php _e('Type to search', 'atelier'); ?>" autocomplete="off">
								<?php if ($header_search_pt != "any") { ?>
									<input type="hidden" name="post_type" value="<?php echo esc_attr($header_search_pt); ?>" />
								<?php } ?>
							</form>
						</div>

						<div class="ajax-loading-wrap">
							<?php echo atelier_loading_animation('', 'ajax-loading'); ?>
						</div>

						<div class="ajax-search-results"></div>

					</div>

				</div>

			<?php }
		}
	}

	/* SIDE SLIDEOUT CONFIG
	================================================== */
	if (!function_exists('atelier_sideslideout_config')) {
		function atelier_sideslideout_config() {

			global $atelier_options;
			
			$header_left_config = $atelier_options['header_left_config'];
			$header_right_config = $atelier_options['header_right_config'];

			// Side Slideout Left
			if (isset($header_left_config) && array_key_exists('side-slideout', $header_left_config['enabled'])) {
				echo atelier_sideslideout('left');
			}

			// Side Slideout Right
			if (isset($header_right_config) && array_key_exists('side-slideout', $header_right_config['enabled'])) {
				echo atelier_sideslideout('right');
			}

		}
		add_action( 'atelier_before_page_container', 'atelier_sideslideout_config', 40 );
	}

	/* SIDE SLIDEOUT
	================================================== */
	if (!function_exists('atelier_sideslideout')) {
		function atelier_sideslideout($side = 'left') {

			global $atelier_options;
			$slideout_output = $page_menu = $menu_output = "";
			
			$side_slideout_type = "menu";
			
			if ( isset($atelier_options['side_slideout_type']) ) {  
				$side_slideout_type = $atelier_options['side_slideout_type'];
			}
			
			if ( $side_slideout_type == "sidebar" ) {
				
				$side_slideout_sidebar = strtolower($atelier_options['side_slideout_sidebar']);
				
				// SLIDEOUT OUTPUT
				$slideout_output .= '<div id="side-slideout-'.$side.'-wrap" class="sf-side-slideout">';
				$slideout_output .= '<div class="slideout-sidebar">';
				$slideout_output .= atelier_get_dynamic_sidebar( $side_slideout_sidebar );
				$slideout_output .= '</div>';
				$slideout_output .= '</div>';
	
				return $slideout_output;
	
			} else {
				
				if ( !class_exists( 'atelier_alt_menu_walker' ) ) {
					return 'Please enable the SwiftFramework plugin';
				}
	
				$slideout_menu_args = array(
					'echo'           => false,
					'theme_location' => 'slideout_menu',
					'walker'         => new atelier_alt_menu_walker,
					'fallback_cb' 	 => '',
				);
	
	
				// MENU OUTPUT
				$menu_output .= '<nav class="std-menu clearfix">'. "\n";
	
				if(function_exists('wp_nav_menu')) {
					if (has_nav_menu('slideout_menu')) {
						$menu_output .= wp_nav_menu( $slideout_menu_args );
					}
					else {
						$menu_output .= '<div class="no-menu">'.__("Please assign a menu to the Main Menu in Appearance > Menus", 'atelier').'</div>';
					}
				}
				$menu_output .= '</nav>'. "\n";
	
	
				// SLIDEOUT OUTPUT
	
				$slideout_output .= '<div id="side-slideout-'.$side.'-wrap" class="sf-side-slideout">';
				$slideout_output .= '<div class="vertical-menu">';
				$slideout_output .= $menu_output;
				$slideout_output .= '</div>';
				$slideout_output .= '</div>';
	
				return $slideout_output;
			}
		}
	}

	/* FULLSCREEN SEARCH
	================================================== */
	if (!function_exists('atelier_fullscreen_supersearch')) {
		function atelier_fullscreen_supersearch() { ?>

			<div id="fullscreen-supersearch">

				<a href="#" class="fs-overlay-close"><?php echo apply_filters( 'atelier_fullscreen_close_icon', '<i class="ss-delete"></i>' ); ?></a>

				<div class="supersearch-wrap">
					<?php echo atelier_super_search(); ?>
				</div>

			</div>

		<?php }
	}


    /* GET typekit KIT ID
    ================================================== */
    if ( ! function_exists( 'atelier_get_typekit_id' ) ) {
        function atelier_get_typekit_id() {
            
            global $atelier_options;
            
            $typekit_id = '';
            $atelier_options = get_option ( 'sf_atelier_options' );
        
            if ( isset( $atelier_options['typekit_id'] ) ) {
                $typekit_id = $atelier_options['typekit_id'];
            }

            return $typekit_id;

        }
    }

    /* REQUEST API TO RETURN KIT FONTS ARRAY
    ================================================== */
    if ( ! function_exists( 'atelier_get_typekit_json_response' ) ) {
        function atelier_get_typekit_json_response() {
            
            $kits = $typekit_id = '';
            $typekit_id = atelier_get_typekit_id();
            
            if ( $typekit_id ) {
                $url = sprintf( 'http://typekit.com/api/v1/json/kits/%s', esc_attr( $typekit_id ) . '/published' );
                $request = wp_remote_get( $url );

                if ( ! is_wp_error( $request ) ) {
                    $response_body = wp_remote_retrieve_body( $request );
                    $kits = json_decode( $response_body );
                }
            }

            set_transient('atelier_typekit_kits', $kits, 60 * 60); //1 hour cache

            return $kits;

        }
    }

    /* RETURN KIT FONTS ARRAY AS TABLE OUTPUT
    ================================================== */
    if ( ! function_exists( 'atelier_get_typekit_kit' ) ) {
        function atelier_get_typekit_kit() {
            
            $out = $kits = '';
            $kits = get_transient( 'atelier_typekit_kits' );
            if (!$kits) {
            	$kits = atelier_get_typekit_json_response();  
        	}

            if ( ! empty( $kits ) && is_object( $kits ) ) {

                $out .='<table class="sf-typekit-kits">';
                $out .='<thead>';
                    $out .='<tr>';
                        $out .='<th>' . esc_html__( 'Font', 'atelier' ) . '</th>';
                        $out .='<th>' . esc_html__( 'Font Family CSS Value', 'atelier' ) . '</th>';
                        $out .='<th>' . esc_html__( 'Variations/Weights', 'atelier' ) . '</th>';
                        $out .='<th>' . esc_html__( 'URL', 'atelier' ) . '</th>';
                    $out .='</tr>';
                $out .='</thead>';
                $out .='<tbody>';
                foreach ( $kits->kit->families as $font_family ) {
                    $out .='<tr><td><strong>';
                    $out .= $font_family->name;
                    $out .='</strong></td><td><code>';
                    $out .= $font_family->slug;
                    $out .='</code></td><td>';
                    $variations = $font_family->variations;
                    $italic = esc_html__( 'Italic', 'atelier' );
                    
                    foreach ( $variations as $variation => $value ){
                        if ( $value == 'n3' ) {
                            $out .='300';
                            if ( $value == 'n3' && 'i3' ) {
                                $out .=' <em>+ ' . $italic . '</em>';
                            }
                            $out .='<br />';
                        } elseif ( $value == 'n4' ) {
                            $out .='400';
                            if ( $value == 'n4' && 'i4' ) {
                                $out .=' <em>+ ' . $italic . '</em>';
                            }
                            $out .='<br />';
                        } elseif ( $value == 'n5' ) {
                            $out .='500';
                            if ( $value == 'n5' && 'i5' ) {
                                $out .=' <em>+ ' . $italic . '</em>';
                            }
                            $out .='<br />';
                        } elseif ( $value == 'n6' ) {
                            $out .='<strong>600';
                            if ( $value == 'n6' && 'i6' ) {
                                $out .=' <em>+ ' . $italic . '</em>';
                            }
                            $out .='</strong><br />';
                        } elseif ( $value == 'n7' ) {
                            $out .='<strong>700';
                            if ( $value == 'n7' && 'i7' ) {
                                $out .=' <em>+ ' . $italic . '</em>';
                            }
                            $out .='</strong><br />';
                        } elseif ( $value == 'n8' ) {
                            $out .='<strong>800';
                            if ( $value == 'n8' && 'i8' ) {
                                $out .=' <em>+ ' . $italic . '</em>';
                            }
                            $out .='</strong><br />';
                        } elseif ( $value == 'n9' ) {
                            $out .='<strong>900';
                            if ( $value == 'n9' && 'i9' ) {
                                $out .=' <em>+ ' . $italic . '</em>';
                            }
                            $out .='</strong><br />';
                        }
                    }
                    $out .='</td><td>';
                    $out .='<a href="http://typekit.com/fonts/' . esc_attr( $font_family->slug ) . '">';
                    $out .= esc_html__( 'View on Typekit', 'atelier' );
                    $out .='</a></td></tr>';
                }
                $out .='</tbody>';
                $out .='</table>'; 

            } else {

            $out .= esc_html__( 'No Kit Available. If you just added your ID, please try saving options and wait for refresh.', 'atelier' );

        }

        return $out; 

        }
    }

    /* CREATE FONT FAMILIES ARRAY
    ================================================== */
    if ( ! function_exists( 'atelier_create_typekit_font_family_array' ) ) {
        function atelier_create_typekit_font_family_array( ) {
            
            $typekit_id = $kits = '';
            $font_families = array();
            $kits = get_transient( 'atelier_typekit_kits' );
            if (!$kits) {
            	$kits = atelier_get_typekit_json_response();  
        	}

            if ( ! empty( $kits ) && is_object( $kits ) ) {
                foreach ($kits->kit->families as $font_family ) {
                	$stack = $font_family->css_stack;
                	$stack = str_replace(',sans-serif', '', $stack);
                	$stack = str_replace('"', '', $stack);
                    $font_families[$stack] = $font_family->name;
                }
            	return $font_families;
            } else {
                return false;
            }
        }
    }

    /* PASS TYPEKIT FONTS TO REDUX TYPOGRAPHY THEME OPTIONS
    ================================================== */
    if ( ! function_exists( 'atelier_add_typekit_to_redux_custom_fonts' ) ) {
        function atelier_add_typekit_to_redux_custom_fonts( $custom_fonts ) {
            
            $font_families = $font_out = '';
            $font_families = atelier_create_typekit_font_family_array();

            if ( is_array( $font_families ) && !empty( $font_families ) ) {
                $font_out = array( esc_html__( 'Typekit Fonts', 'atelier' ) => $font_families );
                return $font_out;
            } else {
            	return $custom_fonts;
            }

        }
        add_filter( 'redux/sf_atelier_options/field/typography/custom_fonts', 'atelier_add_typekit_to_redux_custom_fonts' );
    }

    /* ENQUEUE typekit SCRIPT - FRONTEND & ADMIN REQUIRED
    ================================================== */
    if ( ! function_exists( 'atelier_typekit_enqueue_script' ) ) {
        function atelier_typekit_enqueue_script() {
            
            $typekit_id = atelier_get_typekit_id();
            if ( $typekit_id ) {
                wp_enqueue_script( 'theme_typekit', '//use.typekit.net/' . esc_attr( $typekit_id ) . '.js', '', false);
            }

        }
         add_action( 'wp_enqueue_scripts', 'atelier_typekit_enqueue_script' );
         add_action('admin_enqueue_scripts', 'atelier_typekit_enqueue_script');
    }

    /* ENQUEUE typekit INLINE SCRIPT - FRONTEND & ADMIN REQUIRED
    ================================================== */
    if ( ! function_exists( 'atelier_typekit_inline_script' ) ) {
        function atelier_typekit_inline_script() {
            
            $typekit_id = atelier_get_typekit_id();
            if ( $typekit_id && wp_script_is( 'theme_typekit', 'enqueued' ) ) {
                echo '<script type="text/javascript">try{Typekit.load();}catch(e){}</script>';
            }

        }
        add_action( 'wp_head', 'atelier_typekit_inline_script' );
        add_action( 'admin_head', 'atelier_typekit_inline_script' );
    }


	if ( ! function_exists( 'atelier_typekit_admin_css' ) ) {
	    function atelier_typekit_admin_css() { 
	    	?>
	    	<style type="text/css" media="screen">
	    	/* typekit Theme Options  */
            .sf-typekit-kits {
                border-spacing: 0;
                width: 100%;
                clear: both;
                margin: 0;
            }
            table.sf-typekit-kits {
                border: 1px solid #e5e5e5;
                -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.04);
                box-shadow: 0 1px 1px rgba(0,0,0,.04);
            }
            .sf-typekit-kits thead td,.sf-typekit-kits thead th {
                border-bottom: 1px solid #e1e1e1;
            }
            .sf-typekit-kits td,.sf-typekit-kits th {
                padding: 8px 10px !important;
            }
            </style>
           <?php
	    }
	    add_action( 'admin_head', 'atelier_typekit_admin_css' );
	}

	/* NEXT/PREV NAVIGATION
	================================================== */
	if (!function_exists('atelier_nextprev_navigation')) {
		function atelier_nextprev_navigation() {

			global $atelier_options;

			// Pagiantion style
			$pagination_style = "standard";
			if ( isset( $atelier_options['pagination_style'] ) ) {
			    $pagination_style = $atelier_options['pagination_style'];
			}

			// Category navigation
			$enable_category_navigation = $atelier_options['enable_category_navigation'];

			if (!(is_singular('post') || is_singular('portfolio') || is_singular('product')) || $pagination_style != "fs-arrow" || !atelier_theme_supports( 'fullscreen-pagination' ) ) {
				return;
			}

			$taxonomy = "category";

			if ( is_singular('portfolio') ) {
				$taxonomy = "portfolio-category";
			} else if ( is_singular('product') ) {
				$taxonomy = "product_cat";
			}

			// Get next/prev post
			$prev_post = get_next_post($enable_category_navigation, '', $taxonomy);
			$next_post = get_previous_post($enable_category_navigation, '', $taxonomy);

			$atelier_prev_icon = apply_filters( 'atelier_prev_icon', '<i class="ss-navigateleft"></i>' );
			$atelier_next_icon = apply_filters( 'atelier_next_icon', '<i class="ss-navigateright"></i>' );

			if (!empty( $prev_post )) {

				$postID = $prev_post->ID;
				$prev_permalink = get_permalink($postID);
				$item_subtitle = atelier_get_post_meta($postID, 'sf_portfolio_subtitle', true);
				$use_thumb_content = atelier_get_post_meta($postID, 'sf_thumbnail_content_main_detail', true);

				$image = $media_image_url = $image_id = "";

				if ($use_thumb_content) {
				$media_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full', $postID);
				} else {
				$media_image = rwmb_meta('sf_detail_image', 'type=image&size=full', $postID);
				}

				foreach ($media_image as $detail_image) {
					$image_id = $detail_image['ID'];
					$media_image_url = $detail_image['url'];
					break;
				}

				if (!$media_image) {
					$media_image = get_post_thumbnail_id($postID);
					$image_id = $media_image;
					$media_image_url = wp_get_attachment_url( $media_image, 'full' );
				}

				$detail_image = atelier_aq_resize($media_image_url, 80, 80, true, false);
				$image_alt = atelier_get_post_meta($image_id, '_wp_attachment_image_alt', true);

				if ($detail_image) {
					$image = '<img itemprop="image" src="'.$detail_image[0].'" width="'.$detail_image[1].'" height="'.$detail_image[2].'" alt="'.$image_alt.'" />';
				}

				?>

				<?php if ($image != "") { ?>
				<div id="prev-article-pagination" class="window-arrow-nav prev-item has-img">
				<?php } else { ?>
				<div id="prev-article-pagination" class="window-arrow-nav prev-item">
				<?php } ?>

					<a href="<?php echo esc_url($prev_permalink); ?>">
						<div class="nav-transition">
							<div class="overlay-wrap">
								<?php echo esc_html($atelier_prev_icon); ?>
								<?php if ($image != "") { ?>
								<figure class="pagination-article-image">
									<?php echo esc_html($image); ?>
								</figure>
								<?php } ?>
							</div>
						</div>

						<?php if ($item_subtitle != "") { ?>
						<div class="pagination-article-details has-subtitle">
							<h5><?php echo esc_attr($prev_post->post_title); ?></h5>
							<p><?php echo esc_attr($item_subtitle); ?></p>
						<?php } else { ?>
						<div class="pagination-article-details no-subtitle">
							<h5><?php echo esc_attr($prev_post->post_title); ?></h5>
						<?php } ?>
						</div>
					</a>
				</div>
			<?php }

		 	if (!empty( $next_post )) {

		 		$postID = $next_post->ID;
		 		$next_permalink = get_permalink($postID);
		 		$item_subtitle = atelier_get_post_meta($postID, 'sf_portfolio_subtitle', true);
		 		$use_thumb_content = atelier_get_post_meta($postID, 'sf_thumbnail_content_main_detail', true);

		 		$image = $media_image_url = $image_id = "";

		 		if ($use_thumb_content) {
		 		$media_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full', $postID);
		 		} else {
		 		$media_image = rwmb_meta('sf_detail_image', 'type=image&size=full', $postID);
		 		}

		 		foreach ($media_image as $detail_image) {
		 			$image_id = $detail_image['ID'];
		 			$media_image_url = $detail_image['url'];
		 			break;
		 		}

		 		if (!$media_image) {
		 			$media_image = get_post_thumbnail_id($postID);
		 			$image_id = $media_image;
		 			$media_image_url = wp_get_attachment_url( $media_image, 'full' );
		 		}

		 		$detail_image = atelier_aq_resize($media_image_url, 80, 80, true, false);
		 		$image_alt = atelier_get_post_meta($image_id, '_wp_attachment_image_alt', true);

		 		if ($detail_image) {
		 			$image = '<img itemprop="image" src="'.$detail_image[0].'" width="'.$detail_image[1].'" height="'.$detail_image[2].'" alt="'.$image_alt.'" />';
		 		}

		 		?>

		 		<?php if ($image != "") { ?>
		 		<div id="next-article-pagination" class="window-arrow-nav next-item has-img">
		 		<?php } else { ?>
		 		<div id="next-article-pagination" class="window-arrow-nav next-item">
		 		<?php } ?>

					<a href="<?php echo esc_url($next_permalink); ?>">

						<div class="nav-transition">
							<div class="overlay-wrap">
								<?php echo esc_html($atelier_next_icon); ?>
								<?php if ($image != "") { ?>
								<figure class="pagination-article-image">
								<?php echo esc_html($image); ?>
								</figure>
								<?php } ?>
							</div>
						</div>

						<?php if ($item_subtitle != "") { ?>
						<div class="pagination-article-details has-subtitle">
							<h5><?php echo esc_attr($next_post->post_title); ?></h5>
							<p><?php echo esc_attr($item_subtitle); ?></p>
						<?php } else { ?>
						<div class="pagination-article-details no-subtitle">
							<h5><?php echo esc_attr($next_post->post_title); ?></h5>
						<?php } ?>
						</div>
					</a>
				</div>
		 	<?php }
		}
		add_action('atelier_main_container_start', 'atelier_nextprev_navigation', 50);
	}


	/* GET THUMB TYPE
	================================================== */
	if (!function_exists('atelier_get_thumb_type')) {
		function atelier_get_thumb_type() {
			global $atelier_options;
			$thumbnail_type = "standard";
			if (isset($atelier_options['thumbnail_type'])) {
			$thumbnail_type = $atelier_options['thumbnail_type'];
			}

			if ($thumbnail_type != "") {
				return 'thumbnail-'.$thumbnail_type;
			}

		}
	}


	/*
	*	HEADER WRAP OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-header.php
	*
	================================================== */
	if (!function_exists('atelier_header_wrap')) {
		function atelier_header_wrap($header_layout) {
			global $post, $atelier_options;

			$header_wrap_class = $logo_class = "";
			if ( function_exists( 'atelier_page_classes' ) ) {
				$page_classes = atelier_page_classes();
				$header_layout = $page_classes['header-layout'];
				$header_wrap_class = $page_classes['header-wrap'];
				$logo_class = $page_classes['logo'];
			}

			$page_header_type = "standard";

			if (is_page() && $post) {
				$page_header_type = atelier_get_post_meta($post->ID, 'sf_page_header_type', true);
			} else if (is_singular('post') && $post) {
				$post_header_type = atelier_get_post_meta($post->ID, 'sf_page_header_type', true);
				$fw_media_display = atelier_get_post_meta($post->ID, 'sf_fw_media_display', true);
				$page_title_style = atelier_get_post_meta($post->ID, 'sf_page_title_style', true);
				if ($page_title_style == "fancy" || $fw_media_display == "fw-media-title" || $fw_media_display == "fw-media") {
					$page_header_type = $post_header_type;
				}
			} else if (is_singular('portfolio') && $post) {
				$port_header_type = atelier_get_post_meta($post->ID, 'sf_page_header_type', true);
				$fw_media_display = atelier_get_post_meta($post->ID, 'sf_fw_media_display', true);
				$page_title = atelier_get_post_meta($post->ID, 'sf_page_title', true);
				$page_title_style = atelier_get_post_meta($post->ID, 'sf_page_title_style', true);
				if ($page_title_style == "fancy" || !$page_title) {
					$page_header_type = $port_header_type;
				}
			}

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

			$fullwidth_header = $atelier_options['fullwidth_header'];
			$enable_mini_header = $atelier_options['enable_mini_header'];
			$enable_tb = $atelier_options['enable_tb'];
			$enable_sticky_tb = false;
			if ( isset( $atelier_options['enable_sticky_topbar'] ) ) {
				$enable_sticky_tb = $atelier_options['enable_sticky_topbar'];	
			}
			$header_left_config = $atelier_options['header_left_config'];
			$header_right_config = $atelier_options['header_right_config'];

			if (($page_header_type == "naked-light" || $page_header_type == "naked-dark") && ($header_layout == "header-vert" || $header_layout == "header-vert-right")) {
				$header_layout = "header-4";
				$enable_tb = false;
			}
		?>
			<?php if ( $enable_tb ) { ?>
				<!--// TOP BAR //-->
				<?php echo atelier_top_bar( $enable_sticky_tb ); ?>
			<?php } ?>

			<!--// HEADER //-->
			<div class="header-wrap <?php echo esc_attr($header_wrap_class); ?> page-header-<?php echo esc_attr($page_header_type); ?>">

				<div id="header-section" class="<?php echo esc_attr($header_layout); ?> <?php echo esc_attr($logo_class); ?>">
					<?php if ($enable_mini_header) {
							echo atelier_header($header_layout);
						} else {
							echo '<div class="sticky-wrapper">'.atelier_header($header_layout).'</div>';
						}
					?>
				</div>

				<?php
					// Fullscreen Search
					echo atelier_fullscreen_search();
				?>

				<?php
					// Fullscreen Search
					if (isset($header_left_config) && array_key_exists('supersearch', $header_left_config['enabled']) || isset($header_right_config) && array_key_exists('supersearch', $header_right_config['enabled'])) {
					echo atelier_fullscreen_supersearch();
					}
				?>

				<?php
					// Overlay Menu
					if (isset($header_left_config) && array_key_exists('overlay-menu', $header_left_config['enabled']) || isset($header_right_config) && array_key_exists('overlay-menu', $header_right_config['enabled'])) {
						echo atelier_overlay_menu();
					}
				?>

				<?php
					// Contact Slideout
					if (isset($header_left_config) && array_key_exists('contact', $header_left_config['enabled']) || isset($header_right_config) && array_key_exists('contact', $header_right_config['enabled'])) {
						echo atelier_contact_slideout();
					}
				?>

			</div>

		<?php }
		add_action('atelier_container_start', 'atelier_header_wrap', 20);
	}
	
	if (!function_exists('atelier_top_bar')) {
		function atelier_top_bar( $sticky = false ) {
			global $atelier_options;
			$fullwidth_header = $atelier_options['fullwidth_header'];
	
			$top_bar_class = "";
			if ($sticky) {
				$top_bar_class = "sticky-top-bar";
			}
			?>
	
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
			<?php
		}
	}
	
	
	/*
	*	HEADER MENU OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-header.php
	*
	================================================== */
	if (!function_exists('atelier_main_menu')) {
		function atelier_main_menu($id, $layout = "") {

			// VARIABLES
			global $atelier_options, $post;

			$show_cart = $show_wishlist = false;
			if ( isset($atelier_options['show_cart']) ) {
			$show_cart            = $atelier_options['show_cart'];
			}
			if ( isset($atelier_options['show_wishlist']) ) {
			$show_wishlist            = $atelier_options['show_wishlist'];
			}
			$vertical_header_text = __($atelier_options['vertical_header_text'], 'atelier');
			$page_menu = $menu_output = $menu_full_output = $menu_with_search_output = $menu_float_output = $menu_vert_output = "";

			if ($post) {
			$page_menu = atelier_get_post_meta($post->ID, 'sf_page_menu', true);
			}
			$main_menu_args = array(
				'echo'            => false,
				'theme_location' => 'main_navigation',
				'walker' => new atelier_mega_menu_walker,
				'fallback_cb' => '',
				'menu' => $page_menu
			);


			// MENU OUTPUT
			$menu_output .= '<nav id="'.$id.'" class="std-menu clearfix">'. "\n";

			if(function_exists('wp_nav_menu')) {
				if (has_nav_menu('main_navigation')) {
					$menu_output .= wp_nav_menu( $main_menu_args );
				}
				else {
					$menu_output .= '<div class="no-menu">'.__("Please assign a menu to the Main Menu in Appearance > Menus", 'atelier').'</div>';
				}
			}
			$menu_output .= '</nav>'. "\n";


			// FULL WIDTH MENU OUTPUT
			if ($layout == "full") {

				$menu_full_output .= '<div class="container">'. "\n";
				$menu_full_output .= '<div class="row">'. "\n";
				$menu_full_output .= '<div class="menu-left">'. "\n";
				$menu_full_output .= $menu_output . "\n";
				$menu_full_output .= '</div>'. "\n";
				$menu_full_output .= '<div class="menu-right">'. "\n";
				$menu_full_output .= atelier_header_aux('right'). "\n";
				$menu_full_output .= '</div>'. "\n";
				$menu_full_output .= '</div>'. "\n";
				$menu_full_output .= '</div>'. "\n";

				$menu_output = $menu_full_output;

			} else if ($layout == "float" || $layout == "float-2") {

				$menu_float_output .= '<div class="float-menu container">'. "\n";
				$menu_float_output .= $menu_output . "\n";
				$menu_float_output .= '</div>'. "\n";

				$menu_output = $menu_float_output;

			} else if ($layout == "vertical") {

				$menu_vert_output .= $menu_output . "\n";
				$menu_vert_output .= '<div class="vertical-menu-bottom">'. "\n";
				$menu_vert_output .= atelier_header_aux('right');
				$menu_vert_output .= '<div class="copyright">'.do_shortcode(stripslashes($vertical_header_text)).'</div>'. "\n";
				$menu_vert_output .= '</div>'. "\n";

				$menu_output = $menu_vert_output;
			}

			// MENU RETURN
			return $menu_output;
		}
	}


	/*
	*	HEADER SEARCH OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-header.php
	*
	================================================== */
	if (!function_exists('atelier_get_search')) {
		function atelier_get_search($type) {

			if ($type == "search-off") {
				return;
			}

			global $atelier_options;
			$header_search_type = $atelier_options['header_search_type'];
			$header_search_pt = $atelier_options['header_search_pt'];
			$ajax_url = admin_url('admin-ajax.php');

			if ($type == "aux") {
				$type = $header_search_type;
			}

			$search_output = "";

			if ($type == "fs-search-on") {
				$search_output .= '<li class="menu-search parent"><a href="#" class="header-search-link fs-header-search-link"><i class="sf-icon-search"></i></a></li>'. "\n";
			} else if ($type == "search-on-noajax") {
				$search_output .= '<li class="menu-search parent"><a href="#" class="header-search-link header-search-link-alt header-search-link-noajax"><i class="sf-icon-search"></i></a>'. "\n";
				$search_output .= '<div class="ajax-search-wrap search-wrap" data-ajaxurl=""><form method="get" class="ajax-search-form noajax" action="'.home_url().'/">';
				if ($header_search_pt != "any") {
				$search_output .= '<input type="hidden" name="post_type" value="'.$header_search_pt.'" />';
				}
				$search_output .= '<input type="text" placeholder="'.__("Search", 'atelier').'" name="s" autocomplete="off" class="noajax" /></form></div>'. "\n";
				$search_output .= '</li>'. "\n";
			} else {
				$search_output .= '<li class="menu-search parent"><a href="#" class="header-search-link header-search-link-alt"><i class="sf-icon-search"></i></a>'. "\n";
				$search_output .= '<div class="ajax-search-wrap search-wrap" data-ajaxurl="'.$ajax_url.'"><div class="ajax-loading"></div><form method="get" class="ajax-search-form" action="'.home_url().'/">';
				if ($header_search_pt != "any") {
				$search_output .= '<input type="hidden" name="post_type" value="'.$header_search_pt.'" />';
				}
				$search_output .= '<input type="text" placeholder="'.__("Search", 'atelier').'" name="s" autocomplete="off" /></form><div class="ajax-search-results"></div></div>'. "\n";
				$search_output .= '</li>'. "\n";
			}

			return $search_output;
		}
	}


	/*
	*	HEADER AUX OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-header.php
	*
	================================================== */
	if (!function_exists('atelier_header_aux')) {
		function atelier_header_aux($aux) {

			global $atelier_options;

			$config = array();
			$aux_output = "";

			$header_left_text = __($atelier_options['header_left_text'], 'atelier');
			$header_right_text = __($atelier_options['header_right_text'], 'atelier');
			
			$contact_icon = apply_filters('atelier_header_contact_icon', '<i class="ss-mail"></i>');
			$supersearch_icon = apply_filters('atelier_header_supersearch_icon', '<i class="ss-zoomin"></i>');
			$ajax_url = admin_url('admin-ajax.php');

			if ($aux == "left") {
				$config = $atelier_options['header_left_config'];
			} else if ($aux == "right") {
				$config = $atelier_options['header_right_config'];
			}

			if (!empty($config) && isset($config['enabled'])) {

				foreach ($config['enabled'] as $item_id => $item) {

					if ($item_id == "social") {
						$aux_output .= '<div class="aux-item aux-item-social">' . do_shortcode('[social]'). '</div>'. "\n";
					} else if ($item_id == "aux-links") {
						$aux_output .= '<div class="aux-item">' . atelier_aux_links('header-menu', TRUE, "header-1") . '</div>'. "\n";
					} else if ($item_id == "cart-wishlist") {
						$aux_output .= '<div class="aux-item aux-cart-wishlist"><nav class="std-menu cart-wishlist"><ul class="menu">'. "\n";
						$aux_output .= atelier_get_cart();
						$aux_output .= atelier_get_wishlist();
						$aux_output .= '</ul></nav></div>'. "\n";
					} else if ($item_id == "supersearch") {
						$aux_output .= '<div class="aux-item aux-supersearch"><a href="#" class="fs-supersearch-link">'.$supersearch_icon.'<span>'.__("Super Search", 'atelier').'</span></a></div>'. "\n";
					} else if ($item_id == "overlay-menu") {
						$aux_output .= '<div class="aux-item aux-overlay-menu"><a href="#" class="overlay-menu-link menu-bars-link"><span>'.__("Menu", 'atelier').'</span></a></div>'. "\n";
					} else if ($item_id == "side-slideout" && $aux == "left") {
						$aux_output .= '<div class="aux-item"><a href="#" class="side-slideout-link menu-bars-link" data-side="left"><span>'.__("Menu", 'atelier').'</span></a></div>'. "\n";
					} else if ($item_id == "side-slideout" && $aux == "right") {
						$aux_output .= '<div class="aux-item"><a href="#" class="side-slideout-link menu-bars-link" data-side="right"><span>'.__("Menu", 'atelier').'</span></a></div>'. "\n";
					} else if ($item_id == "contact") {
						$aux_output .= '<div class="aux-item"><a href="#" class="contact-menu-link">'.$contact_icon.'</a></div>'. "\n";
					} else if ($item_id == "search") {
						$aux_output .= '<div class="aux-item aux-search"><nav class="std-menu">'. "\n";
						$aux_output .= '<ul class="menu">'. "\n";
						$aux_output .= atelier_get_search('aux');
						$aux_output .= '</ul>'. "\n";
						$aux_output .= '</nav></div>'. "\n";
					} else if ($item_id == "account") {
						$aux_output .= '<div class="aux-item aux-account">'. "\n";
						$aux_output .= atelier_get_account('aux');
						$aux_output .= '</div>'. "\n";
					} else if ($item_id == "currency-switcher") {
						$aux_output .= '<div class="aux-item aux-currency"><nav class="std-menu currency"><ul class="menu">'. "\n";
						$aux_output .= atelier_get_currency_switcher();
						$aux_output .= '</ul></nav></div>'. "\n";
					} else if ($item_id == "language") {
						$aux_output .= '<div class="aux-item aux-language">'. "\n";
						$aux_output .= '<nav class="std-menu">' . "\n";
						$aux_output .= '<ul class="menu">' . "\n";
						$aux_output .= '<li class="parent aux-languages"><a href="#">' . __( "Language", 'atelier' ) . '</a>' . "\n";
						$aux_output .= '<ul class="header-languages sub-menu">' . "\n";
						if ( function_exists( 'atelier_language_flags' ) ) {
						$aux_output .= atelier_language_flags();
						}
						$aux_output .= '</ul>' . "\n";
						$aux_output .= '</li>' . "\n";
						$aux_output .= '</ul>' . "\n";
						$aux_output .= '</nav>' . "\n";
						$aux_output .= '</div>'. "\n";
					} else if ($item_id == "text" && $aux == "left") {
						$aux_output .= '<div class="aux-item text">'.do_shortcode($header_left_text).'</div>'. "\n";
					} else if ($item_id == "text" && $aux == "right") {
						$aux_output .= '<div class="aux-item text">'.do_shortcode($header_right_text).'</div>'. "\n";
					}

				}

			}

			return $aux_output;
		}
	}


	/*
	*	AJAX SEARCH OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-header.php
	*
	================================================== */
	if (!function_exists('atelier_ajaxsearch')) {
		function atelier_ajaxsearch() {
			atelier_get_template_part('search-results');
            die();
		}
		add_action('wp_ajax_atelier_ajaxsearch', 'atelier_ajaxsearch');
		add_action('wp_ajax_nopriv_atelier_ajaxsearch', 'atelier_ajaxsearch');
	}

	/*
	*	OVERLAY MENU OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/core/sf-header.php
	*
	================================================== */
    if ( ! function_exists( 'atelier_overlay_menu' ) ) {
        function atelier_overlay_menu() {

            global $post;

            $overlayMenu = $page_menu = "";

            if ( $post && !is_search() ) {
                $page_menu = atelier_get_post_meta($post->ID, 'sf_page_menu', true );
            }

            $fs_close_icon = apply_filters( 'atelier_fullscreen_close_icon', '<i class="ss-delete"></i>' );
            $overlay_menu_args = array(
                'echo'           => false,
                'theme_location' => 'overlay_menu',
                'fallback_cb'    => '',
                'menu'			 => $page_menu
            );

            $overlayMenu .= '<div id="overlay-menu">';
            $overlayMenu .= '<a href="#" class="fs-overlay-close">';
            $overlayMenu .= $fs_close_icon;
            $overlayMenu .= '</a>';
            $overlayMenu .= '<nav>';
            if ( function_exists( 'wp_nav_menu' ) ) {
                $overlayMenu .= wp_nav_menu( $overlay_menu_args );
            }
            $overlayMenu .= '</nav>';
            $overlayMenu .= '</div>';


            return $overlayMenu;
        }
    }


    /*
	*	MOBILE MENU OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/content/sf-header.php
	*
	================================================== */
    if ( ! function_exists( 'atelier_mobile_menu' ) ) {
        function atelier_mobile_menu() {
        	atelier_get_template_part('mobile-menu');
        }

        add_action( 'atelier_before_page_container', 'atelier_mobile_menu', 10 );
    }


	/*
	*	GET POST DETAILS OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/content/sf-post-formats.php
	*
	================================================== */
	if ( ! function_exists( 'atelier_get_post_details' ) ) {
	    function atelier_get_post_details( $postID, $recent_post = false ) {

	    	global $atelier_options;
	    	$single_author = $atelier_options['single_author'];

	   		$post_details = $comments = "";
	    	$post_author  = get_the_author();
	    	$num_comments = get_comments_number();
			if ( $num_comments == 0 ) {
				$comments = __('No Comments', 'atelier');
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments . __(' Comments', 'atelier');
			} else {
				$comments = __('1 Comment', 'atelier');
			}

	    	if ( !$single_author && comments_open() ) {
	    	    $post_details .= '<div class="blog-item-details"><span class="author">' . sprintf( __( 'By <a href="%2$s" rel="author" itemprop="author">%1$s</a>', 'atelier' ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '</span>';
	    	    if ( $recent_post ) {
	    	    $post_details .= ' / <span>'. $comments .'</span>';
	    	    }
	    	    $post_details .= '</div>';
	    	} else if ( $single_author && comments_open() ) {
	    	    $post_details .= '<div class="blog-item-details"><span>'. $comments .'</span></div>';
	    	} else {
	    	    $post_details .= '<div class="blog-item-details"><span class="author">' . sprintf( __( 'By <a href="%2$s" rel="author" itemprop="author">%1$s</a>', 'atelier' ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '</span></div>';
	    	}

	    	return $post_details;
	    }
	}
	
	/*
	*	GET MASONRY POST OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/content/sf-post-formats.php
	*
	================================================== */
	if ( ! function_exists( 'atelier_get_masonry_post' ) ) {
		function atelier_get_masonry_post( $postID, $thumb_type, $fullwidth, $show_title, $show_excerpt, $show_details, $show_read_more, $content_output, $excerpt_length ) {
			
			global $atelier_options;
			
			// Get Post Object
			$post_object = atelier_build_post_object( $postID , $content_output, $excerpt_length );
			
			// Link config			
		    $post_links_match_thumb = false;
		    if ( isset( $atelier_options['post_links_match_thumb'] ) ) {
		    	$post_links_match_thumb = $atelier_options['post_links_match_thumb'];	
		    }
		
		    $post_permalink_config = 'href="' . $post_object['permalink'] . '" class="link-to-post"';
		    if ( $post_links_match_thumb ) {
		    	$link_config = atelier_post_item_link();
		    	$post_permalink_config = $link_config['config'];
		    }
		    
			// Variable setup
			$post_item = "";			
			
			// THUMBNAIL MEDIA TYPE SETUP
			$post_item .= apply_filters( 'atelier_before_masonry_post_thumb' , '');
			
			$item_figure = "";
			if ( $thumb_type != "none" ) {
			    $item_figure .= atelier_post_thumbnail( "masonry", $fullwidth );
			}
		    if ( $item_figure != "" ) {
		        $post_item .= $item_figure;
		    }
		
			// Start Output
		    $post_item .= '<div class="details-wrap">';
		    $post_item .= '<a ' . $post_permalink_config . '></a>';
			
			// Title
		    if ( $post_object['type'] == "post" ) {
		        if ( $post_object['format'] == "standard" ) {
		            $post_item .= '<h6>' . __( "Article", 'atelier' ) . '</h6>';
		        } else {
		            $post_item .= '<h6>' . $post_object['format'] . '</h6>';
		        }
		    } else {
		        $post_item .= '<h6>' . $post_object['type'] . '</h6>';
		    }
		    if ( $show_title == "yes" && $post_object['format'] != "quote" && $post_object['format'] != "link" ) {
		        $post_item .= '<h2 itemprop="name headline">' . $post_object['title'] . '</h2>';
		    } else if ( $post_object['format'] == "quote" ) {
		        $post_item .= '<div class="quote-excerpt" itemprop="name headline">' . $post_object['excerpt'] . '</div>';
		    } else if ( $post_object['format'] == "link" ) {
		        $post_item .= '<h3 itemprop="name headline">' . $post_object['title'] . '</h3>';
		    }
		
				
			// Details		
	        if ( $show_details == "yes" ) {
	        	$post_item .= atelier_get_post_details($postID);
			}
			
			// Excerpt
	    	if ( $show_excerpt == "yes" && $post_object['format'] != "quote" ) {
	            $post_item .= '<div class="excerpt" itemprop="description">' . $post_object['excerpt'] . '</div>';
	        }
	
			// Read More
			if ( $show_read_more == "yes" ) {
			    if ( $post_object['download_button'] ) {
			        if ( $post_object['download_shortcode'] != "" ) {
			            $post_item .= do_shortcode( $post_object['download_shortcode'] );
			        } else {
			            $post_item .= '<a href="' . wp_get_attachment_url( $post_object['download_file'] ) . '" class="download-button read-more-button">' . $post_object['download_text'] . '</a>';
			        }
			    }
			    $post_item .= '<a class="read-more-button" href="' . $post_object['permalink'] . '">' . __( "Read more", 'atelier' ) . '</a>';
			}
			
			// Comments / Likes
	        if ( $show_details == "yes" ) {
	            $post_item .= '<div class="comments-likes">';
	            if ( comments_open() ) {
	                $post_item .= '<div class="comments-wrapper"><a href="' . $post_object['permalink'] . '#comment-area">
	                <svg version="1.1" class="comments-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	                	 width="30px" height="30px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
	                <path fill="none" class="stroke" stroke="#252525" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
	                	M13.958,24H2.021C1.458,24,1,23.541,1,22.975V2.025C1,1.459,1.458,1,2.021,1h25.957C28.542,1,29,1.459,29,2.025v20.949
	                	C29,23.541,28.542,24,27.979,24H21v5L13.958,24z"/>
	                </svg>
	                <span>' . $post_object['comments'] . '</span></a></div>';
	            }
	
	            if ( function_exists( 'lip_love_it_link' ) ) {
	                $post_item .= lip_love_it_link( $postID, false );
	            }
	            $post_item .= '</div>';
	        }
				
			// Close Output
		    $post_item .= '</div>';
			
			// Return 
			return $post_item;
		}
    }
    

	/*
	*	PRODUCT META OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/sf-woocommerce.php
	*
	================================================== */
	if ( ! function_exists( 'atelier_product_meta' ) ) {
		function atelier_product_meta() {
			return;
		}
	}


	/*
	*	PRODUCT SHARE OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/sf-woocommerce.php
	*
	================================================== */
    if ( ! function_exists( 'atelier_product_share' ) ) {
        function atelier_product_share() {
            global $post;
            $image = wp_get_attachment_url( get_post_thumbnail_id() );
            $page_permalink = urlencode(get_the_permalink());
            $page_title = esc_url( get_the_title() );
            $page_thumb_id = get_post_thumbnail_id();
            $page_thumb_url = wp_get_attachment_url( $page_thumb_id );
            $icon_prefix = 'fab ';

            echo '<div class="sf-share-counts">';         
            echo '<h3 class="share-text">'.__("Share", 'swift-framework-plugin').'</h3>';
            echo '<a href="https://www.facebook.com/sharer/sharer.php?u='.$page_permalink.'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=440,width=660\');return false;" class="sf-share-link sf-share-fb"><i class="' . $icon_prefix . 'fa-facebook"></i><span class="count">0</span></a>';
            echo '<a href="http://twitter.com/share?text='.$page_title.'&url='.$page_permalink.'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=440,width=660\');return false;" class="sf-share-link sf-share-twit"><i class="' . $icon_prefix . 'fa-twitter"></i><span class="count">0</span></a>';
            echo '<a href="http://pinterest.com/pin/create/button/?url='.$page_permalink.'&media='.$page_thumb_url.'&description='.$page_title.'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=690,width=750\');return false;" class="sf-share-link sf-share-pin"><i class="' . $icon_prefix . 'fa-pinterest"></i><span class="count">0</span></a>';
            echo '</div>';
        }

        add_action( 'woocommerce_single_product_summary', 'atelier_product_share', 45 );
    }


    /*
	*	WOO HELP BAR OVERRIDE
	*	------------------------------------------------
	*	@original - /swift-framework/sf-woocommerce.php
	*
	================================================== */
    if ( ! function_exists( 'atelier_woocommercehelp_bar' ) ) {
        function atelier_woocommercehelp_bar() {
            global $atelier_options;
            
            $disable_help_bar = false;
            
            if ( isset( $atelier_options['disable_help_bar'] ) ) {
			$disable_help_bar = $atelier_options['disable_help_bar'];
			}
            $help_bar_text  = __( $atelier_options['help_bar_text'], 'atelier' );
            $email_modal_title    = __( $atelier_options['email_modal_title'], 'atelier' );
            $email_modal    = __( $atelier_options['email_modal'], 'atelier' );
            $shipping_modal_title = __( $atelier_options['shipping_modal_title'], 'atelier' );
            $shipping_modal = __( $atelier_options['shipping_modal'], 'atelier' );
            $returns_modal_title  = __( $atelier_options['returns_modal_title'], 'atelier' );
            $returns_modal  = __( $atelier_options['returns_modal'], 'atelier' );
            $faqs_modal_title     = __( $atelier_options['faqs_modal_title'], 'atelier' );
            $faqs_modal     = __( $atelier_options['faqs_modal'], 'atelier' );
            ?>
            <?php if ( !$disable_help_bar ) { ?>
	            <div class="help-bar clearfix">
	                <span><?php echo do_shortcode( $help_bar_text ); ?></span>
	                <ul>
	                    <?php if ( $email_modal_title != "" ) { ?>
	                        <li><a href="#email-form" class="inline"
	                               data-toggle="modal"><?php echo esc_attr($email_modal_title); ?></a></li>
	                    <?php } ?>
	                    <?php if ( $shipping_modal_title != "" ) { ?>
	                        <li><a href="#shipping-information" class="inline"
	                               data-toggle="modal"><?php echo esc_attr($shipping_modal_title); ?></a></li>
	                    <?php } ?>
	                    <?php if ( $returns_modal_title != "" ) { ?>
	                        <li><a href="#returns-exchange" class="inline"
	                               data-toggle="modal"><?php echo esc_attr($returns_modal_title); ?></a></li>
	                    <?php } ?>
	                    <?php if ( $faqs_modal_title != "" ) { ?>
	                        <li><a href="#faqs" class="inline"
	                               data-toggle="modal"><?php echo esc_attr($faqs_modal_title); ?></a></li>
	                    <?php } ?>
	                </ul>
	            </div>

	            <?php if ( $email_modal_title != "" ) { ?>
	                <div id="email-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="email-form-modal"
	                     aria-hidden="true">
	                    <div class="modal-dialog">
	                        <div class="modal-content">
	                            <div class="modal-header">
	                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo apply_filters( 'atelier_close_icon', '<i class="ss-delete"></i>' ); ?></button>
	                                <h3 id="email-form-modal"><?php echo esc_attr($email_modal_title); ?></h3>
	                            </div>
	                            <div class="modal-body">
	                                <?php echo do_shortcode( $email_modal ); ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            <?php } ?>

	            <?php if ( $shipping_modal_title != "" ) { ?>
	                <div id="shipping-information" class="modal fade" tabindex="-1" role="dialog"
	                     aria-labelledby="shipping-modal" aria-hidden="true">
	                    <div class="modal-dialog">
	                        <div class="modal-content">
	                            <div class="modal-header">
	                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo apply_filters( 'atelier_close_icon', '<i class="ss-delete"></i>' ); ?></button>
	                                <h3 id="shipping-modal"><?php echo esc_attr($shipping_modal_title); ?></h3>
	                            </div>
	                            <div class="modal-body">
	                                <?php echo do_shortcode( $shipping_modal ); ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            <?php } ?>

	            <?php if ( $returns_modal_title != "" ) { ?>
	                <div id="returns-exchange" class="modal fade" tabindex="-1" role="dialog"
	                     aria-labelledby="returns-modal" aria-hidden="true">
	                    <div class="modal-dialog">
	                        <div class="modal-content">
	                            <div class="modal-header">
	                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo apply_filters( 'atelier_close_icon', '<i class="ss-delete"></i>' ); ?></button>
	                                <h3 id="returns-modal"><?php echo esc_attr($returns_modal_title); ?></h3>
	                            </div>
	                            <div class="modal-body">
	                                <?php echo do_shortcode( $returns_modal ); ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            <?php } ?>

	            <?php if ( $faqs_modal_title != "" ) { ?>
	                <div id="faqs" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="faqs-modal"
	                     aria-hidden="true">
	                    <div class="modal-dialog">
	                        <div class="modal-content">
	                            <div class="modal-header">
	                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo apply_filters( 'atelier_close_icon', '<i class="ss-delete"></i>' ); ?></button>
	                                <h3 id="faqs-modal"><?php echo esc_attr($faqs_modal_title); ?></h3>
	                            </div>
	                            <div class="modal-body">
	                                <?php echo do_shortcode( $faqs_modal ); ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            <?php } ?>
			<?php } ?>
        <?php
        }
        add_action( 'woocommerce_before_account_navigation', 'atelier_woocommercehelp_bar' );
    }


    /*
    *	POST INFO OVERRIDE
    *	------------------------------------------------
    *	@original - /swift-framework/content/sf-post-detail.php
    *
    ================================================== */
    if ( ! function_exists( 'atelier_post_top_author' ) ) {
        function atelier_post_top_author() {
            global $post, $atelier_options;
            $author_info 	 = atelier_get_post_meta($post->ID, 'sf_author_info', true );
            $fw_media_display = atelier_get_post_meta($post->ID, 'sf_fw_media_display', true );
			$post_date       = get_the_date();
			$single_author    = $atelier_options['single_author'];
			$remove_dates     = $atelier_options['remove_dates'];
			$author_id       = $post->post_author;
			$author_name     = get_the_author_meta( 'display_name', $author_id );
			$author_url      = get_author_posts_url( $author_id );
			$post_date       = get_the_date();
			$post_date_str  = get_the_date('Y-m-d');

            if ( is_singular( 'directory' ) ) {
                $author_info = false;
            }

            $post_categories = get_the_category_list( ', ' );
            ?>

            <?php if ( $author_info && $fw_media_display != "fw-media-title" ) { ?>
                <div class="top-author-info container clearfix">
                    <div class="author-avatar"><?php if ( function_exists( 'get_avatar' ) ) {
                            echo get_avatar( get_the_author_meta( 'ID' ), '140' );
                        } ?></div>
                    <div class="post-details">
                        <div class="author-name" itemprop="author" itemscope itemtype="http://schema.org/Person">
                        	<h5 class="vcard author"><?php echo sprintf( __( 'By <a href="%2$s" rel="author" class="fn"><span itemprop="name">%1$s</span></a>', 'atelier' ), $author_name, $author_url ); ?></h5>
                        </div>
                        <?php if ( !$remove_dates ) { ?>
                        	<?php echo sprintf( __( '<time datetime="%1$s">%2$s</time>', 'atelier' ), $post_date_str, $post_date ); ?>
                        <?php } ?>
                        <span class="categories"><?php echo sprintf( __( 'In %1$s', 'atelier' ), $post_categories ); ?></span>
                    </div>
                </div>
            <?php } ?>

        <?php
        }
    }
    add_action( 'atelier_post_content_start', 'atelier_post_top_author', 5 );


    /*
    *	POST INFO OVERRIDE
    *	------------------------------------------------
    *	@original - /swift-framework/content/sf-post-detail.php
    *
    ================================================== */
    if ( ! function_exists( 'atelier_post_info' ) ) {
        function atelier_post_info() {
            global $post, $atelier_options;
            $author_info 	 = atelier_get_post_meta($post->ID, 'sf_author_info', true );
            $social_sharing  = atelier_get_post_meta($post->ID, 'sf_social_sharing', true );
			$post_date       = get_the_date();
			$remove_dates    = $atelier_options['remove_dates'];
			$author_id       = $post->post_author;
			$author_name     = get_the_author_meta( 'display_name', $author_id );
			$author_url      = get_author_posts_url( $author_id );
			$post_permalink  = get_permalink();

            if ( is_singular( 'directory' ) ) {
                $author_info = true;
            }

            $post_categories = get_the_category_list( ', ' );
            ?>

            <?php if ( $author_info ) { ?>
                <div class="post-info clearfix">
            <?php } else { ?>
                <div class="post-info post-info-fw clearfix">
            <?php } ?>

                <?php if ( $author_info ) { ?>
                    <div class="author-info-wrap clearfix">
                        <div class="author-avatar"><?php if ( function_exists( 'get_avatar' ) ) {
                                echo get_avatar( get_the_author_meta( 'ID' ), '140' );
                            } ?></div>
                        <div class="author-bio">
                            <div class="author-name" itemprop="author" itemscope itemtype="http://schema.org/Person"><h3
                                    class="vcard author"><span itemprop="name" class="fn"><?php echo esc_attr($author_name); ?></span>
                                </h3></div>
                            <div class="author-bio-text">
                            	<?php the_author_meta( 'description' ); ?>
                            	<?php echo sprintf( __( '<a href="%2$s" class="author-more-link">More by %1$s <i class="fas fa-long-arrow-alt-right"></i></a>', 'atelier' ), $author_name, $author_url ); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="post-details-wrap">
					
					<?php if ( $social_sharing ) { 
			            $image = wp_get_attachment_url( get_post_thumbnail_id() );
			            $page_permalink = urlencode(get_the_permalink());
			            $page_title = get_the_title();
			            $page_thumb_id = get_post_thumbnail_id();
			            $page_thumb_url = wp_get_attachment_url( $page_thumb_id );
			            $icon_prefix = 'fab ';

			            echo '<div class="sf-share-counts">';         
			            echo '<h3 class="share-text">'.__("Share", 'swift-framework-plugin').'</h3>';
			            echo '<a href="https://www.facebook.com/sharer/sharer.php?u='.$page_permalink.'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=440,width=660\');return false;" class="sf-share-link sf-share-fb"><i class="' . $icon_prefix . 'fa-facebook"></i><span class="count">0</span></a>';
			            echo '<a href="http://twitter.com/share?text='.$page_title.'&url='.$page_permalink.'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=440,width=660\');return false;" class="sf-share-link sf-share-twit"><i class="' . $icon_prefix . 'fa-twitter"></i><span class="count">0</span></a>';
			            echo '<a href="http://pinterest.com/pin/create/button/?url='.$page_permalink.'&media='.$page_thumb_url.'&description='.$page_title.'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=690,width=750\');return false;" class="sf-share-link sf-share-pin"><i class="' . $icon_prefix . 'fa-pinterest"></i><span class="count">0</span></a>';
			            echo '</div>';
					} ?>
					
		        	<?php if ( has_tag() ) { ?>
		                <div class="tags-wrap">
		                	<span class="tags-title"><?php _e( "Tags", 'atelier' ); ?></span>
		                	<ul class="wp-tag-cloud"><?php the_tags( '<li>', '</li><li>', '</li>' ); ?></ul>
		                </div>
		            <?php } ?>

					<div class="comments-likes">
	                	<?php if ( comments_open() ) { ?>
	                        <div class="comments-wrapper">
		                        <a href="#comment-area" class="smooth-scroll-link">
			                        <svg version="1.1" class="comments-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			                        	 width="30px" height="30px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
			                        <path fill="none" class="stroke" stroke="#252525" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
			                        	M13.958,24H2.021C1.458,24,1,23.541,1,22.975V2.025C1,1.459,1.458,1,2.021,1h25.957C28.542,1,29,1.459,29,2.025v20.949
			                        	C29,23.541,28.542,24,27.979,24H21v5L13.958,24z"/>
			                        </svg>
			                        <span><?php echo get_comments_number(); ?></span>
		                        </a>
	                        </div>
	                    <?php } ?>

	                    <?php if ( function_exists( 'lip_love_it_link' ) ) {
		                    lip_love_it_link( get_the_ID(), true, 'text' );
		                } ?>
	                </div>

		        </div>

			</div>
        <?php
        }
    }
    add_action( 'atelier_post_content_end', 'atelier_post_info', 40 );


    /*
    *	POST PAGINATION OVERRIDE
    *	------------------------------------------------
    *	@original - /swift-framework/content/sf-post-detail.php
    *
    ================================================== */
    if ( ! function_exists( 'atelier_post_pagination' ) ) {
    	function atelier_post_pagination() {
    	    global $post, $atelier_options, $atelier_sidebar_config;

    		$blog_page   	  = __( $atelier_options['blog_page'], 'atelier' );
			$blog_page = apply_filters('wpml_object_id', $blog_page, 'page', true);
			$single_author    = $atelier_options['single_author'];
    	    $remove_dates     = $atelier_options['remove_dates'];
    	    $enable_category_navigation = $atelier_options['enable_category_navigation'];
    	    $pagination_style = "standard";
    	    if ( isset( $atelier_options['pagination_style'] ) ) {
    	        $pagination_style = $atelier_options['pagination_style'];
    	    }
    	    $remove_next_prev  = atelier_get_post_meta($post->ID, 'sf_remove_next_prev', true );
			
			if ( $remove_next_prev ) {
				return;
			}
			
			$taxonomy = "category";
			
			if ( is_singular('portfolio') ) {
				$taxonomy = "portfolio-category";
			} else if ( is_singular('product') ) {
				$taxonomy = "product_cat";
			}
			
    	    $prev_post = get_next_post($enable_category_navigation, '', $taxonomy);
    	    $next_post = get_previous_post($enable_category_navigation, '', $taxonomy);
    	    $has_both  = false;

    	    if ( ! empty( $next_post ) && ! empty( $prev_post ) ) {
    	        $has_both = true;
    	    }
    	    ?>

    	    <?php if ( ! empty( $next_post ) || ! empty( $prev_post )) { ?>
			    <?php if ($has_both) { ?>
			    <div class="post-pagination prev-next clearfix">
			    <?php } else { ?>
			    <div class="post-pagination clearfix">
			        <?php } ?>

					<?php if ( ! empty( $prev_post ) ) {
					    $author_id       = $prev_post->post_author;
					    $author_name     = get_the_author_meta( 'display_name', $author_id );
					    $author_url      = get_author_posts_url( $author_id );
					    $post_date       = get_the_date();
					    $post_date_str  = get_the_date('Y-m-d');
					    $post_categories = get_the_category_list( ', ', '', $prev_post->ID );
					    ?>
					    <a class="prev-article col-sm-4" href="<?php echo get_permalink( $prev_post->ID ); ?>">
					        <h4><?php _e( "Newer", 'atelier' ); ?></h4>
					        <h3><?php echo esc_attr($prev_post->post_title); ?></h3>
					    </a>
					<?php } else { ?>
						<div class="pagination-spacer col-sm-4"></div>
					<?php } ?>

					<?php if ( $blog_page != "" ) { ?>
						<div class="blog-button col-sm-4">
					        <a class="sf-button medium rounded black bordered" href="<?php echo get_permalink( $blog_page ); ?>">
					        	<span class="text"><?php _e( "View all posts", 'atelier' ); ?></span>
					        </a>
					    </div>
					<?php } ?>

					<?php if ( ! empty( $next_post ) ) {
					    $author_id       = $next_post->post_author;
					    $author_name     = get_the_author_meta( 'display_name', $author_id );
					    $author_url      = get_author_posts_url( $author_id );
					    $post_date       = get_the_date();
					    $post_date_str   = get_the_date('Y-m-d');
					    $post_categories = get_the_category_list( ', ', '', $next_post->ID );
					    ?>
					    <a class="next-article col-sm-4" href="<?php echo get_permalink( $next_post->ID ); ?>">
					        <h4><?php _e( "Older", 'atelier' ); ?></h4>
					        <h3><?php echo esc_attr($next_post->post_title); ?></h3>
					    </a>
					<?php } ?>

			    </div>
    	    <?php } ?>

    	<?php
    	}
    	add_action( 'atelier_post_content_end', 'atelier_post_pagination', 50 );
    }
?>
