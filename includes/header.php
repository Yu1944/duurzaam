<?php
require_once 'functions.php';
session_start();
$planning = new crud_planning();
$categorie = new categorie();
$login = new login_system();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=m, initial-scale=1.0">
    <title>Duurzaam</title>
</head>
<body>
    <?php
    if (isset($_SESSION['username'])) {
        echo '<ul><li><a href="index.php?page=home">Home</a></li>';
        echo '<li><a href="index.php?page=dashboard">Dashboard</a></li>';
        echo '<li><a href="index.php?page=product">Product</a></li>';
        echo '<li><a href="index.php?page=categorie">categorie</a></li>';
        echo '<li><a href="index.php?page=planning">planning</a></li>';
        if (isset($_SESSION['role']) && ($_SESSION['role'] === 'directie' || $_SESSION['role'] === 'winkelpersoneel')) {
            echo '<li><a href="index.php?page=register">register</a></li>';
        }
        echo '<li>' . $_SESSION['username'] . '</li>';
        echo '<li><a href="index.php?page=log_out">Loguit</a></li></ul>';
    } else {
        echo '<ul><li><a href="index.php?page=login">Login</a></li></ul>';
    }
    ?>
</body>
</html>
