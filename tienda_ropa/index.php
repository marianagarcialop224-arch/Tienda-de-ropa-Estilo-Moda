<?php

//permisos de acceso a la base de datos
require "config/db.php";

//configurar el Inicio de sesicciòn
session_start();

//Restringir el Acceso
if(isset($_SESSION['rol'])){
    if($_SESSION['rol'] == 'admin'){
        header("Location: admin/index.php");
    }else{
        header("Location: vendedor/index.php");
    }
}

//confirmacion de que la informacion se ha enviado por el metodo POST
if($_SERVER["REQUEST_METHOD"]=="POST"){
    //asigancion de valores de los inputs
    $usuario=$_POST["usuario"];
    $password=$_POST["password"];

    //Buscar el usuario en la base de datos 
    $stmt=$pdo->prepare("SELECT * FROM usuarios WHERE usuario=?");
    $stmt->execute([$usuario]);
    $user=$stmt->fetch();

    //validacion de la contraseña 
    if($user &&  password_verify($password, $user["password"])){
        //Creacion de las variables de sesion
        $_SESSION['user_id']=$user['id'];
        $_SESSION['nombre']=$user['nombre'];
        $_SESSION['rol']=$user['rol'];
        
       //redireccionamiento segun el rol 
        if($user["rol"]=="admin"){
            header("Location: admin/index.php");
        }else{
            header ("Location: vendedor/index.php");
             }
             exit();

        }else{
            $error = "Usuario o contraseña incorrectos";
        }
}


?>

<!doctype html>
<html lang="es" data-bs-theme="light">

    <head>
        <title>login - Estilo & Moda la mejor tienda de ropa  </title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"/>
        
        <style>
            /* SOLO AGREGÉ ESTO - DEGRADADO AZUL A ROSA */
            body {
                background: linear-gradient(135deg, #89CFF0 0%, #F5B7B1 100%);
                min-height: 100vh;
            }
        </style>
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main class="container">
           <h1 class="text-center mt-5 mb-5">Bienvenidos a  Estilo & Moda</h1>

           <?php if(isset($error)): ?>
                <div class="alert alert-danger text-center"><?php echo $error; ?></div>
           <?php endif; ?>

           <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
              <form action="" method="post">
            <div class="mb-3">
            <label for="" class="form-label">usuario</label>
                <input type="text" class="form-control" name="usuario"id=""aria-describedby="helpId"placeholder="Digite su nombre de usuario "required autocomplete="off"/>
                <div class="mb-3">
                    <label for="" class="form-label">Contraseña</label>
                    <input
                        type="password"
                        class="form-control"
                        name="password"
                        id=""
                        aria-describedby="helpId"
                        placeholder="Digite su contraseña "required autocomplete="off"/>
                    </div>
                </div>
            <div class="text-center">
            <button type="submit"class="btn btn-primary">
            Iniciar sesiòn  
            </button>

              </div>
           </form>  
            </div>
            <div class="card-footer text-body-secondary"></div>
          </div>
                
       </div>
 </div>
         </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>