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
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css">
	<!-- END CSS -->
</head>
<body>
	<div class="container">
		<div class="panel">
			<section class="panel-heading">
				<form class="form-inline" role="form" name="search" action="<?php echo base_url(); ?>film/exportXML" method="post" >
					<legend>Formulaire de recherche</legend>
					<div class="row">
						<div class="form-group col-md-3">
							<label for="inputNameReal">Nom du réalisateur</label>
							<input id="inputNameReal" class="form-control" type="text" name="realisateur" placeholder="Godard"/>
						</div>
						<div class="form-group col-md-3">
							<label for="inputYear" >Année</label>
							<input id="inputYear" class="form-control" type="text" name="date" placeholder="1980"/>
						</div>
						<div class="form-group col-md-3">	
							<label>Genre</label>		
							<select name="genre[]" class="form-control" multiple="multiple">
								<option selected="selected" value="0">Aucune</option>
								<?php
									echo $optGenre;
								?>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label>Couleur</label>
							<div>
								<div><input type="checkbox" name="nb" value="NB" /> Noir et blanc</div>
								<div><input type="checkbox" name="color" value="couleur" /> Couleur</div>
								<div><input type="checkbox" name="both" value="NB/couleur" /> Noir et blanc / Couleur</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-offset-4 col-md-4">
							<a id="search" class="btn btn-primary btn-block">Rechercher</a>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-offset-4 col-md-4">
							<input type="submit" name="export" id="export" value="Exporter en XML" class="btn btn-primary btn-block" />
							<p class="help-block">Seul le genre est pris en compte pour l'export XML</p>
						</div>
					</div>
				</form>
			</section>

			<section class="col-md-12 panel-body" role="main">
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
		</div>
		<!-- Modal -->
		<div class="modal fade" id="filmInfo" tabindex="-1" role="dialog" aria-labelledby="titreFilm" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="titreFilm">Modal title</h4>
		      </div>
		      <div class="modal-body">
		        ...
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>
	
	<!-- SCRIPT JS -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-3.0.2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/script.js"></script>
	<!-- END SCRIPT JS -->
</body>
</html>