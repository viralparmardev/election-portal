<?php

//capturing form entry
$entry = (isset($_POST['entry']) ? $_POST['entry'] : null);

//sanitizing SQL query input for security
$choice = filter_input(INPUT_POST, 'choice', FILTER_SANITIZE_STRING);

//connecting to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voters";

// Create connection
$db_handle=mysqli_connect($servername, $username, $password, $dbname) or die(mysqli_error()) ;

//search results output
function displayResult($info)  
{ 
        echo "<div class='form-row'> <div class='col-md-3 mb-3'></div> <div class='col-md-3 mb-3'>";
        echo "<img  class='rounded' src=uploads/".$info['image'] .">
        </div> <div class='col-md-3 mb-3'>
        <div class='alert alert-primary' role='alert'>";
            echo "<b>Name: </b>".$info['fname']." ".$info['lname'] ;
            echo "<b> &nbsp; <u>ID: </b>" .$info['id'] ."</u>";
            echo "<b><br>Mobile: </b>" .$info['mobile'] ;
            echo "<b><br>City: </b>" .$info['city'] ;
            echo "<b><br>State: </b>" .$info['state'] ;
            echo "<b><br>Zip: </b>" .$info['zip'] ;
            echo "<b><br>Aadhar: </b>" .$info['aadhar'] ."
        </div></div></div>";
} 

//html formatted output
echo <<<EXCERPT

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Election Commission of India - Viral Parmar</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
    </head>

    <body>
        <!-- header -->
        <header class="header">
            <br>
            <h2 class="text-center"><a href="index.html" class="text-body">Election Commission of India</a></h2>
            <p class="text-center">This is an assignment project submitted for the Learning Ability Assessment</p>
            <br>
        </header>

        <!-- marquee -->
        <div class="bg-danger">
            <a href="https://eci.gov.in/uploads/monthly_2019_03/ge2019-map.jpg.a4db3ab0da89bfa732104faff1947518.jpg"
                target="_blank">
                <marquee>Don't forget to vote as per the schedule. Click here to note the voting date in your region.
                </marquee>
            </a>
        </div>
        <br>
        <h2 class="text-center">Search results</h2>
        <p class="text-center"> Absence of any result means that no matching profile was found.</p><br>
        <div class="container">
    
EXCERPT;

//writing results based on query selection
if ($choice == 'fnames') {
    $data = mysqli_query($db_handle, "SELECT * FROM people WHERE fname = '$entry'") or die(mysqli_error());
    while($info = mysqli_fetch_array( $data )) {
        displayResult($info);
    }
         
}
if ($choice == 'citys') {
    $data = mysqli_query($db_handle, "SELECT * FROM people WHERE city = '$entry'") or die(mysqli_error());
    while($info = mysqli_fetch_array( $data )) {
        displayResult($info);
    }
         
}
if ($choice == 'mobiles') {
    $data = mysqli_query($db_handle, "SELECT * FROM people WHERE mobile = '$entry'") or die(mysqli_error());
    while($info = mysqli_fetch_array( $data )) {
        displayResult($info);
    }
         
}
if ($choice == 'aadhars') {
    $data = mysqli_query($db_handle, "SELECT * FROM people WHERE aadhar = '$entry'") or die(mysqli_error());
    while($info = mysqli_fetch_array( $data )) {
        displayResult($info);
    }
         
}

//html formatted output
echo <<<EXCERPT
            </div>
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-primary" onclick="myFunction()">Back to home</button>
            </div>
            <br>
            <script>
            function myFunction() {
            location.href = "index.html";
            }
            </script>
        </div>
        <!-- emblem -->
        <div class="text-center">
            <img src="images/emblem.png" width="50px" class="img-responsive center-block" alt="Emblem">
            <br>
        </div>

        <br>
        <!-- marquee -->
        <div class="bg-success">
            <a href="https://eci.gov.in/" target="_blank">
                <marquee>Thank you for using your right to vote for the progress of the nation - Government of India.
                </marquee>
            </a>
        </div>

        <!-- footer -->
        <footer class="footer text-center text-muted">Created by <a href="https://viralparmar.ml" class="text-muted"
                target="_blank">Viral Parmar</a> for UpSkill programme
        </footer>

        <script src="js/bootstrap.js"></script>
    </body>

    </html>

EXCERPT;

?>