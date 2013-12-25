<?php foreach($allFilm as $film) : ?>
<tr class="col-md-12">
	<td class="col-md-2"><?php echo $film->titre_original; ?></td>
	<td class="col-md-2"><?php echo $film->titre_francais; ?></td>
	<td class="col-md-1"><?php echo $film->pays; ?></td>
	<td class="col-md-2"><?php echo $film->date; ?></td>
	<td class="col-md-1"><?php echo $film->duree.' min'; ?></td>
	<td class="col-md-2"><?php echo $film->couleur; ?></td>
	<td class="col-md-2"><?php echo $film->prenom.' '.$film->nom; ?></td>
</tr>
<?php endforeach; ?>