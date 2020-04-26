<?php
	require_once('../modeloAbstractoDB.php');
	class Pais extends ModeloAbstractoDB {
		public $pais_codi;
		public $pais_nomb;
		public $pais_capi;
		
		function __construct() {
			//$this->db_name = '';
		}
		
		public function getpais_codi(){
			return $this->pais_codi;
		}

		public function getpais_nomb(){
			return $this->pais_nomb;
		}
		
		public function getpais_capi(){
			return $this->pais_capi;
		}

		public function consultar($pais_codi='') {
			if($pais_codi != ''):
				$this->query = "
				SELECT pais_codi, pais_nomb, pais_capi
				FROM tb_pais
				WHERE pais_codi = '$pais_codi' order by pais_codi
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
			SELECT pais_codi, pais_nomb, pais_capi
			FROM tb_pais as m order by pais_nomb
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		

		public function nuevo($datos=array()) {
			if(array_key_exists('pais_codi', $datos)):
				//$datos = utf8_string_array_encode($datos);
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$pais_nomb= utf8_decode($pais_nomb);
				$this->query = "
				INSERT INTO tb_pais
				(pais_codi, pais_nomb, pais_capi)
				VALUES
				('$pais_codi','$pais_nomb', '$pais_capi')
				";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}

		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$pais_nomb= utf8_decode($pais_nomb);
			$this->query = "
			UPDATE tb_pais
			SET pais_nomb='$pais_nomb',
			pais_capi='$pais_capi'
			WHERE pais_codi = '$pais_codi'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($pais_codi='') {
			$this->query = "
			DELETE FROM tb_pais
			WHERE pais_codi = '$pais_codi'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>