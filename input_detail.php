<?php

// this script takes the team name to the database and redirects the page
	require 'config.php';
	//Assign the value from the registration page to the database
	
	$firstName = $_POST['firstname'];
	$lastName = $_POST['lastname'];
	$userName = $_POST['username'];
	$password = $_POST['password'];

	$hashedPassword = password_hash($password,PASSWORD_DEFAULT);

	$city = $_POST['city'];
	$state = $_POST['state'];
	$zipCode = $_POST['zipcode'];
	$age = $_POST['age'];

	$postfile = $__FILES['pdffile'] ['name'];

	$filePathPdf = 'profile_page/upload/'.$postfile;
	move_uploaded_file($__FILES['pdffile']['tmp_name'], $filePathPdf);
	



	//Executing the insert statement to store the data into the database

	$userQueryString = "INSERT INTO `user_detail`(`first_name`, `last_name`, `user_name`, `password`, `city`, `state`,`zip_code`, `age`)
	 VALUES (?,?,?,?,?,?,?,?)";
	//$userQueryString = "UPDATE `game` SET `gameid`= ?,`teama`= ?,`teamb`= ? WHERE gameid = 1";
	$queryHandle = $connect->prepare($userQueryString);
	$queryHandle->bindParam(1, $firstName);
	$queryHandle->bindParam(2, $lastName);
	$queryHandle->bindParam(3, $userName);
	$queryHandle->bindParam(4, $hashedPassword);
	$queryHandle->bindParam(5, $city);
	$queryHandle->bindParam(6, $state);
	$queryHandle->bindParam(7, $zipCode);
	$queryHandle->bindParam(8, $age);
	$queryHandle->execute();

	// redirect the page to displauyscoreboard
	header("Location: imageupload.html");
?>

