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
// Add 2 products.
$ip_silver = new Product( 'P-IPSIL1', 'iPhone Silver', 'Silver', 999 );
$ip_black  = new Product( 'P-IPBLK2', 'iPhone Black', 'Black', 899 );

// Test case 1: disqualified for discount.
// Assume user id is unique.
// Create user John Doe.
$john = new User( 'U-0001', 'John Doe 1', 'john.doe@example.com', new Cart(), 'GOLD' );

// Create new helper instance.
$helper = new Helper();

// Sample cart actions.
$john->get_cart()->add_product( $ip_black );
$john->get_cart()->add_product( $ip_silver );
$john->get_cart()->add_product( $ip_silver );

// Create new promotion rule.
$date_from = date( 'Y-m-d', strtotime( '2018-08-20' ) );
$date_to   = date( 'Y-m-d', strtotime( '2018-08-30' ) );
$groups    = array( 'GOLD' );
$colors    = array( 'Black' );
$subtotal  = 1500;
$discount  = 50;
$promotion = new Promotion( $date_from, $date_to, $groups, $colors, $subtotal, $discount );

$helper->print_cart( $john, $promotion );

echo '<hr>';

// Test case 2: qualified for discount.
// Create user Janice Allen.
$janice = new User( 'U-0002', 'Janice Allen', 'janice.allen@example.com', new Cart(), 'SILVER' );

// Sample cart actions.
$janice->get_cart()->add_product( $ip_black );
$janice->get_cart()->add_product( $ip_black );
$janice->get_cart()->add_product( $ip_silver );

$promotion->set_user_group( 'SILVER' );

$helper->print_cart( $janice, $promotion );
