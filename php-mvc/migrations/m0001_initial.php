<?php

class m0001_initial {

    public function up() {
        $db = \app\core\Application::$app->db;
        $sql = "
        CREATE TABLE users (
            id INT NOT NULL AUTO_INCREMENT,
            email VARCHAR(255) NOT NULL,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            status TINYINT NULL,
            created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        );
        ";
        $db->pdo->exec( $sql );
    }

    public function down() {
        $db = \app\core\Application::$app->db;
        $sql = "
        DROP TABLE users;
        ";
        $db->pdo->exec( $sql );
    }
}