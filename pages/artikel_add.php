<?php 
//fetch the information in a form to edit
if (isset($_SESSION['role']) && ($_SESSION['role'] === 'directie' || $_SESSION['role'] === 'winkelpersoneel'|| $_SESSION['role'] === 'chauffeur')) {
    $select_add = $artikel->add_selection();
    if (isset($_POST['add_submit'])) {
        // Retrieve form values
        $name = $_POST['naam'];
        $prijs_ex_btw = $_POST['prijs_ex_btw'];
        $categorie_id = $_POST['categorie_name'];
    
        // Call the edit method and edits the information
        $artikel->add($name, $prijs_ex_btw, $categorie_id);
    }
} else {
    header('Location: index.php?page=home');
    exit();  // to make sure that the script wont be executed again
}
?>
<!-- Display the form -->
<form action="" method="post">
    <!-- Categorie dropdown -->
    <label for="categorie">Kies de categorie:</label>
    <select id="categorie" name="categorie_name">
        <?php foreach ($select_add as $item): ?>
            <option value="<?php echo $item->categorie_id; ?>"><?php echo $item->categorie_name; ?></option>
        <?php endforeach; ?>
    </select>
    <br>

    <!-- naam -->
    <label for="naam">naam:</label>
    <input type="text" id="naam" name="naam" required>
    <br>

    <!-- naam -->
    <label for="prijs_ex_btw">prijs_ex_btw:</label>
    <input type="number" id="prijs_ex_btw" name="prijs_ex_btw" required>
    <br>

    <!-- Submit Button -->
    <button type="submit" name="add_submit">toevoegen</button>
</form>
