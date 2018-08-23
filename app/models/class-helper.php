<?php
/**
 * Helper Class
 *
 * @category Model
 * @package  eCommerce
 * @author   Tu Luong <luongduc.tu1992@gmail.com>
 */

/**
 * Helper Class
 *
 * Provide useful functions
 **/
class Helper {

	/**
	 * Constructor
	 */
	public function __construct() {}

	/**
	 * Print Shopping Cart details.
	 *
	 * @param User      $user User instance.
	 * @param Promotion $promotion Promotion instance.
	 */
	public function print_cart( $user = null, $promotion = null ) {
		if ( $user && $promotion ) {
			// Get discount based on user and promotion rule.
			$subtotal = $user->get_cart()->get_subtotal();
			$discount = $promotion->cal_discount( $user );

			$products = $user->get_cart()->get_products();
			$ids      = $user->get_cart()->get_ids();

			echo '<b>User: ' . $user->get_name() . '</b><br>';
			echo 'Cart items:<br>';
			foreach ( $ids as $key => $id ) {
				$product = $products[ $id ]['product'];
				$qty     = $products[ $id ]['qty'];
				echo $product->get_name() . ' (x' . $qty . ')' . '<br>';
			}
			// Output cart total and discount.
			echo '<br>';
			echo 'Subtotal: $' . $subtotal . '<br>';
			echo 'Discount: -$' . $discount . '<br>';
			echo 'Total: $' . ( $subtotal - $discount ) . '<br><br>';
		}
	}

}
