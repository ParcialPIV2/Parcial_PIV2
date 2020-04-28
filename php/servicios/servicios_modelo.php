<?php
	require_once('../modeloAbstractoDB.php');
	class Historial extends ModeloAbstractoDB {
		public $servi_codi;
		public $Cliente_Codi;
		public $Cliente_Nom;
		public $Docu_Cli;
		public $Docu_Emple;
		public $Emple_Codi;
		public $Emple_Nomb;
		public $Cargo_Codi;
		public $Trata_Codi;
		public $Trata_Valor;
		
		function __construct() {
			//$this->db_name = '';
		}

		public function getSERVI_CODI(){
			return $this->servi_codi;
		}
		
		public function getCLIENTE_CODI(){
			return $this->Cliente_Codi;
		}

		public function getCLIENTE_NOM(){
			return $this->Cliente_Nom;
		}		
		
		public function getDOCU_CLI(){
			return $this->Docu_Cli;
		}

		public function getDOCU_EMPLE(){
			return $this->Docu_Emple;
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

		public function getTRATA_CODI(){
			return $this->Trata_Codi;
		}

		public function getTRATA_VALOR(){
			return $this->Trata_Valor;
		}

		public function getCARGO_CODI(){
			return $this->Cargo_Codi;
		}

		public function consultar($servi_codi='') {
			if($servi_codi != ''):
				$this->query = "
				SELECT servi_codi, Cliente_Codi, Emple_Codi, Cargo_Codi, Trata_Codi
				FROM tb_servicios
				WHERE servi_codi = '$servi_codi'
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
			SELECT servi_codi, Cliente_Codi, Emple_Codi, Cargo_Codi, Trata_Codi, m.Cliente_Codi
			FROM tb_servicios as m inner join tb_clientes as d
			ON (m.Cliente_Codi = d.Cliente_Codi) ORDER BY m.Cliente_Codi
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function listaServicios() {
			$this->query = "
			SELECT servi_codi, Cliente_Codi, Emple_Codi, Cargo_Codi, Trata_Codi
			FROM tb_servicios as m order by Cliente_Codi
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		

		public function nuevo($datos=array()) {
			if(array_key_exists('servi_codi', $datos)):
				//$datos = utf8_string_array_encode($datos);
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$Trata_Nomb= utf8_decode($Trata_Nomb);
				$this->query = "
				INSERT INTO tb_servicios
				(servi_codi, Cliente_Codi, Emple_Codi, Cargo_Codi, Trata_Codi)
				VALUES
				('$servi_codi', '$Cliente_Codi', '$Emple_Codi', '$Cargo_Codi', '$Trata_Codi')
				";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}

		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$Cliente_Codi= utf8_decode($Cliente_Codi);
			$this->query = "
			UPDATE tb_servicios
			SET Cliente_Codi='$Cliente_Codi',
			Trata_codi='$Trata_codi'
			WHERE servi_codi = '$servi_codi'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($servi_codi='') {
			$this->query = "
			DELETE FROM tb_servicios
			WHERE servi_codi = '$servi_codi'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>