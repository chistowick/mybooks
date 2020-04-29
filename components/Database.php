<?php

/**
 * Description of Database
 */
class Database {

    // Connecting to database and return database handler
    public static function getConnection() {

        // Connecting database config
        include ('../htconfig/dbconnect.php');

        try {
            // Creating a database handler  
            $dbh = new PDO($dsn, $userName, $password);
        } catch (PDOException $e) { // Catch exceptions
            echo "Error!:" . $e->getMessage();
            die();
        }

        return $dbh;
    }

}
