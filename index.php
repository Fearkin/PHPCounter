<?php
declare(strict_types=1);


require_once 'functions.php';

if (!isset($_COOKIE['user_id'])){
    header("Location: ", "lib/login.php");
    die();
} else {

    $userName = $_COOKIE['username'];
    $pdo = getConnection($options);
    $rows = fetchUser($userName, $pdo);
    $userCounter = $rows['0']['counter'];

    if (isset($_POST['incr_counter'])){
        $userCounter += 1;        
    }

    $id = $_COOKIE['user_id'];

    $statement = $pdo->prepare("UPDATE users SET counter = :counter WHERE id = :id");
    $statement->execute(array($userCounter, $id));

    setcookie('user_counter', $userCounter, time() * 60 * 60);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Your counter</title>
</head>

<body>
      <?php echo $userCounter; ?>
        <form class="" action="/" method="post">
            <button type="submit" name="incr_counter">+1</button>
        </form>
        <form action="lib/exit.php">
            <input type="submit" value="Sign in">
        </form>
    </div>
</body>
</html>
