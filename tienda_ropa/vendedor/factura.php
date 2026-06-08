<?php
session_start();

// El control de acceso
if(!isset($_SESSION['rol']) || $_SESSION['rol'] != 'empleado') {
    header('Location: ../index.php');
    exit();
}

require '../config/db.php';

//REcepción del id de la factura
$id_venta = $_GET['id'];

// Consultar la tabla ventas
$stmt_v = $pdo->prepare("SELECT v.*, u.nombre AS vendedor
                         FROM ventas v
                         JOIN usuarios u ON v.id_vendedor = u.id
                         WHERE v.id = ?");
$stmt_v->execute([$id_venta]);
$venta = $stmt_v->fetch();

// consulta de la venta
$stmt_d = $pdo->prepare("SELECT dv.*, p.nombre
                         FROM detalles_venta dv
                         JOIN productos p ON dv.id_producto = p.id
                         WHERE dv.id_venta = ?");
$stmt_d->execute([$id_venta]);
$detalles = $stmt_d->fetchAll(); 

include '../templates/header.php';
?>

<div class="mt-5" style="max-width: 600px; margin: 0 auto; border: 1px solid #ddd; padding: 20px; background: #fff;">
  <h2 style="text-align: center;">TICKET DE VENTA</h2>
  <p class="text-center">LA MEJOR TIENDA DE ROPA</p>
  <hr>
  <p><strong>Factura Nro. </strong><?php echo $venta['id']; ?></p>
  <p><strong>Fecha: </strong><?php echo $venta['fecha']; ?></p>
  <p><strong>Atendido por: </strong><?php echo $venta['vendedor']; ?></p>
  
  <h3>Detalles de la compra</h3>
  <table class="table table-bordered">
      <thead>
          <tr>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Precio Unitario</th>
              <th>Subtotal</th>
          </thead>
      <tbody>
          <?php foreach($detalles as $item): ?>
          <tr>
              <td><?php echo $item['nombre']; ?></td>
              <td><?php echo $item['cantidad']; ?></td>
              <td>$<?php echo number_format($item['precio_unitario'], 2); ?></td>
              <td>$<?php echo number_format($item['cantidad'] * $item['precio_unitario'], 2); ?></td>
          </tr>
          <?php endforeach; ?>
      </tbody>
      <tfoot>
          <tr>
              <th colspan="3" class="text-end">TOTAL:</th>
              <th>$<?php echo number_format($venta['total'], 2); ?></th>
          </tr>
      </tfoot>
  </table>
  
  <!-- SOLO AGREGÉ ESTOS DOS BOTONES -->
  <div style="display: flex; justify-content: space-between; margin-top: 20px;">
      <a href="javascript:window.print()" style="background: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; text-align: center;">Imprimir ticket</a>
      <a href="catalogo.php" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; text-align: center;">Volver al catálogo</a>
  </div>
  <!-- FIN DE LOS BOTONES -->
  
</div>

<?php
include '../templates/footer.php';
?>