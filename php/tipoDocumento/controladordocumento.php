<?php
 
require_once 'modelodocumento.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $tipodocumento = new Tipodocumento();
		$resultado = $tipodocumento->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $tipodocumento = new Tipodocumento();
		$resultado = $tipodocumento->nuevo($datos);
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
		$tipodocumento = new Tipodocumento();
		$resultado = $tipodocumento->borrar($datos['codigo']);
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
        $tipodocumento = new Tipodocumento();
        $tipodocumento->consultar($datos['codigo']);

        if($tipodocumento->gettipodocumento_CODI() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $tipodocumento->getDOCU_CODI(),
                'tipodocumento' => $tipodocumento->getDOCU_NOMB(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $tipodocumento = new Tipodocumento();
        $listado = $tipodocumento->lista();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;
}
?>
