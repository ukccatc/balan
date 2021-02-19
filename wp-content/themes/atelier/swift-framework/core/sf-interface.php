<?php

    $upload_dir = wp_upload_dir();     
    $fontello_icons_path = $upload_dir['baseurl'] . '/redux/custom-icon-fonts/fontello_css/fontello-embedded.css';
    
    $button_types = array(
    	'standard' => __('Standard', 'atelier'),
    	'bordered' => __('Bordered', 'atelier'),
    	'rotate-3d' => __('3D Rotate', 'atelier'),
    	'stroke-to-fill' => __('Stroke To Fill', 'atelier'),
    	'sf-icon-reveal' => __('Icon Reveal', 'atelier'),
    	'sf-icon-stroke' => __('Icon', 'atelier'),
    );
    
    if (!atelier_theme_supports( '3drotate-button' )) {
    	unset($button_types['rotate-3d']);
    }
    if (!atelier_theme_supports( 'bordered-button' )) {
        unset($button_types['bordered']);
    }
    
    $button_sizes = array(
    	'standard' => __('Standard', 'atelier'),
    	'large'	=> __('Large', 'atelier'),
    );
    
    $button_colours = array(
    	'accent' => __('Accent', 'atelier'),
    	'black'	=> __('Black', 'atelier'),
    	'white'	=> __('White', 'atelier'),
    	'blue'	=> __('Blue', 'atelier'),
    	'grey'	=> __('Grey', 'atelier'),
    	'lightgrey'	=> __('Light Grey', 'atelier'),
    	'orange'	=> __('Orange', 'atelier'),
    	'green'	=> __('Green', 'atelier'),
    	'pink'	=> __('Pink', 'atelier'),
    	'gold'	=> __('Gold', 'atelier'),
    	'transparent-light'	=> __('Transparent - Light', 'atelier'),
    	'transparent-dark'	=> __('Transparent - Dark', 'atelier'),
    );
    
    $button_types = apply_filters( 'atelier_shortcode_button_types', $button_types );
    $button_sizes = apply_filters( 'atelier_shortcode_button_sizes', $button_sizes );
    $button_colours = apply_filters( 'atelier_shortcode_button_colours', $button_colours );
         
?>

<!-- Swift Framework Shortcode Panel -->

<!-- OPEN html -->
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- OPEN head -->
<head>

    <!-- Title & Meta -->
    <meta http-equiv="Content-Type"
          content="<?php bloginfo( 'html_type' ); ?>; charset=<?php echo get_option( 'blog_charset' ); ?>"/>

    <!-- LOAD scripts -->
    <script language="javascript" type="text/javascript"
            src="<?php echo get_option( 'siteurl' ) ?>/wp-includes/js/jquery/jquery.js"></script>
    <script language="javascript" type="text/javascript"
            src="<?php echo get_template_directory_uri() ?>/swift-framework/shortcodes/sf.shortcodes.js"></script>
    <script language="javascript" type="text/javascript"
            src="<?php echo get_template_directory_uri() ?>/swift-framework/shortcodes/sf.shortcode.embed.js"></script>
    <script language="javascript" type="text/javascript"
            src="<?php echo get_option( 'siteurl' ) ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>

    <base target="_self"/>
    
    <?php if ( atelier_theme_supports('nucleo-interface-font') || atelier_theme_supports('nucleo-general-font') ) { ?>
    <link href="<?php echo get_template_directory_uri() ?>/css/iconfont.css" rel="stylesheet" type="text/css"/>
    <?php } ?>
    <?php if ( atelier_theme_supports('icon-mind-font') ) { ?>
    <link href="<?php echo get_template_directory_uri() ?>/css/iconmind.css" rel="stylesheet" type="text/css"/>
    <?php } ?>
    <?php if ( atelier_theme_supports('gizmo-icon-font') ) { ?>
    <link href="<?php echo get_template_directory_uri() ?>/css/ss-gizmo.css" rel="stylesheet" type="text/css"/>
    <?php } ?>
    <link href="<?php echo get_template_directory_uri() ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   
    <link href="<?php echo esc_url($fontello_icons_path); ?>" rel="stylesheet"
          type="text/css"/>
   
    <link href="<?php echo get_template_directory_uri() ?>/swift-framework/shortcodes/base.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo get_template_directory_uri() ?>/swift-framework/shortcodes/sf-shortcodes-style.css"
          rel="stylesheet" type="text/css"/>

    <!-- CLOSE head -->
</head>

<!-- OPEN body -->
<body onLoad="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" id="link">

<!-- OPEN swiftframework_shortcode_form -->
<form name="swiftframework_shortcode_form" action="#">

<!-- OPEN #shortcode_wrap -->
<div id="shortcode_wrap">

<!-- CLOSE #shortcode_panel -->
<div id="shortcode_panel" class="current">

<fieldset>

<h4><?php _e( 'Select a shortcode', 'atelier' ); ?></h4>

<div class="option">
    <label for="shortcode-select"><?php _e( 'Shortcode', 'atelier' ); ?></label>
    <select id="shortcode-select" name="shortcode-select">
        <option value="0"></option>
        <?php if ( atelier_woocommerce_activated() ) { ?>
        <option value="shortcode-addtocart-button"><?php _e( 'Add to Cart Button', 'atelier' ); ?></option>
        <?php } ?>
        <option value="shortcode-buttons"><?php _e( 'Button', 'atelier' ); ?></option>
        <option value="shortcode-chart"><?php _e( 'Chart', 'atelier' ); ?></option>
        <option value="shortcode-columns"><?php _e( 'Columns', 'atelier' ); ?></option>
        <option value="shortcode-counters"><?php _e( 'Counters', 'atelier' ); ?></option>
        <option value="shortcode-countdown"><?php _e( 'Countdown', 'atelier' ); ?></option>
        <option value="shortcode-icons"><?php _e( 'Icons', 'atelier' ); ?></option>
        <option value="shortcode-iconbox"><?php _e( 'Icon Box', 'atelier' ); ?></option>
        <option value="shortcode-imagebanner"><?php _e( 'Image Banner', 'atelier' ); ?></option>
        <option value="shortcode-lists"><?php _e( 'Lists', 'atelier' ); ?></option>
        <option value="shortcode-modal"><?php _e( 'Modal', 'atelier' ); ?></option>
        <option value="shortcode-progressbar"><?php _e( 'Progress Bar', 'atelier' ); ?></option>
        <option value="shortcode-fwvideo"><?php _e( 'Fullscreen Video', 'atelier' ); ?></option>
        <option value="shortcode-responsivevis"><?php _e( 'Responsive Visiblity', 'atelier' ); ?></option>
        <option value="shortcode-social"><?php _e( 'Social', 'atelier' ); ?></option>
        <option value="shortcode-social-share"><?php _e( 'Social share', 'atelier' ); ?></option>
        <option value="shortcode-tables"><?php _e( 'Table', 'atelier' ); ?></option>
        <?php if ( atelier_theme_opts_name() != "sf_atelier_options" ) { ?>
        <option value="shortcode-tooltip"><?php _e( 'Tooltip', 'atelier' ); ?></option>
        <?php } ?>
        <option value="shortcode-typography"><?php _e( 'Typography', 'atelier' ); ?></option>
    </select>
