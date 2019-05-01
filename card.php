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

//voter id data output
function displayResult($info)  
{ 
        echo "<img  class='rounded' src=uploads/".$info['image'] .">
        <br><br>
        <div class='alert alert-primary' role='alert'>";
            echo "<b>Name: </b>".$info['fname']." ".$info['lname'] ;
            echo "<b> &nbsp; <u>ID: </b>" .$info['id'] ."</u>";
            echo "<b><br>Mobile: </b>" .$info['mobile'] ;
            echo "<b><br>City: </b>" .$info['city'] ;
            echo "<b><br>State: </b>" .$info['state'] ;
            echo "<b><br>Zip: </b>" .$info['zip'] ;
            echo "<b><br>Aadhar: </b>" .$info['aadhar'] ."
        </div>";
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
        <br>
        <h2 class="text-center">Voter ID Card</h2>
        <p class="text-center">Absense of your voter ID card indicates entry of incorrect details</p>
        <div class="container">
        <div id="v">
            <div class="form-row">
                <div class="col-md-4 mb-3"></div>
                <div class="col-md-4 mb-3">
                <div class='alert alert-primary text-center' role='alert'>
                    <b>Election Commission of India</b>
                    <br>Voter ID
                </div>

EXCERPT;

//writing results based on query selection
if ($choice == 'ids') {
    $data = mysqli_query($db_handle, "SELECT * FROM people WHERE id = '$entry'") or die(mysqli_error());
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

echo <<<EXCERPT
        
                </div>
            </div>
        </div>
        <p class="text-center">Please use the desktop mode to securely download your Voter ID.</p>

        <div class="text-center">
            <button type="button" class="btn btn-primary" onclick="myFunction()">Download as PDF</button>

            <!-- HTML to PDF conversion -->
            <script>
            function myFunction(){
                html2canvas(document.getElementById('v')).then(function(canvas){
                    var wid = 400;
                    var hgt = 700;
                    var img = canvas.toDataURL("image/png", wid = canvas.width, hgt = canvas.height);
                    var hratio = hgt/wid
                    var doc = new jsPDF('p','pt','a4');
                    var width = doc.internal.pageSize.width;    
                    var height = width * hratio
                    doc.addImage(img,'JPEG',20,20, width, height);
                    doc.save('Voter ID.pdf');
                });
            }
            </script>
            &nbsp;
            <button type="button" class="btn btn-primary" onclick="myFunctionHome()">Back to home</button>

            <script>
            function myFunctionHome() {
            location.href = "index.html";
            }
            </script>
        </div>
        <div class="col-md-4 mb-3"></div>
        </div>
    </div>
    <br>
    <!-- emblem -->
    <div class="text-center">
        <img src="images/emblem.png" width="50px" class="img-responsive center-block" alt="Emblem">
        <br>
    </div>

    <!-- footer -->
    <footer class="footer text-center text-muted">Created by <a href="https://viralparmar.ml" class="text-muted"
            target="_blank">Viral Parmar</a> for UpSkill programme
    </footer>
    
    <!-- libraries for PDF conversion -->
    <script src="js/html2canvas.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/jspdf.js"></script>

</body>

</html>

EXCERPT;

?>