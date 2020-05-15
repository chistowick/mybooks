<?php

return array(
    // A page with publications and a page with a single publication
    'publications/([0-9]{1,3})' => 'publications/getOneItem/$1',
    'publications/([0-9]{1,3})' => 'publications/getOneItem/$1',
    'publications' => 'publications/getList',
    
    // Pages with quotes
    'quotes' => 'quotes/getFrontPage',
    
    // Pages - "what to read"
    'what-to-read' => 'whatToRead/getFrontPage',
    
    // Page "about me"
    'about-me' => 'aboutMe/getFrontPage',
    
    // Page "contacts"
    'contacts' => 'contacts/getFrontPage',
    
    // Main page
    'index.php' => 'publications/getList',
    '' => 'publications/getList',
);

//    'publications/([a-z]+)/([0-9]+)' => 'publications/getOneItem/$1/$2',