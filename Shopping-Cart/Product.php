<?php

class Product {

    private int $id;
    private float $price;
    private string $title;
    private int $availableQuantity;

    /**
     * Product constructor
     *
     * @param int $id
     * @param string  $title
     * @param float $price
     * @param int $availableQuantity
     */
    public function __construct(
        $id,
        $title,
        $price,
        $availableQuantity
    ) {

        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->availableQuantity = $availableQuantity;
    }

    /**
     * @return int
     */
    public function getAvailableQuantity() {
        return $this->availableQuantity;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param int $availableQuantity
     */
    public function setAvailableQuantity( $availableQuantity ) {
        $this->availableQuantity = $availableQuantity;
    }

    /**
     * @param int $id
     */
    public function setID( $id ) {
        $this->id = $id;
    }

    /**
     * @param float $price
     */
    public function setPrice( $price ) {
        $this->price = $price;
    }

    /**
     * @param  string  $title
     */
    public function setTitle( $title ) {
        $this->title = $title;
    }

    /**
     * Add Product $product into cart. If product already exist inside cart
     * it must update quantity.
     * This must create CartItem and return CartItem from method
     *
     * @param Cart $cart
     * @param integer $quantity
     * @return \CartItem
     * @return \Exception
     */
    public function addToCart( Cart $cart, int $quantity ) {
        return $cart->addProduct( $this, $quantity );
    }

    /**
     * Remove product from cart
     *
     * @param Cart $cart
     * @return void
     */
    public function removeFromCart( Cart $cart ) {
        return $cart->removeProduct( $this );
    }
}