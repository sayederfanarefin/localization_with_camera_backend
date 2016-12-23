<?php 

require_once("config.php");
require_once("db.php");

$operation = $_POST["op"];
$table = $_POST["table"];

if($operation != "insert"){
	$column1 = $_POST["column1"];
	$column1value = $_POST["column1value"];
	$column2 = null;
	$column2value = null;

	if(isset($_POST["column2"]) && isset($_POST["column2value"])){
		$column2 = $_POST["column2"];
		$column2value = $_POST["column2value"];
	}

	openConnection(DB_SERVER, DB_USER, DB_PASSWORD, DB_DBNAME);

	$sql2 = "select * FROM ".$table." WHERE ". $column1 . " = ".column1value;

	if($column2 != NULL){
    	$sql2 .=  " AND ". $column2. " = " . $column2value;
	}	
    $result_data = fetch_multiple_result($sql2);
    echo json_encode($result_data);

}else{
	$values = $_POST["values"];
	openConnection(DB_SERVER, DB_USER, DB_PASSWORD, DB_DBNAME);
	$sql = "INSERT INTO ".$table. "VALUES (".$values.")";
	perform_query($sql);
}

?>