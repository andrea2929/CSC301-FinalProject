<?php
include('header.php');

	$params = array(
		'id' => $user['id']
	);

	$sql = file_get_contents('sql/getuserpokemon.sql');
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$pokemon = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="jumbotron">
	<div class="container">
		<h1>Pokemon Collection</h1>
		<p>Contains all the pokemon the user has saved.</p>
	</div>
</div>

<div class="container">

	<h3>List of Pokemon</h3>

	<div class="row">
		<?php for($x = 0; $x < count($pokemon); $x++) : ?>

		<?php $p = $pokemon[$x]; if($x % 3 == 0 && $x != 0) { echo "</div><div class='row'>"; } ?>
			  <div class="col-sm-6 col-md-4">
			    <div class="thumbnail">
			      <img src="https://veekun.com/dex/media/pokemon/main-sprites/omegaruby-alphasapphire/<?php if($p['is_shiny']) { echo 'shiny/';}?><?php echo $p['id']; ?>.png" alt="ORAS Sprite">
			      <div class="caption">
			        <h3 style="text-transform: capitalize;"><?php if($p['nickname']!="") { echo $p['nickname']." the ".$p['identifier']; } else { echo $p['identifier']; }?></h3>
			        <p></p>
			        <p><a href="pokemon.php?id=<?php echo $p['id']; ?>" class="btn btn-default" role="button">Pokemon Information</a> <button onclick="window.location.href='release.php?id=<?php echo $p['bridge_id']?>'" class="btn btn-danger" role="button">Release</button></p>
			      </div>
			    </div>
			  </div>
		<?php endfor; ?>
	</div>

	<a href="pokedex.php?search=&from=0">Back to Pokedex</a>
</div>

<?php include('footer.php') ?>