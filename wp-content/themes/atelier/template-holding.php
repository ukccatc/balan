<?php
	/*
		Template Name: Holding Page
	*/
?>

<?php get_header('alt'); ?>
	
<?php
	global $atelier_options;
	$default_sidebar_config = $atelier_options['default_sidebar_config'];
	$default_left_sidebar = $atelier_options['default_left_sidebar'];
	$default_right_sidebar = $atelier_options['default_right_sidebar'];
	
	$sidebar_config = atelier_get_post_meta($post->ID, 'sf_sidebar_config', true);
	$left_sidebar = atelier_get_post_meta($post->ID, 'sf_left_sidebar', true);
	$right_sidebar = atelier_get_post_meta($post->ID, 'sf_right_sidebar', true);
	
	if ($sidebar_config == "") {
		$sidebar_config = $default_sidebar_config;
	}
	if ($left_sidebar == "") {
		$left_sidebar = $default_left_sidebar;
	}
	if ($right_sidebar == "") {
		$right_sidebar = $default_right_sidebar;
	}
				
	$pb_fw_mode = true;
	$pb_active = atelier_get_post_meta($post->ID, '_spb_status', true);
	if ($sidebar_config != "no-sidebars" || $pb_active != "true") {
		$pb_fw_mode = false;
	}
		
?>

<?php 
	// Check if page should be enabled in full width mode
	if (!$pb_fw_mode) { ?>
	<div class="container">
<?php } ?>

	<?php atelier_base_layout('page'); ?>
	
<?php 
	// Check if page should be enabled in full width mode
	if (!$pb_fw_mode) { ?>
	</div>
<?php } ?>

<?php get_footer('alt'); ?>