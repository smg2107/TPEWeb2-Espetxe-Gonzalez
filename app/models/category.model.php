<?php
require_once './app/models/model.php';

class CategoryModel extends Model {

    public function getCategories() {
        $query = $this->db->prepare('SELECT * FROM categories ORDER BY nombre');
        $query->execute();
        
        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }

    public function getCategory($id) {
        $query = $this->db->prepare('SELECT * FROM categories WHERE id_category=?');
        $query->execute([$id]);
        
        $category = $query->fetch(PDO::FETCH_OBJ);
        return $category;
    }

    public function addCategory($nombre, $descripcion, $responsable){
        $query = $this->db->prepare('INSERT INTO categories (nombre, descripcion, responsable) VALUES (?, ?, ?)');
        $query->execute([$nombre, $descripcion, $responsable]);
    }
    public function editCategory($nombre, $descripcion, $responsable,$id){
        $query = $this->db->prepare('UPDATE categories SET nombre=?, descripcion=?, responsable=? WHERE id_category=?');
        $query->execute([$nombre, $descripcion, $responsable, $id]);
    }
    public function deleteCategory($id){
        $query = $this->db->prepare('DELETE FROM categories WHERE id_category=?');
        $query->execute([$id]);
    }
}