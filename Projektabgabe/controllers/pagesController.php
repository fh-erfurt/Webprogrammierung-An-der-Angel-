<?php

namespace dwp\controller;


class PagesController extends \dwp\core\Controller
{

	public function actionIndex()
	{

	}

	// to show the home page
	public function actionHome()
	{

	}

	// to show the legalNotice page
	public function actionLegalNotice()
	{

	}

	// to show the privacy page
	public function actionPrivacy()
	{
		
	}

	// handels login
	public function actionLogin()
	{
		// store error message
		$errMsg = null;

		// retrieve inputs 
		$email = $_POST['email'] ?? null;
		$password = $_POST['password'] ?? null;

		// check user send login field
		if(isset($_POST['submit']))
		{

			// Validate input first
			if($email === null || mb_strlen($email) < 6)
            {
                $errMsg = 'Bitte gültige Email-Adresse eingeben';
            }

            if($password === null || mb_strlen($password) < 8)
            {
                $errMsg = 'Bitte Passwort eingeben (mindestens 8 Zeichen)';
			}
			// Check login values with database accounts
			$db = $GLOBALS['db'];
			
			$login = \dwp\model\Account::findOne('email = '.$db->quote($email));

			if($login !== null && password_verify($password, $login->password))
			{
				// stes cookies if user checked stayLoggedIn	
				if ($_POST['stayLoggedIn'])
				{
					$duration = time() + (3600 * 24 * 30);
					setcookie('userMail', $email,$duration,'/');
					setcookie('password',$password,$duration,'/');
				}
				// sets Session of account and loggedIn 
				$_SESSION['loggedIn'] = true;
				$_SESSION['account'] = $email;

				// if user got redirected to login by checkout page bring him back to checkout page otherwise to account page
				if($_SESSION['checkout']===true)
				{
					unset($_SESSION['checkout']);
					header('Location: index.php?c=pages&a=checkout');
				}
				else{
					header('Location: index.php?c=pages&a=account');
				}
			}
			else
			{
				$errMsg = 'Nutzer oder Passwort nicht korrekt.'; // if login was incorrect
			}
		}

		// set param email to prefill login input field
		$this->setParam('email', $email);
		// give errorMsg to view
		$this->setParam('errMsg', $errMsg);
	}

	// to handle signup
	public function actionSignup()
	{
		// store error message and success
		$errors = [];
		$success = false;
		

		// check user send login field
		if(isset($_POST['submit']))
		{
			// handle input fields
			$firstname = $_POST['firstname'] ?? null;
			$lastname = $_POST['lastname'] ?? null;
			$birthdate = $_POST['birthdate'] ?? null;
            $email = $_POST['email'] ?? null;
			$password = $_POST['password'] ?? null;

			$street = $_POST['street'] ?? null;
			$streetNo = $_POST['streetNo'] ?? null;
			$zip = $_POST['zip'] ?? null;
			$city = $_POST['city'] ?? null;
			$country = $_POST['country'] ?? null;


			// check if all inputs set and correct otherwise store error message
			if($firstname === null)
            {
                $errors['firstname'] = 'Bitte Vornamen eingeben';
			}
			
			if($lastname === null)
            {
                $errors['lastname'] = 'Bitte Nachnamen eingeben';
			}
			
			if($birthdate === null)
            {
                $errors['birthdate'] = 'Bitte Geburtsdatum eingeben';
            }

            if($email === null || mb_strlen($email) < 6)
            {
                $errors['email'] = 'E-Mail ist zu kurz, bitte mindestens 6 Zeichen verwenden.';
            }

            if($password === null || mb_strlen($password) < 8)
            {
                $errors['password'] = 'Passwort ist zu kurz, bitte mindestens 8 Zeichen verwenden.';
			}
			
			if($street === null)
            {
                $errors['street'] = 'Bitte Straße eingeben';
			}

			if($streetNo === null)
            {
                $errors['streetNo'] = 'Bitte Hausnummer eingeben';
			}
			
			if($zip === null || mb_strlen($zip) != 5)
            {
                $errors['zip'] = 'Die Postleitzahl muss 5 Ziffern lang sein';
			}

			if($city === null)
            {
                $errors['city'] = 'Bitte Stadt eingeben';
			}

			if($country === null)
            {
                $errors['country'] = 'Bitte Land eingeben';
			}
			
			// if no errors try to write into database 
			if(count($errors) === 0)
            {
				// check if account not already exists 
				$db = $GLOBALS['db'];
				if(empty(\dwp\model\Account::findOne('email = '.$db->quote($_POST['email']))))
				{	
					// check if address already exists
					if(empty(\dwp\model\Address::findOne('street = '.$db->quote($street).' AND streetNo = '.$db->quote($streetNo).' AND zip = '.$db->quote($zip))))
					{
						// if address not exists write new address into database
						$address = ["street"=>$street, "streetNo"=>$streetNo, "zip"=>$zip, "city"=>$city, "country"=>$country];
						\dwp\model\Address::insert($address);
					}

					// get address id of the address
					$addressToAccount = \dwp\model\Address::findOne('street = '.$db->quote($street).' AND streetNo = '.$db->quote($streetNo).' AND zip = '.$db->quote($zip));
					$addressId = $addressToAccount->id;

					// write account into database
					$account = ["firstname"=>$firstname, "lastname"=>$lastname, "birthdate"=>$birthdate, "email"=>$email, "password"=>password_hash($password, PASSWORD_DEFAULT), "address"=>$addressId];
					\dwp\model\Account::insert($account); 
				}
				// error message if account already exists
				else $errors['account'] = "Account schon vorhanden!";
			}

			// if there is no error success is true
			if(count($errors) === 0)
			{
				$success = true;
			}

		}

		// give params to view
		$this->setParam('errors', $errors);
		$this->setParam('success', $success);
	}

