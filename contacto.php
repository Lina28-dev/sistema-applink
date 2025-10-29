<?php
// contacto.php - Formulario de contacto para AppLink
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = htmlspecialchars(trim($_POST['nombre'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $mensaje = htmlspecialchars(trim($_POST['mensaje'] ?? ''));
    $enviado = false;
    $error = '';

    if ($nombre && $email && $mensaje) {
        // Aquí podrías enviar el correo o guardar en la base de datos
        // mail('soporte@applink.com', 'Nuevo mensaje de contacto', $mensaje);
        $enviado = true;
    } else {
        $error = 'Por favor, completa todos los campos.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto | AppLink</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', Arial, sans-serif; }
        .contact-container { max-width: 500px; margin: 40px auto; background: #fff; border-radius: 12px; box-shadow: 0 2px 12px #e91e6322; padding: 32px; }
        .contact-container h2 { color: #e91e63; font-weight: 700; margin-bottom: 24px; }
        .form-group { margin-bottom: 18px; }
        .form-group label { font-weight: 600; }
        .form-control { width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; font-size: 1rem; }
        .btn-fucsia { background: #e91e63; color: #fff; border: none; padding: 10px 28px; border-radius: 6px; font-weight: 600; transition: background 0.2s; }
        .btn-fucsia:hover { background: #c2185b; }
        .msg-success { color: #388e3c; font-weight: 600; margin-bottom: 16px; }
        .msg-error { color: #e91e63; font-weight: 600; margin-bottom: 16px; }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<div class="contact-container">
    <h2>Contacto</h2>
    <?php if (!empty($enviado)): ?>
        <div class="msg-success">¡Gracias por contactarnos! Te responderemos pronto.</div>
    <?php elseif (!empty($error)): ?>
        <div class="msg-error"><?= $error ?></div>
    <?php endif; ?>
    <form method="post" action="">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" class="form-control" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="mensaje" class="form-control" rows="5" required><?= htmlspecialchars($_POST['mensaje'] ?? '') ?></textarea>
        </div>
        <button type="submit" class="btn-fucsia">Enviar mensaje</button>
    </form>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
