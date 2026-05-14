<?php
session_start();
require_once('config.php');
require_once('sécurité.php');

if($_SESSION['role'] == "user"){
    header('Location: ticket.php');
    exit();
}if($_SESSION['role']=="admin"){
    header("Location: ticket_admin.php");
    exit();
}

if (isset($_POST['id']) && isset($_POST['statut'])) {

    $mon_id = $_POST['id'];
    $mon_statut = $_POST['statut'];

    $sql="update tickets set statut =? WHERE id= ?";
    $stmt=mysqli_prepare($monLien, $sql);
    mysqli_stmt_bind_param($stmt,"si",$mon_statut,$mon_id);
    mysqli_stmt_execute($stmt);




}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ticket technicien</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
body{
    margin:0;
    font-family: Arial;
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    color:white;
}

h2{
    text-align:center;
    margin-top:30px;
}

form{
    display:flex;
    justify-content:center;
    margin-bottom:20px;
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

th{
    background:#2c3e50;
    color:white;
    padding:15px;
    text-transform:uppercase;
    font-size:14px;
}

td{
    padding:15px;
    border-bottom:1px solid #eee;
}

tr:hover{
    background:#f2f2f2;
}

td a{
    text-decoration:none;
    color:#2980b9;
    font-weight:bold;
}

td a:hover{
    color:#1abc9c;
}

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
span.role{
    display: inline-block;
    background: #1abc9c;
    color: white;
    font-weight: bold;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 14px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
    margin-right: 5px;
    float: right;
}


</style>

<body>

<h2>Réparation des tickets</h2>
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
$monAffiche = mysqli_query($monLien, "SELECT * FROM tickets where statut!='ferme'ORDER BY date_de_creation ASC ");


while ($ligne = mysqli_fetch_assoc($monAffiche)) {
?>

<tr>
    <td>
        <a href="index2.php?ticket_id=<?php print ($ligne['id']); ?>">
            <?php print ($ligne['titre']); ?>
        </a>
    </td>

    <td>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php print $ligne['id']; ?>">

            <select name="statut" onchange="this.form.submit()">
                <option value="ouvert" <?php if($ligne['statut']=='ouvert') print("selected"); ?>>Ouvert</option>
                <option value="en_cours" <?php if($ligne['statut']=='en_cours') print("selected"); ?>>En cours</option>
                <option value="ferme" <?php if($ligne['statut']=='ferme') print("selected"); ?>>Fermé</option>
            </select>
        </form>
    </td>

    <td><?php print ($ligne['description']); ?></td>
    <td><?php print ($ligne['date_de_creation']); ?></td>
</tr>

<?php } ?>

</table>

</body>
</html>
