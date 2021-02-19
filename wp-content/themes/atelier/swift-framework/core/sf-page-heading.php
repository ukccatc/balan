<?php

    /*
    *
    *	Page Heading
    *	------------------------------------------------
    *	Swift Framework v3.0
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	atelier_page_heading()
    *
    */

    /* PAGE HEADING
    ================================================== */
    if ( ! function_exists( 'atelier_page_heading' ) ) {
        function atelier_page_heading() {

            global $wp_query, $post, $atelier_options;
            
            $shop_page  = false;
            $page_title = $page_subtitle = $page_title_style = $page_title_overlay_effect = $fancy_title_image = $fancy_title_image_url = $article_heading_bg = $article_heading_text = $page_heading_el_class = $page_heading_wrap_el_class = $page_design_style = $extra_styles = $page_title_text_align = $woo_category_desc = "";

            $remove_breadcrumbs = apply_filters( 'atelier_page_heading_ns_removebreadcrumbs', 0 );
            $breadcrumb_in_heading = 0;
            if ( isset( $atelier_options['breadcrumb_in_heading'] ) ) {
            	$breadcrumb_in_heading = $atelier_options['breadcrumb_in_heading'];
            }
            $portfolio_page 			= $atelier_options['portfolio_page'];
            $portfolio_page = apply_filters('wpml_object_id', $portfolio_page, 'page', true);
            $hero_heading_fixed_height = false;
            if ( isset( $atelier_options['hero_heading_fixed_height'] ) ) {
            	$hero_heading_fixed_height = $atelier_options['hero_heading_fixed_height'];	
            }
            $page_title_height  = 300;
            $heading_img_width = 0;
            $heading_img_height = 0;
            $page_title_style   = "standard";
			$page_title_text_align = "center";
            $next_icon = apply_filters( 'atelier_next_icon', '<i class="ss-navigateright"></i>' );
            $prev_icon = apply_filters( 'atelier_prev_icon', '<i class="ss-navigateleft"></i>' );
			$index_icon = apply_filters( 'atelier_index_icon', '<i class="fas fa-th"></i>' );
			
			// Shop page check
            if ( ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_category' ) && is_product_category() ) ) {
                $shop_page = true;
            }

            // Defaults
            $default_show_page_heading = $atelier_options['default_show_page_heading'];
            $show_page_title    = apply_filters( 'atelier_page_heading_ns_pagetitle', $default_show_page_heading );
            $pagination_style          = "standard";
            if ( isset( $atelier_options['pagination_style'] ) ) {
                $pagination_style = $atelier_options['pagination_style'];
            }
            if ( isset( $atelier_options['default_page_title_style'] ) ) {
                $page_title_style = $atelier_options['default_page_title_style'];
            }
            if ( isset( $atelier_options['default_page_heading_style'] ) ) {
            	$page_title_style      = $atelier_options['default_page_heading_style'];
            }
            if ( isset( $atelier_options['default_page_heading_text_style'] ) ) {
            	$page_title_text_style = $atelier_options['default_page_heading_text_style'];
            }
            if ( isset( $atelier_options['default_page_heading_text_align'] ) ) {
            	$page_title_text_align = $atelier_options['default_page_heading_text_align'];
            }

            // Post meta
            if ( $post && is_singular() ) {
                $show_page_title       = atelier_get_post_meta($post->ID, 'sf_page_title', true );
                $remove_breadcrumbs    = atelier_get_post_meta($post->ID, 'sf_no_breadcrumbs', true );
                $page_title_style      = atelier_get_post_meta($post->ID, 'sf_page_title_style', true );
                $page_title            = atelier_get_post_meta($post->ID, 'sf_page_title_one', true );
                $page_subtitle         = atelier_get_post_meta($post->ID, 'sf_page_subtitle', true );
                $fancy_title_image     = rwmb_meta('sf_page_title_image', 'type=image&size=full' );
                $page_title_text_style = atelier_get_post_meta($post->ID, 'sf_page_title_text_style', true );
                $page_title_overlay_effect = atelier_get_post_meta($post->ID, 'sf_page_title_overlay_effect', true );
                $page_title_text_align = atelier_get_post_meta($post->ID, 'sf_page_title_text_align', true );
                $page_title_height     = atelier_get_post_meta($post->ID, 'sf_page_title_height', true );
            }

            if ( is_singular( 'post' ) ) {
                $fw_media_display = atelier_get_post_meta($post->ID, 'sf_fw_media_display', true );
                $page_design_style 	  = atelier_get_post_meta($post->ID, 'sf_page_design_style', true );
                if ( $fw_media_display == "fw-media-title" ) {
                    return;
                }
            }

            // Portfolio category navigation
            $enable_category_navigation = $atelier_options['enable_category_navigation'];

            // Woo setup
            if ( $shop_page ) {
                $show_page_title       = $atelier_options['woo_show_page_heading'];
                $page_title_style      = $atelier_options['woo_page_heading_style'];
                $fancy_title_image     = $atelier_options['woo_page_heading_image'];
                $page_title_text_style = $atelier_options['woo_page_heading_text_style'];
                if ( isset( $atelier_options['woo_page_heading_text_align'] ) ) {
                	$page_title_text_align = $atelier_options['woo_page_heading_text_align'];
                }
                $woo_slider	   = $atelier_options['woo_shop_slider'];
                $woo_shop_slider_main_only = false;
                if ( isset($atelier_options['woo_shop_slider_main_only']) ) {
                	$woo_shop_slider_main_only = $atelier_options['woo_shop_slider_main_only'];
                }
                
                if ( $woo_shop_slider_main_only && is_shop() ) {
                	$show_page_title = 0;
                }

                if ( isset( $fancy_title_image ) && isset( $fancy_title_image['url'] ) ) {
                    $fancy_title_image_url = $fancy_title_image['url'];
                }

                if ( is_product_category() ) {
                	$category = $wp_query->get_queried_object();
                	$hero_id = get_term_meta( $category->term_id, 'hero_id', true  );
                	if ( $hero_id != "" && $hero_id != 0 ) {
                		$fancy_title_image_url = wp_get_attachment_url($hero_id, 'full');
                		$fancy_title_image_meta = wp_get_attachment_metadata( $hero_id );
                		$heading_img_width = isset($fancy_title_image_meta['width']) ? $fancy_title_image_meta['width'] : 0;
                		$heading_img_height = isset($fancy_title_image_meta['height']) ? $fancy_title_image_meta['height'] : 0;
                	}
                	if ( $fancy_title_image_url != '' ) {
                		//$page_title_style = "fancy";
                	}
                	if ( atelier_theme_supports( 'page-heading-woo-description' ) ) {
                		if ( $page_title_height == 300 ) {
                			$page_title_height = 400;
                		}
                		$woo_category_desc = atelier_woocommerceget_product_category_description( $category, true );
                	}
                }
            }
            if ( function_exists( 'is_product' ) && is_product() && atelier_theme_opts_name( 'sf_atelier_options' ) ) {
                $product_layout = atelier_get_post_meta( $post->ID, 'sf_product_layout', true );
                $default_product_product_layout = "standard";
                if ( isset( $atelier_options['default_product_product_layout'] ) ) {
                	$default_product_product_layout = $atelier_options['default_product_product_layout'];
                }
                if ( $product_layout == "" ) {
                	$product_layout = $default_product_product_layout;
                }
                if ( $product_layout == "fw-split" ) {
                    return;
                }
            }
            
            // Page Title Style Filter
            $page_title_style = apply_filters( 'atelier_page_title_style', $page_title_style );

            // Page Title
            if ( $page_title == "" ) {
                $page_title = get_the_title();
            }
            if ( $page_title_height == "" ) {
                $page_title_height = apply_filters( 'atelier_shop_fancy_page_height', 300 );
            }

            // Fancy heading image
            if ( ( $page_title_style == "fancy" || $page_title_style == "fancy-tabbed" ) && $fancy_title_image_url == "" && $fancy_title_image ) {
                foreach ( $fancy_title_image as $detail_image ) {
                    if ( isset( $detail_image['url'] ) ) {
                        $fancy_title_image_url = $detail_image['url'];
                        $heading_img_width = isset($detail_image['width']) ? $detail_image['width'] : 0;
                        $heading_img_height = isset($detail_image['height']) ? $detail_image['height'] : 0;
                        break;
                    }
                }
                if ( ! $fancy_title_image ) {
                    $fancy_title_image     = get_post_thumbnail_id();
                    $fancy_title_image_url = wp_get_attachment_url( $fancy_title_image, 'full' );
                    $fancy_title_image_meta = wp_get_attachment_metadata( $fancy_title_image );
                    $heading_img_width = isset($fancy_title_image_meta['width']) ? $fancy_title_image_meta['width'] : 0;
                    $heading_img_height = isset($fancy_title_image_meta['height']) ? $fancy_title_image_meta['height'] : 0;
                }
            }

            // Page Title Hidden
            if ( ! $show_page_title ) {
                $page_heading_el_class = "page-heading-hidden";
                $page_heading_wrap_el_class = "page-heading-wrap-hidden";
            }

            // Breadcrumb in heading
            if ( $breadcrumb_in_heading ) {
            	$page_heading_el_class .= " page-heading-breadcrumbs";
            }

            if ( $page_title_style == "fancy-tabbed" ) {
            	$page_title_text_align = "left";
            }
            
            // Hero styles output
            $hero_styles = array();
            
            // Fixed height, no animation
            if ( $hero_heading_fixed_height ) {
                $page_heading_el_class .= " fixed-height";
                $page_title_height = $page_title_height != "" ? $page_title_height : "400";
            	$hero_styles[] = 'height: '.$page_title_height.'px;';
            }

            // Return if product & inner heading
            if ( function_exists( 'is_product' ) && is_product() && atelier_theme_supports( 'product-inner-heading' ) && ( $page_title_style == "standard" || $page_title_style == "" ) ) {
            	return;
            }

            // Dont' allow fancy-tabbed on product pages
            if ( function_exists( 'is_product' ) && is_product() && atelier_theme_supports( 'product-inner-heading' ) && $page_title_style == "fancy-tabbed" ) {
            	$page_title_style = "fancy";
            }

            if ( $page_title_style == "fancy" && atelier_theme_opts_name() == "sf_atelier_options" && !(function_exists( 'is_product' ) && is_product()) ) {
	            $extra_styles = 'height: ' . $page_title_height . 'px;';
            }
            
			// Default hero image
			if ( isset( $atelier_options['default_page_heading_image'] ) ) {
				$fancy_title_image     = $atelier_options['default_page_heading_image'];
			}           

            if ( $fancy_title_image_url == "" && isset( $fancy_title_image ) && isset( $fancy_title_image['url'] ) ) {
                $fancy_title_image_url = $fancy_title_image['url'];
            }
            
            if ( $fancy_title_image_url != "" ) {
            	$hero_styles[] = "background-image: url(" . esc_url($fancy_title_image_url) . ");";
            }

            $fancy_title_image_url = apply_filters('atelier_hero_title_image_url', $fancy_title_image_url);

            if ( isset($atelier_options['minimal_checkout']) ) {
				if ( function_exists('is_checkout') && is_checkout() ) {
					global $woocommerce;
		        	if ( $atelier_options['minimal_checkout'] ) { ?>
						
		            	<div class="minimal-checkout-return container">
		            		<?php echo atelier_logo( 'logo-left checkout-logo', 'logo' ); ?>
		            		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>"><?php _e("Return to cart", 'atelier'); ?></a>
		            	</div>

		        	<?php }
            	}
        	}

            if ( ! is_home() ) {
                ?>
                <?php if ( $page_title_style == "fancy" || $page_title_style == "fancy-tabbed" ) { ?>

                    <div class="fancy-heading-wrap <?php echo esc_attr($page_heading_wrap_el_class); ?> <?php echo esc_attr($page_title_style); ?>-style">

                    <?php if ( $fancy_title_image_url != ""  ) { ?>
                        <div class="page-heading fancy-heading <?php echo esc_attr($page_heading_el_class); ?> clearfix <?php echo esc_attr($page_title_text_style); ?>-style fancy-image <?php echo esc_attr($page_heading_el_class); ?>" style="<?php echo implode('', $hero_styles); ?>" data-height="<?php echo esc_attr($page_title_height); ?>" data-img-width="<?php echo esc_attr($heading_img_width); ?>" data-img-height="<?php echo esc_attr($heading_img_height); ?>">
                        	<span class="media-overlay"></span>

                    <?php } else { ?>
                        <div class="page-heading fancy-heading <?php echo esc_attr($page_heading_el_class); ?> clearfix" data-height="<?php echo esc_attr($page_title_height); ?>">
                    <?php } ?>

                    <?php if ( $page_title_style == "fancy" && $page_design_style == "hero-content-split" ) {
                    	atelier_post_split_heading_buttons();
                    } ?>

                    <?php if ( $page_title_style == "fancy-tabbed" ) { ?>
                    <div class="tabbed-heading-wrap">
                    <?php } ?>

                    <div class="heading-text container" data-textalign="<?php echo esc_attr($page_title_text_align); ?>">
                        <?php if ( atelier_woocommerce_activated() && is_woocommerce() ) { ?>

                            <?php if ( is_product() ) { ?>

                                <h1 class="entry-title"><?php echo esc_html($page_title); ?></h1>

                            <?php } else { ?>

                                <h1 class="entry-title"><?php woocommerce_page_title(); ?></h1>

                            <?php } ?>
						
						<?php } else if ( is_search() ) {
						
                            $count     = $wp_query->found_posts;
                            
                            if ( $count == 1 ) : ?>
                                <?php printf( __( '<h1 class="entry-title" %1$s>%2$s result for <span>%3$s</span></h1>', 'atelier' ), $article_heading_text, $count, get_search_query() ); ?>
                            <?php else : ?>
                                <?php printf( __( '<h1 class="entry-title" %1$s>%2$s results for <span>%3$s</span></h1>', 'atelier' ), $article_heading_text, $count, get_search_query() ); ?>
                            <?php endif; ?>
                        
                        <?php } else if ( is_category() ) { ?>
                        
                            <h1 class="entry-title"><?php single_cat_title(); ?></h1>
						
						<?php } else if ( is_tax() ) {	
							global $wp_query;
							$term = $wp_query->get_queried_object();
						?>
							<h1 class="entry-title"><?php echo esc_html($term->name); ?></h1>
							
                        <?php } else if ( is_archive() ) { ?>

                            <?php /* If this is a tag archive */
                            if ( is_tag() ) { ?>
                                <h1 class="entry-title"><?php _e( "Posts tagged with", 'atelier' ); ?>
                                    &#8216;<?php single_tag_title(); ?>&#8217;</h1>
                                <?php /* If this is a daily archive */
                            } elseif ( is_day() ) { ?>
                                <h1 class="entry-title"><?php _e( "Archive for", 'atelier' ); ?> <?php the_time( 'F jS, Y' ); ?></h1>
                                <?php /* If this is a monthly archive */
                            } elseif ( is_month() ) { ?>
                                <h1 class="entry-title"><?php _e( "Archive for", 'atelier' ); ?> <?php the_time( 'F, Y' ); ?></h1>
                                <?php /* If this is a yearly archive */
                            } elseif ( is_year() ) { ?>
                                <h1 class="entry-title"><?php _e( "Archive for", 'atelier' ); ?> <?php the_time( 'Y' ); ?></h1>
                                <?php /* If this is an author archive */
                            } elseif ( is_author() ) { ?>
                                <?php $author = get_userdata( get_query_var( 'author' ) ); ?>
                                <?php if ( class_exists( 'ATCF_Campaigns' ) ) { ?>
                                    <h1 class="entry-title"><?php _e( "Projects by", 'atelier' ); ?> <?php echo esc_attr($author->display_name); ?></h1>
                                <?php } else { ?>
                                    <h1 class="entry-title"><?php _e( "Author archive for", 'atelier' ); ?> <?php echo esc_attr($author->display_name); ?></h1>
                                <?php } ?>
                                <?php /* If this is a paged archive */
                            } elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) { ?>
                                <h1 class="entry-title"><?php _e( "Blog Archives", 'atelier' ); ?></h1>
                            <?php } else { ?>
                                <h1 class="entry-title"><?php post_type_archive_title(); ?></h1>
                            <?php } ?>

                        <?php } else if ( is_404() ) { ?>

                            <h1 class="entry-title"><?php _e( "404", 'atelier' ); ?></h1>
						
						<?php } else if ( is_home() && get_option('page_for_posts') ) { ?>
						
						     <h1 class="entry-title"><?php echo apply_filters('the_title',get_page( get_option('page_for_posts') )->post_title); ?></h1>
                        
                        <?php } else if ( function_exists('is_account_page') && is_account_page() ) {
                                    $endpoint       = WC()->query->get_current_endpoint();
                                    $endpoint_title = WC()->query->get_endpoint_title( $endpoint );
                                    if ($endpoint_title == "") {
                                        $endpoint_title = $page_title;
                                    }
                                ?>

                                <h1 class="entry-title"><?php echo esc_html($endpoint_title); ?></h1>

                        <?php } else { ?>

                            <h1 class="entry-title"><?php echo esc_html($page_title); ?></h1>

                        <?php } ?>

                        <?php if ( $page_subtitle ) { ?>
                            <h3><?php echo esc_html($page_subtitle); ?></h3>
                        <?php } ?>
                        
                        <?php if ( $woo_category_desc != "" ) { ?>
                        	<div class="category-desc"><?php echo atelier_woocommerceget_product_category_description( $category, true ); ?></div>
                        <?php } ?>
               

						<?php if ( !$remove_breadcrumbs && $breadcrumb_in_heading ) {
							echo atelier_breadcrumbs( true );
						} ?>

                        <?php if ( is_singular( 'portfolio' ) && ! ( atelier_theme_opts_name() == "atelier_joyn_options" && $pagination_style == "fs-arrow" ) ) { ?>
                            <div
                                class="prev-item"><?php next_post_link( '%link', $prev_icon, $enable_category_navigation, '', 'portfolio-category' ); ?></div>
                            <div
                                class="next-item"><?php previous_post_link( '%link', $next_icon, $enable_category_navigation, '', 'portfolio-category' ); ?></div>
                        <?php } ?>

                        <?php if ( is_singular( 'galleries' ) && ! ( atelier_theme_opts_name() == "atelier_joyn_options" && $pagination_style == "fs-arrow" ) ) { ?>
                            <div
                                class="prev-item"><?php next_post_link( '%link', $prev_icon, false, '', 'gallery-category' ); ?></div>
                            <div
                                class="next-item"><?php previous_post_link( '%link', $next_icon, false, '', 'gallery-category' ); ?></div>
                        <?php } ?>

                    </div>

                    <?php if ( $page_title_style == "fancy-tabbed" ) { ?>
                    </div>
                    <?php } ?>

					<?php if ($page_title_overlay_effect != "" && $page_title_overlay_effect != "none") { ?>

						<div class="sf-canvas-effect" data-type="<?php echo esc_attr($page_title_overlay_effect); ?>">
							<canvas id="page-heading-canvas" data-canvas_id="page-heading-canvas"></canvas>
						</div>

					<?php } ?>

                    </div>

                    </div>

                <?php } else { ?>

                    <?php if ( $show_page_title == 2 ) { ?>
                        <div class="page-heading ph-sort clearfix">
                    <?php } else { ?>
                        <div class="page-heading <?php echo esc_attr($page_heading_el_class); ?> clearfix">
                    <?php } ?>
                    <div class="container">
                    	
                    	<?php if ( is_singular( 'portfolio' ) && atelier_theme_opts_name() == "sf_atelier_options" ) {
                    			$portfolio_page = __($atelier_options['portfolio_page'], 'atelier');
                                $portfolio_page = apply_filters('wpml_object_id', $portfolio_page, 'page', true);
                    		?>                    			
                			<div class="post-nav">
                				<?php if ( isset($portfolio_page) ) { ?>
                				<div class="view-all"><a href="<?php echo get_permalink($portfolio_page); ?>"><?php echo apply_filters( 'atelier_index_icon', '<i class="sf-icon-portfolio"></i>' ); ?></a></div>
                				<div class="divide"></div>
                				<?php } ?>
                				<div class="prev-item"><?php next_post_link( '%link', $prev_icon, $enable_category_navigation, '', 'portfolio-category' ); ?></div>
                				<div class="next-item"><?php previous_post_link( '%link', $next_icon, $enable_category_navigation, '', 'portfolio-category' ); ?></div>		
                			</div>
                    	<?php } ?>
                    	
                        <div class="heading-text" data-textalign="<?php echo esc_attr($page_title_text_align); ?>">

                            <?php if ( atelier_woocommerce_activated() && is_woocommerce() ) { ?>

                                <?php if ( is_product() ) { ?>

                                    <h1 class="entry-title"><?php echo esc_html($page_title); ?></h1>

                                <?php } else { ?>

                                    <h1 class="entry-title"><?php woocommerce_page_title(); ?></h1>

                                <?php } ?>

                            <?php } else if ( is_search() ) { ?>

                                <?php
                                global $wp_query;
                                $count     = $wp_query->found_posts; ?>
                                <?php if ( $count == 1 ) : ?>
                                    <?php printf( __( '<h1>%1$s result for <span>%2$s</span></h1>', 'atelier' ), $count, get_search_query() ); ?>
                                <?php else : ?>
                                    <?php printf( __( '<h1>%1$s results for <span>%2$s</span></h1>', 'atelier' ), $count, get_search_query() ); ?>
                                <?php endif; ?>

                            <?php } else if ( is_category() ) { ?>

                                <h1><?php single_cat_title(); ?></h1>
							
							<?php } else if ( is_tax() ) {	
								global $wp_query;
								$term = $wp_query->get_queried_object();
							?>
								<h1><?php echo esc_html($term->name); ?></h1>
								
                            <?php } else if ( is_archive() ) { ?>

                                <?php /* If this is a tag archive */
                                if ( is_tag() ) { ?>
                                    <h1><?php _e( "Posts tagged with", 'atelier' ); ?>
                                        &#8216;<?php single_tag_title(); ?>&#8217;</h1>
                                    <?php /* If this is a daily archive */
                                } elseif ( is_day() ) { ?>
                                    <h1><?php _e( "Archive for", 'atelier' ); ?> <?php the_time( 'F jS, Y' ); ?></h1>
                                    <?php /* If this is a monthly archive */
                                } elseif ( is_month() ) { ?>
                                    <h1><?php _e( "Archive for", 'atelier' ); ?> <?php the_time( 'F, Y' ); ?></h1>
                                    <?php /* If this is a yearly archive */
                                } elseif ( is_year() ) { ?>
                                    <h1><?php _e( "Archive for", 'atelier' ); ?> <?php the_time( 'Y' ); ?></h1>
                                    <?php /* If this is an author archive */
                                } elseif ( is_author() ) { ?>
                                    <?php $author = get_userdata( get_query_var( 'author' ) ); ?>
                                    <?php if ( class_exists( 'ATCF_Campaigns' ) ) { ?>
                                        <h1><?php _e( "Projects by", 'atelier' ); ?> <?php echo esc_attr($author->display_name); ?></h1>
                                    <?php } else { ?>
                                        <h1><?php _e( "Author archive for", 'atelier' ); ?> <?php echo esc_attr($author->display_name); ?></h1>
                                    <?php } ?>
                                    <?php /* If this is a paged archive */
                                } elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) { ?>
                                    <h1><?php _e( "Blog Archives", 'atelier' ); ?></h1>
                                <?php } else { ?>
                                    <h1><?php post_type_archive_title(); ?></h1>
                                <?php } ?>

                            <?php } else if ( is_404() ) { ?>

                                <h1 class="entry-title"><?php _e( "404", 'atelier' ); ?></h1>
							
							<?php } else if ( is_home() && get_option('page_for_posts') ) { ?>
							
							     <h1 class="entry-title"><?php echo apply_filters('the_title',get_page( get_option('page_for_posts') )->post_title); ?></h1>
				            
                            <?php } else if ( function_exists('is_account_page') && is_account_page() ) {
                                    $endpoint       = WC()->query->get_current_endpoint();
                                    $endpoint_title = WC()->query->get_endpoint_title( $endpoint );
                                    if ($endpoint_title == "") {
                                        $endpoint_title = $page_title;
                                    }
                                ?>

                                <h1 class="entry-title"><?php echo $endpoint_title; ?></h1>

                            <?php } else { ?>

                                <h1 class="entry-title"><?php echo esc_html($page_title); ?></h1>

                            <?php } ?>

                        </div>

                        <?php if ( is_singular( 'portfolio' ) && ! ( atelier_theme_opts_name() == "sf_joyn_options" && $pagination_style == "fs-arrow" ) && atelier_theme_opts_name() != "sf_atelier_options" ) { ?>
	                    	<div class="next-item"><?php previous_post_link( '%link', $next_icon, $enable_category_navigation, '', 'portfolio-category' ); ?></div>
	                    	<?php if (atelier_theme_opts_name() == "sf_atelier_options" && isset($portfolio_page) ) { ?>
	                    		<div class="view-all"><a href="<?php echo get_permalink($portfolio_page); ?>"><?php echo apply_filters( 'atelier_index_icon', '<i class="sf-icon-portfolio"></i>' ); ?></a></div>
	                    	<?php } ?>
	                        <div class="prev-item"><?php next_post_link( '%link', $prev_icon, $enable_category_navigation, '', 'portfolio-category' ); ?></div>
                        <?php } ?>

                        <?php if ( is_singular( 'galleries' ) && ! ( atelier_theme_opts_name() == "sf_joyn_options" && $pagination_style == "fs-arrow" ) ) { ?>
                            <div class="next-item"><?php previous_post_link( '%link', $next_icon, false, '', 'gallery-category' ); ?></div>
                            <div class="prev-item"><?php next_post_link( '%link', $prev_icon, false, '', 'gallery-category' ); ?></div>
                        <?php } ?>

						<?php if ( !$remove_breadcrumbs && $breadcrumb_in_heading ) {
							echo atelier_breadcrumbs( true );
						} ?>

                        <?php if ( $shop_page && atelier_theme_supports( 'page-heading-woocommerce' ) ) {
                            woocommerce_catalog_ordering();
                            woocommerce_result_count();
                        } ?>

                    </div>
                </div>
                <?php
                }
            }
        }

        add_action( 'atelier_main_container_start', 'atelier_page_heading', 20 );
    }


    /* POST SPLIT CONTENT HEADING BUTTONS
    ================================================== */
    if ( ! function_exists( 'atelier_post_split_heading_buttons' ) ) {
        function atelier_post_split_heading_buttons() {
        	global $atelier_options, $atelier_sidebar_config;

        	$blog_page   = __( $atelier_options['blog_page'], 'atelier' );
            $blog_page = apply_filters('wpml_object_id', $blog_page, 'page', true);
    	    $prev_post = get_next_post();
    	    $next_post = get_previous_post();
    	    $has_both  = false;

    	    if ( ! empty( $next_post ) && ! empty( $prev_post ) ) {
    	        $has_both = true;
    	    }
    	    ?>

    	    <?php if ( $blog_page != "" ) { ?>
    	    	<div class="blog-button">
	    	        <a class="sf-button medium white rounded bordered" href="<?php echo get_permalink( $blog_page ); ?>">
	    	        	<i class="fas fa-long-arrow-left"></i>
	    	        	<span class="text"><?php _e( "View all posts", 'atelier' ); ?></span>
	    	        </a>
	    	    </div>
    	    <?php } ?>

    	    <?php if ( ! empty( $next_post ) || ! empty( $prev_post )) { ?>
    	    <?php if ($has_both) { ?>
    	    <div class="post-pagination prev-next">
    	    <?php } else { ?>
    	    <div class="post-pagination">
    	        <?php } ?>

	            <?php if ( ! empty( $next_post ) ) {
	                $author_id       = $next_post->post_author;
	                $author_name     = get_the_author_meta( 'display_name', $author_id );
	                $author_url      = get_author_posts_url( $author_id );
	                $post_date       = get_the_date();
	                $post_date_str   = get_the_date('Y-m-d');
	                $post_categories = get_the_category_list( ', ', '', $next_post->ID );
	                ?>
	                <a class="next-article" href="<?php echo get_permalink( $next_post->ID ); ?>">
	                    <h4><?php _e( "Older", 'atelier' ); ?></h4>
	                    <h3><?php echo esc_attr($next_post->post_title); ?></h3>
	                </a>
	            <?php } ?>

	            <?php if ( ! empty( $prev_post ) ) {
	                $author_id       = $prev_post->post_author;
	                $author_name     = get_the_author_meta( 'display_name', $author_id );
	                $author_url      = get_author_posts_url( $author_id );
	                $post_date       = get_the_date();
	                $post_date_str   = get_the_date('Y-m-d');
	                $post_categories = get_the_category_list( ', ', '', $prev_post->ID );
	                ?>
	                <a class="prev-article" href="<?php echo get_permalink( $prev_post->ID ); ?>">
	                    <h4><?php _e( "Newer", 'atelier' ); ?></h4>
	                    <h3><?php echo esc_attr($prev_post->post_title); ?></h3>
	                </a>
	            <?php } ?>

    	    </div>

      	<?php }
        }
    }
?>