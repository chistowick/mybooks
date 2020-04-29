<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return array(
    
    'publications/articles/([0-9]+)' => 'publications/getOneItem/$1',
    'publications/reviews/([0-9]+)' => 'publications/getOneItem/$1',
    'publications' => 'publications/getList',
    'index.php' => 'publications/getList',
    '' => 'publications/getList',
    
//    'publications/([a-z]+)/([0-9]+)' => 'publications/getOneItem/$1/$2',
);