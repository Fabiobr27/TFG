# Padelemotion
![Modelo E/R](https://github.com/AlejandroMoralesConejo/padelemotionv2/blob/master/modeloer.PNG)
Padelemotion es una web de pádel, a nivel amateur, para apuntarse a partidos. Es una versión 2 del proyecto del trimestre anterior con funcionalidades nuevas como una barra de búsqueda, mejora de la interfaz, corrección de errores de registro y alta en los partidos, aviso de que estamos apuntados, posibilidad de ver los contrincantes de un partido, etc. A su vez, esta versión incluye roles (usuario normal y admin). El admin podrá hacer tareas de gestión de los partidos (CRUD).

## Antes de comenzar 🔧
*Si vamos a trabajar en **local**:*
* Debemos importar nuestra base de datos [padel.sql](https://github.com/AlejandroMoralesConejo/padelemotionv2/blob/master/padel.sql)
* Instalar twig en nuestro proyecto.

## Manual de uso 📖
* Primero debemos hacer login o registrarnos.<br/>
Usuario **normal**: fff@gmail.com | contraseña: 123<br/>
Usuario **admin**: admin@admin.com | contraseña: 123

### Ambos usuarios
* Barra de búsqueda de partidos por fecha, hora, nombre, lugar, etc.
* Nav con tres elementos: padelemotion (vuelve al index), editar perfil y salir.

### Usuario normal
* Listado de todos los partidos.
* Posibilidad de apuntarse y que te avise si lo estás, además de informar las plazas que quedan para cerrar el partido.
* "Ver contrincantes" redirige al partido con más datos sobre este como los jugadores que ya están apuntados y sus posiciones preferidas.

### Usuario admin
* Tabla con información de los partidos.
* Botón de Añadir partido.
* En cada partido, opción de editar y borrar.

## Vídeo sobre el proyecto
[![Padelemotion](https://img.youtube.com/vi/jjoQpxVHqgY/0.jpg)](https://www.youtube.com/watch?v=jjoQpxVHqgY)
