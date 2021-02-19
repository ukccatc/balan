<?php

	/*
	*
	*	Header 10
	*	------------------------------------------------
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*	Output for header-4-alt
	*
	*/
	
?>

<header id="header" class="sticky-header fw-header clearfix">
	<div class="container"> 
		<div class="row"> 
			
			<div class="header-left">
				<?php echo atelier_header_aux( 'left' ); ?>
			</div>
			
			<?php echo atelier_logo( 'col-sm-4 logo-left' ); ?>
			
			<div class="header-right">
				<?php echo atelier_header_aux( 'right' ); ?>
			</div>
			
			<?php echo atelier_main_menu( 'main-navigation', 'float-2' ); ?>
			
		</div> <!-- CLOSE .row --> 
	</div> <!-- CLOSE .container --> 
</header> 
