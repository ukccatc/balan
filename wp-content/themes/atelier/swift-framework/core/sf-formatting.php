<?php

    /*
    *
    *   Swift Framework Formatting Functions
    *   ------------------------------------------------
    *   Swift Framework v3.0
    *   Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *   atelier_content_filter()
    *   atelier_get_the_content_with_formatting()
    *   atelier_add_formatting()
    *   atelier_new_excerpt_length()
    *   atelier_excerpt()
    *   atelier_content()
    *   atelier_custom_excerpt()
    *   atelier_tag_cloud_args()
    *   atelier_category_widget_mod()
    *   atelier_archives_widget_mod()
    *   atelier_format_chat_content()
    *   atelier_format_chat_row_id()
    *
    */


    /* ADD SHORTCODE FUNCTIONALITY TO WIDGETS
    ================================================== */
    add_filter( 'widget_text', 'do_shortcode' );


    /* CONTENT RETURN FUNCTIONS
    ================================================== */
    if ( ! function_exists( 'atelier_get_the_content_with_formatting' ) ) {
        function atelier_get_the_content_with_formatting() {
            $content = get_the_content();
            $content = apply_filters( 'the_content', $content );
            $content = str_replace( ']]>', ']]&gt;', $content );

            return $content;
        }
    }

    if ( ! function_exists( 'atelier_add_formatting' ) ) {
        function atelier_add_formatting( $content ) {
            $content = apply_filters( 'the_content', $content );
            $content = str_replace( ']]>', ']]&gt;', $content );

            return $content;
        }
    }


    /* EXCERPT
    ================================================== */
    if ( ! function_exists( 'atelier_new_excerpt_length' ) ) {
        function atelier_new_excerpt_length( $length ) {
            return 60;
        }

        add_filter( 'excerpt_length', 'atelier_new_excerpt_length' );
    }
    

    if ( ! function_exists( 'atelier_excerpt' ) ) {
        function atelier_excerpt( $limit ) {
            global $post;
            $excerpt = "";
            $custom_excerpt = atelier_get_post_meta($post->ID, 'sf_custom_excerpt', true );
            
            if ( $custom_excerpt != "" ) {
                $excerpt = wp_trim_words( $custom_excerpt, $limit );
            } else {
                $excerpt = wp_trim_words( get_the_excerpt(), $limit );
            }
            $excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

            return '<p>' . $excerpt . '</p>';
        }
    }

    if ( ! function_exists( 'atelier_content' ) ) {
        function atelier_content( $limit ) {
            $content = wp_trim_words( get_the_content(), $limit );
            $content = preg_replace( '/\[.+\]/', '', $content );
            $content = apply_filters( 'the_content', $content );
            $content = str_replace( ']]>', ']]&gt;', $content );

            return $content;
        }
    }

    if ( ! function_exists( 'atelier_custom_excerpt' ) ) {
        function atelier_custom_excerpt( $custom_content, $limit ) {
            $locale = get_locale();
            $content = '';
            if ( $locale == 'zh_CN' || $locale == 'zh_SG' || $locale == 'zh_HK' || $locale == 'zh_TW' ) {
                $content = wp_trim_words( $custom_content, $limit );
            } else {
                $content = $custom_content; // This is needed to keep formatting
            }        
            $content = preg_replace( '/\[.+\]/', '', $content );
            $content = apply_filters( 'the_content', $content );
            $content = str_replace( ']]>', ']]&gt;', $content );
        
            return $content;
        }
    }


    /* WORDPRESS TAG CLOUD WIDGET MODS
    ================================================== */
    if ( ! function_exists( 'atelier_tag_cloud_args' ) ) {    
        function atelier_tag_cloud_args( $args ) {
            $args['largest']  = 12;
            $args['smallest'] = 12;
            $args['unit']     = 'px';
            $args['format']   = 'list';

            return $args;
        }

        add_filter( 'widget_tag_cloud_args', 'atelier_tag_cloud_args' );
    }

    /* WORDPRESS CATEGORY WIDGET MODS
    ================================================== */
    if ( ! function_exists( 'atelier_category_widget_mod' ) ) { 
        function atelier_category_widget_mod( $output ) {
            $output = str_replace( '</a> (', ' <span>(', $output );
            $output = str_replace( ')', ')</span></a> ', $output );

            return $output;
        }

        add_filter( 'wp_list_categories', 'atelier_category_widget_mod' );
    }

    /* WORDPRESS ARCHIVES WIDGET MODS
    ================================================== */
    if ( ! function_exists( 'atelier_archives_widget_mod' ) ) { 
        function atelier_archives_widget_mod( $output ) {
            $output = str_replace( '</a> (', ' <span>(', $output );
            $output = str_replace( ')', ')</span></a> ', $output );

            return $output;
        }

        add_filter( 'wp_get_archives', 'atelier_archives_widget_mod' );
    }
    
    /* ADD CPT TAG RESULTS TO ARCHIVES
    ================================================== */
    if ( ! function_exists( 'atelier_add_cpt_tags_to_archive' ) ) {
        function atelier_add_cpt_tags_to_archive($query) {
            if ( $query->is_category() && $query->is_main_query()  )  {
                $query->set( 'post_type',
                    array('nav_menu_item', 'post', 'portfolio', 'team', 'clients', 'testimonials', 'faqs', 'directory', 'galleries')
                );
            }
            return $query;
        }
        add_filter('pre_get_posts', 'atelier_add_cpt_tags_to_archive');
    }
    
    if ( ! function_exists( 'atelier_pt_search_filter' ) ) {
        function atelier_pt_search_filter($query) {  
            $post_type = "";
            if ( isset($_GET['post_type']) ) {
                $post_type = $_GET['post_type'];
            }
            if ( $query->is_search && $post_type != "" ) {  
                $query->set('post_type', $post_type);  
            }  
            return $query;  
        }  
        add_filter('pre_get_posts', 'atelier_pt_search_filter'); 
    }


    /* CHAT POST FORMAT FORMATTING
    ================================================== */
    add_filter( 'the_content', 'atelier_format_chat_content' );
    add_filter( 'the_excerpt', 'atelier_format_chat_content' );

    /* Auto-add paragraphs to the chat text. */
    add_filter( 'atelier_post_format_chat_text', 'wpautop' );

    /**
     * This function filters the post content when viewing a post with the "chat" post format.  It formats the
     * content with structured HTML markup to make it easy for theme developers to style chat posts.  The
     * advantage of this solution is that it allows for more than two speakers (like most solutions).  You can
     * have 100s of speakers in your chat post, each with their own, unique classes for styling.
     *
     * @author    David Chandra
     * @link      http://www.turtlepod.org
     * @author    Justin Tadlock
     * @link      http://justintadlock.com
     * @copyright Copyright (c) 2012
     * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
     * @link      http://justintadlock.com/archives/2012/08/21/post-formats-chat
     * @global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
     *
     * @param string $content               The content of the post.
     *
     * @return string $chat_output The formatted content of the post.
     */
    if ( ! function_exists( 'atelier_format_chat_content' ) ) {
        function atelier_format_chat_content( $content ) {
            global $atelier_post_format_chat_ids;

            /* If this is not a 'chat' post, return the content. */
            if ( ! has_post_format( 'chat' ) ) {
                return $content;
            }

            /* Set the global variable of speaker IDs to a new, empty array for this chat. */
            $atelier_post_format_chat_ids = array();

            /* Allow the separator (separator for speaker/text) to be filtered. */
            $separator = apply_filters( 'my_post_format_chat_separator', ':' );

            /* Open the chat transcript div and give it a unique ID based on the post ID. */
            $chat_output = "\n\t\t\t" . '<div id="chat-transcript-' . esc_attr( get_the_ID() ) . '" class="chat-transcript">';

            /* Split the content to get individual chat rows. */
            $chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );

            /* Loop through each row and format the output. */
            foreach ( $chat_rows as $chat_row ) {

                /* If a speaker is found, create a new chat row with speaker and text. */
                if ( strpos( $chat_row, $separator ) ) {

                    /* Split the chat row into author/text. */
                    $chat_row_split = explode( $separator, trim( $chat_row ), 2 );

                    /* Get the chat author and strip tags. */
                    $chat_author = strip_tags( trim( $chat_row_split[0] ) );

                    /* Get the chat text. */
                    $chat_text = trim( $chat_row_split[1] );

                    /* Get the chat row ID (based on chat author) to give a specific class to each row for styling. */
                    $speaker_id = atelier_format_chat_row_id( $chat_author );

                    /* Open the chat row. */
                    $chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

                    /* Add the chat row author. */
                    $chat_output .= "\n\t\t\t\t\t" . '<div class="chat-author ' . sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) . ' vcard"><cite class="fn">' . apply_filters( 'my_post_format_chat_author', $chat_author, $speaker_id ) . '</cite>' . $separator . '</div>';

                    /* Add the chat row text. */
                    $chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array(
                                "\r",
                                "\n",
                                "\t"
                            ), '', apply_filters( 'atelier_post_format_chat_text', $chat_text, $chat_author, $speaker_id ) ) . '</div>';

                    /* Close the chat row. */
                    $chat_output .= "\n\t\t\t\t" . '</div><!-- .chat-row -->';
                } /**
                 * If no author is found, assume this is a separate paragraph of text that belongs to the
                 * previous speaker and label it as such, but let's still create a new row.
                 */
                else {

                    /* Make sure we have text. */
                    if ( ! empty( $chat_row ) ) {

                        /* Open the chat row. */
                        $chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

                        /* Don't add a chat row author.  The label for the previous row should suffice. */

                        /* Add the chat row text. */
                        $chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array(
                                    "\r",
                                    "\n",
                                    "\t"
                                ), '', apply_filters( 'atelier_post_format_chat_text', $chat_row, $chat_author, $speaker_id ) ) . '</div>';

                        /* Close the chat row. */
                        $chat_output .= "\n\t\t\t</div><!-- .chat-row -->";
                    }
                }
            }

            /* Close the chat transcript div. */
            $chat_output .= "\n\t\t\t</div><!-- .chat-transcript -->\n";

            /* Return the chat content and apply filters for developers. */

            return apply_filters( 'my_post_format_chat_content', $chat_output );
        }
    }

    /**
     * This function returns an ID based on the provided chat author name.  It keeps these IDs in a global
     * array and makes sure we have a unique set of IDs.  The purpose of this function is to provide an "ID"
     * that will be used in an HTML class for individual chat rows so they can be styled.  So, speaker "John"
     * will always have the same class each time he speaks.  And, speaker "Mary" will have a different class
     * from "John" but will have the same class each time she speaks.
     *
     * @author    David Chandra
     * @link      http://www.turtlepod.org
     * @author    Justin Tadlock
     * @link      http://justintadlock.com
     * @copyright Copyright (c) 2012
     * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
     * @link      http://justintadlock.com/archives/2012/08/21/post-formats-chat
     * @global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
     *
     * @param string $chat_author           Author of the current chat row.
     *
     * @return int The ID for the chat row based on the author.
     */
    if ( ! function_exists( 'atelier_format_chat_row_id' ) ) {
        function atelier_format_chat_row_id( $chat_author ) {
            global $atelier_post_format_chat_ids;

            /* Let's sanitize the chat author to avoid craziness and differences like "John" and "john". */
            $chat_author = strtolower( strip_tags( $chat_author ) );

            /* Add the chat author to the array. */
            $atelier_post_format_chat_ids[] = $chat_author;

            /* Make sure the array only holds unique values. */
            $atelier_post_format_chat_ids = array_unique( $atelier_post_format_chat_ids );

            /* Return the array key for the chat author and add "1" to avoid an ID of "0". */

            return absint( array_search( $chat_author, $atelier_post_format_chat_ids ) ) + 1;
        }
    }

?>
