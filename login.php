<?php 

SESSION_START();

if(isset($_SESSION['auth']))
{
    if($_SESSION['auth']==1)
    {
        header("location:index.php");
    }
}


include "lib/connection.php";
    if (isset($_POST['submit'])) 
    {
        $email = $_POST['email'];
        $pass = md5($_POST['password']);

        $loginquery="SELECT * FROM users WHERE email='$email' AND pass='$pass'";
        $loginres = $conn->query($loginquery);

        echo $loginres->num_rows;

        if ($loginres->num_rows > 0) 
        {

            while ($result=$loginres->fetch_assoc()) 
            {
                $username=$result['f_name'];
                $userid=$result['id'];
            }

            $_SESSION['username']=$username;
            $_SESSION['userid']=$userid;
            $_SESSION['auth']=1;
            header("location:index.php");
        }
        else
        {
            echo "invalid";
        }
    }


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #fff 0%, #e91e63 100%);
            font-family: 'Poppins', Arial, sans-serif;
        }
        .login-card {
            max-width: 430px;
            margin: 60px auto;
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(233,30,99,0.18);
            background: #fff;
        }
        .login-card .card-header {
            background: #e91e63;
            color: #fff;
            border-radius: 18px 18px 0 0;
            text-align: center;
            border-bottom: none;
        }
        .login-card .card-header h3 {
            font-weight: 700;
            letter-spacing: 1px;
        }
        .login-card .card-body {
            padding: 2rem 2rem 1.5rem 2rem;
        }
        .login-card .form-control {
            border-radius: 8px;
            border: 1px solid #e91e63;
            font-size: 1rem;
        }
        .login-card .form-control:focus {
            border-color: #111;
            box-shadow: 0 0 0 2px #e91e6333;
        }
        .login-card .btn-primary {
            background: #e91e63;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            letter-spacing: 1px;
            transition: background 0.2s;
        }
        .login-card .btn-primary:hover {
            background: #111;
            color: #fff;
        }
        .login-card .input-group {
            margin-bottom: 1.2rem;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="login-card card">
        <div class="card-header">
            <h3>Iniciar Sesión</h3>
        </div>
        <div class="card-body">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="input-group form-group">
                    <input type="email" class="form-control" placeholder="Correo electrónico" name="email" required>
                </div>
                <div class="input-group form-group">
                    <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
                </div>
                <div class="form-group d-grid mb-2">
                    <input type="submit" value="Iniciar Sesión" class="btn btn-primary" name="submit">
                </div>
                <div class="text-center mb-2">
                    <a href="reset_password.php" style="color:#e91e63; font-weight:500; text-decoration:none;">¿Olvidaste tu contraseña?</a>
                </div>
                <div class="text-center">
                    <a href="register.php" style="color:#111; text-decoration:none;">¿No tienes cuenta? Regístrate</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>