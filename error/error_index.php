<?php
session_start();
$dificultad = $_SESSION['dificultad'] ?? 'no_definida';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
    <h1>⚠ Error de conexión</h1>
    <p>No se pudieron cargar los datos de la API.</p>
    <a href="../index.php?dificultad=<?php echo $dificultad; ?>" class="btn-restart">🔄 Reintentar</a>
</div>

</body>
</html>