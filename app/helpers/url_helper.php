<?php
    //Simple page redirect
    function redirect($page){
        header('location: ' . URLROOT . '/' . $page);
    }

    function URL(){
        $url=rtrim($_GET['url'],'/');
        $url=filter_var($url,FILTER_SANITIZE_URL);
        return $url;
    }
?>