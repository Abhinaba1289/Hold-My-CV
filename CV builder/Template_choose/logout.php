<?php
session_start();
if (isset($_SESSION['username'])) {
    unset($_SESSION['username']);
    session_destroy();
    header('Location: templates.php');
    exit;
} else {
    header('Location: templates.php');
    exit;
}
?>