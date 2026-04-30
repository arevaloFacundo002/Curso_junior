<?php
session_start();

if (!isset($_GET['dificultad']) && !isset($_SESSION['dificultad'])) {
    header("Location: home.php");
    exit;
}

if (isset($_GET['dificultad'])) {
    $_SESSION['dificultad'] = $_GET['dificultad'];
}

$dificultad = $_SESSION['dificultad'];

if (!isset($_SESSION['pregunta_num'])) {
    $_SESSION['pregunta_num'] = 1;
    $_SESSION['score'] = 0;
    $_SESSION['racha'] = 0;
}

// API
$url = "https://ghibliapi.dev/films";
$response = file_get_contents($url);
$films = json_decode($response, true);

// ❗ FIX ERROR PATH
if (!$films) {
    header('Location: error/error_index.php');
    exit;
}

// PROCESAR RESPUESTA
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['respuesta']) && isset($_SESSION['correcta'])) {

        if ($_POST['respuesta'] == $_SESSION['correcta']) {

            $_SESSION['score']++;
            $_SESSION['racha']++;

            if ($_SESSION['racha'] >= 3) {
                $_SESSION['score']++;
                $_SESSION['bonus'] = true;
            } else {
                $_SESSION['bonus'] = false;
            }

            $_SESSION['resultado'] = "correcto";

        } else {

            $_SESSION['racha'] = 0;
            $_SESSION['resultado'] = "incorrecto";
            $_SESSION['respuesta_correcta_texto'] = $_SESSION['correcta'];
            $_SESSION['bonus'] = false;
        }
    }

    $_SESSION['pregunta_num']++;
}

// ❗ FIX FINAL → PASAR SCORE
if ($_SESSION['pregunta_num'] > 10) {
    $_SESSION['final_score'] = $_SESSION['score'];
    header('Location: mensaje_final.php');
    exit;
}

// VARIABLES SEGURAS
$pregunta = "";
$respuesta_correcta = "";
$opciones = [];

// PELÍCULA RANDOM
$pelicula = $films[array_rand($films)];

// DIFICULTAD
if ($dificultad == "facil") {
    $tipos_posibles = [1];
} elseif ($dificultad == "medio") {
    $tipos_posibles = [1, 2];
} else {
    $tipos_posibles = [1, 2, 3, 4];
}

$tipo = $tipos_posibles[array_rand($tipos_posibles)];

// TIPOS DE PREGUNTA
if ($tipo == 1) {
    $pregunta = "¿Quién dirigió \"" . $pelicula['title'] . "\"?";
    $respuesta_correcta = $pelicula['director'];

} elseif ($tipo == 2) {
    $pregunta = "¿En qué año se lanzó \"" . $pelicula['title'] . "\"?";
    $respuesta_correcta = $pelicula['release_date'];

} elseif ($tipo == 3) {
    $pregunta = "¿Cuál es el RT Score de \"" . $pelicula['title'] . "\"?";
    $respuesta_correcta = $pelicula['rt_score'];

} elseif ($tipo == 4) {

    $peli1 = $films[array_rand($films)];
    do {
        $peli2 = $films[array_rand($films)];
    } while ($peli1['id'] == $peli2['id']);

    $pregunta = "¿Cuál de estas películas dura más?";

    $opcionA = $peli1['title'];
    $opcionB = $peli2['title'];

    $respuesta_correcta = ($peli1['running_time'] > $peli2['running_time'])
        ? $opcionA
        : $opcionB;

    $opciones = [$opcionA, $opcionB];
}

// OPCIONES (solo si NO es tipo 4)
if ($tipo != 4) {

    $opciones = [$respuesta_correcta];

    while (count($opciones) < 4) {

        $randomFilm = $films[array_rand($films)];

        if ($tipo == 1) {
            $valor = $randomFilm['director'];
        } elseif ($tipo == 2) {
            $valor = $randomFilm['release_date'];
        } else {
            $valor = $randomFilm['rt_score'];
        }

        if (!in_array($valor, $opciones)) {
            $opciones[] = $valor;
        }
    }

    shuffle($opciones);
}

// VALIDACIÓN FINAL
if (empty($pregunta) || empty($opciones)) {
    echo "Error generando la pregunta";
    exit;
}

$_SESSION['correcta'] = $respuesta_correcta;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Trivia Ghibli</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<?php if (isset($_SESSION['resultado'])): ?>

    <?php if ($_SESSION['resultado'] == "correcto"): ?>
        <p class="correcto">
            ✔ Correcto
            <?php if (!empty($_SESSION['bonus'])): ?>
                <br>🔥 ¡Racha activa! +1 punto extra
            <?php endif; ?>
        </p>
    <?php else: ?>
        <p class="incorrecto">
            ✘ Incorrecto. Respuesta correcta: <?php echo $_SESSION['respuesta_correcta_texto']; ?>
        </p>
    <?php endif; ?>

    <?php unset($_SESSION['resultado'], $_SESSION['respuesta_correcta_texto'], $_SESSION['bonus']); ?>

<?php endif; ?>

<h1>Pregunta <?php echo $_SESSION['pregunta_num']; ?> / 10</h1>

<div class="progress-container">
    <div class="progress-bar" style="width: <?php echo ($_SESSION['pregunta_num'] - 1) * 10; ?>%;"></div>
</div>

<p><strong><?php echo $pregunta; ?></strong></p>

<form method="POST">
    <?php foreach ($opciones as $opcion): ?>
        <div>
            <label>
                <input type="radio" name="respuesta" value="<?php echo $opcion; ?>" required>
                <?php echo $opcion; ?>
            </label>
        </div>
    <?php endforeach; ?>

    <button type="submit">Responder</button>
</form>

<p>Puntaje: <?php echo $_SESSION['score']; ?></p>
<p>🔥 Racha: <?php echo $_SESSION['racha']; ?></p>

</div>

</body>
</html>