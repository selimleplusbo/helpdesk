<?php
session_start();
require_once('config.php');

if(isset($_POST['bouton'])){
    header("Location: creaTiket.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tickets</title>

<style>
body {
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    font-family: Arial;
    color: white;
    display: flex;
    flex-direction: column;
    align-items: stretch;
}

/* TABLE */
table {
    width: 80%;
    margin: auto;
    border-collapse: collapse;
    background: white;
    color: black;
}

th, td {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: left;
}

th {
    background: #2a5298;
    color: white;
}

/* STATUT */
.ouvert { color: green; font-weight: bold; }
.ferme { color: red; font-weight: bold; }
.en_cours { color: orange; font-weight: bold; }

/* FORM */
form {
    width: 80%;
    margin: auto;
    display: flex;
    justify-content: flex-end;
    margin-bottom: 15px;
}

/* LIENS */
a{
    text-decoration:none; 
    color:black;
}

/* BOUTON RETOUR EN BAS À DROITE */
nav {
    position: fixed;
    bottom: 20px;
    right: 20px;
}

nav ul {
    margin: 0;
    padding: 0;
}

nav li {
    list-style: none;
}

nav a {
    background: #007BFF;
    color: white;
    padding: 10px 15px;
    border-radius: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

nav a:hover {
    background: #0056b3;
}
</style>
</head>

<body>

<h2 style="text-align:center;">Les tickets</h2>

<form action="" method="POST">
    <button type="submit" class="Envoyer" name="bouton">Demander un ticket</button>
</form>

<nav>
  <ul>
    <li><a href="index.php">Retour ↩️</a></li>
  </ul>
</nav>

<table>
    <tr>
        <th>Titre</th>
        <th>Statut</th>
        <th>Description</th>
        <th>Date</th>
    </tr>

<?php
$monAffiche = mysqli_query($monLien, "SELECT * FROM tickets");

while ($ligne = mysqli_fetch_assoc($monAffiche)) {
?>
<tr>
    <td>
        <a href="index2.php?ticket_id=<?php print $ligne['id']; ?>">
            <?php print $ligne['titre']; ?>
        </a>
    </td>

    <td class="<?php print $ligne['statut']; ?>">
        <?php print $ligne['statut']; ?>
    </td>

    <td>
        <?php print $ligne['description']; ?>
    </td>

    <td>
        <?php print $ligne['date_de_creation']; ?>
    </td>
</tr>
<?php
}
?>

</table>

</body>
</html>