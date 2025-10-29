
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
$sql = "SELECT * FROM orders WHERE status='Pending'";
$result = $conn -> query ($sql);

if(isset($_POST['update_update_btn'])){
  $update_value = $_POST['update_status'];
  $update_id = $_POST['update_id'];
  $update_quantity_query = mysqli_query($conn, "UPDATE `orders` SET status = '$update_value' WHERE id = '$update_id'");
  if($update_quantity_query){
     header('location:pending_orders.php');
  };
};
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
      <h5>Estado de la orden</h5>
    <table class="table">
      <thead>
        <tr>

          <th scope="col">Nombre</th>
          <th scope="col">Dirección</th>
          <th scope="col">Teléfono</th>
          <th scope="col">Número de Orden</th>
          <th scope="col">Unidades</th>
          <th scope="col">Total de Productos</th>
          <th scope="col">Precio Total</th>
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
          <td><form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="update_id"  value="<?php echo  $row['id']; ?>" >
            <div>
                                    <select name="update_status" class="form-control">
                                    <option><?php echo $row['status']; ?></option>
                                        <option value="Pending">Pendiente</option>
                                        <option value="Confirmed">Confirmado</option>
                                      <option value="Cancel">Cancelar</option>
                                      <option value="Delivered">Entregado</option>
                                    </select>
                                </div>
            <input type="submit" value="Actualizar" name="update_update_btn">
          </form></td>
          <td><a href="pending_orders.php?remove=<?php echo $row['id']; ?>">Eliminar</a></td>
        </tr>
        <?php 
        }
            } 
            else 
                echo "0 results";
            ?>
        
      </tbody>
    </table>
    </div>
    
    </body>
    </html>