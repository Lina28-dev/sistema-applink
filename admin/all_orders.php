
<?php
SESSION_START();
include'header.php';

if(isset($_SESSION['auth']))
{
   if($_SESSION['auth']!=1)
   {
       header("location:login.php");
       exit;
   }
}
else
{
   header("location:login.php");
   exit;
}
include'lib/connection.php';
$sql = "SELECT * FROM orders WHERE status='Delivered'";
$result = $conn -> query ($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/pending_orders.css">
</head>
<body>

<div class="container pendingbody">
  <h5>Ordenes Entregadas</h5>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Dirección</th>
      <th scope="col">Teléfono</th>
      <th scope="col">Numero de Orden</th>
      <th scope="col">Unidades</th>
      <th scope="col">Total Productos</th>
      <th scope="col">Total Precio</th>
      <th scope="col">Estado</th>
    </tr>
  </thead>
  <tbody>
  <?php
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              ?>
    <tr>
      <td><?php echo $row["nombre"] ?></td>
      <td><?php echo $row["direccion"] ?></td>
      <td><?php echo $row["telefono"] ?></td>
      <td><?php echo $row["numero_de_orden"] ?></td>
      <td><?php echo $row["unidades"] ?></td>
      <td><?php echo $row["total_productos"] ?></td>
      <td><?php echo $row["total_precio"] ?></td>
      <td><?php echo $row["estado"] ?></td>
    </tr>
    <?php 
    }
        } 
        else 
            echo "0 resultados";
        ?>
  </tbody>
</table>
</div>
    
</body>
</html>