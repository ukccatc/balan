<?php

	/*
	*
	*	Header 3
	*	------------------------------------------------
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*	Output for header-3
	*
	*/
	
	global $atelier_options;
	$fullwidth_header    = $atelier_options['fullwidth_header'];
?>

<?php if ( $fullwidth_header ) { ?>
<header id="header" class="sticky-header fw-header clearfix">
<?php } else { ?>
<header id="header" class="sticky-header clearfix">
<?php } ?>
	<div class="container">
		<div class="row">
	
			<?php echo atelier_logo( 'col-sm-4 logo-left' ); ?>
			
			<?php echo atelier_main_menu( 'main-navigation', 'float-2' ); ?>
			
			<div class="header-right col-sm-4">
				<?php echo atelier_header_aux( 'right' ); ?>
			</div>
		
		</div> <!-- CLOSE .row -->
	</div> <!-- CLOSE .container -->
</header>