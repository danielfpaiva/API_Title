<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];

// validate the server method that is sent the request
if($requestMethod == 'GET'){
    if(isset($_GET['filename'])){
        ini_set('max_execution_time', 3600);
        $file_content = json_decode(file_get_contents($_GET['filename']));
        $result = "";

        for($i=0; $i<count($file_content); $i++){
            $url = $file_content[$i]->url;
            $result.=funCheckMarfeel($url);
        }
        echo $result;
    }
} else {
    die("The request is not using the correct method.");
}

/*
 * FUNCHECKMARFEEL($path)
 *
 * /Description
 *      This function checks if the argument $path is a Marfeel site.
 *
 * /Arguments
 *      $path - is a string that contains a website URL
 *
 * /Return
 *      A string displaying the result to all the URL's.
 * */
function funCheckMarfeel($path){
    $ch= curl_init();
    curl_setopt ($ch, CURLOPT_URL, $path );
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch,CURLOPT_VERBOSE,1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)');
    //curl_setopt ($ch, CURLOPT_REFERER,'http://www.google.com');  //just a fake referer
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,CURLOPT_POST,0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 20);

    $htmlContent= curl_exec($ch);

    $title = explode('title>',$htmlContent);
    if (isset($title[1])){
        if (strpos(strtolower($title[1]), 'news') !== false || strpos(strtolower($title[1]), 'noticias') !== false) {

            return "<p>The website ".$path." is a Marfeelizable site.</p>";
        } else {
            return "<p>The website ".$path." is not a Marfeelizable site.</p>";
        }
    } else {
        return "<p>The website ".$path." is not a Marfeelizable site.</p>";
    }
    curl_close($ch);
}

