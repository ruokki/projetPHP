<img id="filmPoster" src="" alt="affiche de <?php echo $film->titre_francais; ?>" title="affiche de <?php echo $film->titre_francais; ?>" />
<p>Titre original : <?php echo $film->titre_original; ?></p>
<p>Pays : <?php echo $film->pays; ?></p>
<p>Date de sorite : <?php echo $film->date; ?></p>
<p>Durée : <?php echo $film->duree; ?> min</p>
<p>Couleur : <?php echo $film->couleur; ?></p>
<p>Réalisateur : <?php echo $film->nom . ' ' . $film->prenom; ?></p>
<p>Genre(s) : <?php echo $film->genre; ?></p>