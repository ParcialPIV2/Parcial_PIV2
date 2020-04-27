<?php
    require_once("../modeloAbstractoDB.php");
    class Clientes extends ModeloAbstractoDB {
		private $Cliente_Codi;
		private $Cliente_Nom;
		private $Docu_Codi;
		
		function __construct() {
			//$this->db_name = '';
		}

		public function getCliente_Codi(){
			return $this->Cliente_Codi;
		}

		public function getCliente_Nom(){
			return $this->Cliente_Nom;
		}
		
		public function getDocu_Codi(){
			return $this->Docu_Codi;
		}

		public function consultar($Cliente_Codi='') {
			if($Cliente_Codi !=''):
				$this->query = "
				SELECT Cliente_Codi, Cliente_Nom, Docu_Codi
				FROM tb_cliente
				WHERE Cliente_Codi = '$Cliente_Codi' order by Cliente_Codi
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
			SELECT Cliente_Codi, Cliente_Nom, m.Docu_Nomb
			FROM tb_cliente as c inner join tb_municipio as m
			ON (c.Docu_Codi = m.Docu_Codi) order by Cliente_Codi
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('Cliente_Codi', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$Cliente_Nom= utf8_decode($Cliente_Nom);
				$this->query = "
					INSERT INTO tb_cliente
					(Cliente_Codi, Cliente_Nom, Docu_Codi)
					VALUES
					(NULL, '$Cliente_Nom', '$Docu_Codi')
					";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$Cliente_Nom= utf8_decode($Cliente_Nom);
			$this->query = "
			UPDATE tb_cliente
			SET Cliente_Nom='$Cliente_Nom',
			Docu_Codi='$Docu_Codi'
			WHERE Cliente_Codi = '$Cliente_Codi'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($Cliente_Codi='') {
			$this->query = "
			DELETE FROM tb_cliente
			WHERE Cliente_Codi = '$Cliente_Codi'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>