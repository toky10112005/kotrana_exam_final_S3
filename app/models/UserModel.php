<?php

namespace app\models;

class UserModel {
    
    private $db;
    private $table = 'users';
    
    // Properties
    public $id;
    public $username;
    public $email;
    public $password;
    public $created_at;
    
    public function __construct($db,$username, $email, $password) {
        $this->db = $db;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
    
    /**
     * Get all users
     */
    // public function getAll() {
    //     $query = "SELECT * FROM {$this->table} ORDER BY createdAt DESC";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->execute();
    //     return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    // }
    
    /**
     * Get user by ID
     */
        public function getById($id) {
            $query = "SELECT * FROM {$this->table} WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

    /*Get by username*/
     public function getByName($username) {
        $query = "SELECT id FROM {$this->table} WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
   
    /**
     * Create a new user
     */
    public  function Insert() {
        // Validate data
        if (!$this->validate()) {
            return false;
        }
        
        $query = "INSERT INTO {$this->table} 
                  (username,email,password,created_at) 
                  VALUES 
                  (:username,:email,:password,NOW())";
        
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        
        return $stmt->execute();
    }


    /*  Check users*/
    public function CheckUser($username,$password){
        $password=password_hash($password, PASSWORD_DEFAULT);
        $query ="SELECT * FROM {$this->table} WHERE username=:username AND password=:password";
        $stmt=$this->db->prepare($query);
        $stmt->bindParam(':username',$username);
        $stmt->bindParam(':password',$password);
        $stmt->execute();
        $result=$stmt->fetch(\PDO::FETCH_ASSOC);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public function checkEmail($email){
        $query ="SELECT * FROM {$this->table} WHERE email=:email";
        $stmt=$this->db->prepare($query);
        $stmt->bindParam(':email',$email);
        $stmt->execute();
        $result=$stmt->fetch(\PDO::FETCH_ASSOC);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * Update user
     */
    // public function update() {
        
    //     $query = "UPDATE {$this->table} 
    //               SET username = :username
    //               WHERE id = :id";
        
    //     $stmt = $this->db->prepare($query);
        
    //     $stmt->bindParam(':id', $this->id);
    //     $stmt->bindParam(':username', $this->username);
        
        
    //     return $stmt->execute();
    // }
    
    
    /**
     * Delete user
     */
    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
    
    /**
     * Validate user data
     */
    private function validate() {
        // Validate username
        if (empty($this->username) || strlen($this->username) < 3) {
            return false;
        }
        if(empty($this->password) || strlen($this->password) < 6){
            return false;
        }

       $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        
        return true;
    }
    
    
    /**
     * Count total users
     */
    public function count() {
        $query = "SELECT COUNT(*) as total FROM {$this->table}";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total'];
    }
    
    /**
     * Search users
     */
    public function search($keyword) {
        $query = "SELECT * FROM {$this->table} 
                  WHERE username LIKE :keyword 
                  ORDER BY createdAt DESC";
        
        $stmt = $this->db->prepare($query);
        $keyword = "%{$keyword}%";
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    
}
