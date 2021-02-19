<?php

/**
 * Password Protected
 *
 * @package bbPress
 * @subpackage Atelier
 */

?>

<div id="bbpress-forums">
	<fieldset class="bbp-form" id="bbp-protected">
		<Legend><?php _e( 'Protected', 'atelier' ); ?></legend>

		<?php echo get_the_password_form(); ?>

	</fieldset>
</div>