<?php
 
require_once 'Modelocliente.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $clientes= new Clientes();
		$resultado = $clientes->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $clientes= new Clientes();
		$resultado = $clientes->nuevo($datos);
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
		$clientes= new Clientes();
		$resultado = $clientes->borrar($datos['codigo']);
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
        $clientes= new Clientes();
        $clientes->consultar($datos['codigo']);

        if($clientes->getCLIENTE_CODI() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $clientes->getCLIENTE_CODI(),
                'clientes' => $clientes->getCLIENTE_NOM(),
                'apellido' => $clientes->getCLIENTE_APELL(),
                'documento codigo' =>$clientes->getDOCU_CODI(),
                'documento' =>$clientes->getDOCUMENTO(),
                'email' => $clientes->getCLIENTE_EMAIL(),
                'celular' =>$clientes->getCLIENTE_CEL(),
                'direccion' =>$clientes->getCLIENTE_DIREC(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $clientes= new Clientes();
        $listado = $clientes->lista();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;
}
?>
