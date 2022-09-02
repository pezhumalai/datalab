<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
    unset($_SESSION['user_name']);
    unset($_SESSION['pass']);
header("Location: index.php"); // Redirecting To Home Page
}
?>