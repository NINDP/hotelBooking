<?php

function viewHotels()
{
    $o = file_get_contents("../php.json");
    $a = json_decode($o, true);
    foreach ($a["hotels"] as $k) {
        echo '<h1>' . $k["name"] . '</h1>';
        echo '<p>' . $k["address"] . '</p>';
        echo '<p>' . $k["number"] . '</p>';
    }
}

viewHotels();