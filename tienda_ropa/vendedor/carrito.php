<?php
session_start();

//El control de acceso
if(isset($_SESSION['rol'])  && $_SESSION['rol'] !== 'empleado'){
    header("Location: ../index.php");
    exit();
}

require "../config/db.php";


//Procesamiento del vaciado del carro 
if (isset($_GET["vaciar"])){
    $_SESSION ["carrito"]= [];
    header ("Location: carrito.php");
}

//Procesamiento de quitar items 
if(isset($_GET["quitar"])){
    $id = $_GET["quitar"];
    unset($_SESSION["carrito"]["$id"]);
    header("Location: carrito.php");
}




include "../templates/header.php";
?>

<h2 class="text-center mt-4 mb-4">Carrito de compras</h2>

<?php if (empty($_SESSION["carrito"])): ?>
<p>El carrito esta vacio <a href="catalogo.php">Volver al catalogo</a></p>
<?php else: ?>
<div
    class="table-responsive"
>
    <table
        class="table table-bordered table-hover">
        <thead>
            <tr class="text-center">
                <th>Producto</th>
                <th>Precio unitario</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total=0;
            foreach ($_SESSION["carrito"] as $id => $item):
                $subtotal = $item["precio"] * $item["cantidad"];
                $total += $subtotal;
            ?>
            <tr>
                <td><?php echo $item["nombre"]; ?></td>
                <td class="text-center"><?php echo $item["precio"]; ?></td>
                <td class="text-center" ><?php echo $item["cantidad"]; ?></td>
                <td class="text-center">$ <?php echo number_format ($subtotal); ?></td>
                <td class="text-center">
                    <a name="" id="" class="btn btn-danger" href="?quitar=<?php echo $id; ?>"role="button">Quitar</a>
                    </td>
            </tr>
            <?php endforeach?>
        </tbody>
        <tfoot>
            <tr> 
                <td colspan="3" style="text-align: center; font-weight: bold; padding: 10px;">TOTAL A PAGAR:</td>
                <td  class="text-center" style=" font-weight: bold; color: green;">$ <?php echo number_format ($total); ?></td>
            </tr>
        </tfoot>
    </table>
</div>
<div style="margin-top: 20px; display: flex; gap: 10px; justify-content: center;">
<a href="catalogo.php" style="background: #6c757d; color: white; padding:  10px 20px;text-decoration: none; border-radius: 8px; "
>Seguir comprando</a>
<a href="?vaciar=1"
style="background: red; color: white; padding: 10px 20px;text-decoration: none; border-radius: 8px;"
>Vaciar el carrito</a>
<form action="procesar_venta.php" method="post" style="display:inline;">
<input type="hidden"name="total_venta"value=<?php  echo $total;?>">
<button type="submit" style="background: green; border: none; color: white; padding: 10px 20px;text-decoration: none; border-radius: 8px;"
>Generar Factura</button>
            </form>
            </div>




    <?php endif; ?>

<?php
include "../templates/footer.php";
?>