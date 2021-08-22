<?php

namespace app\core;

/**
 * Class Session
 *
 * @author Shamim <emtiaz51921@gmail.com>
 * @package app\core;
 */

class Session {

    protected const FLASH_KEY = 'flash_key';

    public function __construct() {

        session_start();

        $flashmessages = $_SESSION[self::FLASH_KEY] ?? [];

        foreach ( $flashmessages as $key => &$flashmessage ) {
            //Mark to be removed
            $flashmessage['remove'] = true;
        }

        $_SESSION[self::FLASH_KEY] = $flashmessages;

    }

    public function setFlash( $key, $message ) {

        $_SESSION[self::FLASH_KEY] = array();
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value'  => $message,
        ];

    }

    public function getFlash( $key ) {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public function set( $key, $value ) {
        $_SESSION[$key] = $value;
    }

    public function get( $key ) {
        return $_SESSION[$key] ?? false;
    }

    public function remove( $key ) {
        unset( $_SESSION[$key] );
    }

    public function __destruct() {

        //Iterate over all marked to be removed
        $flashmessages = $_SESSION[self::FLASH_KEY] ?? [];

        foreach ( $flashmessages as $key => &$flashmessage ) {

            if ( $flashmessage['remove'] ) {

                unset( $flashmessages[$key] );

            }

        }

        $_SESSION[self::FLASH_KEY] = $flashmessages;

    }

}