<?php
	/*
	*
	*	Swift Framework Overrides
	*	------------------------------------------------
	*	Atelier specific functionality
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*/

	/* POST DETAIL FILTERS
	================================================== */
	function atelier_atelier_related_articles_display_type() {
		return 'standard';
	}
	add_filter('atelier_related_articles_display_type', 'atelier_atelier_related_articles_display_type');

	function atelier_atelier_related_articles_excerpt_length() {
		return 0;
	}
	add_filter('atelier_related_articles_excerpt_length', 'atelier_atelier_related_articles_excerpt_length');

	function atelier_atelier_post_comments_wrap_class() {
		return 'comments-wrap clearfix';
	}
	add_filter( 'atelier_post_comments_wrap_class', 'atelier_atelier_post_comments_wrap_class' );

	function atelier_atelier_post_comments_class() {
		return '';
	}
	add_filter( 'atelier_post_comments_class', 'atelier_atelier_post_comments_class' );

	function atelier_atelier_related_posts_count() {
		return 4;
	}
	add_filter('atelier_related_posts_count', 'atelier_atelier_related_posts_count');

					
	/* POST ACTION ORDER
	================================================== */
	remove_action( 'atelier_post_content_end', 'atelier_post_share', 30 );

	remove_action( 'atelier_post_after_article', 'atelier_post_related_articles', 10 );
	add_action( 'atelier_post_after_article', 'atelier_post_related_articles', 30 );

	remove_action( 'atelier_post_after_article', 'atelier_post_comments', 20 );
	add_action( 'atelier_post_content_end', 'atelier_post_comments', 50 );
	
?>
