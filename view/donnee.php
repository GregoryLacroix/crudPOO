<ul class="col-md-6 offset-md-3 list-group text-center">
<?php foreach($donnee as $indice => $valeur): ?> 
	
		<li class="list-group-item"><?= $indice ?> : <?= $valeur ?></li>

<?php endforeach; ?>
</ul>