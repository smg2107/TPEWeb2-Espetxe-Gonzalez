<?php
require_once './app/models/db.model.php';

class ItemModel extends Model{


    public function getItems() {
        $query = $this->db->prepare('
            SELECT *
            FROM prenda
            ');
        $query->execute();
        
        $items = $query->fetchAll(PDO::FETCH_OBJ);
        return $items;
    }

    public function getCategoryItems($categoryId){
        $query = $this->db->prepare('SELECT * FROM prenda WHERE id=? ORDER BY id');
        $query->execute([$categoryId]);
        
        $items = $query->fetchAll(PDO::FETCH_OBJ);
        return $items;
    }

    
    public function getItem($id) {
        $query = $this->db->prepare('SELECT * FROM prenda WHERE id=?');
        $query->execute([$id]);
        
        $item = $query->fetch(PDO::FETCH_OBJ);

        if ($item) {
            $categoryQuery = $this->db->prepare("SELECT * FROM categoria WHERE id = ?");
            $categoryQuery->execute([$item->id]);
            $category  = $categoryQuery->fetch(PDO::FETCH_OBJ);
            $item->nombre = $category ? $category->nombre : null;
        }

        return $item;
    }

    public function addItem($id_category, $nombre, $material, $precio, $disponible){
        $query = $this->db->prepare('INSERT INTO prenda (id_categoria, nombre, material, precio, disponible) VALUES (?,?,?,?,?)');
        $query->execute([$id_category, $nombre, $material, $precio, $disponible]);
    }

    public function editItem($id,$id_category, $nombre, $material, $precio, $disponible){
        $query = $this->db->prepare('UPDATE prenda SET id_categoria=?, nombre=?, material=?, precio=?, disponible=? WHERE id=?');
        $query->execute([$id,$id_category, $nombre, $material, $precio, $disponible]);
    }

    public function deleteItem($id){
        $query = $this->db->prepare('DELETE FROM prenda WHERE id=?');
        $query->execute([$id]);
    }

}