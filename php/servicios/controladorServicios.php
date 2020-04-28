
<?php
 
 require_once 'servicios_modelo.php';
 $datos = $_GET;
 switch ($_GET['accion']){
     case 'editar':
         $servicios= new Servicios();
         $resultado = $servicios->editar($datos);
         $respuesta = array(
                 'respuesta' => $resultado
             );
         echo json_encode($respuesta);
         break;
     case 'nuevo':
         $servicios= new Servicios();
         $resultado = $servicios->nuevo($datos);
         if($resultado > 0) {
             $respuesta = array(
                 'respuesta' => 'correcto'
             );
         }  else {
             $respuesta = array(
                 'respuesta' => 'error'
             );
         }
         echo json_encode($respuesta);
         break;
     case 'borrar':
         $servicios= new Servicios();
         $resultado = $servicios->borrar($datos['codigo']);
         if($resultado > 0) {
             $respuesta = array(
                 'respuesta' => 'correcto'
             );
         }  else {
             $respuesta = array(
                 'respuesta' => 'error'
             );
         }
         echo json_encode($respuesta);
         break;
 
     case 'consultar':
         $servicios= new Servicios();
         $servicios->consultar($datos['codigo']);
 
         if($servicios->getEmple_Codi() == null) {
             $respuesta = array(
                 'respuesta' => 'no existe'
             );
         }  else {
             $respuesta = array(
                 'codigocliente' => $servicios->getCLIENTE_CODI(),
                 'nombrecliente' => $servicios->getCLIENTE_NOM(),
                 'apellidocliente' => $servicios->getCLIENTE_APELL(),
                 'documentocliente' => $servicios->getDOCU_CLI(),
                 'codigoempleado' => $servicios->getEMPLE_CODI(),
                 'nombreempleado' => $servicios->getEMPLE_NOMB(),
                 'apellidoempleado' => $servicios->getEMPLE_APELL(),
                 'documentoempleado' => $servicios->getDOCU_EMPLE(),
                 'tratamiento' => $servicios->getTRATA_CODI(),
                 'cargo' =>$servicios->getCARGO_CODI(),
                 'respuesta' =>'existe'
             );
         }
         echo json_encode($respuesta);
         break;
 
     case 'listar':
         $servicios= new Servicios();
         $listado = $servicios->lista();        
         echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
         break;
 }
 ?>
 