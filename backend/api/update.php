<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/notes.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Notes($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = number_format($data->id);
    $item->text = $data->text;
    $item->date = $data->date;

    if($item->updateNotes()){
        echo json_encode("Note data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>