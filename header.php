<?php

// Include Config File on Every Page
include('config.php');

// Include Functions File on Every Page
include('functions.php');

 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Pokemon Pokedex</title>

  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  	<script src="https://use.fontawesome.com/72e7f63cce.js"></script>

  	<link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="pokedex.php?search=&from=0">Pokedex</a>
			<p class="navbar-text">Welcome <a href="account.php"><?php echo $user['first_name'];?></a>!</p>
		</div>

		<form class="navbar-form navbar-right" method="get" action="pokedex.php?search="> 
			<div class="input-group">
			  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
			  <input type="search" class="form-control" name="search" placeholder="Search">
			</div>
		</form>

		<button type="button" class="btn btn-default navbar-btn navbar-right"
	      	onclick="window.location.href='logout.php'">Logout</button>
	</div>
</nav>