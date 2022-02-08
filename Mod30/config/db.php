<?php
/**

 * @return PDO

 */

function get_connection()
{
    require dirname(__DIR__) . '/config/credentials.php';

    return new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
}

function insert(array $data)
{
    $query = 'INSERT INTO users (name, email, password, created_at) VALUES(?, ?, ?, ?)';
    $db = get_connection();
    $stmt = $db->prepare($query);
    return $stmt->execute($data);
}

function getUserByEmail(string $email)
{
    $query = 'SELECT * FROM users WHERE email = ?';
    $db = get_connection();
    $stmt = $db->prepare($query);
    $stmt->execute([$email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return $result;
    }
    return false;
}


function getUsersList()
{
    $query = 'SELECT * FROM users ORDER BY id DESC';
    $db = get_connection();
    return $db->query($query, PDO::FETCH_ASSOC);
}

function getLoginStatus()
{
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        return true;
    }
    return false;
}


function isAdmin()
{
    if (getLoginStatus() && $_SESSION["id"]<=2) {
        return true;
    }
    return false;
}
