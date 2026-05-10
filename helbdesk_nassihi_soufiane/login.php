<?php
session_start();
if(empty($_SESSION['csrf'])){
  $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
require_once('config.php');

$Mon_erreur = false;

if(isset($_POST['bouton']) && isset($_POST['csrf']) && $_POST['csrf'] === $_SESSION['csrf']){
    $nom=$_POST['mon_nom'];
    $mail = $_POST['mon_email'];
    $mdp = $_POST['mon_mdp'];

    $sql = "SELECT * FROM users WHERE email = ? and nom= ?";
    $stmt = mysqli_prepare($monLien, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $mail,$nom);
    mysqli_stmt_execute($stmt);

    $res = mysqli_stmt_get_result($stmt);
    $res2 = mysqli_fetch_assoc($res);

    if($res2 && password_verify($mdp, $res2['mot_de_passe'])){
        $_SESSION['mail'] = $res2['email'];
        $_SESSION['nom']=   $res2['nom'];
        $_SESSION['role'] = $res2['role'];
        $_SESSION['user_id'] = $res2['id'];
        
        header("Location: index.php");
        exit();
    }

    
    $Mon_erreur = true;

} 






?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soufiane</title>

<style>
    body {
    margin: 0;
    height: 100vh;
    font-family: Arial, sans-serif;

    display: flex;
    justify-content: center;
    align-items: center;

    background: radial-gradient(circle at top, #1e3c72, #0f172a);
}

/* CARD */
.modification {
    width: 100%;
    max-width: 420px;

    padding: 35px;

    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(18px);

    border-radius: 18px;

    box-shadow: 0 20px 50px rgba(0,0,0,0.5);

    color: white;

    animation: fadeIn 0.6s ease;
}

/* TITLE */
h2 {
    text-align: center;
    margin-bottom: 20px;
}

/* INPUT GROUP */
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
    font-size: 16px;
    font-weight: bold;

    cursor: pointer;

    transition: 0.3s;
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
}

/* ERROR */
.msg-erreur {
    background: rgba(255, 0, 0, 0.15);
    border: 1px solid rgba(255,0,0,0.4);
    padding: 10px;
    border-radius: 10px;
    margin-top: 10px;
    font-size: 13px;
    color: #ff6b6b;
}

/* ANIMATION */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
    

    </style>
</head>

<body>


<div class="modification">

    <form action="" method="post">
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf']; ?>">

        <div class="titre">
            <label>Nom</label>
            <input type="text" name="mon_nom" required>
        </div>

        <div class="titre">
            <label>Identification</label>
            <input type="email" name="mon_email" required>
        </div>

        <div class="titre">
            <label>Mot de passe</label>
            <input type="password" name="mon_mdp" required>

            <?php if($Mon_erreur){ ?>
                <div class="msg-erreur">
                    ❌ Identifiant ou mot de passe incorrect !
                </div>
            <?php } ?>
        </div>

        
        <div class="titre">
            <button type="submit" name="bouton">Connexion</button>
        </div>

    </form>

</div>








    
</body>
</html>