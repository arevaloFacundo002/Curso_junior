<?php
session_start();

$score = $_SESSION['final_score']??0;
session_unset(); 
session_destroy(); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>🏆 Resultado final</h1>
    <p style="font-size: 22px; font-weight: bold;"><?php echo $score; ?> / 10</p>

    <p>
        <?php
        if ($score <= 4) echo "😅 ¿Viste aunque sea El Viaje de Chihiro...?"; 
        elseif ($score <= 7) echo "🙂 ¡Nada mal!"; 
        else echo "🔥 ¡Eres un maestro Ghibli!";
        ?>
    </p>

    <a href="home.php" class="btn-restart">Jugar de nuevo</a>
</div>

</body>
</html>