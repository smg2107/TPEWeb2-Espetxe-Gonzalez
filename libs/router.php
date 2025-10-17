<?php
    require_once 'app/controllers/category.controller.php';
	require_once 'app/controllers/item.controller.php';
	require_once 'app/controllers/auth.controller.php';

    define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

    $action = 'category';

    if (!empty($_GET['action'])) {
		$action = $_GET['action'];
	}

	$params = explode('/', $action);

	/*TABLA DE RUTEO

		ACCION                         URL                      DESTINO

		Mostrar todos los items        /item                 	item.controller->showItems()
		Mostrar item                   /item/id             	item.controller->showItem($id)
		Cargar item                    /addItem             	item.controller->addItem()
		Modificar item                 /editItemForm/id       	item.controller->editItemForm($id)
		Enviar cambios                 /editItem/id           	item.controller->editItem($id)
		Eliminar item                  /removeItem/id         	item.controller->remove($id)

		Mostrar todas las categorias   /categories              category.controller->showCategories()
		Mostrar categoria              /categories/id           category.controller->showCategory($id)
		Cargar categoria               /addCategory             category.controller->addCategory()
		Modificar categoria            /editCategoryForm/id     category.controller->editCategoryForm($id)
		Enviar cambios                 /editCategory/id         category.controller->editCategory($id)
		Eliminar categoria             /removeCategory/id       category.controller->remove($id)

		Loguear                        /login                   auth.controller->login()
		Autenticacion                  /auth                    auth.controller->auth()
		Desloguear                     /logout                  auth.controller->logout()
		*/


	switch ($params[0]) {
		case 'items':
			$controller = new ItemController();
			if (isset($params[1])) {
				$controller->showItem($params[1]);
				break;
			}
			$controller->showItemss();
			break;
		case 'addItem':
			$controller = new ItemController();
			$controller->addItem();
			break;
		case 'editItemForm':
			$controller = new ItemController();
			$controller->editItemForm($params[1]);
			break;    
		case 'editItem':
			$controller = new ItemController();
			$controller->editItem($params[1]);
			break;
		case 'removeItem':
			$controller = new ItemController();
			$controller->removeItem($params[1]);
			break;

		case 'categories':
			$controller = new CategoryController();
			if (isset($params[1])) {
				$controller->showCategory($params[1]);
				break;
			}
			$controller->showCategories();
			break;
		case 'addMovie':
			$controller = new CategoryController();
			$controller->addCategory();
			break;
		case 'editCategoryForm':
			$controller = new CategoryController();
			$controller->editCategoryForm($params[1]);
			break;
		case 'editCategory':
			$controller = new CategoryController();
			$controller->editCategory($params[1]);
			break;
		case 'removeCategory':
			$controller = new CategoryController();
			$controller->removeCategory($params[1]);
			break;

		case 'login':
			$controller = new AuthController();
			$controller->login();
			break;
		case 'auth':
			$controller = new AuthController();
			$controller->auth();
			break;
		case 'logout':
			$controller = new AuthController();
			$controller->logout();
			break;
	}