<?php
include_once ('curl.php');

/*
 * FUNSTARTAPI($file, $keywords)
 *
 * /Description
 *      This function starts the API algorithm
 *
 * /Arguments
 *      $file - is a string representing the website URL
 *
 *      $keywords - is a string representing all the keywords that should be tested
 *
 * /Return
 *      A string displaying the test done for all the URL's.
 *
 * */
function funStartAPI($file, $keywords){
    $result = "";
    ini_set('max_execution_time', 1500);
    $fileContent = json_decode(file_get_contents($file));

    $ch = funInitCurl();

    for($i=0; $i<count($fileContent); $i++){
        $url = $fileContent[$i]->url;
        $ch = funSetCurlPath($ch, $url);
        $result.=funCheckMarfeel($url, $keywords, $ch);
    }

    funCloseCurl($ch);
    die($result);
}

/*
 * FUNCHECKMARFEEL($path, $keywords, $ch)
 *
 * /Description
 *      This function check is the argument $path is a Marfeel site using the argument $keywords to do the test
 *
 * /Arguments
 *      $path - is a string representing the website URL
 *
 *      $keywords - is a string representing all the keywords that should be tested
 *
 *      $ch - is a CURL session
 *
 * /Return
 *      A string displaying the test done the argument $path.
 *
 * */
function funCheckMarfeel($path, $keywords, $ch){
    $htmlContent= funExecuteCurl($ch);
    $title = explode('title>',$htmlContent);

    if (isset($title[1])){
        $keys = explode(',',$keywords);

        for($i=0; $i<count($keys); $i++){
            if (strpos(strtolower($title[1]), $keys[$i]) !== false) {
                return "<p>The website ".$path." is a Marfeelizable site.</p>";
            } elseif ($i == (count($keys) - 1)){
                return "<p>The website ".$path." is not a Marfeelizable site.</p>";
            }
        }
    } else {
        return "<p>The website ".$path." is not a Marfeelizable site.</p>";
    }
}

