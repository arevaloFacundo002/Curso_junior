<?php
session_start();

$url = "https://ghibliapi.dev/locations";
$response = file_get_contents($url);
$locations = json_decode($response, true);

if (!$locations) {
    header('Location: error_endpoints.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Locaciones</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">

    <h1>📍 Locaciones</h1>

    <ul class="listado">
        <?php foreach ($locations as $loc): ?>
            <li class="item"><?php echo $loc['name']; ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="../home.php" class="btn-restart">⬅ Volver al inicio</a>

</div>

</body>
</html>