<?php
session_start();
require_once('config.php');

if(isset($_POST['bouton'])){
    if($_POST['titre'] && $_POST['msg']){
          $sql = "insert into tickets (titre,description,user_id) values (?,?,?)";
          $stmt = mysqli_prepare($monLien, $sql);
          mysqli_stmt_bind_param($stmt,"ssi",$_POST['titre'],$_POST['msg'],$_SESSION['user_id']);
          if(mysqli_stmt_execute($stmt)){
            header("Location: lougout.php");
            
            
      

          }    
}
}





?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
    body {
    background: linear-gradient(135deg, #0f4c81, #3aa0ff);
    font-family: Arial, sans-serif;
}

table {
    margin: 80px auto;
    width: 500px;
    background-color: white;
    color: #333;
    border-radius: 12px;
    border: none;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    padding: 20px;
}

td {
    padding: 10px;
}

input[type="text"], textarea {
    width: 100%;
    padding: 10px;
    border: 2px solid #ddd;
    border-radius: 8px;
    transition: 0.3s;
    font-size: 14px;
}

input[type="text"]:focus, textarea:focus {
    border-color: #3aa0ff;
    outline: none;
    box-shadow: 0 0 5px rgba(58,160,255,0.5);
}

input[type="submit"] {
    background: linear-gradient(135deg, #1e6fd9, #3aa0ff);
    color: white;
    border: none;
    padding: 12px;
    border-radius: 8px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
    transition: 0.3s;
}

input[type="submit"]:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

tr:first-child td {
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    padding-bottom: 15px;
}
.page {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.card {
    background: rgba(255,255,255,0.1);
    padding: 30px;
    border-radius: 15px;
    backdrop-filter: blur(10px);
    color: white;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

    </style>
</head>
<body>




    <form action="" method="post">
        <table>
            <tr><td>Titre:</td><td><input type="text" name="titre"></td></tr>
            <tr><td>Décrivez moi ce qu'il s'est passer:</td><td><textarea name="msg" cols="30" rows="6"></textarea> </td></tr>
            
          
     

            </tr>



            

            </tr>



           <tr><td></td><td><input type="submit" value="Envoyer" name="bouton"></td></tr>
        </table>
    </form>
    <br>

</body>
</html>