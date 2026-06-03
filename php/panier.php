<?php

    function getCart () {
        /* Returns the cart (an array of the form $item => $amount) */
        if (isset($_COOKIE['cart'])) {
            return json_decode($_COOKIE['cart'], true);
        } else {
            return array();
        }
    }

    function addItem ($item, $amount) {
        /* Adds an item to the cart */
        $cart = getCart();

        if (isset($cart[$item])) {
            $cart[$item] += $amount;
        } else {
            $cart[$item] = $amount;
        }

        setcookie('cart', json_encode($cart), time() + 60 * 60 * 24);
    }

    function resetCart () {
        /* Removes everything in the cart */
        setcookie('cart', '', time() - 1);
    }

?>
