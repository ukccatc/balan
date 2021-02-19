<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $woocommerce, $post, $product, $woocommerce_loop, $atelier_options, $atelier_catalog_mode, $atelier_product_multimasonry, $atelier_product_display_type, $atelier_product_display_layout;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();

$width = $thumb_width = $thumb_height = "";

$product_display_type = $atelier_options['product_display_type'];
$product_display_gutters = $atelier_options['product_display_gutters'];
$product_qv_hover = $atelier_options['product_qv_hover'];
$product_buybtn = $atelier_options['product_buybtn'];
$product_rating = $atelier_options['product_rating'];
$product_details_alignment = $atelier_options['product_details_alignment'];
$disable_product_transition = false;
if ( isset( $atelier_options['disable_product_transition'] ) ) {
	$disable_product_transition = $atelier_options['disable_product_transition'];
}
	
if ( $atelier_product_display_type ) {
	$product_display_type = $atelier_product_display_type;
}

// GET VARIABLES
if ( isset($_GET['product_display']) ) {
	$product_display_type = $_GET['product_display'];
}
if ( isset($woocommerce_loop['style-override']) && $woocommerce_loop['style-override'] != "" ) {
	$product_display_type = $woocommerce_loop['style-override'];
}

if ( isset($_GET['product_gutters']) ) {
	$product_display_gutters = $_GET['product_gutters'];
}

$product_layout = "";
if ( $atelier_product_multimasonry ) {
	$product_display_type = "gallery";
} else {
	if ( isset($atelier_options['product_display_layout']) ) {
		$product_layout = $atelier_options['product_display_layout'];
	}
}

if ( $atelier_product_display_layout != "" ) {
	$product_layout = $atelier_product_display_layout;
}

if ( $product_qv_hover ) {
	$classes[] = 'qv-hover';
}

$figure_class = 'animated-overlay';

$sidebar_config = $atelier_options['woo_sidebar_config'];
if (isset($_GET['sidebar'])) {
	$sidebar_config = $_GET['sidebar'];
}

if (isset($_GET['layout'])) {
	$product_layout = $_GET['layout'];
}

if ( !$disable_product_transition && $product_display_type != "preview-slider" ) {
	if ( $product_display_type == "standard" ) {
		$figure_class .= ' product-transition-fade';
	} else {
		$figure_class .= ' product-transition-zoom';
	}
} else {
	$figure_class .= ' product-transition-disabled';
}

$classes[] = 'product-display-'.$product_display_type;

if (!$product_display_gutters && ($product_display_type == "gallery" || $atelier_product_multimasonry) ) {
	$classes[] = 'no-gutters';
}

if ($product_buybtn && $product_display_type == "standard") {
	$classes[] = 'buy-btn-visible';
}
if ($product_rating && $product_display_type == "standard") {
	$classes[] = 'rating-visible';
}

$classes[] = 'product-layout-'.$product_layout;
$classes[] = 'details-align-'.$product_details_alignment;


// Get the product description
$product_description = atelier_get_post_meta($post->ID, 'sf_product_short_description', true);
if ($product_description == "") {
	$product_description = $post->post_excerpt;
}

// Get variations for variable products
if ( $product->is_type( 'variable' ) && $product_display_type == "preview-slider" ) {
	$available_variations = $product->get_available_variations();
}


