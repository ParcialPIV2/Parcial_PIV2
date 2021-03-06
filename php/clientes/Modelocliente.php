<?php
	
	require_once('../modeloAbstractoDB.php');
	class Clientes extends ModeloAbstractoDB {
		public $Cliente_Codi;
		public $Cliente_Nom;
		public $Cliente_Apell;
		public $Documento;
		public $Docu_Codi;
		public $Cliente_Email;
		public $Cliente_Cel;
		public $Cliente_Direc;
		
		function __construct() {
			
		}
		
		public function getCLIENTE_CODI(){
			return $this->Cliente_Codi;
		}

		public function getCLIENTE_NOM(){
			return $this->Cliente_Nom;
		}

		public function getCLIENTE_APELL(){
			return $this->Cliente_Apell;
		}

		public function getDOCUMENTO(){
			return $this->Documento;
		}

		
		public function getDOCU_CODI(){
			return $this->Docu_Codi;
		}

		public function getCLIENTE_EMAIL(){
			return $this->Cliente_Email;
		}
		public function getCLIENTE_DIREC(){
			return $this->Cliente_Direc;
		}

		public function getCLIENTE_CEL(){
			return $this->Cliente_Cel;
		}
		public function consultar($Cliente_Codi='') {
			if($Cliente_Codi != ''):
				$this->query = "
				SELECT Cliente_Codi,Cliente_Nom,Cliente_Apell,Documento,Cliente_Cel, Cliente_Direc,Cliente_Email,Cliente_Codi
				FROM tb_cliente
				WHERE Cliente_Codi = '$Cliente_Codi'
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
			SELECT Cliente_Codi, Cliente_Nom, Cliente_Apell,Documento,Cliente_Cel, Cliente_Direc,Cliente_Email, p.Docu_Codi
			FROM tb_cliente as m inner join tb_tipo_documento as p
			ON (m.Docu_Codi = p.Docu_Codi) ORDER BY m.Cliente_Nom
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function listaclientes() {
			$this->query = "
			SELECT Cliente_Codi, Cliente_Nom,Cliente_Apell,Documento,Cliente_Cel, Cliente_Direc,Cliente_Email
			FROM tb_cliente as d order by Cliente_Nom
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('Cliente_Codi', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				INSERT INTO tb_cliente
				(Cliente_Codi, Cliente_Nom, Docu_Codi,Cliente_Apell,Documento,Cliente_Cel, Cliente_Direc,Cliente_Email)
				VALUES
				('$Cliente_Codi','$Cliente_Nom', '$Docu_Codi','$Cliente_Apell', '$Documento', '$Cliente_Cel', '$Cliente_Direc','$Cliente_Email')
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
			UPDATE tb_cliente
			SET Cliente_Nom='$Cliente_Nom', Cliente_Apell='$Cliente_Apell',Docu_Codi='$Docu_Codi',Documento='$Documento', Cliente_Cel='$Cliente_Cel',Cliente_Direc='$Cliente_Direc',Cliente_Email='$Cliente_Email'
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