	// fills page "Konto"
	public function actionAccount()
	{
		// gets user from session and sets params for all user data's
		$userEmail = $_SESSION['account'];
		$db = $GLOBALS['db'];
		$user = \dwp\model\Account::findOne('email = '.$db->quote($userEmail));
		$this->setParam('firstName',$user->firstName);
		$this->setParam('lastName',$user->lastName);
		$this->setParam('birthdate',$user->birthdate);
		$this->setParam('email',$user->email);
		$address =  \dwp\model\Address::findOne('id = '.$db->quote($user->address));
		$this->setParam('street',$address->street);
		$this->setParam('streetNo',$address->streetNo);
		$this->setParam('zip',$address->zip);
		$this->setParam('city',$address->city);
		$this->setParam('country',$address->country);

		// checks if updateAcc is set -> redirects
		if(isset($_POST['updateAcc']))
		{
			header('Location: index.php?c=pages&a=updateAccount');
		}

		// checks if updateAddress is set -> redirects
		if(isset($_POST['updateAddress']))
		{
			header('Location: index.php?c=pages&a=updateAddress');
		}

		// checks if deletaAcc is set
		if(isset($_POST['deleteAcc']))
		{
			// deletes Acount from database
			\dwp\model\Account::destroy('email',$user->email);
			// derstroys session
			session_destroy();
			$duration = time() - 100;
			// unsets cookies
			setcookie('userMail', "",$duration,'/');
			setcookie('password',"",$duration,'/');
			header('Location: index.php?c=pages&a=login');
		}
	}

	// handles updateAccount
	public function actionUpdateAccount()
	{
		$db = $GLOBALS['db'];
		// store error message and success value
		$errors = [];
		$success = false;
		
		// holds collums which should be changed and the values they should be changed to 
		$keys=[];
		$values=[];
		$ArrayCount=0;

		// finds account of session in database
		$email = $_SESSION['account'];
		$user = \dwp\model\Account::findOne('email = '.$db->quote($email));
		$userId = $user->id;

		// check user send submit field
		if(isset($_POST['submit']))
		{
			// handle input fields
			$firstname = $_POST['firstname'] ?? null;
			$lastname = $_POST['lastname'] ?? null;
			$birthdate = $_POST['birthdate'] ?? null;
            $email = $_POST['email'] ?? null;
			$password = $_POST['password'] ?? null;

			// check if input was send and puts collum and values into arrays
			if($firstname != null)
            {
				$keys[$ArrayCount]= 'firstName';
				$values[$ArrayCount]= $firstname;
				$ArrayCount++;
			}

			if($lastname != null)
            {
                $keys[$ArrayCount]='lastName';
				$values[$ArrayCount]=$lastname;
				$ArrayCount++;
			}
			
			if($birthdate != null)
            {
                $keys[$ArrayCount]= 'birthdate';
				$values[$ArrayCount]= $birthdate;
				$ArrayCount++;
            }

			// checks if email is valid
            if($email != null && mb_strlen($email) < 6)
            {
                $errors['email'] = 'E-Mail ist zu kurz, bitte mindestens 6 Zeichen verwenden.';
			}
			
			if($email != null && mb_strlen($email) >= 6)
            {
                $keys[$ArrayCount]= 'email';
				$values[$ArrayCount]= $email;
				$ArrayCount++;
			}

			// checks if password is valid
            if($password != null && mb_strlen($password) < 8)
            {
                $errors['password'] = 'Passwort ist zu kurz, bitte mindestens 8 Zeichen verwenden.';
			}
			
			if($password != null && mb_strlen($password) >= 8)
            {
				$keys[$ArrayCount]= 'password';
				$values[$ArrayCount]= $password;
				$ArrayCount++;
			}
			
			// error if no input was made
			if($firstname == null && $lastname == null && $birthdate == null && $email == null && $password == null)
			{
				$errors['input']='Sie müssen mindestens ein Feld aktualisieren';
			}

			// update Account if there are no errors
			if(count($errors) === 0)
            {
				\dwp\model\Account::update($userId,$keys,$values);
				$success=true;
			}
		}

		// give params to view
		$this->setParam('errors', $errors);
		$this->setParam('success', $success);
	}

