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
if (isset($_POST['submit'])) 
{
  $starttime=$_POST['starttime'];
  $endtime=$_POST['endtime'];
  $sql = "SELECT * FROM orders where created_at>='$starttime' && created_at<'$endtime'";
  $result = $conn -> query ($sql);
} else {
  // Mostrar todos los pedidos entregados por defecto
  $sql = "SELECT * FROM orders WHERE status='Delivered'";
  $result = $conn -> query ($sql);
}
?>
<div class="container">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <label for="starttime">Fecha de inicio (fecha y hora):</label>
  <input type="datetime-local" id="starttime" name="starttime">

  <label for="endtime">Fecha de fin (fecha y hora):</label>
  <input type="datetime-local" id="endtime" name="endtime">
  <input type="submit" name="submit">
</form>
<div class="container pendingbody">
  <h5>Todos los Pedidos</h5>
<table class="table">
  <thead>
    <tr>

      <th scope="col">Nombre</th>
      <th scope="col">Dirección</th>
      <th scope="col">Teléfono</th>
      <th scope="col">Número de Envío</th>
      <th scope="col">Unidades</th>
      <th scope="col">Total de Productos</th>
      <th scope="col">Precio Total</th>
      <th scope="col">Estado</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $t=0;
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                if($row["status"]=="Delivered")
                {
                    $t=$t+$row["totalprice"];

              ?>
    <tr>

      <td><?php echo $row["name"] ?></td>
      <td><?php echo $row["address"] ?></td>
      <td><?php echo $row["phone"] ?></td>
      <td><?php echo $row["mobnumber"] ?></td>
      <td><?php echo $row["txid"] ?></td>
      <td><?php echo $row["totalproduct"] ?></td>
      <td><?php echo $row["totalprice"] ?></td>
      <td><?php echo $row["status"] ?></td>
    </tr>
    <?php 
                        
         }
    }

        } 
        else 
            echo "0 resultados";
        ?>
  </tbody>
</table>
<?php echo "Total= " . $t ." Ordenes";?>

</div>
