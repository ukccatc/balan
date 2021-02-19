<?php
    /*
    *
    *	WooCommerce Functions & Hooks
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    */

    /* FILTER HOOKS
    ================================================== */
    /* Remove default content wrapper output */
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

    /* Remove default WooCommerce breadcrumbs */
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

    /* Move rating output */
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 15 );

    /* Remove default thumbnail output */
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

    /* Remove default sale flash output */
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

	/* Remove totals from cart collaterals */
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
	
	/* Remove default product item link */
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10 );
	remove_action( 'woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10 );
		
	/* Remove review meta */
	remove_action( 'woocommerce_review_meta', 'woocommerce_review_display_meta', 10 );

	/* WooCommerce Thumbnail Size */
	add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
		return array(
		'width' => 200,
		'height' => 200,
		'crop' => 0,
		);
	});


	/* OUTPUT PRODUCT BRAND DESCRIPTION
    ================================================== */
    if ( ! function_exists( 'atelier_woo_brand_description' ) ) {
		function atelier_woo_brand_description() {
	    	$queried_object = get_queried_object();
	    	if (isset($queried_object->taxonomy) && $queried_object->taxonomy == 'product_brand') {
	    		echo do_shortcode( wpautop( wptexturize( term_description() ) ) );
	    	}
	    }
	    add_action('woocommerce_archive_description', 'atelier_woo_brand_description', 10);
	}


	/* ADJUST VARIATION PLACEHOLDER
    ================================================== */
    if ( ! function_exists( 'atelier_woo_filter_dropdown_variation_args' ) ) {
		function atelier_woo_filter_dropdown_variation_args( $args ) {
			if ( isset( $args['attribute'] ) && function_exists('wc_attribute_label') && wc_attribute_label($args['attribute']) != "" ) {
				$dropdown_text = sprintf( __( 'Choose a %s', 'atelier' ), strtolower( wc_attribute_label($args['attribute']) ) );
			    $args['show_option_none'] = apply_filters( 'the_title', $dropdown_text );
			} else if ( isset( $args['attribute'] ) && isset( get_taxonomy( $args['attribute'] )->labels->singular_name ) ) {
				$dropdown_text = sprintf( __( 'Choose a %s', 'atelier' ), strtolower( get_taxonomy( $args['attribute'] )->labels->singular_name ) );
			    $args['show_option_none'] = apply_filters( 'the_title', $dropdown_text );
			} else {
				$dropdown_text = sprintf( __( 'Choose a %s', 'atelier' ), strtolower( $args['attribute'] ) );
			    $args['show_option_none'] = apply_filters( 'the_title', $dropdown_text );
			}

		    return $args;
		}
		add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'atelier_woo_filter_dropdown_variation_args', 10 );
	}
	
	

	/* ADJUST BREADCRUMB OUTPUT
    ================================================== */
    if ( ! function_exists( 'atelier_woocommercebreadcrumb_opts' ) ) {
		function atelier_woocommercebreadcrumb_opts() {

			return array(
				'delimiter'   => '<span class="seperator">></span>',
				'wrap_before' => '<nav class="woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
				'wrap_after'  => '</nav>',
				'before'      => '',
				'after'       => '',
				'home'        => _x( 'Home', 'breadcrumb', 'atelier' )
			);

		}
		add_filter( 'woocommerce_breadcrumb_defaults' , 'atelier_woocommercebreadcrumb_opts' );
	}
	
	/* DISABLE PRODUCT SLIDER
	================================================== */
	if ( ! function_exists( 'atelier_woocommercedisable_slider' ) ) {
		function atelier_woocommercedisable_slider() {
			global $atelier_options;
			$disable_product_slider = false;
			if ( isset( $atelier_options['disable_product_slider'] ) ) {
				$disable_product_slider = $atelier_options['disable_product_slider'];
			}
			
			if ( $disable_product_slider ) {
				remove_theme_support( 'wc-product-gallery-slider' );
			}
		}
		add_action( 'wp', 'atelier_woocommercedisable_slider' );
	}
	

    /* ADD PRICE TO PRODUCT ACTIONS
    ================================================== */
    function atelier_product_actions_price() {
        wc_get_template( 'loop/price.php' );
    }
    add_action( 'woocommerce_after_shop_loop_item', 'atelier_product_actions_price', 0 );


    /* PRODUCT BADGE
    ================================================== */
    if ( ! function_exists( 'atelier_woocommerceproduct_badge' ) ) {
	    function atelier_woocommerceproduct_badge() {
	    	global $product, $post, $atelier_options;
	    	$postdate 		= get_the_time( 'Y-m-d' );			// Post date
	    	$postdatestamp 	= strtotime( $postdate );			// Timestamped post date
	    	$newness 		= $atelier_options['new_badge']; 	// Newness in days
	    ?>
		    <div class="badge-wrap">
			    <?php

			    	if ( atelier_is_out_of_stock() ) {

			    		echo apply_filters( 'woocommerce_sold_out_flash', '<span class="out-of-stock-badge">' . __( 'Sold out', 'atelier' ) . '</span>', $post, $product);

			    	} else if ($product->is_on_sale()) {

			    		echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'.__( 'Sale', 'atelier' ).'</span>', $post, $product);

			    	} else if ( is_numeric($newness) && ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) {

			    		// If the product was published within the newness time frame display the new badge
			    		echo '<span class="wc-new-badge">' . __( 'New', 'atelier' ) . '</span>';

			    	} else if ( $product->get_price() != "" && $product->get_price() == 0 ) {
			    		
			    		echo '<span class="free-badge">' . __( 'Free', 'atelier' ) . '</span>';

			    	}
			    ?>
		    </div>
	    <?php }
	}


    /* ADD HERO IMAGE TO PRODUCT CATEGORY
    ================================================== */
    function atelier_product_cat_add_hero_image() {
    	// this will add the custom meta field to the add new term page
    	?>
    	<div class="form-field">
			<label><?php _e( 'Hero Image', 'atelier' ); ?></label>
			<div id="product_cat_hero" style="float:left;margin-right:10px;"><img style="height: auto!important;margin: 10px 0;" src="<?php echo wc_placeholder_img_src(); ?>" width="300px" height="300px" /></div>
			<div style="line-height:40px;">
				<input type="hidden" id="product_cat_hero_id" name="product_cat_hero_id" />
				<button type="button" class="upload_hero_button button"><?php _e( 'Upload/Add image', 'atelier' ); ?></button>
				<button type="button" class="remove_hero_button button"><?php _e( 'Remove image', 'atelier' ); ?></button>
				<p><?php _e( 'This image is used for the hero image on product category pages.', 'atelier' ); ?></p>
			</div>
			<script type="text/javascript">

				 // Only show the "remove image" button when needed
				 if ( ! jQuery('#product_cat_hero_id').val() )
					 jQuery('.remove_hero_button').hide();

				// Uploading files
				var file_frame;

				jQuery(document).on( 'click', '.upload_hero_button', function( event ){

					event.preventDefault();

					// If the media frame already exists, reopen it.
					if ( file_frame ) {
						file_frame.open();
						return;
					}

					// Create the media frame.
					file_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php _e( 'Choose an image', 'atelier' ); ?>',
						button: {
							text: '<?php _e( 'Use image', 'atelier' ); ?>',
						},
						multiple: false
					});

					// When an image is selected, run a callback.
					file_frame.on( 'select', function() {
						attachment = file_frame.state().get('selection').first().toJSON();

						jQuery('#product_cat_hero_id').val( attachment.id );
						jQuery('#product_cat_hero img').attr('src', attachment.url );
						jQuery('.remove_hero_button').show();
					});

					// Finally, open the modal.
					file_frame.open();
				});

				jQuery(document).on( 'click', '.remove_hero_button', function( event ){
					jQuery('#product_cat_hero img').attr('src', '<?php echo wc_placeholder_img_src(); ?>');
					jQuery('#product_cat_hero_id').val('');
					jQuery('.remove_hero_button').hide();
					return false;
				});

			</script>
			<div class="clear"></div>
		</div>
    <?php
    }
    add_action( 'product_cat_add_form_fields', 'atelier_product_cat_add_hero_image', 10, 2 );

    function atelier_product_cat_edit_hero_image($term) {

    	$image 			= '';
    	$hero_id 	= absint( get_term_meta( $term->term_id, 'hero_id', true ) );
    	if ( $hero_id )
    		$image = wp_get_attachment_url( $hero_id, 'medium' );
    	else
    		$image = wc_placeholder_img_src();

    	?>
    	<tr class="form-field">
			<th scope="row" valign="top"><label><?php _e( 'Hero Image', 'atelier' ); ?></label></th>
			<td>
				<div id="product_cat_hero" style="float:left;margin-right:10px;"><img style="height: auto!important;" src="<?php echo esc_url($image); ?>" width="300px" height="300px" /></div>
				<div style="line-height:40px;">
					<input type="hidden" id="product_cat_hero_id" name="product_cat_hero_id" value="<?php echo esc_attr($hero_id); ?>" />
					<button type="submit" class="upload_hero_button button"><?php _e( 'Upload/Add image', 'atelier' ); ?></button>
					<button type="submit" class="remove_hero_button button"><?php _e( 'Remove image', 'atelier' ); ?></button>
					<p><?php _e( 'This image is used for the hero image on product category pages.', 'atelier' ); ?></p>
				</div>
				<script type="text/javascript">

					// Uploading files
					var file_frame_hero;

					jQuery(document).on( 'click', '.upload_hero_button', function( event ){

						event.preventDefault();

						// If the media frame already exists, reopen it.
						if ( file_frame_hero ) {
							file_frame_hero.open();
							return;
						}

						// Create the media frame.
						file_frame_hero = wp.media.frames.downloadable_file = wp.media({
							title: '<?php _e( 'Choose an image', 'atelier' ); ?>',
							button: {
								text: '<?php _e( 'Use image', 'atelier' ); ?>',
							},
							multiple: false
						});

						// When an image is selected, run a callback.
						file_frame_hero.on( 'select', function() {
							attachment = file_frame_hero.state().get('selection').first().toJSON();

							jQuery('#product_cat_hero_id').val( attachment.id );
							jQuery('#product_cat_hero img').attr('src', attachment.url );
							jQuery('.remove_hero_button').show();
						});

						// Finally, open the modal.
						file_frame_hero.open();
					});

					jQuery(document).on( 'click', '.remove_hero_button', function( event ){
						jQuery('#product_cat_hero img').attr('src', '<?php echo wc_placeholder_img_src(); ?>');
						jQuery('#product_cat_hero_id').val('');
						jQuery('.remove_hero_button').hide();
						return false;
					});

				</script>
				<div class="clear"></div>
			</td>
		</tr>
    <?php
    }
    add_action( 'product_cat_edit_form_fields', 'atelier_product_cat_edit_hero_image', 10, 2 );


	/* SAVE EXTRA TAXONOMY FIELDS
	================================================== */
	function atelier_product_cat_save_hero_image( $term_id, $tt_id, $taxonomy ) {
		if ( isset( $_POST['product_cat_hero_id'] ) ) {
			update_woocommerce_term_meta( $term_id, 'hero_id', absint( $_POST['product_cat_hero_id'] ) );
		}
	}
	add_action( 'created_term', 'atelier_product_cat_save_hero_image', 10, 3 );
	add_action( 'edit_term', 'atelier_product_cat_save_hero_image', 10, 3 );


    /* REMOVE WOOCOMMERCE PRETTYPHOTO STYLES/SCRIPTS
    ================================================== */
    function atelier_remove_woo_lightbox_js() {
        wp_dequeue_script( 'prettyPhoto' );
        wp_dequeue_script( 'prettyPhoto-init' );
    }

    add_action( 'wp_enqueue_scripts', 'atelier_remove_woo_lightbox_js', 99 );

    function atelier_remove_woo_lightbox_css() {
        wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
    }

    add_action( 'wp_enqueue_styles', 'atelier_remove_woo_lightbox_css', 99 );


    /* REMOVE META BOX ON WC SHOP PAGE
    ================================================== */
    function atelier_check_shop_page() {
        $screen = get_current_screen();
        if ( atelier_woocommerce_activated() && $screen->post_type == 'page' ) {
            $wc_shop_id      = wc_get_page_id( 'shop' );
            $current_page_id = 0;

            if ( isset( $_GET['post'] ) ) {
                $current_page_id = $_GET['post'];
            }

            if ( $wc_shop_id == $current_page_id ) {
                echo '<style>.sf-meta-tabs-wrap {display: none!important;}</style>';
            }
        }
    }
    add_action( 'current_screen', 'atelier_check_shop_page', 10 );


    /* WOOCOMMERCE CONTENT FUNCTIONS
    ================================================== */
    function atelier_get_product_stars() {

        $stars_output = "";

        global $wpdb;
        global $post;
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
            $average = number_format( $rating / $count, 2 );
            $stars_output .= '<div class="starwrapper" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';
            $stars_output .= '<span class="star-rating" title="' . sprintf( __( 'Rated %s out of 5', 'atelier' ), $average ) . '"><span style="width:' . ( $average * 16 ) . 'px"><span itemprop="ratingValue" class="rating">' . $average . '</span> </span></span>';
            $stars_output .= '</div>';
        }

        return $stars_output;
    }

    function atelier_is_out_of_stock() {
        global $product;
        if ( $product->is_in_stock() ) {
            return false;
        } else {
            return true;
        }
    }

    if ( ! function_exists( 'atelier_product_items_text' ) ) {
        function atelier_product_items_text( $count, $alt = false ) {
            $product_item_text = "";

            if ( $alt == true ) {
                return number_format_i18n( $count );
            } else {
                if ( $count > 1 ) {
                    $product_item_text = str_replace( '%', number_format_i18n( $count ), __( '% items', 'atelier' ) );
                } elseif ( $count == 0 ) {
                    $product_item_text = __( '0 items', 'atelier' );
                } else {
                    $product_item_text = __( '1 item', 'atelier' );
                }

                return $product_item_text;
            }
        }
    }


    /* ADD TO CART HEADER RELOAD
    ================================================== */
    if ( ! function_exists( 'atelier_woocommerceheader_add_to_cart_fragment' ) ) {
        function atelier_woocommerceheader_add_to_cart_fragment( $fragments ) {
            global $woocommerce, $atelier_options;

            ob_start();

            $show_cart_count = false;
            if ( isset( $atelier_options['show_cart_count'] ) ) {
                $show_cart_count = $atelier_options['show_cart_count'];
            }

			if ( atelier_theme_opts_name() == "sf_atelier_options" ) {
				$cart_total = '<span class="menu-item-title">' . __( "Cart" , 'atelier' ) . '</span>';
			} else {
				$cart_total = WC()->cart->get_cart_total();
			}
            $cart_count          = WC()->cart->get_cart_contents_count();
            $cart_count_text     = atelier_product_items_text( $cart_count );
            $cart_count_text_alt = atelier_product_items_text( $cart_count, true );
            $extra_class		 = "";
            
            if ( $cart_count != "0" ) {
            	$extra_class .= "cart-not-empty ";
            }
            
            ?>

            <li class="parent shopping-bag-item <?php echo esc_attr($extra_class); ?>">

                <?php if ( $show_cart_count ) { ?>

                    <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e( 'View your shopping cart', 'atelier' ); ?>">
                        <?php echo apply_filters( 'atelier_header_cart_icon', '<i class="ss-cart"></i>' ); ?>
                        <span class="cart-text"><?php _e( "Cart", 'atelier' ); ?></span>
                        <?php if ( atelier_theme_opts_name() == "sf_atelier_options" ) {
							echo '<span class="menu-item-title">' . __( "Cart" , 'atelier' ) . '</span>';
						} else {
							wc_cart_totals_subtotal_html();
						} ?>
                       <span class="num-items cart-count-enabled"><?php echo atelier_product_items_text( $cart_count, true ); ?></span></a>

                <?php } else { ?>

                    <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>"
                       title="<?php _e( 'View your shopping cart', 'atelier' ); ?>"><?php echo apply_filters( 'atelier_header_cart_icon', '<i class="ss-cart"></i>' ); ?><span class="cart-text"><?php _e( "Cart", 'atelier' ); ?></span>
                        <?php if ( atelier_theme_opts_name() == "sf_atelier_options" ) {
							echo '<span class="menu-item-title">' . __( "Cart" , 'atelier' ) . '</span>';
						} else {
							wc_cart_totals_subtotal_html();
						} ?>
						<span class="num-items"><?php echo atelier_product_items_text( $cart_count, true ); ?></span></a>

                <?php } ?>

                <ul class="sub-menu">
                    <li>

                        <div class="shopping-bag" data-empty-bag-txt="<?php _e( 'Your cart is empty.', 'atelier' ); ?>" data-singular-item-txt="<?php _e( 'item in the cart', 'atelier' ); ?>" data-multiple-item-txt="<?php _e( 'items in the cart', 'atelier' ); ?>">

                          <div class="loading-overlay"><i class="sf-icon-loader"></i></div>

                            <?php if ( $cart_count != "0" ) { ?>

                                <div
                                    class="bag-header"><?php echo atelier_product_items_text( $cart_count ); ?> <?php _e( 'in the cart', 'atelier' ); ?></div>

                                <div class="bag-contents">

                                    <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) { ?>
                                    
                                        <?php
                                        $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                        $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                                        ?>

                                        <?php  
										
										$variation_id_class = $variation_id = '';
										
                                        if ( $cart_item['variation_id'] > 0 ) {
                                             $variation_id_class = ' product-var-id-' .  $cart_item['variation_id']; 
                                        	 $variation_id = $cart_item['variation_id'];
                                        } 
										
                                        if ( $cart_item['variation_id'] > 0 )
                                             $variation_id_class = ' product-var-id-' .  $cart_item['variation_id']; 
										 
                                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                        	
                                        	$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                    						$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                    						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                    						$product_title       = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                    						$product_short_title = ( strlen( $product_title ) > 25 ) ? substr( $product_title, 0, 22 ) . '...' : $product_title;
                                        ?>

                                            	<div class="bag-product clearfix  product-id-<?php echo esc_attr($cart_item['product_id']); ?> <?php echo esc_attr( $variation_id_class ); ?>">

                                                <figure>
                                                	<a class="bag-product-img" href="<?php echo esc_url( $product_permalink ); ?>">
                                                    	<?php echo apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ); ?>
                                                    </a>
                                                </figure>

                                                <div class="bag-product-details">
                                                    <div class="bag-product-title">
                                                        <a href="<?php echo esc_url( $product_permalink ); ?>">
                                                            <?php echo apply_filters( 'woocommerce_cart_widget_product_title', $product_title, $_product ); ?></a>
                                                    </div>
                                                    <div
                                                        class="bag-product-price"><?php _e( "Unit Price:", 'atelier' ); ?> <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></div>
                                                    <div
                                                        class="bag-product-quantity"><?php _e( 'Quantity:', 'atelier' ); ?> <?php echo esc_html($cart_item['quantity']); ?></div>
                                                </div>

												<?php
												if (function_exists('wc_get_cart_remove_url')) {
													echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
	                            							'<a href="%s" class="remove remove-product" title="%s" data-ajaxurl="'.admin_url( 'admin-ajax.php' ).'" data-product-qty="'. $cart_item['quantity'] .'"  data-product-id="%s" data-product_sku="%s" data-variation-id="%s">&times;</a>',
	                            							esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
	                            							__( 'Remove this item', 'atelier' ),
	                            							esc_attr( $product_id ),
	                            							esc_attr( $_product->get_sku() ),
	                            							esc_attr( $variation_id )
	                            						), $cart_item_key );
												} else {
													echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
	                            							'<a href="%s" class="remove remove-product" title="%s" data-ajaxurl="'.admin_url( 'admin-ajax.php' ).'" data-product-qty="'. $cart_item['quantity'] .'"  data-product-id="%s" data-product_sku="%s" data-variation-id="%s">&times;</a>',
	                            							esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
	                            							__( 'Remove this item', 'atelier' ),
	                            							esc_attr( $product_id ),
	                            							esc_attr( $_product->get_sku() ),
	                            							esc_attr( $variation_id )
	                            						), $cart_item_key );
												}
												?>
 
                                            </div>

                                        <?php } ?>

                                    <?php } ?>

                                </div>

			                    <div class="bag-total">
			                    	<?php if ( class_exists( 'Woocommerce_German_Market' ) ) { ?>
				                    <span class="total-title"><?php _e( "Total incl. tax", 'atelier' ); ?></span>
				                    <?php } else { ?>
				                    <span class="total-title"><?php _e( "Total", 'atelier' ); ?></span>
				                    <?php } ?>
				                    <span class="total-amount"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
			                    </div>

                                <div class="bag-buttons">

                                    <a class="sf-button standard sf-icon-reveal bag-button" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                                    	<?php echo apply_filters( 'atelier_view_cart_icon', '<i class="ss-view"></i>' ); ?>
                                   		<span class="text"><?php _e( 'View cart', 'atelier' ); ?></span>
                                   	</a>

                                    <a class="sf-button standard sf-icon-reveal checkout-button" href="<?php echo esc_url( wc_get_checkout_url() ); ?>">
                                    	<?php echo apply_filters( 'atelier_checkout_icon', '<i class="ss-creditcard"></i>' ); ?>
                                    	<span class="text"><?php _e( 'Checkout', 'atelier' ); ?></span>
                                    </a>

                                </div>

                            <?php } else { ?>

                                <div class="bag-empty"><?php _e( 'Your cart is empty.', 'atelier' ); ?></div>

                            <?php } ?>

                        </div>
                    </li>
                </ul>
            </li>

            <?php

            $fragments['.shopping-bag-item'] = ob_get_clean();

            return $fragments;

        }

        add_filter( 'woocommerce_add_to_cart_fragments', 'atelier_woocommerceheader_add_to_cart_fragment' );
    }


    /* WISHLIST BUTTON
    ================================================== */
    if ( ! function_exists( 'atelier_wishlist_button' ) ) {
        function atelier_wishlist_button($extra_class = "") {

            global $product, $yith_wcwl;
            $product_id = method_exists( $product, 'get_id' ) ? $product->get_id() : $product->id;
			$product_type = method_exists( $product, 'get_type' ) ? $product->get_type() : $product->product_type;

			$yith_version = get_option('yith_wcwl_version');

			if ( !class_exists( 'YITH_WCWL_UI' ) && !class_exists( 'YITH_WCWL' ) ) {
				return;
			}

			if ( version_compare( get_option('yith_wcwl_version'), "3.0" ) >= 0 ) {

				$html = do_shortcode( "[yith_wcwl_add_to_wishlist]" );
				echo wp_kses_post($html);

			} else {

              	$tooltip      = __("Add to wishlist", 'atelier');

				//Check Wishlist version
				if ( version_compare( get_option('yith_wcwl_version'), "2.0" ) >= 0 ) {
					$url = YITH_WCWL()->get_wishlist_url();
	        		$default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;

					if ( ! empty( $default_wishlists ) ) {
		        		$default_wishlist = $default_wishlists[0]['ID'];
	        		}
	        		else {
		        		$default_wishlist = false;
	        		}

					$exists = YITH_WCWL()->is_product_in_wishlist( $product_id , $default_wishlist);
				}
				else {
					$url = $yith_wcwl->get_wishlist_url();
					$exists = $yith_wcwl->is_product_in_wishlist( $product_id );
				}

				if ( $exists ) {
					$tooltip  = __("View wishlist", 'atelier');
				}

                $classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'class="add_to_wishlist single_add_to_wishlist button alt"' : 'class="add_to_wishlist"';
				
				$html = '<div class="yith-wcwl-divide"></div>';
                $html .= '<div class="yith-wcwl-add-to-wishlist '.$extra_class.' atelier-yith-wishlist-btn" data-toggle="tooltip" data-placement="top" title="'.$tooltip.'">';
                $html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row

                $html .= $exists ? ' hide" style="display:none;"' : ' show"';
                $url_add = esc_url( add_query_arg( 'add_to_wishlist', $product_id ) );
                
				$html .= '><a href="' . $url_add . '" rel="nofollow" data-ajaxurl="' . admin_url( 'admin-ajax.php' ). '" data-product-id="' . $product_id . '" data-product-type="' . $product_type . '" ' . $classes . ' >';

                $html .= apply_filters('atelier_add_to_wishlist_icon', '<i class="ss-star"></i>');
                $html .= '</a></div>';

                $html .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><span class="feedback">' . __( 'Product added to wishlist.', 'atelier' ) . '</span> <a href="' . $url . '" rel="nofollow">';
                $html .= apply_filters('atelier_added_to_wishlist_icon', '<i class="fas fa-check"></i>');
                $html .= '</a></div>';
                $html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . $url . '">';
                $html .= apply_filters('atelier_added_to_wishlist_icon', '<i class="fas fa-check"></i>');
                $html .= '</a></div>';
                $html .= '<div style="clear:both"></div><div class="yith-wcwl-wishlistaddresponse"></div>';

                $html .= '</div>';

                echo wp_kses_post($html);
	        }
        }

        add_action( 'woocommerce_after_add_to_cart_button', 'atelier_wishlist_button', 10 );
    }


    /* SHOW PRODUCTS COUNT URL PARAMETER
    ================================================== */
    if ( !function_exists('atelier_product_shop_count') ) {
		function atelier_product_shop_count($original_count) {
			$options           = get_option( atelier_theme_opts_name() );
			$default_count = $products_per_page = $options['products_per_page'];

			$count = isset($_GET['show_products']) ? $_GET['show_products'] : $default_count;

			if ( !$count ) {
				return $original_count;
			}

			if ( $count === 'all' ) {
				$count = -1;
			} else if ( !is_numeric($count) ) {
				$count = $default_count;
			}

			return $count;
		}	
	}
	add_filter( 'loop_shop_per_page', 'atelier_product_shop_count');   
	
    
    /* CROSS SELLS COLUMNS
    ================================================== */
    function atelier_woocommerce_cross_sells_cols() {
    	return 4;
    }
    add_filter( 'woocommerce_cross_sells_columns', 'atelier_woocommerce_cross_sells_cols' );
   

    /* SHOP LAYOUT OPTIONS
    ================================================== */
   	if ( ! function_exists( 'atelier_shop_layout_opts' ) ) {
   	    function atelier_shop_layout_opts() {

   	    	global $atelier_options;
   	    	$product_multi_masonry = $atelier_options['product_multi_masonry'];
   			$product_display_type = $atelier_options['product_display_type'];
   			if (isset($_GET['product_display'])) {
   				$product_display_type = $_GET['product_display'];
			}
   	    	if ( $product_multi_masonry || !atelier_theme_supports('product-layout-opts') ) {
   	    		return;
   	    	}

   	    ?>
   	    	<div class="shop-layout-opts" data-display-type="<?php echo esc_attr($product_display_type); ?>">
   	    		<a href="#" class="layout-opt" data-layout="standard" title="<?php _e("Standard Layout", 'atelier'); ?>"><i class="sf-icon-atelier-shop-standard"></i></a>
   	    		<a href="#" class="layout-opt" data-layout="list" title="<?php _e("List Layout", 'atelier'); ?>"><i class="sf-icon-atelier-shop-list"></i></a>
   	    		<a href="#" class="layout-opt" data-layout="grid" title="<?php _e("Grid Layout", 'atelier'); ?>"><i class="sf-icon-atelier-shop-grid"></i></a>
   	    	</div>
   	    <?php }
    	add_action( 'woocommerce_before_shop_loop', 'atelier_shop_layout_opts', 15 );
    }


    /* MOBILE SHOP LAYOUT OPTIONS
    ================================================== */
    if ( ! function_exists( 'atelier_shop_layout_opts_mobile' ) ) {
   	    function atelier_shop_layout_opts_mobile() {

   	    	global $atelier_options, $woocommerce, $wp_query;
   	    	$product_multi_masonry = $atelier_options['product_multi_masonry'];
   			$product_display_type = $atelier_options['product_display_type'];
   			if (isset($_GET['product_display'])) {
   				$product_display_type = $_GET['product_display'];
			}

   	    	if ( $product_multi_masonry || !atelier_theme_supports('product-layout-opts') && !atelier_theme_supports( 'mobile-shop-filters' ) ) {
   	    		return;
   	    	}

   	    ?>
   	    	<div class="shop-layout-opts" data-display-type="<?php echo esc_attr($product_display_type); ?>">
   	    		<a href="#" class="layout-opt" data-layout="solo" title="<?php _e("Solo Layout", 'atelier'); ?>"><i class="sf-icon-atelier-shop-solo"></i></a>
   	    		<a href="#" class="layout-opt" data-layout="list" title="<?php _e("List Layout", 'atelier'); ?>"><i class="sf-icon-atelier-shop-list"></i></a>
   	    		<a href="#" class="layout-opt" data-layout="grid" title="<?php _e("Grid Layout", 'atelier'); ?>"><i class="sf-icon-atelier-shop-standard"></i></a>
   	    	</div>

   	    	<p class="woocommerce-result-count">
		        <?php
		            $paged    = max( 1, $wp_query->get( 'paged' ) );
		            $per_page = $wp_query->get( 'posts_per_page' );
		            $total    = $wp_query->found_posts;
		            $first    = ( $per_page * $paged ) - $per_page + 1;
		            $last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

		            if ( 1 == $total ) {
		                echo __( '1 product', 'atelier' );
		            } elseif ( $total <= $per_page ) {
		                printf( __( '%d products', 'atelier' ), $total );
		            } else {
		                printf( __( '%1$d-%2$d of %3$d products', 'atelier' ), $first, $last, $total );
		            }
		        ?>
		    </p>

   	    <?php }
    	add_action( 'atelier_mobile_before_shop_loop_details', 'atelier_shop_layout_opts_mobile', 10 );
    }


	/* MOBILE SHOP FILTERS
    ================================================== */
    if ( ! function_exists( 'atelier_mobile_filters_link' ) ) {
		function atelier_mobile_filters_link() {
			if ( !atelier_theme_supports( 'mobile-shop-filters' ) ) {
			    return;
		    }
			echo '<a href="#" class="sf-mobile-shop-filters-link">' . __( "Filters" , 'atelier' ) . '</a>';
		}
		add_action( 'woocommerce_before_shop_loop', 'atelier_mobile_filters_link', 10 );
	}
    if ( ! function_exists( 'atelier_mobile_shop_filters' ) ) {
	    function atelier_mobile_shop_filters() {

		    if ( !atelier_theme_supports( 'mobile-shop-filters' ) ) {
			    return;
		    }

			?>

			<div class="sf-mobile-shop-filters row">
				<?php if ( function_exists( 'dynamic_sidebar' ) && atelier_is_sidebar_active( 'mobile-woocommerce-filters' ) ) { ?>
                    <?php dynamic_sidebar( 'mobile-woocommerce-filters' ); ?>
                <?php } else { ?>
                	<h5 class="no-widgets container"><?php _e( "Please add widgets to the WooCommerce Filters widget area in Appearance > Widgets", 'atelier' ); ?></h5>
                <?php } ?>
			</div>

			<?php

		}
		add_action( 'atelier_mobile_before_shop_loop_filters', 'atelier_mobile_shop_filters', 10 );
	}


    /* SINGLE PRODUCT
    ================================================== */
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
    //remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
    remove_action( 'woocommerce_product_tabs', 'woocommerce_product_description_tab', 10 );
    remove_action( 'woocommerce_product_tab_panels', 'woocommerce_product_description_panel', 10 );

	if ( atelier_theme_supports( 'product-summary-tabs' ) ) {
	    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 35 );
	}

	
	/* WOO SINGLE PRODUCT PRICE/RATING
	================================================== */
	if ( ! function_exists( 'atelier_product_price_rating' ) ) {
	    function atelier_product_price_rating() {
	    	global $post, $atelier_catalog_mode, $wpdb;
	    	$args = array(
	    		'span' => array(),
	    		'del' => array(),
	    		'ins' => array(),
	    		'p' => array()
	    	);
	    	$product = new WC_Product(get_the_ID()); 
	   	    ?>
			<div class="product-price-wrap clearfix">
				<p class="price"><?php echo wp_kses_post($product->get_price_html()); ?></p>
				
				<?php
					if ( function_exists('wc_get_rating_html') ) {
						$rating_html = wc_get_rating_html( $product->get_average_rating() );
						if ( comments_open() ) :
							echo wc_get_rating_html( $product->get_average_rating() );
						endif;
					}
				?>
				
			</div>
			<?php
		}
		// add_action( 'woocommerce_single_product_summary', 'atelier_product_price_rating', 10 );
	}


    /* WOO PRODUCT SHORT DESCRIPTION
    ================================================== */
    if ( ! function_exists( 'atelier_product_short' ) ) {
        function atelier_product_short() {
            global $post;
            $product_short_description = atelier_get_post_meta( $post->ID, 'sf_product_short_description', true );
            if ( $product_short_description == "" ) {
                $product_short_description = $post->post_excerpt;
            }
            if ( substr( $product_short_description, 0, 4 ) === '[spb' ) {
                $product_short_description = "";
            }

            if ( $product_short_description != "" ) {
                ?>
                <div class="product-short" class="entry-summary">
                    <?php echo do_shortcode( atelier_add_formatting( $product_short_description ) ); ?>
                </div>
            <?php
            }
        }

        add_action( 'woocommerce_single_product_summary', 'atelier_product_short', 20 );
    }
    
    
    /* WOO PRODUCT PAGE BUILDER CONTENT
    ================================================== */
    if ( ! function_exists( 'atelier_woocommerceproduct_page_builder_content' ) ) {
	    function atelier_woocommerceproduct_page_builder_content() {
		?>
			<div id="product-display-area" class="clearfix">
				<div class="container">
					<?php the_content(); ?>
				</div>		
			</div>
		<?php }
	}
	

    /* WOO PRODUCT META
    ================================================== */
    if ( ! function_exists( 'atelier_product_meta' ) ) {
        function atelier_product_meta() {
            global $atelier_options;
            ?>
            <div class="meta-row clearfix">
                <span class="need-help"><?php _e( "Need Help?", 'atelier' ); ?> <a href="#email-form"
                                                                                          class="inline accent"
                                                                                          data-toggle="modal"><?php _e( "Contact Us", 'atelier' ); ?></a></span>
                <span class="leave-feedback"><a href="#feedback-form" class="inline accent"
                                                data-toggle="modal"><?php _e( "Leave Feedback", 'atelier' ); ?></a></span>
            </div>
            <div id="email-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="email-form-modal"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo apply_filters( 'atelier_close_icon', '<i class="ss-delete"></i>' ); ?></button>
                            <h3 id="email-form-modal"><?php _e( "Contact Us", 'atelier' ); ?></h3>
                        </div>
                        <div class="modal-body">
                            <?php echo do_shortcode( $atelier_options['email_modal'] ); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div id="feedback-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="feedback-form-modal"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo apply_filters( 'atelier_close_icon', '<i class="ss-delete"></i>' ); ?></button>
                            <h3 id="feedback-form-modal"><?php _e( "Leave Feedback", 'atelier' ); ?></h3>
                        </div>
                        <div class="modal-body">
                            <?php echo do_shortcode( $atelier_options['feedback_modal'] ); ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }

        add_action( 'woocommerce_product_meta_start', 'atelier_product_meta', 10 );
    }


    /* WOO HELP BAR
    ================================================== */
    if ( ! function_exists( 'atelier_woocommercehelp_bar' ) ) {
        function atelier_woocommercehelp_bar() {
            global $atelier_options;

            $help_bar_text  = __( $atelier_options['help_bar_text'], 'atelier' );
            $email_modal    = __( $atelier_options['email_modal'], 'atelier' );
            $shipping_modal = __( $atelier_options['shipping_modal'], 'atelier' );
            $returns_modal  = __( $atelier_options['returns_modal'], 'atelier' );
            $faqs_modal     = __( $atelier_options['faqs_modal'], 'atelier' );
            ?>
            <div class="help-bar clearfix">
                <span><?php echo do_shortcode( $help_bar_text ); ?></span>
                <ul>
                    <?php if ( $email_modal != "" ) { ?>
                        <li><a href="#email-form" class="inline"
                               data-toggle="modal"><?php _e( "Email customer care", 'atelier' ); ?></a></li>
                    <?php } ?>
                    <?php if ( $shipping_modal != "" ) { ?>
                        <li><a href="#shipping-information" class="inline"
                               data-toggle="modal"><?php _e( "Shipping information", 'atelier' ); ?></a></li>
                    <?php } ?>
                    <?php if ( $returns_modal != "" ) { ?>
                        <li><a href="#returns-exchange" class="inline"
                               data-toggle="modal"><?php _e( "Returns & exchange", 'atelier' ); ?></a></li>
                    <?php } ?>
                    <?php if ( $faqs_modal != "" ) { ?>
                        <li><a href="#faqs" class="inline"
                               data-toggle="modal"><?php _e( "F.A.Q.'s", 'atelier' ); ?></a></li>
                    <?php } ?>
                </ul>
            </div>

            <?php if ( $email_modal != "" ) { ?>
                <div id="email-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="email-form-modal"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo apply_filters( 'atelier_close_icon', '<i class="ss-delete"></i>' ); ?></button>
                                <h3 id="email-form-modal"><?php _e( "Email customer care", 'atelier' ); ?></h3>
                            </div>
                            <div class="modal-body">
                                <?php echo do_shortcode( $email_modal ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if ( $shipping_modal != "" ) { ?>
                <div id="shipping-information" class="modal fade" tabindex="-1" role="dialog"
                     aria-labelledby="shipping-modal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo apply_filters( 'atelier_close_icon', '<i class="ss-delete"></i>' ); ?></button>
                                <h3 id="shipping-modal"><?php _e( "Shipping information", 'atelier' ); ?></h3>
                            </div>
                            <div class="modal-body">
                                <?php echo do_shortcode( $shipping_modal ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if ( $returns_modal != "" ) { ?>
                <div id="returns-exchange" class="modal fade" tabindex="-1" role="dialog"
                     aria-labelledby="returns-modal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo apply_filters( 'atelier_close_icon', '<i class="ss-delete"></i>' ); ?></button>
                                <h3 id="returns-modal"><?php _e( "Returns & exchange", 'atelier' ); ?></h3>
                            </div>
                            <div class="modal-body">
                                <?php echo do_shortcode( $returns_modal ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if ( $faqs_modal != "" ) { ?>
                <div id="faqs" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="faqs-modal"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><?php echo apply_filters( 'atelier_close_icon', '<i class="ss-delete"></i>' ); ?></button>
                                <h3 id="faqs-modal"><?php _e( "F.A.Q.'s", 'atelier' ); ?></h3>
                            </div>
                            <div class="modal-body">
                                <?php echo do_shortcode( $faqs_modal ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        <?php
        }
    }

	/* WOO REMOVE PRODUCT FROM CART
    ================================================== */
	if ( ! function_exists('atelier_cart_product_remove')){
		function atelier_cart_product_remove() {

    		global $wpdb, $woocommerce;

			$id = 0; 
			$variation_id = 0;
			

            if ( ! empty( $_REQUEST['product_id'] ) ) {
                $id = $_REQUEST['product_id'];
            }
            
            if ( ! empty( $_REQUEST['variation_id'] ) ) {
                $variation_id = $_REQUEST['variation_id'];
            }
                                                
            $cart = $woocommerce->cart;
            
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            	
        	    if ( ($cart_item['product_id'] == $id && $variation_id <= 0) || ($cart_item['variation_id'] == $variation_id && $variation_id > 0 ) ){
        	   		$cart->set_quantity($cart_item_key,0);	
				}           
		
            }

            if ( $woocommerce->tax_display_cart == 'excl' ) {
				echo wc_price($woocommerce->cart->get_total());
			} else {
				echo wc_price($woocommerce->cart->cart_contents_total + $woocommerce->cart->tax_total);
			} 	
   			
			die();
    	}

    	add_action( 'wp_ajax_atelier_cart_product_remove', 'atelier_cart_product_remove' );
		add_action( 'wp_ajax_nopriv_atelier_cart_product_remove', 'atelier_cart_product_remove' );
	}


	/* WOO SHIPPING CALC BEFORE
	================================================== */
	if ( ! function_exists('atelier_cart_shipping_calc_before')){
		function atelier_cart_shipping_calc_before() {
			echo '<div class="shipping-calc-wrap">';
			echo '<h4 class="lined-heading">'.__( 'Shipping Calculator', 'atelier' ).'</h4>';
		}
		add_action( 'woocommerce_before_shipping_calculator', 'atelier_cart_shipping_calc_before' );
	}


	/* WOO SHIPPING CALC AFTER
	================================================== */
	if ( ! function_exists('atelier_cart_shipping_calc_after')){
		function atelier_cart_shipping_calc_after() {
			echo '</div>';
		}
		add_action( 'woocommerce_after_shipping_calculator', 'atelier_cart_shipping_calc_after' );
	}
	
	
	/* WOO VARIATION ADD TO CART BUTTON
	================================================== */
	// remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
	function atelier_single_variation_add_to_cart_button() {
		global $product;
		$loading_text = __( 'Adding...', 'atelier' );
		$added_text = __( 'Item added', 'atelier' );
		$icon_class = apply_filters( 'atelier_add_to_cart_icon_class', 'sf-icon-add-to-cart' );
		$product_id = method_exists( $product, 'get_id' ) ? $product->get_id() : $product->id;
		?>
		<div class="variations_button">
			<?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
			<button type="submit" data-product_id="<?php echo esc_attr($product_id); ?>" data-quantity="1" data-default_text="<?php echo esc_attr($product->single_add_to_cart_text()); ?>" data-default_icon="<?php echo esc_attr($icon_class); ?>" data-loading_text="<?php echo esc_attr($loading_text); ?>" data-added_text="<?php echo esc_attr($added_text); ?>" class="single_add_to_cart_button button alt"><i class="<?php echo esc_attr($icon_class); ?>"></i><span><?php echo esc_attr($product->single_add_to_cart_text()); ?></span></button>
			<input type="hidden" name="add-to-cart" value="<?php echo absint( $product_id ); ?>" />
			<input type="hidden" name="product_id" value="<?php echo absint( $product_id ); ?>" />
			<input type="hidden" name="variation_id" class="variation_id" value="" />
			<?php echo atelier_wishlist_button(); ?>
		</div>
		<?php
	}
	// add_action( 'woocommerce_single_variation', 'atelier_single_variation_add_to_cart_button', 20 );
	
	
	/* WOO GET CATEGORY DESC
	================================================== */
	function atelier_woocommerceget_product_category_description ($category, $return = false) {
		$cat_id        =    $category->term_id;
		$prod_term    =    get_term($cat_id,'product_cat');
		$description =    $prod_term->description;
		
		if ( $return ) {
			return $prod_term->description;
		} else {
			echo esc_html($prod_term->description);
		}
	}
	
	
	/* WOO SINGLE PRODUCT CAROUSEL OPTS
	================================================== */
	function atelier_single_product_carousel_options() {
		return array(
			'rtl'            => is_rtl(),
			'animation'      => 'slide',
			'smoothHeight'   => true,
			'directionNav'   => true,
			'controlNav'     => 'thumbnails',
			'slideshow'      => false,
			'animationSpeed' => 500,
			'animationLoop'  => false, // Breaks photoswipe pagination if true.
		);
	}
	//add_filter( 'woocommerce_single_product_carousel_options', 'atelier_single_product_carousel_options' );
