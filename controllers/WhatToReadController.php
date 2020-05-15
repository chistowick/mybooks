<?php

/**
 * WhatToReadController partially checks the url's correctness 
 * and outputs "what-to-read" front page
 */
class WhatToReadController {

    // Output the start page of the tab what-to-read
    public function actionGetFrontPage($empty = false) {

        // Validation of the entered url: If extra parameters were passed 
        // from the URL, it means that the address is incorrect
        if ($empty !== false) {
            return false;
        }

        // Connecting the view
        include_once (ROOT . '/views/pages/wtr_front_page.php');

        return true;
    }

}
