<?php
namespace app\controllers;

use flight\Engine;
use Flight;
use app\models\ProductModel;

class ProductController {
    protected Engine $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function getProduct($id_categorie) {
        $db = Flight::db();
        $productModel = new ProductModel($db, '', $id_categorie, '', '', '', '');
        return $productModel->getProduct($id_categorie);
    }

    public function getProductWithNameProp($id_categorie){
          $db = Flight::db();
        $productModel = new ProductModel($db, '', $id_categorie, '', '', '', '');
        return $productModel->getProductwithNameProp($id_categorie);
    }

    public function getProductUser($id_user){
        $db = Flight::db();
        $productModel = new ProductModel($db, $id_user, '', '', '', '', '');
        return $productModel->getProductUser($id_user);
    }
}