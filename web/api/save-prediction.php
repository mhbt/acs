<?php
header("Content-type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Request: *");
$db = new mysqli('db5000267125.hosting-data.io','dbu244594','d23940EF%%',"dbs260683", 3306);
if ($db->connect_error) {
    die(json_encode(array(
        "error" => $db->connect_error
    )));
}else{
    $db->query("SET time_zone='+05:00';");
}
if(!empty($_FILES['picture']['name'])){
    $uploadStatus = false;
    $insert_id = null;
    $update_predictions = false;
    $uploadDir = "../plant-images/";
    $fileName = time().'_'. basename($_FILES['picture']['name']);
    $targetPath = "plant-images/". $fileName;
    
    //Upload file to server
    if(move_uploaded_file($_FILES['picture']['tmp_name'],  $uploadDir . $fileName)){
         $result = $db->query("INSERT INTO disease_data(image) Values('{$targetPath}')");
        if($result){
            $insert_id = $db->insert_id;
            $query = "UPDATE disease_data SET bacterial_blight = {$_POST['bacterial_blight']}, ";
            $query .= "bacterial_spot = {$_POST['bacterial_spot']}, ";
            $query .= "black_rot = {$_POST['black_rot']}, ";
            $query .= "mosaic_virus = {$_POST['mosaic_virus']}, ";
            $query .= "normal = {$_POST['normal']}, ";
            $query .= "powedry_mildew = {$_POST['powedry_mildew']}, ";
            $query .= "rust = {$_POST['rust']}, ";
            $query .= "scab = {$_POST['scab']} ";
            $query .= "WHERE id = {$insert_id}";
            echo $query;
            $result = $db->query($query);
            if($result){
                $update_predictions = true;
            }else{
                $update_predictions = false;
            }
            
        }else{
            $insert_id = null;
        }
        $uploadStatus = true;
    }
    else{
        $uploadStatus = false;
    }
    echo json_encode(array(
        "id" => $insert_id,
        "upload_status" => $uploadStatus,
        "save_predictions" => $update_predictions
    ));
    echo json_encode($_POST);
}else{
    echo json_encode(array(
        "error" => "Page didn't accepted your request"
    ));
    
}