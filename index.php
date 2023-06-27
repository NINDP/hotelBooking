<?php
function addClient($name, $surname, $phoneNumber, $email)
{
    $json = file_get_contents('php.json');
    $json = json_decode($json, true);
    $json['clients'][] = [
        'id' => count($json['clients']) + 1,
        'name' => $name,
        'surname' => $surname,
        "phoneNumber" => $phoneNumber,
        "email" => $email
    ];
    $newJsonString = json_encode($json);
    file_put_contents('php.json', $newJsonString);
    die(json_encode([
        'status' => true,
        'clients' => $json["clients"]
    ]));
}


function addOrders($idClient, $idRoom, $dateDeparture)
{
    $json = file_get_contents('php.json');
    $json = json_decode($json, true);
    $keyRoom = array_search($idRoom, array_column($json["rooms"], 'id'));
    if ($json["rooms"][$keyRoom]["isVacant"] === false) {
        $json["rooms"][$keyRoom]["isVacant"] = true;
        $json['orders'][] = [
            'id' => count($json['orders']) + 1,
            'arrivalDate' => date("d.m.Y"),
            'departureDate' => $dateDeparture,
            "room" => $json["rooms"][$keyRoom]["id"],
            "cost" => $json["rooms"][$keyRoom]["cost"]
        ];
        $newJsonString = json_encode($json);
        file_put_contents('php.json', $newJsonString);
        die(json_encode([
            'status' => true,
            'rooms' => $json["rooms"],
        ]));

    } else {
        die(json_encode([
            'status' => false,
            'rooms' => $json["rooms"],
        ]));
    }
}

function changeVacant()
{
    $json = file_get_contents('./php.json');
    $json = json_decode($json, true);
    $keyOrder = array_search(date("d.m.Y"), array_column($json["orders"], 'departureDate'));
    if ($keyOrder or $keyOrder === 0) {
        $numberRooms = $json["orders"][$keyOrder]["room"];
        $keyRoom = array_search($numberRooms, array_column($json["rooms"], 'id'));
        $json["rooms"][$keyRoom]["isVacant"] = false;
    } else {
        die(json_encode([
            'status' => false,
            'rooms' => $json["rooms"],
        ]));
    }
    $newJsonString = json_encode($json);
    file_put_contents('php.json', $newJsonString);
    die(json_encode([
        'status' => true,
        'rooms' => $json["rooms"],
    ]));
}

changeVacant();
