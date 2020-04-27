<?php
 
require_once 'empleados_modelo.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $empleados = new empleados();
        $resultado = $empleados->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $empleados = new empleados();
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
		$empleados = new empleados();
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
        $empleados = new empleados();
        $empleados->consultar($datos['codigo']);

        if($empleados->getEmple_Codi() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $empleados->getEmple_Codi(),
                'empleados' => $empleados->getEmple_Nomb(),
                'empleados' => $empleados->getEmple_Nomb2(),
                'municipio' =>$empleados->getCargo_Codi(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $empleados = new empleados();
        $listado = $empleados->lista();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
