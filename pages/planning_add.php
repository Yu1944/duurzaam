<?php 
//fetch the information in a form to edit
if (isset($_SESSION['role']) && ($_SESSION['role'] === 'directie' || $_SESSION['role'] === 'winkelpersoneel'|| $_SESSION['role'] === 'chauffeur')) {
    $select_add = $planning->add_selection();
    if (isset($_POST['add_submit'])) {
        // Retrieve form values
        $kenteken = $_POST['kenteken'];
        $ophalen_of_bezorgen = $_POST['ophalen_of_bezorgen'];
        $afspraak_op = $_POST['afspraak_op'];
        $klant_id = $_POST['klant_name'];
        $artikel_id = $_POST['artikel'];
    
        // Call the edit method and edits the information
        $planning->add($kenteken, $ophalen_of_bezorgen, $afspraak_op, $artikel_id, $klant_id);
    }
} else {
    header('Location: index.php?page=home');
    exit();  // to make sure that the script wont be executed again
}
?>
<!-- Display the form -->
<form action="" method="post">
    <!-- Artikel dropdown -->
    <label for="artikel">Kies de Artikel:</label>
    <select id="artikel" name="artikel">
        <?php foreach ($select_add['artikel'] as $artikel): ?>
            <option value="<?php echo $artikel['product_id']; ?>"><?php echo $artikel['product_name']; ?></option>
        <?php endforeach; ?>
    </select>
    <br>

    <!-- Klant dropdown -->
    <label for="klant">Kies de Klant:</label>
    <select id="klant" name="klant_name">
        <?php foreach ($select_add['klant'] as $item): ?>
            <option value="<?php echo $item['klant_id']; ?>"><?php echo $item['klant_name']; ?></option>
        <?php endforeach; ?>
    </select>
    <br>

    <!-- Kenteken -->
    <label for="kenteken">Kenteken:</label>
    <input type="text" id="kenteken" name="kenteken" required>
    <br>

    <!-- Ophalen/Bezorgen -->
    <label for="ophalen_of_bezorgen">Ophalen/Bezorgen:</label>
    <select name="ophalen_of_bezorgen" id="ophalen_of_bezorgen" required>
        <option value="ophalen">ophalen</option>
        <option value="bezorgen">bezorgen</option>
    </select>
    <br>

    <!-- Afspraak op -->
    <label for="afspraak_op">Afspraak op:</label>
    <input type="datetime-local" id="afspraak_op" name="afspraak_op" required>
    <br>

    <!-- Submit Button -->
    <button type="submit" name="add_submit">toevoegen</button>
</form>
