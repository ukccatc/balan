<?php
    global $atelier_options, $atelier_sidebar_config;

    /* META SETUP */
	$fullscreen = 'no';
    $default_sidebar_config = $atelier_options['default_sidebar_config'];
    $default_left_sidebar   = $atelier_options['default_left_sidebar'];
    $default_right_sidebar  = $atelier_options['default_right_sidebar'];

    $sidebar_config = atelier_get_post_meta($post->ID, 'sf_sidebar_config', true );
    $left_sidebar   = atelier_get_post_meta($post->ID, 'sf_left_sidebar', true );
    $right_sidebar  = atelier_get_post_meta($post->ID, 'sf_right_sidebar', true );
    
    /* MAP META */
    $map_lat_cord = atelier_get_post_meta($post->ID, 'sf_directory_lat_coord', true );
    $map_lng_cord = atelier_get_post_meta($post->ID, 'sf_directory_lng_coord', true );
    $map_address = atelier_get_post_meta($post->ID, 'sf_directory_address', true );
    $map_pin = atelier_get_post_meta($post->ID, 'sf_directory_map_pin', true );
    $map_pin_button_text = atelier_get_post_meta($post->ID, 'sf_directory_pin_button_text', true );
    $map_pin_link = atelier_get_post_meta($post->ID, 'sf_directory_pin_link', true );   

    if ( $sidebar_config == "" ) {
        $sidebar_config = $default_sidebar_config;
    }
    if ( $left_sidebar == "" ) {
        $left_sidebar = $default_left_sidebar;
    }
    if ( $right_sidebar == "" ) {
        $right_sidebar = $default_right_sidebar;
    }
    $page_content_class = $content_wrap_class = "";

    /* SIDEBAR SETUP */
    if ( $sidebar_config == "left-sidebar" ) {
    	$fullscreen = 'no';
        add_action( 'atelier_after_post_content', 'atelier_post_left_sidebar', 10 );
    } else if ( $sidebar_config == "right-sidebar" ) {
    	$fullscreen = 'no';
        add_action( 'atelier_after_post_content', 'atelier_post_right_sidebar', 10 );
    }

    /* PAGE BUILDER CHECK */
    $page_content_class = "container";

    /* CONTENT WRAP */
    $cont_width = $sidebar_width = "";
    if ($atelier_options['sidebar_width'] == "reduced") {
    	$cont_width = apply_filters("atelier_base_layout_cont_width_reduced", "col-sm-9");
    	$sidebar_width = apply_filters("atelier_base_layout_cont_width_reduced_sidebar", "col-sm-3");
    } else {
    	$cont_width = apply_filters("atelier_base_layout_cont_width", "col-sm-8");
    	$sidebar_width = apply_filters("atelier_base_layout_cont_width_sidebar", "col-sm-4");
    }
    if ( $sidebar_config == "right-sidebar" ) {
        $content_wrap_class = apply_filters( 'atelier_post_content_wrap_class', $cont_width . ' content-left' );
    } else if ( $sidebar_config == "left-sidebar" ) {
        $content_wrap_class = apply_filters( 'atelier_post_content_wrap_class', $cont_width . ' content-right' );
    } else {
        $content_wrap_class = apply_filters( 'atelier_post_content_wrap_class_nosidebar', 'col-sm-12 ' );
    }

    remove_action( 'atelier_post_after_article', 'atelier_post_pagination', 5 );
    remove_action( 'atelier_post_after_article', 'atelier_post_related_articles', 10 );
    remove_action( 'atelier_post_after_article', 'atelier_post_comments', 20 );
?>

<?php while (have_posts()) : the_post(); ?>

    <!-- OPEN article -->
    <article <?php post_class( 'clearfix single-directory' ); ?> id="<?php the_ID(); ?>">

        <?php
            /**
             * @hooked - atelier_post_detail_heading - 10
             * @hooked - atelier_post_detail_media - 20
             **/
            do_action( 'atelier_post_article_start' );
        ?>
 
        <section class="page-content clearfix <?php echo esc_attr($page_content_class); ?>">
        

            <?php
                do_action( 'atelier_before_post_content' );
            ?>
            

            <div class="content-wrap <?php echo esc_attr($content_wrap_class); ?> clearfix" itemprop="articleBody">
                <?php
                    /**
                     * @hooked - atelier_post_detail_media - 10 (standard)
                     **/
                    do_action( 'atelier_post_content_start' );
                ?>
                <?php the_content(); ?>
                <div class="link-pages"><?php wp_link_pages(); ?></div>
                
                <div class="single-directory-map">
                <h3><?php _e( 'Location', 'atelier' )?></h3>
       
                     <?php echo do_shortcode('[spb_gmaps size="400" type="roadmap" zoom="14" saturation="color" fullscreen="'.$fullscreen.'" width="1/1" el_position="first last"] [spb_map_pin pin_title="' . get_the_title() . '" address="' . $map_address .'" pin_latitude="' . $map_lat_cord . '" pin_longitude="' . $map_lng_cord . '" pin_image="' . $map_pin . '" pin_link="' . $map_pin_link . '" pin_button_text="' . $map_pin_button_text . '" width="1/1" el_position="first last"][/spb_map_pin] [/spb_gmaps]'); ?>
    
               </div>


                <?php
                    /**
                     * @hooked - atelier_post_review - 20
                     * @hooked - atelier_post_share - 30
                     * @hooked - atelier_post_details - 40
                     **/
                    do_action( 'atelier_post_content_end' );
                ?>
            </div>

            <?php
                /**
                 * @hooked - atelier_post_left_sidebar - 10
                 * @hooked - atelier_post_right_sidebar - 10
                 **/
                do_action( 'atelier_after_post_content' );
            ?>

        </section>

        <?php
            do_action( 'atelier_post_article_end' );
        ?>

        <!-- CLOSE article -->
    </article>
   
    <section class="article-extras">

        <?php
            /**
             * @hooked - atelier_post_pagination - 5
             * @hooked - atelier_post_related_articles - 10
             * @hooked - atelier_post_comments - 20
             **/
            do_action( 'atelier_post_after_article' );
        ?>

    </section>
   

<?php endwhile; ?>
