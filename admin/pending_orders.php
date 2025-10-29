<?php
SESSION_START();
// Incluye el encabezado (ej. navegación, estilos)
include 'header.php';

// --- Bloque de Autenticación (Permanece igual) ---
if (isset($_SESSION['auth'])) {
    if ($_SESSION['auth'] != 1) {
        header("location:login.php");
        exit;
    }
} else {
    header("location:login.php");
    exit;
}

// Incluye la conexión a la base de datos
include 'lib/connection.php';

// Consulta para obtener las órdenes pendientes (usando campos reales)
$sql = "SELECT id, userid, name, address, phone, mobnumber, txid, totalproduct, totalprice, status, created_at FROM orders WHERE status='Pending'";
$result = $conn->query($sql);


// --- Bloque 1: Actualización Rápida de Estado (Refactorizado con Prepared Statements) ---
if (isset($_POST['update_update_btn'])) {
    $update_value = $_POST['update_status'];
    $update_id = intval($_POST['update_id']); // Asegurar que es un entero

    // 1. Consulta con marcadores de posición (?)
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");

    // 2. Vincular parámetros: 's' para string (status), 'i' para integer (id)
    $stmt->bind_param("si", $update_value, $update_id);

    // 3. Ejecutar y verificar
    if ($stmt->execute()) {
        $stmt->close();
        header('Location: pending_orders.php');
        exit; // Terminar el script después de la redirección
    } else {
        // Manejo de error (opcional)
        // echo '<div class="alert alert-danger">Error al actualizar estado: ' . $stmt->error . '</div>';
        $stmt->close();
    }
}


// --- Bloque 2: Procesar Guardado de Edición (Refactorizado con Prepared Statements) ---
if (isset($_POST['save_edit'])) {
    // 1. Obtención y saneamiento básico de variables
    $id = intval($_POST['edit_id']);
    $name = trim($_POST['edit_name']);
    $address = trim($_POST['edit_address']);
    $phone = intval($_POST['edit_phone']);
    $mobnumber = intval($_POST['edit_mobnumber']);
    $txid = trim($_POST['edit_txid']);
    $totalproduct = trim($_POST['edit_totalproduct']);
    $totalprice = intval($_POST['edit_totalprice']);
    $status = trim($_POST['edit_status']);

    // 2. Definir la consulta con marcadores de posición (?)
    $sql_update = "UPDATE orders SET 
        name = ?, 
        address = ?, 
        phone = ?, 
        mobnumber = ?, 
        txid = ?, 
        totalproduct = ?, 
        totalprice = ?, 
        status = ? 
        WHERE id = ?";

    // 3. Preparar la sentencia
    if ($stmt = $conn->prepare($sql_update)) {
        $stmt->bind_param(
            "ssiiisssi",
            $name,
            $address,
            $phone,
            $mobnumber,
            $txid,
            $totalproduct,
            $totalprice,
            $status,
            $id
        );
        if ($stmt->execute()) {
            $stmt->close();
            echo '<div class="alert alert-success">Orden actualizada correctamente.</div>';
            header('Location: pending_orders.php');
            exit;
        } else {
            $stmt->close();
            echo '<div class="alert alert-danger">Error al actualizar la orden: ' . $conn->error . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Error en la preparación de la consulta: ' . $conn->error . '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Órdenes Pendientes</title>
<link rel="stylesheet" href="css/pending_orders.css">

</head>
<body>

<div class="main-content container pendingbody">
<h5>Estado de la orden</h5>
<table class="table">
<thead>
<tr>
<th scope="col">Nombre</th>
<th scope="col">Dirección</th>
<th scope="col">Teléfono</th>
<th scope="col">Móvil</th>
<th scope="col">Transacción</th>
<th scope="col">Total Productos</th>
<th scope="col">Precio Total</th>
<th scope="col">Estado</th>
<th scope="col">Acción</th>
</tr>
</thead>
<tbody>
<?php
$edit_id = isset($_GET['edit_id']) ? intval($_GET['edit_id']) : null;
 
if (is_object($result) && mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    if ($edit_id === intval($row['id'])) {
?>
<tr style="background:#f5f5f5;">
<form action="" method="post">
<input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
<td><input type="text" name="edit_name" value="<?php echo htmlspecialchars($row['name']); ?>" class="form-control" required></td>
<td><input type="text" name="edit_address" value="<?php echo htmlspecialchars($row['address']); ?>" class="form-control" required></td>
<td><input type="number" name="edit_phone" value="<?php echo htmlspecialchars($row['phone']); ?>" class="form-control" required></td>
<td><input type="number" name="edit_mobnumber" value="<?php echo htmlspecialchars($row['mobnumber']); ?>" class="form-control" required></td>
<td><input type="text" name="edit_txid" value="<?php echo htmlspecialchars($row['txid']); ?>" class="form-control" required></td>
<td><input type="text" name="edit_totalproduct" value="<?php echo htmlspecialchars($row['totalproduct']); ?>" class="form-control" required></td>
<td><input type="number" name="edit_totalprice" value="<?php echo htmlspecialchars($row['totalprice']); ?>" class="form-control" required></td>
<td>
<select name="edit_status" class="form-control">
<option value="Pending" <?php if($row['status']=='Pending') echo 'selected'; ?>>Pendiente</option>
<option value="Confirmed" <?php if($row['status']=='Confirmed') echo 'selected'; ?>>Confirmado</option>
<option value="Cancel" <?php if($row['status']=='Cancel') echo 'selected'; ?>>Cancelado</option>
<option value="Delivered" <?php if($row['status']=='Delivered') echo 'selected'; ?>>Entregado</option>
</select>
</td>
<td>
 <button type="submit" name="save_edit" class="btn btn-success btn-sm">Guardar</button>
<a href="pending_orders.php" class="btn btn-secondary btn-sm">Cancelar</a>
</td>
</form>
</tr>
<?php
} else {
?>
<tr>
<td><?php echo htmlspecialchars($row["name"]) ?></td>
<td><?php echo htmlspecialchars($row["address"]) ?></td>
<td><?php echo htmlspecialchars($row["phone"]) ?></td>
<td><?php echo htmlspecialchars($row["mobnumber"]) ?></td>
<td><?php echo htmlspecialchars($row["txid"]) ?></td>
<td><?php echo htmlspecialchars($row["totalproduct"]) ?></td>
<td><?php echo htmlspecialchars($row["totalprice"]) ?></td>
<td>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="display:flex; gap:5px;">
<input type="hidden" name="update_id" value="<?php echo $row['id']; ?>" >
<div>
<select name="update_status" class="form-control" style="min-width: 100px;">
<option value="<?php echo htmlspecialchars($row['status']); ?>"><?php echo htmlspecialchars($row['status']); ?></option>
<option value="Pending">Pendiente</option>
<option value="Confirmed">Confirmado</option>
<option value="Cancel">Cancelar</option>
<option value="Delivered">Entregado</option>
</select>
</div>
<input type="submit" value="Actualizar" name="update_update_btn" class="btn btn-sm btn-primary">
</form>
</td>
<td>
<a href="?edit_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info">Editar</a>
<a href="pending_orders.php?remove=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Eliminar</a>
</td>
</tr>


<?php
    }
  }
} else {
  echo "<tr><td colspan='10'>No hay resultados pendientes</td></tr>";
}
?>

</tbody>
</table>
</div>
</body>
</html>