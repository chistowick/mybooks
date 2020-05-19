<?php

/*
 * QuotesController outputs "quotes" front page
 */
class QuotesController {

    // Output the start page of the tab with quotes
    public function actionGetFrontPage() {

        // Connecting the view
        include_once (ROOT . '/views/pages/quotes_front_page.php');

        return true;
    }

}