// Width, Height parameters
if ( $atelier_product_multimasonry ) {

	$masonry_thumb_size = atelier_get_post_meta( get_the_ID(), 'sf_masonry_thumb_size', true );

	if ( $masonry_thumb_size == "large" ) {
	    $classes[] = 'col-sm-6 size-large';
	    $width = 'col-sm-6';
	    $thumb_width = 800;
	    $thumb_height = 650;
	} else if ( $masonry_thumb_size == "tall" ) {
	    $classes[] = 'col-sm-3 size-tall';
	    $width = 'col-sm-3';
	    $thumb_width = 400;
	    $thumb_height = 800;
	} else {
		$classes[] = 'col-sm-3 size-standard';
		$width = 'col-sm-3';
		$thumb_width = 400;
		$thumb_height = 320;
	}

} else {
	
	if ( $product_layout == "grid" ) {
		if ( $sidebar_config == "no-sidebars" ) {
			$classes[] = 'col-sm-sf-5';
			$width = 'col-sm-sf-5';
		} else {
			$classes[] = 'col-sm-3';
			$width = 'col-sm-3';
		}
	} else if ($woocommerce_loop['columns'] == 4) {
		$classes[] = 'col-sm-3';
		$width = 'col-sm-3';
	} else if ($woocommerce_loop['columns'] == 5) {
		$classes[] = 'col-sm-sf-5';
		$width = 'col-sm-sf-5';
	} else if ($woocommerce_loop['columns'] == 3) {
		$classes[] = 'col-sm-4';
		$width = 'col-sm-4';
	} else if ($woocommerce_loop['columns'] == 2) {
		$classes[] = 'col-sm-6';
		$width = 'col-sm-6';
	} else if ($woocommerce_loop['columns'] == 1) {
		$classes[] = 'col-sm-12';
		$width = 'col-sm-12';
	} else if ($woocommerce_loop['columns'] == 6) {
		$classes[] = 'col-sm-2';
		$width = 'col-sm-2';
	} else {
		$classes[] = 'col-sm-3';
		$width = 'col-sm-3';
	}
	
}
?>

