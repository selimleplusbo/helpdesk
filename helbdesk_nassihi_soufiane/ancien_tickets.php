<?php
session_start();
require_once('config.php');
require_once('sécurité.php');

$mon_id=$_SESSION['user_id'];
    if($_SESSION['role']=="user"){
        /*$monAffiche = mysqli_query($monLien,"SELECT * FROM tickets WHERE statut='ferme' and user_id=$mon_id");*/
        $sql="select * from tickets where statut='ferme' and user_id=?";
        $stmt=mysqli_prepare($monLien,$sql);
        mysqli_stmt_bind_param($stmt,"i",$mon_id);
        mysqli_stmt_execute($stmt);
        $monAffiche=mysqli_stmt_get_result($stmt);

    }elseif($_SESSION['role']=="admin" || $_SESSION['role']=="technicien"){

    $sql = "SELECT tickets.*, users.email
            FROM tickets
            JOIN users ON tickets.user_id = users.id
            WHERE tickets.statut = 'ferme'";

    $monAffiche = mysqli_query($monLien, $sql);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Anciens tickets</title>

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

/* TABLE */
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

/* TITRE */
.titre{
    color:#2980b9;
    font-weight:bold;
}

/* DATE */
.date{
    color:#7f8c8d;
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

/* ANIMATION */
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

table{
    animation: fadeIn 0.6s ease;
}
</style>

</head>
<body>
    <?php if($_SESSION['role']=="user"){ ?>

<h2>📁 Mes anciens tickets</h2>

<?php }else{?>
<h2>📁Nos Archives</h2>
<?php }?>


<?php if($_SESSION['role']=="user"){?>

<nav>
    <a href="ticket.php">↩ Retour</a>
</nav>
<?php }else{?>
<nav>
    <a href="index.php">↩ Retour</a>
</nav>
<?php }?>



<table>

<tr>
    <th>Titre</th>
    <th>Description</th>
<?php if($_SESSION['role']=="admin" || $_SESSION['role']=="technicien"){?>
    <th>Utilisateur</th>
    <?php }?>
</tr>

<?php
while($ligne = mysqli_fetch_assoc($monAffiche)){
?>

<tr>
    <td class="titre">
        <?php  print($ligne['titre']); ?>
    </td>

    <td>
        <?php  print($ligne['description']); ?>
    </td>
    <?php if($_SESSION['role']=="admin" || $_SESSION['role']=="technicien"){?>
    <td class="date">
        <?php print($ligne['email']); ?>
    </td>
    <?php }?>
</tr>

<?php
}
?>

</table>

</body>
</html>