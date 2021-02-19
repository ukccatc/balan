<?php
    global $post, $atelier_options;

    $media_type = $media_image = $media_video = $media_gallery = '';

    $default_detail_media = $atelier_options['default_detail_media'];
    $fw_media_display     = atelier_get_post_meta($post->ID, 'sf_fw_media_display', true );
    $custom_media_height  = atelier_get_post_meta($post->ID, 'sf_media_height', true );
    $use_thumb_content    = atelier_get_post_meta($post->ID, 'sf_thumbnail_content_main_detail', true );
    $post_format          = get_post_format( $post->ID );
    if ( $post_format == "" ) {
        $post_format = 'standard';
    }
    if ( $use_thumb_content ) {
        $media_type = atelier_get_post_meta($post->ID, 'sf_thumbnail_type', true );
    } else {
        $media_type = atelier_get_post_meta($post->ID, 'sf_detail_type', true );
    }
    if ( $media_type == "" ) {
        $media_type = $default_detail_media;
    }

    $media_slider      = atelier_get_post_meta($post->ID, 'sf_detail_rev_slider_alias', true );
    $media_layerslider = atelier_get_post_meta($post->ID, 'sf_detail_layer_slider_alias', true );
    $custom_media      = atelier_get_post_meta($post->ID, 'sf_custom_media', true );

    $media_width  = 1170;
    $media_height = null;
    if ( $custom_media_height != "" && $fw_media_display == "fw-media-title" ) {
        $media_height = $custom_media_height;
    }
    if ( $fw_media_display == "fw-media-title" || $fw_media_display == "fw-media" ) {
        $media_width = 1920;
    }
    $video_height = 658;

?>

<figure class="media-wrap media-type-<?php esc_attr($media_type); ?>" itemscope>

    <?php if ( $post_format == "standard" ) {

        if ( $media_type == "video" ) {

            echo atelier_video_post( $post->ID, $media_width, $video_height, $use_thumb_content );

        } else if ( $media_type == "slider" ) {

            echo atelier_gallery_post( $post->ID, $use_thumb_content );

        } else if ( $media_type == "gallery-stacked" ) {

            echo atelier_gallery_stacked_post( $post->ID, $use_thumb_content );

        } else if ( $media_type == "layer-slider" ) {

            echo '<div class="layerslider">';

            if ( $media_slider != "" ) {

                echo do_shortcode( '[rev_slider ' . $media_slider . ']' );

            } else {

                echo do_shortcode( '[layerslider id="' . $media_layerslider . '"]' );

            }

            echo '</div>';

        } else if ( $media_type == "audio" ) {

            echo '<div class="audio-detail">' . atelier_audio_post( $post->ID, $use_thumb_content ) . '</div>';

        } else if ( $media_type == "sh-video" ) {

            echo '<div class="sh-video-wrap">' . atelier_sh_video_post( $post->ID, $use_thumb_content ) . '</div>';

        } else if ( $media_type == "custom" ) {

            echo do_shortcode( $custom_media );

        } else if ( $media_type == "image" ) {

            echo atelier_image_post( $post->ID, $media_width, $media_height, $use_thumb_content );

        }

    } else {

        echo atelier_get_post_media( $post->ID, $media_width, $media_height, $video_height, $use_thumb_content );

    } ?>

</figure>
