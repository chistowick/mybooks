<?php

/**
 * ContactsController outputs "contacts" front page
 */
class ContactsController {

    // Output the start page of the tab with contacts
    public function actionGetFrontPage() {

        // Connecting the view
        include_once (ROOT . '/views/pages/feedback.php');

        return true;
    }

}
