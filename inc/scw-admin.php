<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( !current_user_can( 'activate_plugins' ) )  {
	wp_die( _e( 'You do not have sufficient permissions to access this page.','sidebar-cart' ) );
}



if ( ! empty( $_POST ) && check_admin_referer( 'scw-afs', 'scw-admin-nonce' ) ){
	$data = array(
		'enable-sidebar-cart'   => (isset($_POST['enable-sidebar-cart'])?'1':'0'),
	);
	update_option( 'scw_options', $data );
}
$current_options = get_option('scw_options');
?>
<div class="wrap scw-wrap">
	<h1 class="hidden-h1"></h1>
	<?php if ( isset( $_POST['scw_option_submit'] ) ){ ?>
		<div class="notice notice-success"> 
			<p><strong><?php _e( 'Settings saved.', 'sidebar-cart' ); ?></strong></p>
		</div>
	<?php } ?>
	<div class="scw-admin-page-title">
		<h1 class="scw-admin-title"><?php echo get_admin_page_title(); ?></h1>
		<span class="scw-version"><?php echo esc_html( $this->version ); ?></span>
	</div>
	<form method="POST" class="options-form">
		<?php wp_nonce_field( 'scw-afs', 'scw-admin-nonce' ); ?>
		<div class="block">
			<h3><?php _e( 'General', 'sidebar-cart' ); ?></h3>
			<fieldset>
				<legend class="screen-reader-text"><span>
					<?php _e( 'Enable Sidebar Cart', 'sidebar-cart' ); ?>
				</span></legend>
				<label for="enable-Sidebar Cart">
					<input name="enable-sidebar-cart" type="checkbox" <?php if( $current_options['enable-sidebar-cart'] == 1 ) : ?> checked <?php endif; ?> />
					<span><?php _e( 'Enable Sidebar Cart', 'sidebar-cart' ); ?></span>
				</label>
				<label class="pro-only block-label">
					<input type="checkbox" readonly="readonly">
					<span><strong><?php _e( 'Open Sidebar Cart after product added to cart', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				</label>
				<label class="pro-only block-label">
					<input type="checkbox" readonly="readonly">
					<span><strong><?php _e( 'Hide when cart empty', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				</label>
			</fieldset>
		</div>
		<div class="block scw-styling">
			<h3><?php _e( 'Style', 'sidebar-cart' ); ?></h3>
			<label class="pro-only">
				<span><strong><?php _e( 'Sidebar Cart trigger background color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'Sidebar Cart Count background color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'Sidebar Cart Count Text color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'Cart Icon', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'Sidebar Cart Container background color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'Sidebar Cart Items background color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'Sidebar Cart Item Name color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'Sidebar Cart Item Price/Quantity color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'Remove Item background color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'Remove Item color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'Subtotal Heading Color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'Subtotal Price Color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'View Cart Background Color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'View Cart Text Color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'View Cart Hover Background Color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'View Cart Hover Text Color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'Checkout Background Color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'Checkout Text Color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'Checkout Hover Background Color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
			<br>
			<label class="pro-only">
				<span><strong><?php _e( 'Checkout Hover Text Color', 'sidebar-cart' ); ?></strong> (<a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only)</span>
				<input type="text" readonly="readonly">
			</label>
		</div>
		<div class="block">
			<h3><?php _e( 'Shortcode', 'sidebar-cart' ); ?></h3>
			<p class="pro-only"><?php _e( '<strong style="font-size:18px;">[sidebar-cart]</strong> Use this shortcode to display Sidebar Cart trigger anywhere.', 'sidebar-cart' ) ?></p>
			<p>
				<?php _e( 'Shortcode is available in <a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank" class="pro-only-link">Premium</a> extension only.', 'sidebar-cart' ) ?>
			</p>
		</div>
		<input class="button-primary scw-submit" type="submit" name="scw_option_submit" value="<?php esc_attr_e( 'Save Changes', 'scw-options-submit' ); ?>" />

	</form>
	<?php 
	$pro_notice = __( '<h3><a class="pro-only-link" href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank">Get Premium extension</a></h3><h4>What is included in Premium extension?</h4><ol class="pro-details-list"><li>Auto open Sidebar Cart when product added to cart</li><li>Custom Cart Icon</li><li>Sidebar Cart Trigger Shortcode</li><li>Add Sidebar Cart trigger in menu</li><li>Custom Styling</li><li>Preferred Support</li><li>Lifetime Updates</li></ol><h2>Interested in Premium extension?</h2><h4><a href="https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/" target="_blank">Click here</a> to get Premium extension now.</h4>', 'sidebar-cart' )
	?>
	<div class="pro-notice">
		<?php echo wp_kses_post( $pro_notice ); ?>
		<h4 class="scw-contact-info">
			In case of any problem, question, idea or any WordPress related work, reach me at <a href="mailto:a.hassan@ahmadshyk.com">a.hassan@ahmadshyk.com</a>
		</h4>
	</div>
</div>