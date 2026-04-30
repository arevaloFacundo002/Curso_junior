<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ghibli Trivia Challenge</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <h1 class="titulo">Trivia de cine <br>🎥🎬🍿 </h1>

    <form action="index.php" method="GET">

        <div class="dificultad">
            <h2>Selecciona dificultad</h2>

            <div class="botones-dificultad">
                <label>
                    <input type="radio" name="dificultad" value="facil" required>
                    <span class="btn">Fácil</span>
                </label>

                <label>
                    <input type="radio" name="dificultad" value="medio">
                    <span class="btn">Medio</span>
                </label>

                <label>
                    <input type="radio" name="dificultad" value="dificil">
                    <span class="btn">Difícil</span>
                </label>
            </div>
        </div>

        <div class="jugar-container">
            <button type="submit" class="btn jugar-btn">Jugar</button>
        </div>


        <div class="extra-links">
            <a href="people.php" class="btn-extra">👤 Ver personajes</a>
            <a href="locations.php" class="btn-extra">📍 Ver locaciones</a>
        </div>

    </form>

</div>

</body>
</html>