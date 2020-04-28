<?php
	require_once('../modeloAbstractoDB.php');
	class Historial extends ModeloAbstractoDB {
		public $Cliente_Codi;
		public $Cliente_Nom;
		public $Documento;
		public $Emple_Codi;
		public $Emple_Nomb;
		public $Trata_Codi;
		
		function __construct() {
			//$this->db_name = '';
		}
		
		public function getCLIENTE_CODI(){
			return $this->Cliente_Codi;
		}

		public function getCLIENTE_NOM(){
			return $this->Cliente_Nom;
		}
		
		public function getDOCUMENTO(){
			return $this->Documento;
		}

		public function getEmple_Codi(){
			return $this->Emple_Codi;
		}

		public function getEMPLE_NOMB(){
			return $this->Emple_Nomb;
		}

		public function getTRATA_CODI(){
			return $this->Trata_Codi;
		}

		public function consultar($Trata_Codi='') {
			if($Trata_Codi != ''):
				$this->query = "
				SELECT Trata_Codi, Trata_Nom, Trata_Valor
				FROM tb_tratamientos
				WHERE Trata_Codi = '$Trata_Codi'
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
			SELECT Trata_Codi, Trata_Nomb, Trata_Valor, m.Cliente_Codi, d.Cliente_Nom
			FROM tb_tratamientos as m inner join tb_clientes as d
			ON (m.Cliente_Codi = d.Cliente_Codi) ORDER BY m.Trata_Nomb
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function listaMunicipio() {
			$this->query = "
			SELECT Trata_Codi, Trata_Nomb, Cliente_Codi
			FROM tb_tratamientos as m order by Trata_Nomb
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		

		public function nuevo($datos=array()) {
			if(array_key_exists('Trata_Codi', $datos)):
				//$datos = utf8_string_array_encode($datos);
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$Trata_Nomb= utf8_decode($Trata_Nomb);
				$this->query = "
				INSERT INTO tb_tratamientos
				(Trata_Codi, Trata_Nomb, Cliente_Codi)
				VALUES
				('$Trata_Codi','$Trata_Nomb', '$Cliente_Codi')
				";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}

		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$Trata_Nomb= utf8_decode($Trata_Nomb);
			$this->query = "
			UPDATE tb_tratamientos
			SET Trata_Nomb='$Trata_Nomb',
			Cliente_Codi='$Cliente_Codi'
			WHERE Trata_Codi = '$Trata_Codi'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($Trata_Codi='') {
			$this->query = "
			DELETE FROM tb_tratamientos
			WHERE Trata_Codi = '$Trata_Codi'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>