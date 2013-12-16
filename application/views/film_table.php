<?php foreach($allFilm as $film) : ?>
<tr>
	<td><?php echo $film->titre_original; ?></td>
	<td><?php echo $film->titre_francais; ?></td>
	<td><?php echo $film->pays; ?></td>
	<td><?php echo $film->date; ?></td>
	<td><?php echo $film->duree.' min'; ?></td>
	<td><?php echo $film->couleur; ?></td>
	<td><?php echo $film->prenom.' '.$film->nom; ?></td>
</tr>
<?php endforeach; ?>