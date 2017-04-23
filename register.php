<?php

	// Connecting to the MySQL database
	$user = 'halenkampa1';
	$password = 'qUKwK8SR';

	$database = new PDO('mysql:host=csweb.hh.nku.edu;dbname=db_spring17_halenkampa1', $user, $password);

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		
		$sql = file_get_contents('sql/userid.sql');
		$statement = $database->prepare($sql);
		$statement->execute();
		$id = $statement->fetchAll(PDO::FETCH_ASSOC);

		$sql = file_get_contents('sql/register.sql');
		$params = array(
			'id' => $id[0]['id'] + 1,
			'username' => $username,
			'password' => $password,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
		$users = $statement->fetchAll(PDO::FETCH_ASSOC);

		header('location: index.php');
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Register</title>

  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  	<script src="https://use.fontawesome.com/72e7f63cce.js"></script>
  	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="jumbotron">
		<div class="container">
			<h1>Register</h1>
			<p>Fill out the following in order to create a user account for this awesome application.</p>
		</div>
	</div>

	<div class="container">

		<form method="POST">
			<input type="text" class="form-control" name="username" placeholder="username" required>
			<br>
			<input type="password" class="form-control" name="password" placeholder="password" required>
			<br>
			<input type="text" class="form-control" name="first_name" placeholder="first name">
			<br>
			<input type="text" class="form-control" name="last_name" placeholder="last name">
			<br>
			<input type="email" class="form-control" name="email" placeholder="email address">
			<br>
			<input type="submit" value="Register" class="btn btn-default dropdown-toggle" />
		</form>
	</div>

<?php include('footer.php'); ?>