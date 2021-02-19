<?php get_header(); ?>

<div class="container">

	<?php 
	if ( is_tax( 'download_category' ) && class_exists( 'ATCF_Campaigns' ) ) {
    	atelier_base_layout('campaigns');	
    } else if ( is_tax( 'download_category' ) && atelier_edd_activated() ) {
        atelier_base_layout('edd-archive');      
    }
	?>
	
</div>

<?php get_footer(); ?>