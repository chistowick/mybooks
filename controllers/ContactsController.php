<?php

/**
 * ContactsController controls the page "contacts"
 */

class ContactsController {

    public function actionGetFrontPage() {

        include_once (ROOT . '/views/pages/feedback.php');

        return true;
    }

}
