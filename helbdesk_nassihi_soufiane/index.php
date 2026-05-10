    <?php
    session_start();
    require_once('sécurité.php');



    require_once('config.php');

    $monLien = "ticket.php";

    if(isset($_SESSION['role'])){
        if($_SESSION['role'] == 'technicien'){
            $monLien = "ticket_technicien.php";
        }
        if($_SESSION['role'] == 'admin'){
            $monLien = "ticket_admin.php";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>

    <style>
    body{
        margin:0;
        font-family: Arial;
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        padding-top: 70px;
        color:white;
    }

    nav{
        background:#2c3e50;
        padding:15px 0;
        position:fixed;
        top:0;
        width:100%;
    }

    nav ul{
        list-style:none;
        display:flex;
        justify-content:center;
        margin:0;
        padding:0;
    }

    nav li{
        margin:0 15px;
    }

    nav a{
        color:white;
        text-decoration:none;
        font-size:18px;
    }

    /* CONTENU */
    .container{
        text-align:center;
        padding:40px;
    }

    .welcome{
        background: rgba(255,255,255,0.1);
        padding:25px;
        border-radius:15px;
        width:60%;
        margin:20px auto;
        backdrop-filter: blur(10px);
    }

    /* CARDS */
    .cards{
        display:flex;
        justify-content:center;
        gap:20px;
        flex-wrap:wrap;
        margin-top:40px;
    }

    .card{
        width:220px;
        padding:25px;
        border-radius:15px;
        background:white;
        color:black;
        text-decoration:none;
        transition:0.3s;
        box-shadow:0 5px 15px rgba(0,0,0,0.2);
    }

    .card:hover{
        transform:translateY(-5px);
    }
    span{
        color:green;
        font-weight: bold;
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

    /* animation globale */
    .container {
        animation: fadeIn 0.6s ease;
    }

    /* cards animation */
    .card {
        animation: fadeIn 0.6s ease;
        animation-fill-mode: both;
    }

    /* effet décalé pour les cards */
    .card:nth-child(1) { animation-delay: 0.1s; }
    .card:nth-child(2) { animation-delay: 0.2s; }
    .card:nth-child(3) { animation-delay: 0.3s; }
    .card:nth-child(4) { animation-delay: 0.4s; }

    /* petit hover smooth déjà amélioré */
    .card {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    }

    /* welcome fade */
    .welcome {
        animation: fadeIn 0.5s ease;
    }
    </style>

    </head>
    <body>

    

    <div class="container">

        <div class="welcome">
            <h1>Bienvenue <?php print($_SESSION['nom']); ?> 👋 </h1>
            <p>Rôle : <span class="role"><?php print($_SESSION['role']); ?></span></p>
        </div>

        
        <div class="cards">

            <a href="<?= $monLien ?>" class="card">
                🎫
                <h3>Ticket</h3>
                <p>Accéder au tickets</p>
            </a>

            <a href="logout.php" class="card">
                ⛔
                <h3>Déconnexion</h3>
                <p>Quitter la session</p>
            </a>

            <?php if($_SESSION['role'] == "admin"){ ?>

            <a href="inscription.php" class="card">
                ➕
                <h3>Inscription</h3>
                <p>Ajouter un utilisateur</p>
            </a>

            <a href="Panel.php" class="card">
                ⚙️
                <h3>Panel Admin</h3>
                <p>Gestion du système</p>
            </a>
            <?php } ?>


            <?php if($_SESSION['role'] == "technicien"||$_SESSION['role'] == "admin"){?>
            <a href="ancien_tickets.php" class="card">
                📦
                <h3>Nos Archives</h3>
                <p>tickets fermer</p>
            </a>

            <?php }?>




            

        </div>

    </div>

    </body>
    </html>