<?php

if(isset($_POST['submit'])){

    // Store form data in variables

    $dob = $_POST['dob'];

    $age = $_POST['age'];

    $contact = $_POST['contact'];

    // Database connection

    $servername = "localhost";

    $username = "username";

    $password = "password";

    $dbname = "myDB";

    // Create connection

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection

    if ($conn->connect_error) {

      die("Connection failed: " . $conn->connect_error);

    }

    // SQL query to insert form data into database

    $sql = "INSERT INTO personal_info (dob, age, contact) VALUES ('$dob', '$age', '$contact')";

    if ($conn->query($sql) === TRUE) {

      echo "Form submitted successfully";

    } else {

      echo "Error: " . $sql . "<br>" . $conn->error;

    }

    $conn->close();

}

?>

