<?php
declare(strict_types=1);
error_reporting(E_ALL);
define('HOME_URL', 'http://localhost:8000' . $_SERVER['PHP_SELF']);

require_once 'functions.php';

session_set_cookie_params([
    'httponly' => true,
    'samesite' => 'Strict',
]);
session_start();

if (isset($_POST['logout'])){
    require 'logout.php';
}

if (!isset($_SESSION['user_id'])){
    require_once 'login.php';
    die();
} else {

    $userName = $_SESSION['username'];
    $pdo = getConnection();
    $rows = fetchUser($userName, $pdo);
    $userCounter = $rows['0']['counter'];

    if (isset($_POST['incr_counter'])){
        $userCounter += 1;        
    }

    $id = $_SESSION['user_id'];

    $statement = $pdo->prepare("UPDATE users SET counter = :counter WHERE id = :id");
    $statement->execute(array($userCounter, (int) $id));

    $_SESSION['user_counter'] = $userCounter;

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
    <?php echo htmlspecialchars((string) $userCounter); ?>
    <form class="" action="/" method="post">
        <button type="submit" name="incr_counter">+1</button>
    </form>
    <form action="/" method="post">
        <button type="submit" name="logout"> Log out</button>
    </form>
</div>

</body>
</html>
