<?php

// Assuming $categorie is an instance of your class
if (isset($_SESSION['role']) && ($_SESSION['role'] === 'directie' || $_SESSION['role'] === 'magazijnmedewerker')) {
    if (isset($_POST['create_submit'])) {
        // Retrieve form values
        $categorieValue = $_POST['categorie'];

        // Call the create method to add information
        $categorie->create($categorieValue);
    }
} else {
    header('Location: index.php?page=home');
    exit();
}
?>
<!-- Display the form -->
<form action="" method="post">
    <!-- Category -->
    <label for="categorie">Categorie:</label>
    <input type="text" id="categorie" name="categorie" required>
    <br>

    <!-- Submit Button -->
    <button type="submit" name="create_submit">Toevoegen</button>
</form>
