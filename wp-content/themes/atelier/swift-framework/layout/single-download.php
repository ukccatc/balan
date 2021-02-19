<?php
    atelier_set_sidebar_global( 'no-sidebars' );
?>

<?php if ( have_posts() ) : the_post(); ?>

    <!-- OPEN article -->
    <article <?php post_class( 'container clearfix' ); ?> id="<?php the_ID(); ?>">
		
		<?php
		    /**
		     * @hooked - atelier_post_detail_heading - 10
		     * @hooked - atelier_post_detail_media - 20
		     **/
		    do_action( 'atelier_download_article_start' );
		?>
		
        <section class="page-content download-main clearfix">
        	
        	<?php
        	    /**
        	     * @hooked - atelier_download_detail_media - 10 (standard)
        	     **/
        	    do_action( 'atelier_download_content_start' );
        	?>
        	
			<?php the_content(); ?>
			
			<?php
			    /**
			     * @hooked - atelier_post_review - 20
			     * @hooked - atelier_post_share - 30
			     * @hooked - atelier_post_details - 40
			     **/
			    do_action( 'atelier_download_content_end' );
			?>
			
        </section>
        
		<aside class="download-sidebar">
			<?php
			    /**
			     * @hooked - atelier_download_sidebar_details - 10
			     * @hooked - atelier_download_sidebar_cart - 20
			     **/
			    do_action( 'atelier_download_sidebar' );
			?>
		</aside>
			
		<?php
		    /**
		     * @hooked - atelier_post_detail_heading - 10
		     * @hooked - atelier_post_detail_media - 20
		     **/
		    do_action( 'atelier_download_article_end' );
		?>
		
    <!-- CLOSE article -->
    </article>
	
<?php endif; ?>