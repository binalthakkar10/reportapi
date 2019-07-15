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

$report->id = isset($_GET['id']) ? $_GET['id'] : "";
$stmt = $report->read();
$num = $stmt->rowCount();
 
if($num>0){
 
    $report_arr=array();
    $report_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);
 
        $report_item=array(
            "id" => $id,
            "title" => $title,
            "description" => html_entity_decode($description),
            "username" => $username,
            "timestamp" => $timestamp
        );
 
        array_push($report_arr["records"], $report_item);
    }
 
    http_response_code(200);
 
    echo json_encode($report_arr);
}
 
?>