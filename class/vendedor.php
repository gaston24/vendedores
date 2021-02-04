<?php

class Vendedor{
    
    public function traerVendedores(){
        include __DIR__."/../sql/sql_conexion.php";
        $sql = "SELECT * FROM GVA23 WHERE LEN(NOMBRE_VEN) >2 ORDER BY NOMBRE_VEN";
        $query = sqlsrv_prepare($cid_central, $sql);
        $result = sqlsrv_execute($query);
        $rows = array();
        while($v=sqlsrv_fetch_array($query)){
        	$rows[] = $v;
        }
        return $rows;      
    }


    public function insertarVendedores($conn, $cod, $nombre){
        $sqlInsertaVended = 
        "
        IF NOT EXISTS (SELECT * FROM GVA23 WHERE COD_VENDED = '".$cod."')
        BEGIN
            INSERT INTO GVA23 (COD_VENDED, NOMBRE_VEN, PORC_COMIS, INHABILITA, TIPO_DOC, COD_GVA23)
            VALUES('".$cod."', '".$nombre."', 1, 0, 99, '".$cod."')
        END
        ELSE 
        BEGIN
            UPDATE GVA23 SET INHABILITA = 0 WHERE COD_VENDED = '".$cod."'
        END
        ";
        
        $servidor = $conn['SERVIDOR'];
        $conexion = array( "Database"=>$conn['Database'], "UID"=>"sa", "PWD"=>"Axoft1988");
        $cid = sqlsrv_connect($servidor, $conexion);
        
        $query = sqlsrv_prepare($cid, $sqlInsertaVended);
        sqlsrv_execute($query);

    }


    public function eliminarVendedores($conn, $cod){
        $sqlEliminaVended = 
        "
        IF EXISTS (SELECT * FROM GVA23 WHERE COD_VENDED = '".$cod."')
        BEGIN
            UPDATE GVA23 SET INHABILITA = 1 WHERE COD_VENDED = '".$cod."'
        END

        ";
        
        $servidor = $conn['SERVIDOR'];
        $conexion = array( "Database"=>$conn['Database'], "UID"=>"sa", "PWD"=>"Axoft1988");
        $cid = sqlsrv_connect($servidor, $conexion);
        
        $query = sqlsrv_prepare($cid, $sqlEliminaVended);
        sqlsrv_execute($query);

    }

}