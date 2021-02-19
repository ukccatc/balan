<?php

	/*
	*
	*	Header 4
	*	------------------------------------------------
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*	Output for header-6
	*
	*/

	global $atelier_options;
	$fullwidth_header    = $atelier_options['fullwidth_header'];
?>

<?php if ( $fullwidth_header ) { ?>
<header id="header" class="fw-header clearfix">
<?php } else { ?>
<header id="header" class="clearfix">
<?php } ?>
	<div class="container">
		<div class="row">
	
			<div class="header-left col-sm-4">
				<?php echo atelier_header_aux( 'left' ); ?>
			</div>
	
			<?php echo atelier_logo( 'col-sm-4 logo-center' ); ?>
	
			<div class="header-right col-sm-4">
				<?php echo atelier_header_aux( 'right' ); ?>
			</div>
	
		</div> <!-- CLOSE .row -->
	</div> <!-- CLOSE .container -->
</header>

<div id="main-nav" class="sticky-header center-menu">
	<?php echo atelier_main_menu( 'main-navigation', 'full' ); ?>
</div>