<?php
    global $atelier_options;
	
    $blog_type      = $atelier_options['archive_display_type'];
	$blog_classes 	= atelier_blog_classes( $blog_type );
    $columns   		= 4;
    $pagination 	= "standard";
    if ( isset($atelier_options['archive_display_columns']) ) {
    $columns   = $atelier_options['archive_display_columns'];
    }
    if ( isset($atelier_options['archive_display_pagination']) ) {
    $pagination   = $atelier_options['archive_display_pagination'];
    }
    $content_output = $atelier_options['archive_content_output'];
	$item_class 	= $blog_classes['item'];
	$show_read_more = "no";
	
	if ( $blog_type == "masonry" ) {
		if ( $columns == "5" ) {
		    $item_class = "col-sm-sf-5";
		} else if ( $columns == "4" ) {
		    $item_class = "col-sm-3";
		} else if ( $columns == "3" ) {
		    $item_class = "col-sm-4";
		} else if ( $columns == "2" ) {
		    $item_class = "col-sm-6";
		} else if ( $columns == "1" ) {
		    $item_class = "col-sm-12";
		}
		
	    if ( $content_output == "excerpt" ) {
	        $show_read_more = "yes";
	    }
    }
?>

<div class="blog-wrap blog-items-wrap blog-<?php echo esc_attr($blog_type); ?>">

	<?php if ( have_posts() ) : ?>
	
	        <?php if ( $blog_type == "timeline" ) { ?>
	            <div class="timeline"></div>
	        <?php } ?>
	
	        <!-- OPEN .blog-items -->
	        <ul class="blog-items row <?php echo esc_attr($blog_classes['list']); ?> clearfix"
	            data-blog-type="<?php echo esc_attr($blog_type); ?>">
	
	            <?php while ( have_posts() ) : the_post(); ?>
	
	                <?php
	                $post_format = get_post_format( $post->ID );
	                if ( $post_format == "" ) {
	                    $post_format = 'standard';
	                }
	                ?>
	                <li <?php post_class( 'blog-item ' . $item_class . ' format-' . $post_format ); ?> itemscope itemtype="http://schema.org/BlogPosting">
	                    <?php echo atelier_get_post_item( $post->ID, $blog_type, "yes", "yes", "yes", "20", $content_output, $show_read_more ); ?>
	                </li>
	
	            <?php endwhile; ?>
	
	            <!-- CLOSE .blog-items -->
	        </ul>
	
	
	
	<?php else: ?>
	
	    <h3><?php _e( "Sorry, there are no posts to display.", 'atelier' ); ?></h3>
	    
	    <div class="no-results-text">
            <p><?php _e( "Please use the form below to search again.", 'atelier' ); ?></p>
    
            <form method="get" class="search-form" action="<?php echo home_url(); ?>/">
                <input type="text" placeholder="<?php _e( "Search", 'atelier' ); ?>" name="s"/>
            </form>
            <p><?php _e( "Alternatively, you can browse the sitemap below.", 'atelier' ); ?></p>
            <?php echo do_shortcode( '[sf_sitemap]' ); ?>
        </div>

	<?php endif; ?>
        
	<?php if ( $pagination == "infinite-scroll" ) {
	
	    global $sf_include_infscroll;
	    $sf_include_infscroll = true;
	
	    echo '<div class="pagination-wrap hidden">' . pagenavi( $wp_query ) . '</div>';
	
	} else if ( $pagination == "load-more" ) {
	
	    global $sf_include_infscroll;
	    $sf_include_infscroll = true;
	
	   	echo '<a href="#" class="load-more-btn">' . __( 'Load More', 'atelier' ) . '</a>';
	    echo '<div class="pagination-wrap load-more hidden">' . pagenavi( $wp_query ) . '</div>';
	
	} else if ( $pagination == "standard" ) {
	    if ( $blog_type == "masonry" ) {
	        echo '<div class="pagination-wrap masonry-pagination">';
	    } else {
	        echo '<div class="pagination-wrap">';
	    }
	    echo pagenavi( $wp_query );
	    echo '</div>';
	}
	?>

</div>