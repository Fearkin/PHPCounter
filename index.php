<?php
declare(strict_types=1);
define('HOME_URL', 'http://localhost:8000' . $_SERVER['PHP_SELF']);

require_once 'functions.php';

if (isset($_POST['logout'])){
    require 'logout.php';
}

if (!isset($_COOKIE['user_id'])){
    require_once 'login.php';
    die();
} else {

    $userName = $_COOKIE['username'];
    $pdo = getConnection();
    $rows = fetchUser($userName, $pdo);
    $userCounter = $rows['0']['counter'];

    if (isset($_POST['incr_counter'])){
        $userCounter += 1;        
    }

    $id = $_COOKIE['user_id'];

    $statement = $pdo->prepare("UPDATE users SET counter = :counter WHERE id = :id");
    $statement->execute(array($userCounter, $id));

    setcookie('user_counter', (string) $userCounter, time() + 60 * 60);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Your counter</title>
</head>

<body>
<div>
    <?php echo $userCounter; ?>
    <form class="" action="/" method="post">
        <button type="submit" name="incr_counter">+1</button>
    </form>
    <form action="/" method="post">
        <button type="submit" name="logout"> Log out</button>
    </form>
</div>

</body>
</html>
