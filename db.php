<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	// Create database --------------------------------------------------------
	$sql = "CREATE DATABASE IF NOT EXISTS chart";

	if (mysqli_query($conn, $sql)) {
	    echo "Database created successfully<br>";
	} else {
	    echo "Error creating database: " . mysqli_error($conn) . "<br>";
	}

	$dbname = 'chart';
	mysqli_select_db ( $conn , $dbname);

	if (!$conn) {
	    die("select chart connection failed: " . mysqli_connect_error());
	}

	//create accelaration table --------------------------------------------------
	$sql = "CREATE TABLE IF NOT EXISTS `chart_data` (
	  `mylabel` VARCHAR(50) NOT NULL,
	  `myvalue` VARCHAR(50) NOT NULL,
	  `ID` INT NOT NULL AUTO_INCREMENT,
	  PRIMARY KEY (`ID`))";

	if(mysqli_query($conn, $sql)){
	    echo "Table accelaration created successfully<br>";
	} else {
	    echo "Error creating accelaration table: " . mysqli_error($conn). "<br>";
	}
	
	$query = "INSERT INTO `chart_data` (`ID`, `mylabel`, `myvalue`) VALUES (NULL, 'Label 1', '33.55'";
	
	$conn->query($query);
	mysqli_close($conn);
?>