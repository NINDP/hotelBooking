<?php
function viewRooms()
{
    $o = file_get_contents("../../php.json");
    $a = json_decode($o, true);
    $keys = array_keys(array_column($a["rooms"], 'hotel'), $_GET['idHotel']);
    if ($keys or $keys === 0) {
        foreach ($keys as $key) {
            $result[] = $a["rooms"][$key];
        }
    } else {
        die(json_encode([
            'status' => false,
            'rooms' => $a["rooms"]
        ]));
    }
    die(json_encode([
        'status' => true,
        'rooms' => $result
    ]));
}

viewRooms();
