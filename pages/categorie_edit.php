<?php

//fetch the information in a form to edit
if (isset($_SESSION['role']) && ($_SESSION['role'] === 'directie' || $_SESSION['role'] === 'magazijnmedewerker')) {
    $categorie->fetch_info_for_edit($_GET['id']);
    if (isset($_POST['edit_submit'])) {
        // Retrieve form values
        $id = $_POST['categorie_id'];
        $newCategorieValue = $_POST['categorie'];


        // Call the edit method and edits the information
        $categorie->edit($id, $newCategorieValue);
    }
} else {
    header('Location: index.php?page=dashboard');
    exit();  // to make sure that the script won't be executed again
}

?>