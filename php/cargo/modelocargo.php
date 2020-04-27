<?php
	require_once('../modeloAbstractoDB.php');
	class Cargo extends ModeloAbstractoDB {
		public $Cargo_Codi;
		public $Tipo_Cargo;

		
		function __construct() {
			//$this->db_name = '';
		}
		
		public function getCARGO_CODI(){
			return $this->Cargo_Codi;
		}

		public function getTIPO_CARGO(){
			return $this->Tipo_Cargo;
		}
		

		public function consultar($Cargo_Codi='') {
			if($Cargo_Codi != ''):
				$this->query = "
				SELECT Cargo_Codi, Tipo_Cargo
				FROM tb_cargo
				WHERE Cargo_Codi = '$Cargo_Codi' 
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
			SELECT Cargo_Codi, Tipo_Cargo
			FROM tb_cargo ORDER BY Cargo_Codi
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		
		public function listaCargo() {
			$this->query = "
			SELECT *
			FROM tb_cargo order by Tipo_Cargo
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		


		

		public function nuevo($datos=array()) {
			if(array_key_exists('Cargo_Codi', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$Cargo_Codi= utf8_decode($Cargo_Codi);
				$this->query = "
				INSERT INTO tb_cargo
				(Cargo_Codi, Tipo_Cargo)
				VALUES
				('$Cargo_Codi','$Tipo_Cargo')
				";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}

		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$Cargo_Codi= utf8_decode($Cargo_Codi);
			$this->query = "
			UPDATE tb_cargo
			SET Tipo_Cargo='$Tipo_Cargo'
			WHERE Cargo_Codi = '$Cargo_Codi'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($Cargo_Codi='') {
			$this->query = "
			DELETE FROM tb_cargo
			WHERE Cargo_Codi = '$Cargo_Codi'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>