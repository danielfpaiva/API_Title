<?php

/*
 * FUNINITCURL()
 *
 * /Description
 *      This function initializar a CURL session.
 *
 * /Arguments
 *      void
 *
 * /Return
 *      A CURL Session.
 * */
function funInitCurl(){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 20);

    return $ch;
}

/*
 * FUNSETCURLPATH($ch, $path)
 *
 * /Description
 *      This function set the CURLOPT_URL
 *
 * /Arguments
 *      $ch - is a CURL SESSION.
 *
 *      $path - is a string that contains a website URL
 *
 * /Return
 *      A CURL Session.
 * */
function funSetCurlPath($ch, $path){
    curl_setopt($ch, CURLOPT_URL, $path);

    return $ch;
}

/*
 * FUNEXECUTECURL($ch)
 *
 * /Description
 *      This function excutes the curl session
 *
 * /Arguments
 *      $ch - is a CURL SESSION.
 *
 * /Return
 *      A string that represents the website html
 * */
function funExecuteCurl($ch){
    return curl_exec($ch);

}

/*
 * FUNEXECUTECURL($ch)
 *
 * /Description
 *      This function close the CURL session
 *
 * /Arguments
 *      $ch - is a CURL SESSION.
 *
 * /Return
 *      void
 * */
function funCloseCurl($ch){
    curl_close($ch);

}