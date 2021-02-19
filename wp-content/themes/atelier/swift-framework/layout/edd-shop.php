<?php
global $atelier_options;

$store_page_setting = (is_front_page() && is_page_template('edd-store-front.php') ? 'page' : 'paged' );
$current_page = get_query_var( $store_page_setting );
$per_page = intval( get_theme_mod( 'bwpy_store_front_count', 9 ) );
$offset = $current_page > 0 ? $per_page * ( $current_page-1 ) : 0;
$product_args = array(
	'post_type'		=> 'download',
	'posts_per_page'	=> $per_page,
	'offset'		=> $offset
);
$products = new WP_Query( $product_args );

$show_excerpt = false;
$show_buy_btn = true;
$show_price = true;
$show_cats = true;

$width = 'col-sm-3';
$columns = '4';
if ( isset($atelier_options['edd_display_columns']) ) {
	$columns = $atelier_options['edd_display_columns'];
}
if ($columns == "4") {
	$width = 'col-sm-3';
} else if ($columns == "5") {
	$width = 'col-sm-sf-5';
} else if ($columns == "3") {
	$width = 'col-sm-4';
} else if ($columns == "2") {
	$width = 'col-sm-6';
} else if ($columns == "6") {
	$width = 'col-sm-2';
} else if ($columns == "1") {
	$width = 'col-sm-12';
}

$thumb_width = 500;
$thumb_height = 350;
if ( isset($atelier_options['edd_thumb_image_width']) ) {
	$thumb_width = $atelier_options['edd_thumb_image_width'];
}
if ( isset($atelier_options['edd_thumb_image_height']) ) {
	$thumb_height = $atelier_options['edd_thumb_image_height'];
}

$display_type = "standard";
if ( isset($atelier_options['edd_display_type']) ) {
	$display_type = $atelier_options['edd_display_type'];
}
?>

<div id="edd-grid" class="clearfix">
	<?php if ( $products->have_posts() ) : $i = 1; ?>

		<?php do_action('edd_before_shop_store_content') ?>

		<div class="store-info">
			<?php the_content(); ?>
		</div>

		<?php do_action('edd_after_shop_store_content') ?>

		<div class="product-grid download-grid clearfix">
			<?php while ( $products->have_posts() ) : $products->the_post();?>	
				<div class="<?php echo esc_attr( $width ); ?> sf-edd-display-type-<?php echo esc_attr( $display_type ); ?> download-item">
					<?php if ( has_post_thumbnail() ) {
						$thumb_image   = get_post_thumbnail_id();
						$thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
						$image = atelier_aq_resize( $thumb_img_url, $thumb_width, $thumb_height, true, false );	
						$image_meta = atelier_get_attachment_meta( $thumb_image );
						$image_alt = "";
						if ( isset($image_meta) ) {
							$image_alt 			= esc_attr( $image_meta['alt'] );
						}
					?>
					<div class="figure-wrap">
						<figure class="animated-overlay">
							
							<a href="<?php the_permalink(); ?>"></a>
							
							<div class="img-wrap">
								<img itemprop="image" src="<?php echo esc_url($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
							</div>

							<div class="figcaption-wrap"></div>

							<figcaption>
							    <div class="thumb-info">
							    	<h4><a class="product-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

									<?php if ( $show_cats ) : ?>
										<?php echo get_the_term_list( get_the_ID(), 'download_category', '<h5 class="posted_in">', ', ', '</h5>' ); ?>
									<?php endif; ?>

									<?php if ( $show_price ) : ?>
										<div class="edd-product-price">
											<h6><span class="price"><?php edd_price( $post->ID ); ?></span></h6>
										</div>
									<?php endif; ?>

									<?php if ( $show_excerpt ) : ?>
										<div class="product-info">
											<?php the_excerpt(); ?>
										</div>
									<?php endif; ?>  
							    </div>
							</figcaption>

							<div class="cart-overlay">
								<div class="shop-actions">
								<?php if ( $show_buy_btn ) : ?>
									<?php echo do_shortcode('[purchase_link]'); ?>
								<?php endif; ?>
								</div>
							</div>

						</figure>
					</div>
					<?php } ?>
					<div class="product-description">

						<h3><a class="product-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

						<?php if ( $show_cats ) : ?>
							<?php echo get_the_term_list( get_the_ID(), 'download_category', '<span class="posted_in">', ', ', '</span>' ); ?>
						<?php endif; ?>

						<?php if ( $show_price ) : ?>
							<div class="edd-product-price">
								<?php edd_price( $post->ID ); ?>
							</div>
						<?php endif; ?>

						<?php if ( $show_excerpt ) : ?>
							<div class="product-info">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>

					</div>
				</div>
	
				<?php $i+=1; ?>
			<?php endwhile; ?>
		</div>

		<?php do_action('edd_before_shop_store_pagination') ?>

		<div class="store-pagination">
			<?php 					
				$big = 999999999; // need an unlikely intege					
				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, $current_page ),
					'total' => $products->max_num_pages
				) );
			?>
		</div>

		<?php do_action('edd_after_shop_store_pagination') ?>

	<?php else : ?>
	
		<div class="col-sm-12">
			<h2><?php _e( 'Not Found', 'atelier' ); ?></h2>
			<p><?php _e( 'Sorry, but you are looking for something that isn\'t here. Please search or use the browser\'s back button.', 'atelier' ); ?></p>
			<form method="get" class="search-form" action="<?php echo home_url(); ?>/">
		   	<input type="text" placeholder="<?php _e( "Search", 'atelier' ); ?>" name="s"/>
			</form>
		</div>
	<?php endif; ?>
</div>