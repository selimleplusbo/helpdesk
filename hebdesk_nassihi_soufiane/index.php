<?php
session_start();
if(!isset($_SESSION['mail'])){
    header('Location: login.php');
}
require_once('config.php');
$monLien="ticket.php";
if(isset($_SESSION['role'])){
    if($_SESSION['role']=='technicien'){
        $monLien="ticket_technicien.php";
    }


}
if(isset($_SESSION['role'])){
    if($_SESSION['role']=='admin'){
        $monLien="ticket_admin.php";
    }}



?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            margin: 0;
    height: 100vh;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;

    /* Même fond que login */
    background: linear-gradient(135deg, #1e3c72, #2a5298);
        }

        /* Navbar */
        nav {
            background-color: #2c3e50; /* bleu foncé */
            padding: 15px 0;
            position: fixed;
            width: 100%;
            top: 0;
        }

        ul {
            list-style: none;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
        }

        li {
            margin: 0 20px;
        }

        a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            transition: 0.3s;
        }

        a:hover {
            color: #1abc9c; /* vert sympa au survol */
        }

        /* Pour éviter que le contenu passe sous la navbar */
        body {
            padding-top: 70px;
        }


    </style>
</head>

<body>

<nav>
  <ul>
    <li><a href="#">Accueil</a></li>
    <li><a href=<?= $monLien ?>>Tickets </a></li>
    <li><a href="logout.php">Déconnexion</a></li>
    <?php
    if($_SESSION['role'] && $_SESSION['role']=="admin"){?>
    <li><a href="inscription.php">inscription</a></li>
    <li><a href="Panel.php">paneau de configuration</a></li>
    <?php
    }
    ?>
    
  </ul>
</nav>

</body>
</html>