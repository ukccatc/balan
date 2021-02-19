<?php

	/*
	*
	*	Theme Customizer Options
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*	atelier_customize_register()
	*	atelier_customize_preview()
	*
	*/

	if (!function_exists('atelier_customize_register')) {
		function atelier_customize_register($wp_customize) {

			$wp_customize->get_setting('blogname')->transport='postMessage';
			$wp_customize->get_setting('blogdescription')->transport='postMessage';
			$wp_customize->get_setting('header_textcolor')->transport='postMessage';

			/* MAIN COLOR SCHEME
			================================================== */

			$wp_customize->add_section( 'color_scheme', array(
			    'title'          => __( 'Color - Accent', 'atelier' ),
			    'priority'       => 202,
			    'description'	 => __( 'These colours are used throughout the theme to give your site consistent styling, these would likely be colours from your identity colour scheme.', 'atelier' ),
			) );

			$wp_customize->add_setting( 'sf_customizer[accent_color]', array(
				'default'        => '#1dc6df',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[accent_alt_color]', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[secondary_accent_color]', array(
				'default'        => '#2e2e36',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[secondary_accent_alt_color]', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
				'label'   => __( 'Accent Color', 'atelier' ),
				'section' => 'color_scheme',
				'settings'   => 'sf_customizer[accent_color]',
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_alt_color', array(
				'label'   => __( 'Accent Alt Color', 'atelier' ),
				'section' => 'color_scheme',
				'settings'   => 'sf_customizer[accent_alt_color]',
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_accent_color', array(
				'label'   => __( 'Secondary Accent Color', 'atelier' ),
				'section' => 'color_scheme',
				'settings'   => 'sf_customizer[secondary_accent_color]',
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_accent_alt_color', array(
				'label'   => __( 'Secondary Accent Alt Color', 'atelier' ),
				'section' => 'color_scheme',
				'settings'   => 'sf_customizer[secondary_accent_alt_color]',
			) ) );


			/* PAGE STYLING
			================================================== */

			$wp_customize->add_section( 'page_styling', array(
			    'title'          => __( 'Color - Page', 'atelier' ),
			    'priority'       => 203,
			) );

			$wp_customize->add_setting( 'sf_customizer[page_bg_color]', array(
				'default'        => '#222222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting('sf_customizer[inner_page_bg_transparent]', array(
			    'default'        => 'color',
			    'type'           => 'option',
			    'transport'      => 'postMessage',
			    'capability'     => 'edit_theme_options',
			    'sanitize_callback' => 'sanitize_transparent_select',
			));

			$wp_customize->add_setting( 'sf_customizer[inner_page_bg_color]', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[section_divide_color]', array(
				'default'        => '#e4e4e4',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[alt_bg_color]', array(
				'default'        => '#f7f7f7',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_bg_color', array(
				'label'   => __( 'Outer page / loading background colour', 'atelier' ),
				'section' => 'page_styling',
				'settings'   => 'sf_customizer[page_bg_color]',
				'priority'       => 1,
			) ) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'inner_page_bg_transparent', array(
			    'label'     => __('Inner page background Display', 'atelier'),
			    'section'   => 'page_styling',
			    'settings'  => 'sf_customizer[inner_page_bg_transparent]',
			    'type'      => 'select',
			    'priority'       => 2,
			    'choices'    => array(
			    	'transparent' => 'Transparent',
			    	'color'	 => 'Color'
			    	),
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'inner_page_bg_color', array(
				'label'   => __( 'Inner page background color', 'atelier' ),
				'section' => 'page_styling',
				'settings'   => 'sf_customizer[inner_page_bg_color]',
				'priority'       => 3,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'section_divide_color', array(
				'label'   => __( 'Section divide color', 'atelier' ),
				'section' => 'page_styling',
				'settings'   => 'sf_customizer[section_divide_color]',
				'priority'       => 4,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'alt_bg_color', array(
				'label'   => __( 'Alt Background Color', 'atelier' ),
				'section' => 'page_styling',
				'settings'   => 'sf_customizer[alt_bg_color]',
				'priority'       => 5,
			) ) );


			/* GENERAL STYLING
			================================================== */

			$wp_customize->add_section( 'general_styling', array(
			    'title'          => __( 'Color - General', 'atelier' ),
			    'priority'       => 213,
			) );

			$wp_customize->add_setting( 'sf_customizer[body_color]', array(
				'default'        => '#444444',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[body_alt_color]', array(
				'default'        => '#999999',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[link_color]', array(
				'default'        => '#444444',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[link_hover_color]', array(
				'default'        => '#999999',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[h1_color]', array(
				'default'        => '#000000',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[h2_color]', array(
				'default'        => '#000000',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[h3_color]', array(
				'default'        => '#000000',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[h4_color]', array(
				'default'        => '#000000',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[h5_color]', array(
				'default'        => '#000000',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[h6_color]', array(
				'default'        => '#000000',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[overlay_bg_color]', array(
				'default'        => '#fe504f',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[overlay_text_color]', array(
				'default'        => '#fff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_color', array(
				'label'   => __( 'Body Text Color', 'atelier' ),
				'section' => 'general_styling',
				'settings'   => 'sf_customizer[body_color]',
				'priority'       => 1,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_alt_color', array(
				'label'   => __( 'Body Alt Text Color', 'atelier' ),
				'section' => 'general_styling',
				'settings'   => 'sf_customizer[body_alt_color]',
				'priority'       => 2,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
				'label'   => __( 'Link Text Color', 'atelier' ),
				'section' => 'general_styling',
				'settings'   => 'sf_customizer[link_color]',
				'priority'       => 3,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
				'label'   => __( 'Link Hover Color', 'atelier' ),
				'section' => 'general_styling',
				'settings'   => 'sf_customizer[link_hover_color]',
				'priority'       => 4,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h1_color', array(
				'label'   => __( 'H1 Text Color', 'atelier' ),
				'section' => 'general_styling',
				'settings'   => 'sf_customizer[h1_color]',
				'priority'       => 5,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h2_color', array(
				'label'   => __( 'H2 Text Color', 'atelier' ),
				'section' => 'general_styling',
				'settings'   => 'sf_customizer[h2_color]',
				'priority'       => 6,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h3_color', array(
				'label'   => __( 'H3 Text Color', 'atelier' ),
				'section' => 'general_styling',
				'settings'   => 'sf_customizer[h3_color]',
				'priority'       => 7,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h4_color', array(
				'label'   => __( 'H4 Text Color', 'atelier' ),
				'section' => 'general_styling',
				'settings'   => 'sf_customizer[h4_color]',
				'priority'       => 8,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h5_color', array(
				'label'   => __( 'H5 Text Color', 'atelier' ),
				'section' => 'general_styling',
				'settings'   => 'sf_customizer[h5_color]',
				'priority'       => 9,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h6_color', array(
				'label'   => __( 'H6 Text Color', 'atelier' ),
				'section' => 'general_styling',
				'settings'   => 'sf_customizer[h6_color]',
				'priority'       => 10,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'overlay_bg_color', array(
				'label'   => __( 'Hover Overlay Background Color', 'atelier' ),
				'section' => 'general_styling',
				'settings'   => 'sf_customizer[overlay_bg_color]',
				'priority'       => 11,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'overlay_text_color', array(
				'label'   => __( 'Hover Overlay Text Color', 'atelier' ),
				'section' => 'general_styling',
				'settings'   => 'sf_customizer[overlay_text_color]',
				'priority'       => 12,
			) ) );


			/* UI ELEMENTS STYLING
			================================================== */

			$wp_customize->add_section( 'uielements_styling', array(
			    'title'          => __( 'Color - UI Elements', 'atelier' ),
			    'priority'       => 215,
			) );

			$wp_customize->add_setting( 'sf_customizer[form_styling]', array(
				'default'        => 'standard',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_form_styling',
			) );

			$wp_customize->add_setting( 'sf_customizer[input_bg_color]', array(
				'default'        => '#f4f4f4',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[input_text_color]', array(
				'default'        => '#222222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[sale_tag_color]', array(
				'default'        => '#ef3f32',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[new_tag_color]', array(
				'default'        => '#fa726e',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[oos_tag_color]', array(
				'default'        => '#999',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( 'form_styling', array(
				'label'   => 'Form Styling',
				'section' => 'uielements_styling',
				'type'    => 'select',
			    'settings'   => 'sf_customizer[form_styling]',
				'priority'       => 1,
				'choices'    => array(
					'standard' => 'Standard',
					'minimal'  => 'Minimal'
					),
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'input_bg_color', array(
				'label'   => __( 'Input/Textarea Background Color', 'atelier' ),
				'section' => 'uielements_styling',
				'settings'   => 'sf_customizer[input_bg_color]',
				'priority'       => 2,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'input_text_color', array(
				'label'   => __( 'Input/Textarea Text Color', 'atelier' ),
				'section' => 'uielements_styling',
				'settings'   => 'sf_customizer[input_text_color]',
				'priority'       => 3,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sale_tag_color', array(
				'label'   => __( 'Sale Tag Color', 'atelier' ),
				'section' => 'uielements_styling',
				'settings'   => 'sf_customizer[sale_tag_color]',
				'priority'       => 4,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'new_tag_color', array(
				'label'   => __( 'New Tag Color', 'atelier' ),
				'section' => 'uielements_styling',
				'settings'   => 'sf_customizer[new_tag_color]',
				'priority'       => 5,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'oos_tag_color', array(
				'label'   => __( 'Out of Stock Tag Color', 'atelier' ),
				'section' => 'uielements_styling',
				'settings'   => 'sf_customizer[oos_tag_color]',
				'priority'       => 6,
			) ) );


			/* HEADER STYLING
			================================================== */

			$wp_customize->add_section( 'breadcrumbs_styling', array(
			    'title'          => __( 'Color - Breadcrumbs', 'atelier' ),
			    'priority'       => 204,
			) );

			$wp_customize->add_setting( 'sf_customizer[breadcrumb_bg_color]', array(
				'default'        => '#e4e4e4',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[breadcrumb_text_color]', array(
				'default'        => '#666666',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[breadcrumb_link_color]', array(
				'default'        => '#999999',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_bg_color', array(
				'label'   => __( 'Breadcrumb Background Color', 'atelier' ),
				'section' => 'breadcrumbs_styling',
				'settings'   => 'sf_customizer[breadcrumb_bg_color]',
				'priority'       => 1,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_text_color', array(
				'label'   => __( 'Breadcrumb Text Color', 'atelier' ),
				'section' => 'breadcrumbs_styling',
				'settings'   => 'sf_customizer[breadcrumb_text_color]',
				'priority'       => 2,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_link_color', array(
				'label'   => __( 'Breadcrumb Link Color', 'atelier' ),
				'section' => 'breadcrumbs_styling',
				'settings'   => 'sf_customizer[breadcrumb_link_color]',
				'priority'       => 3,
			) ) );


			/* TOP BAR STYLING
			================================================== */

			$wp_customize->add_section( 'top_bar_styling', array(
			    'title'          => __( 'Color - Top Bar', 'atelier' ),
			    'priority'       => 205,
			) );

			$wp_customize->add_setting( 'sf_customizer[topbar_bg_color]', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[topbar_text_color]', array(
				'default'        => '#222222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[topbar_link_color]', array(
				'default'        => '#666666',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[topbar_link_hover_color]', array(
				'default'        => '#fe504f',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[topbar_divider_color]', array(
				'default'        => '#e3e3e3',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_bg_color', array(
				'label'   => __( 'Top Bar Background Color', 'atelier' ),
				'section' => 'top_bar_styling',
				'settings'   => 'sf_customizer[topbar_bg_color]',
				'priority'       => 2,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_text_color', array(
				'label'   => __( 'Top Bar Text Color', 'atelier' ),
				'section' => 'top_bar_styling',
				'settings'   => 'sf_customizer[topbar_text_color]',
				'priority'       => 3,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_link_color', array(
				'label'   => __( 'Top Bar Link Color', 'atelier' ),
				'section' => 'top_bar_styling',
				'settings'   => 'sf_customizer[topbar_link_color]',
				'priority'       => 4,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_link_hover_color', array(
				'label'   => __( 'Top Bar Link Hover Color', 'atelier' ),
				'section' => 'top_bar_styling',
				'settings'   => 'sf_customizer[topbar_link_hover_color]',
				'priority'       => 5,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topbar_divider_color', array(
				'label'   => __( 'Top Bar Divider Color', 'atelier' ),
				'section' => 'top_bar_styling',
				'settings'   => 'sf_customizer[topbar_divider_color]',
				'priority'       => 6,
			) ) );


			/* HEADER STYLING
			================================================== */

			$wp_customize->add_section( 'header_styling', array(
			    'title'          => __( 'Color - Header', 'atelier' ),
			    'priority'       => 206,
			) );

			$wp_customize->add_setting( 'sf_customizer[header_bg_color]', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting('sf_customizer[header_bg_transparent]', array(
			    'default'        => 'color',
			    'type'           => 'option',
			    'transport'      => 'postMessage',
			    'capability'     => 'edit_theme_options',
			    'sanitize_callback' => 'sanitize_transparent_select',
			));

			$wp_customize->add_setting( 'sf_customizer[header_border_color]', array(
				'default'        => '#e4e4e4',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[header_text_color]', array(
				'default'        => '#222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[header_link_color]', array(
				'default'        => '#222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[header_link_hover_color]', array(
				'default'        => '#fe504f',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[header_divider_style]', array(
				'default'        => 'divider',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_divider_style',
			) );

			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_bg_transparent', array(
			    'label'     => __('Header Background Type', 'atelier'),
			    'section'   => 'header_styling',
			    'settings'  => 'sf_customizer[header_bg_transparent]',
			    'type'      => 'select',
			    'priority'       => 6,
			    'choices'    => array(
			    	'transparent' => 'Transparent',
			    	'color'	 => 'Color'
			    	),
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color', array(
				'label'   => __( 'Header Background Color', 'atelier' ),
				'section' => 'header_styling',
				'settings'   => 'sf_customizer[header_bg_color]',
				'priority'       => 7,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_border_color', array(
				'label'   => __( 'Header Border Color', 'atelier' ),
				'section' => 'header_styling',
				'settings'   => 'sf_customizer[header_border_color]',
				'priority'       => 9,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_text_color', array(
				'label'   => __( 'Header Text Color', 'atelier' ),
				'section' => 'header_styling',
				'settings'   => 'sf_customizer[header_text_color]',
				'priority'       => 10,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_link_color', array(
				'label'   => __( 'Header Link Color', 'atelier' ),
				'section' => 'header_styling',
				'settings'   => 'sf_customizer[header_link_color]',
				'priority'       => 11,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_link_hover_color', array(
				'label'   => __( 'Header Link Hover Color', 'atelier' ),
				'section' => 'header_styling',
				'settings'   => 'sf_customizer[header_link_hover_color]',
				'priority'       => 12,
			) ) );

			$wp_customize->add_control( 'header_divider_style', array(
				'label'   => 'Header Divider Style',
				'section' => 'header_styling',
				'type'    => 'select',
                'settings'   => 'sf_customizer[header_divider_style]',
				'priority'       => 13,
				'choices'    => array(
					'divider' => 'Divider',
					'shadow'	 => 'Shadow',
					'none'	 => 'None'
					),
			) );



			/* NAVIGATION STYLING
			================================================== */

			$wp_customize->add_section( 'nav_styling', array(
			    'title'          => __( 'Color - Navigation', 'atelier' ),
			    'priority'       => 207,
			) );

			$wp_customize->add_setting( 'sf_customizer[nav_bg_color]', array(
				'default'        => '#fff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[nav_hover_style]', array(
				'default'        => 'standard',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_nav_hover_style',
			) );

			$wp_customize->add_setting( 'sf_customizer[nav_text_color]', array(
				'default'        => '#252525',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[nav_bg_hover_color]', array(
				'default'        => '#f7f7f7',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[nav_text_hover_color]', array(
				'default'        => '#07c1b6',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[nav_selected_bg_color]', array(
				'default'        => '#e3e3e3',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[nav_selected_text_color]', array(
				'default'        => '#fe504f',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[nav_sm_bg_color]', array(
				'default'        => '#FFFFFF',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[nav_sm_text_color]', array(
				'default'        => '#666666',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[nav_sm_text_hover_color]', array(
				'default'        => '#000000',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[nav_sm_selected_text_color]', array(
				'default'        => '#000000',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[nav_divider]', array(
				'default'        => 'solid',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_nav_divider_style',
			) );

			$wp_customize->add_setting( 'sf_customizer[nav_divider_color]', array(
				'default'        => '#f0f0f0',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_bg_color', array(
				'label'   => __( 'Nav / Sticky Header Background Color', 'atelier' ),
				'section' => 'nav_styling',
				'settings'   => 'sf_customizer[nav_bg_color]',
				'priority'       => 1,
			) ) );

			$wp_customize->add_control( 'nav_hover_style', array(
				'label'   => 'Menu Item Hover Style',
				'section' => 'nav_styling',
				'type'    => 'select',
                'settings'   => 'sf_customizer[nav_hover_style]',
				'priority'       => 2,
				'choices'    => array(
					'standard' => 'Standard',
					'bold'	 => 'Bold'
					),
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_text_color', array(
				'label'   => __( 'Menu Item Text Color', 'atelier' ),
				'section' => 'nav_styling',
				'settings'   => 'sf_customizer[nav_text_color]',
				'priority'       => 3,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_bg_hover_color', array(
				'label'   => __( 'Menu Item BG Hover Color', 'atelier' ),
				'section' => 'nav_styling',
				'settings'   => 'sf_customizer[nav_bg_hover_color]',
				'priority'       => 4,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_text_hover_color', array(
				'label'   => __( 'Menu Item Text Hover Color', 'atelier' ),
				'section' => 'nav_styling',
				'settings'   => 'sf_customizer[nav_text_hover_color]',
				'priority'       => 5,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_selected_bg_color', array(
				'label'   => __( 'Menu Item Selected Background Color (Bold only)', 'atelier' ),
				'section' => 'nav_styling',
				'settings'   => 'sf_customizer[nav_selected_bg_color]',
				'priority'       => 6,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_selected_text_color', array(
				'label'   => __( 'Menu Item Selected Text Color', 'atelier' ),
				'section' => 'nav_styling',
				'settings'   => 'sf_customizer[nav_selected_text_color]',
				'priority'       => 7,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_sm_bg_color', array(
				'label'   => __( 'Sub Menu Background Color', 'atelier' ),
				'section' => 'nav_styling',
				'settings'   => 'sf_customizer[nav_sm_bg_color]',
				'priority'       => 9,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_sm_text_color', array(
				'label'   => __( 'Sub Menu Text Color', 'atelier' ),
				'section' => 'nav_styling',
				'settings'   => 'sf_customizer[nav_sm_text_color]',
				'priority'       => 10,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_sm_text_hover_color', array(
				'label'   => __( 'Sub Menu Text Hover Color', 'atelier' ),
				'section' => 'nav_styling',
				'settings'   => 'sf_customizer[nav_sm_text_hover_color]',
				'priority'       => 12,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_sm_selected_text_color', array(
				'label'   => __( 'Sub Menu Selected Text Color', 'atelier' ),
				'section' => 'nav_styling',
				'settings'   => 'sf_customizer[nav_sm_selected_text_color]',
				'priority'       => 13,
			) ) );

			$wp_customize->add_control( 'nav_divider', array(
				'label'   => 'Nav Divider Style',
				'section' => 'nav_styling',
				'type'    => 'select',
				'priority'       => 14,
                'settings'   => 'sf_customizer[nav_divider]',
				'choices'    => array(
					'dotted' => 'Dotted',
					'solid'	 => 'Solid',
					'none'   => 'none'
					),
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_divider_color', array(
				'label'   => __( 'Nav Divider Color', 'atelier' ),
				'section' => 'nav_styling',
				'settings'   => 'sf_customizer[nav_divider_color]',
				'priority'       => 15,
			) ) );


			/* OVERLAY MENU STYLING
			================================================== */

			$wp_customize->add_section( 'overlay_menu_styling', array(
			    'title'          => __( 'Color - Fullscreen Overlays', 'atelier' ),
			    'priority'       => 208,
			) );

			$wp_customize->add_setting( 'sf_customizer[overlay_menu_bg_color]', array(
				'default'        => '#e4e4e4',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[overlay_menu_text_color]', array(
				'default'        => '#666',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[overlay_menu_link_color]', array(
				'default'        => '#222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[overlay_menu_link_hover_color]', array(
				'default'        => '#1dc6df',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'overlay_menu_bg_color', array(
				'label'   => __( 'Fullscreen Overlay Background Color', 'atelier' ),
				'section' => 'overlay_menu_styling',
				'settings'   => 'sf_customizer[overlay_menu_bg_color]',
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'overlay_menu_text_color', array(
				'label'   => __( 'Fullscreen Overlay Text Color', 'atelier' ),
				'section' => 'overlay_menu_styling',
				'settings'   => 'sf_customizer[overlay_menu_text_color]',
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'overlay_menu_link_color', array(
				'label'   => __( 'Fullscreen Overlay Link Color', 'atelier' ),
				'section' => 'overlay_menu_styling',
				'settings'   => 'sf_customizer[overlay_menu_link_color]',
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'overlay_menu_link_hover_color', array(
				'label'   => __( 'Fullscreen Overlay Link Hover Color', 'atelier' ),
				'section' => 'overlay_menu_styling',
				'settings'   => 'sf_customizer[overlay_menu_link_hover_color]',
			) ) );


			/* SIDE SLIDEOUT MENU STYLING
			================================================== */

			$wp_customize->add_section( 'slideout_menu_styling', array(
			    'title'          => __( 'Color - Slideout Menu', 'atelier' ),
			    'priority'       => 208,
			) );

			$wp_customize->add_setting( 'sf_customizer[slideout_menu_bg_color]', array(
				'default'        => '#222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[slideout_menu_bg_image]', array(
				'default'        => '',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			) );

			$wp_customize->add_setting( 'sf_customizer[slideout_menu_link_color]', array(
				'default'        => '#fff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[slideout_menu_link_hover_color]', array(
				'default'        => '#1dc6df',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[slideout_menu_divider_color]', array(
				'default'        => '#ccc',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'slideout_menu_bg_color', array(
				'label'   => __( 'Slideout Background Color', 'atelier' ),
				'section' => 'slideout_menu_styling',
				'settings'   => 'sf_customizer[slideout_menu_bg_color]',
			) ) );

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'slideout_menu_bg_image', array(
			    'label'   => __( 'Slideout Background Image', 'atelier' ),
				'section' => 'slideout_menu_styling',
				'settings'   => 'sf_customizer[slideout_menu_bg_image]',
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'slideout_menu_link_color', array(
				'label'   => __( 'Slideout Link Color', 'atelier' ),
				'section' => 'slideout_menu_styling',
				'settings'   => 'sf_customizer[slideout_menu_link_color]',
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'slideout_menu_link_hover_color', array(
				'label'   => __( 'Slideout Link Hover Color', 'atelier' ),
				'section' => 'slideout_menu_styling',
				'settings'   => 'sf_customizer[slideout_menu_link_hover_color]',
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'slideout_menu_divider_color', array(
				'label'   => __( 'Slideout Divider Color', 'atelier' ),
				'section' => 'slideout_menu_styling',
				'settings'   => 'sf_customizer[slideout_menu_divider_color]',
			) ) );


			/* MOBILE HEADER STYLING
			================================================== */

			$wp_customize->add_section( 'mobile_header_styling', array(
			    'title'          => __( 'Color - Mobile Menu', 'atelier' ),
			    'priority'       => 209,
			) );

			$wp_customize->add_setting( 'sf_customizer[mobile_menu_bg_color]', array(
				'default'        => '#222222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[mobile_menu_text_color]', array(
				'default'        => '#e4e4e4',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[mobile_menu_link_color]', array(
				'default'        => '#fff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[mobile_menu_link_hover_color]', array(
				'default'        => '#fe504f',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[mobile_menu_divider_color]', array(
				'default'        => '#444',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mobile_menu_bg_color', array(
				'label'   => __( 'Mobile Menu/Cart Background Color', 'atelier' ),
				'section' => 'mobile_header_styling',
				'settings'   => 'sf_customizer[mobile_menu_bg_color]',
				'priority'       => 6,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mobile_menu_text_color', array(
				'label'   => __( 'Mobile Cart Text Color', 'atelier' ),
				'section' => 'mobile_header_styling',
				'settings'   => 'sf_customizer[mobile_menu_text_color]',
				'priority'       => 7,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mobile_menu_link_color', array(
				'label'   => __( 'Mobile Cart Link Color', 'atelier' ),
				'section' => 'mobile_header_styling',
				'settings'   => 'sf_customizer[mobile_menu_link_color]',
				'priority'       => 8,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mobile_menu_link_hover_color', array(
				'label'   => __( 'Mobile Cart Link Hover Color', 'atelier' ),
				'section' => 'mobile_header_styling',
				'settings'   => 'sf_customizer[mobile_menu_link_hover_color]',
				'priority'       => 9,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mobile_menu_divider_color', array(
				'label'   => __( 'Mobile Cart Divider Color', 'atelier' ),
				'section' => 'mobile_header_styling',
				'settings'   => 'sf_customizer[mobile_menu_divider_color]',
				'priority'       => 10,
			) ) );


			/* FOOTER STYLING
			================================================== */

			$wp_customize->add_section( 'footer_styling', array(
			    'title'          => __( 'Color - Footer', 'atelier' ),
			    'priority'       => 210,
			) );

			$wp_customize->add_setting( 'sf_customizer[footer_bg_color]', array(
				'default'        => '#252525',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[footer_text_color]', array(
				'default'        => '#cccccc',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[footer_link_color]', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[footer_link_hover_color]', array(
				'default'        => '#e4e4e4',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[footer_border_color]', array(
				'default'        => '#333333',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[copyright_bg_color]', array(
				'default'        => '#252525',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[copyright_text_color]', array(
				'default'        => '#999999',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[copyright_link_color]', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[copyright_link_hover_color]', array(
				'default'        => '#e4e4e4',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bg_color', array(
				'label'   => __( 'Footer Background Color', 'atelier' ),
				'section' => 'footer_styling',
				'settings'   => 'sf_customizer[footer_bg_color]',
				'priority'       => 1,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_color', array(
				'label'   => __( 'Footer Text Color', 'atelier' ),
				'section' => 'footer_styling',
				'settings'   => 'sf_customizer[footer_text_color]',
				'priority'       => 2,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_link_color', array(
				'label'   => __( 'Footer Link Color', 'atelier' ),
				'section' => 'footer_styling',
				'settings'   => 'sf_customizer[footer_link_color]',
				'priority'       => 3,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_link_hover_color', array(
				'label'   => __( 'Footer Link Hover Color', 'atelier' ),
				'section' => 'footer_styling',
				'settings'   => 'sf_customizer[footer_link_hover_color]',
				'priority'       => 4,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_border_color', array(
				'label'   => __( 'Footer Border Color', 'atelier' ),
				'section' => 'footer_styling',
				'settings'   => 'sf_customizer[footer_border_color]',
				'priority'       => 5,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_bg_color', array(
				'label'   => __( 'Copyright Background Color', 'atelier' ),
				'section' => 'footer_styling',
				'settings'   => 'sf_customizer[copyright_bg_color]',
				'priority'       => 6,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_text_color', array(
				'label'   => __( 'Copyright Text Color', 'atelier' ),
				'section' => 'footer_styling',
				'settings'   => 'sf_customizer[copyright_text_color]',
				'priority'       => 7,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_link_color', array(
				'label'   => __( 'Copyright Link Color', 'atelier' ),
				'section' => 'footer_styling',
				'settings'   => 'sf_customizer[copyright_link_color]',
				'priority'       => 8,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_link_hover_color', array(
				'label'   => __( 'Copyright Link Hover Color', 'atelier' ),
				'section' => 'footer_styling',
				'settings'   => 'sf_customizer[copyright_link_hover_color]',
				'priority'       => 9,
			) ) );

			/* HEADER BANNER STYLING
			================================================== */

			$wp_customize->add_section( 'header_banner_styling', array(
			    'title'          => __( 'Color - Header Banner', 'atelier' ),
			    'priority'       => 211,
			) );

			$wp_customize->add_setting( 'sf_customizer[header_banner_bg_color]', array(
				'default'        => '#fff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[header_banner_text_color]', array(
				'default'        => '#222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[header_banner_link_color]', array(
				'default'        => '#333',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[header_banner_link_hover_color]', array(
				'default'        => '#1dc6df',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[header_banner_border_color]', array(
				'default'        => '#e3e3e3',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_banner_bg_color', array(
				'label'   => __( 'Header Banner Background Color', 'atelier' ),
				'section' => 'header_banner_styling',
				'settings'   => 'sf_customizer[header_banner_bg_color]',
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_banner_text_color', array(
				'label'   => __( 'Header Banner Text Color', 'atelier' ),
				'section' => 'header_banner_styling',
				'settings'   => 'sf_customizer[header_banner_text_color]',
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_banner_link_color', array(
				'label'   => __( 'Header Banner Link Color', 'atelier' ),
				'section' => 'header_banner_styling',
				'settings'   => 'sf_customizer[header_banner_link_color]',
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_banner_link_hover_color', array(
				'label'   => __( 'Header Banner Link Hover Color', 'atelier' ),
				'section' => 'header_banner_styling',
				'settings'   => 'sf_customizer[header_banner_link_hover_color]',
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_banner_border_color', array(
				'label'   => __( 'Header Banner Border Color', 'atelier' ),
				'section' => 'header_banner_styling',
				'settings'   => 'sf_customizer[header_banner_border_color]',
			) ) );


			/* NEWSLETTER BAR STYLING
			================================================== */

			$wp_customize->add_section( 'newsletter_bar_styling', array(
			    'title'          => __( 'Color - Newsletter Bar', 'atelier' ),
			    'priority'       => 212,
			) );

			$wp_customize->add_setting( 'sf_customizer[newsletter_bar_bg_color]', array(
				'default'        => '#222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[newsletter_bar_text_color]', array(
				'default'        => '#ccc',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[newsletter_bar_link_hover_color]', array(
				'default'        => '#fff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'newsletter_bar_bg_color', array(
				'label'   => __( 'Newsletter Bar Background Color', 'atelier' ),
				'section' => 'newsletter_bar_styling',
				'settings'   => 'sf_customizer[newsletter_bar_bg_color]',
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'newsletter_bar_text_color', array(
				'label'   => __( 'Newsletter Bar Text Color', 'atelier' ),
				'section' => 'newsletter_bar_styling',
				'settings'   => 'sf_customizer[newsletter_bar_text_color]',
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'newsletter_bar_link_hover_color', array(
				'label'   => __( 'Newsletter Bar Link Hover Color', 'atelier' ),
				'section' => 'newsletter_bar_styling',
				'settings'   => 'sf_customizer[newsletter_bar_link_hover_color]',
			) ) );


			/* PROMO BAR STYLING
			================================================== */

			$wp_customize->add_section( 'promo_bar_styling', array(
			    'title'          => __( 'Color - Promo Bar', 'atelier' ),
			    'priority'       => 213,
			) );

			$wp_customize->add_setting( 'sf_customizer[promo_bar_bg_color]', array(
				'default'        => '#e4e4e4',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[promo_bar_text_color]', array(
				'default'        => '#222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'promo_bar_bg_color', array(
				'label'   => __( 'Promo Bar Background Color', 'atelier' ),
				'section' => 'promo_bar_styling',
				'settings'   => 'sf_customizer[promo_bar_bg_color]',
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'promo_bar_text_color', array(
				'label'   => __( 'Promo Bar Text Color', 'atelier' ),
				'section' => 'promo_bar_styling',
				'settings'   => 'sf_customizer[promo_bar_text_color]',
			) ) );


			/* PAGE HEADING STYLING
			================================================== */

			$wp_customize->add_section( 'page_heading_styling', array(
			    'title'          => __( 'Color - Page Heading', 'atelier' ),
			    'priority'       => 214,
			) );

			$wp_customize->add_setting( 'sf_customizer[page_heading_bg_color]', array(
				'default'        => '#f7f7f7',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[page_heading_text_color]', array(
				'default'        => '#222222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_heading_bg_color', array(
				'label'   => __( 'Page Heading Background Color', 'atelier' ),
				'section' => 'page_heading_styling',
				'settings'   => 'sf_customizer[page_heading_bg_color]',
				'priority'       => 1,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_heading_text_color', array(
				'label'   => __( 'Page Heading Text Color', 'atelier' ),
				'section' => 'page_heading_styling',
				'settings'   => 'sf_customizer[page_heading_text_color]',
				'priority'       => 2,
			) ) );


			/* POST STYLING
			================================================== */

			$wp_customize->add_section( 'postdetail_styling', array(
			    'title'          => __( 'Color - Post Detail', 'atelier' ),
			    'priority'       => 215,
			) );

			$wp_customize->add_setting( 'sf_customizer[article_review_bar_alt_color]', array(
				'default'        => '#f7f7f7',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[article_review_bar_color]', array(
				'default'        => '#2e2e36',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[article_review_bar_text_color]', array(
				'default'        => '#fff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[article_extras_bg_color]', array(
				'default'        => '#f7f7f7',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[article_np_bg_color]', array(
				'default'        => '#444',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[article_np_text_color]', array(
				'default'        => '#fff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'article_review_bar_alt_color', array(
				'label'   => __( 'Article Review Bar Alt Background Color', 'atelier' ),
				'section' => 'postdetail_styling',
				'settings'   => 'sf_customizer[article_review_bar_alt_color]',
				'priority'       => 1,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'article_review_bar_color', array(
				'label'   => __( 'Article Review Bar Background Color', 'atelier' ),
				'section' => 'postdetail_styling',
				'settings'   => 'sf_customizer[article_review_bar_color]',
				'priority'       => 2,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'article_review_bar_text_color', array(
				'label'   => __( 'Article Review Bar Text Color', 'atelier' ),
				'section' => 'postdetail_styling',
				'settings'   => 'sf_customizer[article_review_bar_text_color]',
				'priority'       => 3,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'article_extras_bg_color', array(
				'label'   => __( 'Article Extras Background Color', 'atelier' ),
				'section' => 'postdetail_styling',
				'settings'   => 'sf_customizer[article_extras_bg_color]',
				'priority'       => 6,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'article_np_bg_color', array(
				'label'   => __( 'Next / Previous Article Background Color', 'atelier' ),
				'section' => 'postdetail_styling',
				'settings'   => 'sf_customizer[article_np_bg_color]',
				'priority'       => 7,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'article_np_text_color', array(
				'label'   => __( 'Next / Previous Article Text Color', 'atelier' ),
				'section' => 'postdetail_styling',
				'settings'   => 'sf_customizer[article_np_text_color]',
				'priority'       => 8,
			) ) );


			/* CONTENT SLIDER STYLING
			================================================== */

			$wp_customize->add_section( 'contentslider_styling', array(
			    'title'          => __( 'Color - Content Sliders', 'atelier' ),
			    'priority'       => 216,
			) );

			$wp_customize->add_setting( 'sf_customizer[tweet_slider_bg]', array(
				'default'        => '#1dc6df',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[tweet_slider_text]', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[tweet_slider_link]', array(
				'default'        => '#222222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[tweet_slider_link_hover]', array(
				'default'        => '#fb3c2d',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[testimonial_slider_bg]', array(
				'default'        => '#1dc6df',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[testimonial_slider_text]', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tweet_slider_bg', array(
				'label'   => __( 'Tweet Slider Background Color', 'atelier' ),
				'section' => 'contentslider_styling',
				'settings'   => 'sf_customizer[tweet_slider_bg]',
				'priority'       => 1,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tweet_slider_text', array(
				'label'   => __( 'Tweet Slider Text Color', 'atelier' ),
				'section' => 'contentslider_styling',
				'settings'   => 'sf_customizer[tweet_slider_text]',
				'priority'       => 2,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tweet_slider_link', array(
				'label'   => __( 'Tweet Slider Link Color', 'atelier' ),
				'section' => 'contentslider_styling',
				'settings'   => 'sf_customizer[tweet_slider_link]',
				'priority'       => 3,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tweet_slider_link_hover', array(
				'label'   => __( 'Tweet Slider Link Hover Color', 'atelier' ),
				'section' => 'contentslider_styling',
				'settings'   => 'sf_customizer[tweet_slider_link_hover]',
				'priority'       => 4,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'testimonial_slider_bg', array(
				'label'   => __( 'Testimonial Slider Background Color', 'atelier' ),
				'section' => 'contentslider_styling',
				'settings'   => 'sf_customizer[testimonial_slider_bg]',
				'priority'       => 5,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'testimonial_slider_text', array(
				'label'   => __( 'Testimonial Slider Text Color', 'atelier' ),
				'section' => 'contentslider_styling',
				'settings'   => 'sf_customizer[testimonial_slider_text]',
				'priority'       => 6,
			) ) );


			/* SHORTCODE STYLING
			================================================== */

			$wp_customize->add_section( 'shortcode_styling', array(
			    'title'          => __( 'Color - Shortcodes', 'atelier' ),
			    'priority'       => 217,
			) );

			$wp_customize->add_setting( 'sf_customizer[icon_container_bg_color]', array(
				'default'        => '#1dc6df',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[sf_icon_color]', array(
				'default'        => '#1dc6df',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[icon_container_hover_bg_color]', array(
				'default'        => '#222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[sf_icon_alt_color]', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[share_button_bg]', array(
				'default'        => '#fb3c2d',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[share_button_text]', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[bold_rp_bg]', array(
				'default'        => '#f7f7f7',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[bold_rp_text]', array(
				'default'        => '#222',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[bold_rp_hover_bg]', array(
				'default'        => '#fb3c2d',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_setting( 'sf_customizer[bold_rp_hover_text]', array(
				'default'        => '#ffffff',
				'type'           => 'option',
				'transport'      => 'postMessage',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'icon_container_bg_color', array(
				'label'   => __( 'Icon Container Background Color', 'atelier' ),
				'section' => 'shortcode_styling',
				'settings'   => 'sf_customizer[icon_container_bg_color]',
				'priority'       => 1,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'atelier_icon_color', array(
				'label'   => __( 'Icon Color', 'atelier' ),
				'section' => 'shortcode_styling',
				'settings'   => 'sf_customizer[sf_icon_color]',
				'priority'       => 2,
			) ) );


			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'icon_container_hover_bg_color', array(
				'label'   => __( 'Icon Container Background Hover/Alt Color', 'atelier' ),
				'section' => 'shortcode_styling',
				'settings'   => 'sf_customizer[icon_container_hover_bg_color]',
				'priority'       => 3,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'atelier_icon_alt_color', array(
				'label'   => __( 'Icon Hover/Container Icon Color', 'atelier' ),
				'section' => 'shortcode_styling',
				'settings'   => 'sf_customizer[sf_icon_alt_color]',
				'priority'       => 4,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'share_button_bg', array(
				'label'   => __( 'Share Button Background Color', 'atelier' ),
				'section' => 'shortcode_styling',
				'settings'   => 'sf_customizer[share_button_bg]',
				'priority'       => 6,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'share_button_text', array(
				'label'   => __( 'Share Button Text Color', 'atelier' ),
				'section' => 'shortcode_styling',
				'settings'   => 'sf_customizer[share_button_text]',
				'priority'       => 7,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bold_rp_bg', array(
				'label'   => __( 'Bold Recent Posts Background Color', 'atelier' ),
				'section' => 'shortcode_styling',
				'settings'   => 'sf_customizer[bold_rp_bg]',
				'priority'       => 8,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bold_rp_text', array(
				'label'   => __( 'Bold Recent Posts Text Color', 'atelier' ),
				'section' => 'shortcode_styling',
				'settings'   => 'sf_customizer[bold_rp_text]',
				'priority'       => 9,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bold_rp_hover_bg', array(
				'label'   => __( 'Bold Recent Posts Hover Background Color', 'atelier' ),
				'section' => 'shortcode_styling',
				'settings'   => 'sf_customizer[bold_rp_hover_bg]',
				'priority'       => 10,
			) ) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bold_rp_hover_text', array(
				'label'   => __( 'Bold Recent Posts Hover Text Color', 'atelier' ),
				'section' => 'shortcode_styling',
				'settings'   => 'sf_customizer[bold_rp_hover_text]',
				'priority'       => 11,
			) ) );

		}
		add_action( 'customize_register', 'atelier_customize_register' );
	}

	function sanitize_transparent_select( $value ) {
		$valid = array(
	        'color' => 'Color',
	        'transparent' => 'Transparent',
		);

		if ( array_key_exists( $value, $valid ) ) {
		    return $value;
		} else {
		    return '';
		}
	}

	function sanitize_divider_style( $value ) {
		$valid = array(
	        'divider' => 'Divider',
			'shadow'	 => 'Shadow',
			'none'	 => 'None'
		);

		if ( array_key_exists( $value, $valid ) ) {
		    return $value;
		} else {
		    return '';
		}
	}

	function sanitize_nav_hover_style( $value ) {
		$valid = array(
	        'standard' => 'Standard',
			'bold'	 => 'Bold',
		);

		if ( array_key_exists( $value, $valid ) ) {
		    return $value;
		} else {
		    return '';
		}
	}

	function sanitize_nav_divider_style( $value ) {
		$valid = array(
	        'dotted' => 'Dotted',
			'solid'	 => 'Solid',
			'none'   => 'none'
		);

		if ( array_key_exists( $value, $valid ) ) {
		    return $value;
		} else {
		    return '';
		}
	}

	function sanitize_form_styling( $value ) {
	    $valid = array(
	        'standard' => 'Standard',
	        'minimal' => 'Minimal',
		);

		if ( array_key_exists( $value, $valid ) ) {
		    return $value;
		} else {
		    return '';
		}
	}

	function atelier_customizer_live_preview() {
		wp_enqueue_script( 'sf-customizer',	get_template_directory_uri().'/js/sf-customizer.js', 'jquery', NULL, true);
	}
	add_action( 'customize_preview_init', 'atelier_customizer_live_preview' );

?>