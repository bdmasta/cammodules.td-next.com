<?php
try {
  $bdd = new PDO('mysql:host=localhost;dbname=avnet','root','root');
} catch(Exception $e) {
  exit('Impossible de se connecter à la base de données.');
}
?>
