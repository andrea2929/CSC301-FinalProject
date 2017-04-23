<?php

	// Include header file for navigation bar and start of page
	include('header.php');

	// Initializing parameter for forms
	$params = array(
		'id' => $user['id']
	);

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		// Get profile changes
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		// If any of the cells are empty, default them to old data
		if (empty($first_name)) { $first_name = $user['first_name']; }
		if (empty($last_name)) { $last_name = $user['last_name']; }
		if (empty($email)) { $email = $user['email']; }
		if (empty($password)) { $password = $user['password']; }

		// Run Edit Profile Statement
		$params = array(
			'id' => $user['id'],
			'password' => $password,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email
		);

		$sql = file_get_contents('sql/editprofile.sql');
		$statement = $database->prepare($sql);
		$statement->execute($params);

		// Update user after edits
		$user = array(
			'id' => $user['id'],
			'username' => $user['username'],
			'password' => $password,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email
			);
	}

?>

<div class="jumbotron">
	<div class="container">
		<h1>Profile</h1>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<h3>User Information</h3>
			<strong>Username: </strong> <?php echo $user['username']; ?><br>
			<strong>First Name: </strong> <?php echo $user['first_name']; ?><br>
			<strong>Last Name: </strong> <?php echo $user['last_name']; ?><br>
			<strong>Email: </strong> <?php echo $user['email']; ?><br>

			<br>
			<a class="btn btn-primary" role="button" data-toggle="collapse" href="#editprofile">
			  <i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile
			</a><br>
			<div class="collapse" id="editprofile">
				<br>
			  	<div class="well">
					<form method="post">
						<input type="text" class="form-control" name="first_name" placeholder="First Name">
						<br>
						<input type="text" class="form-control" name="last_name" placeholder="Last Name">
						<br>
						<input type="text" class="form-control" name="email" placeholder="Email">
						<br>
						<input type="password" class="form-control" name="password" placeholder="password">
						<br>
						<input type="submit" value="Make Changes" class="btn btn-default dropdown-toggle" />
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<h3>Actions</h3>
			<a href="collection.php" class="btn btn-default">View Collection</a>
		</div>
	</div>
	
	
</div>

<?php include('footer.php') ?>