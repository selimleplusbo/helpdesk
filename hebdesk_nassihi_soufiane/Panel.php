<?php
session_start();
require_once('config.php');


if(isset($_POST['supp'])){
    $id=intval($_POST['supp_id']);
    
    //les messages//
$sql2="delete from messages where user_id=?";
$stmt2=mysqli_prepare($monLien,$sql2);
mysqli_stmt_bind_param($stmt2,"i",$id);
mysqli_stmt_execute($stmt2);


//les tickets//
$sql1="delete from tickets where user_id=?";
$stmt1=mysqli_prepare($monLien,$sql1);
mysqli_stmt_bind_param($stmt1,"i",$id);
mysqli_stmt_execute($stmt1);


//les users//

$id=intval($_POST['supp_id']);
    $sql="delete from users where id = ?";
    $stmt=mysqli_prepare($monLien,$sql);
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    header("Location:Panel.php");
    exit();
    

}




if(isset($_POST['modif'])){
$id = intval($_POST['id']);
$mail = $_POST['email'];
$mdp = $_POST['mot_de_passe'];
    $sql="update users set email=?,mot_de_passe=? where id= ?";
    $stmt=mysqli_prepare($monLien,$sql);
    mysqli_stmt_bind_param($stmt,"ssi",$mail,$mdp,$id);
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
a{
    text-decoration:none; 
    color:black;
}
.btn-retour {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #007BFF;
    color: white;
    padding: 12px 18px;
    border-radius: 25px;
    text-decoration: none;
    z-index: 9999;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
}

.btn-retour:hover {
    background: #0056b3;
}
</style>

</head>
<body>
<a href="index.php" class="btn-retour">Retour ↩️</a>

<div class="container">
    <h1>Listes</h1>

    <table>
        <tr>
            <th>Email</th>
            <th>Mot de passe</th>
            <th>Rôle</th>
            <th>Date de modification</th>
            <th>Action</th> 
        </tr>

<?php
$monAffiche = mysqli_query($monLien, "SELECT * FROM users");

while ($ligne = mysqli_fetch_assoc($monAffiche)) {
?>
<tr>
    <td><?php print($ligne['email']); ?></td>
    <td><?php print ($ligne['mot_de_passe']); ?></td>
    <td><?php print($ligne['role']); ?></td>
    <td><?php print ($ligne['date_de_création']); ?></td>
    <td>
    <form method="POST" action="">
        <input type="hidden" name="supp_id" value="<?= $ligne['id']; ?>">
        <button type="submit" name="supp">Supprimer</button>
    </form>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $ligne['id']; ?>">
        <input type="text" name="email" value="<?= $ligne['email']; ?>">
        <input type="text" name="mot_de_passe" value="<?= $ligne['mot_de_passe']; ?>">

        <button type="submit" name="modif">modifier</button>




    </form>
</td>
</tr>

<?php } ?>


    </table>
</div>

</body>
</html>
