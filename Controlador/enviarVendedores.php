<?php

include '../class/vendedor.php';
include '../class/local.php';

$local = new Local();
$strinCon = $local->localConexion($_POST['sucursal']);
$vend = new Vendedor();

if(isset($_POST['crear'])){
    foreach($_POST['vendedores'] as $vendedor => $value){
        $vend->insertarVendedores($strinCon, $value, $vendedor);
    }
}elseif(isset($_POST['eliminar'])){
    foreach($_POST['vendedores'] as $vendedor => $value){
        $vend->eliminarVendedores($strinCon, $value);
    }
}



header("Location:../index.php");


