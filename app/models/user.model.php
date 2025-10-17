<?php
require_once './app/models/model.php';

class UserModel extends Model{

    public function getByUser($username) { //trae el user de la db
        $query = $this->db->prepare('SELECT * FROM users WHERE username=?');
        $query->execute([$username]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}