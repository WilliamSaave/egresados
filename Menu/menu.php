
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>/* menu.css */
@import "compass/css3";

*, *:after, *:before {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

body {
  background: #ffffff; /* Fondo blanco */
}

.gn-menu-main {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 60px;
  font-size: 13px;
  background-color: #28c530;
  z-index: 1000;
}
.gn-menu-main a {
  display: block;
  height: 100%;
  color: #fff;
  text-decoration: none;
  cursor: pointer;
}
.gn-menu-main a:hover {
  background-color: #1e9b27;
  color: #fff;
}
.gn-menu-main > li {
  display: block;
  float: left;
  height: 100%;
  border-right: 1px solid #1e9b27;
  text-align: center;
}
.gn-menu-main > li > a {
  padding: 0 30px;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: bold;
}
.gn-menu-main > li:after {
  display: table;
  clear: both;
  content: '';
}
.gn-menu-main li.gn-trigger {
  position: relative;
  width: 60px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.gn-menu-main li:last-child {
  float: right;
  border-right: none;
  border-left: 1px solid #1e9b27;
}

.gn-menu-main, .gn-menu-main ul {
  margin: 0;
  padding: 0;
  background-color: #28c530;
  color: #fff;
  list-style: none;
  text-transform: none;
  font-weight: 300;
  font-family: Arial, sans-serif;
  line-height: 60px;
}

.container > header {
  color: #000; /* Color negro para el texto del header */
  font-family: 'Lato', Arial, sans-serif;
}

.container > header {
  margin: 0 auto;
  padding: 12em 2em;
  padding-left: 370px;
  background: rgba(0, 0, 0, 0.05);
}

.container > header a {
  color: #566473;
  text-decoration: none;
  outline: none;
}

.container > header a:hover {
  color: #4f7bab;
}

.container > header h1 {
  font-size: 3.2em;
  line-height: 1.3;
  margin: 0;
  font-weight: 300;
}

.container > header span {
  display: block;
  font-size: 55%;
  color: #74818e;
  padding: 0 0 0.6em 0.1em;
}
.logo-img {
  height: 60px;  /* Ajusta la altura según sea necesario */
  width: 50px;   /* Ajusta el ancho según sea necesario */
  object-fit: contain;  /* Asegura que la imagen se ajuste sin recortarse */
}
</style>

</head>
<body>
  <div class="container">
    <ul id="gn-menu" class="gn-menu-main">
      
    <li><a class="codrops-icon codrops-icon-drop" href="../Inicio/Index.php"><img src="../Login/Imagenes/LOGO.png" class="logo-img" alt="Logo"></a></li>

      <li><a class="codrops-icon codrops-icon-drop" href="../Egresados/views/egresados/index.php"><span>Egresados</span></a></li>
      <li><a class="codrops-icon codrops-icon-drop" href="../Informes/index.php"><span>Informes</span></a></li>
      <li><a class="codrops-icon codrops-icon-drop" href="../Estadisticas/index.php"><span>Estadísticas</span></a></li>
      <li><a class="codrops-icon codrops-icon-drop" href="../Historial/index.php"><span>Historial</span></a></li>
      <li><a class="codrops-icon codrops-icon-drop" href="../Usuarios/index.php"><span>Usuarios</span></a></li>
      <li><a class="codrops-icon codrops-icon-drop" href="../Login/index.php"><span>Salir</span></a></li>
    </ul>

  </div>
</body>
</html>


