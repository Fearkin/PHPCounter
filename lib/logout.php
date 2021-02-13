<?php

require_once 'config.php';

unset($_COOKIE['user_id']);
unset($_COOKIE['user_name']);
setcookie('user_id','',-1,'/');
setcookie('username','',-1,'/');
header('Location: ' . HOME_URL);
die();