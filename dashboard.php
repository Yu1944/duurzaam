<?php

class Dashboard{

    public function MenuItems(): Dashboard{
        yield MenuItems::linktoRoute('Website', 'fas fa-backward', 'app_default');
        yield MenuItems::linktoDashboard('Dashboard', 'fas fa-home');
        yield MenuItems::linktohome('Hoofdpagina', 'fas fa-home');
        yield MenuItems::linktoCrud('Persoonsgegevens', 'fas fa-list', gebruiker::class );
        yield MenuItems::linktoCrud('Klantgegevens', 'fas fa-list', klant::class);
        yield MenuItems::linktoCrud('Voorraadbeheer', 'fas fa-list', voorraad::class);
        yield MenuItems::linktoCrud('Opbrengst verkopen', 'fas fa-list', verkopen::class);
        yield MenuItems::linktoCrud('Rit planning', 'fas fa-list', planning::class);
    
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
        <li><a href="index.php?page=home">Website</a></li>
        <li><a href="index.php?page=product">Dashboard</a></li>
        <li><a href="index.php?page=login">login</a></li>
        <li><a href="index.php?page=login">login</a></li>
    </nav>
    <h1>hallo</h1>
    <p> ik wel graag weet waarom ik niks zie</p>
</body>
</html>