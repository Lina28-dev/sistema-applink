<head>
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
      body {
        font-family: 'Poppins', Arial, sans-serif;
        background: #fff;
        color: #222;
        transition: background 0.3s, color 0.3s;
      }
      .main-content, .container, .welcome, .banner, .logo5, section {
        font-family: 'Poppins', Arial, sans-serif;
      }
      .btn, .btn-lg, .btn-primary {
        font-family: 'Poppins', Arial, sans-serif;
        font-weight: 600;
        border-radius: 8px;
      }
      .btn-fucsia, .btn.btn-fucsia {
        background: #e91e63;
        color: #fff;
        border: none;
      }
      .btn-fucsia:hover {
        background: #c2185b;
        color: #fff;
      }
      .welcometitle, h1, h2, h4, h5, h6 {
        font-family: 'Poppins', Arial, sans-serif;
        font-weight: 700;
      }
      /* Modo oscuro automático */
      @media (prefers-color-scheme: dark) {
        body {
          background: #181818;
          color: #fff;
        }
        .main-content, .container, .welcome, .banner, .logo5, section {
          background: #181818;
          color: #fff;
        }
        .btn, .btn-lg, .btn-primary {
          color: #fff;
        }
        .btn-fucsia, .btn.btn-fucsia {
          background: #e91e63;
          color: #fff;
        }
        .btn-fucsia:hover {
          background: #ad1457;
        }
      }
      /* Contraste para tarjetas y bloques */
      .card, .feature-block, .feature-card {
        background: #fff;
        color: #222;
        border-radius: 16px;
        box-shadow: 0 2px 8px #e91e6322;
        margin-bottom: 24px;
      }
      @media (prefers-color-scheme: dark) {
        .card, .feature-block, .feature-card {
          background: #232323;
          color: #fff;
        }
      }
    </style>
  </head>

<?php
// AppLink - Sistema de Gestión de Ventas
// Administra tu inventario, ventas y clientes de manera eficiente con nuestra plataforma integral.
// Optimiza tu negocio, controla tus pedidos y haz crecer tus ventas con AppLink.

// --- Lógica de carrito y sesión ---
include 'lib/connection.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (isset($_POST['add_to_cart'])) {
  if (isset($_SESSION['auth'])) {
    if ($_SESSION['auth'] != 1) {
      header("location:login.php");
      exit;
    }
  } else {
    header("location:login.php");
    exit;
  }
  $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_id = $_POST['product_id'];
  $product_quantity = 1;
  $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE productid = '$product_id'  && userid='$user_id'");
  if (mysqli_num_rows($select_cart) > 0) {
    echo $message[] = 'product already added to cart';
  } else {
    $insert_product = mysqli_query($conn, "INSERT INTO `cart`(userid, productid, name, quantity, price) VALUES('$user_id', '$product_id', '$product_name', '$product_quantity', '$product_price')");
    echo $message[] = 'product added to cart succesfully';
    header('location:index.php');
    exit;
  }
}

// --- Header y consulta de productos ---
include 'header.php';
$sql = "SELECT * FROM product";
$result = $conn -> query ($sql);
?>

<!--banner start-->
<div class="banner">
<div class="container">
  <div class="row">
    <div class="col-md-6">
    
        <div class="banner-text">
          <p class="bt1">Sistema de Gestión de Ventas</p>
          <p class="bt2"><span class="bt3">App</span>Link</p>
          <p class="bt4">Administra tu inventario, ventas y clientes de manera eficiente con nuestra plataforma integral.<br>
        Optimiza tu negocio, controla tus pedidos y haz crecer tus ventas con AppLink.</p>
        <div class="row">  
        </div>
        <div class="col-md-4 d-flex align-items-center justify-content-center">
        <a href="#" class="btn btn-lg" style="background:#e91e63;color:#fff;font-weight:600;">Comenzar Ahora</a>
      </div>
    </div>
  </div>
</section>
    
  <div class="col-md-6">
    
      <img src="" class="img-fluid">
 
  </div>

  </div>
