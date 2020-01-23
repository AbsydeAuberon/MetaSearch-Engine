<?php

require("db.php");

function getCitiesAsJson($mysqli,$country){
	
	$sql = "SELECT city.id, city.name FROM country,city WHERE country.id = city.id_country AND country.name = ?";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("s",$country);
	$stmt->execute();
    $result = $stmt->get_result();

	if(!$result){
		echo $mysqli->error;
	}else{
		$json = [];
		while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $json[] = $row;
        }
    echo json_encode($json);    
	return json_encode($json);
	}
}

if(isset($_GET['country'])) {

	$country = mysqli_fix_string($mysqli,$_GET['country']);

	$data = getCitiesAsJson($mysqli,$country);
	//var_dump($data);
	header('Content-type: application/json');
	echo $data;
}


function mysqli_fix_string($mysqli, $string)
{
    if(get_magic_quotes_gpc())
    {
        $string = stripslashes($string);
    }

    return $mysqli->real_escape_string($string);
}

?>