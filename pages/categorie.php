<?php
//fetch the information in a form to edit
if (isset($_SESSION['role']) && ($_SESSION['role'] === 'directie' || $_SESSION['role'] === 'magazijnmedewerker')) {
    $categorie->read();
} else {
    header('Location: index.php?page=dashboard');
    exit();  // to make sure that the script wont be executed again
}

?>