<?php

function viewRooms($idHotel)
{
    $o = file_get_contents("../../php.json");
    $a = json_decode($o, true);
    foreach ($a["rooms"] as $k) {
        if($k["hotel"] == $idHotel){
            echo '<h1>' . $k["roomNumber"] . '</h1>';
            echo '<p>' . $k["location"] . '</p>';
            if($k["isVacant"]){
                echo '<p>' . "Комната занята" . '</p>';
            }
            else{
                echo '<p>' . "Комната свободна" . '</p>';
            }
            echo '<p>' . $k["cost"] . '</p>';
        }
    }
}

viewRooms(2);