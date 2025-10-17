<?php

require_once './app/models/item.model.php';
require_once './app/views/item.view.php';

class reviewController
{
    private $itemModel;
    private $categoryModel;
    private $itemView;


    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->categoryModel = new CategoryModel();
        $this->itemView = new ItemView();
    }

    public function showItems()
    {
        $items = $this->itemModel->getItems();
        $categories = $this->categoryModel->getCategories();
        $this->itemView->showItems($items, $categories);
    }

    public function showItem($id)
    {
        $item = $this->itemModel->getItem($id);
        $this->itemView->showItem($item);
    }

    public function addItem()
    {
        AuthHelper::verify();

        if (
            isset($_POST['id_category']) && ($_POST['id_category'] != null)
            && isset($_POST['nombre']) && ($_POST['nombre'] != null)
            && isset($_POST['material']) && ($_POST['material'] != null)
            && isset($_POST['precio']) && ($_POST['precio'] != null)
            && isset($_POST['disponible']) && ($_POST['disponible'] != null)
        ) {
            $id_category = $_POST['id_category'];
            $nombre = $_POST['nombre'];
            $material = $_POST['material'];
            $precio = $_POST['precio'];
            $disponible = $_POST['disponible'];

            $this->itemModel->addItem($id_category, $nombre, $material, $precio, $disponible);
            header('Location: ' . BASE_URL . 'items');
        } else {
            $this->itemView->error("Complete todos los campos para actualizar");
        }
    }
    public function editItemForm($id)
    {
        AuthHelper::verify();

        $item = $this->itemModel->getItem($id);
        $items = $this->itemModel->getItems();
        $categories = $this->categoryModel->getCategories();
        $this->itemView->editItemForm($item, $items, $categories);
    }

    public function editItem($id)
    {
        AuthHelper::verify();

        if (
            isset($_POST['id_category']) && ($_POST['id_category'] != null)
            && isset($_POST['nombre']) && ($_POST['nombre'] != null)
            && isset($_POST['material']) && ($_POST['material'] != null)
            && isset($_POST['precio']) && ($_POST['precio'] != null)
            && isset($_POST['disponible']) && ($_POST['disponible'] != null)
        ) {
            $id_category = $_POST['id_category'];
            $nombre = $_POST['nombre'];
            $material = $_POST['material'];
            $precio = $_POST['precio'];
            $disponible = $_POST['disponible'];

            $this->itemModel->editItem($id_category, $nombre, $material, $precio, $disponible, $id);
            header('Location: ' . BASE_URL . 'items');
        } else {
            $this->itemView->error("Complete todos los campos para actualizar");
        }
    }
    public function removeItem($id)
    {
        AuthHelper::verify();
        $item=$this->itemModel->getItem($id);
        if(!$item){
            $this->itemView->error("La prenda que se quiere eliminar no existe");
        }else{
            $this->itemModel->deleteItem($id);
        header('Location: ' . BASE_URL . 'items');
        }
        
    }
}