<?php

/**
 * AboutMe - a model that gets content about me from a database
 */
class AboutMe {

    // Gets content about me from database
    public static function getContentAboutMe() {
        
        // Connecting to database
        $dbh = Database::getConnection();

        // Preparing and executing a request
        $sql = "SELECT text FROM tmain WHERE pagename = 'about'";

        $pdostmt = $dbh->prepare($sql);
        $pdostmt->execute();

        $about_me = $pdostmt->fetch(PDO::FETCH_ASSOC);

        return $about_me;
    }

}
