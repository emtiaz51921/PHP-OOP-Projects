<?php

require_once "Product.php";
require_once "Cart.php";
require_once "CartItem.php";

/**
 * Main index file
 */

/** Initiate products */
$product1 = new Product( 1, "iPhone12", 1500, 10 );
$product2 = new Product( 2, "M2 SSD", 500, 10 );
$product3 = new Product( 3, "Samsung Phone", 2000, 10 );

/** Initiate cart */
$cart = new Cart();
$cartItem1 = $cart->addProduct( $product1, 3 );
$cartItem2 = $product2->addToCart( $cart, 5 );

echo " New Cart \n";
echo "Number of product in cart: " . $cart->getTotalQuantity() . "\n";
echo "Total price of items is: " . $cart->getTotalSum() . "\n";

$cartItem1->increaseQuantity();
$cartItem2->decreaseQuantity();

echo "Cart increaseQuantity or decreaseQuantity \n";
echo "Number of product in cart: " . $cart->getTotalQuantity() . "\n";
echo "Total price of items is: " . $cart->getTotalSum() . "\n";

$cart->removeProduct( $product1 );

echo "Cart removeProduct \n";
echo "Number of product in cart: " . $cart->getTotalQuantity() . "\n";
echo "Total price of items is: " . $cart->getTotalSum() . "\n";