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
        require './templates/categories/showCategories.phtml'; //que estamos requiriendo aca
    }
    public function error($errorString){
        require './templates/layout/error.phtml';
    }
}