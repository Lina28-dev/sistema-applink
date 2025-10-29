<?php
include'lib/connection.php';
$sql = "SELECT * FROM orders where status='pending'";
$result = $conn -> query ($sql);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--css link-->
	<link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
      crossorigin="anonymous"
    />
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/media.css">
</head>
<body>
	<div style="width:260px;height:100px;position:fixed;top:0;left:0;background:white;z-index:200;display:flex;align-items:center;justify-content:center;">
		<img src="img/logo.jpg" alt="Applink Logo" class="fixed-logo" style="height:60px; width:auto;">
	</div>
	<section class="header" id="header">
		<i class="fas fa-bars fixed" onclick="openside()"></i>
		<div class="line-fixed">Panel de Control</div>
	</section>

	<div class="sidenav" id="sidenav" style="position:fixed;">
		<ul class="navbar-nav" style="padding-bottom:60px;">
		   <li class="nav-item">
				<a class="nav-link d" href="Home.php">Dashboard</a>
			</li>
			<li class="nav-item">
				<a class="nav-link po" href="pending_orders.php">Estado de la Orden</a>
			</li>
			<li class="nav-item">
				<a class="nav-link ap" href="add_product.php">Agregar Producto</a>
			</li>
			<li class="nav-item">
				<a class="nav-link vp" href="all_product.php">Todos los Productos</a>
			</li>
    
			<li class="nav-item">
				<a class="nav-link ao" href="all_orders.php">Órdenes Entregadas</a>
			</li>
			<li class="nav-item">
				<a class="nav-link u" href="users.php">Usuarios</a>
			</li>
			<li class="nav-item">
				<a class="nav-link u" href="report.php">Reporte</a>
			</li>
		</ul>
		<a href="logout.php" class="logout-btn">Cerrar Sesión</a>
	</div>
	<?php

?>
<!--js link-->
<script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
      integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
      integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK"
      crossorigin="anonymous"
    ></script>
<script src="js/script.js"></script>
<script src="https://kit.fontawesome.com/3b83a3096d.js" crossorigin="anonymous"></script>

</body>
</html>