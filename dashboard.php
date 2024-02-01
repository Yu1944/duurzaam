<?php

require_once 'functions.php';
$dashboard = new crud_product();

class Dashboard{

    /* public function (): Dashboard{

     }*/

}
?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">
<title>Dashboard</title>
<body>
<h1>hallo</h1>
<p> ik wel graag Hallo zeggen</p>
<!-- Sidebar -->
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:15%">
    <h3 class="w3-bar-item">KCD1ERD</h3>
    <a href="index.php?page=home" class="w3-bar-item w3-button">Website</a>
    <a href="#" class="w3-bar-item w3-button">Dashboard</a>
    <a href="#" class="w3-bar-item w3-button">Hoofdpagina</a>
    <a href="#" class="w3-bar-item w3-button">Persoonsgegevens</a>
    <a href="#" class="w3-bar-item w3-button">Klantgegevens</a>
    <a href="#" class="w3-bar-item w3-button">Voorraadbeheer</a> <!-- artikel, categorie, magazijnlocatie -->
    <a href="#" class="w3-bar-item w3-button">Opbrengst verkopen</a>
    <a href="#" class="w3-bar-item w3-button">Rit planning</a>
</div>

<!-- Page Content -->
<div style="margin-left:15%">

    <div class="topnav">
        <div class="search-container">
            <form action="/action_page.php">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>

    <div style="padding-left:16px">
        <?php

        ?>
    </div>

</div>


</body>
</html>