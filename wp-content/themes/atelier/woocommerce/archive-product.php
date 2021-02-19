<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $atelier_options;
$sidebar_config = $atelier_options['woo_sidebar_config'];
$left_sidebar = $atelier_options['woo_left_sidebar'];
$right_sidebar = $atelier_options['woo_right_sidebar'];
$product_display_fullwidth = $atelier_options['product_display_fullwidth'];
$product_display_type = $atelier_options['product_display_type'];
$product_multi_masonry = $atelier_options['product_multi_masonry'];
$page_title_style      = $atelier_options['woo_page_heading_style'];
$product_fw_mode = false;

// GET VARIABLES
if (isset($_GET['sidebar'])) {
	$sidebar_config = $_GET['sidebar'];
}
if (isset($_GET['product_display'])) {
	$product_display_type = $_GET['product_display'];
}
if (isset($_GET['fullwidth'])) {
	$product_fw_mode = $_GET['fullwidth'];
}

if ($product_display_fullwidth) {
	$product_fw_mode = true;
}

if ($sidebar_config == "") {
	$sidebar_config = 'right-sidebar';
}
if ($left_sidebar == "") {
	$left_sidebar = 'woocommerce-sidebar';
}
if ($right_sidebar == "") {
	$right_sidebar = 'woocommerce-sidebar';
}

$page_class = $content_class = $orig_sidebar_config = $cont_width = $sidebar_width = $cont_push = $sidebar_pull = '';
$page_wrap_class = "woocommerce-shop-page ";


if ($product_fw_mode) {
$page_wrap_class .= 'full-width-shop ';
$orig_sidebar_config = $sidebar_config;
$sidebar_config = "no-sidebars";
}

if ($product_multi_masonry) {
$orig_sidebar_config = "";
}

if ($atelier_options['sidebar_width'] == "reduced") {
	$cont_width = "col-sm-9";
	$cont_push = "col-sm-push-3";
	$sidebar_width = "col-sm-3";
	$sidebar_pull = "col-sm-pull-9";
} else {
	$cont_width = "col-sm-8";
	$cont_push = "col-sm-push-4";
	$sidebar_width = "col-sm-4";
	$sidebar_pull = "col-sm-pull-8";
}

if ($orig_sidebar_config != "") {
	if ($orig_sidebar_config == "left-sidebar") {
		$page_wrap_class .= 'has-left-sidebar has-one-sidebar';
	} else if ($orig_sidebar_config == "right-sidebar") {
		$page_wrap_class .= 'has-right-sidebar has-one-sidebar';
	} else if ($orig_sidebar_config == "both-sidebars") {
		$page_wrap_class .= 'has-both-sidebars';
	} else {
		$page_wrap_class .= 'has-no-sidebar';
	}
	$page_class = "row clearfix";
	$content_class = "col-sm-12 clearfix";
} else {
	if ($sidebar_config == "left-sidebar") {
		$page_wrap_class .= 'has-left-sidebar has-one-sidebar row';
		$page_class = $cont_width ." ".$cont_push." clearfix";
		$content_class = "clearfix";
	} else if ($sidebar_config == "right-sidebar") {
		$page_wrap_class .= 'has-right-sidebar has-one-sidebar row';
		$page_class = $cont_width . " clearfix";
		$content_class = "clearfix";
	} else if ($sidebar_config == "both-sidebars") {
		$page_wrap_class .= 'has-both-sidebars row';
		$page_class = $cont_width . " clearfix";
		$content_class = $cont_width . " clearfix";
	} else {
		$page_wrap_class .= 'has-no-sidebar';
		$page_class = "row clearfix";
		$content_class = "col-sm-12 clearfix";
	}
}

$content_class .= ' product-type-'. $product_display_type;

global $sf_include_isotope, $sf_has_products;
$sf_include_isotope = true;
$sf_has_products = true;

$width = $product_display_columns = "";
if (function_exists('wc_get_default_products_per_row') && function_exists('wc_get_loop_prop')) {
	$product_display_columns    = absint( max( 1, wc_get_loop_prop( 'columns', wc_get_default_products_per_row() ) ) );
} else {
	$product_display_columns = "4";
}
if ($product_display_columns == "4") {
	$width = 'col-sm-3';
} else if ($product_display_columns == "5") {
	$width = 'col-sm-sf-5';
} else if ($product_display_columns == "3") {
	$width = 'col-sm-4';
} else if ($product_display_columns == "2") {
	$width = 'col-sm-6';
} else if ($product_display_columns == "6") {
	$width = 'col-sm-2';
} else if ($product_display_columns == "1") {
	$width = 'col-sm-12';
}

