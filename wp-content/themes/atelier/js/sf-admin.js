/*
*
*	Admin jQuery Functions
*	------------------------------------------------
*	Swift Framework
* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
*
*/

jQuery(function(jQuery) {
	
	// FIELD VARIABLES
	var $sidebar_config = jQuery('#sf_sidebar_config'), 
		$left_sidebar = jQuery('#sf_left_sidebar').parent().parent(),
		$right_sidebar = jQuery('#sf_right_sidebar').parent().parent();
	var $revslider_alias = jQuery('#sf_rev_slider_alias').parent().parent(),
		$layerslider_id = jQuery('#sf_layerslider_id').parent().parent();
	var $thumb_type = jQuery('#sf_thumbnail_type'),
		$thumb_image = jQuery('#sf_thumbnail_image_description').parent().parent(),
		$thumb_video = jQuery('#sf_thumbnail_video_url').parent().parent(),
		$thumb_gallery = jQuery('#sf_thumbnail_gallery_description').parent().parent(),
		$thumb_audio = jQuery('#sf_thumbnail_audio_url').parent().parent();
		$thumb_videomp4 = jQuery('#sf_thumbnail_video_mp4').parent().parent();
		$thumb_videoogg = jQuery('#sf_thumbnail_video_ogg').parent().parent();
		$thumb_videowebm = jQuery('#sf_thumbnail_video_webm').parent().parent();
	var $link_type = jQuery('#sf_thumbnail_link_type'),
		$link_url = jQuery('#sf_thumbnail_link_url').parent().parent(),
		$link_image = jQuery('a[data-field_id="atelier_thumbnail_link_image"]').parent().parent(),
		$link_video = jQuery('#sf_thumbnail_link_video_url').parent().parent();
	var $use_thumb_content = jQuery('#sf_thumbnail_content_main_detail'),
		$detail_type = jQuery('#sf_detail_type'),
		$detail_image = jQuery('#sf_detail_image_description').parent().parent(),
		$detail_video = jQuery('#sf_detail_video_url').parent().parent(),
		$detail_gallery = jQuery('#sf_detail_gallery_description').parent().parent(),
		$detail_slider = jQuery('#sf_detail_rev_slider_alias').parent().parent(),
		$detail_layerslider = jQuery('#sf_detail_layer_slider_alias').parent().parent(),
		$detail_custom = jQuery('#sf_custom_media').parent().parent(),
		$detail_audio = jQuery('#sf_detail_audio_url').parent().parent();
		$detail_videomp4 = jQuery('#sf_detail_video_mp4').parent().parent();
		$detail_videoogg = jQuery('#sf_detail_video_ogg').parent().parent();
		$detail_videowebm = jQuery('#sf_detail_video_webm').parent().parent();
	var $page_title_style = jQuery('#sf_page_title_style'), 
		$page_title_text_two = jQuery('#sf_page_title_two').parent().parent(),
		$page_title_fancy_image = jQuery('#sf_page_title_image_description').parent().parent(),
		$page_title_fancy_text_style = jQuery('#sf_page_title_text_style').parent().parent(),
		$page_title_overlay_effect = jQuery('#sf_page_title_overlay_effect').parent().parent(),
		$page_title_height = jQuery('#sf_page_title_height').parent().parent();
		
	if ($sidebar_config.val() == "no-sidebars") {
		$left_sidebar.css('display', 'none');
		$right_sidebar.css('display', 'none');
	} else if ($sidebar_config.val() == "left-sidebar") {
		$left_sidebar.css('display', 'block');
		$right_sidebar.css('display', 'none');
	} else if ($sidebar_config.val() == "right-sidebar") {
		$right_sidebar.css('display', 'block');
		$left_sidebar.css('display', 'none');
	} else if ($sidebar_config.val() == "both-sidebars") {
		$left_sidebar.css('display', 'block');
		$right_sidebar.css('display', 'block');
	}
	
	if ($thumb_type.val() == "none") {
		$thumb_image.css('display', 'none');
		$thumb_video.css('display', 'none');
		$thumb_gallery.css('display', 'none');
		$thumb_audio.css('display', 'none');
		$thumb_videomp4.css('display', 'none');
		$thumb_videoogg.css('display', 'none');
		$thumb_videowebm.css('display', 'none');
	} else if ($thumb_type.val() == "image") {
		$thumb_image.css('display', 'block');
		$thumb_video.css('display', 'none');
		$thumb_gallery.css('display', 'none');
		$thumb_audio.css('display', 'none');
		$thumb_videomp4.css('display', 'none');
		$thumb_videoogg.css('display', 'none');
		$thumb_videowebm.css('display', 'none');
	} else if ($thumb_type.val() == "video") {
		$thumb_image.css('display', 'none');
		$thumb_video.css('display', 'block');
		$thumb_gallery.css('display', 'none');
		$thumb_audio.css('display', 'none');
		$thumb_videomp4.css('display', 'none');
		$thumb_videoogg.css('display', 'none');
		$thumb_videowebm.css('display', 'none');
	} else if ($thumb_type.val() == "slider") {
		$thumb_image.css('display', 'none');
		$thumb_video.css('display', 'none');
		$thumb_gallery.css('display', 'block');
		$thumb_audio.css('display', 'none');
		$thumb_videomp4.css('display', 'none');
		$thumb_videoogg.css('display', 'none');
		$thumb_videowebm.css('display', 'none');
	} else if ($thumb_type.val() == "audio") {
		$thumb_image.css('display', 'none');
		$thumb_video.css('display', 'none');
		$thumb_gallery.css('display', 'none');
		$thumb_audio.css('display', 'block');
		$thumb_videomp4.css('display', 'none');
		$thumb_videoogg.css('display', 'none');
		$thumb_videowebm.css('display', 'none');
	} else if ($thumb_type.val() == "sh-video") {
		$thumb_image.css('display', 'none');
		$thumb_video.css('display', 'none');
		$thumb_gallery.css('display', 'none');
		$thumb_audio.css('display', 'none');
		$thumb_videomp4.css('display', 'block');
		$thumb_videoogg.css('display', 'block');
		$thumb_videowebm.css('display', 'block');
	}
	
	if ($link_type.val() == "link_to_post") {
		$link_url.css('display', 'none');
		$link_image.css('display', 'none');
		$link_video.css('display', 'none');
	} else if ($link_type.val() == "link_to_url" || $link_type.val() == "link_to_url_nw" ) {
		$link_url.css('display', 'block');
		$link_image.css('display', 'none');
		$link_video.css('display', 'none');
	} else if ($link_type.val() == "lightbox_thumb") {
		$link_url.css('display', 'none');
		$link_image.css('display', 'none');
		$link_video.css('display', 'none');
	} else if ($link_type.val() == "lightbox_image") {
		$link_url.css('display', 'none');
		$link_image.css('display', 'block');
		$link_video.css('display', 'none');
	} else if ($link_type.val() == "lightbox_video") {
		$link_url.css('display', 'none');
		$link_image.css('display', 'none');
		$link_video.css('display', 'block');
	}
	
	if ($use_thumb_content.is(':checked')) {
		$detail_type.parent().parent().css('display', 'none');
		$detail_image.css('display', 'none');
		$detail_video.css('display', 'none');
		$detail_gallery.css('display', 'none');
		$detail_slider.css('display', 'none');
		$detail_layerslider.css('display', 'none');
		$detail_custom.css('display', 'none');
		$detail_audio.css('display', 'none');
		$detail_videomp4.css('display', 'none');
		$detail_videoogg.css('display', 'none');
		$detail_videowebm.css('display', 'none');
	} else {
		$detail_type.parent().parent().css('display', 'block');
		if ($detail_type.val() == "none") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_layerslider.css('display', 'none');
			$detail_custom.css('display', 'none');
			$detail_audio.css('display', 'none');
			$detail_videomp4.css('display', 'none');
			$detail_videoogg.css('display', 'none');
			$detail_videowebm.css('display', 'none');
		} else if ($detail_type.val() == "image") {
			$detail_image.css('display', 'block');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_layerslider.css('display', 'none');
			$detail_custom.css('display', 'none');
			$detail_audio.css('display', 'none');
			$detail_videomp4.css('display', 'none');
			$detail_videoogg.css('display', 'none');
			$detail_videowebm.css('display', 'none');
		} else if ($detail_type.val() == "video") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'block');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_layerslider.css('display', 'none');
			$detail_custom.css('display', 'none');
			$detail_audio.css('display', 'none');
			$detail_videomp4.css('display', 'none');
			$detail_videoogg.css('display', 'none');
			$detail_videowebm.css('display', 'none');
		} else if ($detail_type.val() == "slider" || $detail_type.val() == "gallery-stacked") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'block');
			$detail_slider.css('display', 'none');
			$detail_layerslider.css('display', 'none');
			$detail_custom.css('display', 'none');
			$detail_audio.css('display', 'none');
			$detail_videomp4.css('display', 'none');
			$detail_videoogg.css('display', 'none');
			$detail_videowebm.css('display', 'none');
		} else if ($detail_type.val() == "layer-slider") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'block');
			$detail_layerslider.css('display', 'block');
			$detail_custom.css('display', 'none');
			$detail_audio.css('display', 'none');
			$detail_videomp4.css('display', 'none');
			$detail_videoogg.css('display', 'none');
			$detail_videowebm.css('display', 'none');
		} else if ($detail_type.val() == "custom") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_layerslider.css('display', 'none');
			$detail_custom.css('display', 'block');
			$detail_audio.css('display', 'none');
			$detail_videomp4.css('display', 'none');
			$detail_videoogg.css('display', 'none');
			$detail_videowebm.css('display', 'none');
		} else if ($detail_type.val() == "audio") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_layerslider.css('display', 'none');
			$detail_custom.css('display', 'none');
			$detail_audio.css('display', 'block');
			$detail_videomp4.css('display', 'none');
			$detail_videoogg.css('display', 'none');
			$detail_videowebm.css('display', 'none');
		} else if ($detail_type.val() == "sh-video") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_layerslider.css('display', 'none');
			$detail_custom.css('display', 'none');
			$detail_audio.css('display', 'none');
			$detail_videomp4.css('display', 'block');
			$detail_videoogg.css('display', 'block');
			$detail_videowebm.css('display', 'block');
		}
	}

	if ($page_title_style.val() == "standard") {
		$page_title_text_two.css('display', 'none');
		$page_title_fancy_image.css('display', 'none');
		$page_title_fancy_text_style.css('display', 'none');
		$page_title_overlay_effect.css('display', 'none');
		$page_title_height.css('display', 'none');
	}
	
	
	// ON CHANGE SHOW/HIDE CONFIG

	$page_title_style.change(function() {
		if (jQuery(this).val() == "standard") {
			$page_title_text_two.css('display', 'none');
			$page_title_fancy_image.css('display', 'none');
			$page_title_fancy_text_style.css('display', 'none');
			$page_title_overlay_effect.css('display', 'none');
			$page_title_height.css('display', 'none');
		} else {
			$page_title_text_two.css('display', 'block');
			$page_title_fancy_image.css('display', 'block');
			$page_title_fancy_text_style.css('display', 'block');
			$page_title_overlay_effect.css('display', 'block');
			$page_title_height.css('display', 'block');
		}
	});
		
	$sidebar_config.change(function() {
	  if (jQuery(this).val() == "no-sidebars") {
	  	$left_sidebar.css('display', 'none');
	  	$right_sidebar.css('display', 'none');
	  } else if (jQuery(this).val() == "left-sidebar") {
	  	$left_sidebar.css('display', 'block');
	  	$right_sidebar.css('display', 'none');
	  } else if (jQuery(this).val() == "right-sidebar") {
	  	$right_sidebar.css('display', 'block');
	  	$left_sidebar.css('display', 'none');
	  } else if (jQuery(this).val() == "both-sidebars") {
	  	$left_sidebar.css('display', 'block');
	  	$right_sidebar.css('display', 'block');
	  }
	});
	
	$thumb_type.change(function() {
		if (jQuery(this).val() == "none") {
			$thumb_image.css('display', 'none');
			$thumb_video.css('display', 'none');
			$thumb_gallery.css('display', 'none');
			$thumb_audio.css('display', 'none');
			$thumb_videomp4.css('display', 'none');
			$thumb_videoogg.css('display', 'none');
			$thumb_videowebm.css('display', 'none');
		} else if (jQuery(this).val() == "image") {
			$thumb_image.css('display', 'block');
			$thumb_video.css('display', 'none');
			$thumb_gallery.css('display', 'none');
			$thumb_audio.css('display', 'none');
			$thumb_videomp4.css('display', 'none');
			$thumb_videoogg.css('display', 'none');
			$thumb_videowebm.css('display', 'none');
		} else if (jQuery(this).val() == "video") {
			$thumb_image.css('display', 'none');
			$thumb_video.css('display', 'block');
			$thumb_gallery.css('display', 'none');
			$thumb_audio.css('display', 'none');
			$thumb_videomp4.css('display', 'none');
			$thumb_videoogg.css('display', 'none');
			$thumb_videowebm.css('display', 'none');
		} else if (jQuery(this).val() == "slider") {
			$thumb_image.css('display', 'none');
			$thumb_video.css('display', 'none');
			$thumb_gallery.css('display', 'block');
			$thumb_audio.css('display', 'none');
			$thumb_videomp4.css('display', 'none');
			$thumb_videoogg.css('display', 'none');
			$thumb_videowebm.css('display', 'none');
		} else if (jQuery(this).val() == "audio") {
			$thumb_image.css('display', 'none');
			$thumb_video.css('display', 'none');
			$thumb_gallery.css('display', 'none');
			$thumb_audio.css('display', 'block');
			$thumb_videomp4.css('display', 'none');
			$thumb_videoogg.css('display', 'none');
			$thumb_videowebm.css('display', 'none');
		} else if (jQuery(this).val() == "sh-video") {
			$thumb_image.css('display', 'none');
			$thumb_video.css('display', 'none');
			$thumb_gallery.css('display', 'none');
			$thumb_audio.css('display', 'none');
			$thumb_videomp4.css('display', 'block');
			$thumb_videoogg.css('display', 'block');
			$thumb_videowebm.css('display', 'block');
		}
	});

	$link_type.change(function() {	
		if (jQuery(this).val() == "link_to_post") {
			$link_url.css('display', 'none');
			$link_image.css('display', 'none');
			$link_video.css('display', 'none');
		} else if (jQuery(this).val() == "link_to_url" || $link_type.val() == "link_to_url_nw") {
			$link_url.css('display', 'block');
			$link_image.css('display', 'none');
			$link_video.css('display', 'none');
		} else if (jQuery(this).val() == "lightbox_thumb") {
			$link_url.css('display', 'none');
			$link_image.css('display', 'none');
			$link_video.css('display', 'none');
		} else if (jQuery(this).val() == "lightbox_image") {
			$link_url.css('display', 'none');
			$link_image.css('display', 'block');
			$link_video.css('display', 'none');
		} else if (jQuery(this).val() == "lightbox_video") {
			$link_url.css('display', 'none');
			$link_image.css('display', 'none');
			$link_video.css('display', 'block');
		}
	});
	
	$use_thumb_content.change(function() {
		if ($use_thumb_content.is(':checked')) {
			$detail_type.parent().parent().css('display', 'none');
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_layerslider.css('display', 'none');
			$detail_custom.css('display', 'none');
			$detail_audio.css('display', 'none');
			$detail_videomp4.css('display', 'none');
			$detail_videoogg.css('display', 'none');
			$detail_videowebm.css('display', 'none');
		} else {
			$detail_type.parent().parent().css('display', 'block');
			if ($detail_type.val() == "none") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "image") {
				$detail_image.css('display', 'block');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "video") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'block');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "slider" || $detail_type.val() == "gallery-stacked") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'block');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "layer-slider") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'block');
				$detail_layerslider.css('display', 'block');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "custom") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'block');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "audio") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'block');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "sh-video") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'block');
				$detail_videoogg.css('display', 'block');
				$detail_videowebm.css('display', 'block');
			}
		}
	});
	
	$detail_type.change(function() {
		if ($use_thumb_content.is(':checked')) {
			$detail_type.parent().parent().css('display', 'none');
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_layerslider.css('display', 'none');
			$detail_audio.css('display', 'none');
			$detail_videomp4.css('display', 'none');
			$detail_videoogg.css('display', 'none');
			$detail_videowebm.css('display', 'none');
		} else {
			$detail_type.parent().parent().css('display', 'block');
			if (jQuery(this).val() == "none") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if (jQuery(this).val() == "image") {
				$detail_image.css('display', 'block');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if (jQuery(this).val() == "video") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'block');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if (jQuery(this).val() == "slider" || $detail_type.val() == "gallery-stacked") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'block');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if (jQuery(this).val() == "layer-slider") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'block');
				$detail_layerslider.css('display', 'block');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "custom") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'block');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "audio") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'block');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "sh-video") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'block');
				$detail_videoogg.css('display', 'block');
				$detail_videowebm.css('display', 'block');
			}
		}
	});
	
	// Page Slider
	var $page_slider_type = jQuery('#sf_page_slider');
	
	showHideSliderMeta($page_slider_type.val());
	$page_slider_type.change(function() {
		showHideSliderMeta(jQuery(this).val());
	});
		
	function showHideSliderMeta($selected) {
		if ($selected == "swift-slider") {
			jQuery('.pageslider-revslider').css('display', 'none');
			jQuery('.pageslider-masterslider').css('display', 'none');
			jQuery('.pageslider-layerslider').css('display', 'none');
			jQuery('.pageslider-swift-slider').css('display', 'block');
		} else if ($selected == "revslider") {
			jQuery('.pageslider-revslider').css('display', 'block');
			jQuery('.pageslider-masterslider').css('display', 'none');
			jQuery('.pageslider-layerslider').css('display', 'none');
			jQuery('.pageslider-swift-slider').css('display', 'none');
		} else if ($selected == "layerslider") {
			jQuery('.pageslider-revslider').css('display', 'none');
			jQuery('.pageslider-masterslider').css('display', 'none');
			jQuery('.pageslider-layerslider').css('display', 'block');
			jQuery('.pageslider-swift-slider').css('display', 'none');
		} else if ($selected == "masterslider") {
			jQuery('.pageslider-revslider').css('display', 'none');
			jQuery('.pageslider-masterslider').css('display', 'block');
			jQuery('.pageslider-layerslider').css('display', 'none');
			jQuery('.pageslider-swift-slider').css('display', 'none');
		} else if ($selected == "none") {
			jQuery('.pageslider-revslider').css('display', 'none');
			jQuery('.pageslider-masterslider').css('display', 'none');
			jQuery('.pageslider-layerslider').css('display', 'none');
			jQuery('.pageslider-swift-slider').css('display', 'none');
		}
	}
	
	
	// Media functions
	jQuery('#media-items').bind('DOMNodeInserted',function(){
		jQuery('input[value="Insert into Post"]').each(function(){
				jQuery(this).attr('value','Use This Image');
		});
	});
	
	jQuery('.custom_upload_image_button').click(function() {
		formfield = jQuery(this).siblings('.custom_upload_image');
		preview = jQuery(this).siblings('.custom_preview_image');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			classes = jQuery('img', html).attr('class');
			id = classes.replace(/(.*?)wp-image-/, '');
			formfield.val(id);
			preview.attr('src', imgurl);
			tb_remove();
		}
		return false;
	});
	
	jQuery('.custom_clear_image_button').click(function() {
		var defaultImage = jQuery(this).parent().siblings('.custom_default_image').text();
		jQuery(this).parent().siblings('.custom_upload_image').val('');
		jQuery(this).parent().siblings('.custom_preview_image').attr('src', defaultImage);
		return false;
	});
	
	jQuery('.repeatable-add').click(function() {
		field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
		fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
		jQuery('input', field).val('').attr('name', function(index, name) {
			return name.replace(/(\d+)/, function(fullMatch, n) {
				return Number(n) + 1;
			});
		})
		field.insertAfter(fieldLocation, jQuery(this).closest('td'))
		return false;
	});
	
	jQuery('.repeatable-remove').click(function(){
		jQuery(this).parent().remove();
		return false;
	});
	
	
	// ALT BACKGROUND
	
	var altBackgroundValue = jQuery('.rwmb-meta-box').find('#sf_page_title_bg').val();
	if (altBackgroundValue != "") {
		jQuery('.rwmb-meta-box').find('.meta-altbg-preview').addClass(altBackgroundValue);
	}
	
	jQuery(document).on('change', '#sf_page_title_bg', function() {
	    jQuery('.meta-altbg-preview').attr('class', 'meta-altbg-preview');
	    jQuery('.meta-altbg-preview').addClass(jQuery(this).val());
	});
	
	
	// COLOUR SCHEME FUNCTION
	jQuery("#sf-export-scheme-dl").click(function(e) {
	
		e.preventDefault(); // prevent link
		
		var the_link = jQuery(this).attr("href");
		
		var file_name = jQuery("#sf-export-scheme-name").val();
		
		if ( file_name ) {
					
			file_name = file_name.replace(/\W/g, ''); // let's attempt to filter this a bit
			
			jQuery("#sf-export-scheme-name").val(file_name); 
			
			the_link = the_link + "&file_name=" + file_name;
			
			window.open(the_link);
			
						
		} else {
			
			alert ("You must enter a scheme name.");
			
		}
		
		//console.log ( file_name );
	
	});


});