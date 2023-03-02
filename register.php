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

    $name = $_POST["name"];

    $email = $_POST["email"];

    $password = $_POST["password"];

    $cpassword = $_POST["cpassword"];

    $user_type = $_POST["user_type"];

    // Check if passwords match

    if ($password != $cpassword) {

        echo "Error: Passwords do not match";

    } else {

        // Hash the password

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the email already exists

        $sql = "SELECT COUNT(*) as count FROM users WHERE email='$email'";

        $result = $conn->query($sql);

        $row = $result->fetch_assoc();

        $count = $row['count'];

        if ($count > 0) {

            // Email already registered

            echo "This email is already registered. Please login instead.";

        } else {

            // Insert the data into the database

            $sql = "INSERT INTO users (name, email, password, user_type)

                    VALUES ('$name', '$email', '$hashed_password', '$user_type')";

            if ($conn->query($sql) === TRUE) {

                echo "New record created successfully";

            } else {

                echo "Error: " . $sql . "<br>" . $conn->error;

            }

        }

    }

}

$conn->close();

?>
