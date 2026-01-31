<?php
require_once("bd.php");

class ArticulosModelo extends BD {
	// Campos de la tabla.
	public $id;
	public $referencia;
	public $descripcion;
	public $precio;
	public $iva;
	public $filas = null;

	public function Insertar() {
		$sql = "INSERT INTO articulos VALUES (default, '$this->referencia', '$this->descripcion', '$this->precio', '$this->iva')";
		return $this->_ejecutar($sql);
	}

	public function Modificar() {
		$sql = "UPDATE articulos SET referencia='$this->referencia', descripcion='$this->descripcion', precio='$this->precio', iva='$this->iva' WHERE id=$this->id";
		return $this->_ejecutar($sql);
	}

	public function Borrar() {
		$sql = "DELETE FROM articulos WHERE id=$this->id";
		return $this->_ejecutar($sql);
	}

	public function Seleccionar() {
		$sql = 'SELECT * FROM articulos';

		// Si me han pasado un id, obtenemos solo el registro indicado.
		if ($this->id != 0) {
			$sql .= " WHERE id=$this->id";
		}

		$this->filas = $this->_consultar($sql);

		if ($this->filas == null) {
			return false;
		}

		if ($this->id != 0) {
			// Guardamos los campos en las propiedades.
			$this->referencia = $this->filas[0]->referencia;
            $this->descripcion = $this->filas[0]->descripcion;
            $this->precio = $this->filas[0]->precio;
            $this->iva = $this->filas[0]->iva;
		}

		return true;
	}
}
?>