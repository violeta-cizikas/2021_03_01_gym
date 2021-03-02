<?php 
namespace app\controller;

/**
 * 
 */
class MainController
{
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
		$this->view('register.php', []);
	}

	public function reviews()
	{
		$this->view('reviews.php', []);
	}
	// logout ass no view (because according to the requirements in documentation _ redirects to home page)
	public function logout() {}
}