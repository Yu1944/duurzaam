<?php 
if (isset($_SESSION['role']) && $_SESSION['role'] === 'directie'|| $_SESSION['role'] === 'winkelpersoneel' ){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
        $role = $_POST['role'];
        $is_geverifieerd = $_POST['is_geverifieerd'];
        $login->register($username, $password, $role, $is_geverifieerd);
    }
    ?>
    <!-- registration_form.php -->
    <form action="" method="post"> 
        <!-- username -->
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
    
        <!-- password -->
        <label for="password">Password:</label>
        <input type="password" name="password" required>
    
        <!-- role -->
        <input type="hidden" id="role" name="role" step="0.01" value="customer" require><br>
        <label for="role">Kies rol:</label>
        <?php
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'directie') {
        ?>
            <select id="role" name="role">
                <option value="directie">directie</option>
                <option value="winkelpersoneel">winkelpersoneel</option>
                <option value="magazijnmedewerker">magazijnmedewerker</option>
                <option value="chauffeur">chauffeur</option>
            </select>
        <?php
        } else { // can only be accessed by winkelpersoneel
        ?>
            <select id="role" name="role">
                <option value="winkelpersoneel">winkelpersoneel</option>
                <option value="magazijnmedewerker">magazijnmedewerker</option>
                <option value="chauffeur">chauffeur</option>
            </select>
        <?php
        }
        ?>
        <input type="hidden" name="is_geverifieerd" id="is_geverifieerd" value="0"><br>  
        <!-- Submit Button -->
        <button type="submit" name="register_submit">Register</button>
    </form>
 <?php   
} ?>
