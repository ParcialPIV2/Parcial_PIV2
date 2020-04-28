<?php
	
	require_once('../modeloAbstractoDB.php');
	class Empleados extends ModeloAbstractoDB {
		public $Emple_Codi;
		public $Emple_Nomb;
		public $Emple_Apell;
		public $Documento;
		public $Cargo_Codi;

		
		function __construct() {
			
		}
		
		public function getEMPLE_CODI(){
			return $this->Emple_Codi;
		}

		public function getEMPLE_NOMB(){
			return $this->Emple_Nomb;
		}

		public function getEMPLE_APELL(){
			return $this->Emple_Apell;
		}
		
		public function getDOCUMENTO(){
			return $this->Documento;
		}
		
		public function getCARGO_CODI(){
			return $this->Cargo_Codi;
		}

		public function consultar($Emple_Codi='') {
			if($Emple_Codi != ''):
				$this->query = "
				SELECT Emple_Codi,Emple_Nomb,Emple_Apell,Documento,Emple_Codi,Cargo_Codi
				FROM tb_empleados
				WHERE Emple_Codi = '$Emple_Codi'
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		public function lista() {
			$this->query = "
			SELECT Emple_Codi,Emple_Nomb,Emple_Apell,Documento,p.Cargo_Codi
			FROM tb_empleados as m inner join tb_cargo as p
			ON (m.Cargo_Codi = p.Cargo_Codi) ORDER BY m.Emple_Nomb
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function listaempleados() {
			$this->query = "
			SELECT Emple_Codi, Emple_Nomb,Emple_Apell,Documento
			FROM tb_empleados as d order by Emple_nom
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('Emple_Codi', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				INSERT INTO tb_empleados
				(Emple_Codi, Emple_Nomb, Cargo_Codi,Emple_Apell,Documento)
				VALUES
				('$Emple_Codi','$Emple_Nomb', '$Cargo_Codi','$Emple_Apell','$Documento')
				";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}

		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$this->query = "
			UPDATE tb_empleados
			SET Emple_Nomb='$Emple_Nomb',
			Emple_Apell='$Emple_Apell',
			Documento='$Documento',
            Cargo_Codi='$Cargo_Codi'
			WHERE Emple_Codi = '$Emple_Codi'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($Emple_Codi='') {
			$this->query = "
			DELETE FROM tb_empleados
			WHERE Emple_Codi = '$Emple_Codi'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>