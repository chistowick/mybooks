<?php

/**
 * QuotesController requests a set of random quotes from the database 
 * and outputs the start page of the tab with quotes
 */
class QuotesController {

    // Output the start page of the tab with quotes
    public function actionGetFrontPage() {

        include_once (ROOT . '/views/pages/quotes_front_page.php');

        return true;
    }

    // Requests a set of random quotes from the database
    public function actionGetRandomQuotes() {

        include_once (ROOT . '/models/Quote.php');

        $quotes_list = Quote::getRandomQuotes();

        if (!$quotes_list) {
            echo "There should be a 'Page not found'";

            return true;
        }

        include_once (ROOT . '/views/pages/quotes_random_quotes.php');

        return true;
    }

}
