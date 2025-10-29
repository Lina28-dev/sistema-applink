<?php
// reset_password.php
// Simple placeholder for password reset (to be replaced with real logic)
$message = '';
if (isset($_POST['email'])) {
    $email = trim($_POST['email']);
    // Aquí deberías agregar lógica real de recuperación (enviar correo, token, etc.)
    $message = 'Si el correo existe, recibirás instrucciones para restablecer tu contraseña.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #fff 0%, #e91e63 100%);
            font-family: 'Poppins', Arial, sans-serif;
        }
        .reset-card {
            max-width: 370px;
            margin: 60px auto;
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(233,30,99,0.18);
            background: #fff;
        }
        .reset-card .card-header {
            background: #e91e63;
            color: #fff;
            border-radius: 18px 18px 0 0;
            text-align: center;
            border-bottom: none;
        }
        .reset-card .card-header h3 {
            font-weight: 700;
            letter-spacing: 1px;
        }
        .reset-card .card-body {
            padding: 2rem 2rem 1.5rem 2rem;
        }
        .reset-card .form-control {
            border-radius: 8px;
            border: 1px solid #e91e63;
            font-size: 1rem;
        }
        .reset-card .form-control:focus {
            border-color: #111;
            box-shadow: 0 0 0 2px #e91e6333;
        }
        .reset-card .btn-primary {
            background: #e91e63;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            letter-spacing: 1px;
            transition: background 0.2s;
        }
        .reset-card .btn-primary:hover {
            background: #111;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="reset-card card">
        <div class="card-header">
            <h3>Restablecer Contraseña</h3>
        </div>
        <div class="card-body">
            <?php if($message) echo '<div class="alert alert-info text-center">'.$message.'</div>'; ?>
            <form method="post" action="">
                <div class="input-group form-group mb-3">
                    <input type="email" class="form-control" placeholder="Correo electrónico" name="email" required>
                </div>
                <div class="form-group d-grid">
                    <button type="submit" class="btn btn-primary">Enviar instrucciones</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="admin/login.php" style="color:#e91e63; text-decoration:none;">Volver al inicio de sesión</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
