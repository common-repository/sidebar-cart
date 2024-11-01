<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( is_admin() ) return false;
?>
<div class="scw-overlay"></div>
<div class="scw-container">
	<div class="scw-container-inner">
		<a href="" class="scw-close">&times;</a>
		<?php include ( plugin_dir_path( __FILE__ ) . 'scw-review.php' ); ?>
	</div>
</div>