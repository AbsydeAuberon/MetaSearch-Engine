<?php

require_once("db.php");

//set content type: text/json
header("Content-Type: text/json");

$dbhandle = mysql_connect("localhost","root","password") or die("Unable to connect to MySQL");

//select a database to work with
$selected = mysql_select_db("info",$dbhandle) or die("Could not select examples");

$result = mysql_query("SELECT * FROM students");

if(mysql_num_rows($result)>0){
    $rows=array();
    while($row = mysql_fetch_assoc($result))
    {
        $rows[]=$row;
    }
    echo json_encode(array("success"=>$rows));
}else{
    echo json_encode(array("error"=>"No records found."));
}
exit;

?>