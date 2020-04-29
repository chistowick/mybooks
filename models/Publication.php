<?php

/**
 * Model for getting list or single publication from database
 */
class Publication {
    
    // Returns one publication by id
    public static function getOnePublicationById($publication_id) {
        
        // Connecting to database
        $dbh = Database::getConnection();
        
        // Preparing and executing a request
        $sql = "SELECT * FROM tpublications WHERE id = ?";

        $pdostmt = $dbh->prepare($sql);
        $pdostmt->bindParam(1, $publication_id);
        $pdostmt->execute();

        $one_publication = $pdostmt->fetch(PDO::FETCH_ASSOC);
        
        return $one_publication;
    }
    
    public static function getPublicationsList() {
        
        // Connecting to database
        $dbh = Database::getConnection();
        
        // Preparing and executing a request
        $sql = "SELECT * FROM tpublications ORDER BY id DESC LIMIT 20";

        $pdostmt = $dbh->prepare($sql);
        $pdostmt->execute();

        $publications_list = array();

        // Filling an array with data from the pdo-statement
        $i = 0;
        
        while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)) {

            $publications_list[$i]['id'] = $row['id'];
            $publications_list[$i]['type'] = $row['type'];
            $publications_list[$i]['title'] = $row['title'];
            $publications_list[$i]['datestamp'] = $row['datestamp'];
            $publications_list[$i]['short_description'] = $row['short_description'];
            $publications_list[$i]['main_image'] = $row['main_image'];
            $publications_list[$i]['author'] = $row['author'];
            $publications_list[$i]['liked'] = $row['liked'];
            $publications_list[$i]['disliked'] = $row['disliked'];

            $i++;
        }
        
        return $publications_list;
    }
}
