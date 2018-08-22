<?php
/**
 * Main Index
 *
 * @package  eCommerce
 * @author   Tu Luong <luongduc.tu1992@gmail.com>
 */

/**
 * Main application testing and playground.
 **/

require_once '../app/app.php';

// Assume product id is unique.
$ip_silver = new Product( 'P-IPSIL1', 'iPhone Silver', 'Silver', 999 );
$ip_black  = new Product( 'P-IPBLK2', 'iPhone Black', 'Black', 899 );

$user = new User( 'U-0001', 'John Doe 1', 'john.doe@example.com', null, 'GOLD' );
$cart = new Cart();
$cart->add_product( $ip_black );
$cart->update_product( $ip_black, 0 );
$cart->add_product( $ip_black );
$cart->add_product( $ip_black );
$cart->add_product( $ip_silver );

$promotion = new Promotion( date( 'Y-m-d', strtotime( '2018-08-20' ) ), date( 'Y-m-d', strtotime( '2018-08-30' ) ), 'GOLD', 'Black', 1500, 50 );

$discount = $promotion->cal_discount( $user );

echo $discount;
