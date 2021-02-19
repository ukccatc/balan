<?php
global $atelier_options;
$page_classes = atelier_page_classes();
$header_layout = $page_classes['header-layout'];
$header_search_type = $atelier_options['header_search_type'];
$header_search_pt = $atelier_options['header_search_pt'];
$search_term = trim($_POST['s']);
if ( $header_search_pt == "" ) {
	$header_search_pt = "any";
}
$search_query_args = array(
	's' => $search_term,
	'post_type' => $header_search_pt,
	'post_status' => 'publish',
	'suppress_filters' => false,
	'numberposts' => -1
);
$search_query_args = http_build_query($search_query_args);
$search_results = get_posts( $search_query_args );
if ( function_exists('relevanssi_do_query') ) {
	$search_results = new WP_Query(array(
		'post_type' => $header_search_pt,
		'post_status' => 'publish',
	));
	$search_results->query_vars['s'] = $search_term;
	$search_results->query_vars['posts_per_page'] = 50;
	relevanssi_do_query($search_results);
}

$shown_results = 5;

if ($header_layout == "header-vert" || $header_layout == "header-vert-right") {
	$shown_results = 2;
}

if ($header_search_type == "fs-search-on") {
	$shown_results = 20;
}

$price_args = array(
	'span' => array(),
	'del' => array(),
	'ins' => array(),
	'p' => array()
);

if ( function_exists('relevanssi_do_query') ) {

	if ( $search_results->have_posts() ) {
		$i = 0;

		echo '<div class="search-result-pt">';
        while ( $search_results->have_posts() ) {
            $search_results->the_post();		 
            $postID = get_the_ID();

            $post_type = get_post_type();
            $post_title = get_the_title($postID);
        	$post_date = get_the_time(get_option('date_format'), $postID);
        	$post_permalink = get_permalink($postID);

        	$image = get_the_post_thumbnail( $postID, 'thumb-square' );

        	if ($image) {
        		echo '<div class="search-result has-img">';
        		echo '<div class="search-item-img"><a href="'.$post_permalink.'">'.$image.'</div>';
        	} else {
        		echo '<div class="search-result">';
        	}
			
			echo '<a href="'.$post_permalink.'" class="search-result-link"></a>';
			
            echo '<div class="search-item-content">';

            if ($header_search_type == "fs-search-on") {
            	echo '<h4><a href="'.$post_permalink.'">'.$post_title.'</a></h4>';
            } else {
            	echo '<h5><a href="'.$post_permalink.'">'.$post_title.'</a></h5>';
            }

            if ($post_type == "product") {
            	global $product;
	            echo wp_kses($product->get_price_html(), $price_args);
            } else {
            	echo '<time>'.$post_date.'</time>';
            }

            echo '</div>';

            echo '</div>';

        	$i++;
        	if ($i == $shown_results) break;
        }

        echo '</div>';

        $count = $search_results->post_count;

        if ($count > 1) {
	    	$search_link = get_search_link( $search_term );
	    	
	    	if (strpos($search_link,'?') !== false) {
	    		$search_link .= '&post_type='. $header_search_pt;
	    	} else {
	    		$search_link .= '?post_type='. $header_search_pt;
	    	}
	    	if ($header_search_type == "fs-search-on") {
		    	echo '<a href="'.$search_link.'" class="all-results">'.sprintf(__("View all %d results", 'atelier'), $count).'</a>';
	    	} else {
	    		echo '<a href="'.$search_link.'" class="all-results sf-button black bordered">'.sprintf(__("View all %d results", 'atelier'), $count).'</a>';
	    	}
	    }

    } else {

    	echo '<div class="no-search-results" data-test="123">';
		echo '<h5>'.__("No results", 'atelier').'</h5>';
		echo '<p>'.__("No search results could be found, please try another query.", 'atelier').'</p>';
		echo '</div>';

    }

} else {

	$count = count($search_results);

	if (!empty($search_results)) {

		$sorted_posts = $post_type = array();

		foreach ($search_results as $search_result) {
			$sorted_posts[$search_result->post_type][] = $search_result;
		    // Check we don't already have this post type in the post_type array
		    if (empty($post_type[$search_result->post_type])) {
		    	// Add the post type object to the post_type array
		        $post_type[$search_result->post_type] = get_post_type_object($search_result->post_type);
		    }
		}

		$i = 0;
		foreach ($sorted_posts as $key => $type) {
			echo '<div class="search-result-pt">';

			if ($header_search_type == "fs-search-on") {
		        if(isset($post_type[$key]->labels->name)) {
		            echo "<h3>".$post_type[$key]->labels->name."</h3>";
		        } else if(isset($key)) {
		            echo "<h3>".$key."</h3>";
		        } else {
		            echo "<h3>".__("Other", 'atelier')."</h3>";
		        }
		    }

	        foreach ($type as $post) {
	        
	        	$post_type = get_post_type($post);
	        	$product = array();
	        
	        	if ( $post_type == "product" ) {
	        	    $product = new WC_Product( $post->ID );
	        	    if (!$product->is_visible()) {
	        	    	return;
	        	    }
	        	}

	        	$post_title = get_the_title($post->ID);
	        	$post_date = get_the_time(get_option('date_format'), $post->ID);
	        	$post_permalink = get_permalink($post->ID);

	        	$image = get_the_post_thumbnail( $post->ID, 'thumb-square' );

	        	if ($image) {
	        		echo '<div class="search-result has-img">';
	        		echo '<div class="search-item-img"><a href="'.$post_permalink.'">'.$image.'</div>';
	        	} else {
	        		echo '<div class="search-result">';
	        	}
				
				echo '<a href="'.$post_permalink.'" class="search-result-link"></a>';
				
	            echo '<div class="search-item-content">';

	            if ($header_search_type == "fs-search-on") {
	            	echo '<h4><a href="'.$post_permalink.'">'.$post_title.'</a></h4>';
	            } else {
	            	echo '<h5><a href="'.$post_permalink.'">'.$post_title.'</a></h5>';
	            }

	            if ($post_type == "product") {
		            echo wp_kses($product->get_price_html(), $price_args);
	            } else {
	            	echo '<time>'.$post_date.'</time>';
	            }

	            echo '</div>';

	            echo '</div>';

	        	$i++;
	        	if ($i == $shown_results) break;
	        }

	       echo '</div>';
	        if ($i == $shown_results) break;
	    }

	    if ($count > 1) {
	    	$search_link = get_search_link( $search_term );
	    	
	    	if (strpos($search_link,'?') !== false) {
	    		$search_link .= '&post_type='. $header_search_pt;
	    	} else {
	    		$search_link .= '?post_type='. $header_search_pt;
	    		if (apply_filters( 'wpml_setting', false, 'language_negotiation_type' ) == 3) {
	    			$current_language=apply_filters( 'wpml_current_language', NULL );
	    			$search_link .='&lang='.$current_language;
	    		}
	    	}
	    	if ($header_search_type == "fs-search-on") {
		    	echo '<a href="'.$search_link.'" class="all-results">'.sprintf(__("View all %d results", 'atelier'), $count).'</a>';
	    	} else {
	    		echo '<a href="'.$search_link.'" class="all-results sf-button black bordered">'.sprintf(__("View all %d results", 'atelier'), $count).'</a>';
	    	}
	    }

	} else {

		echo '<div class="no-search-results" data-test="123">';
		echo '<h5>'.__("No results", 'atelier').'</h5>';
		echo '<p>'.__("No search results could be found, please try another query.", 'atelier').'</p>';
		echo '</div>';

	}

}
