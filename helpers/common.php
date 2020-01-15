<?php 
session_start();
const BASE_URL = "https://mistorepro1013.000webhostapp.com/";
const ASSET_URL = BASE_URL . "public/assets/";

function displayStar($star)
{
    $decimalStar = fmod($star, 1.0);
    $wholeStar = floor($star);
    for ($i=0; $i < $wholeStar; $i++) { 
        echo '<a href="#" tabindex="0"><i class="zmdi zmdi-star"></i></a>';
    }
    if ($decimalStar < 0.25) {
        echo '<a href="#" tabindex="0"><i class="zmdi zmdi-star-outline"></i></a>';
    } elseif ($decimalStar <= 0.75) {
        echo '<a href="#" tabindex="0"><i class="zmdi zmdi-star-half"></i></a>';
    } else {
        echo '<a href="#" tabindex="0"><i class="zmdi zmdi-star"></i></a>';
    }
    $remainStar = 4 - $wholeStar;
    if ($remainStar != 0) {
        for ($i=0; $i < $remainStar; $i++) { 
            echo '<a href="#" tabindex="0"><i class="zmdi zmdi-star-outline"></i></a>';
        }
    } 
}
?>