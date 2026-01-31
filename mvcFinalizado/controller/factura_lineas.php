<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("model/factura_lineas.php");

class FacturaLineasControlador
{
    /** Muestra la lista de lineas de factura */
    static function index()
    {
        $factura_lineas = new FacturaLineasModelo();
        $factura_lineas->Seleccionar();

        require_once("view/factura_lineas.php");
    }

    /** Formulario para nueva linea de factura */
    static function Nuevo()
    {

        $facturas = new FacturasModelo();
        $facturas->Seleccionar();

        $opcion = 'NUEVO'; // Opción de insertar una linea de factura
        require_once("view/factura_lineasmantenimiento.php");
    }

    /** Inserta un nuevo cliente */
    static function Insertar()
    {
        $factura_lineas = new FacturaLineasModelo();
        $factura_lineas->factura_id = $_POST['factura_id'];
        $factura_lineas->referencia  = $_POST['referencia'];
        $factura_lineas->descripcion  = $_POST['descripcion'];
        $factura_lineas->cantidad  = $_POST['cantidad'];
        $factura_lineas->precio  = $_POST['precio'];
        $factura_lineas->iva  = $_POST['iva'];
        $factura_lineas->importe  = $_POST['importe'];
        
        if ($factura_lineas->Insertar() == 1) {
            header("Location: " . URLSITE . '?c=factura_lineas');
            exit;
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $factura_lineas->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }

    /** Edita un cliente existente */
    static function Editar()
    {
        $factura_lineas = new FacturaLineasModelo();
        $factura_lineas->id = $_GET['id'];
        $opcion = 'EDITAR'; // Opción de modificar un cliente

        if ($factura_lineas->Seleccionar()) {
            require_once("view/factura_lineasmantenimiento.php");
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $factura_lineas->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }

    /** Modifica los datos del cliente */
    static function Modificar()
    {
        $factura_lineas = new FacturaLineasModelo();
        $factura_lineas->id     = $_GET['id'];
        $factura_lineas->factura_id = $_POST['factura_id'];
        $factura_lineas->referencia  = $_POST['referencia'];
        $factura_lineas->descripcion  = $_POST['descripcion'];
        $factura_lineas->cantidad  = $_POST['cantidad'];
        $factura_lineas->precio  = $_POST['precio'];
        $factura_lineas->iva  = $_POST['iva'];
        $factura_lineas->importe  = $_POST['importe'];

        // Si no hay cambios, Modificar puede devolver 0, por lo que solo mostramos error si realmente hay uno
        if (($factura_lineas->Modificar() == 1) || ($factura_lineas->GetError() == '')) {
            header("Location: " . URLSITE . '?c=factura_lineas');
            exit;
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $factura_lineas->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }
    static function Borrar()
    {
        $factura_lineas = new FacturaLineasModelo();
        $factura_lineas->id = $_GET['id'];

        if ($factura_lineas->Borrar() == 1) {
            header("Location: " . URLSITE . '?c=factura_lineas');
            exit;
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $factura_lineas->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }
}