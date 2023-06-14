<?php
$bd = dbConnect();
$query = $bd->prepare('SELECT * FROM parkings');
$query->execute();
$parkings = $query->fetchAll();
?>
<header>
	<h1>Parkings</h1>
</header>
<section class="overlap container">
	<div class="grid cols-2">
		<?php foreach ($parkings as $parking) : ?>
			<a target="_blank" href="<?= $parking['location'] ?>" class="card hover dark">
				<img class="full" src="/assets/images/parkings/<?= $parking['picture'] ?>" alt="car">
				<div class="gradient alpha"></div>
				<div class="tags top">
					<span><img src="./assets/images/icons/place.svg" alt="place icon"><?= $parking['spaces'] ?> places</span>
				</div>
				<div class="trip">
					<span class="center"><?= $parking['name'] ?></span>
				</div>
			</a>
		<?php endforeach; ?>
	</div>
</section>

</section>

<?php
dbDisconnect($bd);
?>