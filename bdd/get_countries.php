<?php
if(isset($_GET['go'])) {

  $json = array();

  if(isset($_GET['go'])) {
    // requête qui récupère les régions
    $requete = "SELECT id_country, name_country FROM country ORDER BY id_country";
  }
  // connexion à la base de données
require 'connection_bdd.php';

  // exécution de la requête
  $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

  // résultats

    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {

    // je remplis un tableau et mettant l'id en index (que ce soit pour les régions ou les départements)
    $json[$donnees['id_country']][] = utf8_encode($donnees['name_country']);
  }

  // envoi du résultat au success
  echo json_encode($json);
}
