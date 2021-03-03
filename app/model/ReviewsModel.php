<?php

namespace app\model;

/**
 * OOP
 * ReviewsModel model, use for conect to DB
 */
class ReviewsModel {

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
	//  create new review
	public function createNewReview($user_id, $user_name, $review, $date){
		// exemple :abcabc - will be replaced with real value
		$sql = "INSERT INTO reviews (`user_id`,  `date`, `review`, `user_name`) VALUES (:user_id, :date, :review, :user_name)";

		// with PDO prepare  for sql statment executing
		$pdo_statement = $this->dbh->prepare($sql);

		// add values
		$pdo_statement->bindValue(':user_id', $user_id, \PDO::PARAM_STR);
		$pdo_statement->bindValue(':review', $review, \PDO::PARAM_STR);	
		$pdo_statement->bindValue(':date', $date, \PDO::PARAM_STR);
		$pdo_statement->bindValue(':user_name', $user_name, \PDO::PARAM_STR);
		
		// sql execution
		$pdo_statement->execute();
	}

	// create new mwthod to get all review from DB
	public function getAllReviews(){
		$sql = "SELECT * FROM reviews";

		// with PDO prepare  for sql statment executing
		$pdo_statement = $this->dbh->prepare($sql);

		// sql execution
		$pdo_statement->execute();
		
		// return results
		return $pdo_statement->fetchAll();
	}	
}		