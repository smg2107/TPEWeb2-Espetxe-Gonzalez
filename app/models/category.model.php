<?php
require_once './app/models/item.model.php';

class CategoryModel extends Model {

    public function getCategories() {
        $query = $this->db->prepare('SELECT * FROM categoria ORDER BY nombre');
        $query->execute();
        
        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }

    public function getCategory($id) {
        $query = $this->db->prepare('SELECT * FROM categoria WHERE id=?');
        $query->execute([$id]);
        
        $category = $query->fetch(PDO::FETCH_OBJ);
        return $category;
    }

    public function addCategory($nombre, $descripcion, $responsable){
        $query = $this->db->prepare('INSERT INTO categoria (nombre, descripcion, responsable) VALUES (?, ?, ?)');
        $query->execute([$nombre, $descripcion, $responsable]);
    }
    public function editCategory($nombre, $descripcion, $responsable,$id){
        $query = $this->db->prepare('UPDATE categoria SET nombre=?, descripcion=?, responsable=? WHERE id=?');
        $query->execute([$nombre, $descripcion, $responsable, $id]);
    }
    public function deleteCategory($id){
        $query = $this->db->prepare('DELETE FROM categoria WHERE id=?');
        $query->execute([$id]);
    }
}