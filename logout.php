<?php

unset($_COOKIE['user_id']);
unset($_COOKIE['user_name']);
unset($_COOKIE['user_counter']);
setcookie('user_id','', -1,'/');
setcookie('username', '', -1, '/');
setcookie('user_counter', '', -1, '/');
header('Location: ' . HOME_URL);
die();