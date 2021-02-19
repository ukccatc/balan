<?php
    atelier_set_sidebar_global( 'no-sidebars' );
    $content_wrap_class = apply_filters( 'atelier_campaign_content_wrap_class_nosidebar', 'col-sm-8' );
    remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );
    remove_action( 'atcf_campaign_contribute_custom_price', 'edd_purchase_link_top', 5 );
?>

<?php while (have_posts()) : the_post(); ?>

    <!-- OPEN article -->
    <article <?php post_class( 'clearfix' ); ?> id="<?php the_ID(); ?>">

        <?php
            do_action( 'atelier_campaign_article_start' );
        ?>

        <section class="page-content clearfix container">

            <?php
                do_action( 'atelier_before_campaign_content' );
            ?>

            <div class="content-wrap <?php echo esc_attr($content_wrap_class); ?> clearfix">
                <?php
                    /**
                     * @hooked - atelier_campaign_detail_media - 10 (standard)
                     **/
                    do_action( 'atelier_campaign_content_start' );
                ?>
                <?php the_content(); ?>
                <?php
                    /**
                     * @hooked - atelier_campaign_updates - 10
                     * @hooked - atelier_campaign_share - 20
                     * @hooked - atelier_campaign_info - 30
                     **/
                    do_action( 'atelier_campaign_content_end' );
                ?>
            </div>

            <?php
                do_action( 'atelier_after_campaign_content' );
            ?>

        </section>

        <?php
            do_action( 'atelier_campaign_article_end' );
        ?>

        <!-- CLOSE article -->
    </article>

    <section class="article-extras">

        <?php
            /**
             * @hooked - atelier_campaign_pagination - 10
             * @hooked - atelier_campaign_backers - 20
             * @hooked - atelier_campaign_comments - 30
             **/
            do_action( 'atelier_campaign_after_article' );
        ?>

    </section>

<?php endwhile; ?>
