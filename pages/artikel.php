<?php 
//fetch the information in a form to edit
if (isset($_SESSION['role']) && ($_SESSION['role'] === 'directie' || $_SESSION['role'] === 'winkelpersoneel'|| $_SESSION['role'] === 'chauffeur')) {
    $artikel->read();
} else {
    header('Location: index.php?page=home');
    exit();  // to make sure that the script wont be executed again
}

?>

