<?php
declare(strict_types=1);

require_once 'functions.php';

if (!isset($_COOKIE['user_id'])){

    if (isset($_POST['signin_button'])){
        require 'login.php';
        die();
    }

    if (isset($_POST['signup_button'])){

        $date = $_POST['date'];
        $userName = $_POST['username'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        if (
            !empty($userName) &&
            !empty($password) &&
            !empty($password2) &&
            ($password == $password2) &&
            !empty($date)
        ){
            
            $userYear = (int) date('Y') - (int) $_POST['date'];

            if ($userYear < 5){
                echo "Too young";
            } else if ($userYear > 120){
                echo "Too old";
            } else {

                $pdo = getConnection();

                $rows = fetchUser($userName, $pdo);
                print_r($rows);

                if (count($rows) == 0){

                    $password_hash = password_hash($password, PASSWORD_ARGON2ID);

                    $statement = $pdo->prepare("INSERT INTO users (login, password_hash, counter) VALUES (:login, :password_hash, 0)");
                    $statement->execute(array($userName, $password_hash));

                    $rows = fetchUser($userName, $pdo);

                    if (count($rows) == 1){
                        setcookie('user_id', (string) $rows['0']['id'], time() + (60 * 60 * 24 * 30));
                        setcookie('username', $rows['0']['login'], time() + (60 * 60 * 24 * 30));
                        header("Location: " . HOME_URL);
                        die();
                    } else {
                        echo "Sign up error";
                    }

                } else {
                    echo "User already exists";
                }
            }
        } else {
            echo "Fields unfilled or wrong password";
        }
    }
} else {
    header("Location: " . HOME_URL);
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <label for="username">User: </label>
        <input type="text" id="username" name="username">
        <label for="password">Password: </label>
        <input type="password" id="password" name="password">
        <label for="password2">Repeat password: </label>
        <input type="password" id="password2" name="password2">
        <label for="date">Date of birth: </label>
        <input type="date" id="date" name="date">
        
        <button type="submit" name="signup_button">Sign up</button>

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <input type="submit" name="signin_button" value="Sign in">
        </form>


    </form>
</body>
</html>
