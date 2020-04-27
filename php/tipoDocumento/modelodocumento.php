<?php
	require_once('../modeloAbstractoDB.php');
	class tipodocumento extends ModeloAbstractoDB {
		public $Docu_Codi;
		public $Docu_Nomb;

		
		function __construct() {
			//$this->db_name = '';
		}
		
		public function getDOCU_CODI(){
			return $this->Docu_Codi;
		}

		public function getDOCU_NOMB(){
			return $this->Docu_Nomb;
		}
		

		public function consultar($Docu_Codi='') {
			if($Docu_Codi != ''):
				$this->query = "
				SELECT Docu_Codi, Docu_Nomb
				FROM tb_tipo_documento
				WHERE Docu_Codi = '$Docu_Codi' 
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
			SELECT Docu_Codi, Docu_Nomb
			FROM tb_tipo_documento ORDER BY Docu_Codi
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		
		public function listaCargo() {
			$this->query = "
			SELECT *
			FROM tb_tipo_documento order by Docu_Nomb
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
	

		public function nuevo($datos=array()) {
			if(array_key_exists('Docu_Codi', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$Docu_Codi= utf8_decode($Docu_Codi);
				$this->query = "
				INSERT INTO tb_tipo_documento
				(Docu_Codi, Docu_Nomb)
				VALUES
				('$Docu_Codi','$Docu_Nomb')
				";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}

		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$Docu_Codi= utf8_decode($Docu_Codi);
			$this->query = "
			UPDATE tb_tipo_documento
			SET Docu_Nomb='$Docu_Nomb'
			WHERE Docu_Codi = '$Docu_Codi'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($Docu_Codi='') {
			$this->query = "
			DELETE FROM tb_tipo_documento
			WHERE Docu_Codi = '$Docu_Codi'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>