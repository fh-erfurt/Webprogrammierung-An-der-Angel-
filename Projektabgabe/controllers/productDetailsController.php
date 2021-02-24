<?php

namespace dwp\controller;


class ProductDetailsController extends \dwp\core\Controller
{

    // used to show product page when clicked on product
	public function actionshowProductDetails()
	{
        $db = $GLOBALS['db'];
        $productId = $_GET['id'];

        // finds product by the id given by $_GET
        $product = \dwp\model\Products::findOne('id = '.$db->quote($productId));

        // sets title of the page to product name
        $this->title = $product->name;
        // givés the product to the view
        $this->setParam('product', $product);

        // finds names to product properties where only the id is given, in the product table and gives them to the view
        $manufacturer = \dwp\model\Manufacturer::findOne('id = '.$db->quote($product->manufacturer));
        $this->setParam('manufacturer', $manufacturer);
        $material = \dwp\model\Material::findOne('id = '.$db->quote($product->material));
        $this->setParam('material', $material);
        $category = \dwp\model\Category::findOne('id = '.$db->quote($product->category));
        $this->setParam('category', $category);
        $color = \dwp\model\Color::findOne('id = '.$db->quote($product->color));
        $this->setParam('color', $color);

        // checks if submit was pressed
        if(isset($_POST['submit']))
        {
            // gets quantity input
            $quantity = $_POST['quantity']; 

            // if item already in cart adds up quantity else puts item into the Session
            if(isset($_SESSION['shoppingCart'][$productId]))
            {
                $_SESSION['shoppingCart'][$productId]['quantity'] = $_SESSION['shoppingCart'][$productId]['quantity'] + $quantity;
            }
            else
            {
                $_SESSION['shoppingCart'][$productId]['quantity']= $quantity;
            }
        }
	}
}