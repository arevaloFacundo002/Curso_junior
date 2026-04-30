# curso_junior

Aplicación web desarrollada en PHP, HMTL y CSS que permite jugar una trivia sobre películas de Studio Ghibli utilizando una API pública.

---

## Cómo ejecutar el proyecto

1. Clonar el repositorio:

```
git clone https://github.com/arevaloFacundo002/Curso_junior
```

2. Mover la carpeta al servidor local (XAMPP, WAMP, etc.)

Ejemplo en XAMPP:

```
C:\xampp\htdocs\curso_junior
```

3. Iniciar Apache desde el panel de control

4. Abrir en el navegador:

```
http://localhost/curso_junior/home.php
```

---

## Funcionalidades

* Selección de dificultad (fácil, medio, difícil)
* 10 preguntas aleatorias por partida
* Diferentes tipos de preguntas:

  * Director
  * Año de estreno
  * Puntaje (RT Score)
  * Duración (bonus)
* Sistema de puntaje
* Sistema de racha (streak) con bonus
* Barra de progreso
* Feedback inmediato (correcto / incorrecto)

---

## API utilizada

https://ghibliapi.dev/

Endpoints:

* /films
* /people
* /locations

---

## 📂 Estructura del proyecto

```
/css
/img
/enpoints
  people.php
  locations.php
/error
  error_index.php
  error_enpoints.php
home.php
index.php
README.md
```

---

##  Tecnologías

* PHP
* HTML
* CSS
* API REST

---

## Bonus implementados

* Sistema de racha con puntos extra
* Pregunta especial: "¿Cuál dura más?"
* Pantalla de error amigable
  
