<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$operationArray = ['addition', 'subtraction', 'division'];
$validRequestKeys = ['operation_type', 'x', 'y'];
$acceptedDataTypes = ['integer', 'double'];

// Takes raw data from the request
$json = file_get_contents('php://input');


// Converts it into a PHP object
$data = json_decode($json, true);

// collect the json request keys

$requestKeys = array_keys($data);

foreach ($requestKeys as $key => $requestKey) {
    # code...
    if(!in_array($requestKey, $validRequestKeys)){
        echo "invalid request key name ". $requestKey. " Request keys must be operation_type, x and y" ;
        return ;
    }
}

if(!in_array($data['operation_type'], $operationArray)){
    echo "invalid operation_type value ". $data['operation_type']. " operation_type value must be addition or  subtraction or division" ;
    return ;
}
if(!in_array(gettype($data['x']), $acceptedDataTypes) ){
    echo "invalid value for x ->". $data['x']. " value for x  must be integer or float" ;
    return ;
}

if(!in_array(gettype($data['y']), $acceptedDataTypes) ){
    echo "invalid value for y ->". $data['y']. " value for x  must be integer or float" ;
    return ;
}

try {
    //code...
    switch ($data['operation_type']) {
        case 'addition':
            # code...
            $result = $data['x'] + $data['y'];
            break;
        case 'subtraction':
            $result =  $data['x'] - $data['y'];
            break;
        case 'division':
            $result = $data['x'] / $data['y'];
            break; 
        default:
            # code...
            break;
    }

    $myResponse = [
        'slackUsername' => "AQIM",
        'operation_type' => $data['operation_type'],
        'result' => intval($result),
    ];

    $jsonResponse = json_encode($myResponse);
    http_response_code(200);
    echo ($jsonResponse);

} catch (DivisionByZeroError $th) {
    //throw $th;
    http_response_code(400);
    echo json_encode("Y cannot be Zero");
}
catch (ErrorException $th) {
    //throw $th;
    http_response_code(400);
    echo json_encode("Something went wrong. Try again");
}