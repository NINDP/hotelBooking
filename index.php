<?php
function addClient($name, $surname, $phoneNumber, $email)
{
    $o = file_get_contents('php.json');
    $a = json_decode($o, true);
    $a['clients'][] = [
        'id' => count($a['clients']) + 1,
        'name' => $name,
        'surname' => $surname,
        "phoneNumber" => $phoneNumber,
        "email" => $email
    ];
    $newJsonString = json_encode($a);
    file_put_contents('php.json', $newJsonString);
    die(json_encode([
        'status' => true,
        'clients' => $a["clients"]
    ]));
}


function addOrders($idClient, $idRoom, $dateDeparture)
{
    $o = file_get_contents('php.json');
    $a = json_decode($o, true);
    $keyRoom = array_search($idRoom, array_column($a["rooms"], 'id'));
    if ($a["rooms"][$keyRoom]["isVacant"] === false) {
        $a["rooms"][$keyRoom]["isVacant"] = true;
        $a['orders'][] = [
            'id' => count($a['orders']) + 1,
            'arrivalDate' => date("d.m.Y"),
            'departureDate' => $dateDeparture,
            "room" => $a["rooms"][$keyRoom]["id"],
            "cost" => $a["rooms"][$keyRoom]["cost"]
        ];
        $newJsonString = json_encode($a);
        file_put_contents('php.json', $newJsonString);
        die(json_encode([
            'status' => true,
            'rooms' => $a["rooms"],
        ]));

    } else {
        die(json_encode([
            'status' => false,
            'rooms' => $a["rooms"],
        ]));
    }
}

function changeVacant()
{
    $o = file_get_contents('./php.json');
    $a = json_decode($o, true);
    $keyOrder = array_search(date("d.m.Y"), array_column($a["orders"], 'departureDate'));
    if ($keyOrder or $keyOrder === 0) {
        $numberRooms = $a["orders"][$keyOrder]["room"];
        $keyRoom = array_search($numberRooms, array_column($a["rooms"], 'id'));
        $a["rooms"][$keyRoom]["isVacant"] = false;
    } else {
        die(json_encode([
            'status' => false,
            'rooms' => $a["rooms"],
        ]));
    }
    $newJsonString = json_encode($a);
    file_put_contents('php.json', $newJsonString);
    die(json_encode([
        'status' => true,
        'rooms' => $a["rooms"],
    ]));
}

changeVacant();