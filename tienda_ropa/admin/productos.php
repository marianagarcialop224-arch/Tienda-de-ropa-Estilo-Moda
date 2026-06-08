<?php
// baquen hace que la pagina web haga el puente entre la base de datos y
//  el usuario, es decir, que el usuario pueda interactuar con la base de datos 
// a traves de la pagina web, para esto se utiliza el lenguaje de programacion PHP, 
// que es un lenguaje de programacion del lado del servidor, es decir, que se ejecuta 
// en el servidor y no en el navegador del usuario, lo que permite que el usuario pueda
//  interactuar con la base de datos sin necesidad de tener conocimientos de SQL, 
// ya que el PHP se encarga de hacer las consultas a la base de datos y mostrar los resultados 
// al usuario de una manera amigable.

//permisos de acceso a la base de datos
require "../config/db.php";

session_start();

//El control de acceso
if(isset($_SESSION['rol']) && $_SESSION['rol'] !== 'admin'){
    header("Location: ../index.php");
    exit();
}

//Procesamiento del guardado
if(isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    // procesamiento de la imagen    
    $nombre_imagen = $_FILES['imagen']['name'];
    $ruta_temporal = $_FILES['imagen']['tmp_name'];
    $carpeta_destino = "../uploads/" . $nombre_imagen;

    //Mover la imagen a la carpeta destino y guardar 
    if(move_uploaded_file($ruta_temporal, $carpeta_destino)){
        //insercion en la base de datos del registro 
        $stmt = $pdo->prepare("INSERT INTO productos (nombre, precio, stock, imagen) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nombre, $precio, $stock, $nombre_imagen]);
        header("Location: productos.php");
        exit();
    }  
}

//Procesamiento de eliminacion
if(isset($_GET['eliminar'])){
    $id = $_GET['eliminar'];

    //Buscar la imagen en la base de datos 
    $stmt = $pdo->prepare("SELECT imagen from productos where id = ?");
    $stmt->execute([$id]);
    $producto = $stmt->fetch();

    if($producto){
        unlink("../uploads/" . $producto['imagen']);
        $stmt = $pdo->prepare("DELETE FROM productos where id = ?");
        $stmt->execute([$id]);
    }
    header("Location: productos.php");
    exit();
}

//Consulta de registro 
$stmt = $pdo->query("SELECT * FROM productos");
$productos = $stmt->fetchAll();

// comienza el fron 
include "../templates/header.php";
?>
<h2 class="mt-4 mb-4 text-center">Gestión de Inventario de ropa</h2>

<div class="card">
    <div class="card-header">Agregar Nueva Prenda</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" 
                           placeholder="Digite el nombre de la prenda" autocomplete="off" required />
                </div>
                <div class="col-md-3 mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" class="form-control" name="precio" id="precio" 
                           placeholder="Digite el precio de la prenda" autocomplete="off" required />
                </div>
                <div class="col-md-3 mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" name="stock" id="stock" 
                           placeholder="Digite la cantidad de stock inicial" autocomplete="off" required />
                </div>
                <div class="col-md-3 mb-3">
                    <label for="imagen" class="form-label">Imagen:</label>
                    <input type="file" class="form-control" name="imagen" id="imagen" required />
                </div>
            </div> <!-- ← CERRÉ EL ROW AQUÍ -->
            <div class="text-center mb-3">
                <button type="submit" class="btn btn-primary" name="agregar">
                    Guardar en el almacén
                </button>
            </div>
        </form>
    </div>
    <div class="card-footer text-body-secondary"></div>
</div>

<hr>

<h3 class="text-center mt-5 mb-5">Lista de Productos</h3>
<div class="table-responsive">
    <table class="table table-bordered table-hover display" style="text-align: center;" id="myTable">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $p): ?>
            <tr>
                <td><img src="../uploads/<?php echo $p['imagen']; ?>" width="50"></td>
                <td><?php echo $p['nombre']; ?></td>
                <td>$<?php echo number_format($p['precio'], 2); ?></td>
                <td><?php echo $p['stock']; ?></td>
                <td>
                    <a class="btn btn-success btn-sm" href="editar_productos.php?id=<?php echo $p['id']; ?>" role="button"><i class="bi bi-pencil-square"></i> Editar</a>
                    <a class="btn btn-danger btn-sm" href="?eliminar=<?php echo $p['id']; ?>" role="button" onclick="return confirm('¿Eliminar este producto?')"> <i class="bi bi-trash3"></i> Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
include "../templates/footer.php";
?>