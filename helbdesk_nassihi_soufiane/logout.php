<?php
session_start();
unset($_SESSION['role']);
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Déconnexion</title>
  <meta http-equiv="refresh" content="2;url=login.php">

</head>
<style>
body {
    margin: 0;
    height: 100vh;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;

    /* Même fond que login */
    background: linear-gradient(135deg, #1e3c72, #2a5298);
}

/* Carte */
.card {
    text-align: center;
    padding: 30px;
    width: 300px;

    /* Glass effect */
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);

    border-radius: 15px;
    color: white;

    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

/* Emoji */
.card div {
    font-size: 3rem;
    margin-bottom: 10px;
}

/* Titre */
.card h2 {
    margin-bottom: 10px;
}

/* Paragraphe */
.card p {
    color: #ddd;
    font-size: 13px;
}

/* Animation facultative */
.card {
    animation: fadeIn 0.8s ease;
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

</style>
<body>
  <div class="page">
    <div class="card" style="text-align:center;">
      <div style="font-size:3rem; margin-bottom:12px;">👋</div>
      <h2 style="font-family:'Fredoka One',cursive; font-size:1.6rem; margin-bottom:8px;">À bientôt !</h2>
      <p style="color:rgba(255,255,255,.4); font-size:13px; font-weight:700;">Redirection vers le login...</p>
    </div>
  </div>
</body>
</html>
















