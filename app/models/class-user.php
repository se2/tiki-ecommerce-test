<?php
/**
 * User Class
 *
 * @category Model
 * @package  eCommerce
 * @author   Tu Luong <luongduc.tu1992@gmail.com>
 */

/**
 * User Class Definition
 **/
class User {

	/**
	 * Predefined user's groups
	 *
	 * @var Array
	 */
	protected $groups = array( 'UNREGISTER', 'REGISTER', 'SILVER', 'GOLD' );

	/**
	 * User unique ID
	 *
	 * @var String
	 */
	protected $id;

	/**
	 * User Name
	 *
	 * @var String
	 */
	protected $name;

	/**
	 * User Email
	 *
	 * @var String
	 */
	protected $email;

	/**
	 * User Shopping Cart object
	 *
	 * @var Cart Associated shopping cart
	 */
	protected $cart;

	/**
	 * User Group
	 *
	 * @var String User's group, values must be UNREGISTER, REGISTER, SILVER, or GOLD
	 */
	protected $group;

	/**
	 * Constructor
	 *
	 * @param String $id User id.
	 * @param String $name User name.
	 * @param String $email User email.
	 * @param Cart   $cart User shopping cart.
	 * @param String $group User group.
	 */
	public function __construct( $id = null, $name = null, $email = null, $cart = null, $group = 'UNREGISTER' ) {
		$this->id    = $id;
		$this->name  = $name;
		$this->email = $email;
		$this->cart  = $cart ? $cart : new Cart();
		$this->cart->set_user_id( $this->get_id() );
		$this->group = in_array( $group, $this->groups, true ) ? $group : 'UNREGISTER';
	}

	/**
	 * User groups getter
	 */
	public function get_groups() {
		return $this->groups;
	}

	/**
	 * User ID getter
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * User ID setter
	 *
	 * @param String $id User id.
	 */
	public function set_id( $id ) {
		if ( $id ) {
			$this->id = $id;
		}
	}

	/**
	 * User Name getter
	 */
	public function get_name() {
		return $this->name;
	}

	/**
	 * User Name setter
	 *
	 * @param String $name User name.
	 */
	public function set_name( $name ) {
		if ( $name ) {
			$this->name = $name;
		}
	}

	/**
	 * User Email getter
	 */
	public function get_email() {
		return $this->email;
	}

	/**
	 * User Email setter
	 *
	 * @param String $email User email.
	 */
	public function set_email( $email ) {
		if ( $email ) {
			$this->email = $email;
		}
	}

	/**
	 * User Group getter
	 */
	public function get_group() {
		return $this->group;
	}

	/**
	 * User Group setter
	 *
	 * @param String $group User group.
	 */
	public function set_group( $group ) {
		if ( $group ) {
			$this->group = $group;
		}
	}

	/**
	 * User Cart getter
	 */
	public function get_cart() {
		if ( ! $this->cart ) {
			return new Cart();
		}
		return $this->cart;
	}

	/**
	 * User Cart setter
	 *
	 * @param String $cart User cart.
	 */
	public function set_cart( $cart ) {
		if ( $cart ) {
			$this->cart = $cart;
			$this->cart->set_user_id( $this->get_id() );
		}
	}

}
