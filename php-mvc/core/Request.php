<?php

namespace app\core;

/**
 * Class Application
 *
 * @author Shamim <emtiaz51921@gmail.com>
 * @package app\core;
 */

class Request {

    /**
     * This function returns the current path info
     *
     * @return string
     */
    public function getPath() {
        $path = $_SERVER['REQUEST_URI'] ?? false;
        $position = strpos( $path, '?' );

        if ( false === $position ) {
            return $path;
        }

        return substr( $path, 0, $position );
    }

    /**
     * This function return the request method as get or post
     *
     * @return string
     */
    public function method() {
        return strtolower( $_SERVER['REQUEST_METHOD'] );
    }

    public function isGet() {
        return $this->method() === 'get';
    }

    public function isPost() {
        return $this->method() === 'post';
    }

    /**
     * Get sanitize data
     *
     * @return string
     */
    public function getBody() {

        $body = [];

        if ( 'get' === $this->method() ) {

            foreach ( $_GET as $key => $value ) {
                $body[$key] = filter_input( INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS );
            }

        }

        if ( 'post' === $this->method() ) {

            foreach ( $_POST as $key => $value ) {
                $body[$key] = filter_input( INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS );
            }

        }

        return $body;

    }

}