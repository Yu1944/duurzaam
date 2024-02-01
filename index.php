<?php 
include 'includes/header.php';
$page = isset($_GET['page'])? $_GET['page']: 'home';
include 'pages/' . $page .'.php';
include 'includes/footer.php';
?>