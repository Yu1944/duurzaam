<?php

class crud_artikel{
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function read() {
            // Implementation for reading from the database
            $stmt = $this->conn->prepare('
            SELECT 
            `artikel`.id as artikel_id, 
            `artikel`.`naam`, 
            `artikel`.`prijs_ex_btw`,
            `categorie`.`id`,
            `categorie`.`categorie`
        FROM 
            `artikel` 
        JOIN 
            `categorie` ON `artikel`.`categorie_id` = `categorie`.`id`;');
        
            $stmt->execute();
            $artikel_data = $stmt->fetchAll(PDO::FETCH_OBJ);
        
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th><th>naam</th><th>Prijs ex BTW</th><th>categorie</th><th>Action</th>";
            echo "</tr>";
        // prints out the information to the artikel page
            foreach ($artikel_data as $data) {
                echo "<tr>";
                echo "<td>{$data->artikel_id}</td>";
                echo "<td>{$data->naam}</td>";
                echo "<td>{$data->prijs_ex_btw}</td>";
                echo "<td>{$data->categorie}</td>";
                echo "<td><a href='index.php?page=artikel_delete&id={$data->artikel_id}&confirm=true'>Delete</a></td>";
                echo "<td><a href='index.php?page=artikel_edit&id={$data->artikel_id}'>Edit</a></td>";
                echo "</tr>";
            }
        
            echo "</table>";
            echo "<td><a href='index.php?page=artikel_add'>toevoeg nieuw product</a></td>";
    }


    public function add($name, $prijs_ex_btw, $categorie_id) {
        // Implementation for adding to the database
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Prepare SQL to add into the database
            $stmt = $this->conn->prepare('INSERT INTO artikel (naam, prijs_ex_btw, categorie_id) VALUES (:naam, :prijs_ex_btw, :categorie_id)');

            // Get values from the form and bind them to the database values
            $stmt->bindParam(':naam', $name);
            $stmt->bindParam(':prijs_ex_btw', $prijs_ex_btw);
            $stmt->bindParam(':categorie_id', $categorie_id);

            // Execute the statement
            $stmt->execute();

            // After successfully added, reload the page to prevent double insert
            header('location: index.php?page=artikel');
            exit();
        }
    }
    

    public function add_selection() {
        // Get distinct categorie information
        $stmt2 = $this->conn->prepare('SELECT 
            `categorie`.`id` as `categorie_id`,
            `categorie`.`categorie` as `categorie_name`
            FROM 
            `categorie`');

        // Fetch results from the query
        $stmt2->execute();
        $result2 = $stmt2->fetchAll(PDO::FETCH_OBJ);
        return $result2;
    }
    


    public function edit($id, $naam, $prijs_ex_btw,$categorie_id) {
        // Implementation for editing in the database
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $stmt = $this->conn->prepare('UPDATE `artikel` 
                SET 
                    `artikel`.`naam` = :naam,
                    `artikel`.`prijs_ex_btw` = :prijs_ex_btw, 
                    `artikel`.`categorie_id` = :categorie_id
                WHERE `artikel`.`id` = :id;
                ');
                //binds the information given by the $_POST in the artikel_edit page
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':naam', $naam);
                $stmt->bindParam(':prijs_ex_btw', $prijs_ex_btw);
                $stmt->bindParam(':categorie_id', $categorie_id);
                
                $stmt->execute();
                
                header('Location: index.php?page=artikel');
                exit();
            } catch (PDOException $e) {
                // Handle database errors
                echo "Error: " . $e->getMessage();
            }
        }
    }
    

    public function fetch_info_for_edit($id) {
        // fills in the information to be edited in the planning_edit page
        $stmt = $this->conn->prepare('
            SELECT 
                `artikel`.id as artikel_id, 
                `artikel`.`naam`, 
                `artikel`.`prijs_ex_btw`,
                `categorie`.`id` as categorie_id,
                `categorie`.`categorie`
            FROM 
                `artikel` 
            JOIN 
                `categorie` ON `artikel`.`categorie_id` = `categorie`.`id` 
            WHERE `artikel`.`id` = :id;');
    
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $artikel = $stmt->fetch(PDO::FETCH_OBJ);
    
        $stmt2 = $this->conn->prepare('SELECT 
            `categorie`.`id` as `categorie_id`,
            `categorie`.`categorie` as `categorie_name`
            FROM 
            `categorie`');
    
        // Fetch results from the query
        $stmt2->execute();
        $result2 = $stmt2->fetchAll(PDO::FETCH_OBJ);
    
        // prints out into the form to be edited
        echo '<form action="" method="post">
            <!-- artikel ID (hidden) -->
            <input type="hidden" name="artikel_id" value="' . $artikel->artikel_id . '"><br>
            
            <!-- Artikel naam -->
            <label for="Artikel">Artikel:</label>
            <input type="text" id="Artikel_naam" name="Artikel_naam" required value="' . $artikel->naam . '"><br>
    
            <!-- Categorie dropdown -->
            <label for="categorie">Kies de categorie:</label>
            <select id="categorie" name="categorie_name">';
        
        // Loop over the categories
        foreach ($result2 as $category) {
            echo '<option value="' . $category->categorie_id . '">' . $category->categorie_name . '</option>';
        }
        
        echo '</select><br>
    
            <!-- prijs exclusief btw -->
            <label for="prijs_ex_btw">Prijs Op:</label>
            <input type="text" id="prijs_ex_btw" name="prijs_ex_btw" required value="' . $artikel->prijs_ex_btw . '"><br>
    
            <!-- Submit Button -->
            <button type="submit" name="edit_submit">Edit artikel</button>
        </form>';
    }
    
    
    public function delete($id) {
        // Implementation for deleting from the database to be deleted
        $stmt = $this->conn->prepare('DELETE FROM `artikel` WHERE `artikel`.`id` = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('Location: index.php?page=artikel');
        exit();
    }    
}

?>