<!DOCTYPE html>
<html lang="fr">
<head>
	<!-- META -->
	<title>Mini projet</title>
	<meta charset="utf-8">
	<!-- END META -->

	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap-3.0.2/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css">
	<!-- END CSS -->
</head>
<body>
	<div class="container">
				<header>
					<h1>Liste des films</h1>
				</header>
			
				<div class="panel panel-default">
					<div class="panel-heading">
						<section>
							<form class="form-inline" role="form" name="search">
								<legend>Formulaire de recherche</legend>
								<div class="row">
									<div class="form-group col-md-3">
										<label for="inputNameReal">Nom du réalisateur :</label>
										<input id="inputNameReal" class="form-control" type="text" name="realisateur" placeholder="Nom du réalisateur..."/>
									</div>
									<div class="form-group col-md-3">	
										<label>Genre :</label>		
										<select name="genre" class="form-control" multiple="multiple">
											<option selected="selected" value="0">Aucune</option>
											<?php
												foreach($genre as $row) {
													echo '<option value="'.$row->code_genre.'">'.$row->nom_genre.'</option>';
												}
											?>
										</select>
									</div>
									<div class="form-group col-md-2">
										<label for="inputYear" >Année :</label>
										<input id="inputYear" class="form-control" type="text" name="date" placeholder="Année..."/>
									</div>
									<div class="form-group col-md-2">
										<label>Couleur :</label>
										<div>
											<div><input type="checkbox" name="nb" value="NB" /> Noir et blanc</div>
											<div><input type="checkbox" name="couleur" value="couleur" /> Couleur</div>
											<div><input type="checkbox" name="both" value="NB/couleur" /> Noir et blanc / Couleur</div>		
										</div>
									</div>
									<div class="form-group col-md-2">
										<input type="submit" id="submit" value="Rechercher" class="btn btn-primary pull-right" />
									</div>
								</div>
							</form>
						</section>
					</div>

					<section class="panel-body">
						<table id="film">
							<tr id="head">
								<th>Titre original</th>
								<th>Titre français</th>
								<th>Pays</th>
								<th>Année de sortie</th>
								<th>Durée</th>
								<th>Colorisation</th>
								<th>Réalisateur</th>
							</tr>
							<?php echo $tableFilm; ?>
						</table>
			
					</section>
				</div>
			</div>

	<!-- SCRIPT JS -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-3.0.2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/script.js"></script>
	<!-- END SCRIPT JS -->
</body>
</html>