<?php

/**
 * ContactsController partially checks the url's correctness 
 * and outputs "contacts" front page
 */
class ContactsController {

    // Output the start page of the tab with contacts
    public function actionGetFrontPage($empty = false) {

        // Validation of the entered url: If extra parameters were passed 
        // from the URL, it means that the address is incorrect
        if ($empty !== false) {
            return false;
        }

        // Connecting the view
        include_once (ROOT . '/views/pages/feedback.php');

        return true;
    }

}
