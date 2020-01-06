<?php
    session_start();
    $_SESSION['logname'] = $_POST['logname'];
    if(!isset($_SESSION['logname'])){
        header('Location: login.html');
    }

// this script takes the team name to the database and redirects the page
	require 'config.php';
	//Assign the value from the registration page to the database
    //exit("here...");
    
	$username = $_POST['logname'];
	$password = $_POST['logpassword'];
	
	//Executing the insert statement to store the data into the database

    $userQueryString ='SELECT user_name, password FROM user_detail WHERE user_name=BINARY ?';
    
    //$userQueryString = "UPDATE `game` SET `gameid`= ?,`teama`= ?,`teamb`= ? WHERE gameid = 1";
    
    $queryHandle = $connect->prepare($userQueryString);
    $queryHandle->bindParam(1, $username);
    $queryHandle->execute();

    $row = $queryHandle->fetch();
            
    $dusername = $row['user_name'];
    $dpassword = $row['password'];
    if(password_verify($_POST['logpassword'],$row['password']))
    {
        $_SESSION['logname'] = $dusername;
        header('Location: Home.php');
        
    } else {
        echo 'Invalid username/ password '.$username.' : '.$password;
    }



?>

