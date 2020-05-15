<?php

/*
 * QuotesController partially checks the url's correctness 
 * and outputs "quotes" front page
 */
class QuotesController {

    // Output the start page of the tab with quotes
    public function actionGetFrontPage($empty = false) {

        // Validation of the entered url: If extra parameters were passed 
        // from the URL, it means that the address is incorrect
        if ($empty !== false) {
            return false;
        }

        // Connecting the view
        include_once (ROOT . '/views/pages/quotes_front_page.php');

        return true;
    }

}
