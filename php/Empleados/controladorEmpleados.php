<?php
 
require_once 'empleados_modelo.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $empleados= new Empleados();
		$resultado = $empleados->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $empleados= new Empleados();
		$resultado = $empleados->nuevo($datos);
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
		$empleados= new Empleados();
		$resultado = $empleados->borrar($datos['codigo']);
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
        $empleados= new Empleados();
        $empleados->consultar($datos['codigo']);

        if($empleados->getempleados_codi() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $empleados->getEMPLE_CODI(),
                'empleados' => $empleados->getEMPLE_NOMB(),
                'cargo' =>$empleados->getCARGO_CODI(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $empleados= new Empleados();
        $listado = $empleados->lista();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;
}
?>
