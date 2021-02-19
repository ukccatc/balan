<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

global $product;
$product_id = method_exists( $product, 'get_id' ) ? $product->get_id() : $product->id;
?>

<div id="reviews" class="row">
	<div id="comments" class="col-sm-7">
		<div class="title-wrap">
			<h3 class="spb-heading"><span><?php
//			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_rating_count() ) )
//				printf( _n( '%s review for %s', '%s reviews for %s', $count, 'atelier' ), $count, get_the_title() );
//			else
				esc_html_e( 'Reviews', 'atelier' );
				if ( version_compare( WC_VERSION, '3.6', '>=' ) ) {
					echo '<span class="count">(' . $product->get_review_count() . ')</span>';
				} else {
					echo comments_number( '<span class="count">(0)</span>', '<span class="count">(1)</span>', '<span class="count">(%)</span>' );					
				}
			?></span></h3>
		</div>

		<?php if ( have_comments() ) : ?>

			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'atelier' ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product_id ) ) : ?>

		<div id="review_form_wrapper" class="col-sm-5">
			<div class="title-wrap">
				<h3 class="spb-heading"><span><?php esc_html_e( 'Add a Review', 'atelier' ); ?></span></h3>
			</div>
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();
					$comment_form = array(
						'title_reply'          => have_comments() ? __( 'Add a Review', 'atelier' ) : __( 'Be the first to review', 'atelier' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
						'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'atelier' ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'atelier' ) . '&nbsp;<span class="required">*</span></label> ' .
										'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_html__( 'Name', 'atelier' ) . '" size="30" required /></p>',
							'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'atelier' ) . '&nbsp;<span class="required">*</span></label> ' .
										'<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_html__( 'Email', 'atelier' ) . '" size="30" required /></p>',
						),
						'label_submit'  => esc_html__( 'Add your review', 'atelier' ),
						'logged_in_as'  => '',
						'comment_field' => ''
					);

					$comment_form['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your review', 'atelier' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" placeholder="' . esc_html__( 'Your review', 'atelier' ) . '" required></textarea></p>';

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] .= '<p class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'atelier' ) . '</label><select name="rating" id="rating" required>
							<option value="">' . __( 'Rate&hellip;', 'atelier' ) . '</option>
							<option value="5">' . __( 'Perfect', 'atelier' ) . '</option>
							<option value="4">' . __( 'Good', 'atelier' ) . '</option>
							<option value="3">' . __( 'Average', 'atelier' ) . '</option>
							<option value="2">' . __( 'Not that bad', 'atelier' ) . '</option>
							<option value="1">' . __( 'Very Poor', 'atelier' ) . '</option>
						</select></p>';
					}

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'atelier' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>