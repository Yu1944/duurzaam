<?php

//require_once 'function.php';
class categorie
{
    private $conn;
    private $id;
    private $categorie;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // view category
    public function read()
    {
    $stmt = $this->conn->prepare("SELECT * FROM `categorie` WHERE :id");
    $stmt->execute();

    $categorie =$stmt->fetchAll(PDO::FETCH_OBJ);

    echo $categorie->categorie;

    }

    // add category
    public function add()
    {

    }

    //delete category
    public function delete()
    {

    }

    // update category
    public function edit()
    {

    }
}