get_header('shop');	?>

<?php
	// Swift Slider meta
	$woo_slider	   = $atelier_options['woo_shop_slider'];
	$woo_shop_slider_main_only = false;
	if ( isset($atelier_options['woo_shop_slider_main_only']) ) {
		$woo_shop_slider_main_only = $atelier_options['woo_shop_slider_main_only'];
	}
	$ss_category   = "";
	if ( isset($atelier_options['woo_shop_category']) ) {
	$ss_category   = $atelier_options['woo_shop_category'];
	}
	$ss_random	   = $atelier_options['woo_shop_slider_random'];
	$ss_maxheight  = $atelier_options['woo_shop_slider_maxheight'];
	$ss_slidecount = $atelier_options['woo_shop_slider_slides'];
	$ss_autoplay   = $atelier_options['woo_shop_slider_auto'];
	$ss_transition = $atelier_options['woo_shop_slider_transition'];
	$ss_loop       = $atelier_options['woo_shop_slider_loop'];
	$ss_nav        = $atelier_options['woo_shop_slider_nav'];
	$ss_pagination = $atelier_options['woo_shop_slider_pagination'];
	
	if ( $woo_shop_slider_main_only && !is_shop() ) {
		$woo_slider = "";
	}
	
	if ( $woo_slider == "swift-slider" ) {
		
		global $sf_has_swiftslider;
		$sf_has_swiftslider = true;
		
		if ( $ss_category != "" ) {
			$ss_category_obj = get_term( $ss_category, 'swift-slider-category', 'object');
			$ss_category = $ss_category_obj->slug;
		}
				
		echo do_shortcode( '[swift_slider type="slider" category="' . $ss_category . '" random="' . $ss_random . '" fullscreen="false" max_height="' . $ss_maxheight . '" slide_count="' . $ss_slidecount . '" transition="'.$ss_transition.'" loop="' . $ss_loop . '" nav="' . $ss_nav . '" pagination="' . $ss_pagination . '" autoplay="' . $ss_autoplay . '"]' );
	}
?>

