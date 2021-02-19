<?php
    /*
    *
    *	Swift Super Search
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	atelier_super_search()
    */

    /* SUPER SEARCH
    ================================================== */
    if ( ! function_exists( 'atelier_super_search' ) ) {
        function atelier_super_search($contained = "") {

            global $atelier_options;
            $ss_enable = $atelier_options['ss_enable'];

            if ( $ss_enable ) {

                global $atelier_supersearchcount, $woocommerce;
                $ss_button_text      = __( $atelier_options['ss_button_text'], 'atelier' );
                $close_icon = apply_filters( 'atelier_close_icon', '<i class="ss-delete"></i>' );
                $count = 1;
                
                $super_search = $search_text = $shop_url = "";
                
                $shop_url = get_permalink( wc_get_page_id( 'shop' ) );
                
                if (atelier_theme_supports('super-search-config')) {
                                	
                	$search_config = $atelier_options['ss_super_search_field'];
                	foreach ($search_config as $search_field) {
                		$search_text .= '<span>' . $search_field['beforetext'] . '</span>';
                		$search_text .= atelier_super_search_dropdown( $count, $search_field['ss-filter'], $search_field['label'] );
                		$search_text .= '<span>' . $search_field['aftertext'] . '</span>';
                		$count++;
                	}
                	
                	
                	
                } else {
	                $field1_text         = __( $atelier_options['field1_text'], 'atelier' );
	                $field1_filter       = __( $atelier_options['field1_filter'], 'atelier' );
	                $field1_default_text = __( $atelier_options['field1_default_text'], 'atelier' );
	                $field2_text         = __( $atelier_options['field2_text'], 'atelier' );
	                $field2_filter       = __( $atelier_options['field2_filter'], 'atelier' );
	                $field2_default_text = __( $atelier_options['field2_default_text'], 'atelier' );
	                $field3_text         = __( $atelier_options['field3_text'], 'atelier' );
	                $field3_filter       = __( $atelier_options['field3_filter'], 'atelier' );
	                $field3_default_text = __( $atelier_options['field3_default_text'], 'atelier' );
	                $field4_text         = __( $atelier_options['field4_text'], 'atelier' );
	                $field4_filter       = __( $atelier_options['field4_filter'], 'atelier' );
	                $field4_default_text = __( $atelier_options['field4_default_text'], 'atelier' );
	                $field5_text         = __( $atelier_options['field5_text'], 'atelier' );
	                $field5_filter       = __( $atelier_options['field5_filter'], 'atelier' );
	                $field5_default_text = __( $atelier_options['field5_default_text'], 'atelier' );
	                $field6_text         = __( $atelier_options['field6_text'], 'atelier' );
	                $field6_filter       = __( $atelier_options['field6_filter'], 'atelier' );
	                $field6_default_text = __( $atelier_options['field6_default_text'], 'atelier' );
	                $ss_final_text       = __( $atelier_options['ss_final_text'], 'atelier' );	                
	
	                if ( $field1_text != "" ) {
	                    $search_text .= '<span>' . $field1_text . '</span>';
	                    $search_text .= atelier_super_search_dropdown( 1, $field1_filter, $field1_default_text );
	                }
	                if ( $field2_text != "" ) {
	                    $search_text .= '<span>' . $field2_text . '</span>';
	                    $search_text .= atelier_super_search_dropdown( 2, $field2_filter, $field2_default_text );
	                }
	                if ( $field3_text != "" ) {
	                    $search_text .= '<span>' . $field3_text . '</span>';
	                    $search_text .= atelier_super_search_dropdown( 3, $field3_filter, $field3_default_text );
	                }
	                if ( $field4_text != "" ) {
	                    $search_text .= '<span>' . $field4_text . '</span>';
	                    $search_text .= atelier_super_search_dropdown( 4, $field4_filter, $field4_default_text );
	                }
	                if ( $field5_text != "" ) {
	                    $search_text .= '<span>' . $field5_text . '</span>';
	                    $search_text .= atelier_super_search_dropdown( 5, $field5_filter, $field5_default_text );
	                }
	                if ( $field6_text != "" ) {
	                    $search_text .= '<span>' . $field6_text . '</span>';
	                    $search_text .= atelier_super_search_dropdown( 6, $field6_filter, $field6_default_text );
	                }
	                
	                $search_text .= '<span>' . $ss_final_text . '</span>';
                }
                
               

                if ( $atelier_supersearchcount == 0 || ! $atelier_supersearchcount ) {
                    $super_search .= '<div id="super-search" class="sf-super-search clearfix">';
                } else {
                    $super_search .= '<div id="super-search-' . $atelier_supersearchcount . '" class="sf-super-search clearfix">';
                }
                
                if ( $contained ) {
                	$super_search .= '<div class="container">';
                }
	                $super_search .= '<div class="search-options col-sm-9">';
	                $super_search .= $search_text;
	                $super_search .= '</div>';
	                $super_search .= '<div class="search-go col-sm-3">';
	                $super_search .= '<a href="#" class="super-search-go sf-button accent" data-home_url="' . get_home_url() . '" data-shop_url="' . $shop_url . '"><span class="text">' . $ss_button_text . '</span></a>';
	                $super_search .= '<a class="super-search-close" href="#">'.$close_icon.'</a>';
	                $super_search .= '</div>';
				
				if ( $contained ) {
					$super_search .= '</div>';
				}
				
                $super_search .= '</div><!-- close #super-search -->';

                if ( $atelier_supersearchcount >= 0 ) {
                    $atelier_supersearchcount ++;
                } else {
                    $atelier_supersearchcount = 0;
                }

                return $super_search;
            }
        }
    }


    if ( ! function_exists( 'atelier_super_search_dropdown' ) ) {
        function atelier_super_search_dropdown( $index, $option, $text ) {

            global $product;

            $option_id = $atelier_ss_dropdown = $default_term_id = "";

            $option_id = $option;

            if ( $option != "product_cat" && $option != "price" ) {
                $option = 'pa_' . $option;
            }

            $default_term = get_term_by( 'name', $text, $option );

            if ( $default_term ) {
                if ( $option == "product_cat" ) {
                    $default_term_id = $default_term->slug;
                } else {
                    $default_term_id = $default_term->slug;
                }
            }

            $term_args = array(
                'parent' => 0,
            );

            if ( $option == "price" ) {

                global $wpdb, $woocommerce;

                $max = ceil( $wpdb->get_var(
                    $wpdb->prepare( '
                		SELECT max(meta_value + 0)
                		FROM %1$s
                		LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
                		WHERE meta_key = \'%3$s\' and %1$s.post_status = "publish"
                		', $wpdb->posts, $wpdb->postmeta, '_price' )
                ) );

                $atelier_ss_dropdown .= '<input type="text" pattern="[0-9]*" id="ss-price-min" name="min_price" value="0" />';
                $atelier_ss_dropdown .= '<span>&</span>';
                $atelier_ss_dropdown .= '<input type="text" pattern="[0-9]*" id="ss-price-max" name="max_price" value="' . $max . '" />';

            } else {

                $terms = get_terms( $option, $term_args );

                $atelier_ss_dropdown .= '<div id="' . $option_id . '" class="ss-dropdown" tabindex="' . $index . '" data-attr_value="' . $default_term_id . '">';
                $atelier_ss_dropdown .= '<span>' . $text . '</span>';
                $atelier_ss_dropdown .= '<ul>';
                $atelier_ss_dropdown .= '<li>';
                $atelier_ss_dropdown .= '<a class="ss-option" href="#" data-attr_value="">' . __( "Any", 'atelier' ) . '</a>';
                $atelier_ss_dropdown .= '<i class="fas fa-check"></i>';
                $atelier_ss_dropdown .= '</li>';

                foreach ( $terms as $term ) {
                	
                	if ( !isset($term->slug) || !isset($term->term_id) ) { 
                		return;
                	}
                	
                    if ( $term->slug == $default_term_id || $term->term_id == $default_term_id ) {
                        $atelier_ss_dropdown .= '<li class="selected">';
                    } else {
                        $atelier_ss_dropdown .= '<li>';
                    }

                    if ( $option == "product_cat" ) {
                        $atelier_ss_dropdown .= '<a class="ss-option" href="#" data-attr_value="' . $term->slug . '">' . $term->name . '</a>';
                    } else {
                        //$atelier_ss_dropdown .= '<a class="ss-option" href="#" data-attr_value="' . $term->term_id . '">' . $term->name . '</a>';
                        $atelier_ss_dropdown .= '<a class="ss-option" href="#" data-attr_value="' . $term->slug . '">' . $term->name . '</a>';
                    }

                    $atelier_ss_dropdown .= '<i class="fas fa-check"></i>';
                    $atelier_ss_dropdown .= '</li>';
                }

                $atelier_ss_dropdown .= '</ul>';
                $atelier_ss_dropdown .= '</div>';

            }

            return $atelier_ss_dropdown;
        }
    }


    function atelier_custom_get_attribute_taxonomies() {
        $transient_name       = 'wc_attribute_taxonomies';
        $attribute_taxonomies = "";

        if ( atelier_woocommerce_activated() ) {

            if ( false === ( $attribute_taxonomies = get_transient( $transient_name ) ) ) {

                global $wpdb;

                $attribute_taxonomies = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies" );

                set_transient( $transient_name, $attribute_taxonomies );
            }

        }

        return apply_filters( 'woocommerce_attribute_taxonomies', $attribute_taxonomies );
    }

    function atelier_custom_get_attribute_taxonomy_name( $name ) {
        $taxonomy = $name;
        $taxonomy = strtolower( stripslashes( strip_tags( $taxonomy ) ) );
        $taxonomy = preg_replace( '/&.+?;/', '', $taxonomy ); // Kill entities
        $taxonomy = str_replace( array( '.', '\'', '"' ), '', $taxonomy ); // Kill quotes and full stops.
        $taxonomy = str_replace( array( ' ', '_' ), '-', $taxonomy ); // Replace spaces and underscores.
        return 'pa_' . $taxonomy;
    }

?>