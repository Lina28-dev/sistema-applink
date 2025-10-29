<?php
 SESSION_START();
 include'header.php';

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
include'lib/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/home.css">

</head>
<body>
    
    <div class="main-content container homebody">
        <div class="row">
            <div class="col-md-12">
                <h1>Bienvenida al Panel de Administración Lina!</h1>
                <p style="font-size:1.2em;color:#555;font-style:italic;">"El éxito es la suma de pequeños esfuerzos repetidos día tras día."</p>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Órdenes Totales</div>
                    <div class="card-body">
                        <h3 class="card-title">
                            <?php
                            $total_orders = $conn->query("SELECT COUNT(*) as total FROM orders")->fetch_assoc()['total'];
                            echo $total_orders;
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Órdenes Pendientes</div>
                    <div class="card-body">
                        <h3 class="card-title">
                            <?php
                            $pending_orders = $conn->query("SELECT COUNT(*) as total FROM orders WHERE status='Pending'")->fetch_assoc()['total'];
                            echo $pending_orders;
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Órdenes Entregadas</div>
                    <div class="card-body">
                        <h3 class="card-title">
                            <?php
                            $delivered_orders = $conn->query("SELECT COUNT(*) as total FROM orders WHERE status='Delivered'")->fetch_assoc()['total'];
                            echo $delivered_orders;
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Órdenes Canceladas</div>
                    <div class="card-body">
                        <h3 class="card-title">
                            <?php
                            $cancel_orders = $conn->query("SELECT COUNT(*) as total FROM orders WHERE status='Cancel'")->fetch_assoc()['total'];
                            echo $cancel_orders;
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card border-info mb-3">
                    <div class="card-header">Total de Productos</div>
                    <div class="card-body text-info">
                        <h3 class="card-title">
                            <?php
                            $total_products = $conn->query("SELECT COUNT(*) as total FROM product")->fetch_assoc()['total'];
                            echo $total_products;
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card border-secondary mb-3">
                    <div class="card-header">Usuarios Registrados</div>
                    <div class="card-body text-secondary">
                        <h3 class="card-title">
                            <?php
                            $total_users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
                            echo $total_users;
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card border-warning mb-3">
                    <div class="card-header">Productos con Bajo Stock (&lt;=5)</div>
                    <div class="card-body text-warning">
                        <h3 class="card-title">
                            <?php
                            $low_stock = $conn->query("SELECT COUNT(*) as total FROM product WHERE quantity<=5")->fetch_assoc()['total'];
                            echo $low_stock;
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>