<?php


namespace dwp\controller;

class ErrorsController extends \dwp\core\Controller
{

    // fills error page
	public function actionError404()
	{
        $errorMessage = 'Seite konnte nicht gefunden werden';

        if(isset($_GET['error']))
        {
            switch($_GET['error'])
            {
                case 'nocontroller':
                    $errorMessage = 'Seite konnte nicht gefunden werden.';
                    break;
                case 'viewpath':
                    $errorMessage = 'View konnte nicht gefunden werden.';
                    break;
            }
        }

        $this->title = 'Error 404 | '.$this->title;

        // give the error message variable to the view, so we can show it to our customers
        $this->setParam('errorMessage', $errorMessage);
	}
}