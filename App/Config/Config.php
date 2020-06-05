<?php

// URL PARAMS
define('URLROOT', '');
define('SITENAME', 'REPORTS CMS');

// FOLDER PARAMS
define('ROOT', dirname(dirname(__dir__)) . DIRECTORY_SEPARATOR);
define('APPROOT', ROOT . 'App' . DIRECTORY_SEPARATOR);


// DB PARAMS
define('DB_HOST', 'localhost');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_NAME', '');

// Errors - development purpose
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



// Login PARAMS


define('LOGIN_FAILED_ATTEMPTS', 10);
define('LOGIN_BAN_EXPIRE_TIME', 3600); // in secconds


// PASSWORDS

define('MAX_PASSWORD_LENGTH', 32);

define('MIN_PASSWORD_LENGTH', 6);
