<?php
class login_system{
    private $conn;

    public function __construct() {
        //Makes the connection to the database
        $this->conn = connectDB();
    }

    public function login_user($username, $password) {
        // Login function

        // Check the username and hashed password in the database
        $stmt = $this->conn->prepare("SELECT * FROM `gebruiker` WHERE `gebruiker`.`gebruikersnaam` = :gebruikersnaam");
        $stmt->bindParam(':gebruikersnaam', $username);
        $stmt->execute();
        $users = $stmt->fetch(PDO::FETCH_OBJ);
        if ($users && password_verify($password, $users->wachtwoord)) {
            $_SESSION['user_id'] = $users->id;
            $_SESSION['username'] = $users->gebruikersnaam;
            $_SESSION['role'] = $users->rollen;
            header("Location: index.php?page=home");
            exit();
        } else {
            return "Invalid username or password";
        }
    }

    public function register($username,$password,$roles, $is_geverifieerd){
        $stmt = $this->conn->prepare('INSERT INTO `gebruiker`(gebruikersnaam,wachtwoord,rollen,is_geverifieerd)VALUES(:gebruikersnaam,:wachtwoord,:rollen,:is_geverifieerd)');
        $stmt->bindparam(':gebruikersnaam',$username);
        $stmt->bindparam(':wachtwoord',$password);
        $stmt->bindparam(':rollen',$roles);
        $stmt->bindparam(':is_geverifieerd',$is_geverifieerd);
        
        if($stmt->execute()){
            echo 'user gemaakt';
            header('location: index.php?page=home');
        }else{
            echo "mislukt";
        }
    }

    public function logout_user() {
        // Logout function
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?page=home");
        exit();
    }


}