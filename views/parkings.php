<?php
	$bd = dbConnect();
	$query = $bd -> prepare('SELECT * FROM parkings');
	$query -> execute();
	$parkings = $query -> fetchAll();
?>
<header>
	<h1>Parkings</h1>
</header>
<section class="overlap container">

</section>

<?php
	dbDisconnect($bd);
?>