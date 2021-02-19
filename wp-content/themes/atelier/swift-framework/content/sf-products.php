<?php

    /*
    *
    *	Swift Page Builder - Products Function Class
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	atelier_mini_product_items()
    *	atelier_product_items()
    *
    */

    /* MINI PRODUCTS
    ================================================== */
    if ( ! function_exists( 'atelier_mini_product_items' ) ) {
        function atelier_mini_product_items( $asset_type, $category, $item_count, $sidebar_config, $width ) {

            global $woocommerce, $atelier_catalog_mode;

            $product_list_output = $image = "";
            $args                = array();

            // ARRAY ARGUMENTS
            if ( $asset_type == "latest-products" ) {
                $args = array(
                	'post_type'           => 'product',
                	'post_status'         => 'publish',
                	'product_cat'         => $category,
                	'ignore_sticky_posts' => 1,
                	'posts_per_page'      => $item_count,
                	'meta_query'          => WC()->query->get_meta_query(),
                	'tax_query'           => WC()->query->get_tax_query(),
                );
            } else if ( $asset_type == "featured-products" ) {
                $meta_query  = WC()->query->get_meta_query();
                $tax_query   = WC()->query->get_tax_query();
                $tax_query[] = array(
                	'taxonomy' => 'product_visibility',
                	'field'    => 'name',
                	'terms'    => 'featured',
                	'operator' => 'IN',
                );
                $args = array(
                    'post_type'           => 'product',
                    'post_status'         => 'publish',
                    'product_cat'         => $category,
                    'ignore_sticky_posts' => 1,
                    'posts_per_page'      => $item_count,
                    'meta_query'          => $meta_query,
                    'tax_query'           => $tax_query,
                );
            } else if ( $asset_type == "top-rated" ) {
                $args = array(
                	'posts_per_page' => $item_count,
                	'product_cat' => $category,
                	'no_found_rows'  => 1,
                	'post_status'    => 'publish',
                	'post_type'      => 'product',
                	'meta_key'       => '_wc_average_rating',
                	'orderby'        => 'meta_value_num',
                	'order'          => 'DESC',
                	'meta_query'     => WC()->query->get_meta_query(),
                	'tax_query'      => WC()->query->get_tax_query(),
                );
            } else if ( $asset_type == "recently-viewed" ) {

                // Get recently viewed product cookies data
                $viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
                $viewed_products = array_filter( array_map( 'absint', $viewed_products ) );

                // If no data, quit
                if ( empty( $viewed_products ) ) {
                    return '<p class="no-products">' . __( "You haven't viewed any products yet.", 'atelier' ) . '</p>';
                }

                // Create query arguments array
                $args = array(
                    'post_type'           => 'product',
                    'post_status'         => 'publish',
                    'product_cat'         => $category,
                    'ignore_sticky_posts' => 1,
                    'posts_per_page'      => $item_count,
                    'no_found_rows'       => 1,
                    'post__in'            => $viewed_products,
                    'orderby'             => 'rand'
                );

                // Add meta_query to query args
                //$args['meta_query'] = array();

                // Check products stock status
                //$args['meta_query'][] = $woocommerce->query->stock_status_meta_query();

            } else if ( $asset_type == "sale-products" ) {
                $args = array(
                	'posts_per_page' => $item_count,
    				'no_found_rows'  => 1,
    				'post_status'    => 'publish',
    				'post_type'      => 'product',
    				'product_cat'    => $category,
    				'meta_query'     => WC()->query->get_meta_query(),
    				'tax_query'      => WC()->query->get_tax_query(),
    				'post__in'       => array_merge( array( 0 ), wc_get_product_ids_on_sale() ),
                );
            } else {
                $args = array(
                	'post_type'           => 'product',
                	'post_status'         => 'publish',
                	'ignore_sticky_posts' => 1,
                	'posts_per_page'      => $item_count,
                	'meta_key'            => 'total_sales',
                	'orderby'             => 'meta_value_num',
                	'meta_query'          => WC()->query->get_meta_query(),
                	'tax_query'           => WC()->query->get_tax_query(),
                	'product_cat' 		  => $category,
                );
            }

            // OUTPUT PRODUCTS
            $products = new WP_Query( $args );

            if ( $products->have_posts() ) {

                $product_list_output .= '<ul class="mini-list mini-' . $asset_type . '">';

                while ( $products->have_posts() ) : $products->the_post();

                    $product_output = $rating_output = "";

                    global $product, $post, $wpdb, $woocommerce_loop;

                    if ( has_post_thumbnail() ) {
                        $image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
                        $image_alt   = esc_attr( atelier_get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) );
                        $image_link  = wp_get_attachment_url( get_post_thumbnail_id() );

                        if ( $image_link == "" ) {
                            $image_link = "default";
                        }

                        $image = atelier_aq_resize( $image_link, 70, 70, true, false );

                        if ( $image ) {
                            $image_html = '<img itemprop="image" src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" title="' . $image_title . '" alt="' . $image_alt . '" />';
                        }
                    }

                    if ( comments_open() ) {

                        $count = $wpdb->get_var( "
		           		    SELECT COUNT(meta_value) FROM $wpdb->commentmeta
		           		    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		           		    WHERE meta_key = 'rating'
		           		    AND comment_post_ID = $post->ID
		           		    AND comment_approved = '1'
		           		    AND meta_value > 0
		           		" );

                        $rating = $wpdb->get_var( "
		           	        SELECT SUM(meta_value) FROM $wpdb->commentmeta
		           	        LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
		           	        WHERE meta_key = 'rating'
		           	        AND comment_post_ID = $post->ID
		           	        AND comment_approved = '1'
		           	    " );

                        if ( $count > 0 ) {

                            $average       = number_format( $rating / $count, 2 );
                            $rating_output = '<div class="star-rating" title="' . sprintf( __( 'Rated %s out of 5', 'atelier' ), $average ) . '" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating"><span style="width:' . ( $average * 16 ) . 'px"><span itemprop="ratingValue" class="rating">' . $average . '</span> ' . __( 'out of 5', 'atelier' ) . '</span></div>';

                        }
                    }

                    $product_output .= '<li class="clearfix" itemscope itemtype="http://schema.org/Product">';

                    if ( $image ) {
                        $product_output .= '<figure>';
                        $product_output .= '<a href="' . get_permalink( $post->ID ) . '">';
                        $product_output .= $image_html;
                        $product_output .= '</a>';
                        $product_output .= '</figure>';
                    }
                    $product_output .= '<div class="product-details">';
                    $product_output .= '<h5 itemprop="name"><a href="' . get_permalink( $post->ID ) . '">' . get_the_title() . '</a></h5>';

                    if ( $asset_type == "top-rated" ) {

                        $product_output .= $rating_output;

                    } else {
                        if ( function_exists('wc_get_product_category_list') ) {
                        	$product_id = method_exists( $product, 'get_id' ) ? $product->get_id() : $product->id;
                        	$product_output .= wc_get_product_category_list( $product_id, ', ', '<span class="posted_in">', '</span>' ); 
                        } else {
                        	$product_output .= $product->get_categories( ', ', '<span class="product-cats">', '</span>' );
						}
                    }
                    if ( ! $atelier_catalog_mode ) {
                        $product_output .= '<span class="price" itemprop="price">' . $product->get_price_html() . '</span>';
                    }
                    $product_output .= '</div>';
                    $product_output .= '</li>';

                    $product_list_output .= $product_output;

                endwhile;

                wp_reset_query();
                wp_reset_postdata();
                woocommerce_reset_loop();

                $product_list_output .= '</ul>';

                return $product_list_output;
            }

        }
    }


    /* STANDARD PRODUCTS
    ================================================== */
    if ( ! function_exists( 'atelier_product_items' ) ) {
        function atelier_product_items( $atts ) {

			extract( shortcode_atts( array(
			    'title'          => '',
			    'asset_type'     => '',
			    'category'       => '',
			    'products'		 => '',
			    'display_layout' => '',
			    'display_type'	 => '',
			    'carousel'       => '',
			    'multi_masonry'	 => '',
			    'fullwidth'      => '',
			    'gutters'        => '',
			    'columns'        => '',
			    'item_count'     => '',
			    'order_by'		 => '',
			    'order'			 => '',
			    'button_enabled' => '',
			    'width'          => '',
			), $atts ) );
			
            global $woocommerce, $woocommerce_loop, $atelier_sidebar_config, $sf_carouselID, $atelier_options, $atelier_product_multimasonry, $atelier_product_display_layout;

            if ( $sf_carouselID == "" ) {
                $sf_carouselID = 1;
            } else {
                $sf_carouselID ++;
            }

            if ( is_singular( 'portfolio' ) ) {
                $atelier_sidebar_config = "no-sidebars";
            }

            $list_class           = "";
            $product_display_type = $atelier_options['product_display_type'];

            if ( $display_type != "" ) {
            	$product_display_type = $display_type;
            }

            if ( $fullwidth == "yes" ) {
                $list_class .= 'products-full-width ';
            }
            if ( $gutters == "no" || $product_display_type == "gallery-bordered" ) {
                $list_class .= 'no-gutters ';
            }
			if ( $multi_masonry == "yes" && $product_display_type != "preview-slider" && $asset_type != "categories" ) {
				$carousel = "no";
				$list_class .= 'multi-masonry-items ';
				$atelier_product_multimasonry = true;
			} else {
				$atelier_product_multimasonry = false;
			}
			
			if ( $display_layout != '' ) {
				$atelier_product_display_layout = $display_layout;
			}

            if ( $carousel == "no" && $multi_masonry == "no" ) {
                $list_class .= 'product-grid ';
            }

            $list_class .= 'product-type-' . $product_display_type . ' ';

			$woocommerce_loop['style-override'] = $product_display_type;

            // Set Columns
            $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', intval( $columns ) );
            
			$args = array();

            // CATEGORY ASSET OUTPUT
        	if ($asset_type == "categories") {

        		$hide_empty = 1;
				$category_id = '';
				$ids = array();
				
				if ( $category != "" ) {
					$category = str_replace( "0,", "", $category );		
					$categories = explode( ',', $category );			
	       			foreach ($categories as $term) {
	       				$category_term = get_term_by('slug', $term, 'product_cat');
                        if ( isset($category_term->term_id) ) {
    	       				$category_id = $category_term->term_id;
    	       				array_push($ids, $category_id);
                        }
        			}
        		}
        		        		
        		$args = array(
        			'hide_empty' => $hide_empty,
        			'pad_counts' => true,
        			'include'    => $ids,
        			'orderby'    => $order_by,
        			'order'		 => $order
        		);

        		$product_categories = get_terms( 'product_cat', $args );

        		if ( $hide_empty ) {
        			foreach ( $product_categories as $key => $category ) {
        				if ( $category->count == 0 ) {
        					unset( $product_categories[ $key ] );
        				}
        			}
        		}

        		if ( $item_count ) {
        			$product_categories = array_slice( $product_categories, 0, $item_count );
        		}

        		ob_start();

        		if ( $product_categories ) {

        			if ( $carousel == "yes" ) { ?>

	                    <div class="product-carousel carousel-wrap <?php echo esc_attr($list_class); ?>">

	                        <ul class="products list-<?php echo esc_attr($asset_type); ?> carousel-items gutters" id="carousel-<?php echo esc_attr($sf_carouselID); ?>" data-columns="<?php echo esc_attr($columns); ?>">

	                            <?php

                    			foreach ( $product_categories as $category ) {

                    				wc_get_template( 'content-product_cat.php', array(
                    					'category' => $category
                    				) );

                    			}

								?>

	                        </ul>

	                        <?php if ( atelier_theme_opts_name() != "sf_atelier_options" ) { ?>

	                        <a href="#" class="carousel-prev"><?php echo apply_filters( 'atelier_carousel_prev_icon', '<i class="ss-navigateleft"></i>' ); ?></a>
	                        <a href="#" class="carousel-next"><?php echo apply_filters( 'atelier_carousel_next_icon', '<i class="ss-navigateright"></i>' ); ?></a>

							<?php } ?>

	                    </div>

	                <?php } else { ?>

	                    <ul class="products list-<?php echo esc_attr($asset_type); ?> row <?php echo esc_attr($list_class); ?>">

	                        <?php

                    			foreach ( $product_categories as $category ) {

                    				wc_get_template( 'content-product_cat.php', array(
                    					'category' => $category
                    				) );

                    			}

                    		?>

	                    </ul>

	                <?php }

        		}

        		woocommerce_reset_loop();
        		$product_list_output = ob_get_contents();
        		ob_end_clean();

        		wp_reset_query();
        		wp_reset_postdata();

        		return $product_list_output;
        	}

            // ARRAY ARGUMENTS
            if ( $asset_type == "latest-products" ) {
            	$args = array(
    				'post_type'           => 'product',
    				'post_status'         => 'publish',
    				'product_cat'         => $category,
    				'ignore_sticky_posts' => 1,
    				'posts_per_page'      => $item_count,
    				'orderby'             => $order_by,
    				'order'				  => $order,
    				'meta_query'          => WC()->query->get_meta_query(),
    				'tax_query'           => WC()->query->get_tax_query(),
    			);
            } else if ( $asset_type == "featured-products" ) {
                $meta_query  = WC()->query->get_meta_query();
                $tax_query   = WC()->query->get_tax_query();
                $tax_query[] = array(
                	'taxonomy' => 'product_visibility',
                	'field'    => 'name',
                	'terms'    => 'featured',
                	'operator' => 'IN',
                );
                $args = array(
                    'post_type'           => 'product',
                    'post_status'         => 'publish',
                    'product_cat'         => $category,
                    'ignore_sticky_posts' => 1,
                    'posts_per_page'      => $item_count,
                    'orderby'             => $order_by,
                    'order'				  => $order,
                    'meta_query'          => $meta_query,
                    'tax_query'           => $tax_query,
                );
            } else if ( $asset_type == "top-rated" ) {
                $args = array(
                	'posts_per_page' => $item_count,
                	'product_cat' => $category,
                	'no_found_rows'  => 1,
                	'post_status'    => 'publish',
                	'post_type'      => 'product',
                	'meta_key'       => '_wc_average_rating',
                	'orderby'        => 'meta_value_num',
                	'order'          => 'DESC',
                	'meta_query'     => WC()->query->get_meta_query(),
                	'tax_query'      => WC()->query->get_tax_query(),
                );
            } else if ( $asset_type == "recently-viewed" ) {

                // Get recently viewed product cookies data
                $viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
                $viewed_products = array_filter( array_map( 'absint', $viewed_products ) );

                // If no data, quit
                if ( empty( $viewed_products ) ) {
                    return '<p class="no-products">' . __( "You haven't viewed any products yet.", 'atelier' ) . '</p>';
                }

                // Create query arguments array
                $args = array(
                    'post_type'           => 'product',
                    'post_status'         => 'publish',
                    'product_cat'         => $category,
                    'ignore_sticky_posts' => 1,
                    'posts_per_page'      => $item_count,
                    'no_found_rows'       => 1,
                    'post__in'            => $viewed_products,
                    'orderby'             => $order_by,
                    'order'				  => $order
                );

                // Add meta_query to query args
                //$args['meta_query'] = array();

                // Check products stock status
                //$args['meta_query'][] = $woocommerce->query->stock_status_meta_query();

            } else if ( $asset_type == "sale-products" ) {
            	
            	$args = array(
            		'posts_per_page' => $item_count,
            		'no_found_rows'  => 1,
            		'post_status'    => 'publish',
            		'post_type'      => 'product',
            		'product_cat'    => $category,
            		'orderby'        => $order_by,
            		'order'			 => $order,
            		'meta_query'     => WC()->query->get_meta_query(),
            		'tax_query'      => WC()->query->get_tax_query(),
            		'post__in'       => array_merge( array( 0 ), wc_get_product_ids_on_sale() ),
            	);
            	
            } else if ( $asset_type == "selected-products" ) {

				$product_ids = explode(',', $products);
	            $args = array(
	                'posts_per_page' => -1,
	                'no_found_rows'  => 1,
	                'post_status'    => 'publish',
	                'post_type'      => 'product',
	                'orderby'        => $order_by,
	                'order'			 => $order,
	                'meta_query'     => WC()->query->get_meta_query(),
	                'tax_query'      => WC()->query->get_tax_query(),
	                'post__in'       => array_merge( array( 0 ), $product_ids )
	            );
            } else {
                $args = array(
                	'post_type'           => 'product',
                	'post_status'         => 'publish',
                	'ignore_sticky_posts' => 1,
                	'posts_per_page'      => $item_count,
                	'meta_key'            => 'total_sales',
                	'orderby'             => 'meta_value_num',
                	'meta_query'          => WC()->query->get_meta_query(),
                	'tax_query'           => WC()->query->get_tax_query(),
                	'product_cat' 		  => $category,
                );
            }

            ob_start();

            // OUTPUT PRODUCTS
            $products = new WP_Query( $args );

            if ( $products->have_posts() ) {
                ?>

                <?php if ( $carousel == "yes" ) { ?>

                    <div class="product-carousel carousel-wrap <?php echo esc_attr($list_class); ?>">

                        <ul class="products list-<?php echo esc_attr($asset_type); ?> carousel-items gutters" id="carousel-<?php echo esc_attr($sf_carouselID); ?>" data-columns="<?php echo esc_attr($columns); ?>">

                            <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                                <?php wc_get_template_part( 'content', 'product' ); ?>

                            <?php endwhile; // end of the loop. ?>

                        </ul>

                        <?php if ( atelier_theme_opts_name() != "sf_atelier_options" && atelier_theme_opts_name() != "sf_atelier_options" ) { ?>

                        <a href="#" class="carousel-prev"><?php echo apply_filters( 'atelier_carousel_prev_icon', '<i class="ss-navigateleft"></i>' ); ?></a>
                        <a href="#" class="carousel-next"><?php echo apply_filters( 'atelier_carousel_next_icon', '<i class="ss-navigateright"></i>' ); ?></a>

						<?php } ?>

                    </div>

                <?php } else { ?>

                    <ul class="products list-<?php echo esc_attr($asset_type); ?> row <?php echo esc_attr($list_class); ?>" data-columns="<?php echo esc_attr($columns); ?>">

                    	<?php if ( $multi_masonry == "yes" ) { ?>

                    		<div class="clearfix product col-sm-3 grid-sizer"></div>

                    	<?php } ?>

                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                            <?php wc_get_template_part( 'content', 'product' ); ?>

                        <?php endwhile; // end of the loop. ?>

                    </ul>

                <?php } ?>

            <?php
            }
			
			// Get contents and then clean output
            $product_list_output = ob_get_contents();
            ob_end_clean();
		
			// Reset query
            wp_reset_query();
            wp_reset_postdata();
            woocommerce_reset_loop();
			
			// Reset global
			$atelier_product_display_layout = "";
			
            return $product_list_output;

        }
    }
