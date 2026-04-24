<?php
session_start();
if(empty($_SESSION['csrf'])){
  $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
require_once('config.php');

$Mon_erreur= true;
if(isset($_POST['bouton']) && isset($_POST['csrf']) && $_POST['csrf'] === $_SESSION['csrf']){
    $mail=$_POST['mon_email'];
    $mdp=$_POST['mon_mdp'];

    $sql="select * from  users where email= ? and mot_de_passe= ?";
    $stmt=mysqli_prepare($monLien,$sql);
    mysqli_stmt_bind_param($stmt,"ss",$mail,$mdp);
    mysqli_stmt_execute($stmt);
    $res=mysqli_stmt_get_result($stmt);
    $res2=mysqli_fetch_assoc($res);
          if(mysqli_num_rows($res) > 0){

            $_SESSION['mail']=$res2['email'];
            $_SESSION['role']=$res2['role'];
            $_SESSION['user_id']=$res2['id'];
            //ici le gas est connue//
        $ligne=mysqli_fetch_assoc($res); 
    
    header("Location: index.php");
    }

}
else{
    $Mon_erreur= false;
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
    font-family: Arial, sans-serif;
    margin: 0;
    height: 100vh;

    /* fond dégradé moderne */
    background: linear-gradient(135deg, #1e3c72, #2a5298);

    display: flex;
    justify-content: center;
    align-items: center;
}

/* Carte principale (glass effect) */
.modification { 
    width: 100%;
    max-width: 380px;
    padding: 30px;

    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);

    border-radius: 15px;
    color: white;

    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

/* Titre */
.titre label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

/* Inputs */
input {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: none;
    outline: none;

    background: rgba(255,255,255,0.2);
    color: white;

    margin-bottom: 15px;
}

/* Placeholder blanc */
input::placeholder {
    color: #ddd;
}

/* Focus */
input:focus {
    box-shadow: 0 0 8px rgba(255,255,255,0.5);
}

/* Bouton */
button {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 8px;

    background: #00c6ff;
    background: linear-gradient(90deg, #00c6ff, #0072ff);

    color: white;
    font-size: 16px;
    cursor: pointer;

    transition: 0.3s;
}

/* Hover */
button:hover {
    transform: scale(1.05);
    opacity: 0.9;
}
.msg-erreur {
  background: rgba(239,68,68,.12);
  border: 1px solid rgba(239,68,68,.3);
  border-radius: 10px;
  padding: 10px 14px;
  color: var(--red);
  font-size: 13px;
  font-weight: 700;
  margin-bottom: 16px;
}
    

    </style>
</head>

<body>


<div class="modification">

    <form action="" method="post">
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf']; ?>">

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