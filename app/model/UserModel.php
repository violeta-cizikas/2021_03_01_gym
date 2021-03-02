<?php

namespace app\model;

/**
 * OOP
 * UserModel model, use for conect to DB
 */
class UserModel {

	// class properties
	private $dbh;
	private $stmt;
	private $error;

	public function __construct()
	{
		$connectionInfo = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8;";
		$user = DB_USER;
		$password = DB_PASS;

		// connection to DB options
		$options = [
			\PDO::ATTR_PERSISTENT => true,
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
		];

		// create new PDO
		try {
			$this->dbh = new \PDO($connectionInfo, $user, $password, $options);
		} catch (PDOException $e) {
			// error catching, if error connecting to DB
			$this->error = $e->getMessage();
			echo $this->error;
		}
	}

	//////////////////////////////////////////////////////////
	// find User by email
	public function findUserByEmail($email){
		$sql = "SELECT * FROM users WHERE `email` = :email";
		$pdo_statement = $this->dbh->prepare($sql);
    	$pdo_statement->bindValue(':email', $email, \PDO::PARAM_STR);
		$pdo_statement->execute();
		return $pdo_statement->fetch(\PDO::FETCH_ASSOC);
	}

	//////////////////////////////////////////////////////////
	// register new user
	public function register($data)
    {

        // exemple :abcabc - will be replaced with real value
        $sql = "INSERT INTO users (`firstname`,  `lastname`, `email`, `password`, `phone_number`, `home_adress`) VALUES (:firstname, :lastname, :email, :password, :phoneNumber, :homeAdress)";

        // with PDO prepare  for sql statment executing
        $pdo_statement = $this->dbh->prepare($sql);

        // add values
        $pdo_statement->bindValue(':firstname', $data['firstname'], \PDO::PARAM_STR);
		$pdo_statement->bindValue(':lastname', $data['lastname'], \PDO::PARAM_STR);	
		$pdo_statement->bindValue(':email', $data['email'], \PDO::PARAM_STR);
		$pdo_statement->bindValue(':password', $data['password'], \PDO::PARAM_STR);
		$pdo_statement->bindValue(':phoneNumber', $data['phoneNumber'], \PDO::PARAM_STR);	
		$pdo_statement->bindValue(':homeAdress', $data['homeAdress'], \PDO::PARAM_STR);

		// sql execution
		$pdo_statement->execute();
    }
}