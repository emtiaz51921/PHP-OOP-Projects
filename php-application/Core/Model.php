<?php
namespace Core;
use PDO;
use PDOException;
use App\Config;

/**
 * Controller Class
 *
 * PHP version 7.4
 */

abstract class Model {

    /**
     * Get PDO database connection
     *
     * @return mixed
     */
    protected static function getDB() {
        static $db = null;

        if ( $db == null ) {
            $db = new PDO( "mysql:host=" . config::DB_HOST . ";dbname=" . Config::DB_NAME . "", Config::DB_USER, Config::DB_PASSWORD );
            $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }

        return $db;

    }

}