</div>
</div>

<!--banner end-->


<!---top sell start---->

<section>
  <div class="container">
    <div class="topsell-head">
      <div class="row">
        <div class="col-md-12 text-center">
          <img src="img/mark.png">
          <h4>Conoce tu proximo outfit!</h4>
          <p>Un pasaje a un mundo de moda y estilo.</p>

        </div>
        
        
      </div>

    </div>
  </div>
  <div class="container">
  <div class="row">
  <?php
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              ?>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="col-md-3 col-sm-6 col-6">
              <div>
                <img src="img/<?php echo $row['imgname']; ?>" class="product-img img-fluid" >
              </div>
              <div>
              <div>
                <h6><?php echo $row["name"] ?></h6> 
                <span><?php echo $row["Price"] ?></span> 
                <input type="hidden" name="user_id" value="<?php echo isset($_SESSION['userid']) ? htmlspecialchars($_SESSION['userid']) : ''; ?>" >
                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>"> 
                <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['Price']; ?>">              
              </div>
              <input type="submit" class="btn btn btn-primary" value="add to cart" name="add_to_cart">
              </div>
              
            </div>
            </form>
            <?php 
    }
        } 
        else 
            echo "0 results";
        ?>

            
          </div>
  </div>
</section>


<!---top sell end---->


<!---logo start--->

<div class="logo5">
  <div class="container d-flex justify-content-center align-items-center" style="min-height:80px;">
    <img src="img/logo.jpg" alt="AppLink Logo" class="main-logo">
  </div>
</div>
  <style>
    .main-logo {
      max-width: 160px;
      width: 100%;
      height: auto;
      display: block;
      margin: 0 auto;
      filter: drop-shadow(0 2px 12px #e91e6340);
      transition: filter 0.3s;
    }
    .main-logo:hover {
      filter: drop-shadow(0 4px 24px #e91e6380);
    }
    .logo5 {
      padding: 24px 0 8px 0;
      background: transparent;
    }
  </style>



<!---logo end--->

<!---welcome start--->

<div class="welcome">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-6 col-sm-12">

        <span class="welcometitle">Bienvenido a AppLink</span>
        <img src="img/titleful.png">
        <img src="img/titleline.png" class="titleline">

        <div class="row" id="wel1">
          <div class="col-md-2 col-lg-2 col-2">
            <img src="img/w1.png" class="w" class="img-fluid">
          </div>
          <div class="col-md-10  col-lg-10 col-10">
            <h6 class="wh">Gestión Integral de tu Negocio</h6>
            <p class="wp">Administra productos, ventas y clientes desde una sola plataforma. Optimiza tu inventario, controla tus pedidos y haz crecer tu negocio con AppLink.</p>
          </div>   
        </div>

        <div class="row" id="wel2">
          <div class="col-md-2 col-lg-2 col-2">
            <img src="img/w1.png" class="w" class="img-fluid">
          </div>
          <div class="col-md-10 col-lg-10 col-10">
            <h6 class="wh">Soporte y Seguridad</h6>
            <p class="wp">Soporte rápido, acceso seguro y respaldo de tus datos. Nos encargamos de la tecnología para que tú te enfoques en vender más.</p>
          </div>   
        </div>

        <div class="row" id="wel3">
          <div class="col-md-2 col-lg-2 col-2">
            <img src="img/w1.png" class="w" class="img-fluid">
          </div>
          <div class="col-md-10 col-lg-10 col-10">
            <h6 class="wh">Crecimiento y Simplicidad</h6>
            <p class="wp">Panel intuitivo, reportes claros y herramientas para impulsar tu emprendimiento. ¡Con AppLink, vender es más fácil!</p>
          </div>   
        </div>

      </div>
      <div class="col-md-12 col-lg-6 col-sm-12">
        <img src="img/banner-pic.png" class="img-fluid">
      </div>
    </div>
  </div>
</div>



<!---welcome end--->



<?php
 include'footer.php';
?>

