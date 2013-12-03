<!DOCTYPE html>
<html lang="fr">
<head>
	<!-- META -->
	<title>Mini projet</title>
	<meta charset="utf-8">
	<!-- END META -->

	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/bootstrap-3.0.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/style.css">
	<!-- END CSS -->
</head>
<body>
	<table>
		<tr>
			<th>Titre original</th>
			<th>Titre français</th>
			<th>Pays</th>
			<th>Année de sortie</th>
			<th>Durée</th>
			<th>Colorisation</th>
			<th>Réalisateur</th>
		</tr>
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
	</table>

	<!-- SCRIPT JS -->
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/lib/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/bootstrap-3.0.2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/script.js"></script>
	<!-- END SCRIPT JS -->
</body>
</html>