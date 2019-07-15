<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'db_connect.php';

include_once 'Report.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$report = new Report($connection);

$data = json_decode(file_get_contents("php://input"),true);

 
if(!empty($data['title']) && !empty($data['username']) &&!empty($data['description'])){

    $report->title = $data['title'];
    $report->username = $data['username'];
    $report->description = $data['description'];
    $report->timestamp = date('Y-m-d H:i:s');
 
    if($report->create()){
 
        http_response_code(201);
 
        echo json_encode(array("message" => "Report was created."));
    }else{
 
        http_response_code(503);
 
        echo json_encode(array("message" => "Unable to create report."));
    }
}
 
else{
 
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to create report. Data is incomplete."));
}
?>