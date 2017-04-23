<?php

	include('header.php'); 

	$pokemon = new Pokemon(get('id'), $database);

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$level = $_POST['level'];
		$ability = $_POST['ability'];
		$nickname = $_POST['nickname'];
		$stat_hp = $_POST['stat_hp'];
		$stat_attack = $_POST['stat_attack'];
		$stat_defense = $_POST['stat_defense'];
		$stat_spattack = $_POST['stat_spattack'];
		$stat_spdefense = $_POST['stat_spdefense'];
		$stat_speed = $_POST['stat_speed'];
		if(isset($_POST['is_shiny'])) {
			$is_shiny = 1;
		}
		else {
			$is_shiny = 0;
		}

		$params = array(
			'user_id' => $user['id'],
			'pokemon_id' => $id,
			'id' => $newid[0]['id'],
			'level' => $level,
			'ability' => $ability,
			'nickname' => $nickname,
			'stat_hp' => $stat_hp,
			'stat_attack' => $stat_attack,
			'stat_defense' => $stat_defense,
			'stat_spattack' => $stat_spattack,
			'stat_spdefense' => $stat_spdefense,
			'stat_speed' => $stat_speed,
			'is_shiny' => $is_shiny
		);

		$sql = file_get_contents('sql/addpokemon.sql');
		$statement = $database->prepare($sql);
		$statement->execute($params);

	}

?>

<div class="container" style="margin-top: 50px;">
	
	<h1 style="text-transform: capitalize;"><div class="pokedex-number" <?php if($pokemon->getPokemon()['species_id']>99) {echo "style='width:70px; height:70px; padding: 15px 0;'"; } ?>><?php echo $pokemon->getPokemon()['species_id']; ?></div> <?php echo $pokemon->getPokemon()['identifier']; ?></h1>

	<img src="https://veekun.com/dex/media/pokemon/main-sprites/omegaruby-alphasapphire/<?php echo $pokemon->getPokemon()['id']; ?>.png">
	<img src="https://veekun.com/dex/media/pokemon/main-sprites/omegaruby-alphasapphire/shiny/<?php echo $pokemon->getPokemon()['id']; ?>.png"><br>

	<div class="row">
		<div class="col-md-6">
			<h3>Information</h3>
			<strong>Height</strong>: <?php echo $pokemon->getPokemon()['height']; ?><br>
			<strong>Weight</strong>: <?php echo $pokemon->getPokemon()['weight']; ?><br>
			<strong>Base Experience</strong>: <?php echo $pokemon->getPokemon()['base_experience']; ?><br>
			<strong>Order</strong>: <?php echo $pokemon->getPokemon()['order']; ?><br>
			<strong>Default</strong>: <?php echo $pokemon->getPokemon()['is_default']; ?><br>

			<h3>Base Statistics</h3>
			<?php foreach($pokemon->getStatistics() as $stat) : ?>
				<p><?php echo $stat['identifier'].": ".$stat['base_stat']; ?></p>
			<?php endforeach; ?>
		</div>
		<div class="col-md-6">
			<h3>Abilities</h3>
			<?php foreach($pokemon->getAbilities() as $ability) : ?>
				<?php echo $ability['ability_id'] ?>
			<?php endforeach; ?>

			<br><br>

			<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
			  Add Pokemon
			</button>

			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Caught a Pokemon</h4>
			      </div>
			      <form method="post">
				      <div class="modal-body">
				      		<p>What are the following: </p>
				        	<input type="number" class="form-control" name="level" placeholder="level" min="1" max="100">
							<br>
							<p>Select the ability: </p>
							<?php foreach ($pokemon->getAbilities()  as $ability) : ?>
								<input type="radio" name="ability" value="<?php echo $ability['ability_id']; ?>"> <?php echo $ability['ability_id']; ?><br>
							<?php endforeach; ?>
							<br>
							<input type="text" class="form-control" name="nickname" placeholder="nickname" maxlength="12">
							<br>
							<input type="number" class="form-control" name="stat_hp" placeholder="HP" min="1">
							<br>
							<input type="number" class="form-control" name="stat_attack" placeholder="Attack" min="1">
							<br>
							<input type="number" class="form-control" name="stat_defense" placeholder="Defense" min="1">
							<br>
							<input type="number" class="form-control" name="stat_spattack" placeholder="Special Attack" min="1">
							<br>
							<input type="number" class="form-control" name="stat_spdefense" placeholder="Special Defense" min="1">
							<br>
							<input type="number" class="form-control" name="stat_speed" placeholder="Speed">
							<br>
							<input type="checkbox" name="is_shiny" value="1"> <label>Shiny</label>
						
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" value="Add" class="btn btn-primary">Save changes</button>
				      </div>
			      </form>
			    </div>
			  </div>
			</div>

		</div>
	</div>

</div>

<?php include('footer.php'); ?>