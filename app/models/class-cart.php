<?php
/**
 * User Class
 *
 * @category Model
 * @package  eCommerce
 * @author   Tu Luong <luongduc.tu1992@gmail.com>
 */

/**
 * Cart Class Definition
 **/
class Cart {

	/**
	 * List of products
	 *
	 * @var Array
	 */
	protected $products;

	/**
	 * List of products ids
	 * for convenient interator
	 *
	 * @var Array
	 */
	protected $ids;

	/**
	 * Cart subtotal
	 *
	 * @var Integer
	 */
	protected $subtotal;

	/**
	 * Cart associated user id
	 *
	 * @var String
	 */
	protected $user_id;

	/**
	 * Constructor
	 *
	 * @param String  $user_id Shopping cart associated user id.
	 * @param Array   $products Shopping cart products.
	 * @param Integer $subtotal Shopping cart products subtotal.
	 */
	public function __construct( $user_id = null, $products = array(), $subtotal = 0 ) {
		$this->user_id  = $user_id;
		$this->products = $products;
		$this->ids      = empty( $this->products ) ? array() : array_keys( $this->products );
		$this->subtotal = $subtotal;
	}

	/**
	 * Cart user_id getter
	 */
	public function get_user_id() {
		return $this->user_id;
	}

	/**
	 * Cart user_id setter
	 *
	 * @param User $user_id User id.
	 */
	public function set_user_id( $user_id ) {
		if ( $user_id ) {
			$this->user_id = $user_id;
		}
	}

	/**
	 * Cart products getter
	 */
	public function get_products() {
		return $this->products;
	}

	/**
	 * Cart products ids getter
	 */
	public function get_ids() {
		return $this->ids;
	}

	/**
	 * Cart subtotal getter
	 */
	public function get_subtotal() {
		return $this->subtotal;
	}

	/**
	 * Cart subtotal setter
	 *
	 * @param Integer $subtotal Cart subtotal.
	 */
	public function set_subtotal( $subtotal ) {
		if ( $subtotal ) {
			$this->subtotal = $subtotal;
		}
	}

	/**
	 * Check if cart is empty
	 */
	public function is_empty() {
		return ( empty( $this->products ) );
	}

	/**
	 * Add a product to $products list
	 *
	 * @param Product $product Product.
	 */
	public function add_product( Product $product ) {
		// Get product unique ID.
		$id = $product->get_id();
		if ( ! $id ) {
			return false;
		}
		if ( isset( $this->products[ $id ] ) ) {
			$this->update_product( $product, intval( $this->products[ $id ]['qty'] ) + 1 );
		} else {
			// Add Product to $products list.
			$this->products[ $id ] = array(
				'product' => $product,
				'qty'     => 1,
			);
			// Update $ids list and $subtotal.
			$this->ids[]    = $id;
			$this->subtotal = $this->subtotal + $product->get_price();
		}
		return true;
	}

	/**
	 * Update a product in $products list
	 *
	 * @param Product $product Product.
	 * @param Integer $qty Product quantity in number.
	 */
	public function update_product( Product $product, $qty = 1 ) {
		// Get product unique ID.
		$id = $product->get_id();

		if ( ! $id || ! isset( $this->products[ $id ] ) ) {
			return false;
		}

		if ( $qty > 0 ) {
			// Update product quantity and cart subtotal.
			$to_add_subtotal              = $product->get_price() * ( $qty - $this->products[ $id ]['qty'] );
			$this->subtotal               = $this->subtotal + $to_add_subtotal;
			$this->products[ $id ]['qty'] = intval( $qty );
		} elseif ( 0 === $qty ) {
			// Remove all product instances if quantity is 0.
			$this->remove_product( $product, $this->products[ $id ]['qty'] );
		}

		return true;
	}

	/**
	 * Remove a product from $products list
	 *
	 * @param Product $product Product.
	 * @param Integer $qty Product quantity to remove.
	 */
	public function remove_product( Product $product, $qty = 1 ) {

		// Get product unique ID.
		$id = $product->get_id();
		if ( ! $id ) {
			return false;
		}

		// Remove product action.
		if ( isset( $this->products[ $id ] ) ) {
			// Update subtotal before removing.
			$to_remove_subtotal           = $product->get_price() * $qty;
			$this->subtotal               = $this->subtotal - $to_remove_subtotal;
			$this->products[ $id ]['qty'] = $this->products[ $id ]['qty'] - $qty;
			// Remove product from list completely if quantity is 0.
			if ( 0 === $this->products[ $id ]['qty'] ) {
				unset( $this->products[ $id ] );
				// Recreate $ids list.
				$this->ids = empty( $this->products ) ? array() : array_keys( $this->products );
			}
		}
		return true;
	}

}
