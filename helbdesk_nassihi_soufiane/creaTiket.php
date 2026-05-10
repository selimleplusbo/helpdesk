<?php
session_start();
require_once('config.php');
require_once('sécurité.php');

if(isset($_POST['bouton'])){
    if(!empty($_POST['titre']) && !empty($_POST['msg'])){

        $sql = "INSERT INTO tickets (titre, description, user_id) VALUES (?,?,?)";
        $stmt = mysqli_prepare($monLien, $sql);
        mysqli_stmt_bind_param($stmt,"ssi", $_POST['titre'], $_POST['msg'], $_SESSION['user_id']);

        if(mysqli_stmt_execute($stmt)){
            header("Location: lougout.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Créer un ticket</title>

<style>
body{
    margin:0;
    font-family: Arial;
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

/* CARD */
form{
    background: rgba(255,255,255,0.1);
    padding:30px;
    border-radius:15px;
    backdrop-filter: blur(10px);
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
    width:400px;
    color:white;
}

/* TITLE */
h2{
    text-align:center;
    margin-bottom:20px;
}

/* INPUTS */
input[type="text"], textarea{
    width:100%;
    padding:12px;
    margin-top:5px;
    border:none;
    border-radius:8px;
    outline:none;
}

/* TEXTAREA */
textarea{
    resize:none;
}

/* BUTTON */
input[type="submit"]{
    width:100%;
    padding:12px;
    margin-top:15px;
    border:none;
    border-radius:8px;
    background:#1abc9c;
    color:white;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}

input[type="submit"]:hover{
    background:#16a085;
    transform:scale(1.05);
}

/* LABEL */
label{
    font-size:14px;
}
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animation{
    animation: fadeIn 0.6s ease;
}
</style>

</head>

<body>
    


<form method="post">
    <div class="animation">

    <h2>🎫 Créer un ticket</h2>

    <label>Titre</label>
    <input type="text" name="titre" placeholder="Titre du problème">

    <br><br>

    <label>Description</label>
    <textarea name="msg" rows="6" placeholder="Décris ton problème..."></textarea>

    <input type="submit" name="bouton" value="Envoyer">

</form>
</div>

</body>
</html>