<?php
global $atelier_options;
$tb_right_config = $atelier_options['tb_right_config'];
$tb_right_text = __($atelier_options['tb_right_text'], 'atelier');
		
if ($tb_right_config == "social") {
	echo do_shortcode('[social]');
} else if ($tb_right_config == "account") {
	echo atelier_get_account();
} else if ($tb_right_config == "menu") {
	echo atelier_top_bar_menu();
} else if ($tb_right_config == "cart-wishlist") {
	echo '<div class="aux-item aux-cart-wishlist"><nav class="std-menu cart-wishlist"><ul class="menu">';
	echo atelier_get_cart();
	echo atelier_get_wishlist();
	echo '</ul></nav></div>';
} else if ($tb_right_config == "currency-switcher") {
	echo '<div class="aux-item aux-currency"><nav class="std-menu currency"><ul class="menu">';
	echo atelier_get_currency_switcher();
	echo  '</ul></nav></div>';
} else {
	echo '<div class="tb-text">'.do_shortcode($tb_right_text).'</div>';
}