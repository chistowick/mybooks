<?php

return array(
    // A page with publications and a page with a single publication
    '([\s\S]*)publications/articles/([0-9]{1,3})([\s\S]*)' => 'publications/getOneItem/$2',
    '([\s\S]*)publications/reviews/([0-9]{1,3})([\s\S]*)' => 'publications/getOneItem/$2',
    '([\s\S]*)publications([\s\S]*)' => 'publications/getList',
    
    // Pages with quotes
    '([\s\S]*)quotes/random-quotes([\s\S]*)' => 'quotes/getRandomQuotes',
    '([\s\S]*)quotes([\s\S]*)' => 'quotes/getFrontPage',
    
    // Pages - "what to read"
    '([\s\S]*)what-to-read/recommendations/by-genre([\s\S]*)' => 'whatToRead/getRecommendations/by-genre',
//    '([\s\S]*)what-to-read/recommendations/by-author([\s\S]*)' => 'whatToRead/getRecommendations/by-author',
    '([\s\S]*)what-to-read/by-genre([\s\S]*)' => 'whatToRead/getFrontPage/by-genre',
//    '([\s\S]*)what-to-read/by-author([\s\S]*)' => 'whatToRead/getFrontPage/by-author',
    '([\s\S]*)what-to-read([\s\S]*)' => 'whatToRead/getFrontPage/by-genre',
    
    // Page "about me"
    '([\s\S]*)about-me([\s\S]*)' => 'aboutMe/getFrontPage',
    
    
    '([\s\S]*)contacts([\s\S]*)' => 'contacts/getFrontPage',
    
    '([\s\S]*)index.php([\s\S]*)' => 'publications/getList',
    '[\s\S]+' => 'publications/getList',
    '[\s\S]*' => 'publications/getList',
);

//    'publications/([a-z]+)/([0-9]+)' => 'publications/getOneItem/$1/$2',