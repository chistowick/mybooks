<?php

/**
 * WhatToReadController selects which selection page to show as the start page 
 * and initiates output of the user's query results
 */
include_once (ROOT . '/models/WhatToRead.php');

class WhatToReadController {

    // Getting a list of recommended books according to the user's request 
    public function actionGetRecommendations($by_option) {

        // If a post-request was received
        if (isset($_POST['what_to_read'])
                AND ( $_POST['what_to_read'] == 'request')) {

            $recommendations_list = WhatToRead::getRecommendationsList($by_option);

            include_once (ROOT . '/views/pages/wtr_recommendations_list.php');

            return true;
        }

        $this->actionGetFrontPage('by-genre');

        return true;
    }

    // Configuring the page for selecting query conditions
    public function actionGetFrontPage($by_option) {

        if ($by_option == 'by-author') {

            $author_list = WhatToRead::getAuthorListForSelect();

            include_once (ROOT . '/views/pages/wtr_selection_page_by_author.php');
        } else {

            include_once (ROOT . '/views/pages/wtr_selection_page_by_genre.php');
        }

        return true;
    }

}
