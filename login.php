<?php

// Establish a connection to the database

$servername = "localhost";

$username = "root";

$password = "";

$dbname = "myDB";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

// Process the form data

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];

    $password = $_POST["password"];

    // Query the database for the user with the given email

    $sql = "SELECT * FROM users WHERE email='$email'";

    $result = $conn->query($sql);

    if ($result->num_rows == 1) {

        // Check if the password is correct

        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {

            // The user has successfully logged in

            session_start();

            $_SESSION["email"] = $email;

            header("Location: profile.html");

            exit();

        } else {

            // The password is incorrect

            echo "Invalid email or password";

        }

    } else {

        // The email is not registered

        echo "Invalid email or password";

    }

}

$conn->close();

?>