<?php if (!$product_fw_mode) { ?>
<div class="container">
<?php } ?>

	<?php
		/**
		 * Hook: woocommerce_before_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 * @hooked WC_Structured_Data::generate_website_data() - 30
		 */
		do_action('woocommerce_before_main_content');
	?>

	<div class="inner-page-wrap <?php echo esc_attr($page_wrap_class); ?> clearfix">

		<?php if ( $product_fw_mode && $page_title_style == "fancy-tabbed" ) { ?>
		<div class="container">
		<?php } ?>

			<div class="woo-aux-options-wrap col-sm-12">
				<div class="woo-aux-options clearfix">
				<?php
					/**
					 * woocommerce_before_shop_loop hook
					 *
					 * @hooked atelier_shop_layout_opts - 10
					 * @hooked woocommerce_result_count - 20
					 * @hooked atelier_mobile_filters_link - 25
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					do_action( 'woocommerce_before_shop_loop' );
				?>
				</div>

				<div class="mobile-woo-aux-options clearfix">
					<div class="mobile-woo-aux-filters clearfix">
						<?php
							/**
							 * atelier_mobile_before_shop_loop_filters hook
							 *
							 * @hooked atelier_mobile_filters_display - 10
							 */
							do_action( 'atelier_mobile_before_shop_loop_filters' );
						?>
					</div>
					<div class="mobile-woo-aux-details clearfix">
						<?php
							/**
							 * atelier_mobile_before_shop_loop_details hook
							 *
							 * @hooked atelier_shop_layout_opts_mobile - 10
							 */
							do_action( 'atelier_mobile_before_shop_loop_details' );
						?>
					</div>
				</div>
			</div>

		<?php if ( $product_fw_mode && $page_title_style == "fancy-tabbed" ) { ?>
		</div>
		<?php } ?>

		<!-- OPEN section -->
		<section class="<?php echo esc_attr($page_class); ?>">

			<!-- OPEN .page-content -->
			<div class="page-content <?php echo esc_attr($content_class); ?>">

			<?php do_action( 'woocommerce_archive_description' ); ?>

			<?php if ( function_exists('woocommerce_product_loop') ? woocommerce_product_loop() : have_posts() ) : ?>

				<!-- LOOP START -->
				<?php woocommerce_product_loop_start(); ?>

					<?php if ( !version_compare( WC_VERSION, '3.3', '>=' ) ) {
						woocommerce_product_subcategories();
					}?>

					<?php if ($product_fw_mode && ($orig_sidebar_config == "left-sidebar" || $orig_sidebar_config == "both-sidebars")) { ?>
						<div class="sidebar left-sidebar <?php echo esc_attr($width); ?>">
							<?php dynamic_sidebar(strtolower($left_sidebar)); ?>
						</div>

					<?php } ?>

					<?php if ( function_exists('wc_get_loop_prop') ) {
						if ( wc_get_loop_prop( 'total' ) ) {
							while ( have_posts() ) {
								the_post();

								/**
								 * Hook: woocommerce_shop_loop.
								 *
								 * @hooked WC_Structured_Data::generate_product_data() - 10
								 */
								do_action( 'woocommerce_shop_loop' );

								wc_get_template_part( 'content', 'product' );
							}
						}
					} else {
						while ( have_posts() ) {
							the_post();
							wc_get_template_part( 'content', 'product' );
						}
					} ?>

					<?php if ($product_fw_mode && ($orig_sidebar_config == "right-sidebar" || $orig_sidebar_config == "both-sidebars")) { ?>

					<div class="sidebar right-sidebar <?php echo esc_attr($width); ?>">
						<?php dynamic_sidebar(strtolower($right_sidebar)); ?>
					</div>

					<?php } ?>

				<!-- LOOP END -->
				<?php woocommerce_product_loop_end(); ?>

				<?php
					/**
					 * woocommerce_after_shop_loop hook
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
				?>

			<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

				<div class="no-products-wrap container">
					<?php wc_get_template( 'loop/no-products-found.php' ); ?>
				</div>

			<?php endif; ?>

			<!-- CLOSE .page-content -->
			</div>

			<?php if ($sidebar_config == "both-sidebars") { ?>
			<aside class="sidebar left-sidebar col-sm-3">

				<?php do_action('atelier_after_sidebar'); ?>

				<div class="sidebar-widget-wrap">
					<?php dynamic_sidebar(strtolower($left_sidebar)); ?>
				</div>

				<?php do_action('atelier_before_sidebar'); ?>

			</aside>
			<?php } ?>

		<!-- CLOSE section -->
		</section>

		<?php if ($sidebar_config == "left-sidebar") { ?>

		<aside class="sidebar left-sidebar <?php echo esc_attr($sidebar_width); ?> <?php echo esc_attr($sidebar_pull); ?>">

			<?php do_action('atelier_after_sidebar'); ?>

			<div class="sidebar-widget-wrap">
				<?php dynamic_sidebar(strtolower($left_sidebar)); ?>
			</div>

			<?php do_action('atelier_before_sidebar'); ?>

		</aside>

		<?php } else if ($sidebar_config == "right-sidebar") { ?>

		<aside class="sidebar right-sidebar <?php echo esc_attr($sidebar_width); ?>">

			<?php do_action('atelier_after_sidebar'); ?>

			<div class="sidebar-widget-wrap">
				<?php dynamic_sidebar(strtolower($right_sidebar)); ?>
			</div>

			<?php do_action('atelier_before_sidebar'); ?>

		</aside>

		<?php } else if ($sidebar_config == "both-sidebars") { ?>

		<aside class="sidebar right-sidebar col-sm-3">

			<?php do_action('atelier_after_sidebar'); ?>

			<div class="sidebar-widget-wrap">
				<?php dynamic_sidebar(strtolower($right_sidebar)); ?>
			</div>

			<?php do_action('atelier_before_sidebar'); ?>

		</aside>

		<?php } ?>

	</div>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

<?php if (!$product_fw_mode) { ?>
</div>
<?php } ?>

<?php get_footer('shop'); ?>