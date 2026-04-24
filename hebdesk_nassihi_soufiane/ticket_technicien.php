<?php
session_start();
require_once('config.php');

if($_SESSION['role'] == "user"){
    header('Location: ticket.php');
}

if (isset($_POST['id']) && isset($_POST['statut'])) {
    $mon_id= $_POST['id'];
    $mon_statut = $_POST['statut'];

    mysqli_query($monLien, "UPDATE tickets SET statut='$mon_statut' WHERE id=$mon_id");
    


}



 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    
</head>
<style>
    body {
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    font-family: Arial;
    color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
}

table {
    width: 80%;
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

/* couleurs selon statut */
.ouvert { color: green; font-weight: bold; }
.ferme { color: red; font-weight: bold; }
.en_cours { color: orange; font-weight: bold; }
</style>
<body>
    <h2>Réparation des tickets</h2>
    <a href="index.php" class="btn-retour">Retour ↩️</a>
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
        <a href="index2.php?id=<?php echo $ligne['id']; ?>" style="text-decoration:none; color:black;">
            <?php echo $ligne['titre']; ?>
        </a>
    </td>

    <td>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $ligne['id']; ?>">
            
            <select name="statut" onchange="this.form.submit()">
                <option value="ouvert" <?php if($ligne['statut']=='ouvert')  print("selected"); ?>>Ouvert</option>
                <option value="en_cours" <?php if($ligne['statut']=='en_cours')print("selected") ; ?>>En cours</option>
                <option value="ferme" <?php if($ligne['statut']=='ferme')print("selected") ; ?>>Fermé</option>
            </select>
        </form>
    </td>

    <td><?php echo $ligne['description']; ?></td>
    <td><?php echo $ligne['date_de_creation']; ?></td>
</tr>
<?php
}
?>
</table>
    
</body>
</html>