</div>


<!--//////////////////////////////
////	ADD TO CART BUTTON
//////////////////////////////-->

<div id="shortcode-addtocart-button" class="shortcode-option">
    <h5><?php _e( 'Add to Cart Button', 'atelier' ); ?></h5>

	<div class="option">
	    <label for="addtocart-button-productid"><?php _e( 'Product ID', 'atelier' ); ?></label>
	    <input id="addtocart-button-productid" name="button-productid" type="text"
	           value=""/>
	    <p class="info">Provide the ID for the product here, you can find this in the Products admin area when you hover the product.</p>
	    </p>
	</div>
    <div class="option">
        <label for="addtocart-button-colour"><?php _e( 'Button colour', 'atelier' ); ?></label>
        <select id="addtocart-button-colour" name="button-colour">
            <option value="default"><?php _e( 'Default', 'atelier' ); ?></option>
            <option value="accent"><?php _e( 'Accent', 'atelier' ); ?></option>
            <option value="black"><?php _e( 'Black', 'atelier' ); ?></option>
            <option value="white"><?php _e( 'White', 'atelier' ); ?></option>
            <option value="blue"><?php _e( 'Blue', 'atelier' ); ?></option>
            <option value="grey"><?php _e( 'Grey', 'atelier' ); ?></option>
            <option value="lightgrey"><?php _e( 'Light Grey', 'atelier' ); ?></option>
            <option value="orange"><?php _e( 'Orange', 'atelier' ); ?></option>
            <option value="turquoise"><?php _e( 'Turquoise', 'atelier' ); ?></option>
            <option value="green"><?php _e( 'Green', 'atelier' ); ?></option>
            <option value="pink"><?php _e( 'Pink', 'atelier' ); ?></option>
            <option value="gold"><?php _e( 'Gold', 'atelier' ); ?></option>
            <option
                value="transparent-light"><?php _e( 'Transparent - Light (For use on images/dark backgrounds)', 'atelier' ); ?></option>
            <option value="transparent-dark"><?php _e( 'Transparent - Dark', 'atelier' ); ?></option>
        </select>
    </div>
    <div class="option">
        <label for="addtocart-button-extraclass"><?php _e( 'Button Extra Class', 'atelier' ); ?></label>
        <input id="addtocart-button-extraclass" name="button-extraclass" type="text" value=""/>

        <p class="info">Optional, for extra styling/custom colour control.</a></p>
    </div>
</div>


<!--//////////////////////////////
////	BUTTONS
//////////////////////////////-->

<div id="shortcode-buttons" class="shortcode-option">
    <h5><?php _e( 'Buttons', 'atelier' ); ?></h5>

    <div class="option">
        <label for="button-size"><?php _e( 'Button size', 'atelier' ); ?></label>
        <select id="button-size" name="button-size">
            <?php foreach ($button_sizes as $size_val => $size_name ) {
            	echo '<option value="' . $size_val . '">' . $size_name . '</option>';
            } ?>
        </select>
    </div>
    <div class="option">
        <label for="button-colour"><?php _e( 'Button colour', 'atelier' ); ?></label>
        <select id="button-colour" name="button-colour">
        	<?php foreach ($button_colours as $colour_val => $colour_name ) {
        		echo '<option value="' . $colour_val . '">' . $colour_name . '</option>';
        	} ?>
        </select>
    </div>
    <div class="option">
        <label for="button-type"><?php _e( 'Button type', 'atelier' ); ?></label>
        <select id="button-type" name="button-type">
        	<?php foreach ($button_types as $button_val => $button_name ) {
        		echo '<option value="' . $button_val . '">' . $button_name . '</option>';
        	} ?>
        </select>
    </div>
    <div class="option">
        <label for="button-rounded"
               class="for-checkbox"><?php _e( 'Button rounded', 'atelier' ); ?></label>
        <input id="button-rounded" class="checkbox" name="button-rounded" type="checkbox"/>
    </div>
    <div class="option">
        <label for="button-dropshadow"
               class="for-checkbox"><?php _e( 'Button drop shadow', 'atelier' ); ?></label>
        <input id="button-dropshadow" class="checkbox" name="button-dropshadow" type="checkbox"/>
    </div>
    <div class="option">
        <label
            for="button-icon"><?php _e( 'Button icon (for button types with icon)', 'atelier' ); ?></label>
		<input type="text" class="search-icon-grid textfield" placeholder="Search Icon">
        <input id="button-icon" name="icon-icon" type="text" value="" style="visibility: hidden;"/>
        <ul class="font-icon-grid"><?php echo atelier_get_icons_list(); ?></ul>
    </div>
    <div class="option">
        <label for="button-text"><?php _e( 'Button text', 'atelier' ); ?></label>
        <input id="button-text" name="button-text" type="text"
               value="<?php _e( 'Button text', 'atelier' ); ?>"/>
    </div>
    <div class="option">
        <label for="button-url"><?php _e( 'Button URL', 'atelier' ); ?></label>
        <input id="button-url" name="button-url" type="text" value="http://"/>
    </div>
    <div class="option">
        <label for="button-target"
               class="for-checkbox"><?php _e( 'Open link in a new window?', 'atelier' ); ?></label>
        <input id="button-target" class="checkbox" name="button-target" type="checkbox"/>
    </div>
    <div class="option">
        <label for="button-extraclass"><?php _e( 'Button Extra Class', 'atelier' ); ?></label>
        <input id="button-extraclass" name="button-extraclass" type="text" value=""/>

        <p class="info">Optional, for extra styling/custom colour control.</a></p>
    </div>
