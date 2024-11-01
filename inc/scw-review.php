<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( is_admin() ) return false;
?>
<div class="scw-review">
	<?php if( WC()->cart->is_empty() ) { ?>
		<div class="scw-empty">
			<?php do_action( 'scw-empty' ); ?>
		</div>
	<?php }
	else{
		do_action( 'scw-before-items' );
		?>
		<ul class="scw-items">
			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				}
				$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'scw-thumb' ), $cart_item, $cart_item_key );
				?>
				<li class="scw-item woocommerce-mini-cart-item">
					<div class="scw-thumb">
						<?php
						$allowed_tag_img = array(
							'img' => array(
								'width'      => array(),
								'height'     => array(),
								'src'        => array(),
								'class'      => array(),
								'alt'        => array(),
								'loading'    => array(),
								'srcset'     => array(),
								'sizes'      => array(),
							)
						);
						if ( ! $product_permalink ) {
							echo wp_kses( $thumbnail, $allowed_tag_img );
						} 
						else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses( $thumbnail, $allowed_tag_img ) );
						//echo $thumbnail;
						}
						?>
					</div>
					<div class="scw-item-detail">
						<span class="scw-title">
							<?php
							if ( ! $product_permalink ) {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
							} else {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
							}
							do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

						// Meta data.
							echo wc_get_formatted_cart_item_data( $cart_item );

						// Backorder notification.
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
							}
							?>
						</span>
						<div class="scw-item-extra">
							<div class="scw-quantity-price">
							<span class="scw-price">
								<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
							</span>
							&times;
							<span class="scw-quantity">
								<?php echo esc_html( $cart_item['quantity'] ); ?>
							</span>
						</div>
						<div class="scw-remove product-remove">
						<?php
						echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
							'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
							esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
							__( 'Remove this item', 'woocommerce' ),
							esc_attr( $product_id ),
							esc_attr( $cart_item_key ),
							esc_attr( $_product->get_sku() )
						), $cart_item_key );
						?>
					</div>
						</div>
					</div>
				</li>
			<?php }  ?>
		</ul>
		<?php 
		do_action( 'scw-after-items' ); 
	} 
	?>
</div>