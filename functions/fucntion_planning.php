<?php

class crud_planning{
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }
    public function read() {
        // Implementation for reading from the database
        $stmt = $this->conn->prepare('
            SELECT 
                `planning`.id, 
                `planning`.kenteken, 
                `planning`.`ophalen_of_bezorgen`, 
                `planning`.afspraak_op, 
                `artikel`.`naam`, 
                `artikel`.`prijs_ex_btw`,
                `klant`.`naam` as `klant_naam`,
                `klant`.`adres`,
                `klant`.`plaats`, 
                `klant`.`telefoon`,
                `klant`.`email`
            FROM 
                `planning` 
                JOIN `artikel` ON `planning`.`artikel_id` = `artikel`.`id` 
                JOIN `klant` ON `planning`.`klant_id` = `klant`.`id`
        ');
    
        $stmt->execute();
        $planningData = $stmt->fetchAll(PDO::FETCH_OBJ);
    
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th><th>Kenteken</th><th>Ophalen/Bezorgen</th><th>Afspraak Op</th><th>Product</th><th>Prijs ex BTW</th><th>Klant Naam</th><th>Adres</th><th>Plaats</th><th>Telefoon</th><th>Email</th><th>Action</th>";
        echo "</tr>";
    // prints out the information to the planning
        foreach ($planningData as $data) {
            echo "<tr>";
            echo "<td>{$data->id}</td>";
            echo "<td>{$data->kenteken}</td>";
            echo "<td>{$data->ophalen_of_bezorgen}</td>";
            echo "<td>{$data->afspraak_op}</td>";
            echo "<td>{$data->naam}</td>";
            echo "<td>{$data->prijs_ex_btw}</td>";
            echo "<td>{$data->klant_naam}</td>";
            echo "<td>{$data->adres}</td>";
            echo "<td>{$data->plaats}</td>";
            echo "<td>{$data->telefoon}</td>";
            echo "<td>{$data->email}</td>";
            echo "<td><a href='index.php?page=planning_delete&id={$data->id}&confirm=true'>Delete</a></td>";
            echo "<td><a href='index.php?page=planning_edit&id={$data->id}'>Edit</a></td>";
            echo "</tr>";
        }
    
        echo "</table>";
    }
    

    public function add() {
        // Implementation for adding to the database
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Prepare sql to add into database
            $stmt = $this->conn->prepare('INSERT INTO planning (name, description, quantity, price) VALUES (:name, :description, :quantity, :price);
            ');
            // Get values from the form and binds together with the database values
            $stmt->bindParam(':name', $_POST['productName']);
            $stmt->bindParam(':description', $_POST['description']);
            $stmt->bindParam(':quantity', $_POST['quantity']);
            $stmt->bindParam(':price', $_POST['price']);            
            $stmt->execute();
            // after succesfully added reloads the page to overcome double insert
            header('location: index.php?page=planning');
            exit();
        }
    }

    public function edit($id, $kenteken, $ophalen_of_bezorgen, $afspraak_op, $naam, $prijs_ex_btw, $klant_naam, $adres, $plaats, $telefoon, $email) {
        // Implementation for editing in the database
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $stmt = $this->conn->prepare('UPDATE `planning`
                                            JOIN `artikel` ON `planning`.`artikel_id` = `artikel`.`id`
                                            JOIN `klant` ON `planning`.`klant_id` = `klant`.`id`
                                            SET `planning`.`kenteken` = :kenteken, 
                                                `planning`.`ophalen_of_bezorgen` = :ophalen_of_bezorgen, 
                                                `planning`.`afspraak_op` = :afspraak_op, 
                                                `artikel`.`naam` = :naam, 
                                                `artikel`.`prijs_ex_btw` = :prijs_ex_btw, 
                                                `klant`.`naam` = :klant_naam,
                                                `klant`.`adres` = :adres,
                                                `klant`.`plaats` = :plaats,
                                                `klant`.`telefoon` = :telefoon,
                                                `klant`.`email` = :email 
                                            WHERE `planning`.`id` = :id');
                
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':kenteken', $kenteken);
                $stmt->bindParam(':ophalen_of_bezorgen', $ophalen_of_bezorgen);
                $stmt->bindParam(':afspraak_op', $afspraak_op);
                $stmt->bindParam(':naam', $naam);
                $stmt->bindParam(':prijs_ex_btw', $prijs_ex_btw);
                $stmt->bindParam(':klant_naam', $klant_naam);
                $stmt->bindParam(':adres', $adres);
                $stmt->bindParam(':plaats', $plaats);
                $stmt->bindParam(':telefoon', $telefoon);
                $stmt->bindParam(':email', $email);
                
                $stmt->execute();
                
                header('Location: index.php?page=planning');
                exit();
            } catch (PDOException $e) {
                // Handle database errors
                echo "Error: " . $e->getMessage();
            }
        }
    }
    

    public function fetch_info_for_edit($id){
        $stmt = $this->conn->prepare('SELECT 
        `planning`.id, 
        `planning`.kenteken, 
        `planning`.`ophalen_of_bezorgen`, 
        `planning`.afspraak_op, 
        `artikel`.`naam` as `product_name`, 
        `artikel`.`prijs_ex_btw` as `product_price`,
        `klant`.`naam` as `customer_name`,
        `klant`.`adres` as `customer_address`,
        `klant`.`plaats` as `customer_city`, 
        `klant`.`telefoon` as `customer_phone`,
        `klant`.`email` as `customer_email`
    FROM 
        `planning` 
    JOIN 
        `artikel` ON `planning`.`artikel_id` = `artikel`.`id` 
    JOIN 
        `klant` ON `planning`.`klant_id` = `klant`.`id`
    WHERE 
        `planning`.id = :id;
    ');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $planning = $stmt->fetch(PDO::FETCH_OBJ);
    
        echo '<form action="" method="post">
        <!-- Planning ID (hidden) -->
        <input type="hidden" name="planning_id" value="' . $planning->id . '"><br>
        
        <!-- Kenteken -->
        <label for="kenteken">Kenteken:</label>
        <input type="text" id="kenteken" name="kenteken" required value="' . $planning->kenteken . '"><br>

        <!-- Ophalen/Bezorgen -->
        <label for="ophalen_of_bezorgen">Ophalen/Bezorgen:</label>
        <input type="text" id="ophalen_of_bezorgen" name="ophalen_of_bezorgen" required value="' . $planning->ophalen_of_bezorgen . '"><br>

        <!-- Afspraak Op -->
        <label for="afspraak_op">Afspraak Op:</label>
        <input type="text" id="afspraak_op" name="afspraak_op" required value="' . $planning->afspraak_op . '"><br>

        <!-- Product Name -->
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required value="' . $planning->product_name . '"><br>

        <!-- Product Price -->
        <label for="product_price">Product Price:</label>
        <input type="text" id="product_price" name="product_price" required value="' . $planning->product_price . '"><br>

        <!-- Customer Name -->
        <label for="customer_name">Customer Name:</label>
        <input type="text" id="customer_name" name="customer_name" required value="' . $planning->customer_name . '"><br>

        <!-- Customer Address -->
        <label for="adres">Customer Address:</label>
        <input type="text" id="adres" name="adres" required value="' . $planning->customer_address . '"><br>

        <!-- Customer City -->
        <label for="city">Customer City:</label>
        <input type="text" id="city" name="city" required value="' . $planning->customer_city . '"><br>

        <!-- Customer Phone -->
        <label for="phone">Customer Phone:</label>
        <input type="text" id="phone" name="phone" required value="' . $planning->customer_phone . '"><br>

        <!-- Customer Email -->
        <label for="customer_email">Customer Email:</label>
        <input type="text" id="customer_email" name="customer_email" required value="' . $planning->customer_email . '"><br>

        <!-- Submit Button -->
        <button type="submit" name="edit_submit">Edit Planning</button>
    </form>';

    }
    
    public function delete($id) {
        // Implementation for deleting from the database
        $stmt = $this->conn->prepare('DELETE FROM `planning` WHERE `planning`.`id` = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('Location: index.php?page=planning');
        exit();
    }    
}

?>