<?php
/**
 * Product Class
 *
 * @category Model
 * @package  eCommerce
 * @author   Tu Luong <luongduc.tu1992@gmail.com>
 */

/**
 * Product Class Definition
 **/
class Product {

	/**
	 * Product unique ID
	 *
	 * @var String
	 */
	protected $id;

	/**
	 * Product Name
	 *
	 * @var String
	 */
	protected $name;

	/**
	 * Product Color
	 *
	 * @var String
	 */
	protected $color;

	/**
	 * Product Price
	 *
	 * @var String
	 */
	protected $price;

	/**
	 * Constructor
	 *
	 * @param String  $id Product id.
	 * @param String  $name Product name.
	 * @param String  $color Product color.
	 * @param Integer $price Product price.
	 */
	public function __construct( $id = null, $name = null, $color = null, $price = 0 ) {
		$this->id    = $id;
		$this->name  = $name;
		$this->color = $color;
		$this->price = $price;
	}

	/**
	 * Product ID getter
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Product ID setter
	 *
	 * @param String $id Product id.
	 */
	public function set_id( $id ) {
		if ( $id ) {
			$this->id = $id;
		}
	}

	/**
	 * Product Name getter
	 */
	public function get_name() {
		return $this->name;
	}

	/**
	 * Product Name setter
	 *
	 * @param String $name Product name.
	 */
	public function set_name( $name ) {
		if ( $name ) {
			$this->name = $name;
		}
	}

	/**
	 * Product Color getter
	 */
	public function get_color() {
		return $this->color;
	}

	/**
	 * Product Color setter
	 *
	 * @param String $color Product color.
	 */
	public function set_color( $color ) {
		if ( $color ) {
			$this->color = $color;
		}
	}

	/**
	 * Product Price getter
	 */
	public function get_price() {
		return $this->price;
	}

	/**
	 * Product Price setter
	 *
	 * @param Integer $price Product price.
	 */
	public function set_price( $price ) {
		if ( $price ) {
			$this->price = $price;
		}
	}

}
