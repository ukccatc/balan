<?php

    /*
    *
    *	Swift Page Builder - Campaign Detail Function Class
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	atelier_campaign_detail_media()
    *	atelier_campaign_comments()
    *
    */

    /* CAMPAIGN DETAIL MEDIA
    ================================================== */
    if ( ! function_exists( 'atelier_campaign_detail_media' ) ) {
        function atelier_campaign_detail_media() {
            global $post, $wp_embed;
            $end_date      = "";
            $campaign      = new ATCF_Campaign( $post->ID );
            $type          = $campaign->type();
            $post_date     = get_the_date();
            $post_date_str = get_the_date('Y-m-d');
            if ( ! $campaign->is_endless() ) {
                $end_date = date_i18n( get_option( 'date_format' ), strtotime( $campaign->end_date() ) );
            }
            $image      = wp_get_attachment_url( get_post_thumbnail_id() );
            $share_text = apply_filters( 'atelier_post_share_text', __( "Share this", 'atelier' ) );
            ?>
            <div class="campaign-detail row">
                <div class="col-sm-8">
                    <?php if ( $campaign->video() ) { ?>
                        <figure class="video-container">
                            <?php echo esc_html($wp_embed->run_shortcode( '[embed]' . $campaign->video() . '[/embed]' )); ?>
                        </figure>
                    <?php } else { ?>
                        <?php atelier_get_template( 'detail-media' ); ?>
                    <?php } ?>
                </div>
                <div class="col-sm-4">
                    <div class="campaign-details">
                        <div class="detail">
                            <data><?php echo esc_attr($campaign->backers_count()); ?></data>
                            <span><?php echo _n( 'Backer', 'Backers', $campaign->backers_count(), 'atelier' ); ?></span>
                        </div>
                        <div class="detail pledged">
                            <data><?php echo esc_attr($campaign->current_amount()); ?></data>
                            <span><?php printf( __( 'Pledged of %s Goal', 'atelier' ), $campaign->goal() ); ?></span>
                        </div>
                        <?php if ( ! $campaign->is_endless() ) { ?>
                            <div class="detail">
                                <data><?php echo esc_attr($campaign->days_remaining()); ?></data>
                                <span><?php echo _n( 'Day to Go', 'Days to Go', $campaign->days_remaining(), 'atelier' ); ?></span>
                            </div>
                        <?php } ?>
                    </div>
                    <a href="#back-this-project"
                       class="back-this sf-button accent smooth-scroll-link"><?php _e( 'Back this project', 'atelier' ); ?></a>
                    <h5 class="fund">
                        <?php if ( $type == 'fixed' ) {
                            printf( __( 'This %3$s will only be funded if at least %1$s is pledged by %2$s.', 'atelier' ), $campaign->goal(), $end_date, strtolower( edd_get_label_singular() ) );
                        } else if ( $type == 'flexible' ) {
                            printf( __( 'All funds will be collected on %1$s.', 'atelier' ), $end_date );
                        } else if ( ! $campaign->is_endless() ) {
                            printf( __( 'All pledges will be collected automatically until %1$s.', 'atelier' ), $end_date );
                        } ?>
                    </h5>

                    <div class="campaign-meta">
                        <time class="date" datetime="<?php echo esc_attr($post_date_str); ?>">
                            <span><?php _e( 'Launched', 'atelier' ); ?></span><?php echo esc_attr($post_date); ?></time>
                        <?php if ( ! $campaign->is_endless() ) { ?>
                            <div class="funding-ends">
                                <span><?php _e( 'Funding Ends', 'atelier' ); ?></span><?php echo esc_attr($end_date); ?>
                            </div>
                        <?php } ?>
                        <?php if ( $campaign->location() ) : ?>
                            <div class="location">
                                <span><?php _e( 'Location', 'atelier' ); ?></span><?php echo esc_attr($campaign->location()); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php
        }
    }
    add_action( 'atelier_before_campaign_content', 'atelier_campaign_detail_media', 10 );


    /* CAMPAIGN SIDEBAR
    ================================================== */
    if ( ! function_exists( 'atelier_campaign_sidebar' ) ) {
        function atelier_campaign_sidebar() {
            global $post;
            $campaign    = new ATCF_Campaign( $post->ID );
            $download_id = $post->ID;
            $prices      = edd_get_variable_prices( $download_id );
            $type        = edd_single_price_option_mode( $download_id ) ? 'checkbox' : 'radio';
            $extra_class = "";
            if ( $campaign->is_donations_only() ) {
                $extra_class = 'project-donate-only';
            }

            ?>
            <div id="back-this-project" class="campaign-sidebar <?php echo esc_attr($extra_class); ?> col-sm-4">
                <?php
                    if ( $campaign->is_active() ) {
                        if ( $campaign->is_donations_only() ) {
                            echo '<p class="donate-only">' . __( 'This project is donation only, and you can donate using the button below.', 'atelier' ) . '</p>';
                            echo edd_get_purchase_link( array(
                                'download_id' => $post->ID,
                                'class'       => 'accent sf-button contribute-now',
                                'price'       => false,
                                'text'        => __( 'Donate Now', 'atelier' )
                            ) );
                        } else {
                            echo edd_get_purchase_link( array(
                                'download_id' => $post->ID,
                                'class'       => 'accent sf-button contribute-now',
                                'price'       => false,
                                'text'        => __( 'Contribute Now', 'atelier' )
                            ) );
                        }
                    } else { // Inactive, just show options with no button
                        if ( $campaign->is_donations_only() ) {
                            echo '<p class="project-ended">' . __( 'This project has ended.', 'atelier' ) . '</p>';
                        } else {
                            atcf_campaign_contribute_options( $prices, $type, $download_id );
                        }
                    }
                ?>
            </div>
        <?php
        }
    }
    add_action( 'atelier_after_campaign_content', 'atelier_campaign_sidebar', 10 );


    /* CAMPAIGN UPDATES
    ================================================== */
    if ( ! function_exists( 'atelier_campaign_updates' ) ) {
        function atelier_campaign_updates() {
            global $post;
            $campaign = new ATCF_Campaign( $post->ID );

            if ( '' != $campaign->updates() ) {
                ?>
                <div id="campaign-updates">
                    <h2 class="heading"><?php _e( 'Updates', 'atelier' ); ?></h2>

                    <?php echo esc_attr($campaign->updates()); ?>
                </div>
            <?php
            }
        }
    }
    add_action( 'atelier_campaign_content_end', 'atelier_campaign_updates', 10 );


    /* CAMPAIGN SHARE
    ================================================== */
    if ( ! function_exists( 'atelier_campaign_share' ) ) {
        function atelier_campaign_share() {
            $image      = wp_get_attachment_url( get_post_thumbnail_id() );
            $share_text = apply_filters( 'atelier_campaign_share_text', __( "Share this", 'atelier' ) );
            ?>
            <div class="campaign-share">
                <div class="article-divider"></div>
                <div class="article-share" data-buttontext="<?php echo esc_attr($share_text); ?>"
                     data-image="<?php echo esc_url($image); ?>"><share-button class="share-button"></share-button></div>
            </div>
        <?php
        }
    }
    add_action( 'atelier_campaign_content_end', 'atelier_campaign_share', 20 );


    /* CAMPAIGN INFO
    ================================================== */
    if ( ! function_exists( 'atelier_campaign_info' ) ) {
        function atelier_campaign_info() {
            global $post;
            $campaign   = new ATCF_Campaign( $post->ID );
            $categories = get_the_term_list( $post->ID, 'download_category', '', ', ', '' );
            $author     = get_user_by( 'id', $post->post_author );
            ?>

            <div class="author-info-wrap clearfix">
                <div class="author-avatar"><?php if ( function_exists( 'get_avatar' ) ) {
                        echo get_avatar( get_the_author_meta( 'ID' ), '140' );
                    } ?></div>
                <div class="author-bio">
                    <div class="author-name" itemprop="author" itemscope itemtype="http://schema.org/Person"><h3><a
                                itemprop="name"
                                href="<?php echo get_author_posts_url( $author->ID, $author->user_nicename ); ?>"><?php the_author_meta( 'display_name' ); ?></a>
                        </h3></div>
                    <div class="author-bio-text">
                        <?php the_author_meta( 'description' ); ?>
                    </div>
                    <?php if ( $campaign->contact_email() != "" ) { ?>
                        <a href="mailto:<?php echo sanitize_email($campaign->contact_email()); ?>"
                           class="sf-button contact-author accent"><?php _e( 'Contact Author', 'atelier' ); ?></a>
                    <?php } ?>
                </div>
            </div>

            <div class="campaign-info post-info clearfix">
                <?php if ( $categories ) { ?>
                    <div class="categories-wrap"><?php _e( "Categories:", 'atelier' ); ?><span
                            class="categories"><?php echo esc_html($categories); ?></span></div>
                <?php } ?>
                <?php if ( has_tag() ) { ?>
                    <div class="tags-wrap"><?php _e( "Tags:", 'atelier' ); ?><span
                            class="tags"><?php the_tags( '' ); ?></span></div>
                <?php } ?>
                <div class="comments-likes">
                    <?php if ( comments_open() ) { ?>
                        <div class="comments-wrapper"><a href="#comments" class="smooth-scroll-link">
                        	<?php echo apply_filters( 'atelier_comments_icon', '<i class="ss-chat"></i>' ); ?><span><?php comments_number( __( '0 Comments', 'atelier' ), __( '1 Comment', 'atelier' ), __( '% Comments', 'atelier' ) ); ?></span></a>
                        </div>
                    <?php } ?>
                    <?php if ( function_exists( 'lip_love_it_link' ) ) {
                        lip_love_it_link( get_the_ID(), true, 'text' );
                    } ?>
                </div>
            </div>

        <?php
        }
    }
    add_action( 'atelier_campaign_content_end', 'atelier_campaign_info', 30 );


    /* CAMPAIGN PAGINATION
    ================================================== */
    function atelier_campaign_pagination() {
        $prev_post = get_previous_post();
        $next_post = get_next_post();
        $has_both  = false;

        if ( ! empty( $next_post ) && ! empty( $prev_post ) ) {
            $has_both = true;
        }
        ?>

        <?php if ( ! empty( $next_post ) || ! empty( $prev_post ) ) { ?>
            <?php if ( $has_both ) { ?>
                <div class="post-pagination-wrap prev-next">
            <?php } else { ?>
                <div class="post-pagination-wrap">
            <?php } ?>

            <div class="container">

                <?php if ( ! empty( $next_post ) ) {
                    $post_author     = get_the_author_link( $next_post->ID );
                    $post_date       = get_the_date();
                    $post_date_str   = get_the_date('Y-m-d');
                    $post_categories = get_the_category_list( ', ', '', $next_post->ID );
                    ?>
                    <div class="next-article">
                        <h6><?php _e( "Next Project", 'atelier' ); ?></h6>

                        <h2>
                            <a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo esc_attr($next_post->post_title); ?></a>
                        </h2>

                        <div
                            class="blog-item-details"><?php echo sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s on <time datetime="%4$s">%5$s</time>', 'atelier' ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_categories, $post_date_str, $post_date ); ?></div>
                    </div>
                <?php } ?>

                <?php if ( ! empty( $prev_post ) ) {
                    $post_author     = get_the_author_link( $prev_post->ID );
                    $post_date       = get_the_date();
                    $post_date_str   = get_the_date('Y-m-d');
                    $post_categories = get_the_category_list( ', ', '', $prev_post->ID );
                    ?>
                    <div class="prev-article">
                        <h6><?php _e( "Previous Project", 'atelier' ); ?></h6>

                        <h2>
                            <a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo esc_attr($prev_post->post_title); ?></a>
                        </h2>

                        <div
                            class="blog-item-details"><?php echo sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s on <time datetime="%4$s">%5$s</time>', 'atelier' ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_categories, $post_date_str, $post_date ); ?></div>
                    </div>
                <?php } ?>

            </div>

            </div>
        <?php } ?>
    <?php
    }

    add_action( 'atelier_campaign_after_article', 'atelier_campaign_pagination', 10 );


    /* CAMPAIGN BACKERS
    ================================================== */
    if ( ! function_exists( 'atelier_campaign_backers' ) ) {
        function atelier_campaign_backers() {
            global $post;
            $campaign      = new ATCF_Campaign( $post->ID );
            $backers       = $campaign->unique_backers();
            $backers_class = apply_filters( 'atelier_campaign_backers_wrap_class', 'col-sm-8 col-sm-offset-2' );

            ?>
            <div class="backers-wrap container">
                <div id="campaign-backers" class="<?php echo esc_attr($backers_class); ?>">

                    <h2 class="heading"><?php _e( "Backers", 'atelier' ); ?></h2>

                    <?php if ( empty( $backers ) ) { ?>

                        <p><?php _e( 'No backers yet, be the first!', 'atelier' ); ?></p>

                    <?php } else { ?>

                        <ol class="backer-list">
                            <?php foreach ( $backers as $backer ) : ?>
                                <?php
                                $meta      = edd_get_payment_meta( $backer );
                                $user_info = edd_get_payment_meta_user_info( $backer );

                                if ( empty( $user_info ) ) {
                                    continue;
                                }

                                $anon = isset ( $meta['anonymous'] ) ? $meta['anonymous'] : 0;
                                ?>

                                <li class="backer">
                                    <?php echo get_avatar( $anon ? '' : $user_info['email'], 60 ); ?>

                                    <div class="backer-info">
                                        <?php if ( $anon ) { ?>
                                            <strong> <?php _e( 'Anonymous', 'atelier' ); ?></strong><br/>
                                        <?php } else { ?>
                                            <strong><?php echo esc_attr($user_info['first_name']); ?> <?php echo esc_attr($user_info['last_name']); ?></strong>
                                            <br/>
                                        <?php } ?>
                                        <?php echo edd_payment_amount( $backer ); ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ol>

                    <?php } ?>

                </div>
            </div>
        <?php
        }
    }
    add_action( 'atelier_campaign_after_article', 'atelier_campaign_backers', 20 );


    /* CAMPAIGN COMMENTS
    ================================================== */
    if ( ! function_exists( 'atelier_campaign_comments' ) ) {
        function atelier_campaign_comments() {

            $comments_class = apply_filters( 'atelier_campaign_comments_wrap_class', 'col-sm-8 col-sm-offset-2' );

            if ( comments_open() ) {
                ?>
                <div class="comments-wrap container">
                    <div id="comment-area" class="<?php echo esc_attr($comments_class); ?>">
                        <?php comments_template( '', true ); ?>
                    </div>
                </div>
            <?php
            }
        }
    }
    add_action( 'atelier_campaign_after_article', 'atelier_campaign_comments', 30 );