<h1>LOGOUT</h1>
<?php

// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
setcookie('login', '', 1);
setcookie('vk', '', 1);

// Redirect to login page
header("location: index.php?page=1");
exit;
?>