<?php
// Iniciar sesión y preparar datos antes de enviar cualquier salida
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
// incluir conexión
include __DIR__ . '/lib/connection.php';

$total = 0;
if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
  $id = mysqli_real_escape_string($conn, $_SESSION['userid']);
  $sql = "SELECT * FROM cart WHERE userid='$id'";
  $result = $conn->query($sql);
  if ($result) {
    $total = mysqli_num_rows($result);
  }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fashion</title>
    <meta charset="UTF-8">
    <meta name="description" content="test">
    <meta name="keywords" content="HTML, CSS, BOOTSTRAP">
    <meta name="author" content="Anik">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&display=swap" rel="stylesheet">
    <!--font-family: 'Raleway', sans-serif;-->
    <link rel="favicon" type="text/css" href="#favicon">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <style>
      header, .header-top, .navbar, .navbar-light, .navbar-nav .nav-link, .line {
        transition: background 0.3s, color 0.3s;
      }
      /* Títulos en modo claro */
      header .header-top .col-md-12.text-center h1,
      header .header-top .col-md-12.text-center h2,
      header .header-top .col-md-12.text-center h3,
      header .header-top .col-md-12.text-center h4,
      header .header-top .col-md-12.text-center h5,
      header .header-top .col-md-12.text-center h6,
      .navbar-nav .nav-link,
      .line {
        color: #222 !important;
      }
      body.dark-mode header,
      body.dark-mode .header-top,
      body.dark-mode .navbar,
      body.dark-mode .navbar-light,
      body.dark-mode .line {
        background: #232323 !important;
        color: #fff !important;
      }
      body.dark-mode .navbar-nav .nav-link {
        color: #fff !important;
      }
      body.dark-mode .navbar-nav .nav-link.active, 
      body.dark-mode .navbar-nav .nav-link:focus, 
      body.dark-mode .navbar-nav .nav-link:hover {
        color: #e91e63 !important;
      }
      body.dark-mode .form-control {
        background: #181818 !important;
        color: #fff !important;
        border-color: #e91e63;
      }
      body.dark-mode .form-control:focus {
        background: #232323 !important;
        color: #fff !important;
        border-color: #e91e63;
        box-shadow: 0 0 0 2px #e91e6333;
      }
      body.dark-mode .btn-outline-dark {
        background: #e91e63 !important;
        color: #fff !important;
        border-color: #e91e63 !important;
      }
      body.dark-mode .btn-outline-dark:hover {
        background: #fff !important;
        color: #e91e63 !important;
        border-color: #e91e63 !important;
      }
    </style>
</head>

<body>

<!--header start--->
  <header>
    <div class="container">
    <div class="header-top">
      
        <div class="row">
          <div class="col-md-12 text-center">
            <a href=""><img src="img/logo.jpg" alt="AppLink Logo" style="max-height:90px; width:auto;"></a>
          </div>
        </div>
    
    </div>
    </div>
  </header>
  <div class="line">

    
  </div>
<!--header end--->
<!--nav start--->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Clothing.php"> Ropa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Trends.php">Tendencias</a>
        </li>
      </ul>
      <form class="form-inline"  action="search(1).php" method="post">
        <!--<a href=""><img src="img/search.png"></a>-->
        <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="name">
        <button class="btn btn-outline-dark" type="submit" style="margin-left:7px;margin-right:7px;"><img src="img/search.png"></button>
        </form>
        <!-- contador del carrito calculado al inicio del archivo -->
        <a href="cart(1).php"><img src="img/cart.png"><?php echo $total?></a>
        <?php 

if(isset($_SESSION['auth']))
{
   if($_SESSION['auth']==1)
   {
    echo $_SESSION['username']; ?>
    <a href="profile.php">Mi Carrito!</a>
    <a href="logout.php">Cerrar sesion</a>
<?php
   }
}
else
{
?>
  <a href="login.php">Iniciar Sesión</a>
  <a href="Register.php">Registrarse</a>
<?php
}
?>
        

    </div>
  </div>
</nav>

<!--nav end--->