<?php

// Connecting the Model
include_once (ROOT . '/models/AboutMe.php');

/**
 * AboutMeController partially checks the url's correctness, 
 * accesses to the model "AboutMe.php"
 * and outputs "about me" page
 */
class AboutMeController {

    // Uses the model to get information "about_me" and outputs view
    public function actionGetFrontPage($empty = false) {

        // Validation of the entered url: If extra parameters were passed 
        // from the URL, it means that the address is incorrect
        if ($empty !== false) {
            return false;
        }

        $about_me = array();
        $about_me = AboutMe::getContentAboutMe();

        // If the $about_me is empty
        if (!$about_me) {
            return false;
        }

        // Connecting the view
        include_once (ROOT . '/views/pages/about_me_front_page.php');

        return true;
    }

}
