<?php
 
require_once 'modelocargo.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $cargo = new Cargo();
		$resultado = $cargo->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $cargo = new Cargo();
		$resultado = $cargo->nuevo($datos);
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
		$cargo = new Cargo();
		$resultado = $cargo->borrar($datos['codigo']);
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
        $cargo = new Cargo();
        $cargo->consultar($datos['codigo']);

        if($cargo->getCARGO_CODI() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $cargo->getCARGO_CODI(),
                'cargo' => $cargo->getTIPO_CARGO(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $cargo = new Cargo();
        $listado = $cargo->lista();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;
}
?>
