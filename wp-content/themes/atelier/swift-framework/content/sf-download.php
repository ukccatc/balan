<?php

    /*
    *
    *	Swift Page Builder - Download Function Class
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	atelier_download_detail_media()
    *	atelier_download_sidebar_purchase_link()
    *	atelier_download_sidebar_details()
    *	atelier_download_sidebar_cart()
    *
    */
    
    remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );
    
    
    
	/* DOWNLOAD MEDIA
    ================================================== */
    if ( ! function_exists( 'atelier_download_detail_media' ) ) {
        function atelier_download_detail_media() {
			atelier_get_template( 'detail-media' );
        }
    	add_action( 'atelier_download_content_start', 'atelier_download_detail_media', 10 );
    }
    
    
    /* DOWNLOAD SIDEBAR PURCHASE LINK
    ================================================== */
    if ( ! function_exists( 'atelier_download_sidebar_purchase_link' ) ) {
        function atelier_download_sidebar_purchase_link() {
        ?>
        <div class="edd-download-purchase">
        	<?php echo do_shortcode('[purchase_link]'); ?>
        </div>
        <?php }
        add_action( 'atelier_single_download_before_details_excerpt', 'atelier_download_sidebar_purchase_link', 10 );
    }
    
    
    
    /* DOWNLOAD SIDEBAR DETAILS
    ================================================== */
    if ( ! function_exists( 'atelier_download_sidebar_details' ) ) {
        function atelier_download_sidebar_details() {
        	global $post;
    		?>
    		<div class="widget widget_download_details">
				<h2 class="widgettitle"><?php _e( 'Download Details', 'atelier' ); ?></h2>

				<h3 class="edd-download-price"><?php echo edd_price_range(); ?></h3>

				<ul class="edd-details-list">
					<?php if ( apply_filters( 'atelier_show_sales_in_sidebar', false, $post ) ) { ?>
						<li class="edd-details-list-item">
							<?php $sales = apply_filters( 'atelier_download_sales_count', edd_get_download_sales_stats( $post->ID ), $post ); ?>
							<span class="edd-detail-name"><?php _e( 'Sales:', 'atelier' ); ?></span>
							<span class="edd-detail-info"><?php echo esc_html($sales); ?></span>
						</li>
					<?php } ?>
				</ul>

				<?php do_action('atelier_single_download_before_details_excerpt'); ?>
				
				<?php 
				//the_excerpt(); 
				?>
				
				<?php do_action('atelier_single_download_after_details_excerpt'); ?>

				<ul class="edd-download-meta">
					<?php
	
						$categories = get_the_term_list( $post->ID, 'download_category', '', ', ', '' );
						if ( '' != $categories ) {
							?>
							<li class="edd-download-meta-cats">
								<span class="edd-detail-name"><?php _e( 'Categories:', 'atelier' ); ?></span>
								<span class="edd-detail-info"><?php echo esc_html($categories); ?></span>
							</li>
							<?php
						}
	
						$tags = get_the_term_list( $post->ID, 'download_tag', '', ', ', '' );
						if ( '' != $tags ) {
							?>
							<li class="edd-download-meta-tags">
								<span class="edd-detail-name"><?php _e( 'Tags:', 'atelier' ); ?></span>
								<span class="edd-detail-info"><?php echo esc_html($tags); ?></span>
							</li>
							<?php
						}
					?>
				</ul>

			</div>    		
    		
    		<?php
        }
    	add_action( 'atelier_download_sidebar', 'atelier_download_sidebar_details', 20 );
    }