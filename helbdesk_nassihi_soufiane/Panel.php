<?php
session_start();
require_once('config.php');
require_once('sécurité.php');

if($_SESSION['role']!="admin"){
    header('Location: index.php');
}


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

 $hash=password_hash($_POST['mot_de_passe'],PASSWORD_BCRYPT);

    $sql="update users set email=?,mot_de_passe=? where id= ?";
    $stmt=mysqli_prepare($monLien,$sql);
    mysqli_stmt_bind_param($stmt,"ssi",$mail,$hash,$id);
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
    background: linear-gradient(135deg, #0f172a, #1e3c72);
    margin: 0;
    padding: 20px;
    color: white;
}

/* TITRE */
h1 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 28px;
    letter-spacing: 1px;
}

/* CONTAINER */
.container {
    max-width: 1100px;
    margin: auto;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    background: rgba(255,255,255,0.06);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

/* HEADER TABLE */
th {
    background: rgba(0,0,0,0.5);
    padding: 14px;
    text-align: left;
    font-size: 14px;
}

/* CELLS */
td {
    padding: 12px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

/* HOVER */
tr:hover {
    background: rgba(255,255,255,0.08);
}

/* INPUTS */
input {
    padding: 6px 10px;
    border-radius: 8px;
    border: none;
    outline: none;
    margin: 3px;
}

/* BUTTONS */
button {
    padding: 7px 12px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.2s;
    font-weight: bold;
}

button:hover {
    transform: scale(1.05);
}

/* DELETE BUTTON */
button[name="supp"] {
    background: #ff4d4d;
    color: white;
}

/* SAVE BUTTON */
button[name="modif"] {
    background: #3aa0ff;
    color: white;
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
/* ROLE BADGE */
.role {
    padding: 4px 10px;
    border-radius: 10px;
    font-size: 12px;
    display: inline-block;
}

.admin { background: #ff4d4d; }
.technicien { background: #f39c12; }
.user { background: #2ecc71; }

/* ACTION CELL */
td form {
    display: inline-block;
    margin: 2px;
}
</style>

</head>
<body>
    <nav>
<a href="index.php">Retour ↩️</a>

</nav>

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
    <td>🔒</td>
    <td><?php print($ligne['role']); ?></td>
    <td><?php print ($ligne['date_de_création']); ?></td>
    <td>
    <form method="POST" action="">
        <input type="hidden" name="supp_id" value="<?= $ligne['id']; ?>">
        <button type="submit" name="supp">Supprimer</button>
        <br></br>
    </form>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $ligne['id']; ?>">
        <input type="text" name="email" value="<?= $ligne['email']; ?>">
        <input type="password" name="mot_de_passe" placeholder="Nouveau mot de passe">

        <button type="submit" name="modif">sauvegarder</button>




    </form>
</td>
</tr>

<?php } ?>


    </table>
</div>

</body>
</html>
