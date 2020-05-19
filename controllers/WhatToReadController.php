<?php

/**
 * WhatToReadController outputs "what-to-read" front page
 */
class WhatToReadController {

    // Output the start page of the tab what-to-read
    public function actionGetFrontPage() {

        // Connecting the view
        include_once (ROOT . '/views/pages/wtr_front_page.php');

        return true;
    }

}
