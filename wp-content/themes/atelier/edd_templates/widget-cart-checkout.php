<?php if ( edd_use_taxes() ) : ?>
<div class="bag-total bag-subtotal edd-cart-meta edd_subtotal">
	<span class="subtotal-title"><?php _e( 'Subtotal:', 'atelier' ); ?></span>
	<span class="subtotal"><?php echo edd_currency_filter( edd_format_amount( edd_get_cart_subtotal() ) ); ?></span>
</div>
<div class="bag-total bag-tax cart_item edd-cart-meta edd_cart_tax">
	<span class="tax-title"><?php _e( 'Estimated Tax:', 'atelier' ); ?></span>
	<span class="cart-tax"><?php echo edd_currency_filter( edd_format_amount( edd_get_cart_tax() ) ); ?></span>
</div>
<?php endif; ?>
<div class="bag-total cart_item edd-cart-meta edd_total">
	<p class="total-title"><?php _e( 'Total:', 'atelier' ); ?></p>
	<span class="cart-total"><?php echo edd_currency_filter( edd_format_amount( edd_get_cart_total() ) ); ?></span>
</div>
<div class="bag-buttons edd_checkout">
	<a class="sf-button standard sf-icon-reveal checkout-button" href="<?php echo esc_url( edd_get_checkout_uri() ); ?>"><?php echo apply_filters( 'atelier_checkout_icon', '<i class="ss-creditcard"></i>' ); ?><span class="text"><?php _e( 'Checkout', 'atelier' ); ?></span></a>
</div>