<?php
session_start();

$url = "https://ghibliapi.dev/people";
$response = file_get_contents($url);
$people = json_decode($response, true);

if (!$people) {
    header('Location: error_endpoints.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Personajes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">

    <h1>👤 Personajes</h1>

    <ul class="listado">
        <?php foreach ($people as $per): ?>
            <li class="item"><?php echo $per['name']; ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="../home.php" class="btn-restart">⬅ Volver al inicio</a>

</div>

</body>
</html>