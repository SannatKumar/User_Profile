<?php

  session_start();
  if(!isset($_SESSION['logname'])){
    exit('Direct access not Allowed.');
    
}
$validateusername = $_SESSION['logname'];  
// this script takes the team name to the database and redirects the page
  require 'config.php';
  require_once __DIR__.'/vendor/autoload.php';
  
  //Assign the value from the registration page to the database
	//$sessionusername = $_SESSION['username'];
	$userQueryString = "SELECT * FROM user_detail WHERE user_name = ?";
	$queryHandle = $connect->prepare($userQueryString);
	$queryHandle->bindParam(1,$validateusername);
	$queryHandle->execute();
	$row = $queryHandle->fetch();
	$firstname = $row['first_name'];
  $lastname= $row['last_name'];
  $username = $row['user_name'];
  $city = $row['city'];
  $state = $row['state'];
  $zip_code = $row['zip_code'];
  $age = $row['age'];


  //creating instance for pdf 

  $mpdf = new \Mpdf\Mpdf();

//create  pdf

$data = '';

$data .= '<h1> CURRICULUM VITAE</h1>';

//Add some more data

$data .= '<strong>First Name</strong> '. $firstname . '<br/>';
$data .= '<strong>Last Name</strong> '. $lastname . '<br/>';
$data .= '<strong>UserName</strong> '. $username . '<br/>';
$data .= '<strong>City Name</strong> '. $city . '<br/>';
$data .= '<strong>State Name</strong> '. $state . '<br/>';
$data .= '<strong>ZIP CODE Name</strong> '. $zip_code . '<br/>';
$data .= '<strong>Age</strong> '. $age . '<br/>';

//Writing PDF

$mpdf->WriteHTML($data);


// output to browser

$mpdf->Output('myfile.pdf', 'F');


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Home</title>
    <style>
    #header {
      text-align: center;
      background: skyblue;
      height: 150px;
  }
</style>
  </head>
  <body>
    <!-- UI header -->
    <header id="header">
      <h1 style="text-align: center;">Profile Page</h1>
      <div class="container">
          <div class="box">
              <div class="box-row">
                  <div class="box-cell box1">
                      
                      <h1>Create your own profile</h1>
                      
                  </div>
                  
                  </div>
              </div>
          </div>
  </header>
  
  
  <div class="alert alert-primary" role="alert">
    User Details
  </div>
      <!-- Table UI -->
      <div class="container px-lg-5">
        <div class="row mx-lg-n5">
            <div class="col py-3 px-lg-5 border bg-light">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">User Name</th>
                            <th scope="col">City</th>
                            <th scope="col">State</th>
                            <th scope="col">Zip Code</th>
                            <th scope="col">Age</th>                    
                        </tr>
                    </thead>
                    <tbody>
                  <?php
                        // php display team B data
                            echo '<tr>';
                            echo '<th scope="row">' . $firstname . '</th>';
                            echo '<td>' . $lastname . '</td>';
                            echo '<td>' . $username . '</td>';
                            echo '<td>' . $city . '</td>';
                            echo '<th scope="row">' . $state . '</th>';
                            echo '<td>' . $zip_code . '</td>';
                            echo '<td>' . $age. '</td>';
                            echo '</tr>';
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    

    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>