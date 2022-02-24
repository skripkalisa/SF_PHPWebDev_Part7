<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once 'config/config.php';
require_once 'config/db.php';
// require_once 'engine/token.php';
require_once 'engine/register.php';
// require_once 'engine/login.php';
require_once 'engine/oauth.php';
require_once 'engine/upload.php';
require_once 'engine/logger.php';
