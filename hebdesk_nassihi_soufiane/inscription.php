<?php
session_start();
require_once('config.php');

if(empty($_SESSION['csrf'])){
  $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
if(!isset($_SESSION['role']) || $_SESSION['role'] !== "admin"){
    header("Location: index.php");
    exit();
}

$mon_message="";
if(isset($_POST['bouton'])){
    if($_SESSION['csrf']==$_POST['csrf_token']){
    if(!empty($_POST['mon_mdp']) && !empty($_POST['conf_mdp'])){
        if($_POST['mon_mdp']== $_POST['conf_mdp']){
            $sql="insert into users (email,mot_de_passe,role) values(?,?,?) ";
            $stmt=mysqli_prepare($monLien,$sql);
            mysqli_stmt_bind_param($stmt,"sss",$_POST['mon_email'],$_POST['mon_mdp'],$_POST['role']);

            if(mysqli_stmt_execute($stmt)){
                header("Location: login.php");
            }
        }else{
           $mon_message="<span class='msg'>*Les mots de passe ne sont pas pareil </span>";
        }

    }else{
        $mon_message = "<span class='msg'>* Vous devez remplir tous les champs !!</span>";
      }
   
    } else{
          die("CSRF invalide"); 
      }
}







?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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
.titre label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}
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
.msg{
        color:red;
      }

</style>
<body>



<form action="" method="POST">
<div class="modification">

<input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">

        <div class="titre">
            <label>email</label>
            <input type="email" name="mon_email" required>
        </div>

        <div class="titre">
            <label>Mot de passe</label>
            <input type="password" name="mon_mdp" required>
        </div>
        <div class="titre">
          <label>Confirmer le mot de passe</label>
          <input name="conf_mdp" type="password" required>
          <?=$mon_message?>
          
        </div>
        <div class="titre">
          <label>role</label>
          <input name="role" type="text" required>
          
        </div>



        <div class="titre">
            <button type="submit" name="bouton">crée</button>
        </div>
        </div>

    </form>



    
</body>
</html>