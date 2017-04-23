<?php

	// Create and include a configuration file with the database connection
	include('config.php');

	// Include functions for application
	include('functions.php');

	$params = array(
		'id' => get('id')
	);

	$sql = file_get_contents('sql/release.sql');
	$statement = $database->prepare($sql);
	$statement->execute($params);

	header("Location: collection.php");

?>