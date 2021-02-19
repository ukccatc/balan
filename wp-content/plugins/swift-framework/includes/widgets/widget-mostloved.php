<?php

    /*
    *
    *   Most Loved Widget
    *   ------------------------------------------------
    *   Swift Framework
    *   Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    */

    if (!function_exists('sf_most_loved_widget')) {
        function sf_most_loved_widget() {
            register_widget( 'SF_InFocus_Widget' );
        }
        add_action( 'widgets_init', 'sf_most_loved_widget' );
    }

    if (!class_exists('SF_Most_Loved_Widget')) {
        class SF_Most_Loved_Widget extends WP_Widget {

            /** constructor */
            function __construct() {
                parent::__construct( false, $name = __( 'Most Loved Items', 'swift-framework-plugin' ), array( 'description' => __( 'Show the most loved items', 'swift-framework-plugin' ) ) );
            }

            /** @see WP_Widget::widget */
            function widget( $args, $instance ) {
                extract( $args );
                $title  = apply_filters( 'widget_title', $instance['title'] );
                $number = strip_tags( $instance['number'] );

                echo $before_widget;
                if ( $title ) {
                    echo $before_title . $title . $after_title;
                } ?>
                <ul class="most-loved">
                    <?php
                        $args       = array(
                            'post_type'   => 'any',
                            'numberposts' => $number,
                            'meta_key'    => '_li_love_count',
                            'orderby'     => 'meta_value_num',
                            'order'       => 'DESC'
                        );
                        $most_loved = get_posts( $args );
                        foreach ( $most_loved as $loved ) : ?>
                            <?php global $post;

                            	$post_id = $loved->ID;

                            	if ( function_exists( 'icl_object_id' ) ) {
                            		$post_id = icl_object_id( $post_id, 'post', true );
                            	}

                            	$author_id = get_post_field( 'post_author', $post_id );
                            	$author_name = get_the_author_meta( 'user_nicename', $author_id );

                            ?>

                            <li class="loved-item">
                                <a href="<?php echo get_permalink( $post_id ); ?>"></a>
                                <h5><?php echo get_the_title( $post_id ); ?></h5>
                                <span><?php echo sprintf( __( 'By %1$s', 'swift-framework-plugin' ), $author_name ); ?></span>

                                <div class="loved-count"><?php echo apply_filters( 'sf_loved_icon', '<i class="ss-heart"></i>' ); ?><span><?php echo sf_get_post_meta( $post_id, '_li_love_count', true ); ?></span>
                                </div>
                            </li>
                        <?php endforeach; ?>
                </ul>
                <?php
                echo $after_widget;
            }

            /** @see WP_Widget::update */
            function update( $new_instance, $old_instance ) {
                $instance           = $old_instance;
                $instance['title']  = strip_tags( $new_instance['title'] );
                $instance['number'] = strip_tags( $new_instance['number'] );

                return $instance;
            }

            /** @see WP_Widget::form */
            function form( $instance ) {
                if ( isset( $instance['title'] ) ) {
                    $title = esc_attr( $instance['title'] );
                } else {
                    $title = __( "Most Loved", 'swift-framework-plugin' );
                }
                if ( isset( $instance['number'] ) ) {
                    $number = esc_attr( $instance['number'] );
                } else {
                    $number = 5;
                }
                ?>
                <p>
                    <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'swift-framework-plugin' ); ?></label>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
                           name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text"
                           value="<?php echo esc_attr($title); ?>"/>
                </p>
                <p>
                    <label
                        for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php _e( 'Number to Show:', 'swift-framework-plugin' ); ?></label>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"
                           name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text"
                           value="<?php echo esc_attr($number); ?>"/>
                </p>
            <?php
            }
        }
    }