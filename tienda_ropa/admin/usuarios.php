<?php

//permisos de acceso a la base de datos
require "../config/db.php";

session_start();

$mensaje="";

//El control de acceso
if(isset($_SESSION['rol']) && $_SESSION['rol'] !== 'admin'){
    header("Location: ../index.php");
    exit();
}

//Procesamiento de creacion de usuarios 
if(isset($_POST["registrar"])){
    $nombre = $_POST["nombre"];
    $usuario = $_POST["usuario"];
    $password_inicial = $_POST["password"];
    $rol = $_POST["rol"];

    $password_hasheada = password_hash($password_inicial, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO `usuarios` (`nombre`, `usuario`, `password`, `rol`) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nombre, $usuario, $password_hasheada, $rol]);
        $mensaje = "Usuario creado exitosamente";
    } catch (PDOException $e) {
        $mensaje = "Error al crear el usuario";
    }
}

//Consulta a la tabla de usuarios 
$stmt = $pdo->query("SELECT `id`, `nombre`, `usuario`, `rol` FROM `usuarios`");
$lista_usuarios = $stmt->fetchAll();

//Procesamiento de eliminar 
if(isset($_GET['eliminar'])){
    $id_a_eliminar = $_GET['eliminar'];

    if($id_a_eliminar == $_SESSION['user_id']){
        $mensaje = "No puedes eliminarte a ti mismo";
    } else {
        // Primero eliminar las ventas asociadas al usuario
        $stmt = $pdo->prepare("DELETE FROM `ventas` WHERE id_vendedor=?");
        $stmt->execute([$id_a_eliminar]);
        
        // Luego eliminar el usuario
        $stmt = $pdo->prepare("DELETE FROM `usuarios` WHERE id=?");
        $stmt->execute([$id_a_eliminar]);
        
        header("Location: usuarios.php");
        exit();
    }
}

include "../templates/header.php";
?>

<h2 class="mt-4 mb-4 text-center">Gestión de Usuarios</h2>

<?php if ($mensaje):?>
    <div class="alert alert-success text-center"><?php echo $mensaje; ?></div>
<?php endif; ?>

<div class="mb-4">
    <div class="border p-3 mb-3" style="background-color: #f8f9fa; border-radius: 5px;">
        <h4 class="mb-3">Registro de nuevo Usuario</h4>
        <form action="" method="post">
            <div class="mb-3">
                <input type="text" class="form-control" name="nombre" id="" aria-describedby="helpId"
                placeholder="Digite el nombre completo del Usuario" required autocomplete="off"/>  
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="usuario" id="" aria-describedby="helpId"
                placeholder="Digite el nick de usuario" required autocomplete="off"/>  
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" id="" aria-describedby="helpId"
                placeholder="Digite el password inicial del usuario" required autocomplete="off"/>  
            </div>
            <div class="mb-3">
                <select class="form-select" name="rol" id="rol" required>
                    <option value="" selected disabled> Tipo de rol </option>
                    <option value="admin">Administrador</option>
                    <option value="empleado">Empleado</option>
                </select>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="registrar">
                    Crear usuario
                </button>
            </div>
        </form>
    </div>
</div>

<hr>

<h3 class="text-center mt-3">Usuarios Registrados en el Sistema</h3>
<div class="table-responsive">
    <table class="table table-bordered table-hover" style="text-align: center;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Acciones</th>
            </thead>
        <tbody>
            <?php foreach($lista_usuarios as $u): ?>
            <tr>
                <td><?php echo $u["id"]; ?></td>
                <td><?php echo $u["nombre"]; ?></td>
                <td><?php echo $u["usuario"]; ?></td>
                <td><strong><?php echo strtoupper($u["rol"]); ?></strong></td>
                <td>
                    <a class="btn btn-danger btn-sm" href="?eliminar=<?php echo $u["id"]; ?>" role="button" onclick="return confirm('¿Eliminar este usuario?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?> 
        </tbody>
    </table>
</div>

<?php
include "../templates/footer.php";
?>