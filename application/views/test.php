<?php
	$optGenre = '';
	foreach($genre as $row) {
		$optGenre .= '<option value="'.$row->code_genre.'">'.$row->nom_genre.'</option>';
	}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<!-- META -->
	<title>Mini projet</title>
	<meta charset="utf-8">
	<!-- END META -->

	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap-3.0.2/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui-1.10.3/css/jquery-ui-1.10.3.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css">
	<!-- END CSS -->
</head>
<body>
	<div class="container">
		<section class="panel col-md-3">
			<form action="" name="search" role="form" method="post">
				<legend><small>Rechercher</small></legend>
				<div class="form-group">
					<label for="realSearch">Réalisateur :</label>
					<input type="text" id="realSearch" placeholder="Godard" class="form-control" >
				</div>
				<div class="form-group">
					<label for="genreSearch">Genre :</label>
					<select multiple name="genreSearch" id="genreSearch" class="form-control">
						<option selected="selected" value="0">Aucune</option>
						<?php
							echo $optGenre;
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="dateSearch">Année :</label>
					<input type="text" name="dateSearch" id="dateSearch" placeholder="2013"  class="form-control">
				</div>
				<div class="form-group">
					<label>Genre :</label>
					<div class="checkbox">
						<label for="nb">
							<input type="checkbox">Noir et Blanc
						</label>
					</div>
					<div class="checkbox">
						<label for="couleur">
							<input type="checkbox">Couleur
						</label>
					</div>
					<div class="checkbox">
						<label for="both">
							<input type="checkbox">Noir et Blanc/Couleur
						</label>
					</div>
				</div>
				<div class="form-group">
					<input type="submit" value="Rechercher" name="search" id="search" class="btn btn-primary">
				</div>
			</form>
		</section>

		<section class="col-md-6" role="main">
			<table id="film" class="table table-hover">
				<caption>
					<h1>Liste des films</h1>
				</caption>
				<tr>
					<th>Titre original</th>
					<th>Titre français</th>
					<th>Réalisateur</th>
				</tr>
				<?php
					echo $tableFilm; 
				?>
			</table>
		</section>

		<section class="panel col-md-3 pull-right">
			<form action="<?php base_url(); ?>film/exportXML" name="export" role="form" method="post">
				<legend><small>Exporter en XML</small></legend>
				<div class="form-group">
					<label for="real">Réalisateur :</label>
					<select name="real" id="real" class="form-control">
						<option selected="selected" value="0">Aucun</option>
						<?php
							// foreach($genre as $row) {
							// 	echo '<option value="'.$row->code_genre.'">'.$row->nom_genre.'</option>';
							// }
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="genre">Genre :</label>
					<select multiple name="genre" id="genre" class="form-control">
						<option selected="selected" value="0">Aucune</option>
						<?php
							echo $optGenre;
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="date">Année :</label>
					<input type="text" name="date" id="date" placeholder="2013"  class="form-control">
				</div>
				<div class="form-group">
					<label>Genre :</label>
					<div class="checkbox">
						<label for="nb">
							<input type="checkbox">Noir et Blanc
						</label>
					</div>
					<div class="checkbox">
						<label for="couleur">
							<input type="checkbox">Couleur
						</label>
					</div>
					<div class="checkbox">
						<label for="both">
							<input type="checkbox">Noir et Blanc/Couleur
						</label>
					</div>
				</div>
				<div class="form-group">
					<input type="submit" value="Exporter" name="export" class="btn btn-primary" >
				</div>
			</form>
		</section>
	</div>
	
	<!-- SCRIPT JS -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-ui-1.10.3/js/jquery-ui-1.10.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-3.0.2/js/bootstrap.min.js"></script>
	<!-- END SCRIPT JS -->
</body>
</html>