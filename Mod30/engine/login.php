<?php
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["password"])) {
 

 // Check if email is empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter email.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please enter a valid email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }
 
    // Validate credentials
    if (empty($email_err) && empty($password_err)) {
        // Prepare a select statement
        $stmt = getUserByEmail($email);
        if (!empty($stmt)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $stmt['name'];
            $_SESSION['email'] = $stmt['email'];
            $_SESSION['id'] = $stmt['id'];
        }
    }
}
