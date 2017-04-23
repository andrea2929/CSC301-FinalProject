<?php

include('header.php');

$search = get('search');
$params = array(
	'name' => '%'.$search.'%'
);

$sql = file_get_contents('sql/pokemon.sql');
$statement = $database->prepare($sql);
$statement->execute($params);
$pokemon = $statement->fetchAll(PDO::FETCH_ASSOC);

// Make sure URL variables both exist and are valid

$from = get('from');
$to = get('to');

if ($from > count($pokemon) - 1) {
	$to = count($pokemon) - 1;
	$from = count($pokemon) - 30;
} else {
	if($from > $to && $to!="") {
		$swap = $from;
		$from = $to;
		$to = $swap;
	}

	if($from<0) {
		$from = 0;
	} else if ($from=="") {
		$from = 0;
	}

	if ($to == "") {
		$to = $from + 29;
	}

	if($to > (count($pokemon) - 1)) {
		$to = count($pokemon)-1;
	}
}

?>

<div class="container">

	<div class="dropdown">
		<label>View Pokedex IDs: </label> <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	      <?php if($from==0 && $to == count($pokemon)-1) { echo "All"; } else { echo ($from+1)." - ".($to+1); } ?>
	      <span class="caret"></span>
	    </button>
		<ul class="dropdown-menu">
		  	<?php if (count($pokemon) > 30) : for($x = 0; $x <= count($pokemon)/30; $x++) : ?>
		  		<li><a href="pokedex.php?search=<?php echo $search; ?>&from=<?php echo $x*30; ?>"><?php echo ($x*30+1)." - ".(($x+1)*30); ?></a></li>
			<?php endfor; endif;?>
			<li><a href="pokedex.php?search=<?php echo $search; ?>&to=<?php echo count($pokemon)-1; ?>&from=0">All <?php echo count($pokemon); ?></a></li>
		</ul>
	</div>

	<div class="pokedex">
		<div class="row">
			<?php for($x = $from; $x <= $to; $x++) : $p = $pokemon[$x];?>
				<?php if($x % 6 == 0 && $x != 0) { echo "</div><div class='row'>"; } ?>
				<div class='col-sm-2'>
					<a  style="display:block" href="pokemon.php?id=<?php echo $p['id']; ?>">
						<div class="pokedex-item">
							<div class="pokedex-item-info">
								<img src="images/icons/<?php echo $p['id']?>.png"><br>
								<?php echo $p['identifier']?>
							</div>
							<div class="pokedex-item-hover">
								<h2><?php echo $p['id']?></h2>
							</div>
						</div>
					</a>
				</div>
			<?php endfor; ?>
		</div>
	</div>

<?php include('footer.php'); ?>

