<?php

namespace app\core;

/**
 * Class Application
 *
 * @author Shamim <emtiaz51921@gmail.com>
 * @package app\core;
 */

class Response {

    /**
     * Set response code
     *
     * @param integer $code
     * @return void
     */
    public function setStatusCode( int $code ) {
        http_response_code( $code );
    }

    public function redirect( string $url ) {
        header( "Location: $url" );
    }
}