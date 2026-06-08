<?php
session_start();

//El control de acceso
if(isset($_SESSION['rol'])  && $_SESSION['rol'] !== 'empleado'){
    header("Location: ../index.php");
    exit();
}
include "../templates/header.php";
?>

<style>
    body {
        background: #FADADD !important;  /* Rosado suave con !important */
        min-height: 100vh;
    }
    
    .card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
    }
</style>

<div class="container">
    <div class="card mt-5 p-4">
        <h1 class="mt-2">Interfaz del vendedor</h1>
        <h3 class="mb-5">Bienvenido al mejor sistema, <strong><?php echo $_SESSION['nombre']; ?></strong>.</h3>
    </div>
</div>

<?php
include "../templates/footer.php";
?>