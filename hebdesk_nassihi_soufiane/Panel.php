<?php
session_start();
require_once('config.php');


if(isset($_POST['supp'])){
    $id=intval($_POST['supp_id']);
    $sql="delete from users where id = ?";
    $stmt=mysqli_prepare($monLien,$sql);
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    header("Location: panel.php");
    exit();

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    margin: 0;
    padding: 20px;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    overflow: hidden;
    color: white;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

/* En-tête */
th {
    background: rgba(0,0,0,0.4);
    padding: 14px;
    text-align: left;
}

/* Cellules */
td {
    padding: 12px;
    border-bottom: 1px solid rgba(255,255,255,0.2);
}

/* Hover */
tr:hover {
    background: rgba(255,255,255,0.1);
}

/* Ligne une sur deux */
tr:nth-child(even) {
    background: rgba(255,255,255,0.05);
}
</style>

</head>
<body>

<div class="container">
    <h1>Liste des utilisateurs</h1>

    <table>
        <tr>
            <th>Email</th>
            <th>Mot de passe</th>
            <th>Rôle</th>
            <th>Date de création</th>
            <th>Action</th> 
        </tr>

<?php
$monAffiche = mysqli_query($monLien, "SELECT * FROM users");

while ($ligne = mysqli_fetch_assoc($monAffiche)) {
?>
<tr>
    <td><?php echo $ligne['email']; ?></td>
    <td><?php echo $ligne['mot_de_passe']; ?></td>
    <td><?php echo $ligne['role']; ?></td>
    <td><?php echo $ligne['date_de_création']; ?></td>
    <td>
    <form method="POST" action="">
        <input type="hidden" name="supp_id" value="<?= $ligne['id']; ?>">
        <button type="submit" name="supp">Supprimer</button>
    </form>
</td>
</tr>

<?php } ?>


    </table>
</div>

</body>
</html>