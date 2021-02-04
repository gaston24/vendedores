<?php

class Local{
    
    public function traerLocales(){
        include __DIR__."/../sql/sql_conexion.php";
        $sql = "SELECT NRO_SUCURSAL, DESC_SUCURSAL 
        FROM SUCURSAL 
        WHERE (NRO_SUCURSAL BETWEEN 2 AND 98) 
        AND CA_423_HABILITADO = 1 
        ORDER BY 1";
        $query = sqlsrv_prepare($cid_central, $sql);
        $result = sqlsrv_execute($query);
        $rows = array();
        while($v=sqlsrv_fetch_array($query)){
        	$rows[] = $v;
        }
        return $rows;      
    }


    public function localConexion($num_suc){
        include __DIR__."/../sql/sql_conexion.php";
    
        $sql_buscar_local = "SELECT TOP 1 * FROM ACTOR WHERE NUMERO_ACTOR = $num_suc";
    
        $query_buscar_local = sqlsrv_prepare($cid_tangonet_bis_1, $sql_buscar_local);
    
        sqlsrv_execute($query_buscar_local);
    
        $datos = array();
    
        while($v=sqlsrv_fetch_array($query_buscar_local)){
    
            $datos = array
            (
    
                "SERVIDOR" => $v['SERVIDOR_ACTOR'],
                "Database" => $v['BASE_ACTOR'],
                "NOMBRE" => $v['NOMBRE_ACTOR'],
                "MAIL" => $v['MAIL_ACTOR']
    
            );
    
    
        }
    
        sqlsrv_close($cid_tangonet_bis_1);
    
        return $datos;
        
    }

    public function probarConexion($strCon){
        $consulta = 
        "
        SELECT * FROM GVA12 WHERE 1 = 0

        ";
        
        $servidor = $strCon['SERVIDOR'];
        $conexion = array( "Database"=>$strCon['Database'], "UID"=>"sa", "PWD"=>"Axoft1988");
        $cid = sqlsrv_connect($servidor, $conexion);
        
        try {
            $query = sqlsrv_prepare($cid, $sqlEliminaVended);
            sqlsrv_execute($query);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


}