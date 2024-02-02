<?php 
//fetch the information in a form to edit
if (isset($_SESSION['role']) && ($_SESSION['role'] === 'directie' || $_SESSION['role'] === 'winkelpersoneel'|| $_SESSION['role'] === 'chauffeur')) {
    $planning->fetch_info_for_edit($_GET['id']);
    if (isset($_POST['edit_submit'])) {
        // Retrieve form values
        $id = $_POST['planning_id'];
        $kenteken = $_POST['kenteken'];
        $ophalen_of_bezorgen = $_POST['ophalen_of_bezorgen'];
        $afspraak_op = $_POST['afspraak_op'];
        $product_naam = $_POST['product_name'];
        $prijs_ex_btw = $_POST['product_price'];
        $klant_naam = $_POST['customer_name'];
        $adres = $_POST['adres'];
        $plaats = $_POST['city'];
        $telefoon = $_POST['phone'];
        $email = $_POST['email'];
    
        // Call the edit method and edits the information
        $planning->edit($id, $kenteken, $ophalen_of_bezorgen, $afspraak_op, $product_naam, $prijs_ex_btw, $klant_naam, $adres, $plaats, $telefoon, $email);
    }
} else {
    header('Location: index.php?page=home');
    exit();  // to make sure that the script wont be executed again
}

?>

