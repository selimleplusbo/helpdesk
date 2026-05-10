<?php
session_start();
require_once('config.php');
require_once('sécurité.php');

if(isset($_POST['bouton'])){
    header("Location: creaTiket.php");
    exit();
}
if(isset($_POST['ticket'])){
    header("Location: ancien_tickets.php");
    exit();
}
if($_SESSION['role']!="user"){
    header("Location: index.php");
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
body{
    margin:0;
    font-family: Arial;
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    color:white;
}

/* HEADER */
h2{
    text-align:center;
    margin-top:30px;
}

/* BUTTON */
.buttons{
    display:flex;
    justify-content:center;
    gap:20px;
    margin-bottom:25px;
}

.Envoyer{
    background:#1abc9c;
    border:none;
    padding:12px 20px;
    border-radius:25px;
    color:white;
    cursor:pointer;
    font-size:15px;
    transition:0.3s;
}

.Envoyer:hover{
    background:#16a085;
    transform:scale(1.05);
}

/* TABLE WRAPPER */
table{
    width:85%;
    margin:auto;
    border-collapse:collapse;
    background:white;
    color:black;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

/* HEADER TABLE */
th{
    background:#2c3e50;
    color:white;
    padding:15px;
    text-transform:uppercase;
    font-size:14px;
}

/* CELLS */
td{
    padding:15px;
    border-bottom:1px solid #eee;
}

/* HOVER */
tr:hover{
    background:#f2f2f2;
}

/* TITRE LINK */
td a{
    text-decoration:none;
    color:#2980b9;
    font-weight:bold;
}

td a:hover{
    color:#1abc9c;
}

/* STATUT STYLE */
.ouvert{
    color:#27ae60;
    font-weight:bold;
}

.ferme{
    color:#e74c3c;
    font-weight:bold;
}

.en_cours{
    color:#f39c12;
    font-weight:bold;
}

/* BACK BUTTON */
nav{
    position:fixed;
    bottom:20px;
    right:20px;
}

nav a{
    background:#007BFF;
    color:white;
    padding:12px 18px;
    border-radius:25px;
    text-decoration:none;
    box-shadow:0 4px 10px rgba(0,0,0,0.3);
    transition:0.3s;
}

nav a:hover{
    background:#0056b3;
}
@keyframes fadeIn {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
table {
    animation: fadeIn 0.6s ease;
}

</style>
</head>

<body>

<h2>🎫 Liste de mes tickets</h2>

<div class="buttons">

    <form method="POST">
        <button type="submit" class="Envoyer" name="bouton">
            ➕ Créer un ticket
        </button>
    </form>
    

    <form method="POST">
        <button type="submit" class="Envoyer" name="ticket">
            📁 Mes anciens Tickets
        </button>
    </form>

</div>

<nav>
    <a href="index.php">↩ Retour</a>
</nav>

<table>
    <tr>
        <th>Titre</th>
        <th>Statut</th>
        <th>Description</th>
        <th>Date</th>
    </tr>

<?php
$mon_id=$_SESSION['user_id'];
$monAffiche = mysqli_query($monLien, "SELECT * FROM tickets where statut!='ferme' and  user_id= $mon_id  ORDER BY date_de_creation ASC");


while ($ligne = mysqli_fetch_assoc($monAffiche)) {
?>
<tr>

    <td>
        <a href="index2.php?ticket_id=<?php print($ligne['id']); ?>">
            <?php print($ligne['titre']); ?>
        </a>
    </td>

    <td class="<?php print($ligne['statut']); ?>">
        <?php print($ligne['statut']); ?>
    </td>

    <td>
        <?php print($ligne['description']); ?>
    </td>

    <td>
        <?php print($ligne['date_de_creation']); ?>
    </td>

</tr>
<?php } ?>

</table>

</body>
</html>