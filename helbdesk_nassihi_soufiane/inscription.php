<?php
session_start();
require_once('config.php');
require_once('sécurité.php');

if($_SESSION['role']!="admin"){
    header("Location: index.php");
    exit();
}

if(empty($_SESSION['csrf'])){
  $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
if(!isset($_SESSION['role']) || $_SESSION['role'] !== "admin"){
    header("Location: index.php");
    exit();
}



$mon_message="";
if (isset($_POST['bouton'])) {

    if ($_SESSION['csrf'] == $_POST['csrf_token']) {
    if (!empty($_POST['mon_mdp']) && !empty($_POST['conf_mdp'])) {
    if ($_POST['mon_mdp'] == $_POST['conf_mdp']) {
    if (!empty($_POST['role'])) {
    if ($_POST['role'] == "user" || $_POST['role'] == "admin" || $_POST['role'] == "technicien") {

    $hash = password_hash($_POST['mon_mdp'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (nom,email, mot_de_passe, role) VALUES (?,?, ?, ?)";
     $stmt = mysqli_prepare($monLien, $sql);
    mysqli_stmt_bind_param($stmt, "ssss",$_POST['mon_nom'],$_POST['mon_email'], $hash, $_POST['role']);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit();
        }
        } else {
            $mon_message = "<span class='msg'>* veuillez mettre le bon rôle </span>";
            }
            } else {
               $mon_message = "<span class='msg'>* Le rôle est obligatoire </span>";
            }
            } else {
                $mon_message = "<span class='msg'>* Les mots de passe ne sont pas pareils </span>";
            }

        } else {
            $mon_message = "<span class='msg'>* Vous devez remplir tous les champs !!</span>";
        }

    } else {
        die("CSRF invalide");
    }
}







?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Créer un utilisateur</title>


<style>
body {
    margin: 0;
    height: 100vh;
    font-family: Arial, sans-serif;

    display: flex;
    justify-content: center;
    align-items: center;

    background: radial-gradient(circle at top, #2a5298, #0f172a);
}

/* CARD */
.modification {
    width: 100%;
    max-width: 420px;

    padding: 35px;

    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(15px);

    border-radius: 18px;

    box-shadow: 0 15px 40px rgba(0,0,0,0.4);

    color: white;

    animation: fadeIn 0.6s ease;
}

/* TITLE STYLE */
h2 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 22px;
    letter-spacing: 1px;
}

/* INPUT BLOCK */
.titre {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 6px;
    font-size: 14px;
    opacity: 0.9;
}

/* INPUTS */
input {
    width: 100%;
    padding: 12px;

    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.2);

    background: rgba(255,255,255,0.1);
    color: white;

    outline: none;

    transition: 0.3s;
}

input:focus {
    border-color: #00c6ff;
    box-shadow: 0 0 10px rgba(0,198,255,0.4);
}

/* BUTTON */
button {
    width: 100%;
    padding: 12px;

    border: none;
    border-radius: 10px;

    background: linear-gradient(90deg, #00c6ff, #0072ff);

    color: white;
    font-size: 15px;
    font-weight: bold;

    cursor: pointer;

    transition: 0.3s;
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.3);
}

/* ERROR MSG */
.msg {
    color: #ff4d4d;
    font-size: 13px;
    margin-top: 5px;
    display: block;
}
.roles{
    display:flex;
    gap:10px;
    margin-top:10px;
}

.role-card{
    flex:1;
    background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.15);
    border-radius:12px;
    padding:12px;
    text-align:center;
    cursor:pointer;
    transition:0.25s;
}

.role-card:hover{
    background:rgba(255,255,255,0.15);
    transform:translateY(-2px);
}

.role-card input{
    display:none;
}

.role-card span{
    font-size:14px;
    font-weight:bold;
}
.role-card input:checked + span{
    color:#00c6ff;
}

.role-card input:checked + span::after{
    content:" ✔";
}

.role-card:has(input:checked){
    background:rgba(0,198,255,0.2);
    border:1px solid #00c6ff;
    box-shadow:0 0 15px rgba(0,198,255,0.4);
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
</style>

</head>

<body>
     <nav>
<a href="index.php">Retour ↩️</a>

</nav>

<form action="" method="POST">

<div class="modification">

<h2>Créer un utilisateur</h2>

<input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">

<div class="titre">
    <label>nom</label>
    <input type="text" name="mon_nom" required>
</div>


<div class="titre">
    <label>Email</label>
    <input type="email" name="mon_email" required>
</div>

<div class="titre">
    <label>Mot de passe</label>
    <input type="password" name="mon_mdp" required>
</div>

<div class="titre">
    <label>Confirmer le mot de passe</label>
    <input type="password" name="conf_mdp" required>
</div>

<div class="titre">
    <label>Rôle</label>

    <div class="roles">

        <label class="role-card">
            <input type="radio" name="role" value="user" required>
            <span>👤 User</span>
        </label>

        <label class="role-card">
            <input type="radio" name="role" value="technicien">
            <span>🛠️ Technicien</span>
        </label>

        <label class="role-card">
            <input type="radio" name="role" value="admin">
            <span>👑 Admin</span>
        </label>

    </div>

    <?=$mon_message?>
</div>

<div class="titre">
    <button type="submit" name="bouton">Créer</button>
</div>

</div>

</form>

</body>
</html>
