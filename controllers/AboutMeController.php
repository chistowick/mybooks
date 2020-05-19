<?php

// Connecting the Model
include_once (ROOT . '/models/AboutMe.php');

/**
 * AboutMeController accesses to the model "AboutMe.php"
 * and outputs "about me" page
 */
class AboutMeController {

    // Uses the model to get information "about_me" and outputs view
    public function actionGetFrontPage() {

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
