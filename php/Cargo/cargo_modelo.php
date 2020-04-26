<?php
    require_once("../modeloAbstractoDB.php");
    class cargo extends ModeloAbstractoDB {
		private $Cargo_Codi;
		private $Tipo_Cargo;
		private $Emple_Codi;
		
		function __construct() {
			//$this->db_name = '';
		}

		public function getCargo_Codi(){
			return $this->Cargo_Codi;
		}

		public function getTipo_Cargo(){
			return $this->Tipo_Cargo;
		}
		
		public function getEmple_Codi(){
			return $this->Emple_Codi;
		}

		public function consultar($Cargo_Codi='') {
			if($Cargo_Codi !=''):
				$this->query = "
				SELECT Cargo_Codi, Tipo_Cargo, Emple_Codi
				FROM tb_cargo
				WHERE Cargo_Codi = '$Cargo_Codi' order by Cargo_Codi
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
			SELECT Cargo_Codi, Tipo_Cargo, m.Emple_Nomb
			FROM tb_cargo as c inner join tb_empleados as m
			ON (c.Emple_Codi = m.Emple_Codi) order by Cargo_Codi
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('Cargo_Codi', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$Tipo_Cargo= utf8_decode($Tipo_Cargo);
				$this->query = "
					INSERT INTO tb_cargo
					(Cargo_Codi, Tipo_Cargo, Emple_Codi)
					VALUES
					(NULL, '$Tipo_Cargo', '$Emple_Codi')
					";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$Tipo_Cargo= utf8_decode($Tipo_Cargo);
			$this->query = "
			UPDATE tb_cargo
			SET Tipo_Cargo='$Tipo_Cargo',
			Emple_Codi='$Emple_Codi'
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