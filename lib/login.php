<?php
declare(strict_types=1);


require_once 'functions.php';

if (isset($_COOKIE['user_id'])){
    header('Location: ' . HOME_URL);
    die();
}

if (isset($_POST['signup_button'])){
    require_once 'signup.php';
    die();
}

if (isset($_POST['signin_button'])) {

    $userName = $_POST['username'];
    $password = $_POST['password'];
    
    $pdo = getConnection($options);

    $rows = fetchUser($userName, $pdo);

    if (count($rows) == 1){
            
        if (password_verify($password, $rows['0']['password_hash'])) {

            echo "worked";
            echo $rows['0']['id'];
            setcookie('username', $rows['0']['login'], time() + (60 * 60 * 24 * 30));
            setcookie('user_id',$rows['0']['id'], time() + (60 * 60 * 24 * 30));
            header("Location: " . HOME_URL);
            die();

        } else {
            echo "Wrong password";
        }

    } else {
        echo "Wrong username";
    }
}
?>

<!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>Sign in</title>
    </head>
    <body>
      <form id="form_auth" method="POST" action="/">
        <label for="username">Enter login: </label>
        <input type="text" name="username">
        <label for="password">Enter password: </label>
        <input type="password" name="password">
        <button type="submit" name="signin_button">Sign in</button>
        <button type="submit" name="signup_button">Sign up</button>
    </form>
    </body>
  </html>