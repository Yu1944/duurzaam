<?php 
require_once 'db.php';
require_once 'functions/function_login.php';

class crud_product{
    private $conn;

    public function __construct(){
    $this->conn = connectDB();
    }

    public function read(){
    }

    public function add(){
        
    }

    public function delete(){
        
    }

    public function edit(){
        
    }
}