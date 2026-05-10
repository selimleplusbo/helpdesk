<?php
session_start();
require_once('config.php');
require_once('sécurité.php');

$mon_id = $_SESSION['user_id'];

$ticket_id = isset($_GET['ticket_id']) ? (int)$_GET['ticket_id'] : 0;

if ($ticket_id <= 0) {
    header("Location: ticket.php");
    exit;
}

if (isset($_POST['bouton'])) {
    if (!empty($_POST['msg'])) {
        $user_id = $_SESSION['user_id'];

        $sql = "INSERT INTO messages (ticket_id, user_id, message) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($monLien, $sql);
        mysqli_stmt_bind_param($stmt, "iis", $ticket_id, $user_id, $_POST['msg']);
        mysqli_stmt_execute($stmt);
    }
}

$sql = "SELECT * FROM tickets WHERE id = ?";
$stmt = mysqli_prepare($monLien, $sql);
mysqli_stmt_bind_param($stmt, "i", $ticket_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$ticket = mysqli_fetch_assoc($result);

if (!$ticket) {
    header("Location: ticket.php");
    exit;
}

if ($_SESSION['role'] == 'user' && $ticket['user_id'] != $_SESSION['user_id']) {
    header("Location: ticket.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">    
<head>
<meta charset="UTF-8">
<title>Messenger UI</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Inter','Segoe UI',sans-serif;
    height:100vh;
    overflow:hidden;

    background:
    radial-gradient(circle at top left,#2563eb33,transparent 30%),
    radial-gradient(circle at bottom right,#7c3aed33,transparent 30%),
    linear-gradient(135deg,#0f172a,#111827,#1e293b);

    color:white;
}

/* APP */
.app{
    display:flex;
    height:100vh;
    backdrop-filter:blur(10px);
}

/* SIDEBAR */
.sidebar{
    width:320px;
    padding:20px;
    background:rgba(15,23,42,0.75);
    backdrop-filter:blur(20px);
    border-right:1px solid rgba(255,255,255,0.08);
    overflow-y:auto;
}

.sidebar h2{
    font-size:24px;
    margin-bottom:25px;
    font-weight:700;
}

.contact{
    display:flex;
    align-items:center;
    padding:14px;
    margin-bottom:12px;
    border-radius:20px;
    background:rgba(255,255,255,0.03);
    transition:0.25s;
}

.contact:hover{
    background:rgba(255,255,255,0.08);
}

.ticket-icon{
    width:48px;
    height:48px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:14px;
    background:rgba(255,255,255,0.06);
    margin-right:14px;
}

/* CHAT */
.chat{
    flex:1;
    display:flex;
    flex-direction:column;
}

.chat-box{
    flex:1;
    padding:25px;
    overflow-y:auto;
    display:flex;
    flex-direction:column;
    gap:8px;
}

/* MESSAGE */
.msg{
    max-width:65%;
    padding:14px 18px;
    border-radius:22px;
}

.me{
    align-self:flex-end;
    background:linear-gradient(135deg,#2563eb,#7c3aed);
}

.other{
    align-self:flex-start;
    background:rgba(255,255,255,0.08);
}

/* INPUT */
.chat-input{
    display:flex;
    gap:15px;
    padding:20px;
    background:rgba(15,23,42,0.7);
}

textarea{
    flex:1;
    padding:16px;
    border-radius:18px;
    background:rgba(255,255,255,0.06);
    color:white;
    border:none;
    outline:none;
    resize:none;
}

.bouton{
    padding:14px 22px;
    border-radius:16px;
    background:linear-gradient(135deg,#2563eb,#7c3aed);
    color:white;
    border:none;
    cursor:pointer;
}

</style>

</head>
<body>

<div class="app">

<!-- SIDEBAR -->
<div class="sidebar">
<h2>Mes tickets</h2>

<?php
if ($_SESSION['role'] == 'technicien' || $_SESSION['role'] == 'admin') {
    $tickets = mysqli_query($monLien, "SELECT * FROM tickets WHERE statut != 'ferme'");
} else {
    $sql = "SELECT * FROM tickets WHERE user_id = ? AND statut != 'ferme'";
    $stmt = mysqli_prepare($monLien, $sql);
    mysqli_stmt_bind_param($stmt, "i", $mon_id);
    mysqli_stmt_execute($stmt);
    $tickets = mysqli_stmt_get_result($stmt);
}

while ($t = mysqli_fetch_assoc($tickets)) {
?>
<a href="?ticket_id=<?= $t['id'] ?>" style="text-decoration:none;color:white;">
    <div class="contact">
        <div class="ticket-icon">🎫</div>
        <b><?= $t['titre'] ?></b>
    </div>
</a>
<?php } ?>

</div>

<!-- CHAT -->
<div class="chat">

<div class="chat-box">
    <div class="chat">

<div style="display:flex;justify-content:flex-end;padding:20px 20px 0 20px;">

<?php if($_SESSION['role'] == 'technicien' || $_SESSION['role'] == 'admin'){ ?>

    <a href="ticket_technicien.php" class="bouton" style="text-decoration:none;">
        Retour ↩️
    </a>

<?php } else { ?>

    <a href="ticket.php" class="bouton" style="text-decoration:none;">
        Retour ↩️
    </a>

<?php } ?>

</div>

<div class="chat-box">

<?php
$messages = mysqli_query($monLien,"
SELECT messages.*, users.email, users.role
FROM messages
JOIN users ON messages.user_id = users.id
WHERE messages.ticket_id = $ticket_id
");


while ($mesMessage = mysqli_fetch_assoc($messages)) {
?>

<?php
if($mesMessage['role']=="admin"){
    $role="👑 Admin";
}
elseif($mesMessage['role']=="technicien"){
    $role="🛠️ Technicien";
}
else{
    $role="👤 User";
}
?>

<?php if($mesMessage['user_id']==$_SESSION['user_id']){?>

    <div class="msg me">
        <small style="opacity:0.7;display:block;margin-bottom:5px;">
            Vous - <?= $mesMessage['email'] ?>
        </small>
        <?php print($mesMessage['message']); ?>
    </div>

<?php } else { ?>

    <div class="msg other">
        <small style="opacity:0.7;display:block;margin-bottom:5px;">
            <?= $role ?> - <?= $mesMessage['email'] ?>
        </small>
        <?php print($mesMessage['message']); ?>
    </div>

<?php } ?>

<?php
}
?>

</div>

<form class="chat-input" method="POST" action="?ticket_id=<?= $ticket_id ?>">
<textarea name="msg" placeholder="taper pour écrire"></textarea>
<button class="bouton" name="bouton">Envoyer</button>
</form>

</div>
</div>

</body>
</html>