	// handles updateAddress 
	public function actionUpdateAddress()
	{
		// store error message and success value
		$errors = [];
		$success = false;
		

		// check user send login field
		if(isset($_POST['submit']))
		{
			// handle input fields

			$street = $_POST['street'] ?? null;
			$streetNo = $_POST['streetNo'] ?? null;
			$zip = $_POST['zip'] ?? null;
			$city = $_POST['city'] ?? null;
			$country = $_POST['country'] ?? null;

			
			// checks if all input fields are set and valid otherwise error
			if($street === null)
            {
                $errors['street'] = 'Bitte Straße eingeben';
			}

			if($streetNo === null)
            {
                $errors['streetNo'] = 'Bitte Hausnummer eingeben';
			}
			
			if($zip === null || mb_strlen($zip) != 5)
            {
                $errors['zip'] = 'Die Postleitzahl muss 5 Ziffern lang sein';
			}

			if($city === null)
            {
                $errors['city'] = 'Bitte Stadt eingeben';
			}

			if($country === null)
            {
                $errors['country'] = 'Bitte Land eingeben';
			}
			
			// if no errors update address table
			if(count($errors) === 0)
            {
				$db = $GLOBALS['db'];
				// check if address already exists
				if(empty(\dwp\model\Address::findOne('street = '.$db->quote($street).' AND streetNo = '.$db->quote($streetNo).' AND zip = '.$db->quote($zip))))
				{
					$address = ["street"=>$street, "streetNo"=>$streetNo, "zip"=>$zip, "city"=>$city, "country"=>$country];
					\dwp\model\Address::insert($address);
				}

				// gets addressId of inputted address
				$addressToAccount = \dwp\model\Address::findOne('street = '.$db->quote($street).' AND streetNo = '.$db->quote($streetNo).' AND zip = '.$db->quote($zip));
				$addressId = $addressToAccount->id;

				// gets user from session and updates address
				$email = $_SESSION['account'];
				$user = \dwp\model\Account::findOne('email = '.$db->quote($email));
				$userId = $user->id;
				$keys[0]='address';
				$values[0]=$addressId;
				\dwp\model\Account::update($userId,$keys,$values); 

				$success = true;
			}
		}

		// gives params to view
		$this->setParam('errors', $errors);
		$this->setParam('success', $success);
	}

	// handles logout
	public function actionLogout()
	{
		// destrtoyes Session and unsets Cookies redirects to login
		session_destroy();
		$duration = time() - 100;
		setcookie('userMail', "",$duration,'/');
		setcookie('password',"",$duration,'/');
		header('Location: index.php?c=pages&a=login');
	}

	// fills page "Warenkorb"
	public function actionShoppingCart()
	{
		if(isset($_POST['submit']))
        {
			foreach($_POST['quantity'] as $key => $val) { 
				if($val==0) { 
					unset($_SESSION['shoppingCart'][$key]); // unsets Session of products with quantity of 0
				}else{ 
					$_SESSION['shoppingCart'][$key]['quantity']=$val; // updates quantity of products in cart to inputed value
				}  
			}
		} 
	}

	// fills page "Kasse"
	public function actionCheckout()
	{
		$db = $GLOBALS['db'];
		$checkedOut = false;
		
		// check user send submit field
		if(isset($_POST['buy']))
		{		
			// checks if user is logged in		
			if($this->loggedIn())
			{
				// gets input of paymethod
				$paymethodName = $_POST['paymethod'];
				
				// get paymethod and user
				$paymethod = \dwp\model\PayMethod::findOne('name = '.$db->quote($paymethodName));
				$user = \dwp\model\Account::findOne('email = '.$db->quote($_SESSION['account']));
				// writes order into database
				$order = ["payMethod"=>$paymethod->id, "account"=>$user->id];
				$orderId = \dwp\model\Order::insert($order);

				// writes orderitems for each product into database
				foreach($_SESSION['shoppingCart'] as $id => $quantity)
				{
					$orderItems = ["`order`"=>$orderId, "products"=>$id, "quantity"=>$_SESSION['shoppingCart'][$id]['quantity']];
					\dwp\model\OrderItems::insert($orderItems);
					// deletes shoppingCart in the Session
					unset($_SESSION['shoppingCart'][$id]);
				}
				$checkedOut = true;
			}
			// redirects to login if not logged in ands sets session of checkout to come back to checkout
			else
			{
				$_SESSION['checkout']=true;
				header('Location: index.php?c=pages&a=login');
			}
		}

		// gives params to view
		$this->setParam('checkedOut',$checkedOut);
	}
}