<?php

	/*
	*
	*	Header 2
	*	------------------------------------------------
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*	Output for header-4
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
			
			<div class="header-right">
				<?php echo atelier_header_aux( 'right' ); ?>
			</div>
			
			<?php echo atelier_main_menu( 'main-navigation', 'float-2' ); ?>
			
		</div> <!-- CLOSE .row --> 
	</div> <!-- CLOSE .container --> 
</header> 