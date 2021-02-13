<?php

define('DB_TYPE', 'mysql');
define('HOST', '127.0.0.1');
define('DB_NAME', 'counter_db');
define('CHARSET', 'utf8');
define('USER', 'counter');
define('PASSWORD', 'bad_password');
define('HOME_URL', 'http://' . $_SERVER['HTTP_HOST']);

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

