<?php

class CartItem {
    private Product $product;

    private int $quantity;

    /**
     * Cartitem constructor
     *
     * @param \Product $product
     * @param int $quantity
     */
    public function __construct( \Product $product, $quantity ) {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    /**
     * @return \Product
     */
    public function getProduct() {
        return $this->product;
    }

    /**
     * @return int
     */
    public function getQuantity() {
        return $this->quantity;
    }

    /**
     * @param \Product $product
     */
    public function setProduct( $product ) {
        $this->product = $product;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity( $quantity ) {
        $this->quantity = $quantity;
    }

    /**
     * Increase cart amount
     *
     * @param integer $amount
     * @return void
     */
    public function increaseQuantity( $amount = 1 ) {

        if ( $this->getQuantity() + $amount > $this->getProduct()->getAvailableQuantity() ) {
            throw new Exception( "Product quantity can\'t be more then " . $this->getProduct()->getAvailableQuantity() );
        }

        $this->quantity += $amount;
    }

    /**
     * Decrease cart amount
     *
     * @param integer $amount
     * @return void
     */
    public function decreaseQuantity( $amount = 1 ) {

        if ( $this->getQuantity() - $amount < 1 ) {
            throw new Exception( "Product quantity can\'t be less then 1" );
        }

        $this->quantity -= $amount;

    }

}