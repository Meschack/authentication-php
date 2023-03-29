<?php

require './functions/connectToDatabase.php';

function getPosts(): array
{
    $database = connectToDatabase();

    $sqlQuery = "SELECT * FROM posts";

    $statement = $database->prepare($sqlQuery);

    $statement->execute();

    return $statement->fetchAll();
}

function getSinglePost(int $id)
{
    $database = connectToDatabase();

    $sqlQuery = "SELECT * FROM posts WHERE id=?";

    $statement = $database->prepare($sqlQuery);

    $statement->execute([$id]);

    return $statement->fetch();
}

function reduceTitle(string $title)
{
    $reducedTitle = substr($title, 0, 30) . '...';

    return $reducedTitle;
}
