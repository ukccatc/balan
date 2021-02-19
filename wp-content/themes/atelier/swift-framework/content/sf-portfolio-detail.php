<?php

    /*
    *
    *	Swift Page Builder - Portfolio Detail Function Class
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	atelier_portfolio_detail_media()
    *	atelier_portfolio_item_details()
    *	atelier_portfolio_related_projects()
    *
    */

    /* PORTFOLIO DETAIL MEDIA
    ================================================== */
    if ( ! function_exists( 'atelier_portfolio_detail_media' ) ) {
        function atelier_portfolio_detail_media() {
            global $post, $atelier_options;
            $media_type = $media_image = $media_video = $media_audio = $media_mp4 = $media_ogg = $media_webm = $media_gallery = $image_alt = '';

            $default_detail_media = $atelier_options['default_detail_media'];
            $fw_media_display     = atelier_get_post_meta($post->ID, 'sf_fw_media_display', true );
            $use_thumb_content    = atelier_get_post_meta($post->ID, 'sf_thumbnail_content_main_detail', true );
            $hide_details         = atelier_get_post_meta($post->ID, 'sf_hide_details', true );
            $item_categories      = get_the_term_list( $post->ID, 'portfolio-category', '<li>', '</li><li>', '</li>' );
            $item_link            = atelier_get_post_meta($post->ID, 'sf_portfolio_external_link', true );
            $custom_media_height  = atelier_get_post_meta($post->ID, 'sf_media_height', true );

            if ( $use_thumb_content ) {
                $media_type    = atelier_get_post_meta($post->ID, 'sf_thumbnail_type', true );
                $media_image   = rwmb_meta('sf_thumbnail_image', 'type=image&size=full' );
                $media_video   = atelier_get_post_meta($post->ID, 'sf_thumbnail_video_url', true );
                $media_gallery = rwmb_meta('sf_thumbnail_gallery', 'type=image&size=thumb-image-onecol' );
                $media_mp4     = atelier_get_post_meta($post->ID, 'sf_thumbnail_video_mp4', true );
                $media_ogg     = atelier_get_post_meta($post->ID, 'sf_thumbnail_video_ogg', true );
                $media_webm    = atelier_get_post_meta($post->ID, 'sf_thumbnail_video_webm', true );
            } else {
                $media_type        = atelier_get_post_meta($post->ID, 'sf_detail_type', true );
                $media_image       = rwmb_meta('sf_detail_image', 'type=image&size=full' );
                $media_video       = atelier_get_post_meta($post->ID, 'sf_detail_video_url', true );
                $media_gallery     = rwmb_meta('sf_detail_gallery', 'type=image&size=thumb-image-onecol' );
                $media_slider      = atelier_get_post_meta($post->ID, 'sf_detail_rev_slider_alias', true );
                $media_layerslider = atelier_get_post_meta($post->ID, 'sf_detail_layer_slider_alias', true );
                $custom_media      = atelier_get_post_meta($post->ID, 'sf_custom_media', true );
                $media_audio       = atelier_get_post_meta($post->ID, 'sf_detail_audio_url', true );
                $media_mp4         = atelier_get_post_meta($post->ID, 'sf_detail_video_mp4', true );
                $media_ogg         = atelier_get_post_meta($post->ID, 'sf_detail_video_ogg', true );
                $media_webm        = atelier_get_post_meta($post->ID, 'sf_detail_video_webm', true );
            }

            if ( $media_type == "" ) {
                $media_type = $default_detail_media;
            }

            if (isset($media_image) && is_array($media_image)) {
                foreach ( $media_image as $detail_image ) {
                    $media_image_url = $detail_image['url'];
                    $share_image_url = $media_image_url;
                    $image_alt       = esc_attr( atelier_get_post_meta( $detail_image['ID'], '_wp_attachment_image_alt', true ) );
                    break;
                }
            }

            if ( ! $media_image ) {
                $media_image     = get_post_thumbnail_id();
                $media_image_url = wp_get_attachment_url( $media_image, 'full' );
                $share_image_url = $media_image_url;
                $image_alt       = esc_attr( atelier_get_post_meta( $media_image, '_wp_attachment_image_alt', true ) );
            }
            
            // ENQUEUE SCRIPT
            if ( $media_type == "slider" ) {
                wp_enqueue_script( 'flexslider' );
            }

            // META VARIABLES
            $media_width  = 850;
            $video_height = 638;
            if ( $fw_media_display ) {
                $media_width  = 2000;
                $video_height = 1125;
            }
            $media_height = null;

            if ( $custom_media_height != "" ) {
                $media_height = $custom_media_height;
            }
            ?>

            <?php if ( $fw_media_display == "fw-media" ) { ?>
                <figure class="media-wrap fw-media-wrap media-type-<?php echo esc_attr($media_type); ?>">
            <?php } else if ( $fw_media_display == "poster" ) { ?>
            	<figure class="media-wrap fw-media-wrap media-type-<?php echo esc_attr($media_type); ?> detail-feature">
            <?php } else if ( $fw_media_display == "split" ) { ?>
                <figure class="media-wrap col-sm-9 media-type-<?php echo esc_attr($media_type); ?>">
            <?php } else { ?>
                <figure class="media-wrap container media-type-<?php echo esc_attr($media_type); ?>">
            <?php } ?>
            
            	<?php do_action( 'atelier_portfolio_article_figure_inner' ); ?>
            
            <?php if ( $fw_media_display == "poster" ) {            
            	$item_subtitle = atelier_get_post_meta($post->ID, 'sf_portfolio_subtitle', true );
            ?>
            
	            <div class="details-overlay">
	                <h1 class="entry-title" itemprop="name"><?php the_title(); ?></h1>
	                <?php if ( $item_subtitle != "" ) { ?>
	                <h2><?php echo esc_html($item_subtitle); ?></h2>
	                <?php } ?>
	            </div>
            
            <?php } ?>
            

            <?php if ( $media_type == "video" ) { ?>

                <?php echo atelier_video_embed( $media_video, $media_width, $video_height ); ?>

            <?php } else if ( $media_type == "slider" ) { ?>

                <div class="flexslider item-slider">

                    <ul class="slides">

                        <?php foreach ( $media_gallery as $image ) {
                            echo "<li>";
                            if ( ! empty( $image['caption'] ) ) {
                                echo "<p class='flex-caption'>{$image['caption']}</p>";
                            }
                            echo "<img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' />";
                            echo "</li>";
                        } ?>

                    </ul>

                </div>

            <?php } else if ( $media_type == "gallery-stacked" ) { ?>

                <?php foreach ( $media_gallery as $image ) {
                    echo "<img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' />";
                } ?>

            <?php } else if ( $media_type == "layer-slider" ) { ?>

                <div class="layerslider">

                    <?php if ( $media_slider != "" ) {

                        echo do_shortcode( '[rev_slider ' . $media_slider . ']' );

                    } else {

                        echo do_shortcode( '[layerslider id="' . $media_layerslider . '"]' );

                    } ?>

                </div>

            <?php
            } else if ( $media_type == "sh-video" ) {
                $media_mp4  = 'mp4="' . $media_mp4 . '"';
                $media_ogg  = 'ogg="' . $media_ogg . '"';
                $media_webm = 'webm="' . $media_webm . '"';
                $poster     = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large', true );
                if ( isset( $poster ) & $poster != "" ) {
                    $poster = 'poster="' . $poster[0] . '"';
                }
                ?>
                <div class="sh-video-wrap">
                    <?php echo do_shortcode( '[video ' . $media_mp4 . ' ' . $media_ogg . ' ' . $media_webm . ' ' . $poster . ']' ); ?>
                </div>

            <?php
            } else if ( $media_type == "audio" ) {

                echo do_shortcode( '[audio src="' . $media_audio . '"]' );

            } else if ( $media_type == "custom" ) {

                echo do_shortcode( $custom_media );

            } else {
                ?>

                <?php $detail_image = atelier_aq_resize( $media_image_url, $media_width, $media_height, true, false ); ?>

                <?php if ( $detail_image ) { ?>

                    <img itemprop="image" src="<?php echo esc_url($detail_image[0]); ?>" width="<?php echo esc_attr($detail_image[1]); ?>"
                         height="<?php echo esc_attr($detail_image[2]); ?>" alt="<?php echo esc_attr($image_alt); ?>"/>

                <?php } ?>

            <?php } ?>

            </figure>

        <?php
        }
        add_action( 'atelier_portfolio_article_start', 'atelier_portfolio_detail_media', 20 );
    }

    /* PORTFOLIO ITEM DETAILS
    ================================================== */
	if ( ! function_exists( 'atelier_portfolio_item_details' ) ) {
		function atelier_portfolio_item_details() {
		    global $post;
		    $item_sidebar_content = atelier_get_post_meta($post->ID, 'sf_item_sidebar_content', true );
		    $client               = atelier_get_post_meta($post->ID, 'sf_portfolio_client', true );
		    $item_link            = atelier_get_post_meta($post->ID, 'sf_portfolio_external_link', true );
		    $item_categories      = get_the_term_list( $post->ID, 'portfolio-category', '<li>', '</li><li>', '</li>' );
		    $fw_media_display     = atelier_get_post_meta($post->ID, 'sf_fw_media_display', true );
		    $image                = wp_get_attachment_url( get_post_thumbnail_id() );
		    $pb_active            = atelier_get_post_meta( $post->ID, '_spb_status', true );
		    ?>
		<?php if ($fw_media_display == "split") { ?>
		<section class="item-details">
		    <?php } else if ($pb_active == "true") { ?>
		    <section class="item-details container">
		    <?php } else { ?>
		    <section class="item-details col-sm-3">
		        <?php } ?>
		        <?php if ( $item_sidebar_content != "" ) { ?>
		            <div class="sidebar-content">
		                <?php echo do_shortcode( $item_sidebar_content ); ?>
		            </div>
		        <?php } ?>
		        <?php if ( $client != "" ) { ?>
		            <div class="client"><span><?php _e( "Client:", 'atelier' ); ?></span><?php echo esc_attr($client); ?></div>
		        <?php } ?>
		        <time class="date updated" itemprop="datePublished" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>">
		            <span><?php _e( "Date:", 'atelier' ); ?></span><?php echo get_the_date(); ?></time>
		        <?php if ( $item_link != "" ) { ?>
		            <a class="item-link" href="<?php echo esc_url($item_link); ?>" target="_blank"><?php echo apply_filters( 'atelier_link_icon', '<i class="ss-link"></i>' ); ?><?php _e( "View Project", 'atelier' ); ?></a>
		        <?php } ?>
		        <?php if ( $item_categories != "" ) { ?>
		            <ul class="portfolio-categories">
		                <?php echo get_the_term_list( $post->ID, 'portfolio-category', '<li>', '</li><li>', '</li>' ); ?>
		            </ul>
		        <?php } ?>
		        <?php
                    $page_permalink = urlencode(get_the_permalink());
                    $page_title = get_the_title();
                    $page_thumb_id = get_post_thumbnail_id();
                    $page_thumb_url = wp_get_attachment_url( $page_thumb_id );
                    $manual_count = atelier_get_post_meta( $post->ID, 'bit_manual_share_count', true );
                    $icon_prefix = 'fab ';

                    echo '<div class="sf-share-counts">';         
                    echo '<h3 class="share-text">'.__("Share", 'swift-framework-plugin').'</h3>';
                    echo '<a href="https://www.facebook.com/sharer/sharer.php?u='.$page_permalink.'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=440,width=660\');return false;" class="sf-share-link sf-share-fb"><i class="' . $icon_prefix . 'fa-facebook"></i><span class="count">0</span></a>';
                    echo '<a href="http://twitter.com/share?text='.$page_title.'&url='.$page_permalink.'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=440,width=660\');return false;" class="sf-share-link sf-share-twit"><i class="' . $icon_prefix . 'fa-twitter"></i><span class="count">0</span></a>';
                    echo '<a href="http://pinterest.com/pin/create/button/?url='.$page_permalink.'&media='.$page_thumb_url.'&description='.$page_title.'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=690,width=750\');return false;" class="sf-share-link sf-share-pin"><i class="' . $icon_prefix . 'fa-pinterest"></i><span class="count">0</span></a>';
                    echo '</div>';
                ?>
		    </section>
		
		<?php
		}
	    add_action( 'atelier_after_portfolio_content', 'atelier_portfolio_item_details', 0 );
	}


    /* PORTFOLIO RELATED PROJECTS
    ================================================== */
    if ( ! function_exists( 'atelier_portfolio_related_projects' ) ) {
        function atelier_portfolio_related_projects() {
            global $post, $atelier_options;
            $fullwidth  = $atelier_options['related_projects_fullwidth'];
            $gutters = false;
            if ( isset($atelier_options['related_projects_gutters']) ) {
            $gutters  = $atelier_options['related_projects_gutters'];
            }
            $item_count = $atelier_options['related_projects_columns'];
            $related    = atelier_portfolio_related_posts( $post->ID, $item_count );
            $item_class = "col-sm-4";
            $wrap_class = $heading_class = "";
            if ( $fullwidth ) {
                $heading_class = "container";
            } else {
                $wrap_class = "container";
            }
            $hover_style = "default";
			
			if ( $gutters ) {
				$wrap_class .= " gutters";
			} else {
				$wrap_class .= " no-gutters";
			}
			
            // Thumb Type
            if ( function_exists( 'atelier_get_thumb_type' ) && atelier_theme_opts_name() == "sf_atelier_options" ) {
                $wrap_class .= ' ' . atelier_get_thumb_type();
            } else if ( function_exists( 'atelier_get_thumb_type' ) && $hover_style == "default" ) {
                $wrap_class .= ' ' . atelier_get_thumb_type();
            } else {
                $wrap_class .= ' thumbnail-' . $hover_style;
            }

            if ( $item_count == "4" ) {
                $item_class = "col-sm-3";
            }
            if ( atelier_theme_supports( 'alt-gallery-hover' ) ) {
            	$item_class .= " portfolio-item gallery-item";
            }
            if ( $related->have_posts() ) {
                ?>
                <section class="related-projects <?php echo esc_attr($wrap_class); ?> clearfix">

                    <h2 class="<?php echo esc_attr($heading_class); ?>"><?php echo apply_filters('atelier_related_projects_heading', __( "Related Projects", 'atelier' )); ?></h2>

                    <div class="row clearfix">
                        <?php while ( $related->have_posts() ): $related->the_post(); ?>
                            <?php
                            $item_title    = get_the_title();
                            $item_subtitle = atelier_get_post_meta($post->ID, 'sf_portfolio_subtitle', true );
                            $thumb_image   = $port_hover_style = $port_hover_text_style = "";
                            $thumb_image   = atelier_get_post_meta($post->ID, 'sf_thumbnail_image', true );
                            if ( ! $thumb_image ) {
                                $thumb_image = get_post_thumbnail_id();
                            }
                            $thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
                            if ( $thumb_img_url == "" ) {
                                $thumb_img_url = "default";
                            }
                            $image                 = atelier_aq_resize( $thumb_img_url, 500, 375, true, false );
                            $image_alt             = esc_attr( atelier_get_post_meta( $thumb_image, '_wp_attachment_image_alt', true ) );
                            $port_hover_bg_color   = atelier_get_post_meta($post->ID, 'sf_port_hover_bg_color', true );
                            $port_hover_text_color = atelier_get_post_meta($post->ID, 'sf_port_hover_text_color', true );
                            if ( $port_hover_bg_color != "" ) {
                            	if ( isset( $atelier_options['overlay_opacity'] ) ) {
                                	$overlay_opacity = $atelier_options['overlay_opacity'];
                                	if ( $overlay_opacity == 100 ) {
                                	    $overlay_opacity = '1';
                                	} else {
                                	    $overlay_opacity = '0.' . $overlay_opacity;
                                	}
                                	$port_hover_bg_rgb = atelier_hex2rgb( $port_hover_bg_color );
                                	$port_hover_style  = 'style="background-color:rgba(' . $port_hover_bg_rgb['red'] . ',' . $port_hover_bg_rgb['green'] . ',' . $port_hover_bg_rgb['blue'] . ',' . $overlay_opacity . ');"';
                                } else if ( isset( $atelier_options['overlay_opacity_top'] ) ) {
                                	$overlay_opacity_top   = $atelier_options['overlay_opacity_top'];
                                	$overlay_opacity_bottom = $atelier_options['overlay_opacity_bottom'];
                                	$port_hover_bg_rgb = atelier_hex2rgb( $port_hover_bg_color );
                                	if ( $overlay_opacity_top < 100 || $overlay_opacity_bottom < 100 ) {
                                		$overlay_opacity_top = ($overlay_opacity_top < 100 ? '0.' . $overlay_opacity_top : '1.0');
                                		$overlay_opacity_bottom = ($overlay_opacity_bottom < 100 ? '0.' . $overlay_opacity_bottom : '1.0');
                                	    $port_hover_style = 'style="background: -webkit-gradient(linear,left top,left bottom,color-stop(25%,rgba(' . $port_hover_bg_rgb["red"] . ',' . $port_hover_bg_rgb["green"] . ',' . $port_hover_bg_rgb["blue"] . ', ' . $overlay_opacity_top .')),to(rgba(' . $port_hover_bg_rgb["red"] . ',' . $port_hover_bg_rgb["green"] . ',' . $port_hover_bg_rgb["blue"] . ', ' . $overlay_opacity_bottom . ')));
                                	    	background: -webkit-linear-gradient(top, rgba(' . $port_hover_bg_rgb["red"] . ',' . $port_hover_bg_rgb["green"] . ',' . $port_hover_bg_rgb["blue"] . ', ' . $overlay_opacity_top .') 25%,rgba(' . $port_hover_bg_rgb["red"] . ',' . $port_hover_bg_rgb["green"] . ',' . $port_hover_bg_rgb["blue"] . ', ' . $overlay_opacity_bottom . ') 100%);
                                	    	background: linear-gradient(to bottom, rgba(' . $port_hover_bg_rgb["red"] . ',' . $port_hover_bg_rgb["green"] . ',' . $port_hover_bg_rgb["blue"] . ', ' . $overlay_opacity_top .') 25%, rgba(' . $port_hover_bg_rgb["red"] . ',' . $port_hover_bg_rgb["green"] . ',' . $port_hover_bg_rgb["blue"] . ', ' . $overlay_opacity_bottom . ') 100%);"';
                                	}
                                	
                                }
                            }
                            if ( $port_hover_text_color != "" ) {
                                $port_hover_text_style = 'style="color: ' . $port_hover_text_color . ';"';
                            }
                            ?>

                            <article class="<?php echo esc_attr($item_class); ?>">
                                <figure class="animated-overlay overlay-style">
                                    <img src="<?php echo esc_url($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>"
                                         height="<?php echo esc_attr($image[2]); ?>" alt="<?php echo esc_attr($image_alt); ?>"/>
                                    <a href="<?php the_permalink(); ?>"></a>
                                    <figcaption <?php echo esc_attr($port_hover_style); ?>>
                                        <div class="thumb-info">
                                            <h4 <?php echo esc_attr($port_hover_text_style); ?>><?php echo esc_attr($item_title); ?></h4>
                                            <div class="name-divide"></div>
                                            <h5 <?php echo esc_attr($port_hover_text_style); ?>><?php echo esc_attr($item_subtitle); ?></h5>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                        <?php endwhile; ?>
                    </div>

                </section>

            <?php
            }
        }

        add_action( 'atelier_portfolio_after_article', 'atelier_portfolio_related_projects', 0 );
    }
?>
