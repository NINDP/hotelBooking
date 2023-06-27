<?php
function viewHotel()
{
    $o = file_get_contents("../php.json");
    $a = json_decode($o, true);
    $place = array_search($_GET['id'], array_column($a["hotels"], 'id'));
    if ($place or $place === 0) {
        die(json_encode([
            'status' => true,
            'hotel' => $a["hotels"][$place]
        ]));
    } else {
        die(json_encode([
            'status' => false,
            'hotels' => $a["hotels"]
        ]));
    }
}

viewHotel();