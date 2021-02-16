<?php
declare(strict_types=1);

require_once 'functions.php';

if (isset($_COOKIE['user_id'])){
    require_once 'index.php';
    die();
}

if (isset($_POST['signup_button'])){
    require_once 'signup.php';
    die();
}

if (isset($_POST['signin_button'])) {

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $userName = $_POST['username'];
        $password = $_POST['password'];

        $pdo = getConnection();

        $rows = fetchUser($userName, $pdo);

        if (count($rows) == 1) {

            if (password_verify($password, $rows['0']['password_hash'])) {

                echo $rows['0']['id'];
                setcookie('username', $rows['0']['login'], time() + (60 * 60 * 24 * 30));
                setcookie('user_id', (string)$rows['0']['id'], time() + (60 * 60 * 24 * 30));
                header("Location: " . HOME_URL);
                die();

            } else {
                echo "Wrong password or password";
            }

        } else {
            echo "Wrong username";
        }
    } else {
        echo "Fields must be filled";
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
          <input type="text" name="username" id="username">
          <label for="password">Enter password: </label>
          <input type="password" name="password" id="password">
          <button type="submit" name="signin_button">Sign in</button>
          <button type="submit" name="signup_button">Sign up</button>
    </form>
    </body>
  </html>