<?php

class categorie
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // read for category
    public function read() {
        // Implementation for reading from the database
        $stmt = $this->conn->prepare('
        SELECT 
            `categorie`.id, 
            `categorie`.`categorie` as `categorie`
        FROM 
            `categorie`
        ');

        $stmt->execute();
        $categorieData = $stmt->fetchAll(PDO::FETCH_OBJ);

        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th><th>Categorie</th><th>Action</th>";
        echo "</tr>";

        // prints out the information to the table
        foreach ($categorieData as $data) {
            echo "<tr>";
            echo "<td>{$data->id}</td>";
            echo "<td>{$data->categorie}</td>";
            echo "<td><a href='index.php?page=categorie_delete&id={$data->id}&confirm=true'>Delete</a></td>";
            echo "<td><a href='index.php?page=categorie_edit&id={$data->id}'>Edit</a></td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "<td><a href='index.php?page=categorie_create'>Toevoeg nieuwe categorie</a></td>";
    }

    // create for category
    public function create($categorie) {
        // Implementation for adding to the database
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Prepare SQL to add into the database
            $stmt = $this->conn->prepare('INSERT INTO categorie (categorie) VALUES (:categorie)');

            // Get values from the form and bind them to the database values
            $stmt->bindParam(':categorie', $categorie);

            // Execute the statement
            $stmt->execute();

            // After successfully added, reload the page to prevent double insert
            header('location: index.php?page=categorie'); // You may need to update this URL based on your application's structure
            exit();
        }
    }

    //delete for category
    public function delete($id) {
        // Implementation for deleting from the database to be deleted
        $stmt = $this->conn->prepare('DELETE FROM `categorie` WHERE `categorie`.`id` = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('Location: index.php?page=categorie');
        exit();
    }

    // edit for category
    public function edit($id, $categorie) {
        // Implementation for editing in the database
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $stmt = $this->conn->prepare('UPDATE `categorie` 
                SET 
                    `id` = :id,
                    `categorie` = :categorie
                WHERE `id` = :id;
                ');
                //binds the information given by the $_POST in the planning_edit page
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':categorie', $categorie);

                $stmt->execute();

                header('Location: index.php?page=categorie');
                exit();
            } catch (PDOException $e) {
                // Handle database errors
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function fetch_info_for_edit($id){
        // fills in the information to be edited in the planning_edit page
        $stmt = $this->conn->prepare('
            SELECT
                `id`,
                `categorie`
            FROM
                `categorie`
            WHERE 
                `id` = :id
        ');

        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $categorie = $stmt->fetch(PDO::FETCH_OBJ);

        //prints out into the form to be edited
        echo '<form action="" method="post">
            <!-- Categorie ID (hidden) -->
            <input type="hidden" name="categorie_id" value="' . $categorie->id . '"><br>
        
            <!-- Category -->
            <label for="categorie">Categorie:</label>
            <input type="text" id="categorie" name="categorie" required value="' . $categorie->categorie . '"><br>
        
            <!-- Submit Button -->
            <button type="submit" name="edit_submit">Edit Category</button>
        </form>';
    }
}
