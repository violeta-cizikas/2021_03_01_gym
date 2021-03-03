<?php 
namespace app\controller;

use app\model\UserModel;
use app\model\ReviewsModel;

/**
 * OOP
 * MainController controller, use for responding to User input
 */

class MainController
{
	// property
	private $userModel;
	private $reviewModel;

	// constructor used to creat new UserModel object for later (& login & register & validation)
	public function __construct()
	{
		$this->userModel = new UserModel();
		$this->reviewModel = new ReviewsModel();
	}

	public function home()
	{
		$this->view('home.php', ['page' => 'home']);
	}

	public function view($name, $data) 
	{
		require '../app/view/pages/' . $name;
	}

	//////////////////////////////////////////////////////////
	// login logic 

	public function login()
	{
		//////////////////////////////////////////////////////////
		// check if logged-in
		if (isset($_SESSION['user'])) {
			header("Location: " . URLROOT . "/index");
			return;
		}

		//////////////////////////////////////////////////////////
		// Login in progress

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$data = [
				'email' => trim($_POST['email']),
				'password' => trim($_POST['password']),

				'emailErr' => '',
				'passwordErr' => '',
				'page' => 'login'
			];

			//////////////////////////////////////////////////////////
			// email validation 
			if (empty($data['email'])) {
				$data['emailErr'] = "Please enter Your Email";
			  // filter_var($data['email'] - check email correct format 
			} else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
				$data['emailErr'] = "Please enter a valid Email";
			  // if user with this email in DB exyst - error
			} else if (!$this->userModel->findUserByEmail($data['email'])) {
				$data['emailErr'] = "User does not exist";
			} 

			//////////////////////////////////////////////////////////
			// password validation 
			if (empty($data['password'])) {
				$data['passwordErr'] = "Please enter Your Password";
			}

			// check if there are no validation errors
			if (empty($data['emailErr']) && empty($data['passwordErr'])) {
				$user = $this->userModel->findUserByEmail($data['email']);
				
				if (!password_verify($data['password'], $user['password'])) {
					$data['passwordErr'] = "Bad password";
				} else {
					// create session
					$_SESSION['user'] = $user;
					header("Location: " . URLROOT . "/index");
					return;
				}
			}
		} else {
			$data = ['page' => 'login'];
		}

		$this->view('login.php', $data);
	}

	//////////////////////////////////////////////////////////
	// register logic

	public function register()
	{
		//////////////////////////////////////////////////////////
		// Register in progress

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
				'page' => 'register',
			];

			//////////////////////////////////////////////////////////
			// firstname validation
			if (empty($data['firstname'])) {
				$data['firstnameErr'] = "Please enter Your Firstname";
			} else if (strlen($data['firstname']) > 40) {
				$data['firstnameErr'] = "Please enter less then 40 letters";
			  // preg_match('/^[\p{L} ]+$/u' - allows only letters from any language  
			} else if (!preg_match('/^[\p{L} ]+$/u', $data['firstname'])) {
				$data['firstnameErr'] = "Please only use letters";
			}
				

			//////////////////////////////////////////////////////////
			// lastname validation 
			if (empty($data['lastname'])) {
				$data['lastnameErr'] = "Please enter Your Lastname";
			} else if (strlen($data['lastname']) > 40) {
				$data['lastnameErr'] = "Please enter less then 40 letters";
			  // preg_match('/^[\p{L} ]+$/u' - allows only letters from any language  
			} else if (!preg_match('/^[\p{L} ]+$/u', $data['lastname'])) {
				$data['lastnameErr'] = "Please only use letters";
			} 

			//////////////////////////////////////////////////////////
			// email validation
			if (empty($data['email'])) {
				$data['emailErr'] = "Please enter Your Email";
			  // filter_var($data['email'] - check email correct format 
			} else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
				$data['emailErr'] = "Please enter a valid Email";
			  // if user with this email in DB exists - error
			} else if ($this->userModel->findUserByEmail($data['email'])) {
				$data['emailErr'] = "Email already taken";
			}

			//////////////////////////////////////////////////////////
			// passwords validation 
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
			$data = ['page' => 'register'];
			$this->view('register.php', $data);
		}
	}

	//////////////////////////////////////////////////////////
	// feedback logic
	public function feedback()
	{
		//////////////////////////////////////////////////////////
		// Reviews in progress
		 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// insted of $_POST decoding body as json for adding reviws without refresh
			// file_get_contents - php function, that returns file content
			$json = file_get_contents('php://input');
			// json_decode - takes JSON encoded string & returns PHP variable
			$jsonData = json_decode($json, true);
			$data = [
				'review' => trim($jsonData['review']),

				'reviewErr' => '',
				'page' => 'feedback',
			];

			//////////////////////////////////////////////////////////
			// Reviews validation
			if (empty($data['review'])) {
				// if empty
				$data['reviewErr'] = "Please enter Your review";
			} elseif (strlen($data['review']) > 500) {
				// if to long
				$data['reviewErr'] = "Please enter max 500 symbols";
			} elseif (!isset($_SESSION['user'])) {
				// if not logdin
				$data['reviewErr'] = "Please login";
			}

			// if not validation error
			if (empty($data['reviewErr'])) {
				$date = date('Y-m-d H:i:s');
				// insert to DB new review
				$this->reviewModel->createNewReview($_SESSION['user']['user_id'], $_SESSION['user']['firstname'], $data['review'], $date);
				$data['user_name'] = $_SESSION['user']['firstname'];
				$data['date'] = $date;
			}

			// header - part of http protocol
			// Content-Type tells browser that content tipe - json
			header('Content-Type: application/json'); 
			// echo results in json format
			echo json_encode($data);

		} else {
			// GET method
			$reviews = $this->reviewModel->getAllReviews();
			$data = [
				'reviews' => $reviews,
				'page' => 'feedback',
			];
			$this->view('reviews.php', $data);
		}	
	}

	//////////////////////////////////////////////////////////
	// logout logic

	// logout has no view (because according to the requirements in documentation _ redirects to home page)
	public function logout() {
		// check if logged-in
		if (isset($_SESSION['user'])) {
			// $_SESSION['user'] delete
			$_SESSION['user'] = null;
			header("Location: " . URLROOT . "/index");
		} else {
			header("Location: " . URLROOT . "/index");
		}
	}
}