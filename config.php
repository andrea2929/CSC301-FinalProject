<?php

	// Connecting to the MySQL database
	$user = 'halenkampa1';
	$password = 'qUKwK8SR';

	$database = new PDO('mysql:host=csweb.hh.nku.edu;dbname=db_spring17_halenkampa1', $user, $password);

	// Start the Session
	session_start();
	if(!isset($_SESSION['userid'])) {
		$_SESSION['userid'] = NULL;
	}

	// Implement an autoloader function to automatically load classes as called
	spl_autoload_register(function ($class_name) {
	    include 'class.' . $class_name . '.php';
	});

	// Grab the page URL
	$current_url = basename($_SERVER['REQUEST_URI']);

	// Check if the use has logged in
	if(is_null($_SESSION['userid'])&&$current_url!='index.php') {
		header("Location: index.php");
	}
	else if (!is_null($_SESSION['userid'])){
		$sql = file_get_contents('sql/getuser.sql');
		$params = array(
			'id' => $_SESSION['userid']
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
		$user = $statement->fetchAll(PDO::FETCH_ASSOC);
		$user = $user[0];
	}

?>