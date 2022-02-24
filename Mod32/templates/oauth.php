<?php
// Получаем access_token, с помощью этого параметра.
// require_once dirname(__DIR__, 1) . '/engine/oauth.php';
require_once dirname(__DIR__, 1) . '/bootstrap.php';
authUserVk();
getUserVk();
setUserCookieVk();
setLoginStatusVk();


if (getLoginStatus()) {
    header("location: index.php?page=7");
    exit;
}


    // var_dump($_SESSION);
    // echo '<br/>';
    // echo '<br/>';
    // echo '<br/>';
    // var_dump($response);
    // echo '<br/>';
    // echo '<br/>';
    // var_dump($vk_user->response[0]);
