<?php

function connectToDatabase(): PDO
{
    $pdo = new PDO("mysql:host=localhost;dbname=test", 'root', '');

    return $pdo;
}
