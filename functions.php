<?php
declare(strict_types=1);

require_once 'config.php';


function fetchUser(string $userName, PDO $pdo): array
{
    $statement = $pdo->prepare("SELECT * FROM users WHERE login = :login");
    $statement->execute(array($userName));
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getConnection(array $options = OPTIONS): PDO
{
    return new PDO(
        DB_TYPE . ":host=". HOST . ";dbname=" . DB_NAME . ";charset=" . CHARSET,
        USER, PASSWORD, $options
    );
}