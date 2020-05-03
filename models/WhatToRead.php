<?php

/**
 * Model for getting list of all authors or recommendations from database
 */
class WhatToRead {

    // Returns a list of authors
    public static function getAuthorListForSelect() {

        // Connecting to database
        $dbh = Database::getConnection();

        // Preparing and executing a request
        $sql = "SELECT * FROM authors ORDER BY authorname";

        $pdostmt = $dbh->prepare($sql);
        $pdostmt->execute();

        $authors_list = array();
        
        $i = 0;

        while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)) {

            $authors_list[$i]['id'] = $row['id'];
            $authors_list[$i]['authorname'] = $row['authorname'];

            $i++;
        }

        return $authors_list;
    }

    // Returns a list of recommended books
    public static function getRecommendationsList($option) {


        // Connecting to database
        $dbh = Database::getConnection();

        $column_name = ($option == 'by-author') ? 'id_author' : 'id_genre' ;
        
        // Preparing and executing a request
        $sql = "SELECT * FROM books WHERE " . $column_name . " = ? "
                . "ORDER BY author, series, id";
        
        $pdostmt = $dbh->prepare($sql);
        $pdostmt->bindParam(1, $_POST[$column_name]);
        $pdostmt->execute();
        
        $recommendations_list = array();

        // Filling an array with data from the pdo-statement
        $i = 0;

        while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)) {

            $recommendations_list[$i]['author'] = $row['author'];
            $recommendations_list[$i]['book_name'] = $row['book_name'];
            $recommendations_list[$i]['series'] = $row['series'];

            $i++;
        }

        return $recommendations_list;
    }

}
