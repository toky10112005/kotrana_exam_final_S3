<?php
namespace app\models;

use Flight;

class ProductModel{
    private $db;
    private $table='products';

    private $id_user;
    private $id_categorie;
    private $name;
    private $description;
    private $price;
    private $picture;
    private $categorie_id;
    private $create_at;

    public function __construct($db,$id_user,$id_categorie,$name,$description,$price,$picture){
        $this->db=Flight::db();
        $this->id_user=$id_user;
        $this->id_categorie=$id_categorie;
        $this->name=$name;
        $this->description=$description;
        $this->price=$price;
        $this->picture=$picture;
    }

    public function getProduct($id_categorie){
        $query="SELECT * FROM {$this->table} WHERE id_categorie=:id_categorie";
        $stmt=$this->db->prepare($query);
        $params=[
            ':id_categorie'=>$id_categorie
        ];
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}