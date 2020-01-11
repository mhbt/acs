<?php
header("Content-type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Request: *");
$keys = ["temperature", "humidity", "ph", "reservoir", "moisture", "created_by"];
$data_keys = [];
if(! isset($_POST["acs_data"])){
    die(json_encode(array(
        "error" => "Invalid API request."
    )));
}
// $db = new mysqli('localhost','root','',"eciot");
$db = new mysqli('db5000267125.hosting-data.io','dbu244594','d23940EF%%',"dbs260683", 3306);
if ($db->connect_error) {
    die(json_encode(array(
        "error" => "Database Initialization Failed. Contact Network Administrator."
    )));
}else{
    $db->query("SET time_zone='+05:00';");
}
// echo $_POST["eciot_data"];
$data = json_decode(stripcslashes($_POST["acs_data"]), true);
if(! $data){
    die(json_encode(array(
        "error" => "JSON Initialization Failed. Contact Developers."
    )));
}
// var_dump($data);
foreach ($data as $key => $value){
    $data[$key] = $db->real_escape_string($value);
} 
foreach($data as $key => $value){
    if(! in_array($key, $keys)){
        die(json_encode(array(
            "error" => "Bad Data Key: '{$key}'"
        )));
    }
    $data_keys[] = $key;
}
foreach($keys as $test_key){
   if (! in_array($test_key, $data_keys)){
    die(json_encode(array(
        "error" => "Data Key Missing: $test_key"
    )));
   }
}
//https://www.allotment-garden.org/composts-fertilisers/effects-ph-nutrient-availability/
if ($data["ph"] >= 1 && $data["ph"] < 5){
    $data["nitrogen"] = 30;
    $data["phosphorous"] = 20;
    $data["kalium"] = 50;
}
else if ($data["ph"] >= 5 && $data["ph"] < 5.5){
    $data["nitrogen"] = 40;
    $data["phosphorous"] = 35;
    $data["kalium"] = 50;
}
else if ($data["ph"] >= 5.5 && $data["ph"] < 6){
    $data["nitrogen"] = 70;
    $data["phosphorous"] = 45;
    $data["kalium"] = 70;
}
else if ($data["ph"] >= 6 && $data["ph"] < 7){
    $data["nitrogen"] = 85;
    $data["phosphorous"] = 55;
    $data["kalium"] = 100;
}
else if ($data["ph"] >= 7 && $data["ph"] < 7.5){
    $data["nitrogen"] = 100;
    $data["phosphorous"] = 100;
    $data["kalium"] = 100;
}
else if ($data["ph"] >= 7.5 && $data["ph"] < 8){
    $data["nitrogen"] = 85;
    $data["phosphorous"] = 55;
    $data["kalium"] = 70;
}
else if ($data["ph"] >= 8 && $data["ph"] < 9){
    $data["nitrogen"] = 70;
    $data["phosphorous"] = 45;
    $data["kalium"] = 70;
}
else {
    $data["nitrogen"] = 0;
    $data["phosphorous"] = 0;
    $data["kalium"] = 0;
}

$query = "INSERT INTO datapoints (temperature, humidity, ph, reservoir, nitrogen, phosphorous, kalium, moisture, created_at, created_by) ";
$query .="VALUES({$data['temperature']}, {$data['humidity']}, {$data['ph']}, {$data['reservoir']},{$data['nitrogen']}, {$data['phosphorous']}, {$data['kalium']}, {$data['moisture']}, now(), '{$data['created_by']}')";
echo json_encode($query);
$result = $db->query($query);

if(!$result){
    die(json_encode(array(
        "error" => "Bad Query"
    )));
}
die(json_encode(array(
    "payload" => $result
)));
