<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function convertCurrency($amount, $to) {
    $url = "https://www.google.com/finance/converter?a=$amount&from=GBP&to=$to";
    $data = file_get_contents($url);
    preg_match("/<span class=bld>(.*)<\/span>/", $data, $converted);
    $converted = preg_replace("/[^0-9.]/", "", $converted[0]);
    return round($converted, 3);
}
//print_r(convertCurrency(12, "USD", "EUR"));

function convertedRateToDollar($amount){
    return convertCurrency($amount, "GBP","USD");
}

function convertedEuro($amount){
    return convertCurrency($amount, "GBP", "EUR");  
}

function convertedPound($amount){
    return convertCurrency($amount, "GBP", "GBP");  
}
