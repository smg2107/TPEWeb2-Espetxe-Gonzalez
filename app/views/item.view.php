<?php
require_once './app/views/view.php';

class ItemView extends View{

    public function showItems($items, $categories){
        $form= './templates/item/formAddItem.phtml';
        require './templates/item/showItems.phtml';
    }

    public function showItem($item){
        require './templates/item/showItemDetail.phtml';
    }
    public function editItemForm($item, $items, $categories){
        $form = './templates/item/formUpdateItem.phtml';
        require './templates/item/showItems.phtml';
    }
    public function error($errorString){
        require './templates/layout/error.phtml';
    }
}