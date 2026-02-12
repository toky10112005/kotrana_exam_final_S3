<?php
namespace app\models;

use Flight;

class ProductModel{
    private $db;
    private $table1='products';
    private $table2='users';

    private $id_user;
    private $id_categorie;
    private $name;
    private $description;
    private $price;
    private $picture;
    private $categorie_id;
    private $created_at;

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
        $query="SELECT * FROM {$this->table1} WHERE id_categorie=:id_categorie";
        $stmt=$this->db->prepare($query);
        $params=[
            ':id_categorie'=>$id_categorie
        ];
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProductwithNameProp($id_categorie){
        $query="SELECT us.username,pro.name,pro.description,pro.price,pro.picture,pro.id_categorie,pro.created_at
            FROM products AS pro
            JOIN users AS us
            ON pro.id_categorie=:id_categorie
            AND pro.id_user=us.id";

        $stmt=$this->db->prepare($query);

        $params=[
            ':id_categorie'=>$id_categorie,  
        ];

        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProductUser($id_user){
        $query="SELECT * FROM {$this->table1} WHERE id_user=:id_user";
        $stmt=$this->db->prepare($query);
        $params=[
            ':id_user'=>$id_user
        ];
         $stmt->execute($params);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}