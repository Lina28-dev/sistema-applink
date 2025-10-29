<?php

include "lib/connection.php";
$result = null;
  if (isset($_POST['u_submit'])) 
  {
    $f_name=$_POST['u_name'];
    $l_name=$_POST['l_name'];
    $email=$_POST['email'];
    $pass=md5($_POST['pass']);
    $cpass=md5($_POST['c_pass']);

    if ($pass==$cpass) 
    {
         $insertSql = "INSERT INTO users(f_name ,l_name, email, pass) VALUES ('$f_name', '$l_name','$email', '$pass')";

         if ($conn -> query ($insertSql)) 
         {
            $result="Account Open success";
            header("location:login.php");
         }
         else
         {
             die($conn -> error);
         }
    }
    else
    {
      $result="Password Not Match";
    }
  } 


 //echo $result_std -> num_rows;


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

</head>

    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #fff 0%, #e91e63 100%);
            font-family: 'Poppins', Arial, sans-serif;
        }
        .register-card {
            max-width: 430px;
            margin: 60px auto;
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(233,30,99,0.18);
            background: #fff;
        }
        .register-card .card-header {
            background: #e91e63;
            color: #fff;
            border-radius: 18px 18px 0 0;
            text-align: center;
            border-bottom: none;
        }
        .register-card .card-header h3 {
            font-weight: 700;
            letter-spacing: 1px;
        }
        .register-card .card-body {
            padding: 2rem 2rem 1.5rem 2rem;
        }
        .register-card .form-control {
            border-radius: 8px;
            border: 1px solid #e91e63;
            font-size: 1rem;
        }
        .register-card .form-control:focus {
            border-color: #111;
            box-shadow: 0 0 0 2px #e91e6333;
        }
        .register-card .btn-primary {
            background: #e91e63;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            letter-spacing: 1px;
            transition: background 0.2s;
        }
        .register-card .btn-primary:hover {
            background: #111;
            color: #fff;
        }
        .register-card .input-group {
            margin-bottom: 1.2rem;
        }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">
        <div class="register-card card">
            <div class="card-header">
                <h3>Crear Cuenta</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="input-group form-group">
                        <input type="text" class="form-control" placeholder="Nombre" name="u_name" required>
                    </div>
                    <div class="input-group form-group">
                        <input type="text" class="form-control" placeholder="Apellido" name="l_name" required>
                    </div>
                    <div class="input-group form-group">
                        <input type="email" class="form-control" placeholder="Correo electrónico" name="email" required>
                    </div>
                    <div class="input-group form-group">
                        <input type="password" class="form-control" placeholder="Contraseña" name="pass" required>
                    </div>
                    <div class="input-group form-group">
                        <input type="password" class="form-control" placeholder="Confirmar contraseña" name="c_pass" required>
                    </div>
                    <div class="form-group d-grid">
                        <input type="submit" value="Registrarse" class="btn btn-primary" name="u_submit">
                    </div>
                    <div class="text-center mt-3">
                        <?php if($result) echo '<span class="text-danger">'.$result.'</span>'; ?>
                    </div>
                </form>
            </div>
        </div>
        
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.php">Ya tienes una cuenta? Inicia sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    </div>


</body>

</html>