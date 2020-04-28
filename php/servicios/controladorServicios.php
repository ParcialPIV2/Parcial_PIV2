
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
                 'codigo cliente' => $servicios->getCLIENTE_CODI(),
                 'cliente nombre completo' => $servicios->getCLIENTE_NOMB(),getCLIENTE_APELL(),
                 'documento cliente' => $servicios->getDOCUM_CLI(),
                 'tratamiento' => $servicios->getTRATA_CODI(),
                 'codigo empleado' => $servicios->getEMPLE_CODI(),
                 'empleado nombre completo' => $servicios->getEMPLE_NOMB(),getEMPLE_APELL(),
                 'documento empleado' => $servicios->getDOCU_EMPLE(),
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
 