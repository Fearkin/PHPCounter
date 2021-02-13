<?php
declare(strict_types=1);

require_once 'config.php';


function fetchUser(string $userName, \PDO $pdo): array
{
    $statement = $pdo->prepare("SELECT * FROM users WHERE login = :login");
    $statement->execute(array($userName));
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    print_r($rows);

    return $rows;
}

function getConnection(array $options): \PDO
{
    $pdo = new PDO(
        DB_TYPE . ":host=". HOST . ";dbname=" . DB_NAME . ";charset=" . CHARSET,
        USER, PASSWORD, $options
    );

    return $pdo;
}