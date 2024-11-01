<?php
/**
 * Plugin Name:       Sidebar Cart for WooCommerce
 * Plugin URI:        https://ahmadshyk.com/item/sidebar-cart-for-woocommerce-premium-extension/
 * Description:       The simple plugin to add Sidebar Cart on your WooCommerce website.
 * Version:           1.0.1
 * Author:            Ahmad Shyk
 * Author URI:        https://ahmadshyk.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sidebar-cart
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'SIDEBAR_CART_VERSION', '1.0.1' );

/**
 * Activation Hook.
 */
register_activation_hook( __FILE__, 'scw_activate' );
function scw_activate(){
	$default = array(
		'enable-sidebar-cart' => 1,
	);
	add_option( 'scw_options', $default, '', 'yes' );
}

/**
 * Admin notice if WooCommerce not installed and activated.
 */
function scw_no_woocommerce(){ ?>
	<div class="error">
		<p><?php _e( 'Sidebar Cart for WooCommerce Plugin is activated but not effective. It requires WooCommerce in order to work.', 'sidebar-cart' ); ?></p>
	</div>
	<?php	
}

/**
 *  Main Class
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	require plugin_dir_path( __FILE__ ) . 'class-sidebar-cart.php';

	new SCW_Main_Class();

}

else{
	add_action( 'admin_notices', 'scw_no_woocommerce' );
}

//Add settings link on plugin page
function scw_settings_link($links) { 
	$settings_link = '<a href="admin.php?page=sidebar-cart">Settings</a>'; 
	array_unshift($links, $settings_link); 
	return $links; 
}
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'scw_settings_link' );

add_action( 'init', 'scw_load_textdomain' );
//Load plugin textdomain.
function scw_load_textdomain() {
	load_plugin_textdomain( 'sidebar-cart', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' ); 
}