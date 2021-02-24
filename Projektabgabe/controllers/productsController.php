<?php

namespace dwp\controller;


class ProductsController extends \dwp\core\Controller
{
        // fills page "Angebote"
        public function actionSale()
        {
                // finds all products that are on sale
                $products = \dwp\model\Products::find('discount != 0 ORDER BY discount DESC'); 
                $this->setParam('products', $products); // gives result to view
        }

        // fills page "Produkte"
	public function actionProducts()
	{
                $db = $GLOBALS['db'];
                $products = \dwp\model\Products::find();

                //checks if minimum or maximum price is set
                $priceMin = $_POST['priceMin'] ?? null;
                $priceMax = $_POST['priceMax'] ?? null;

                // filters products matching the input
                if(isset($_POST['submit'])){
                        // checks if priceMin is not set or invalid
                        if($priceMin === null || !is_numeric($_POST['priceMin']))
                        {
                                $priceMin=0; // lowest possible price = default
                        }
                        else
                        {
                                if(is_numeric($_POST['priceMin']))
                                {
                                        $priceMin=$_POST['priceMin']; // sets priceMin to input
                                }
                        }
                        // check if priceMax is not set or invalid
                        if($priceMax === null || !is_numeric($_POST['priceMax']))
                        {
                                // sets priceMax to maximum price of the database = default
                                $db = $GLOBALS['db'];
                                $sqlStr = "SELECT MAX(price) FROM products;";
                                $maxPrice = $db->query($sqlStr)->fetchAll();
                                $priceMax=$maxPrice[0]["MAX(price)"];
                        }
                        else
                        {
                                if(is_numeric($_POST['priceMax']))
                                {
                                        $priceMax=$_POST['priceMax']; // sets priceMax to input
                                }
                        }
                        // gets products matching the price
                        $priceStr = 'price >= '.$db->quote($priceMin).' AND price <= '.$db->quote($priceMax);
                        $productsPrice = \dwp\model\Products::find($priceStr);

                        // checks if at least one category is checked
                        if(isset($_POST['category']))
                        {
                                // gets products matching the categories
                                $categoryStr = '';
                                foreach($_POST['category'] as $id)
                                {
                                        $categoryStr.= 'category = '.$db->quote($id).' OR ';    
                                }
                                $categoryStr = rtrim($categoryStr, ' OR ');
                                $productsCategory = \dwp\model\Products::find($categoryStr);
                                //finds products matching categories and price
                                $productsCategoryPrice = $this->matchingItems($productsPrice,$productsCategory);
                        }

                        // checks if at least one manufacturer is checked
                        if(isset($_POST['manufacturer']))
                        {
                                // gets all products matching the manufacturers
                                $manufacturerStr = '';
                                foreach($_POST['manufacturer'] as $id)
                                {
                                        $manufacturerStr.= 'manufacturer = '.$db->quote($id).' OR ';    
                                }
                                $manufacturerStr = rtrim($manufacturerStr, ' OR ');
                                $productsManufacturer = \dwp\model\Products::find($manufacturerStr);
                                // finds products matching manufacturers and price
                                $prouctsManufacturerPrice = $this->matchingItems($productsPrice,$productsManufacturer);
                        }

                        // checks which filters are set and choose the right result
                        if(isset($_POST['manufacturer']) && isset($_POST['category']))
                        {
                                $productsFilter = $this->matchingItems($prouctsManufacturerPrice,$productsCategoryPrice);
                             
                        }
                        elseif(isset($_POST['category']))
                        {
                                $productsFilter = $productsCategoryPrice;
                        }
                        elseif(isset($_POST['manufacturer']))
                        {
                                $productsFilter = $prouctsManufacturerPrice;
                        }
                        else
                        {
                                $productsFilter = $productsPrice;
                        }

                        $products = $this->matchingItems($products,$productsFilter);
                }

                // gives list of filtered products to view
                $this->setParam('products',$products);
	}

        // fills subpages of "Produkte"
	public function actionshowCategoryProducts()
	{
                $db = $GLOBALS['db'];
                $categoryId = $_GET['id'];

                // finds category by the id given by $_GET
                $category = \dwp\model\Category::findOne('id = '.$db->quote($categoryId));

                // sets title of the page to category name
                $this->title = $category->name;
                // givés the category to the view
                $this->setParam('category', $category);

                $products = \dwp\model\Products::find('category = '.$db->quote($categoryId));

                $priceMin = $_POST['priceMin'] ?? null;
                $priceMax = $_POST['priceMax'] ?? null;

                 // filters products matching the input
                if(isset($_POST['submit'])){
                        // checks if priceMin is not set or invalid
                        if($priceMin === null || !is_numeric($_POST['priceMin']))
                        {
                                $priceMin=0; // lowest possible price = default
                        }
                        else
                        {
                                if(is_numeric($_POST['priceMin']))
                                {
                                        $priceMin=$_POST['priceMin']; // sets priceMin to input
                                }
                        }
                        // check if priceMax is not set or invalid
                        if($priceMax === null || !is_numeric($_POST['priceMax']))
                        {
                                // sets priceMax to maximum price of the database = default
                                $db = $GLOBALS['db'];
                                $sqlStr = "SELECT MAX(price) FROM products;";
                                $maxPrice = $db->query($sqlStr)->fetchAll();
                                $priceMax=$maxPrice[0]["MAX(price)"];
                        }
                        else
                        {
                                if(is_numeric($_POST['priceMax']))
                                {
                                        $priceMax=$_POST['priceMax']; // sets priceMax to input
                                }
                        }
                        // gets products matching the price
                        $priceStr = 'price >= '.$db->quote($priceMin).' AND price <= '.$db->quote($priceMax);
                        $productsPrice = \dwp\model\Products::find($priceStr);

                        // checks if at least one manufacturer is checked
                        if(isset($_POST['manufacturer']))
                        {
                                $manufacturerStr = '';
                                foreach($_POST['manufacturer'] as $id)
                                {
                                        $manufacturerStr.= 'manufacturer = '.$db->quote($id).' OR ';    
                                }
                                $manufacturerStr = rtrim($manufacturerStr, ' OR ');
                                $productsManufacturer = \dwp\model\Products::find($manufacturerStr);
                                // finds products matching manufacturers and price
                                $prouctsManufacturerPrice = $this->matchingItems($productsPrice,$productsManufacturer);
                        }

                        // checks which filters are set and choose the right result
                        if(isset($_POST['manufacturer']))
                        {
                                $productsFilter = $prouctsManufacturerPrice;
                        }
                        else
                        {
                                $productsFilter = $productsPrice;
                        }
                        
                        $products = $this->matchingItems($products,$productsFilter);
                }

                // gives list of filtered products to view
                $this->setParam('products', $products);
	}
}