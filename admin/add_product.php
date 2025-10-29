<?php
SESSION_START();

if(isset($_SESSION['auth']))
{
   if($_SESSION['auth']!=1)
   {
       header("location:login.php");
   }
}
else
{
   header("location:login.php");
}
 include'header.php';
 include'lib/connection.php';
 $result=null;
if (isset($_POST['submit'])) 
{
  $name = trim($_POST['name']);
  $catagory = trim($_POST['catagory']);
  $description = trim($_POST['description']);
  $quantity = intval($_POST['quantity']);
  // Limpiar el precio para dejar solo números
  $price = $_POST['price'];
  $price = preg_replace('/[^0-9]/', '', $price);
  if ($price === '' || $price == 0) {
    $result = '<div style="color:red;">Alerta: El precio es obligatorio.</div>';
  } else {
    $filename = $_FILES["uploadfile"]["name"];
    if ($filename === '') {
      $result = '<div style="color:red;">Error: Debes seleccionar una imagen.</div>';
    } else {
      $insertSql = "INSERT INTO product(name, catagory, description, quantity, price, imgname) VALUES ('$name', '$catagory', '$description', $quantity, $price, '$filename')";
      if ($conn->query($insertSql)) {
        $result = "<h2>*******Data insert success*******</h2>";
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "../img/" . $filename;
        move_uploaded_file($tempname, $folder);
      } else {
        $result = '<div style="color:red;">Error SQL: ' . $conn->error . '</div>';
      }
    }
  }

} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <div class="main-content container">
      <?php echo $result;?>
        <h4>Agregar Producto</h4>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="exampleInputName" class="form-label">Nombre del Producto</label>
    <input type="text" name="name" class="form-control" id="exampleInputName">
  </div>
  <div class="mb-3">
    <label for="exampleInputType" class="form-label">Categoría</label>
    <input type="text" name="catagory"  class="form-control" id="exampleInputType">
  </div>
  <div class="mb-3">
    <label for="exampleInputDescription" class="form-label">Descripción</label>
    <input type="text" name="description" class="form-control" id="exampleInputDescription">
  </div>
  <div class="mb-3">
    <label for="exampleInputQuantity" class="form-label">Unidades</label>
    <input type="number" name="quantity" class="form-control" id="exampleInputQuantity">
  </div>
  <div class="mb-3">
    <label for="exampleInputPrice" class="form-label">Precio</label>
    <input type="Number" name="price" class="form-control" id="exampleInputPrice">
  </div>
  <div class="mb-3">
        <label for="uploadfile" class="form-label">Imagen</label>
        <input type="file" name="uploadfile" />
    </div>
  <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
</form>
    </div>
</body>
</html>