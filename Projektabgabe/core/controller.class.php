<?php

namespace dwp\core;

class Controller
{
	protected $controller  = null;	// stores the called controller name
	protected $action 	   = null;	// stores the called action name
	protected $currentUser = null;  // store current logged in user here

	protected $params = [];			// stores useful params for view rendering

	public $title = 'An der Angel'; // show title

	public function __construct($controller, $action)
	{
		$this->controller = $controller; // errors
		$this->action = $action; // error404

		if($this->loggedIn())
		{

		}
	}

	/**
	 * Check a valid login is available for this current session
	 * @return Boolean 		true if the user logged in otherwise false
	 */
	public function loggedIn()
	{
		return ( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true);
	}

	/**
	 * Render the correct view for the controller and action, using the params array to extract variables for the view
	 */
	public function render()
	{
		// generate the view path
		$viewPath = VIEWSPATH.$this->controller.DIRECTORY_SEPARATOR.$this->action.'.php';

		// check the file exists
		if(!file_exists($viewPath))
		{
			// redirect to error page 404 because not found
			header('Location: index.php?c=errors&a=error404&error=viewpath');
			exit(0);
		}

		// extract the params array to get all needed variables for the view
		extract($this->params);
		
		// just include the view here, it's like putting the code of the php file by copy paste on this position.
		include $viewPath;
	}

	/**
	 * Setter for params, which will be used for the render method
	 * @param  String $key   Key in the param array
	 * @param  Mixed  $value Key value
	 */
	protected function setParam($key, $value = null)
	{
		$this->params[$key] = $value;
	}

	// redirects to the given page
	public function redirect($url)
	{
		header('Location: '.$url);
        exit(0);
	}

	// finds items that are in both arrays
	public function matchingItems($array1, $array2)
	{
		foreach($array1 as $item)
        {
        	$match = false;
        	foreach($array2 as $compare)
        	{
                if($item == $compare)
                {
                    $match = true;
                    break;
                }
        	}
        	if($match === false)
        	{
                unset($array1[array_search($item,$array1)]);
        	}
		}
		return $array1;
	}

	public function __destruct()
	{
		$this->controller = null;
		$this->action = null;
		$this->params = null;
	}
}