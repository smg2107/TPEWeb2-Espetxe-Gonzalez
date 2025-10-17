<?php
require_once './app/views/view.php';

class CategoryView extends View{

    public function showCategories($categories){
        $form= './templates/categories/formAddCategory.phtml';
        require './templates/categories/showCategories.phtml';
    }
    public function showCategory($category, $items){
        require './templates/categories/detailCategory.phtml';
    }
    public function editCategoryForm($category, $categories){
        $form = './templates/categories/formUpdateCategory.phtml';
        require './templates/list.categories.phtml';
    }
    public function error($errorString){
        require './templates/layout/error.phtml';
    }
}