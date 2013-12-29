<?php foreach($allFilm as $film) : ?>
<tr class="col-md-12">
	<td class="hidden"><?php echo $film->id; ?></td>
	<td class="col-md-4"><?php echo $film->titre_original; ?></td>
	<td class="col-md-4"><?php echo $film->titre_francais; ?></td>
	<td class="col-md-4"><?php echo $film->prenom.' '.$film->nom; ?></td>
</tr>
<?php endforeach; ?>