<?php
function viewHotel()
{
    $json = file_get_contents("../php.json");
    $json = json_decode($json, true);
    $place = array_search($_GET['id'], array_column($json["hotels"], 'id'));
    if ($place or $place === 0) {
        die(json_encode([
            'status' => true,
            'hotel' => $json["hotels"][$place]
        ]));
    } else {
        die(json_encode([
            'status' => false,
            'hotels' => $json["hotels"]
        ]));
    }
}

viewHotel();
