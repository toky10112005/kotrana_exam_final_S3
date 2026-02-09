<?php

namespace app\controllers;

use flight\Engine;
use Flight;
use app\models\UserModel;

class UserController {

	protected Engine $app;

	public function __construct($app) {
		$this->app = $app;
	}

    public function CheckUser($username,$email,$password){
        $db = Flight::db();

        $users = new UserModel($db, $username, $email, $password);

        $result=$users->CheckUser($username,$password);
        if($result){
            $id=$users->getByName($username);
            return ['nom'=>$username,'id'=>$id['id']];
        }
        else{
            $this->InsertUsers($username,$email,$password);
            return ['nom'=>$username,'id'=>$users->getByName($username)['id']];
        }
        
    }

    public function InsertUsers($username,$email,$password){
        $db = $this->app->db();
        $users = new UserModel($db, $username);

        $result=$users->Insert();
        if($result){
            
            return ['message' => 'User created successfully'];
        } else {
           
            return ['message' => 'Failed to create user'];
        }

    }


}