<?php
if (isset($_SESSION['role']) && ($_SESSION['role'] === 'directie' || $_SESSION['role'] === 'magazijnmedewerker')) {
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        // Perform the deletion and redirect back to the planning list
        $categorie->delete($_GET['id']);
    }
} else {
    header('Location: index.php?page=home');
    exit();  // to make sure that the script wont be executed again
}
?>