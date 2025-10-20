<?php

    require_once './app/models/category.model.php';
    require_once './app/models/item.model.php';
    require_once './app/views/category.view.php';

    class CategoryController
{
    private $categoryModel;
    private $categoryView;
    private $itemModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->categoryView = new CategoryView();
        $this->itemModel = new ItemModel();
    }

    public function showCategories()
    {
        AuthHelper::verify();
        $categories = $this->categoryModel->getCategories();
        $this->categoryView->showCategories($categories);
    }

    public function showCategory($id)
    {
        AuthHelper::verify();
        $category = $this->categoryModel->getCategory($id);
        $items = $this->itemModel->getCategoryItems($id);
        $this->categoryView->showCategory($category, $items);
    }

    public function addCategory()
    {
        AuthHelper::verify();

        if (
            isset($_POST['nombre']) && ($_POST['nombre'] != null)
            && isset($_POST['descripcion']) && ($_POST['descripcion'] != null)
            && isset($_POST['responsable']) && ($_POST['responsable'] != null)
        ) {

            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $responsable = $_POST['responsable'];

            $this->categoryModel->addCategory($nombre, $descripcion, $responsable);
            header('Location: ' . BASE_URL . 'categories');
        } else {
            $this->categoryView->error("Complete todos los campos para agregar");
        }
    }
    public function editCategoryForm($id)
    {
        AuthHelper::verify();

        $category = $this->categoryModel->getCategory($id);
        $categories = $this->categoryModel->getCategories();
        $this->categoryView->editCategoryForm($category, $categories);
    }

    public function editCategory($id)
    {
        AuthHelper::verify();
        if (
            isset($_POST['nombre']) && ($_POST['nombre'] != null)
            && isset($_POST['descripcion']) && ($_POST['descripcion'] != null)
            && isset($_POST['responsable']) && ($_POST['responsable'] != null)
        ) {

            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $responsable = $_POST['responsable'];

            $this->categoryModel->editCategory($nombre, $descripcion, $responsable, $id);
            header('Location: ' . BASE_URL . 'categories');
        } else {
            $this->categoryView->error("Complete todos los campos para actualizar");
        }
    }
    public function removeCategory($id)
    {
        AuthHelper::verify();
        $category = $this->categoryModel->getCategory($id);
        if (!$category) {
            $this->categoryView->error("La categoria que se quiere eliminar no existe");
        } else {
            $this->categoryModel->deleteCategory($id);
            header('Location: ' . BASE_URL . 'categories');
        }
    }
}
    