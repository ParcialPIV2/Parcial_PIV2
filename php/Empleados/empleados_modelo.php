<?php
    require_once("../modeloAbstractoDB.php");
    class empleados extends ModeloAbstractoDB {
		private $Emple_Codi;
		private $Emple_Nomb;
		private $Emple_Nomb2;
		private $Cargo_Nomb;
		
		function __construct() {
			//$this->db_name = '';
		}

		public function getEmple_Codi(){
			return $this->Emple_Codi;
		}

		public function getEmple_Nomb(){
			return $this->Emple_Nomb;
		}

		public function getEmple_Nomb(){
			return $this->Emple_Nomb2;
		}
		
		public function getCargo_Nomb(){
			return $this->Cargo_Nomb;
		}

		public function consultar($Emple_Codi='') {
			if($Emple_Codi !=''):
				$this->query = "
				SELECT Emple_Codi, Emple_Nomb, Emple_Nomb2, Cargo_Nomb
				FROM tb_empleados
				WHERE Emple_Codi = '$Emple_Codi' order by Emple_Codi
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
			SELECT Emple_Codi, Emple_Nomb, Emple_Nomb2, m.muni_nomb
			FROM tb_empleados as c inner join tb_cargo as m
			ON (c.Cargo_Nomb = m.Cargo_Nomb) order by Emple_Codi
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('Emple_Codi', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$Emple_Nomb= utf8_decode($Emple_Nomb);
				$this->query = "
					INSERT INTO tb_empleados
					(Emple_Codi, Emple_Nomb, Emple_Nomb2, Cargo_Nomb)
					VALUES
					(NULL, '$Emple_Nomb', '$Cargo_Nomb')
					";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$Emple_Nomb= utf8_decode($Emple_Nomb);
			$this->query = "
			UPDATE tb_empleados
			SET Emple_Nomb='$Emple_Nomb',
			SET Emple_Nomb2='$Emple_Nomb2',
			Cargo_Nomb='$Cargo_Nomb'
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