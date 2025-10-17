<?php
require_once './app/models/model.php';

class ItemModel extends Model{


    public function getItems() {
        $query = $this->db->prepare('
            SELECT items.*, category.nombre 
            FROM items 
            JOIN categories ON items.id_category = categories.id_category
            ORDER BY items.id_category
        ');
        $query->execute();
        
        $items = $query->fetchAll(PDO::FETCH_OBJ);
        return $items;
    }

    public function getCategoryItems($categoryId){
        $query = $this->db->prepare('SELECT * FROM items WHERE id_category=? ORDER BY id_category');
        $query->execute([$categoryId]);
        
        $items = $query->fetchAll(PDO::FETCH_OBJ);
        return $items;
    }

    
    public function getItem($id) {
        $query = $this->db->prepare('SELECT * FROM items WHERE id_item=?');
        $query->execute([$id]);
        
        $review = $query->fetch(PDO::FETCH_OBJ);
        if ($item) {
            $categoryQuery = $this->db->prepare("SELECT title FROM categories WHERE id_category = ?");
            $categoryQuery->execute([$item->id_category]);
            $movie = $categoryQuery->fetch(PDO::FETCH_OBJ);
            $item->title = $category ? $category->title : null;
        }

        return $review;
    }

    public function addItem($id_category, $nombre, $material, $precio, $disponible){
        $query = $this->db->prepare('INSERT INTO items (id_category, nombre, material, precio, disponible) VALUES (?,?,?,?,?)');
        $query->execute([$id_category, $nombre, $material, $precio, $disponible]);
    }

    public function editItem($id_category,$nombre, $material, $precio, $disponible, $id){
        $query = $this->db->prepare('UPDATE items SET id_category=?, nombre=?, material=?, precio=?, disponible=? WHERE id_item=?');
        $query->execute([$id_category, $nombre, $material, $precio, $disponible, $id]);
    }

    public function deleteItem($id){
        $query = $this->db->prepare('DELETE FROM items WHERE id_item=?');
        $query->execute([$id]);
    }

}