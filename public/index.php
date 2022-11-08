<?php

//require must be used instead of include because the router is essential for the framwork
require '../Core/router.php';

$router = new router;

//calling the add methods defined in the router 
$router->add('',['controller'=> 'Home','action'=>'index']);
$router->add('posts',['controller'=> 'Posts','action'=>'index']);
$router->add('posts/new',['controller'=> 'Posts','action'=>'new']);

// $_SERVER is a PHP super global variable which holds information about headers, paths, and script locations.
// $_SERVER['QUERY_STRING']	Returns the query string if the page is accessed via a query string

$url = $_SERVER['QUERY_STRING'];

if($router->match($url)){
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
}
else{
    echo 'NO route found';
}