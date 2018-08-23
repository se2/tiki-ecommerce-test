<?php
/**
 * Promotion Class
 *
 * @category Model
 * @package  eCommerce
 * @author   Tu Luong <luongduc.tu1992@gmail.com>
 */

/**
 * Promotion Class Definition
 **/
class Promotion {

	/**
	 * Promotion start date
	 *
	 * @var String
	 */
	protected $date_from;

	/**
	 * Promotion end date
	 *
	 * @var String
	 */
	protected $date_to;

	/**
	 * Approved user's group
	 *
	 * @var Array
	 */
	protected $user_group;

	/**
	 * Approved product's color
	 *
	 * @var Array
	 */
	protected $color;

	/**
	 * Approved promotion's subtotal
	 *
	 * @var Integer
	 */
	protected $subtotal;

	/**
	 * Promotion discount
	 *
	 * @var Integer
	 */
	protected $discount;

	/**
	 * Constructor
	 *
	 * @param String       $date_from Promotion start date.
	 * @param String       $date_to Promotion end date.
	 * @param String|Array $user_group Promotion approved user's group.
	 * @param String|Array $color Promotion approved product's color.
	 * @param Integer      $subtotal Promotion approved subtotal.
	 * @param Integer      $discount Promotion approved discount.
	 */
	public function __construct( $date_from = null, $date_to = null, $user_group = array(), $color = array(), $subtotal = null, $discount = 0 ) {
		$this->date_from = $date_from;
		$this->date_to   = $date_to;
		$this->subtotal  = $subtotal;
		$this->discount  = $discount;
		if ( $this->date_to < $this->date_from ) {
			$this->date_to = $this->date_from;
		}
		if ( is_array( $user_group ) ) {
			$this->user_group = $user_group;
		} else {
			$this->user_group[] = $user_group;
		}
		if ( is_array( $color ) ) {
			$this->color = $color;
		} else {
			$this->color[] = $color;
		}
	}

	/**
	 * Promotion from date getter
	 */
	public function get_date_from() {
		return $this->date_from;
	}

	/**
	 * Promotion from date setter
	 *
	 * @param String $date_from Promotion date from.
	 */
	public function set_date_from( $date_from ) {
		if ( $date_from ) {
			$this->date_from = $date_from;
		}
	}

	/**
	 * Promotion to date getter
	 */
	public function get_date_to() {
		return $this->date_to;
	}

	/**
	 * Promotion to date setter
	 *
	 * @param String $date_to Promotion to date.
	 */
	public function set_date_to( $date_to ) {
		if ( $date_to ) {
			$this->date_to = $date_to;
		}
	}

	/**
	 * Promotion user's group getter
	 */
	public function get_user_group() {
		return $this->user_group;
	}

	/**
	 * Promotion user's group setter
	 *
	 * @param String|Array $user_group Promotion approved user's groups.
	 */
	public function set_user_group( $user_group ) {
		if ( $user_group ) {
			if ( is_array( $user_group ) ) {
				$this->user_group = $user_group;
			} else {
				$this->user_group[] = $user_group;
			}
		}
	}

	/**
	 * Promotion product's color getter
	 */
	public function get_color() {
		return $this->color;
	}

	/**
	 * Promotion product's color setter
	 *
	 * @param String|Array $color Promotion approved colors.
	 */
	public function set_color( $color ) {
		if ( $color ) {
			if ( is_array( $color ) ) {
				$this->color = $color;
			} else {
				$this->color[] = $color;
			}
		}
	}

	/**
	 * Promotion subtotal getter
	 */
	public function get_subtotal() {
		return $this->subtotal;
	}

	/**
	 * Promotion subtotal setter
	 *
	 * @param Integer $subtotal Cart subtotal.
	 */
	public function set_subtotal( $subtotal ) {
		if ( $subtotal ) {
			$this->subtotal = $subtotal;
		}
	}

	/**
	 * Promotion discount getter
	 */
	public function get_discount() {
		return $this->discount;
	}

	/**
	 * Promotion discount setter
	 *
	 * @param Integer $discount Cart discount.
	 */
	public function set_discount( $discount ) {
		if ( $discount ) {
			$this->discount = $discount;
		}
	}

	/**
	 * Promotion discount calculator
	 *
	 * @param User $user User.
	 */
	public function cal_discount( $user = null ) {
		if ( $user ) {
			$subtotal = 0;

			if ( ! in_array( $user->get_group(), $this->user_group, true ) ) {
				return 0;
			}
			// Validate today against promotion period.
			$today = time();
			if ( strtotime( $this->date_from ) <= $today && $today <= strtotime( $this->date_to ) ) {
				$products = $user->get_cart()->get_products();
				$ids      = $user->get_cart()->get_ids();
				// Iterate through each items in shooping cart associated with user.
				foreach ( $ids as $key => $id ) {
					$product = $products[ $id ]['product'];
					if ( in_array( $product->get_color(), $this->color, true ) ) {
						$subtotal = $subtotal + ( $product->get_price() * $products[ $id ]['qty'] );
					}
				}
				if ( $subtotal >= $this->subtotal ) {
					return $this->discount;
				}
			}
		}
		return 0;
	}

}
