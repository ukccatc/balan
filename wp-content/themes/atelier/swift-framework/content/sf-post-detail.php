<?php

    /*
    *
    *	Swift Page Builder - Post Detail Function Class
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	atelier_post_detail_heading()
    *	atelier_post_detail_media()
    *	atelier_post_details()
    *	atelier_post_related_articles()
    *
    */
	
	/* POST DETAIL META
	================================================== */
	if ( ! function_exists( 'atelier_post_detail_meta' ) ) {
	    function atelier_post_detail_meta() {
	        global $post, $atelier_options;
	        $site_name = apply_filters('atelier_schema_meta_site_name', get_bloginfo( 'name' ));
	        $post_title = get_the_title();
	        $post_date = get_the_date('Y-m-d g:i:s');
	        $modified_date = get_the_modified_date('Y-m-d g:i:s');
	        $permalink = get_permalink();
	        
	        $post_image = get_post_thumbnail_id();
	       	$image_meta = array();
	       	$post_image_url = $post_image_alt = "";
	        $post_image_width = $post_image_height = 0;
	        
	        if ( $post_image != "" ) {
		        $post_image_meta = atelier_get_attachment_meta( $post_image );
		        if ( isset($post_image_meta) ) {
		        	$post_image_alt = esc_attr( $post_image_meta['alt'] );
		        } 
		        $post_thumb_id = get_post_thumbnail_id();
		        $post_image_url = wp_get_attachment_url( $post_thumb_id );
		        $post_image_meta = wp_get_attachment_metadata( $post_thumb_id );
		        $post_image_width = isset($post_image_meta['width']) ? $post_image_meta['width'] : 0;
		        $post_image_height = isset($post_image_meta['height']) ? $post_image_meta['height'] : 0;
	        }
	        $logo = array();
	        $logo_width = $logo_height = 0;
	        if ( isset($atelier_options['logo_upload']) ) {
	        	$logo = $atelier_options['logo_upload'];
	        	if ( isset($logo['width']) ) {
	        		$logo_width = $logo['width'];
	        	}
	        	if ( isset($logo['height']) ) {
	        		$logo_height = $logo['height'];
	        	}
	        }
	        
	        ?>
	        
	        <div class="article-meta hide">
	        	<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
	        		<?php if ( !empty($logo) ) { ?>
						<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
							<img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($site_name); ?>" />
							<meta itemprop="url" content="<?php echo esc_url($logo['url']); ?>">
							<meta itemprop="width" content="<?php echo esc_attr($logo_width); ?>">
							<meta itemprop="height" content="<?php echo esc_attr($logo_height); ?>">
						</div>
					<?php } ?>
					<meta itemprop="name" content="<?php echo esc_attr($site_name); ?>">
				</div>
	        	<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php echo esc_url($permalink); ?>"/>
	        	<div itemprop="headline"><?php echo esc_html($post_title); ?></div>
	        	<meta itemprop="datePublished" content="<?php echo esc_attr($post_date); ?>"/>
	        	<meta itemprop="dateModified" content="<?php echo esc_attr($modified_date); ?>"/>
	        	<?php if ( $post_image != "" ) { ?>
	        	<div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
					<meta itemprop="url" content="<?php echo esc_url($post_image_url); ?>">
					<meta itemprop="width" content="<?php echo esc_attr($post_image_width); ?>">
					<meta itemprop="height" content="<?php echo esc_attr($post_image_height); ?>">
				</div>
	        	<?php } ?>
	        </div>
	        
	    <?php
	    }
	}
	add_action( 'atelier_post_article_start', 'atelier_post_detail_meta', 5 );
	
	
    /* POST DETAIL HEADING
    ================================================== */
    if ( ! function_exists( 'atelier_post_detail_heading' ) ) {
        function atelier_post_detail_heading() {
            global $post;
            ?>
            <header class="article-heading hidden-hatom">
                <div class="container">
                    <div class="entry-title" itemprop="name"><?php the_title(); ?></div>
                    <span class="date updated"><?php the_date(); ?></span>
                    <span class="vcard author">
                    	<span class="fn"><?php the_author_meta( 'display_name' ); ?></span>
                    </span>
                </div>
            </header>
        <?php
        }
    }
    add_action( 'atelier_post_article_start', 'atelier_post_detail_heading', 10 );


    /* POST DETAIL MEDIA
    ================================================== */
    if ( ! function_exists( 'atelier_post_detail_media' ) ) {
        function atelier_post_detail_media() {
            global $post, $atelier_options, $atelier_sidebar_config;

            $single_author           = $atelier_options['single_author'];
            $remove_dates            = $atelier_options['remove_dates'];

            $media_type              = atelier_get_post_meta($post->ID, 'sf_media_type', true );
            $fw_media_display        = atelier_get_post_meta($post->ID, 'sf_fw_media_display', true );
            $pb_active = atelier_get_post_meta( $post->ID, '_spb_status', true );

            $post_author     = get_the_author_link();
            $post_date       = get_the_date();
            $post_date_str   = get_the_date('Y-m-d');
            $post_categories = get_the_category_list( ', ' );

            if ( $media_type == "none" ) {
            	return;
            }
            
            if ( is_singular('directory') ) {
            	$fw_media_display = "standard";
            }
            
            if ( $fw_media_display == "fw-media-title" && $media_type != "none" ) {
                remove_action( 'atelier_post_article_start', 'atelier_post_detail_heading', 0 );

                $use_thumb_content   = atelier_get_post_meta($post->ID, 'sf_thumbnail_content_main_detail', true );
                $custom_media_height = atelier_get_post_meta($post->ID, 'sf_media_height', true );
                $media_height        = null;
                if ( $custom_media_height != "" ) {
                    $media_height = $custom_media_height;
                } else {
                    $custom_media_height = 0;
                }
                $image_url = atelier_image_post( $post->ID, 1920, $media_height, $use_thumb_content, true )
                ?>
                <div class="detail-feature" style="background-image: url(<?php echo esc_url($image_url); ?>); min-height: <?php echo esc_attr($custom_media_height); ?>px;">
                   <span class="media-overlay"></span>
                    <div class="details-overlay">
                    	<?php do_action( 'atelier_post_detail_media_details_before' ); ?>
                        <h1 class="entry-title"
                            itemprop="name"><?php the_title(); ?></h1>
                        <?php if ( $single_author && ! $remove_dates ) { ?>
                            <div
                                class="post-item-details"><?php echo sprintf( __( 'In %1$s on <time datetime="%2$s" itemprop="datePublished" class="updated">%3$s</time>', 'atelier' ), $post_categories, $post_date_str, $post_date ); ?></div>
                        <?php } else if ( ! $remove_dates ) { ?>
                            <div
                                class="post-item-details"><?php echo sprintf( __( '<span class="vcard author">By <span itemprop="author" class="fn">%1$s</span></span> in %2$s <time class="date updated" datetime="%3$s" itemprop="datePublished">%4$s</time>', 'atelier' ), $post_author, $post_categories, $post_date_str, $post_date ); ?></div>
                        <?php } else if ( ! $single_author ) { ?>
                            <div
                                class="post-item-details"><?php echo sprintf( __( '<span class="vcard author">By <span itemprop="author" class="fn">%1$s</span></span> in %2$s', 'atelier' ), $post_author, $post_categories ); ?></div>
                        <?php } ?>
                    	<?php do_action( 'atelier_post_detail_media_details_after' ); ?>
                    </div>
                </div>
            <?php
            } else if ( $fw_media_display == "fw-media" ) {
                atelier_get_template( 'detail-media' );
            } else if ( ( $pb_active != "true" && !$fw_media_display == "standard" ) ) {
                ?>
                <?php atelier_get_template( 'detail-media' ); ?>
            <?php } else { ?>
                <div class="container">
                    <?php atelier_get_template( 'detail-media' ); ?>
                </div>
            <?php
            }
        }
    	add_action( 'atelier_post_article_start', 'atelier_post_detail_media', 20 );
    }


    /* POST DETAIL LEFT SIDEBAR
    ================================================== */
    if ( ! function_exists( 'atelier_post_left_sidebar' ) ) {
        function atelier_post_left_sidebar() {
            global $post, $atelier_options;
            $left_sidebar  = strtolower(atelier_get_post_meta($post->ID, 'sf_left_sidebar', true ));
			$default_left_sidebar   = $atelier_options['default_post_left_sidebar'];
			if ( $left_sidebar == "" ) {
				$left_sidebar = $default_left_sidebar;
			}
			          
            $sidebar_width = "";
            if ($atelier_options['sidebar_width'] == "reduced") {
            	$sidebar_width = apply_filters( 'atelier_post_sidebar_width', 'col-sm-3' );
            } else {
            	$sidebar_width = apply_filters( 'atelier_post_sidebar_width', 'col-sm-4' );
            }
            ?>

            <aside class="sidebar left-sidebar <?php echo esc_attr($sidebar_width); ?>">
                <div class="sidebar-widget-wrap sticky-widget">
                    <?php
                        /**
                         * @hooked - atelier_post_details - 10
                         **/
                        do_action( 'atelier_post_before_left_sidebar' );
                    ?>

                    <?php dynamic_sidebar( $left_sidebar ); ?>

                    <?php do_action( 'atelier_post_after_left_sidebar' ); ?>
                </div>
            </aside>

        <?php
        }
    }

    /* POST DETAIL RIGHT SIDEBAR
    ================================================== */
    if ( ! function_exists( 'atelier_post_right_sidebar' ) ) {
        function atelier_post_right_sidebar() {
            global $post, $atelier_options;
            $right_sidebar = strtolower(atelier_get_post_meta($post->ID, 'sf_right_sidebar', true ));
            $default_right_sidebar   = $atelier_options['default_post_right_sidebar'];
			if ( $right_sidebar == "" ) {
				$right_sidebar = $default_right_sidebar;
			}
            $sidebar_width = "";
            if ($atelier_options['sidebar_width'] == "reduced") {
            	$sidebar_width = apply_filters( 'atelier_post_sidebar_width', 'col-sm-3' );
            } else {
            	$sidebar_width = apply_filters( 'atelier_post_sidebar_width', 'col-sm-4' );
            }
            ?>

            <aside class="sidebar right-sidebar <?php echo esc_attr($sidebar_width); ?>">
                <div class="sidebar-widget-wrap sticky-widget">
                    <?php
                        /**
                         * @hooked - atelier_post_details - 10
                         **/
                        do_action( 'atelier_post_before_right_sidebar' );
                    ?>

                    <?php dynamic_sidebar( $right_sidebar ); ?>

                    <?php do_action( 'atelier_post_after_right_sidebar' ); ?>
                </div>
            </aside>

        <?php
        }
    }

    /* POST DOWNLOAD
    ================================================== */
    if ( ! function_exists( 'atelier_post_download' ) ) {
        function atelier_post_download() {
            global $post;
            $download_button    = atelier_get_post_meta($post->ID, 'sf_download_button', true );
            $download_file      = atelier_get_post_meta($post->ID, 'sf_download_file', true );
            $download_text      = apply_filters( 'atelier_post_download_text', __( "Download", 'atelier' ) );
            $download_shortcode = atelier_get_post_meta($post->ID, 'sf_download_shortcode', true );
            if ( $download_button ) {
                ?>
                <div class="post-download">
                    <?php if ( $download_shortcode != "" ) {
                        echo do_shortcode( $download_shortcode );
                    } else {
                        ?>
                        <a href="<?php echo wp_get_attachment_url( $download_file ); ?>"
                           class="sf-button accent"><?php echo esc_attr($download_text); ?></a>
                    <?php } ?>
                </div>
            <?php
            }
        }
    }
    add_action( 'atelier_post_content_end', 'atelier_post_download', 10 );

    /* POST REVIEW
    ================================================== */
    if ( ! function_exists( 'atelier_post_review' ) ) {
        function atelier_post_review() {
            global $post, $atelier_options;

            $review_format = "percentage";
            if ( isset( $atelier_options['review_format'] ) ) {
                $review_format = $atelier_options['review_format'];
            }

            $review_cat1_name  = atelier_get_post_meta($post->ID, 'sf_review_cat_1', true );
            $review_cat1_value = atelier_get_post_meta($post->ID, 'sf_review_cat_1_value', true );
            $review_cat2_name  = atelier_get_post_meta($post->ID, 'sf_review_cat_2', true );
            $review_cat2_value = atelier_get_post_meta($post->ID, 'sf_review_cat_2_value', true );
            $review_cat3_name  = atelier_get_post_meta($post->ID, 'sf_review_cat_3', true );
            $review_cat3_value = atelier_get_post_meta($post->ID, 'sf_review_cat_3_value', true );
            $review_cat4_name  = atelier_get_post_meta($post->ID, 'sf_review_cat_4', true );
            $review_cat4_value = atelier_get_post_meta($post->ID, 'sf_review_cat_4_value', true );
            $review_summary    = atelier_get_post_meta($post->ID, 'sf_review_summary', true );

            $review_cat1_width = $review_cat2_width = $review_cat3_width = $review_cat4_width = "";

            $values_array = array();

            if ( $review_cat1_name != "" ) {
                array_push( $values_array, $review_cat1_value );
                $review_cat1_width = atelier_review_barpercent( $review_cat1_value, $review_format );
            }
            if ( $review_cat2_name != "" ) {
                array_push( $values_array, $review_cat2_value );
                $review_cat2_width = atelier_review_barpercent( $review_cat2_value, $review_format );
            }
            if ( $review_cat3_name != "" ) {
                array_push( $values_array, $review_cat3_value );
                $review_cat3_width = atelier_review_barpercent( $review_cat3_value, $review_format );
            }
            if ( $review_cat4_name != "" ) {
                array_push( $values_array, $review_cat4_value );
                $review_cat4_width = atelier_review_barpercent( $review_cat4_value, $review_format );
            }
            ?>
            <div class="article-review-wrap clearfix" itemprop="review" itemscope itemtype="http://schema.org/Review">

                <h2 class="heading"><?php _e( "Review", 'atelier' ); ?></h2>

                <?php if ( $review_cat1_name != "" ) { ?>
                    <div class="review-bar">
                        <div class="bar" data-width="<?php echo esc_attr($review_cat1_width); ?>">
                            <div class="bar-text"><?php echo esc_html($review_cat1_name); ?>
                                <span><?php echo atelier_review_value_adjust($review_cat1_value, $review_format); ?></span></div>
                        </div>
                    </div>
                <?php } ?>
                <?php if ( $review_cat2_name != "" ) { ?>
                    <div class="review-bar">
                        <div class="bar" data-width="<?php echo esc_attr($review_cat2_width); ?>">
                            <div class="bar-text"><?php echo esc_html($review_cat2_name); ?>
                                <span><?php echo atelier_review_value_adjust($review_cat2_value, $review_format); ?></span></div>
                        </div>
                    </div>
                <?php } ?>
                <?php if ( $review_cat3_name != "" ) { ?>
                    <div class="review-bar">
                        <div class="bar" data-width="<?php echo esc_attr($review_cat3_width); ?>">
                            <div class="bar-text"><?php echo esc_html($review_cat3_name); ?>
                                <span><?php echo atelier_review_value_adjust($review_cat3_value, $review_format); ?></span></div>
                        </div>
                    </div>
                <?php } ?>
                <?php if ( $review_cat4_name != "" ) { ?>
                    <div class="review-bar">
                        <div class="bar" data-width="<?php echo esc_attr($review_cat4_width); ?>">
                            <div class="bar-text"><?php echo esc_html($review_cat4_name); ?>
                                <span><?php echo atelier_review_value_adjust($review_cat4_value, $review_format); ?></span></div>
                        </div>
                    </div>
                <?php } ?>

                <div class="review-overview-wrap clearfix">
                    <div class="overview-circle" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                        <span class="overview-text"><?php _e( "Overall", 'atelier' ); ?></span>
                        <?php if ( $review_format == "percentage" ) { ?>
                            <span class="overview-score" itemprop="ratingValue"><?php echo atelier_review_overall( $values_array, $review_format ); ?>%</span>
                        <?php } else { ?>
                            <span class="overview-score score-pts"><?php echo atelier_review_overall( $values_array, $review_format ); ?></span>
                        <?php } ?>
                    </div>
                    <p><?php echo esc_attr($review_summary); ?></p>
                </div>
            </div>
        <?php
        }
    }


    /* POST SHARE
    ================================================== */
    if ( ! function_exists( 'atelier_post_share' ) ) {
        function atelier_post_share() {
            $image      = wp_get_attachment_url( get_post_thumbnail_id() );
            $share_text = apply_filters( 'atelier_post_share_text', __( "Share this", 'atelier' ) );
            ?>
            <div class="article-divider"></div>
            <div class="article-share" data-buttontext="<?php echo esc_attr($share_text); ?>"
                 data-image="<?php echo esc_url($image); ?>"><share-button class="share-button"></share-button></div>
        <?php
        }
    }
    add_action( 'atelier_post_content_end', 'atelier_post_share', 30 );


    /* POST INFO
    ================================================== */
    if ( ! function_exists( 'atelier_post_info' ) ) {
        function atelier_post_info() {
            global $post, $atelier_options;
            $author_info = atelier_get_post_meta($post->ID, 'sf_author_info', true );			$remove_dates     = $atelier_options['remove_dates'];

            if ( is_singular( 'directory' ) ) {
                $author_info = true;
            }
            $post_categories = get_the_category_list( ', ' );
            ?>

            <?php if ( $author_info ) { ?>
                <div class="author-info-wrap clearfix">
                    <div class="author-avatar"><?php if ( function_exists( 'get_avatar' ) ) {
                            echo get_avatar( get_the_author_meta( 'ID' ), '140' );
                        } ?></div>
                    <div class="author-bio">
                        <div class="author-name" itemprop="author" itemscope itemtype="http://schema.org/Person"><h3
                                class="vcard author"><span itemprop="name"
                                                           class="fn"><?php the_author_meta( 'display_name' ); ?></span>
                            </h3></div>
                        <div class="author-bio-text">
                            <?php the_author_meta( 'description' ); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if ( $author_info ) { ?>
                <div class="post-info clearfix">
            <?php } else { ?>
                <div class="post-info post-info-fw clearfix">
            <?php } ?>

           	<?php if ( !$remove_dates ) { ?>
           		<div class="post-date"><?php echo get_the_date(); ?></div>
           	<?php } ?>

            <?php if ( $post_categories ) { ?>
                <div class="categories-wrap"><?php _e( "Categories:", 'atelier' ); ?><span
                        class="categories"><?php echo get_the_category_list( ', ' ); ?></span>
                 </div>
            <?php } ?>
            <?php if ( has_tag() ) { ?>
                <div class="tags-wrap"><?php _e( "Tags:", 'atelier' ); ?><span
                        class="tags"><?php the_tags( '' ); ?></span></div>
            <?php } ?>
            <div class="comments-likes">
                <?php if ( comments_open() ) { ?>
                    <div class="comments-wrapper"><a href="#comments" class="smooth-scroll-link"><?php echo apply_filters( 'atelier_comments_icon', '<i class="ss-chat"></i>' ); ?><span><?php comments_number( __( '0 Comments', 'atelier' ), __( '1 Comment', 'atelier' ), __( '% Comments', 'atelier' ) ); ?></span></a>
                    </div>
                <?php } ?>
                <?php if ( function_exists( 'lip_love_it_link' ) ) {
                    lip_love_it_link( get_the_ID(), true, 'text' );
                } ?>
            </div>
            </div>

        <?php
        }
    }
    add_action( 'atelier_post_content_end', 'atelier_post_info', 40 );


    /* POST PAGINATION
    ================================================== */
    if ( ! function_exists( 'atelier_post_pagination' ) ) {
		function atelier_post_pagination() {
		    global $atelier_options, $atelier_sidebar_config;

		    $single_author    = $atelier_options['single_author'];
		    $remove_dates     = $atelier_options['remove_dates'];
		    $pagination_style = "standard";
		    if ( isset( $atelier_options['pagination_style'] ) ) {
		        $pagination_style = $atelier_options['pagination_style'];
		    }
		    $enable_category_navigation = $atelier_options['enable_category_navigation'];

			$prev_post = get_next_post($enable_category_navigation, '', 'category');
			$next_post = get_previous_post($enable_category_navigation, '', 'category');
		   
		    $has_both  = false;

		    if ( atelier_theme_opts_name() == "atelier_joyn_options" && $pagination_style == "fs-arrow" ) {
		        return;
		    }

		    if ( ! empty( $next_post ) && ! empty( $prev_post ) ) {
		        $has_both = true;
		    }
		    ?>

		    <?php if ( ! empty( $next_post ) || ! empty( $prev_post )) { ?>
		    <?php if ($has_both) { ?>
		    <div class="post-pagination-wrap prev-next">
		    <?php } else { ?>
		    <div class="post-pagination-wrap">
		        <?php } ?>

		        <div class="container">

		            <?php if ( ! empty( $next_post ) ) {
		                $author_id       = $next_post->post_author;
		                $author_name     = get_the_author_meta( 'display_name', $author_id );
		                $author_url      = get_author_posts_url( $author_id );
		                $post_date       = get_the_date();
		                $post_date_str   = get_the_date('Y-m-d');
		                $post_categories = get_the_category_list( ', ', '', $next_post->ID );
		                ?>
		                <div class="next-article">
		                    <h6><?php _e( "Next Article", 'atelier' ); ?></h6>

		                    <h2>
		                        <a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo esc_html($next_post->post_title); ?></a>
		                    </h2>
		                    <?php if ( $single_author && ! $remove_dates ) { ?>
		                        <div
		                            class="blog-item-details"><?php echo sprintf( __( 'In %1$s on <time datetime="%2$s">%3$s</time>', 'atelier' ), $post_categories, $post_date_str, $post_date ); ?></div>
		                    <?php } else if ( ! $remove_dates ) { ?>
		                        <div
		                            class="blog-item-details"><?php echo sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s on <time datetime="%4$s">%5$s</time>', 'atelier' ), $author_name, $author_url, $post_categories, $post_date_str, $post_date ); ?></div>
		                    <?php } else if ( ! $single_author ) { ?>
		                        <div
		                            class="blog-item-details"><?php echo sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s', 'atelier' ), $author_name, $author_url, $post_categories ); ?></div>
		                    <?php } ?>
		                </div>
		            <?php } ?>

		            <?php if ( ! empty( $prev_post ) ) {
		                $author_id       = $prev_post->post_author;
		                $author_name     = get_the_author_meta( 'display_name', $author_id );
		                $author_url      = get_author_posts_url( $author_id );
		                $post_date       = get_the_date();
		                $post_date_str   = get_the_date('Y-m-d');
		                $post_categories = get_the_category_list( ', ', '', $prev_post->ID );
		                ?>
		                <div class="prev-article">
		                    <h6><?php _e( "Previous Article", 'atelier' ); ?></h6>

		                    <h2>
		                        <a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo esc_html($prev_post->post_title); ?></a>
		                    </h2>
		                    <?php if ( $single_author && ! $remove_dates ) { ?>
		                        <div
		                            class="blog-item-details"><?php echo sprintf( __( 'In %1$s on <time datetime="%2$s">%3$s</time>', 'atelier' ), $post_categories, $post_date_str, $post_date ); ?></div>
		                    <?php } else if ( ! $remove_dates ) { ?>
		                        <div
		                            class="blog-item-details"><?php echo sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s on <time datetime="%4$s">%5$s</time>', 'atelier' ), $author_name, $author_url, $post_categories, $post_date_str, $post_date ); ?></div>
		                    <?php } else if ( ! $single_author ) { ?>
		                        <div
		                            class="blog-item-details"><?php echo sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s', 'atelier' ), $author_name, $author_url, $post_categories ); ?></div>
		                    <?php } ?>
		                </div>
		            <?php } ?>

		        </div>

		    </div>
		    <?php } ?>

		<?php
		}
    	add_action( 'atelier_post_after_article', 'atelier_post_pagination', 5 );
	}


    /* POST RELATED ARTICES
    ================================================== */
    if ( ! function_exists( 'atelier_post_related_articles' ) ) {
        function atelier_post_related_articles() {

            $related_articles_class = apply_filters( 'atelier_post_related_articles_wrap_class', 'container' );
			$related_articles_display_type = apply_filters( 'atelier_related_articles_display_type', 'bold' );
			$related_articles_excerpt_length = apply_filters( 'atelier_related_articles_excerpt_length', 20 );
			$related_articles_count = apply_filters( 'atelier_related_posts_count', 4 );
            $related_articles_item_class = apply_filters( 'atelier_related_posts_item_class', 'col-sm-3' );
            $related_articles_heading = apply_filters( 'atelier_related_posts_heading', __( "Related Articles", 'atelier' ) );

			
			$list_class = 'posts-type-'.$related_articles_display_type;

			if ($related_articles_display_type == "bold") {
				$list_class .= ' no-gutters';
			} else {
				$list_class .= ' row';
			}

            global $post;

            $args       = array();
            $tags       = wp_get_post_tags( $post->ID );
            $categories = get_the_category( $post->ID );
            if ( ! empty( $tags ) ) {
                $tag_ids = array();
                foreach ( $tags as $individual_tag ) {
                    $tag_ids[] = $individual_tag->term_id;
                }
                $args = array(
                    'tag__in'             => $tag_ids,
                    'post__not_in'        => array( $post->ID ),
                    'posts_per_page'      => $related_articles_count, // Number of related posts to display.
                    'ignore_sticky_posts' => 1
                );
            } else if ( ! empty( $categories ) ) {
                $category_ids = array();
                foreach ( $categories as $individual_category ) {
                    $category_ids[] = $individual_category->term_id;
                }

                $args = array(
                    'category__in'   => $category_ids,
                    'post__not_in'   => array( $post->ID ),
                    'posts_per_page' => $related_articles_count, // Number of related posts that will be shown.
                    'orderby'        => 'rand'
                );
            }

            $related_posts_query = new WP_Query( $args );
            if ( $related_posts_query->have_posts() ) {
                echo '<div class="related-wrap">';
                echo '<div class="related-articles ' . $related_articles_class . '">';
                echo '<div class="title-wrap"><h3 class="spb-heading"><span>' . $related_articles_heading . '</span></h3></div>';
                echo '<div class=" recent-posts '.$list_class.' clearfix">';

                while ( $related_posts_query->have_posts() ) : $related_posts_query->the_post();
                    echo atelier_get_recent_post_item( $post, $related_articles_display_type, $related_articles_excerpt_length, $related_articles_item_class );
                endwhile;

                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            wp_reset_query();
        }
    	add_action( 'atelier_post_after_article', 'atelier_post_related_articles', 10 );
	}


    /* POST COMMENTS
    ================================================== */
    if ( ! function_exists( 'atelier_post_comments' ) ) {
        function atelier_post_comments() {

            $comments_wrap_class = apply_filters( 'atelier_post_comments_wrap_class', 'comments-wrap container' );
            $comments_class = apply_filters( 'atelier_post_comments_class', 'col-sm-8 col-sm-offset-2' );

            if ( comments_open() ) {
                ?>
                <div class="<?php echo esc_attr($comments_wrap_class); ?>">
                    <div id="comment-area" class="<?php echo esc_attr($comments_class); ?>">
                        <?php comments_template( '', true ); ?>
                    </div>
                </div>
            <?php
            }
        }
    }
    add_action( 'atelier_post_after_article', 'atelier_post_comments', 20 );
