<?php
// required headers
header("Access-Control-Allow-Origin: *");
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
 
$report->id = $data['id'];
 
$report->title = $data['title'];
$report->description = $data['description'];
$report->username = $data['username'];
 
if($report->update()){
 
    http_response_code(200);
 
    echo json_encode(array("message" => "Report was updated."));
}
 
else{
 
    http_response_code(503);
 
    echo json_encode(array("message" => "Unable to update report."));
}
?>