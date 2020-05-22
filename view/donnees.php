<!-- <?php var_dump($donnees); ?> -->

<div><a href="?op=add" class="btn btn-large btn-info mb-2"><i class="glyphicon glyphicon-plus"></i> Ajouter une nouvelle donnée</a></div>

<table class="table">
	<thead>
		<tr>
			<th>ID</th><!-- à cause du array_splice permettant de ne pas afficher le champ id_employes dans le formulaire d'ajout, on déclare manuellement un enetête, sinon décalage -->
			<?php foreach($fields as $field) :  ?>	
				<th><?= $field['Field'] ?></th>
			<?php endforeach; ?>	
			<th>Voir</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>	
	</thead>	 
	<tbody>
	<?php foreach ($donnees as $donnee) : ?>
		<tr class="text-center">
			<td><?= implode('</td><td>', $donnee) ?></td>
			<td><a href="?op=select&id=<?= $donnee[$id] ?>" class="text-dark"><i class="fas fa-eye"></i></a></td>
			<td><a href="?op=update&id=<?= $donnee[$id] ?>" class="text-dark"><i class="fas fa-edit"></i></a></td>
			<td><a href="?op=delete&id=<?= $donnee[$id] ?>" class="text-danger"><i class="fas fa-trash-alt"></i></a></td>
		</tr>	
	<?php endforeach; ?>
	</tbody>
</table>	