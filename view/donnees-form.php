<form method="post" action="" class="col-md-6 offset-md-3">
	
	<?php foreach($fields as $field) : ?><!-- grace à la méthode render() on récupère le résultat de getFiedl() et on peut peux crocheter à l'indice pour afficher le nom des champs -->
	<div class="form-group">
		<label><?= $field['Field'] ?> : </label>
		<input type="text" name="<?= $field['Field'] ?>" class="form-control" value="<?= ($op == 'update') ? $values[$field['Field']] : '' ?>"><br><!-- dans value="" on va crocheter sur chaque indice du resulata recu par la méthode select() (Entityrepository) et save(controller) -->
	</div>
	<?php endforeach; ?>
		
	<input type="submit" class="col-md-12 btn btn-dark mb-4" value="ajouter"> 
</form>	