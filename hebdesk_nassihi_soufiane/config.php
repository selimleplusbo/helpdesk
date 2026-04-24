<?php
$serveur = 'localhost';
$nom_base_donnee = 'helbdesk_nassihi_soufiane';
$login = 'root';
$mdp = '';

$monLien=mysqli_connect($serveur,$login,$mdp,$nom_base_donnee);

if(!$monLien){
    die("Connexion raté ".mysqli_connect_error());
}
?>