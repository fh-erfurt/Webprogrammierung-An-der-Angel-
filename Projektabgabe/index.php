<?php

// load needed variables/defines/configs
require_once 'config/init.php';
require_once 'config/database.php';

// load core stuff
require_once COREPATH.'functions.php';
require_once COREPATH.'controller.class.php';
require_once COREPATH.'model.class.php';


// load all created models
foreach(glob(MODELSPATH.'*.php') as $modelclass)
{
    require_once $modelclass;
}

// start session to handle login
session_start();

if(isset($_COOKIE['userMail']) && isset($_COOKIE['password']))
{
    $email = $_COOKIE['userMail'];
    $password = $_COOKIE['password'];
    $login = \dwp\model\Account::findOne('email = '.$db->quote($email));
    if($login !== null && password_verify($password, $login->password))
	{
        $_SESSION['loggedIn'] = true;
        $_SESSION['account'] = $email;
    }
}

// check which controller should be loaded
$controllerName = 'pages'; // default controller if nothing is set
$actionName = 'home'; // default action if nothing is set

// check a controller is given
if(isset($_GET['c']))
{
    $controllerName = $_GET['c'];
}

// check an action is given
if(isset($_GET['a']))
{
    $actionName = $_GET['a'];
}

// check controller/class and method exists
if(file_exists(CONTROLLERSPATH.$controllerName.'Controller.php'))
{
    // include the controller file
    require_once CONTROLLERSPATH.$controllerName.'Controller.php';

    // generate the class name of the controller using the name extended by Controller
    // also add the namespace in front
    $className = '\\dwp\\controller\\'.ucfirst($controllerName).'Controller'; 

    // generate an instace of the controller using the name, stored in $className
    $controller = new $className($controllerName, $actionName);

    // checking the method is available in the controller class
    $actionMethod = 'action'.ucfirst($actionName);
    if(!method_exists($controller, $actionMethod))
    {
        // redirect to error page 404 because not found
        header('Location: index.php?c=errors&a=error404');
        exit(0);
    }
    else
    {
        // call the action method to do the job
        // so the action can fill the params for the view which will be used 
        // in the render process later
        $controller->{$actionMethod}();
    }
}
else
{
    // redirect to error page 404 because not found
    header('Location: index.php?c=errors&a=error404&error=nocontroller');
    exit(0);
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style.css">
    <title><?=$controller->title ?? 'Kein Titel'?></title>
    <script src="assets/js/functions.js"></script>
</head>
<body>
    <div class="header">
        <div class="logo-item"><img src="<?=IMGPATH.'logo.jpg'?>" alt="LOGO" width='300'></div>
        
        <!-- menu button for mobile version -->
        <input type="checkbox" id="hamburg-nav">
        <label for="hamburg-nav" class="hamburg-nav">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </label>

        <nav class="topmenu">
            <ul>
                <li>
                    <a href="index.php?c=pages&a=home">Startseite</a>
                </li>
                <li>
                    <a href="index.php?c=products&a=sale">Angebote</a>
                </li>
                <div class="dropdown">
                    <li>
                        <a class="dropMenu" href="index.php?c=products&a=products">Produkte</a>
                        <div class="dropdown-content">
                            <ul>
                                <?php $categories = \dwp\model\Category::find(); ?>
                                <!-- uses categories in the database to create the menu -->
                                <?php foreach($categories as $category) : ?>
                                    <li>
                                        <a href="index.php?c=products&a=showCategoryProducts&id=<?=$category->id;?>"><?=$category->name;?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </li>
                </div>
                <li>
                    <a href="index.php?c=pages&a=shoppingCart">Warenkorb</a>
                </li>
                <li>
                    <?php if ($controller->loggedIn()) : ?>
                        <a href="index.php?c=pages&a=account">Konto</a>
                    <?php else : ?>
                        <a href="index.php?c=pages&a=login">Konto</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </div>
    <?php

        // this method will render the view of the called action
        // for this the the file in the views directory will be included
        $controller->render();
    ?>

<footer>
    <nav>
        <ul>
            <li>
                <a href="index.php?c=pages&a=legalNotice">Impressum</a>
            </li>
            <li>
                <a href="index.php?c=pages&a=privacy">Datenschutz</a>
            </li>
        </ul>
    </nav>
</footer>

</body>
</html>