<?php

    /*
    *
    *	Swift Framework Media Functions
    *	------------------------------------------------
    *	Swift Framework v3.0
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	atelier_return_slider()
    *	atelier_video_embed()
    *	atelier_video_youtube()
    *	atelier_video_vimeo()
    *	atelier_get_embed_src()
    *	atelier_featured_img_title()
    *
    */


    /* REVSLIDER RETURN FUNCTION
    ================================================== */
    function atelier_return_slider( $revslider_shortcode ) {
        ob_start();
        if ( function_exists('putRevSlider') ) {
        	putRevSlider( $revslider_shortcode );
        }
        return ob_get_clean();
    }


    /* VIDEO EMBED FUNCTIONS
    ================================================== */
    function atelier_get_vimeoid( $url ) {
        $regex = '~
		            # Match Vimeo link and embed code
		            (?:<iframe [^>]*src=")?     # If iframe match up to first quote of src
		            (?:                         # Group vimeo url
		                https?:\/\/             # Either http or https
		                (?:[\w]+\.)*            # Optional subdomains
		                vimeo\.com              # Match vimeo.com
		                (?:[\/\w]*\/videos?)?   # Optional video sub directory this handles groups links also
		                \/                      # Slash before Id
		                ([0-9]+)                # $1: VIDEO_ID is numeric
		                [^\s]*                  # Not a space
		            )                           # End group
		            "?                          # Match end quote if part of src
		            (?:[^>]*></iframe>)?        # Match the end of the iframe
		            (?:<p>.*</p>)?              # Match any title information stuff
		            ~ix';

        preg_match( $regex, $url, $matches );

        $vimeo_ID_fallback = substr( $url, strrpos( $url, '/' ) + 1 );

        if ( isset( $matches[1] ) ) {
            return $matches[1];
        } else {
            return $vimeo_ID_fallback;
        }
    }

    if ( ! function_exists( 'atelier_video_embed' ) ) {
        function atelier_video_embed( $url, $width = 640, $height = 480 ) {
            if ( strpos( $url, 'youtube' ) || strpos( $url, 'youtu.be' ) ) {
                return atelier_video_youtube( $url, $width, $height );
            } else {
                return atelier_video_vimeo( $url, $width, $height );
            }
        }
    }

    if ( ! function_exists( 'atelier_video_youtube' ) ) {
        function atelier_video_youtube( $url, $width = 640, $height = 480 ) {
            preg_match( '/[\\?\\&]v=([^\\?\\&]+)/', $url, $video_id );
            $youtube_params = apply_filters( 'atelier_youtube_embed_params', '?showinfo=0&controls=1&modestbranding=1' );

            $video_padding = ( intval( $height, 10 ) / intval( $width, 10 ) ) * 100;
            $inline_style  = 'padding-bottom: ' . $video_padding . '%;';
            $ssl_override = apply_filters( 'atelier_video_youtube_ssl', false );

            if ( is_ssl() || $ssl_override ) {
                return '<div class="sf-video-wrap" style="' . $inline_style . '"><iframe itemprop="video" class="video-embed" src="https://www.youtube.com/embed/' . $video_id[1] . $youtube_params . '" width="' . $width . '" height="' . $height . '" allowfullscreen></iframe></div>';
            } else {
                return '<div class="sf-video-wrap" style="' . $inline_style . '"><iframe itemprop="video" class="video-embed" src="http://www.youtube.com/embed/' . $video_id[1] . $youtube_params . '" width="' . $width . '" height="' . $height . '" allowfullscreen></iframe></div>';
            }
        }
    }

    if ( ! function_exists( 'atelier_video_vimeo' ) ) {
        function atelier_video_vimeo( $url, $width = 640, $height = 480 ) {
            $url          = str_replace( 'https://', 'http://', $url );
            $video_id     = atelier_get_vimeoid( $url );
            $vimeo_params = apply_filters( 'atelier_vimeo_embed_params', '?title=0&amp;byline=0&amp;portrait=0' );

            $video_padding = ( intval( $height, 10 ) / intval( $width, 10 ) ) * 100;
            $inline_style  = 'padding-bottom: ' . $video_padding . '%;';
			$ssl_override = apply_filters( 'atelier_video_vimeo_ssl', false );
			
            if ( $video_id == "" ) {
                return '<div class="sf-video-wrap">' . __( "Video not found", 'atelier' ) . '</div>';
            }

            if ( is_ssl() || $ssl_override ) {
                return '<div class="sf-video-wrap" style="' . $inline_style . '"><iframe itemprop="video" class="video-embed" src="https://player.vimeo.com/video/' . $video_id . $vimeo_params . '" width="' . $width . '" height="' . $height . '" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
            } else {
                return '<div class="sf-video-wrap" style="' . $inline_style . '"><iframe itemprop="video" class="video-embed" src="http://player.vimeo.com/video/' . $video_id . $vimeo_params . '" width="' . $width . '" height="' . $height . '" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
            }
        }
    }

    if ( ! function_exists( 'atelier_get_embed_src' ) ) {
        function atelier_get_embed_src( $url ) {
            if ( strpos( $url, 'youtube' ) ) {
                preg_match( '/[\\?\\&]v=([^\\?\\&]+)/', $url, $video_id );
                $youtube_params = apply_filters( 'atelier_youtube_embed_src_params', '?autoplay=1' );
                if ( is_ssl() ) {
                    if ( isset( $video_id[1] ) ) {
                        return 'https://www.youtube.com/embed/' . $video_id[1] . $youtube_params;
                    }
                } else {
                    if ( isset( $video_id[1] ) ) {
                        return 'http://www.youtube.com/embed/' . $video_id[1] . $youtube_params;
                    }
                }
            } else {
                $url          = str_replace( 'https://', 'http://', $url );
                $video_id     = atelier_get_vimeoid( $url );
                $time_stamp = explode('#',$url);
                $video_id  = (!empty($time_stamp[1]))?$video_id.'#'.$time_stamp[1]:$video_id;
                $vimeo_params = apply_filters( 'atelier_vimeo_embed_src_params', '?title=0&byline=0&portrait=0&autoplay=1' );
                if ( is_ssl() ) {
                    if ( $video_id != "" ) {
                        return 'https://player.vimeo.com/video/' . $video_id . $vimeo_params;
                    }
                } else {
                    if ( $video_id != "" ) {
                        return 'http://player.vimeo.com/video/' . $video_id . $vimeo_params;
                    }
                }
            }
        }
    }


    /* FEATURED IMAGE TITLE
    ================================================== */
    function atelier_featured_img_title() {
        global $post;
        $atelier_thumbnail_id    = get_post_thumbnail_id( $post->ID );
        $atelier_thumbnail_image = get_posts( array( 'p'           => $atelier_thumbnail_id,
                                                'post_type'   => 'attachment',
                                                'post_status' => 'any'
            ) );
        if ( $atelier_thumbnail_image && isset( $atelier_thumbnail_image[0] ) ) {
            return $atelier_thumbnail_image[0]->post_title;
        }
    }


	/* GET ATTACHMENT META
    ================================================== */
    if ( ! function_exists( 'atelier_get_attachment_meta' ) ) {
	    function atelier_get_attachment_meta( $attachment_id ) {
	
			$attachment = get_post( $attachment_id );
	
			if ( isset( $attachment ) ) {
				return array(
					'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
					'caption' => $attachment->post_excerpt,
					'description' => $attachment->post_content,
					'href' => get_permalink( $attachment->ID ),
					'src' => $attachment->guid,
					'title' => $attachment->post_title
				);
			}
		}
	}

?>
