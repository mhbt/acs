<?php
header("Content-type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Request: *");
$intervals = ["day","week", "month", "year"];
$attrs = ["temperature", "humidity", "ph", "reservoir", "moisture", "npk"];
$query = "";
// $db = new mysqli('localhost','root','',"eciot");
$db = new mysqli('db5000267125.hosting-data.io','dbu244594','d23940EF%%',"dbs260683", 3306);
if ($db->connect_error) {
    die(json_encode(array(
        "error" => $db->connect_error
    )));
}else{
    $db->query("SET time_zone='+05:00';");
}

if(!isset($_GET["attr"], $_GET["period"], $_GET["interval"])){
    die(json_encode(array(
        "error" => "Invalid query parameter."
    )));
}
$attr = $db->real_escape_string($_GET["attr"]);
$period = $db->real_escape_string($_GET["period"]);
$interval = $db->real_escape_string($_GET["interval"]);
$period = explode("to", $period);
if(empty($period[1])){
    $period[1] = $period[0];
}
if(! in_array($interval, $intervals)){
    die(json_encode(array(
        "error" => "Interval can only be 'day', 'week', 'month', 'year'.",
        "interval-given" => $interval
    )));
}
$interval = strtoupper($interval);
if(! in_array($attr, $attrs)){
    die(json_encode(array(
        "error" => "Invalid attribute value."
    )));
}
if($interval == 'DAY'){
    if($attr == 'npk'){
        $query = "SELECT DATE_FORMAT(created_at, '%Y-%m-%d') as date, TRUNCATE(AVG(nitrogen),2) as nitrogen, TRUNCATE(AVG(phosphorous),2) as phosphorous, TRUNCATE(AVG(kalium),2) as kalium FROM datapoints WHERE created_at BETWEEN STR_TO_DATE('{$period[0]}', '%Y-%m-%d') AND DATE_ADD(STR_TO_DATE('{$period[1]}', '%Y-%m-%d'), INTERVAL 1 DAY) GROUP BY date";
    }else{
        $query = "SELECT DATE_FORMAT(created_at, '%Y-%m-%d') as date, TRUNCATE(AVG($attr),2) as $attr FROM datapoints WHERE created_at BETWEEN STR_TO_DATE('{$period[0]}', '%Y-%m-%d') AND DATE_ADD(STR_TO_DATE('{$period[1]}', '%Y-%m-%d'), INTERVAL 1 DAY)  GROUP BY date";

    }
}else if ($interval == 'WEEK'){
    if($attr == 'npk'){
        // $query = "SELECT DATE_FORMAT(created_at, '%Y-%m-%d %u') as date, TRUNCATE(AVG(nitrogen),2) as nitrogen, TRUNCATE(AVG(phosphorous),2) as phosphorous, TRUNCATE(AVG(kalium),2) as kalium FROM datapoints WHERE created_at BETWEEN STR_TO_DATE('{$period[0]}', '%Y-%m-%d') AND DATE_ADD(STR_TO_DATE('{$period[1]}', '%Y-%m-%d'), INTERVAL 1 MONTH)  GROUP BY date";
        $query = "SELECT DATE_FORMAT(created_at, '%Y W%u') as date, TRUNCATE(AVG(nitrogen),2) as nitrogen, TRUNCATE(AVG(phosphorous),2) as phosphorous, TRUNCATE(AVG(kalium),2) as kalium FROM datapoints WHERE created_at BETWEEN STR_TO_DATE('{$period[0]}', '%Y-%m-%d') AND DATE_ADD(STR_TO_DATE('{$period[1]}', '%Y-%m-%d'), INTERVAL 1 MONTH)  GROUP BY date";
    }else{
        // $query = "SELECT DATE_FORMAT(created_at, '%Y-%m-%d %u') as date, TRUNCATE(AVG($attr),2) as $attr FROM datapoints WHERE created_at BETWEEN STR_TO_DATE('{$period[0]}', '%Y-%m-%d') AND DATE_ADD(STR_TO_DATE('{$period[1]}', '%Y-%m-%d'), INTERVAL 1 MONTH)  GROUP BY date";
        $query = "SELECT DATE_FORMAT(created_at, '%Y W%u') as date, TRUNCATE(AVG($attr),2) as $attr FROM datapoints WHERE created_at BETWEEN STR_TO_DATE('{$period[0]}', '%Y-%m-%d') AND DATE_ADD(STR_TO_DATE('{$period[1]}', '%Y-%m-%d'), INTERVAL 1 MONTH)  GROUP BY date";


    }
}
else if ($interval == 'MONTH'){
    if($attr == 'npk'){
        $query = "SELECT DATE_FORMAT(created_at, '%Y-%m') as date, TRUNCATE(AVG(nitrogen),2) as nitrogen, TRUNCATE(AVG(phosphorous),2) as phosphorous, TRUNCATE(AVG(kalium),2) as kalium FROM datapoints WHERE created_at BETWEEN STR_TO_DATE('{$period[0]}', '%Y-%m-%d') AND DATE_ADD(STR_TO_DATE('{$period[1]}', '%Y-%m-%d'), INTERVAL 1 MONTH)  GROUP BY date";
    }else{
        $query = "SELECT DATE_FORMAT(created_at, '%Y-%m') as date, TRUNCATE(AVG($attr),2) as $attr FROM datapoints WHERE created_at BETWEEN STR_TO_DATE('{$period[0]}', '%Y-%m-%d') AND DATE_ADD(STR_TO_DATE('{$period[1]}', '%Y-%m-%d'), INTERVAL 1 MONTH)  GROUP BY date";

    }
}
else if ($interval == 'YEAR'){
    if($attr == 'npk'){
        $query = "SELECT DATE_FORMAT(created_at, '%Y') as date, TRUNCATE(AVG(nitrogen),2) as nitrogen, TRUNCATE(AVG(phosphorous),2) as phosphorous, TRUNCATE(AVG(kalium),2) as kalium FROM datapoints WHERE created_at BETWEEN STR_TO_DATE('{$period[0]}', '%Y-%m-%d') AND DATE_ADD(STR_TO_DATE('{$period[1]}', '%Y-%m-%d'), INTERVAL 1 YEAR)  GROUP BY date";
    }else{
        $query = "SELECT DATE_FORMAT(created_at, '%Y') as date, TRUNCATE(AVG($attr),2) as $attr FROM datapoints WHERE created_at BETWEEN STR_TO_DATE('{$period[0]}', '%Y-%m-%d') AND DATE_ADD(STR_TO_DATE('{$period[1]}', '%Y-%m-%d'), INTERVAL 1 YEAR)  GROUP BY date";

    }
}
$resource = $db->query($query);
$data = [];
if($resource){
    if($resource->num_rows){
        while($data_row = $resource->fetch_assoc()){
            $data[] = $data_row;
        }
    }
}
die(json_encode($data,1));
// die(json_encode(array(
//     "query" => $query
// )));
// $query = "SELECT created_at as `date`, AVG($attr) as $attr FROM datapoints WHERE DATE_FORMAT(created_at, '%Y-%m-%d %h:%m') BETWEEN DATE_FORMAT('{$period[0]}', '%Y-%m-%d %h:%m') AND DATE_FORMAT('{$period[1]}', '%Y-%m-%d') GROUP BY $interval(created_at)";
// echo $query;
