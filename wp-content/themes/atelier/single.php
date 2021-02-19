<?php get_header(); ?>
	
<?php
	global $atelier_options;
	$default_sidebar_config = $atelier_options['default_post_sidebar_config'];
	$default_left_sidebar = $atelier_options['default_post_left_sidebar'];
	$default_right_sidebar = $atelier_options['default_post_right_sidebar'];
	
	$sidebar_config = atelier_get_post_meta($post->ID, 'sf_sidebar_config', true);
	$left_sidebar = atelier_get_post_meta($post->ID, 'sf_left_sidebar', true);
	$right_sidebar = atelier_get_post_meta($post->ID, 'sf_right_sidebar', true);
	$right_sidebar = atelier_get_post_meta($post->ID, 'sf_right_sidebar', true);
	$page_design_style = atelier_get_post_meta($post->ID, 'sf_page_design_style', true );
	
	if ($sidebar_config == "") {
		$sidebar_config = $default_sidebar_config;
	}
	if ($left_sidebar == "") {
		$left_sidebar = $default_left_sidebar;
	}
	if ($right_sidebar == "") {
		$right_sidebar = $default_right_sidebar;
	}
	
	atelier_set_sidebar_global($sidebar_config);	
?>

<?php if ( $page_design_style == "hero-content-split" ) { ?>
<div class="container">
<?php } ?>

	<?php atelier_base_layout('single-post'); ?>

<?php if ( $page_design_style == "hero-content-split" ) { ?>
</div>
<?php } ?>

<?php get_footer(); ?>