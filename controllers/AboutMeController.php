<?php

/**
 * AboutMeController controls the page About me
 */
include_once (ROOT . '/models/AboutMe.php');

class AboutMeController {

    public function actionGetFrontPage() {

        $about_me = array();
        $about_me = AboutMe::getContentAboutMe();

        if (!$about_me) {
            echo "There should be a 'Page not found'";

            return true;
        }

        include_once (ROOT . '/views/pages/about_me_front_page.php');

        return true;
    }

}
