<?php

header('Content-Type: application/json');

/****** Curl function *******/
function curl_request($url)
{
    //  Initiate curl
    $ch = curl_init();
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set the url
    curl_setopt($ch, CURLOPT_URL, $url);
    // Execute
    $result = curl_exec($ch);
    // Closing
    curl_close($ch);

    return json_decode($result, true);
}
/****** END: Curl function *******/

/******** Candle light curl request **********/
function candlelight_curl($month = 1, $year = 1970)
{
    $candleLight = curl_request('https://www.hebcal.com/hebcal?v=1&cfg=json&maj=on&min=on&mod=on&nx=on&year=' . $year . '&month=' . $month . '&ss=on&mf=on&c=on&geo=geoname&geonameid=&m=&s=on&zip=33480');
    return $candleLight;
}
/******** END: Candle light curl request **********/

echo json_encode(candlelight_curl());
