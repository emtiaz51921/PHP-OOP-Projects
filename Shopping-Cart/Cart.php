<?php

class Cart {
    /**
     * @var CartItem[]
     */
    private array $items = [];

    /**
     * @return \CartItem[]
     */
    public function getItems() {
        return $this->items;
    }

    /**
     * @param \CartItem[] $items
     */
    public function setItems( $items ) {
        $this->items = $items;
    }

    /**
     * Add product $product into cart. If product already exist inside cart
     * it must update quantity.
     * This must create CartItem and return CartItem from method
     * $quantity must not become more then whatever
     * is $availablequantity of the product
     *
     * @param Product $product
     * @param int $quantity
     * @return \CartItem
     * @return \Exception
     */

    public function addProduct( Product $product, int $quantity ) {
        $cartItem = $this->findCartItem( $product->getId() );

        if ( $cartItem === null ) {
            $cartItem = new CartItem( $product, 0 );
            $this->items[$product->getId()] = $cartItem;
        }

        $cartItem->increaseQuantity( $quantity );

        return $cartItem;

    }

    /**
     * Find existing cart item
     *
     * @param integer $productId
     * @return void
     */
    private function findCartItem( int $productId ) {
        return $this->items[$productId] ?? null;
    }

    /**
     * Remove product from cart
     *
     * @param Product $product
     * @return void
     */
    public function removeProduct( Product $product ) {
        unset( $this->items[$product->getId()] );
    }

    /**
     * Get total cart quantity
     *
     * @return void
     */
    public function getTotalQuantity() {
        $sum = 0;

        foreach ( $this->items as $item ) {
            $sum += $item->getQuantity();
        }

        return $sum;

    }

    /**
     * Get total sum of the cart
     *
     * @return void
     */
    public function getTotalSum() {
        $totalSum = 0;

        foreach ( $this->items as $item ) {
            $totalSum += $item->getQuantity() * $item->getProduct()->getPrice();
        }

        return $totalSum;
    }

}