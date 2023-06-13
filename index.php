<?php
$idOrders = 0;
$idCli = 0;

function addClient($idCli, $name, $surname, $phoneNumber, $email)
{
    $o = file_get_contents('php.json');
    $a = json_decode($o, true);
    $a['clients'][] = [
        'id' => ++$idCli,
        'name' => $name,
        'surname' => $surname,
        "phoneNumber" => $phoneNumber,
        "email" => $email
    ];
    $newJsonString = json_encode($a);
    file_put_contents('php.json', $newJsonString);
    die(json_encode([
        'status' => true,
        'clients' => $a["clients"],
        'idOrders' => $idCli
    ]));
}


function addOrders($idClient, $idOrders, $idRoom, $dateDeparture)
{
    $o = file_get_contents('php.json');
    $a = json_decode($o, true);
    if ($a["rooms"][$idRoom]["isVacant"] === false) {
        $a["rooms"][$idRoom]["isVacant"] = true;
        $a['orders'][] = [
            'id' => ++$idOrders,
            'arrivalDate' => date("d.m.Y"),
            'departureDate' => $dateDeparture,
            "room" => $a["rooms"][$idRoom]["id"],
            "cost" => $a["rooms"][$idRoom]["cost"]
        ];
        $newJsonString = json_encode($a);
        file_put_contents('php.json', $newJsonString);
        die(json_encode([
            'status' => true,
            'rooms' => $a["rooms"],
            'idOrders' => $idOrders
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
    $o = file_get_contents('../php.json');
    $a = json_decode($o, true);
    foreach ($a["orders"] as $props) {
        if (date($props["departureDate"]) == date("d.m.Y")) {
            $numberRooms = $props["room"];
            $a["rooms"][$numberRooms]["isVacant"] = false;
        }
    }
    $newJsonString = json_encode($a);
    file_put_contents('php.json', $newJsonString);
    die(json_encode([
        'status' => true,
        'rooms' => $a["rooms"],
    ]));
}


