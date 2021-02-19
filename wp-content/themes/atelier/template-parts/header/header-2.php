<?php

	/*
	*
	*	Header 9
	*	------------------------------------------------
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*	Output for header-2
	*
	*/
	
?>

<header id="header" class="clearfix">
	<div class="container">
		<div class="row">
		
		<?php echo atelier_logo( 'col-sm-4 logo-left' ); ?>
		
		<div class="header-right col-sm-8">
			<?php echo atelier_header_aux( 'right' ); ?>
		</div>
		
		</div> <!-- CLOSE .row -->
	</div> <!-- CLOSE .container -->
</header>

<div id="main-nav" class="sticky-header">
	<?php echo atelier_main_menu( 'main-navigation', 'full' ); ?>
</div>