<?php

    /* PAGE COMMENTS
    ================================================== */
    if ( ! function_exists( 'atelier_page_comments' ) ) {
        function atelier_page_comments() {

            global $atelier_options;
            $disable_pagecomments = $atelier_options['disable_pagecomments'];

            $comments_class = apply_filters( 'atelier_post_comments_wrap_class', 'col-sm-8 col-sm-offset-2' );

            if ( comments_open() && ! $disable_pagecomments ) {
                ?>
                <div class="comments-wrap container">
                    <div id="comment-area" class="<?php echo esc_attr($comments_class); ?>">
                        <?php comments_template( '', true ); ?>
                    </div>
                </div>
            <?php
            }
        }

        add_action( 'atelier_page_content_end', 'atelier_page_comments', 10 );
    }

?>

<?php while ( have_posts() ) : the_post(); ?>

    <?php do_action( 'atelier_page_content_before' ); ?>

    <div <?php post_class( 'clearfix' ); ?> id="<?php the_ID(); ?>">

        <?php do_action( 'atelier_page_content_start' ); ?>

        <?php the_content(); ?>

        <div class="link-pages"><?php wp_link_pages(); ?></div>

        <?php
            /**
             * @hooked - atelier_page_comments - 10
             **/
            do_action( 'atelier_page_content_end' );
        ?>

    </div>

    <?php do_action( 'atelier_page_content_after' ); ?>

<?php endwhile; ?>