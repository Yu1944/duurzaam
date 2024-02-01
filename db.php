<?php
function connectDB(){
    $servername="localhost";
    $username="root";
    $password ="";
    $db_name = "duurzaam";
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$db_name",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
        return $conn;
    }catch(PDOEXCEPTION $e){
        die('connection failed:'. $e->getMessage());
    }
}