<?php 
namespace app\controller;

use app\model\UserModel;

/**
 * OOP
 * MainController controller, use for responding to User input
 */
class MainController
{
	// property
	private $userModel;

	// constructor used to creat new UserModel object for later (& login & register & validation)
	public function __construct()
	{
		$this->userModel = new UserModel();
	}

	public function home()
	{
		$this->view('home.php', []);
	}

	public function view($name, $data) 
	{
		require '../app/view/pages/' . $name;
	}

	public function login()
	{
		$this->view('login.php', []);
	}

	public function register()
	{
		//////////////////////////////////////////////////////////
		// echo 'Register in progress';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // create data 
            $data = [
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'phoneNumber' => trim($_POST['phoneNumber']),
                'homeAdress' => trim($_POST['homeAdress']),

                'firstnameErr' => '',
                'lastnameErr' => '',
                'emailErr' => '',
                'passwordErr' => '',
                'phoneNumberErr' => '',
                'homeAdressErr' => '',
            ];

            //////////////////////////////////////////////////////////
            // Validation firstname
            if (empty($data['firstname'])) {
                $data['firstnameErr'] = "Please enter Your Firstname";
            } else if (strlen($data['firstname']) > 40) {
                $data['firstnameErr'] = "Please enter less then 40 letters";
              // preg_match('/^[\p{L} ]+$/u' - allows only letters from any language  
            } else if (!preg_match('/^[\p{L} ]+$/u', $data['firstname'])) {
                $data['firstnameErr'] = "Please only use letters";
            }
            	

            //////////////////////////////////////////////////////////
            // Validation lastname 
            if (empty($data['lastname'])) {
                $data['lastnameErr'] = "Please enter Your Lastname";
            } else if (strlen($data['lastname']) > 40) {
                $data['lastnameErr'] = "Please enter less then 40 letters";
              // preg_match('/^[\p{L} ]+$/u' - allows only letters from any language  
            } else if (!preg_match('/^[\p{L} ]+$/u', $data['lastname'])) {
                $data['lastnameErr'] = "Please only use letters";
            } 

            //////////////////////////////////////////////////////////
            // Validation email
            if (empty($data['email'])) {
                $data['emailErr'] = "Please enter Your Email";
              // filter_var($data['email'] - check email correct format 
            } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailErr'] = "Please enter a valid Email";
              // if user with this email in DB exysts - error
            } else if ($this->userModel->findUserByEmail($data['email'])) {
                $data['emailErr'] = "Email already taken";
            }

            //////////////////////////////////////////////////////////
            // Validate passwords
            if (empty($data['password'])) {
                $data['passwordErr'] = "Please enter Your Password";
            } elseif (strlen($data['password']) < 4) {
                $data['passwordErr'] = "Please enter atleast 4 symbols";
            }

            //////////////////////////////////////////////////////////
            // check if there are no validation errors
            if (empty($data['firstnameErr']) && empty($data['lastnameErr']) && empty($data['emailErr']) && empty($data['passwordErr'])) {

                // hash password // secure way to store password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // call register method, to make sql request
            	$this->userModel->register($data);
                header("Location: " . URLROOT . "/login");


            } else {
                // load view with errors 
                $this->view('register.php', $data);
            }

        } else{
            // kuriamas $data, nes i view bus paduodami atvaizduojami duomenys
            $data = [];
            // view() uzkrauna html turini
            $this->view('register.php', $data);
        }
	}

	public function reviews()
	{
		$this->view('reviews.php', []);
	}
	// logout ass no view (because according to the requirements in documentation _ redirects to home page)
	public function logout() {}
}