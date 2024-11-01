<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

class SCW_Main_Class{
  public $version;
  public function __construct(){
    if ( defined( 'SIDEBAR_CART_VERSION' ) ) {
      $this->version = SIDEBAR_CART_VERSION;
    } else {
      $this->version = '1.0.0';
    }
    $this->scw_options = get_option( 'scw_options' );
    add_action( 'admin_menu', array( $this, 'scw_admin_menu' ) );
    add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
    if( $this->scw_options['enable-sidebar-cart'] == 1 ) {
      add_action( 'after_setup_theme', array( $this, 'thumb_size' ) );
      add_action( 'wp_footer', array( $this, 'sidebar_cart_frontend' ) );
      add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'scw_fragments' ), 30, 1);
      add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
      add_action( 'scw-empty', array( $this, 'scw_empty' ), 10 );
      add_action( 'scw-after-items', array( $this, 'scw_after_items' ), 10 );
    }
	if( isset( $this->scw_options['auto-open-sidebar-cart'] ) && $this->scw_options['auto-open-sidebar-cart'] == 1 ) {
		$this->auto_open_attr = 'data-auto-open="1"';
	}
	 else{
		 $this->auto_open_attr = 'data-auto-open="0"';
	 }
	  if( isset( $this->scw_options['hide-empty-sidebar-cart'] ) && $this->scw_options['hide-empty-sidebar-cart'] == 1 ) {
		$this->hide_empty_attr = 'data-hide-empty="1"';
	}
	 else{
		 $this->hide_empty_attr = 'data-hide-empty="0"';
	 }
  }

  public function scripts(){
    wp_enqueue_style( 'scw-css', plugins_url( '/assets/css/scw-style.css', __FILE__ ), '', $this->version );
    wp_enqueue_script( 'scw-js', plugins_url('/assets/js/scw-scripts.js', __FILE__), array( 'jquery' ), $this->version, true );
  }

  public function thumb_size() {
    add_image_size( 'scw-thumb', 60, 60, true ); 
  }

  public function admin_scripts($hook){
	wp_register_style( 'scw-admin-css', plugins_url('/assets/css/admin.css', __FILE__), '', $this->version );
    if($hook != 'woocommerce_page_sidebar-cart') {
     return;
   }
   wp_enqueue_style( 'scw-admin-css' );
  }

 public function sidebar_cart_frontend(){
  if( !is_cart() && !is_checkout() ){
    if( WC()->cart->is_empty() ) {
      $scw_count = 0;
    }
    else{
      $scw_count = WC()->cart->cart_contents_count;
    }
    echo wp_kses_post( '<a href="" class="scw-trigger" '. $this->auto_open_attr .' '. $this->hide_empty_attr .'><img src="'. esc_url( plugins_url( '/assets/img/cart.png', __FILE__ ) ) .'" alt="'. __( 'Trigger Sidebar Cart', 'sidebar-cart' ) .'" /><span>'. $scw_count .'</span></a>' );
    require plugin_dir_path( __FILE__ ) . '/inc/scw-sidecart.php';
  }
}

public function scw_empty(){ ?>
  <span class="scw-title"><?php _e( 'Your cart is empty.', 'sidebar-cart' ); ?></span>
  <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="goto-shop"><?php _e( 'Go to Shop', 'sidebar-cart' ); ?></a>
<?php }

public function scw_after_items(){ ?>
  <div class="scw-action-buttons">
	<div class="scw-subtotal">
		<span class="scw-subtotal-title">
			<?php _e( 'Subtotal:', 'sidebar-cart' ); ?>
		</span>
		<span class="scw-subtotal-value scw-title">
			<?php wc_cart_totals_subtotal_html(); ?>
		</span>
	  </div>
	  <a class="checkout-button button alt wc-forward scw-cart-button" href="<?php echo esc_url( wc_get_cart_url() ); ?>"><?php _e( 'View Cart', 'sidebar-cart' ); ?></a>
	  <div class="scw-proceed-to-checkout">
		  <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	  </div>
  </div>
<?php }

public function scw_fragments( $fragments ){
  ob_start();
  require plugin_dir_path( __FILE__ ) . 'inc/scw-review.php';
  $fragments['.scw-review'] = ob_get_clean();
  if( WC()->cart->is_empty() ) {
    $scw_count = 0;
  }
  else{
    $scw_count = WC()->cart->cart_contents_count;
  }
  $fragments['.scw-trigger span'] = '<span>'. $scw_count .'</span>';
  return $fragments;
}

public function scw_admin_menu(){
  add_submenu_page(
    'woocommerce',
    __( 'Sidebar Cart', 'sidebar-cart' ),
    __( 'Sidebar Cart', 'sidebar-cart' ),
    'manage_options',
    'sidebar-cart',
    array( $this, 'scw_admin_menu_callback' )
  );
}

public function scw_admin_menu_callback(){
  require plugin_dir_path( __FILE__ ) . '/inc/scw-admin.php';
}

}