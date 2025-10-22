<?php
require_once './app/models/db.model.php';

class ItemModel extends Model{


    public function getItems() {
        $query = $this->db->prepare('
        SELECT 
            a.id,
            a.nombre AS prendaNombre, 
            a.material AS prendaMaterial,
            a.precio AS prendaPrecio, 
            a.disponible AS prendaDisponible, 
            b.nombre AS categoriaNombre
        FROM prenda a
        INNER JOIN categoria b
            ON a.id_categoria = b.id
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
<<<<<<< HEAD
    $query = $this->db->prepare('
        SELECT
        
            a.nombre AS prendaNombre,
            a.material AS prendaMaterial,
            a.precio AS prendaPrecio,
            a.disponible AS prendaDisponible,
            b.nombre AS categoriaNombre
        FROM prenda a
        INNER JOIN categoria b
            ON a.id_categoria = b.id
        WHERE a.id = ?
    ');
    
    $query->execute([$id]);
    $item = $query->fetch(PDO::FETCH_OBJ);

    return $item;
}

=======
        $query = $this->db->prepare('
            SELECT 
                a.nombre AS prendaNombre,
                a.material AS prendaMaterial,
                a.precio AS prendaPrecio,
                a.disponible AS prendaDisponible,
                a.descripcion AS prendaDescripcion,
                b.nombre AS categoriaNombre
            FROM prenda a
            INNER JOIN categoria b
                ON a.id_categoria = b.id
            WHERE a.id = ?
        ');
        
        $query->execute([$id]);
        $item = $query->fetch(PDO::FETCH_OBJ);

        return $item;
    }
>>>>>>> 3107f78efa7093d8b422f680fcbf42e1a41588c1

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