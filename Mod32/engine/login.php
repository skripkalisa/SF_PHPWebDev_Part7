<?php
include_once 'oauth.php';

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = '';
// $_SESSION["email_err"] = '';
// $_SESSION["password_err"] = '';


if (isset($_COOKIE["login"])) {
    $email_cookie = explode(',', $_COOKIE["login"])[0];
    $stmt = getUserByEmail($email_cookie);
    setLoginStatus($stmt);
}
if (isset($_COOKIE["vk"])) {
    checkCookieVk();
}



function login()
{
    global $email_err , $password_err ;


    if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST["token"]) && $_POST["token"] == $_SESSION["CSRF"]) {
        // Check if email is empty
        if (empty(trim($_POST["email"]))) {
            $email_err = "Please enter email.";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["email_err"] = "Please enter a valid email.";
        } else {
            $email = trim($_POST["email"]);
        }
        // Check if password is empty
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter your password.";
        } else {
            $password = trim($_POST["password"]);
            // echo "Password: " . $password ."<br />";
        }
        $_SESSION["email_err"] = $email_err;
        $_SESSION["password_err"] = $password_err;
        // Validate credentials
        if (empty($email_err) && empty($password_err)) {
            // Prepare a select statement
            $stmt = getUserByEmail($email);
            if (!empty($stmt)) {
                setLoginStatus($stmt);
                setUserCookie();
            }
        }
    }
}



function setUserCookie()
{
    if (isset($_POST["remember"])) {
        setcookie(
            'login',
            $_SESSION['email'].','.md5($_SESSION['email'].SECRET_WORD),
            strtotime('+30 days')
        );
    }
}

function setLoginStatus($stmt)
{
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $stmt['name'];
    $_SESSION['email'] = $stmt['email'];
    $_SESSION['id'] = $stmt['id'];
}
