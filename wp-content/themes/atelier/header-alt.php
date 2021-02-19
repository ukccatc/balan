<!DOCTYPE html>

<!--// OPEN HTML //-->
<html <?php language_attributes(); ?>>

	<!--// OPEN HEAD //-->
	<head>
		
		<!-- Manually set render engine for Internet Explorer, prevent any plugin overrides -->
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE10">
		
		<?php
	        $page_class = "";

			if ( function_exists( 'atelier_page_classes' ) ) {
				$page_classes = atelier_page_classes();
				$page_class = $page_classes['page'];
			}

	        global $post, $atelier_options;
	        $extra_page_class = $page_header_type = "";
	        $page_layout      = $atelier_options['page_layout'];
	        $header_layout    = $atelier_options['header_layout'];
	        if ( isset( $_GET['layout'] ) ) {
	            $page_layout = $_GET['layout'];
	        }
	        if ( $post && !( is_archive() || is_category() ) ) {
	            $extra_page_class = atelier_get_post_meta($post->ID, 'sf_extra_page_class', true );
	        }
	        if ( is_page() && $post ) {
	            $page_header_type = atelier_get_post_meta($post->ID, 'sf_page_header_type', true );
	        }
			if ( $page_header_type == "below-slider" && $page_layout == "boxed" ) {
				add_action( 'atelier_before_page_container', 'atelier_pageslider', 20 );
	        } else if ( $page_header_type == "below-slider" && ( $header_layout != "header-vert" || $header_layout != "header-vert-right" ) ) {
	            add_action( 'atelier_container_start', 'atelier_pageslider', 5 );
	        } else {
	            add_action( 'atelier_container_start', 'atelier_pageslider', 30 );
	        }

	        if ( $page_header_type == "naked-light" || $page_header_type == "naked-dark" ) {
	            remove_action( 'atelier_main_container_start', 'atelier_breadcrumbs', 20 );
	        }

			// Remove Header
			remove_action('atelier_before_page_container', 'atelier_mobile_menu', 10);
			remove_action('atelier_before_page_container', 'atelier_mobile_cart', 20);
			remove_action('atelier_container_start', 'atelier_mobile_header', 10);
			remove_action('atelier_container_start', 'atelier_header_wrap', 20);
			remove_action( 'atelier_container_start', 'atelier_header_banner_bar', 30 );
		?>

		<?php wp_head(); ?>

	<!--// CLOSE HEAD //-->
	</head>

	<!--// OPEN BODY //-->
	<body <?php body_class($page_class.' '.$extra_page_class); ?>>

		<?php
			/**
			 * @hooked - atelier_site_loading - 0
			 * @hooked - atelier_mobile_menu - 10
			 * @hooked - atelier_mobile_cart - 20
			 * @hooked - atelier_pageslider - 30 (if above header)
			**/
			do_action('atelier_before_page_container');
		?>

		<!--// OPEN #container //-->
		<div id="container">

			<?php
				/**
				 * @hooked - atelier_mobile_header - 10
				 * @hooked - atelier_header_wrap - 20
				**/
				do_action('atelier_container_start');
			?>

			<!--// OPEN #main-container //-->
			<div id="main-container" class="clearfix">

				<?php
					/**
					 * @hooked - atelier_pageslider - 10 (if standard)
					 * @hooked - atelier_breadcrumbs - 20
					 * @hooked - atelier_page_heading - 30
					**/
					do_action('atelier_main_container_start');
				?>