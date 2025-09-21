<?php

require_once "database.php";
class Books{
    public $id = "";
    public $title = "";
    public $author = "";
    public $genre = "";
    public $publicationyear = "";

    protected $db;

    public function __construct(){
        $this->db = new Database();
    }
    public function addbooks(){
        $sql = "INSERT INTO books (title, author, genre, publicationyear) VALUE(:title, :author, :genre, :publicationyear)";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(":title", $this->title);
        $query->bindParam(":author", $this->author);
        $query->bindParam(":genre", $this->genre);
        $query->bindParam(":publicationyear", $this->publicationyear);

        return $query->execute();

    }

    public function viewBooks(){
        $sql ="SELECT * FROM books ORDER BY title ASC;";
        $query = $this->db->connect()->prepare($sql);

        if($query->execute()){
            return $query->fetchAll();
        }else{
             return null;
        }
           
    }

}
/*
$obj = new Books();
$obj->title = "laptop 10p";
$obj->author = "Gadget";
$obj->genre = "science";
$obj->publicationyear = "2005";

var_dump($obj->addBooks());
*/