</div>


<!--//////////////////////////////
////	ICONS
//////////////////////////////-->

<div id="shortcode-icons" class="shortcode-option">
    <h5><?php _e( 'Icons', 'atelier' ); ?></h5>

    <div class="option">
        <label for="icon-size"><?php _e( 'Icon size', 'atelier' ); ?></label>
        <select id="icon-size" name="icon-size">
            <option value="small"><?php _e( 'Small', 'atelier' ); ?></option>
            <option value="medium"><?php _e( 'Medium', 'atelier' ); ?></option>
            <option value="large"><?php _e( 'Large', 'atelier' ); ?></option>
        </select>
    </div>
    <div class="option">
        <label for="icon-image"><?php _e( 'Icon image', 'atelier' ); ?></label>
		<input type="text" class="search-icon-grid textfield" placeholder="Search Icon">
        <input id="icon-image" name="icon-image" type="text" value="" style="visibility: hidden;"/>
        <ul class="font-icon-grid"><?php echo atelier_get_icons_list(); ?></ul>
    </div>
    <div class="option">
        <label for="icon-character"><?php _e( 'Icon Character', 'atelier' ); ?></label>
        <input id="icon-character" name="icon-character" type="text" value=""/>

        <p class="info">Instead of an icon, you can optionally provide a single letter/digit here. NOTE: This will
            override the icon selection.</p>
    </div>
    <div class="option">
        <label for="icon-cont"><?php _e( 'Circular container', 'atelier' ); ?></label>
        <select id="icon-cont" name="icon-cont">
            <option value="no"><?php _e( 'No', 'atelier' ); ?></option>
            <option value="yes"><?php _e( 'Yes', 'atelier' ); ?></option>
        </select>
    </div>
    <div class="option">
        <label for="icon-float"><?php _e( 'Icon float', 'atelier' ); ?></label>
        <select id="icon-float" name="icon-float">
            <option value="left"><?php _e( 'Left', 'atelier' ); ?></option>
            <option value="right"><?php _e( 'Right', 'atelier' ); ?></option>
            <option value="none"><?php _e( 'None', 'atelier' ); ?></option>
        </select>
    </div>
    <div class="option">
        <label for="icon-color"><?php _e( 'Icon Color', 'atelier' ); ?></label>
        <input id="icon-color" name="icon-color" type="text" value=""/>

        <p class="info">If you'd like to override the default color customiser value (link in the WP Admin Bar), then
            please enter a hex colour value (including #).</p>
    </div>
</div>


<!--//////////////////////////////
////	ICON BOX
//////////////////////////////-->

<div id="shortcode-iconbox" class="shortcode-option">
    <h5><?php _e( 'Icon Box', 'atelier' ); ?></h5>

    <div class="option">
        <label for="iconbox-type"><?php _e( 'Icon Box Type', 'atelier' ); ?></label>
        <select id="iconbox-type" name="iconbox-type">
            <option value="standard"><?php _e( 'Standard', 'atelier' ); ?></option>
            <option value="standard-title"><?php _e( 'Standard Title Icon', 'atelier' ); ?></option>
            <option value="bold"><?php _e( 'Bold', 'atelier' ); ?></option>
            <option value="left-icon"><?php _e( 'Left Icon', 'atelier' ); ?></option>
            <option value="boxed-one"><?php _e( 'Boxed Icon Box', 'atelier' ); ?></option>
            <option value="boxed-two"><?php _e( 'Boxed Icon Box Type 2', 'atelier' ); ?></option>
            <option value="boxed-three"><?php _e( 'Boxed Icon Box Type 3', 'atelier' ); ?></option>
            <option value="boxed-four"><?php _e( 'Boxed Icon Box Type 4', 'atelier' ); ?></option>
            <option value="animated"><?php _e( 'Animated', 'atelier' ); ?></option>
        </select>
    </div>
    <div class="option">
        <label for="iconbox-image"><?php _e( 'Icon Box Image', 'atelier' ); ?></label>
		<input type="text" class="search-icon-grid textfield" placeholder="Search Icon">
        <input id="iconbox-image" name="iconbox-image" type="text" value="" style="visibility: hidden;"/>
        <ul class="font-icon-grid"><?php echo atelier_get_icons_list(); ?></ul>
    </div>
    <div class="option">
        <label for="iconbox-character"><?php _e( 'Icon Character', 'atelier' ); ?></label>
        <input id="iconbox-character" name="iconbox-character" type="text" value=""/>

        <p class="info">Instead of an icon, you can optionally provide a single letter/digit here. NOTE: This will
            override the icon selection.</p>
    </div>
    <div class="option">
        <label for="iconbox-color"><?php _e( 'Icon Color', 'atelier' ); ?></label>
        <select id="iconbox-color" name="iconbox-color">
            <option value="standard"><?php _e( 'Standard', 'atelier' ); ?></option>
            <option value="accent"><?php _e( 'Accent', 'atelier' ); ?></option>
            <option value="secondary-accent"><?php _e( 'Secondary Accent', 'atelier' ); ?></option>
            <option value="icon-one"><?php _e( 'Icon One', 'atelier' ); ?></option>
            <option value="icon-two"><?php _e( 'Icon Two', 'atelier' ); ?></option>
            <option value="icon-three"><?php _e( 'Icon Three', 'atelier' ); ?></option>
            <option value="icon-four"><?php _e( 'Icon Four', 'atelier' ); ?></option>
            <p class="info">These colours are all set in the Color Customiser (link in the WP Admin Bar).</p>
        </select>
    </div>
    <div class="option">
        <label for="iconbox-title"><?php _e( 'Icon Box Title', 'atelier' ); ?></label>
        <input id="iconbox-title" name="iconbox-title" type="text" value=""/>
    </div>
    <div class="option">
        <label for="iconbox-link"><?php _e( 'Icon Box Link', 'atelier' ); ?></label>
        <input id="iconbox-link" name="iconbox-link" type="text" value=""/>

        <p class="info">This is optional, only provide if you'd like the icon box to link on click.</p>
    </div>
    <div class="option">
        <label for="iconbox-target"
               class="for-checkbox"><?php _e( 'Open link in a new window?', 'atelier' ); ?></label>
        <input id="iconbox-target" class="checkbox" name="iconbox-target" type="checkbox"/>
    </div>
    <div class="option">
        <label for="iconbox-animation"><?php _e( 'Icon Box Animation', 'atelier' ); ?></label>
        <select id="iconbox-animation" name="iconbox-animation">
            <?php echo atelier_get_animations_list(); ?>
        </select>
    </div>
    <div class="option">
        <label for="iconbox-animation-delay"><?php _e( 'Icon Box Animation Delay', 'atelier' ); ?></label>
        <input id="iconbox-animation-delay" name="iconbox-animation-delay" type="text" value="200"/>

        <p class="info">This value determines the delay to which the animation starts once it's visible on the
            screen.</p>
    </div>
</div>


<!--//////////////////////////////
////	SOCIAL
//////////////////////////////-->

<div id="shortcode-social" class="shortcode-option">
    <h5><?php _e( 'Social', 'atelier' ); ?></h5>

    <div class="option">
        <label for="social-size"><?php _e( 'Social Icon Size', 'atelier' ); ?></label>
        <select id="social-size" name="social-size">
            <option value="standard"><?php _e( 'Standard', 'atelier' ); ?></option>
            <option value="large"><?php _e( 'Large', 'atelier' ); ?></option>
        </select>
    </div>
</div>


<!--//////////////////////////////
////	SOCIAL SHARE
//////////////////////////////-->

<div id="shortcode-social-share" class="shortcode-option">
    <h5><?php _e( 'Social share', 'atelier' ); ?></h5>

    <div class="option">
        <p class="info">This shortcode will embed the social share links asset, for sharing the current post/page on
            social media.</p>
    </div>
</div>


<!--//////////////////////////////
////	TYPOGRAPHY
//////////////////////////////-->

<div id="shortcode-typography" class="shortcode-option">
    <h5><?php _e( 'Typography', 'atelier' ); ?></h5>

    <div class="option">
        <label for="typography-type"><?php _e( 'Type', 'atelier' ); ?></label>
        <select id="typography-type" name="typography-type">
            <option value="0"></option>
            <option value="highlight"><?php _e( 'Highlight', 'atelier' ); ?></option>
            <option
                value="decorative_ampersand"><?php _e( 'Decorative Ampersand', 'atelier' ); ?></option>
            <option value="blockquote1"><?php _e( 'Blockquote Standard', 'atelier' ); ?></option>
            <option value="blockquote2"><?php _e( 'Blockquote Medium', 'atelier' ); ?></option>
            <option value="blockquote3"><?php _e( 'Blockquote Big', 'atelier' ); ?></option>
            <option value="pullquote"><?php _e( 'Pull Quote', 'atelier' ); ?></option>
            <option value="dropcap1"><?php _e( 'Dropcap Type 1', 'atelier' ); ?></option>
            <option value="dropcap2"><?php _e( 'Dropcap Type 2', 'atelier' ); ?></option>
            <option value="dropcap3"><?php _e( 'Dropcap Type 3', 'atelier' ); ?></option>
            <option value="dropcap4"><?php _e( 'Dropcap Type 4', 'atelier' ); ?></option>
        </select>
    </div>
</div>


<!--//////////////////////////////
////	COLUMNS
//////////////////////////////-->

<div id="shortcode-columns" class="shortcode-option">
    <h5><?php _e( 'Columns', 'atelier' ); ?></h5>

    <div class="option">
        <label for="column-options"><?php _e( 'Layout', 'atelier' ); ?></label>
        <select id="column-options" name="column-options">
            <option value="0"></option>
            <option value="two_halves"><?php _e( '1/2 + 1/2', 'atelier' ); ?></option>
            <option value="three_thirds"><?php _e( '1/3 + 1/3 + 1/3', 'atelier' ); ?></option>
            <option value="one_third_two_thirds"><?php _e( '1/3 + 2/3', 'atelier' ); ?></option>
            <option value="two_thirds_one_third"><?php _e( '2/3 + 1/3', 'atelier' ); ?></option>
            <option value="four_quarters"><?php _e( '1/4 + 1/4 + 1/4 + 1/4', 'atelier' ); ?></option>
            <option value="one_quarter_three_quarters"><?php _e( '1/4 + 3/4', 'atelier' ); ?></option>
            <option value="three_quarters_one_quarter"><?php _e( '3/4 + 1/4', 'atelier' ); ?></option>
            <option
                value="one_quarter_one_quarter_one_half"><?php _e( '1/4 + 1/4 + 1/2', 'atelier' ); ?></option>
            <option
                value="one_quarter_one_half_one_quarter"><?php _e( '1/4 + 1/2 + 1/4', 'atelier' ); ?></option>
            <option
                value="one_half_one_quarter_one_quarter"><?php _e( '1/2 + 1/4 + 1/4', 'atelier' ); ?></option>
        </select>
    </div>
</div>

<!--//////////////////////////////
////	PROGRESS BAR
//////////////////////////////-->

<div id="shortcode-progressbar" class="shortcode-option">
    <h5><?php _e( 'Progress Bar', 'atelier' ); ?></h5>

    <div class="option">
        <label for="progressbar-percentage"><?php _e( 'Percentage', 'atelier' ); ?></label>
        <input id="progressbar-percentage" name="progressbar-percentage" type="text" value=""/>

        <p class="info">Enter the percentage of the progress bar.</p>
    </div>
    <div class="option">
        <label for="progressbar-text"><?php _e( 'Progress Text', 'atelier' ); ?></label>
        <input id="progressbar-text" name="progressbar-text" type="text" value=""/>

        <p class="info">Enter the text that you'd like shown above the bar, i.e. "COMPLETED".</p>
    </div>
    <div class="option">
        <label for="progressbar-value"><?php _e( 'Progress Value', 'atelier' ); ?></label>
        <input id="progressbar-value" name="progressbar-value" type="text" value=""/>

        <p class="info">Enter value that you'd like shown at the end of the bar on completion, i.e. "90%".</p>
    </div>
    <div class="option">
        <label for="progressbar-type"><?php _e( 'Progress Bar Type', 'atelier' ); ?></label>
        <select id="progressbar-type" name="progressbar-type">
            <option value=""><?php _e( 'Standard', 'atelier' ); ?></option>
            <option value="progress-striped"><?php _e( 'Striped', 'atelier' ); ?></option>
            <option
                value="progress-striped active"><?php _e( 'Striped - Animated', 'atelier' ); ?></option>
        </select>
    </div>
    <div class="option">
        <label for="progressbar-colour"><?php _e( 'Progress Bar Colour', 'atelier' ); ?></label>
        <input id="progressbar-colour" name="progressbar-colour" type="text" value=""/>

        <p class="info">Enter the hex value (with the #) for the progress bar colour, or it will default to accent
            colour.</p>
    </div>
</div>


<!--//////////////////////////////
////	FULLSCREEN VIDEO
//////////////////////////////-->

<div id="shortcode-fwvideo" class="shortcode-option">
    <h5><?php _e( 'Fullscreen Video', 'atelier' ); ?></h5>

    <div class="option">
        <label for="fwvideo-type"><?php _e( 'Button type', 'atelier' ); ?></label>
        <select id="fwvideo-type" name="fwvideo-type">
            <option value="image-button"><?php _e( 'Image Button', 'atelier' ); ?></option>
            <option value="image-button2"><?php _e( 'Image Button Alt', 'atelier' ); ?></option>
            <option value="image-button3"><?php _e( 'Image Button Bottom Left', 'atelier' ); ?></option>
            <option value="icon-button"><?php _e( 'Icon Button', 'atelier' ); ?></option>
            <option value="text-button"><?php _e( 'Text Button', 'atelier' ); ?></option>
        </select>

        <p class="info">Choose the button type you'd like to link to the fullscreen video.</p>
    </div>
    <div class="option">
        <label for="fwvideo-imageurl"><?php _e( 'Image URL (for image button)', 'atelier' ); ?></label>
        <input id="fwvideo-imageurl" name="fwvideo-imageurl" type="text" value=""/>

        <p class="info">If you've chosen the image button above, then please enter the full path for the image that you
            wish the fullscreen video to be linked from.</p>
    </div>
    <div class="option">
        <label for="fwvideo-btntext"><?php _e( 'Button Text (for text button)', 'atelier' ); ?></label>
        <input id="fwvideo-btntext" name="fwvideo-btntext" type="text" value=""/>

        <p class="info">If you've chosen the text button above, then please enter the text you'd like to show on the
            button. This also functions as the alt text for an image button.</p>
    </div>
    <div class="option">
        <label for="fwvideo-videourl"><?php _e( 'Video URL', 'atelier' ); ?></label>
        <input id="fwvideo-videourl" name="fwvideo-videourl" type="text" value=""/>

        <p class="info">Enter the video URL here. Vimeo/YouTube are supported, and please make sure you enter the full
            video URL, not shortened, and HTTP only.</p>
    </div>
    <div class="option">
        <label for="fwvideo-extraclass"><?php _e( 'Button Extra class', 'atelier' ); ?></label>
        <input id="fwvideo-extraclass" name="fwvideo-extraclass" type="text" value=""/>

        <p class="info">Provide any extra classes you'd like to add here (optional).</p>
    </div>
</div>


<!--//////////////////////////////
////	RESPONSIVE VISIBILITY
//////////////////////////////-->

<div id="shortcode-responsivevis" class="shortcode-option">
    <h5><?php _e( 'Responsive Visibility', 'atelier' ); ?></h5>

    <div class="option">
        <label for="responsivevis-config"><?php _e( 'Device Visiblity', 'atelier' ); ?></label>
        <select id="responsivevis-config" name="responsivevis-config">
            <option value="visible-xs"><?php _e( 'Visible - Phone', 'atelier' ); ?></option>
            <option value="visible-md visible-sm"><?php _e( 'Visible - Tablet', 'atelier' ); ?></option>
            <option value="visible-lg"><?php _e( 'Visible - Desktop', 'atelier' ); ?></option>
            <option value="hidden-xs"><?php _e( 'Hidden - Phone', 'atelier' ); ?></option>
            <option value="hidden-md hidden-sm"><?php _e( 'Hidden - Tablet', 'atelier' ); ?></option>
            <option value="hidden-lg"><?php _e( 'Hidden - Desktop', 'atelier' ); ?></option>
        </select>

        <p class="info">Choose the responsive visibility for the content within the shortcode.</p>
    </div>
</div>


<!--//////////////////////////////
////	TOOLTIP
//////////////////////////////-->

<div id="shortcode-tooltip" class="shortcode-option">
    <h5><?php _e( 'Tooltip', 'atelier' ); ?></h5>

    <div class="option">
        <label for="tooltip-text"><?php _e( 'Text', 'atelier' ); ?></label>
        <input id="tooltip-text" name="tooltip-text" type="text" value=''/>

        <p class="info">Enter the text for the tooltip.</p>
    </div>
    <div class="option">
        <label for="tooltip-link"><?php _e( 'Link', 'atelier' ); ?></label>
        <input id="tooltip-link" name="tooltip-link" type="text" value=""/>

        <p class="info">Enter the link that the tooltip text links to.</p>
    </div>
    <div class="option">
        <label for="tooltip-direction"><?php _e( 'Direction', 'atelier' ); ?></label>
        <select id="tooltip-direction" name="tooltip-direction">
            <option value="top"><?php _e( 'Top', 'atelier' ); ?></option>
            <option value="bottom"><?php _e( 'Bottom', 'atelier' ); ?></option>
            <option value="left"><?php _e( 'Left', 'atelier' ); ?></option>
            <option value="right"><?php _e( 'Right', 'atelier' ); ?></option>
        </select>

        <p class="info">Choose the direction in which the tooltip appears.</p>
    </div>
</div>


<!--//////////////////////////////
////	MODAL
//////////////////////////////-->

<div id="shortcode-modal" class="shortcode-option">
    <h5><?php _e( 'Modal', 'atelier' ); ?></h5>
	
	<div class="option">
	    <label for="modal-link-type"><?php _e( 'Link Type', 'atelier' ); ?></label>
	    <select id="modal-link-type" name="modal-link-type">
	        <option value="button"><?php _e( 'Button', 'atelier' ); ?></option>
	        <option value="text"><?php _e( 'Text Link', 'atelier' ); ?></option>
	    </select>
	</div>
	
	<div class="option">
	    <label for="modal-link-text"><?php _e( 'Modal link text', 'atelier' ); ?></label>
	    <input id="modal-link-text" name="modal-link-text" type="text" value="<?php _e( 'Modal link', 'atelier' ); ?>"/>
	    <p class="info">If using the Text Link type, then enter the link text here.</p>
	</div>
	
    <div class="option">
        <label for="modal-button-size"><?php _e( 'Modal Button size', 'atelier' ); ?></label>
        <select id="modal-button-size" name="modal-button-size">
            <option value="standard"><?php _e( 'Standard', 'atelier' ); ?></option>
            <option value="large"><?php _e( 'Large', 'atelier' ); ?></option>
        </select>
    </div>
    <div class="option">
        <label for="modal-button-colour"><?php _e( 'Modal Button colour', 'atelier' ); ?></label>
        <select id="modal-button-colour" name="modal-button-colour">
            <option value="accent"><?php _e( 'Accent', 'atelier' ); ?></option>
            <option value="black"><?php _e( 'Black', 'atelier' ); ?></option>
            <option value="white"><?php _e( 'White', 'atelier' ); ?></option>
            <option value="blue"><?php _e( 'Blue', 'atelier' ); ?></option>
            <option value="grey"><?php _e( 'Grey', 'atelier' ); ?></option>
            <option value="lightgrey"><?php _e( 'Light Grey', 'atelier' ); ?></option>
            <option value="orange"><?php _e( 'Orange', 'atelier' ); ?></option>
            <option value="turquoise"><?php _e( 'Turquoise', 'atelier' ); ?></option>
            <option value="green"><?php _e( 'Green', 'atelier' ); ?></option>
            <option value="pink"><?php _e( 'Pink', 'atelier' ); ?></option>
            <option value="gold"><?php _e( 'Gold', 'atelier' ); ?></option>
            <option value="transparent-light"><?php _e( 'Transparent - Light (For use on images/dark backgrounds)', 'atelier' ); ?></option>
            <option value="transparent-dark"><?php _e( 'Transparent - Dark', 'atelier' ); ?></option>
        </select>
    </div>
    <div class="option">
        <label for="modal-button-type"><?php _e( 'Modal Button type', 'atelier' ); ?></label>
        <select id="modal-button-type" name="modal-button-type">
            <option value="standard"><?php _e( 'Standard', 'atelier' ); ?></option>
            <option value="stroke-to-fill"><?php _e( 'Stroke To Fill', 'atelier' ); ?></option>
            <option value="sf-icon-reveal"><?php _e( 'Icon Reveal', 'atelier' ); ?></option>
            <option value="sf-icon-stroke"><?php _e( 'Icon', 'atelier' ); ?></option>
        </select>
    </div>
    <div class="option">
        <label
            for="modal-button-icon"><?php _e( 'Modal Button Icon (Icon Reveal Only)', 'atelier' ); ?></label>
        <input id="modal-button-icon" name="modal-button-icon" type="text" value="ss-star"/>
    </div>
    <div class="option">
        <label for="modal-button-text"><?php _e( 'Modal Button text', 'atelier' ); ?></label>
        <input id="modal-button-text" name="modal-button-text" type="text"
               value="<?php _e( 'Button text', 'atelier' ); ?>"/>
    </div>
    <div class="option">
        <label for="modal-header"><?php _e( 'Header', 'atelier' ); ?></label>
        <input id="modal-header" name="modal-header" type="text" value=''/>

        <p class="info">Enter the heading for the modal popup.</p>
    </div>
</div>


<!--//////////////////////////////
////	CHART
//////////////////////////////-->

<div id="shortcode-chart" class="shortcode-option">
    <h5><?php _e( 'Chart', 'atelier' ); ?></h5>

    <div class="option">
        <label for="chart-percentage"><?php _e( 'Percentage', 'atelier' ); ?></label>
        <input id="chart-percentage" name="chart-percentage" type="text" value=""/>

        <p class="info">Enter the percentage of the chart value. NOTE: This must be between 0-100, numeric only.</p>
    </div>
    <div class="option">
        <label for="chart-content"><?php _e( 'Content', 'atelier' ); ?></label>
        <input id="chart-content" name="chart-content" type="text" value=''/>

        <p class="info">Enter the content for the center of the chart, i.e. a number or percentage. NOTE: if you'd like
            to include a font awesome icon or Gizmo icon here, just enter the icon name, i.e. "fa-magic".</p>
    </div>
    <div class="option">
        <label for="chart-size"><?php _e( 'Chart Size', 'atelier' ); ?></label>
        <select id="chart-size" name="chart-size">
            <option value="70"><?php _e( 'Standard', 'atelier' ); ?></option>
            <option value="170"><?php _e( 'Large', 'atelier' ); ?></option>
        </select>
    </div>
    <div class="option">
        <label for="chart-barcolour"><?php _e( 'Chart Bar Colour', 'atelier' ); ?></label>
        <input id="chart-barcolour" name="chart-barcolour" type="text" value=""/>

        <p class="info">Enter the hex value (with the #) for the chart bar colour.</p>
    </div>
    <div class="option">
        <label for="chart-trackcolour"><?php _e( 'Chart Track Colour', 'atelier' ); ?></label>
        <input id="chart-trackcolour" name="chart-trackcolour" type="text" value=""/>

        <p class="info">Enter the hex value (with the #) for the chart track colour (the path the bar follows).</p>
    </div>
    <div class="option">
        <label for="chart-align"><?php _e( 'Chart Align', 'atelier' ); ?></label>
        <select id="chart-align" name="chart-align">
            <option value="left"><?php _e( 'Left', 'atelier' ); ?></option>
            <option value="center"><?php _e( 'Center', 'atelier' ); ?></option>
        </select>
    </div>
</div>


<!--//////////////////////////////
////	COUNTERS
//////////////////////////////-->

<div id="shortcode-counters" class="shortcode-option">
    <h5><?php _e( 'Counters', 'atelier' ); ?></h5>

    <div class="option">
        <label for="count-from"><?php _e( 'From Value', 'atelier' ); ?></label>
        <input id="count-from" name="count-from" type="text" value=""/>

        <p class="info">Enter the number from which the counter starts at.</p>
    </div>
    <div class="option">
        <label for="count-to"><?php _e( 'To Value', 'atelier' ); ?></label>
        <input id="count-to" name="count-to" type="text" value=""/>

        <p class="info">Enter the number from which the counter counts up to.</p>
    </div>
    <div class="option">
        <label for="count-prefix"><?php _e( 'Prefix Text', 'atelier' ); ?></label>
        <input id="count-prefix" name="count-prefix" type="text" value=""/>

        <p class="info">Enter the text which you would like to show before the count number (optional).</p>
    </div>
    <div class="option">
        <label for="count-suffix"><?php _e( 'Suffix Text', 'atelier' ); ?></label>
        <input id="count-suffix" name="count-suffix" type="text" value=""/>

        <p class="info">Enter the text which you would like to show after the count number (optional).</p>
    </div>
    <div class="option">
        <label for="count-commas"
               class="for-checkbox"><?php _e( 'Comma Seperated', 'atelier' ); ?></label>
        <input id="count-commas" class="checkbox" name="count-commas" type="checkbox"/>

        <p class="info">Include comma separators in the numbers after every 3rd digit.</p>
    </div>
    <div class="option">
        <label for="count-subject"><?php _e( 'Subject Text', 'atelier' ); ?></label>
        <input id="count-subject" name="count-subject" type="text" value=""/>

        <p class="info">Enter the text which you would like to show below the counter.</p>
    </div>
    <div class="option">
        <label for="count-speed"><?php _e( 'Speed', 'atelier' ); ?></label>
        <input id="count-speed" name="count-speed" type="text" value=""/>

        <p class="info">Enter the time you want the counter to take to complete, this is in milliseconds and optional.
            The default is 2000.</p>
    </div>
    <div class="option">
        <label for="count-refresh"><?php _e( 'Refresh Interval', 'atelier' ); ?></label>
        <input id="count-refresh" name="count-refresh" type="text" value=""/>

        <p class="info">Enter the time to wait between refreshing the counter. This is in milliseconds and optional. The
            default is 25.</p>
    </div>
    <div class="option">
        <label for="count-textstyle"><?php _e( 'Text style', 'atelier' ); ?></label>
        <select id="count-textstyle" name="count-textstyle">
            <option value="h3"><?php _e( 'H3', 'atelier' ); ?></option>
            <option value="h6"><?php _e( 'H6', 'atelier' ); ?></option>
            <option value="div"><?php _e( 'Body', 'atelier' ); ?></option>
        </select>
    </div>
    <div class="option">
        <label for="count-textcolor"><?php _e( 'Text Color', 'atelier' ); ?></label>
        <input id="count-textcolor" name="count-textcolor" type="text" value=""/>

        <p class="info">Enter the hex colour code here for a custom colour (e.g. #ff9900).</p>
    </div>
</div>


<!--//////////////////////////////
////	COUNTDOWN
//////////////////////////////-->

<div id="shortcode-countdown" class="shortcode-option">
    <h5><?php _e( 'Countdown', 'atelier' ); ?></h5>

    <div class="option">
        <label for="countdown-year"><?php _e( 'Year', 'atelier' ); ?></label>
        <input id="countdown-year" name="countdown-year" type="text" value=""/>

        <p class="info">Enter the year for which you want the countdown to count to (e.g. 2020).</p>
    </div>
    <div class="option">
        <label for="countdown-month"><?php _e( 'Month', 'atelier' ); ?></label>
        <input id="countdown-month" name="countdown-month" type="text" value=""/>

        <p class="info">Enter the month for which you want the countdown to count to (e.g. 10).</p>
    </div>
    <div class="option">
        <label for="countdown-day"><?php _e( 'Day', 'atelier' ); ?></label>
        <input id="countdown-day" name="countdown-day" type="text" value=""/>

        <p class="info">Enter the day for which you want the countdown to count to (e.g. 24).</p>
    </div>
    <div class="option">
        <label for="countdown-displaytext"><?php _e( 'Display Text', 'atelier' ); ?></label>
        <input id="countdown-displaytext" name="countdown-displaytext" type="text" value=""/>

        <p class="info">Enter the text that you want to show below the countdown (optional).</p>
    </div>
</div>


<!--//////////////////////////////
////	IMAGE BANNER
//////////////////////////////-->

<div id="shortcode-imagebanner" class="shortcode-option">
    <h5><?php _e( 'Image Banner', 'atelier' ); ?></h5>

    <div class="option">
        <label for="imagebanner-image"><?php _e( 'Background Image', 'atelier' ); ?></label>
        <input id="imagebanner-image" name="imagebanner-image" type="text" value=""/>

        <p class="info">Provide the URL here for the background image that you would like to use.</p>
    </div>
    <div class="option">
        <label for="imagebanner-animation"><?php _e( 'Content Animation', 'atelier' ); ?></label>
        <select id="imagebanner-animation" name="imagebanner-animation">
            <?php echo atelier_get_animations_list(); ?>
        </select>

        <p class="info">Choose the intro animation for the content.</p>
    </div>
    <div class="option">
        <label for="imagebanner-contentpos"><?php _e( 'Content Position', 'atelier' ); ?></label>
        <select id="imagebanner-contentpos" name="imagebanner-contentpos">
            <option value="left"><?php _e( 'Left', 'atelier' ); ?></option>
            <option value="center"><?php _e( 'Center', 'atelier' ); ?></option>
            <option value="right"><?php _e( 'Right', 'atelier' ); ?></option>
        </select>

        <p class="info">Choose the alignment for the content.</p>
    </div>
    <div class="option">
        <label for="imagebanner-textalign"><?php _e( 'Text Align', 'atelier' ); ?></label>
        <select id="imagebanner-textalign" name="imagebanner-textalign">
            <option value="left"><?php _e( 'Left', 'atelier' ); ?></option>
            <option value="center"><?php _e( 'Center', 'atelier' ); ?></option>
            <option value="right"><?php _e( 'Right', 'atelier' ); ?></option>
        </select>

        <p class="info">Choose the alignment for the text within the content.</p>
    </div>
    <div class="option">
        <label for="imagebanner-link"><?php _e( 'Image Banner Link', 'atelier' ); ?></label>
        <input id="imagebanner-link" name="imagebanner-link" type="text" value=""/>

        <p class="info">This is optional, only provide if you'd like the entire image banner to link on click.</p>
    </div>
    <div class="option">
        <label for="imagebanner-target"
               class="for-checkbox"><?php _e( 'Open link in a new window?', 'atelier' ); ?></label>
        <input id="imagebanner-target" class="checkbox" name="imagebanner-target" type="checkbox"/>
    </div>
    <div class="option">
        <label for="imagebanner-extraclass"><?php _e( 'Extra class', 'atelier' ); ?></label>
        <input id="imagebanner-extraclass" name="imagebanner-extraclass" type="text" value=""/>

        <p class="info">Provide any extra classes you'd like to add here (optional).</p>
    </div>
</div>


<!--//////////////////////////////
////	TABLE
//////////////////////////////-->

<div id="shortcode-tables" class="shortcode-option">
    <h5><?php _e( 'Tables', 'atelier' ); ?></h5>

    <div class="option">
        <label for="table-type"><?php _e( 'Table style', 'atelier' ); ?></label>
        <select id="table-type" name="table-type">
            <option value="standard_minimal"><?php _e( 'Standard minimal table', 'atelier' ); ?></option>
            <option value="striped_minimal"><?php _e( 'Striped minimal table', 'atelier' ); ?></option>
            <option
                value="standard_bordered"><?php _e( 'Standard bordered table', 'atelier' ); ?></option>
            <option value="striped_bordered"><?php _e( 'Striped bordered table', 'atelier' ); ?></option>
        </select>
    </div>
    <div class="option">
        <label for="table-head"><?php _e( 'Table Head', 'atelier' ); ?></label>
        <select id="table-head" name="table-head">
            <option value="yes"><?php _e( 'Yes', 'atelier' ); ?></option>
            <option value="no"><?php _e( 'No', 'atelier' ); ?></option>
            <p class="info">Include a heading row in the table</p>
        </select>
    </div>
    <div class="option">
        <label for="table-columns"><?php _e( 'Number of columns', 'atelier' ); ?></label>
        <select id="table-columns" name="table-columns">
            <option value="1"><?php _e( '1', 'atelier' ); ?></option>
            <option value="2"><?php _e( '2', 'atelier' ); ?></option>
            <option value="3"><?php _e( '3', 'atelier' ); ?></option>
            <option value="4"><?php _e( '4', 'atelier' ); ?></option>
            <option value="5"><?php _e( '5', 'atelier' ); ?></option>
            <option value="6"><?php _e( '6', 'atelier' ); ?></option>
        </select>
    </div>

    <div class="option">
        <label for="table-rows"><?php _e( 'Number of rows', 'atelier' ); ?></label>
        <select id="table-rows" name="table-rows">
            <option value="1"><?php _e( '1', 'atelier' ); ?></option>
            <option value="2"><?php _e( '2', 'atelier' ); ?></option>
            <option value="3"><?php _e( '3', 'atelier' ); ?></option>
            <option value="4"><?php _e( '4', 'atelier' ); ?></option>
            <option value="5"><?php _e( '5', 'atelier' ); ?></option>
            <option value="6"><?php _e( '6', 'atelier' ); ?></option>
            <option value="7"><?php _e( '7', 'atelier' ); ?></option>
            <option value="8"><?php _e( '8', 'atelier' ); ?></option>
            <option value="9"><?php _e( '9', 'atelier' ); ?></option>
            <option value="10"><?php _e( '10', 'atelier' ); ?></option>
        </select>
    </div>
</div>

<!--//////////////////////////////
////	LISTS
//////////////////////////////-->

<div id="shortcode-lists" class="shortcode-option">
    <h5><?php _e( 'Lists', 'atelier' ); ?></h5>

    <div class="option">
        <label for="list-icon"><?php _e( 'List icon', 'atelier' ); ?></label>
		<input type="text" class="search-icon-grid textfield" placeholder="Search Icon">
        <input id="list-icon" name="list-icon" type="text" value="" style="visibility: hidden;"/>
        <ul class="font-icon-grid"><?php echo atelier_get_icons_list(); ?></ul>
    </div>
    <div class="option">
        <label for="list-items"><?php _e( 'Number of list items', 'atelier' ); ?></label>
        <select id="list-items" name="list-items">
            <option value="1"><?php _e( '1', 'atelier' ); ?></option>
            <option value="2"><?php _e( '2', 'atelier' ); ?></option>
            <option value="3"><?php _e( '3', 'atelier' ); ?></option>
            <option value="4"><?php _e( '4', 'atelier' ); ?></option>
            <option value="5"><?php _e( '5', 'atelier' ); ?></option>
            <option value="6"><?php _e( '6', 'atelier' ); ?></option>
            <option value="7"><?php _e( '7', 'atelier' ); ?></option>
            <option value="8"><?php _e( '8', 'atelier' ); ?></option>
            <option value="9"><?php _e( '9', 'atelier' ); ?></option>
            <option value="10"><?php _e( '10', 'atelier' ); ?></option>
            <p class="info">You can easily add more by duplicating the code after.</p>
        </select>
    </div>
    <div class="option">
        <label for="list-extraclass"><?php _e( 'List Extra Class', 'atelier' ); ?></label>
        <input id="list-extraclass" name="list-extraclass" type="text" value=""/>

        <p class="info">Optional, for extra styling/custom colour control.</a></p>
    </div>
</div>

</fieldset>

<!-- CLOSE #shortcode_panel -->
</div>

<div class="buttons clearfix">
    <input type="submit" id="insert" name="insert" value="<?php _e( 'Insert Shortcode', 'atelier' ); ?>"
           onClick="embedSelectedShortcode();"/>
</div>

<!-- CLOSE #shortcode_wrap -->
</div>

<!-- CLOSE swiftframework_shortcode_form -->
</form>

<!-- CLOSE body -->
</body>

<!-- CLOSE html -->
</html>
