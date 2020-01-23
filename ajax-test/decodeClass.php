<?php

require("db.php");

function readJSON($mysqli){
	$json = file_get_contents("countries.json");
	$array = json_decode($json,TRUE);

	foreach ($array as $pais => $ciudades) {
		
		$queryInsert = "INSERT INTO `country`(`name`) VALUES ('$pais')";
		$result = $mysqli->query($queryInsert);

		if($result){
			$first = true;
			$id_city = $mysqli->insert_id;
			$queryCity = "INSERT INTO `city`(`id_country`,`name`) VALUES ";
			foreach ($ciudades as $ciudad) {
				if(!$first){
					$queryCity .= ", ('$id_city','$ciudad')";
				}
				else{
					$queryCity .= "('$id_city','$ciudad')";
					$first = false;
				}

			}
			$result = $mysqli->query($queryCity);
			if(!$result){
				echo $mysqli->error;
			}
		}
		else{
			echo $mysqli->error;
		}


	}

}

readJSON($mysqli);

?>