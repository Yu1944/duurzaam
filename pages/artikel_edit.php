<?php 
//fetch the information in a form to edit
if (isset($_SESSION['role']) && ($_SESSION['role'] === 'directie' || $_SESSION['role'] === 'winkelpersoneel'|| $_SESSION['role'] === 'chauffeur')) {
    $artikel->fetch_info_for_edit($_GET['id']);
    $artikel->add_selection();
    if (isset($_POST['edit_submit'])) {
        // Retrieve form values
        $id = $_POST['artikel_id'];
        $product_naam = $_POST['Artikel_naam'];
        $prijs_ex_btw = $_POST['prijs_ex_btw'];
        $categorie_id = $_POST['categorie_name'];
    
        // Call the edit method and edits the information
        $artikel->edit($id, $product_naam, $prijs_ex_btw,$categorie_id);
    }
} else {
    header('Location: index.php?page=home');
    exit();  // to make sure that the script wont be executed again
}

?>

