<?php
    global $atelier_options;
    $type = "";
    if ( isset($atelier_options['404_type']) ) {
    	$type = $atelier_options['404_type'];
    }
    
    if ( $type == "page" ) {
    	$page = __( $atelier_options['404_page'], 'atelier' );
        $current_page_URL = atelier_current_page_url();
        $page_URL = get_permalink( $page );

	    if ( $current_page_URL != $page_URL ) {
            wp_redirect( $page_URL );
            exit;
        }
    }
    
    $error_content = __( $atelier_options['404_page_content'], 'atelier' );
?>

<div class="help-text">
    <?php echo do_shortcode( $error_content ); ?>
</div>
<form method="get" class="search-form" action="<?php echo home_url(); ?>/">
    <input type="text" placeholder="<?php _e( "Search", 'atelier' ); ?>" name="s"/>
</form>