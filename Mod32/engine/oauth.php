<?php
// session_start(); // Токен храним в сессии
require_once dirname(__DIR__, 1) . '/bootstrap.php';
require_once dirname(__DIR__, 1) . '/config/credentials.php';

// Параметры приложения
$clientId     = $vk_id; // ID приложения
$clientSecret = $vk_secret_key; // Защищённый ключ
$redirectUri  = $redirect_uri; // Адрес, на который будет переадресован пользователь после прохождения авторизации

// Формируем ссылку для авторизации
$params = array(
    'client_id'     => $clientId,
    'redirect_uri'  => $redirectUri,
    'response_type' => 'code',
    'v'             => '5.131', // (обязательный параметр) версиb API https://vk.com/dev/versions

    // Права доступа приложения https://vk.com/dev/permissions
    // Если указать "offline", полученный access_token будет "вечным" (токен умрёт, если пользователь сменит свой пароль или удалит приложение).
    // Если не указать "offline", то полученный токен будет жить 12 часов.
    'scope'         => 'photos,offline',
);

// Выводим на экран ссылку для открытия окна диалога авторизации
// echo '<a href="http://oauth.vk.com/authorize?' . http_build_query($params) . '">Авторизация через ВКонтакте</a>';

/*
*
*
*
*/
function authUserVk()
{
    global $clientId, $clientSecret, $redirectUri;
    $params = array(
        'client_id'     => $clientId,
        'client_secret' => $clientSecret,
        'code'          => $_GET['code'],
        'redirect_uri'  => $redirectUri
    );
    
    $oauth_vk = 'https://oauth.vk.com/access_token?';
    
    $content = @file_get_contents($oauth_vk . http_build_query($params));
    
    if (checkForError($content)) {
        $response = json_decode($content);
    }
    
    if (checkResponse($response)) {
        // А вот здесь выполняем код, если все прошло хорошо
    $tokenVk = $response->access_token; // Токен
    $expiresIn = $response->expires_in; // Время жизни токена
    $userId = $response->user_id; // ID авторизовавшегося пользователя

        // Сохраняем токен в сессии
        $_SESSION['token_vk'] = $tokenVk;
        $_SESSION['id'] = $userId;
        // setUserCookieVk();
    }
}

function getUserVk()
{
    $api_vk = 'https://api.vk.com/method/users.get?';
    
    $user_data = array(
        'user_id' => $_SESSION['id'],
        'fields'  => 'photo_50',
        'access_token' => $_SESSION['token_vk'],
        'v' => '5.131'
    );
    
    
    $getVkUser = @file_get_contents($api_vk. http_build_query($user_data));
    if (checkForError($getVkUser)) {
        $vk_user = json_decode($getVkUser);
    }
    
    if (checkResponse($vk_user)) {
        $firstname = $vk_user->response[0]->first_name;
        $lastname = $vk_user->response[0]->last_name;
        $_SESSION['avatar'] = $vk_user->response[0]->photo_50;
        $_SESSION['username'] = $firstname . ' '. $lastname;
        
        setLoginStatusVk();
    }
}
    
function checkForError($args)
{
    if (!$args) {
        $error = error_get_last();
        throw new Exception('HTTP request failed. Error: ' . $error['message']);
        return false;
    }
    return true;
}

function checkResponse($args)
{
    // Если при получении токена произошла ошибка
    if (isset($args->error)) {
        throw new Exception('При получении токена произошла ошибка. Error: ' . $response->error . '. Error description: ' . $response->error_description);
        return false;
    }
    return true;
}

function setLoginStatusVk()
{
    $_SESSION['loggedin'] = true;
    // if ($_POST["token"] == $_SESSION["CSRF"]) {
    // }
}

function setUserCookieVk()
{
    setcookie(
        'vk',
        setTokenVk(),
        strtotime('+30 days')
    );
}
function setTokenVk()
{
    if (isset($_SESSION['id']) && isset($_SESSION['token_vk'])) {
        return $_SESSION['id'].','.md5($_SESSION['token_vk'].SECRET_WORD);
    }
    return '';
}

function checkCookieVk()
{
    if ($_COOKIE['vk'] === setTokenVk()) {
        getUserVk();
        setLoginStatusVk();
    }
}
