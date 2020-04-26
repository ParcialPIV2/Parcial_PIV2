<?php
 
require_once 'cargo_modelo.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $cargo = new cargo();
        $resultado = $cargo->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $cargo = new cargo();
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
		$cargo = new cargo();
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
        $cargo = new cargo();
        $cargo->consultar($datos['codigo']);

        if($cargo->getcarg_codi() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $cargo->getcarg_codi(),
                'cargo' => $cargo->getcarg_nomb(),
                'municipio' =>$cargo->getempl_codi(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $cargo = new cargo();
        $listado = $cargo->lista();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
