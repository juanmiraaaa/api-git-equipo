<?php
require_once("bd.php");

class RecibosModelo extends BD {
	// Campos de la tabla.
	public $recibo_id;
	public $factura_id;
	public $fecha;
	public $importe;
	public $filas = null;

	public function Insertar() {
		$sql = "INSERT INTO recibos VALUES (default, '$this->factura_id', '$this->fecha', '$this->importe')";
		return $this->_ejecutar($sql);
	}

	public function Modificar() {
		$sql = "UPDATE recibos SET recibo_id='factura_id='$this->factura_id', fecha='$this->fecha', importe='$this->importe' WHERE recibo_id=$this->recibo_id";
		return $this->_ejecutar($sql);
	}

	public function Borrar() {
		$sql = "DELETE FROM recibos WHERE recibo_id=$this->recibo_id";
		return $this->_ejecutar($sql);
	}

	public function Seleccionar() {
		$sql = 'SELECT * FROM recibos';

		// Si me han pasado un id, obtenemos solo el registro indicado.
		if ($this->recibo_id != 0) {
			$sql .= " WHERE id=$this->recibo_id";
		}

		$this->filas = $this->_consultar($sql);

		if ($this->filas == null) {
			return false;
		}

		if ($this->recibo_id != 0) {
			// Guardamos los campos en las propiedades.
			$this->factura_id = $this->filas[0]->factura_id;
			$this->fecha = $this->filas[0]->fecha;
			$this->importe = $this->filas[0]->importe;
		}

		return true;
	}
}
?>