<?php

function isConnect(): bool
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return !empty($_SESSION['isConnected']);
}

function forceUserToConnect(): void
{
    if (!isConnect()) {
        header('Location: ./index.php');
        exit();
    }
}
