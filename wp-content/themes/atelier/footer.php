<?php
						global $atelier_options;
						$header_layout = $atelier_options['header_layout'];
						if (isset($_GET['header'])) {
							$header_layout = $_GET['header'];
						}

						global $remove_promo_bar;

						if ($remove_promo_bar) {
							remove_action('atelier_main_container_end', 'atelier_footer_promo', 20);
						}
					?>
					
				<?php
					/**
					 * @hooked - atelier_footer_promo - 20
					 * @hooked - atelier_one_page_nav - 30
					**/
					do_action('atelier_main_container_end');
				?>

			<!--// CLOSE #main-container //-->
			</div>

			<div id="footer-wrap">
				<?php
					/**
					 * @hooked - atelier_footer_widgets - 10
					 * @hooked - atelier_footer_copyright - 20
					**/
					do_action('atelier_footer_wrap_content');
				?>
			</div>

			<?php do_action('atelier_container_end'); ?>

		<!--// CLOSE #container //-->
		</div>

		<?php
			/**
			 * @hooked - atelier_back_to_top - 20
			 * @hooked - atelier_fw_video_area - 30
			**/
			do_action('atelier_after_page_container');
		?>

		<?php wp_footer(); ?>

	<!--// CLOSE BODY //-->
	</body>


<!--// CLOSE HTML //-->
</html>