<?php if ( version_compare( WC_VERSION, '3.6', '>=' ) ) { ?>
<li <?php wc_product_class( $classes, $product ); ?> data-width="<?php echo esc_attr($width); ?>">
<?php } else if ( version_compare( WC_VERSION, '3.4', '>=' ) ) { ?>
<li <?php wc_product_class( $classes ); ?> data-width="<?php echo esc_attr($width); ?>">
<?php } else { ?>
<li <?php post_class( $classes ); ?> data-width="<?php echo esc_attr($width); ?>">
<?php } ?>


	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	
	<?php if ( $product_display_type == "preview-slider" ) { ?>
	<div class="preview-slider-item-wrapper" data-permalink="<?php the_permalink(); ?>">
	<?php } ?>

	<figure class="<?php echo esc_attr($figure_class); ?>">

		<?php atelier_woocommerceproduct_badge(); ?>

		<?php if ( $atelier_product_multimasonry ) {
			$thumb_image    = get_post_thumbnail_id();
			$thumb_image_id = $thumb_image;
			$thumb_img_url  = wp_get_attachment_url( $thumb_image, 'full' );
			
			if ( $thumb_img_url == "" ) {
				$thumb_img_url = "default";
			}
			
			$image = '';
            if (function_exists('atelier_aq_resize')) {
				$image = atelier_aq_resize( $thumb_img_url, $thumb_width, $thumb_height, true, false );				
			}
			$image_alt = esc_attr( atelier_get_post_meta( $thumb_image_id, '_wp_attachment_image_alt', true ) );
			
			if ( $image_alt == "" ) {
				$image_alt = get_the_title();
			}

			if ( $image ) {
				echo '<div class="multi-masonry-img-wrap"><img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . $image_alt . '" /></div>' . "\n";
			}
		} else if ( $product_display_type == "preview-slider" ) {
						
			if ( $product->is_type( 'variable' ) ) {
				
				echo '<div class="variable-image-wrapper is-variable">';
				$img_count = 0;			
				$available_variations = $product->get_available_variations();
				if ($available_variations && is_array($available_variations) ) {
					$available_variations = array_reverse($available_variations);
					foreach ( $available_variations as $variation ) {
						if ( $variation['variation_is_visible'] ) {
							$sale = false;
							if ( $variation['display_price'] != $variation['display_regular_price'] ) {
							$sale = true;
							}
											
							if ( $img_count == 0 ) {
							echo '<div class="img-wrap selected" data-sale="'.$sale.'">';
							} else if ( $img_count == 1 ) {
							echo '<div class="img-wrap move-right" data-sale="'.$sale.'">';
							} else {
							echo '<div class="img-wrap" data-sale="'.$sale.'">';
							}
							echo '<div class="variation-price">'.$variation["price_html"].'</div>';
							if ( isset($variation["image_src"]) ) {
								echo '<img src="'.$variation["image_src"].'" />';		
							} else if ( isset($variation["image"]["url"]) ) {
								echo '<img src="'.$variation["image"]["url"].'" />';		
							} else {
								echo '<img src="' . wc_placeholder_img_src() . '" />';
							}	
							echo '</div>';
							$img_count++;
						}
					}
				}
				echo '</div>';
				
			} else {
				
				echo '<div class="variable-image-wrapper">';
				echo '<div class="img-wrap selected">';
				woocommerce_template_loop_product_thumbnail();
				echo '</div>';
				echo '</div>';	
				
			}
			
		} else {
			echo '<div class="img-wrap first-image">';
			woocommerce_template_loop_product_thumbnail();
			echo '</div>';

			if ($product_display_type == "standard" && !$disable_product_transition) {
				
				$attachment_ids = '';
				if ( version_compare( WC_VERSION, '2.7', '>=' ) ) {
				$attachment_ids = $product->get_gallery_image_ids();
				} else {
				$attachment_ids = $product->get_gallery_attachment_ids();
				}
				
				$img_count = 0;

				if ($attachment_ids) {

					foreach ( $attachment_ids as $attachment_id ) {

						if ( atelier_get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) )
							continue;
						
						echo '<div class="img-wrap second-image">'.wp_get_attachment_image( $attachment_id, 'woocommerce_thumbnail' ).'</div>';

						$img_count++;

						if ($img_count == 1) break;

					}

				} else {
					echo '<div class="img-wrap second-image">';
					woocommerce_template_loop_product_thumbnail();
					echo '</div>';
				}
			}
		} ?>

		<div class="cart-overlay">
			<div class="shop-actions clearfix">
				<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			</div>
		</div>
		
		<?php if ( !( $product_display_type == "preview-slider" && $product->is_type( 'variable' ) ) ) { ?>
		<a href="<?php the_permalink(); ?>"></a>
		<?php } ?>

		<div class="figcaption-wrap"></div>

		<?php if ($product_display_type != "standard") { ?>
			<figcaption>
				<div class="thumb-info">
					<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
					<h4><?php the_title(); ?></h4>
					<?php
						$product_id = method_exists( $product, 'get_id' ) ? $product->get_id() : $product->id;
						echo wc_get_product_category_list( $product_id, ', ', '<span class="posted_in">', '</span>' ); 
					?>
					<?php if ( class_exists( 'Woocommerce_German_Market' ) ) { ?>
						<div class="gm-hover-price-wrap">
						<?php
							/**
							 * woocommerce_after_shop_loop_item_title hook
							 *
							 * @hooked woocommerce_template_loop_price - 10
							 */
							do_action( 'woocommerce_after_shop_loop_item_title' );
						?>
						</div>				
					<?php } else { ?>
						<h6><?php woocommerce_template_loop_price(); ?></h6>
					<?php } ?>
				</div>
			</figcaption>

		<?php } ?>

	</figure>

	<div class="product-details">
		<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
		<h3><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h3>
		<?php
			$product_id = method_exists( $product, 'get_id' ) ? $product->get_id() : $product->id;
			echo wc_get_product_category_list( $product_id, ', ', '<span class="posted_in">', '</span>' ); 
		?>
		<div class="product-desc">
			<?php echo wp_kses_post($product_description); ?>
		</div>

		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

	</div>

	<?php if ($product_display_type == "standard") { ?>
		<div class="clear"></div>
		<div class="product-actions">
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
		</div>
	<?php } ?>
	
	<?php if ( $product_display_type == "preview-slider" ) { ?>
	</div>
	<?php } ?>

</li>