<?php

include_once (ROOT . '/models/Publication.php');

/**
 * Description of PublicationsController
 *
 */
class PublicationsController {


    // Uses the model to get a list of the 20 most recent publications
    public function actionGetList() {

        $publications_list = array();
        $publications_list = Publication::getPublicationsList();

        if (!$publications_list) {
            echo "There should be a 'Page not found'";
        }

        include_once (ROOT . '/views/pages/publications_list.php');

        return true;
    }

    // Uses the model to get a single publication
    public function actionGetOneItem($id) {

        if ($id) {
            $one_publication = Publication::getOnePublicationById($id);
        }

        if (!$one_publication) {
            echo "There should be a 'Page not found'";
        }

        include_once (ROOT . '/views/pages/one_publication.php');
        
        return true;
    }

}
