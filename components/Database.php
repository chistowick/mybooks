<?php

/**
 * Database - connects to the database with parameters 
 * from the file the path to which is passed in the $path_to_config variable 
 * and returns the database handler.
 */
class Database {

    // Connecting to database and return database handler
    public static function getConnection() {

        // Determining the path to the configuration file
        $path_to_config = $_SERVER["DOCUMENT_ROOT"] . '/../htconfig/dbconnect.php';

        // Connecting database config
        include ($path_to_config);

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
