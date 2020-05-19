<?php

// Connecting the Model
include_once (ROOT . '/models/Publication.php');

/*
 * PublicationsController 
 * accesses to the model "Publication.php" to access the database for getting 
 * information about publications 
 * and connects the front page view
 */

class PublicationsController {

    // Uses the model to get a list of the 20 most recent publications
    public function actionGetList() {

        $publications_list = array();
        $publications_list = Publication::getPublicationsList();

        // If the $publications_list is empty
        if (!$publications_list) {
            return false;
        }

        // Connecting the view
        include_once (ROOT . '/views/pages/publications_list.php');

        return true;
    }

    // Uses the model to get a single publication
    public function actionGetOneItem($id) {

        $one_publication = Publication::getOnePublicationById($id);

        // if the responce is empty
        if (!$one_publication) {
            return false;
        }

        // Connecting the view
        include_once (ROOT . '/views/pages/one_publication.php');

        return true;
    }

}
