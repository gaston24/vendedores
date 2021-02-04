<?php

include 'class/vendedor.php';
include 'class/local.php';
$vendedor = new Vendedor();
$listVendedores = $vendedor->traerVendedores();
$locales = new Local();
$listLocales = $locales->traerLocales();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
    <title>Vendedores</title>
    <link rel="shortcut icon" href="assets/icono.ico" />
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css" >
    <script src="assets/css/bootstrap/jquery-3.5.1.slim.min.js" ></script>
    <script src="assets/css/bootstrap/popper.min.js" ></script>
    <script src="assets/css/bootstrap/bootstrap.min.js" ></script>
</head>
<body>

<div class="container">

<h3 class="text-center">Vendedores</h3>

<form action="Controlador/enviarVendedores.php" method="POST">
    <label for="">Seleccione Vendedor:</label>

    <select name="sucursal" id="" >
    <?php
    foreach ($listLocales as $key => $value) {
        echo '<option value="'.$value['NRO_SUCURSAL'].'">'.$value['DESC_SUCURSAL'].'</option>';
    }
    ?>
    </select>

    <input type="submit" class="btn btn-sm btn-primary" name="crear" value="Enviar vendedores">
    <input type="submit" class="btn btn-sm btn-danger" name="eliminar" value="Inhabilitar vendedores">
    <br>
    <?php

    foreach ($listVendedores as $key => $value) {
        echo '<input type="checkbox" name="vendedores['.$value['NOMBRE_VEN'].']" id="'.$value['COD_VENDED'].'" value="'.$value['COD_VENDED'].'" >  -  '.$value['NOMBRE_VEN'].'<br>';
    }

    ?>


</form>


</div>
    
</body>
</html>