<?php

//sanitizing SQL query input for security
$fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
$lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
$mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING);
$city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
$state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
$zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING);
$aadhar = filter_input(INPUT_POST, 'aadhar', FILTER_SANITIZE_STRING);

$target = "uploads/";
$target = $target . basename( $_FILES['image']['name']); 
$image=($_FILES['image']['name']); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voters";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO people (fname, lname, mobile, city, state, zip, aadhar, image)
VALUES ('$fname', '$lname', '$mobile', '$city', '$state', '$zip', '$aadhar', '$image')";

if(move_uploaded_file($_FILES['image']['tmp_name'],$target)) {
} else {  
    echo "Sorry, there was a problem uploading your file."; 
} 

if ($conn->query($sql) === TRUE) {
    echo ("<script language='javascript'>
    window.alert('Your registration is successful.');
    window.location.href='index.html';
    </script>");

} else {
    echo ("<script language='javascript'>
    window.alert('Duplicate or invalid entries detected. Please enter again.');
    window.location.href='register.html';
    </script>");
}

$conn->close();
?>