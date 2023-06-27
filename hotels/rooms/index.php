<?php
function viewRooms()
{
    $json = file_get_contents("../../php.json");
    $json = json_decode($json, true);
    $keys = array_keys(array_column($json["rooms"], 'hotel'), $_GET['idHotel']);
    if ($keys or $keys === 0) {
        foreach ($keys as $key) {
            $result[] = $json["rooms"][$key];
        }
    } else {
        die(json_encode([
            'status' => false,
            'rooms' => $json["rooms"]
        ]));
    }
    die(json_encode([
        'status' => true,
        'rooms' => $result
    ]));
}

viewRooms();
