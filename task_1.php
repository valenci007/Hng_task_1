<?php

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
$myData = [
    "slackUsername" => "AQIM",
    "backend" => true,
    "age" => 30,
    "bio" => "My Name is Aqim I am a backend developer I graduated as a Mechanical Engineer but my love for problem solving made me want to be a programmer",
];

echo json_encode($myData, 200);

?>