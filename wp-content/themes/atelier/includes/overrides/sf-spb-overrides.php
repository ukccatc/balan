<?php
	/*
	*
	*	Swift Framework - Page Builder Overrides
	*	------------------------------------------------
	*	Atelier specific functionality
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*/
	
	/* HERO CONTENT SPB ADJUST
	================================================== */
//	if ( ! function_exists( 'atelier_page_hero_content_check' ) ) {
//	    function atelier_page_hero_content_check( $wrap_type ) {
//	        global $post;
//	        $page_design_style = atelier_get_post_meta($post->ID, 'sf_page_design_style', true );
//	        if ( $page_design_style == "hero-content-split" && $wrap_type == 'full-width-stretch' ) {
//	            return 'full-width-contained';
//	        } else {
//	            return $wrap_type;
//	        }
//	    }
//	    add_filter( 'spb_row_wrap_type', 'atelier_page_hero_content_check', 10 );
//	}
	
	
	/* PAGE BUILDER FONT ICONS
	================================================== */
	function atelier_spb_font_icons_list( $icon_list ) {
					
		// IconMind
		$icon_mind_list = '<li><i class="sf-im-gear"></i><span class="icon-name">sf-im-gear</span></li><li><i class="sf-im-gears"></i><span class="icon-name">sf-im-gears</span></li><li><i class="sf-im-information"></i><span class="icon-name">sf-im-information</span></li><li><i class="sf-im-magnifi-glass-"></i><span class="icon-name">sf-im-magnifi-glass-</span></li><li><i class="sf-im-magnifi-glass"></i><span class="icon-name">sf-im-magnifi-glass</span></li><li><i class="sf-im-magnifi-glass2"></i><span class="icon-name">sf-im-magnifi-glass2</span></li><li><i class="sf-im-preview"></i><span class="icon-name">sf-im-preview</span></li><li><i class="sf-im-pricing"></i><span class="icon-name">sf-im-pricing</span></li><li><i class="sf-im-repair"></i><span class="icon-name">sf-im-repair</span></li><li><i class="sf-im-support"></i><span class="icon-name">sf-im-support</span></li><li><i class="sf-im-user"></i><span class="icon-name">sf-im-user</span></li><li><i class="sf-im-equalizer"></i><span class="icon-name">sf-im-equalizer</span></li><li><i class="sf-im-microphone-2"></i><span class="icon-name">sf-im-microphone-2</span></li><li><i class="sf-im-rock-androll"></i><span class="icon-name">sf-im-rock-androll</span></li><li><i class="sf-im-sound-wave"></i><span class="icon-name">sf-im-sound-wave</span></li><li><i class="sf-im-close-window"></i><span class="icon-name">sf-im-close-window</span></li><li><i class="sf-im-network-window"></i><span class="icon-name">sf-im-network-window</span></li><li><i class="sf-im-settings-window"></i><span class="icon-name">sf-im-settings-window</span></li><li><i class="sf-im-two-windows"></i><span class="icon-name">sf-im-two-windows</span></li><li><i class="sf-im-upload-window"></i><span class="icon-name">sf-im-upload-window</span></li><li><i class="sf-im-url-window"></i><span class="icon-name">sf-im-url-window</span></li><li><i class="sf-im-width-window"></i><span class="icon-name">sf-im-width-window</span></li><li><i class="sf-im-windows-2"></i><span class="icon-name">sf-im-windows-2</span></li><li><i class="sf-im-drop"></i><span class="icon-name">sf-im-drop</span></li><li><i class="sf-im-clapperboard-open"></i><span class="icon-name">sf-im-clapperboard-open</span></li><li><i class="sf-im-video-3"></i><span class="icon-name">sf-im-video-3</span></li><li><i class="sf-im-hand-touch2"></i><span class="icon-name">sf-im-hand-touch2</span></li><li><i class="sf-im-thumb"></i><span class="icon-name">sf-im-thumb</span></li><li><i class="sf-im-clock"></i><span class="icon-name">sf-im-clock</span></li><li><i class="sf-im-watch"></i><span class="icon-name">sf-im-watch</span></li><li><i class="sf-im-normal-text"></i><span class="icon-name">sf-im-normal-text</span></li><li><i class="sf-im-text-box"></i><span class="icon-name">sf-im-text-box</span></li><li><i class="sf-im-text-effect"></i><span class="icon-name">sf-im-text-effect</span></li><li><i class="sf-im-archery-2"></i><span class="icon-name">sf-im-archery-2</span></li><li><i class="sf-im-medal-3"></i><span class="icon-name">sf-im-medal-3</span></li><li><i class="sf-im-skate-shoes"></i><span class="icon-name">sf-im-skate-shoes</span></li><li><i class="sf-im-trophy"></i><span class="icon-name">sf-im-trophy</span></li><li><i class="sf-im-speach-bubbleasking"></i><span class="icon-name">sf-im-speach-bubbleasking</span></li><li><i class="sf-im-speach-bubbledialog"></i><span class="icon-name">sf-im-speach-bubbledialog</span></li><li><i class="sf-im-inifity"></i><span class="icon-name">sf-im-inifity</span></li><li><i class="sf-im-quotes"></i><span class="icon-name">sf-im-quotes</span></li><li><i class="sf-im-ribbon"></i><span class="icon-name">sf-im-ribbon</span></li><li><i class="sf-im-venn-diagram"></i><span class="icon-name">sf-im-venn-diagram</span></li><li><i class="sf-im-car-coins"></i><span class="icon-name">sf-im-car-coins</span></li><li><i class="sf-im-cash-register2"></i><span class="icon-name">sf-im-cash-register2</span></li><li><i class="sf-im-password-shopping"></i><span class="icon-name">sf-im-password-shopping</span></li><li><i class="sf-im-tag-5"></i><span class="icon-name">sf-im-tag-5</span></li><li><i class="sf-im-coding"></i><span class="icon-name">sf-im-coding</span></li><li><i class="sf-im-consulting"></i><span class="icon-name">sf-im-consulting</span></li><li><i class="sf-im-testimonal"></i><span class="icon-name">sf-im-testimonal</span></li><li><i class="sf-im-lock-2"></i><span class="icon-name">sf-im-lock-2</span></li><li><i class="sf-im-unlock-2"></i><span class="icon-name">sf-im-unlock-2</span></li><li><i class="sf-im-atom"></i><span class="icon-name">sf-im-atom</span></li><li><i class="sf-im-chemical"></i><span class="icon-name">sf-im-chemical</span></li><li><i class="sf-im-plaster"></i><span class="icon-name">sf-im-plaster</span></li><li><i class="sf-im-camera-2"></i><span class="icon-name">sf-im-camera-2</span></li><li><i class="sf-im-flash-2"></i><span class="icon-name">sf-im-flash-2</span></li><li><i class="sf-im-photo"></i><span class="icon-name">sf-im-photo</span></li><li><i class="sf-im-photos"></i><span class="icon-name">sf-im-photos</span></li><li><i class="sf-im-sport-mode"></i><span class="icon-name">sf-im-sport-mode</span></li><li><i class="sf-im-business-man"></i><span class="icon-name">sf-im-business-man</span></li><li><i class="sf-im-business-woman"></i><span class="icon-name">sf-im-business-woman</span></li><li><i class="sf-im-speak-2"></i><span class="icon-name">sf-im-speak-2</span></li><li><i class="sf-im-talk-man"></i><span class="icon-name">sf-im-talk-man</span></li><li><i class="sf-im-chair"></i><span class="icon-name">sf-im-chair</span></li><li><i class="sf-im-footprint"></i><span class="icon-name">sf-im-footprint</span></li><li><i class="sf-im-gift-box"></i><span class="icon-name">sf-im-gift-box</span></li><li><i class="sf-im-key"></i><span class="icon-name">sf-im-key</span></li><li><i class="sf-im-light-bulb"></i><span class="icon-name">sf-im-light-bulb</span></li><li><i class="sf-im-luggage-2"></i><span class="icon-name">sf-im-luggage-2</span></li><li><i class="sf-im-paper-plane"></i><span class="icon-name">sf-im-paper-plane</span></li><li><i class="sf-im-environmental-3"></i><span class="icon-name">sf-im-environmental-3</span></li><li><i class="sf-im-compass-4"></i><span class="icon-name">sf-im-compass-4</span></li><li><i class="sf-im-globe"></i><span class="icon-name">sf-im-globe</span></li><li><i class="sf-im-map-marker"></i><span class="icon-name">sf-im-map-marker</span></li><li><i class="sf-im-map2"></i><span class="icon-name">sf-im-map2</span></li><li><i class="sf-im-satelite-2"></i><span class="icon-name">sf-im-satelite-2</span></li><li><i class="sf-im-add"></i><span class="icon-name">sf-im-add</span></li><li><i class="sf-im-close"></i><span class="icon-name">sf-im-close</span></li><li><i class="sf-im-cursor-click2"></i><span class="icon-name">sf-im-cursor-click2</span></li><li><i class="sf-im-download-2"></i><span class="icon-name">sf-im-download-2</span></li><li><i class="sf-im-link"></i><span class="icon-name">sf-im-link</span></li><li><i class="sf-im-upload-2"></i><span class="icon-name">sf-im-upload-2</span></li><li><i class="sf-im-yes"></i><span class="icon-name">sf-im-yes</span></li><li><i class="sf-im-old-camera"></i><span class="icon-name">sf-im-old-camera</span></li><li><i class="sf-im-mouse-4"></i><span class="icon-name">sf-im-mouse-4</span></li><li><i class="sf-im-coffee"></i><span class="icon-name">sf-im-coffee</span></li><li><i class="sf-im-doughnut"></i><span class="icon-name">sf-im-doughnut</span></li><li><i class="sf-im-glass-water"></i><span class="icon-name">sf-im-glass-water</span></li><li><i class="sf-im-hot-dog"></i><span class="icon-name">sf-im-hot-dog</span></li><li><i class="sf-im-juice"></i><span class="icon-name">sf-im-juice</span></li><li><i class="sf-im-pizza-slice"></i><span class="icon-name">sf-im-pizza-slice</span></li><li><i class="sf-im-pizza"></i><span class="icon-name">sf-im-pizza</span></li><li><i class="sf-im-wine-glass"></i><span class="icon-name">sf-im-wine-glass</span></li><li><i class="sf-im-box-open"></i><span class="icon-name">sf-im-box-open</span></li><li><i class="sf-im-box-withfolders"></i><span class="icon-name">sf-im-box-withfolders</span></li><li><i class="sf-im-add-file"></i><span class="icon-name">sf-im-add-file</span></li><li><i class="sf-im-delete-file"></i><span class="icon-name">sf-im-delete-file</span></li><li><i class="sf-im-file-download"></i><span class="icon-name">sf-im-file-download</span></li><li><i class="sf-im-file-horizontaltext"></i><span class="icon-name">sf-im-file-horizontaltext</span></li><li><i class="sf-im-file-link"></i><span class="icon-name">sf-im-file-link</span></li><li><i class="sf-im-file-love"></i><span class="icon-name">sf-im-file-love</span></li><li><i class="sf-im-file-pictures"></i><span class="icon-name">sf-im-file-pictures</span></li><li><i class="sf-im-file-zip"></i><span class="icon-name">sf-im-file-zip</span></li><li><i class="sf-im-files"></i><span class="icon-name">sf-im-files</span></li><li><i class="sf-im-remove-file"></i><span class="icon-name">sf-im-remove-file</span></li><li><i class="sf-im-thumbs-upsmiley"></i><span class="icon-name">sf-im-thumbs-upsmiley</span></li><li><i class="sf-im-letter-open"></i><span class="icon-name">sf-im-letter-open</span></li><li><i class="sf-im-mail"></i><span class="icon-name">sf-im-mail</span></li><li><i class="sf-im-mailbox-full"></i><span class="icon-name">sf-im-mailbox-full</span></li><li><i class="sf-im-notepad"></i><span class="icon-name">sf-im-notepad</span></li><li><i class="sf-im-computer"></i><span class="icon-name">sf-im-computer</span></li><li><i class="sf-im-laptop"></i><span class="icon-name">sf-im-laptop</span></li><li><i class="sf-im-monitor-2"></i><span class="icon-name">sf-im-monitor-2</span></li><li><i class="sf-im-monitor-5"></i><span class="icon-name">sf-im-monitor-5</span></li><li><i class="sf-im-monitor-phone"></i><span class="icon-name">sf-im-monitor-phone</span></li><li><i class="sf-im-phone-2"></i><span class="icon-name">sf-im-phone-2</span></li><li><i class="sf-im-smartphone-4"></i><span class="icon-name">sf-im-smartphone-4</span></li><li><i class="sf-im-tablet-3"></i><span class="icon-name">sf-im-tablet-3</span></li><li><i class="sf-im-aa"></i><span class="icon-name">sf-im-aa</span></li><li><i class="sf-im-brush"></i><span class="icon-name">sf-im-brush</span></li><li><i class="sf-im-fountain-pen"></i><span class="icon-name">sf-im-fountain-pen</span></li><li><i class="sf-im-idea"></i><span class="icon-name">sf-im-idea</span></li><li><i class="sf-im-marker"></i><span class="icon-name">sf-im-marker</span></li><li><i class="sf-im-note"></i><span class="icon-name">sf-im-note</span></li><li><i class="sf-im-pantone"></i><span class="icon-name">sf-im-pantone</span></li><li><i class="sf-im-pencil"></i><span class="icon-name">sf-im-pencil</span></li><li><i class="sf-im-scissor"></i><span class="icon-name">sf-im-scissor</span></li><li><i class="sf-im-vector-3"></i><span class="icon-name">sf-im-vector-3</span></li><li><i class="sf-im-address-book"></i><span class="icon-name">sf-im-address-book</span></li><li><i class="sf-im-megaphone"></i><span class="icon-name">sf-im-megaphone</span></li><li><i class="sf-im-newspaper"></i><span class="icon-name">sf-im-newspaper</span></li><li><i class="sf-im-wifi"></i><span class="icon-name">sf-im-wifi</span></li><li><i class="sf-im-download-fromcloud"></i><span class="icon-name">sf-im-download-fromcloud</span></li><li><i class="sf-im-upload-tocloud"></i><span class="icon-name">sf-im-upload-tocloud</span></li><li><i class="sf-im-blouse"></i><span class="icon-name">sf-im-blouse</span></li><li><i class="sf-im-boot"></i><span class="icon-name">sf-im-boot</span></li><li><i class="sf-im-bow-2"></i><span class="icon-name">sf-im-bow-2</span></li><li><i class="sf-im-bra"></i><span class="icon-name">sf-im-bra</span></li><li><i class="sf-im-cap"></i><span class="icon-name">sf-im-cap</span></li><li><i class="sf-im-coat"></i><span class="icon-name">sf-im-coat</span></li><li><i class="sf-im-dress"></i><span class="icon-name">sf-im-dress</span></li><li><i class="sf-im-hanger"></i><span class="icon-name">sf-im-hanger</span></li><li><i class="sf-im-heels"></i><span class="icon-name">sf-im-heels</span></li><li><i class="sf-im-jacket"></i><span class="icon-name">sf-im-jacket</span></li><li><i class="sf-im-jeans"></i><span class="icon-name">sf-im-jeans</span></li><li><i class="sf-im-shirt"></i><span class="icon-name">sf-im-shirt</span></li><li><i class="sf-im-suit"></i><span class="icon-name">sf-im-suit</span></li><li><i class="sf-im-sunglasses-w3"></i><span class="icon-name">sf-im-sunglasses-w3</span></li><li><i class="sf-im-t-shirt"></i><span class="icon-name">sf-im-t-shirt</span></li><li><i class="sf-im-present"></i><span class="icon-name">sf-im-present</span></li><li><i class="sf-im-tactic"></i><span class="icon-name">sf-im-tactic</span></li><li><i class="sf-im-bar-chart3"></i><span class="icon-name">sf-im-bar-chart3</span></li><li><i class="sf-im-calculator-2"></i><span class="icon-name">sf-im-calculator-2</span></li><li><i class="sf-im-calendar-4"></i><span class="icon-name">sf-im-calendar-4</span></li><li><i class="sf-im-credit-card2"></i><span class="icon-name">sf-im-credit-card2</span></li><li><i class="sf-im-diamond"></i><span class="icon-name">sf-im-diamond</span></li><li><i class="sf-im-financial"></i><span class="icon-name">sf-im-financial</span></li><li><i class="sf-im-handshake"></i><span class="icon-name">sf-im-handshake</span></li><li><i class="sf-im-line-chart4"></i><span class="icon-name">sf-im-line-chart4</span></li><li><i class="sf-im-money-2"></i><span class="icon-name">sf-im-money-2</span></li><li><i class="sf-im-pie-chart3"></i><span class="icon-name">sf-im-pie-chart3</span></li><li><i class="sf-im-home"></i><span class="icon-name">sf-im-home</span></li><li><i class="sf-im-bones"></i><span class="icon-name">sf-im-bones</span></li><li><i class="sf-im-brain"></i><span class="icon-name">sf-im-brain</span></li><li><i class="sf-im-ear"></i><span class="icon-name">sf-im-ear</span></li><li><i class="sf-im-eye-visible"></i><span class="icon-name">sf-im-eye-visible</span></li><li><i class="sf-im-face-style"></i><span class="icon-name">sf-im-face-style</span></li><li><i class="sf-im-fingerprint-2"></i><span class="icon-name">sf-im-fingerprint-2</span></li><li><i class="sf-im-heart"></i><span class="icon-name">sf-im-heart</span></li><li><i class="sf-im-arrow-downincircle"></i><span class="icon-name">sf-im-arrow-downincircle</span></li><li><i class="sf-im-arrow-left"></i><span class="icon-name">sf-im-arrow-left</span></li><li><i class="sf-im-arrow-right"></i><span class="icon-name">sf-im-arrow-right</span></li><li><i class="sf-im-arrow-up"></i><span class="icon-name">sf-im-arrow-up</span></li><li><i class="sf-im-download"></i><span class="icon-name">sf-im-download</span></li><li><i class="sf-im-fit-to"></i><span class="icon-name">sf-im-fit-to</span></li><li><i class="sf-im-full-screen"></i><span class="icon-name">sf-im-full-screen</span></li><li><i class="sf-im-full-screen2"></i><span class="icon-name">sf-im-full-screen2</span></li><li><i class="sf-im-left"></i><span class="icon-name">sf-im-left</span></li><li><i class="sf-im-repeat-2"></i><span class="icon-name">sf-im-repeat-2</span></li><li><i class="sf-im-right"></i><span class="icon-name">sf-im-right</span></li><li><i class="sf-im-up"></i><span class="icon-name">sf-im-up</span></li><li><i class="sf-im-upload"></i><span class="icon-name">sf-im-upload</span></li><li><i class="sf-im-arrow-around"></i><span class="icon-name">sf-im-arrow-around</span></li><li><i class="sf-im-arrow-loop"></i><span class="icon-name">sf-im-arrow-loop</span></li><li><i class="sf-im-arrow-outleft"></i><span class="icon-name">sf-im-arrow-outleft</span></li><li><i class="sf-im-arrow-outright"></i><span class="icon-name">sf-im-arrow-outright</span></li><li><i class="sf-im-arrow-shuffle"></i><span class="icon-name">sf-im-arrow-shuffle</span></li><li><i class="sf-im-maximize"></i><span class="icon-name">sf-im-maximize</span></li><li><i class="sf-im-minimize"></i><span class="icon-name">sf-im-minimize</span></li><li><i class="sf-im-resize"></i><span class="icon-name">sf-im-resize</span></li><li><i class="sf-im-bird"></i><span class="icon-name">sf-im-bird</span></li><li><i class="sf-im-cat"></i><span class="icon-name">sf-im-cat</span></li><li><i class="sf-im-dog"></i><span class="icon-name">sf-im-dog</span></li><li><i class="sf-im-align-center"></i><span class="icon-name">sf-im-align-center</span></li><li><i class="sf-im-align-left"></i><span class="icon-name">sf-im-align-left</span></li><li><i class="sf-im-align-right"></i><span class="icon-name">sf-im-align-right</span></li>';
		
		$icon_list .= $icon_mind_list;
		
		return $icon_list;
	}
	add_filter( 'spb_font_icons_list', 'atelier_spb_font_icons_list' );