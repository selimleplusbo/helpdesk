<?php
session_start();
require_once('config.php');


if(isset($_POST['bouton'])){
    if(!empty($_POST['msg']) && isset($_GET['ticket_id'])){

        

        $sql = "INSERT INTO messages (ticket_id, user_id, message) VALUES (?, ?,?)";
        $stmt = mysqli_prepare($monLien, $sql);
        mysqli_stmt_bind_param($stmt, "iis",$_GET['ticket_id'],$_SESSION['user_id'],$_POST['msg']);
        mysqli_stmt_execute($stmt);
    }
}
$mon_id=$_SESSION['user_id'];


?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Messenger UI</title>

<style>
body{
    margin:0;
    font-family: 'Segoe UI', Arial, sans-serif;
    
    /* Dégradé doux type Messenger */
    background: linear-gradient(180deg, #e4ecf7 0%, #d8e4f2 100%);
    
    /* effet bulles légères */
    background-image:
        radial-gradient(circle at 20% 30%, rgba(0,132,255,0.08) 0, transparent 40%),
        radial-gradient(circle at 80% 70%, rgba(0,132,255,0.08) 0, transparent 40%)
}

/* APP LAYOUT */
.app{
    display:flex;
    height:100vh;
}

/* SIDEBAR */
.sidebar{
    width:300px;
    background:white;
    border-right:1px solid #e0e0e0;
    padding:15px;
    overflow-y:auto;
    box-shadow: 2px 0 8px rgba(0,0,0,0.05);
}

.sidebar h2{
    margin:10px;
    font-size:20px;
}

.contact{
    display:flex;
    padding:10px;
    border-radius:12px;
    cursor:pointer;
    transition:0.2s;
}

.contact:hover{
    background:#f0f4ff;
}

.avatar{
    width:40px;
    height:40px;
    border-radius:50%;
    background:linear-gradient(135deg,#6a11cb,#2575fc);
    margin-right:10px;
}

/* CHAT */
.chat{
    flex:1;
    display:flex;
    flex-direction:column;
    background:#f7f9fc;
}

/* HEADER */
.chat-header{
    display:flex;
    align-items:center;
    padding:15px;
    background:white;
    border-bottom:1px solid #ddd;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.chat-header h3{
    margin:0 10px;
}

nav{
    margin-left:auto;
}

nav a{
    background:#007BFF;
    color:white;
    padding:8px 14px;
    border-radius:20px;
    font-size:14px;
    transition:0.2s;
}

nav a:hover{
    background:#0056b3;
}

/* MESSAGES */
.chat-box{
    flex:1;
    padding:20px;
    overflow-y:auto;
    display:flex;
    flex-direction:column;

    /* fond type Messenger */
    background: url("https://www.transparenttextures.com/patterns/cubes.png");
    background-color: #f0f2f5;
}

.msg{
    max-width:60%;
    padding:12px 15px;
    margin:6px;
    border-radius:18px;
    font-size:14px;
    line-height:1.4;
    box-shadow: 0 2px 5px rgba(0,0,0,0.08);
}

.me{
    background:linear-gradient(135deg,#0084ff,#3aa0ff);
    color:white;
    align-self:flex-end;
    border-bottom-right-radius:5px;
}

.other{
    background:white;
    align-self:flex-start;
    border-bottom-left-radius:5px;
}

/* INPUT */
.chat-input{
    display: flex;
    align-items: center;
    padding: 15px;
    background: white;
    border-top: 1px solid #ddd;
    gap: 10px;
}

textarea {
    flex:1;
    padding: 12px 15px;
    border: none;
    border-radius: 20px;
    resize: none;
    background: #f0f2f5;
    font-size: 14px;
    outline: none;
    transition: 0.2s;
}

textarea:focus {
    background: #e8ebf0;
    box-shadow: 0 0 0 2px #3aa0ff;
}

/* BOUTON */
.bouton{
    background: linear-gradient(135deg,#007BFF,#3aa0ff);
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 20px;
    cursor: pointer;
    transition: 0.2s;
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
}

.bouton:hover {
    transform: scale(1.05);
    background: linear-gradient(135deg,#0056b3,#007BFF);
}

/* LIENS */
a{
    text-decoration:none; 
    color:black;
}
</style>

</head>
<body>

<div class="app">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Mes tickets</h2>

        <?php
        if($_SESSION['role']=='technicien' || $_SESSION['role']=='admin'){
        $tickets = mysqli_query($monLien, "SELECT * FROM tickets");
        }else if($_SESSION['role']=='user'){
             $tickets = mysqli_query($monLien, "SELECT * FROM tickets where user_id =$mon_id");
                }else{
                        header("Location: index.php");
                }
        while ($ticket = mysqli_fetch_assoc($tickets)) {
        ?>
            <a href="?ticket_id=<?php echo $ticket['id']; ?>" style="text-decoration:none; color:black;">
                <div class="contact">
                    <div class="avatar"></div>
                    <div>
                        <b><?php echo $ticket['titre']; ?></b>
                    </div>
                </div>
            </a>
        <?php } ?>

    </div>

    <!-- CHAT -->
    <div class="chat">

        <div class="chat-header">
            <div class="avatar"></div>
            
            <nav>
  

    <?php if (isset($_SESSION['role'])) { ?>

        <?php if ($_SESSION['role'] == 'technicien') { ?>
            <li><a href="ticket_technicien.php">Retour↩️</a></li>
        <?php } else { ?>
            <li><a href="ticket.php">Retour↩️</a></li>
        <?php } ?>

    <?php } ?>

  
</nav>
        </div>

        <div class="chat-box">

        <?php
        $ticket_id = isset($_GET['ticket_id']) ? intval($_GET['ticket_id']) : 0;

        if($ticket_id > 0){

            $messages = mysqli_query($monLien, "SELECT * FROM messages WHERE ticket_id = $ticket_id");

            while ($mesMessage = mysqli_fetch_assoc($messages)) {
        ?>


                <?php if($mesMessage['user_id']==$_SESSION['user_id']){?>
                <div class="msg me">
                    <?php echo $mesMessage['message']; ?>
                </div>
                <?php
                }else{
                ?>


                <div class="msg other">
                    <?php echo $mesMessage['message']; ?>
                </div>
                <?php
                }
                ?>
        <?php
            }

        }
        ?>

        </div>

        <form  class="chat-input" method="POST" action="?ticket_id=<?php echo $_GET['ticket_id']; ?>">
        <textarea name="msg" placeholder="taper pour écrire"></textarea>
        <button class="bouton"type="submit" name="bouton">Envoyer</button>
</form> 

    </div>

</div>

</body>
</html>