<?php
require_once 'functions.php';
session_start();
$dashboard = new crud_product();
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
    <ul>
        <li><a href="index.php?page=home">home</a></li>
        <li><a href="index.php?page=product">producten</a></li>
        <li><a href="index.php?page=login">login</a></li>
    </ul>
</body>
</html>