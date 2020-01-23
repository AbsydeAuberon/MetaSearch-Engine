<?php

function getData(){
	$file = "countries.json";
	return json_decode(file_get_contents($file),TRUE);
}

function showForm($array){
	$web = "<html>
				<head>
					<title> Test JSON </title>
					<script src='parse.js'></script>
				</head>
				<body>
					<form action='' method='POST'>
						<label> Select a country </label>
						<select name='country' onchange='ajax(URLS.cities,\"country=\"+this.options[this.selectedIndex].value,populateSelect);'> 
							<option value='0'> Pick a country </option>";
	foreach ($array as $key => $value) {
		$web .= 			"<option value='{$key}'> {$key} </option>";
	}
	$web .= 			"</select>
						<br><label> Select a city </label>
						<select id='city' name='city'>
						</select> 
						<br><input type='submit'>
					</form>
					<div id='data'>
					</div>
				</body>
			</html>";

	echo $web;

}

$country = "";
if(isset($_POST['country']))
	$country = $_POST['country'];

$data = getData();

showForm($data);

if($country!=""){

	echo "<p> Cities for {$country} </p>";

	foreach ($data[$country] as $key => $value) {
		echo "<p> $value </p>";
	}

}

?>