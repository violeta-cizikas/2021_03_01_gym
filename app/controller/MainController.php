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
}