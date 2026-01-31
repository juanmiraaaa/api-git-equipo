<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("model/facturas.php");

class FacturasControlador
{
    /** Muestra la lista de clientes */
    static function index()
    {
        $facturas = new FacturasModelo();
        $facturas->Seleccionar();

        require_once("view/facturas.php");
    }

    /** Formulario para nuevo cliente */
    static function Nuevo()
    {
        $clientes = new ClientesModelo();

        $clientes->Seleccionar();

        $opcion = 'NUEVO'; // Opción de insertar un cliente
        require_once("view/facturasmantenimiento.php");
    }

    /** Inserta un nuevo cliente */
    static function Insertar()
    {
        $facturas = new FacturasModelo();
        $facturas->cliente_id = $_POST['cliente_id'];
        $facturas->numero  = $_POST['numero'];
        $facturas->fecha  = $_POST['fecha'];
     
        if ($facturas->Insertar() == 1) {
            header("Location: " . URLSITE . '?c=facturas');
            exit;
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $facturas->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }

    /** Edita un cliente existente */
    static function Editar()
    {
        $facturas = new FacturasModelo();
        $facturas->id = $_GET['id'];
        $opcion = 'EDITAR'; // Opción de modificar un cliente

        if ($facturas->Seleccionar()) {
            require_once("view/facturasmantenimiento.php");
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $facturas->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }

    /** Modifica los datos del cliente */
    static function Modificar()
    {
        $facturas = new FacturasModelo();
        $facturas->cliente_id = $_GET['cliente_id'];
        $facturas->numero = $_POST['numero'];
        $facturas->fecha  = $_POST['fecha'];
  
        // Si no hay cambios, Modificar puede devolver 0, por lo que solo mostramos error si realmente hay uno
        if (($facturas->Modificar() == 1) || ($facturas->GetError() == '')) {
            header("Location: " . URLSITE . '?c=facturas');
            exit;
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $facturas->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }

    /** Borra una factura */
    static function Borrar()
    {
        $facturas = new FacturasModelo();
        $facturas->id = $_GET['id'];

        if ($facturas->Borrar() == 1) {
            header("Location: " . URLSITE . '?c=facturas');
            exit;
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $facturas->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }
/*
    function porCliente()
    {
        $cliente_id = $_GET['id'];
        $facturas = new FacturasModelo();
        $facturas->SeleccionarPorCliente($cliente_id);
        require_once("view/facturas.php");
    }

    function verLineas()
    {
        $id_factura = $_GET['id'];
        $lineas = new LineasFacturaModelo();
        $lineas->factura_id = $id_factura;
        $lineas->SeleccionarPorFactura();
        require_once("view/lineas_factura.php");
    }
*/
    static function Exportar() {

        // Nos creamos el objeto clientes para acceder
        // a la tabla clientes de la BBDD
        $facturas = new FacturasModelo();

        // Seleccionamos todos los clientes
        $facturas->Seleccionar();

        try {
            // Abirmos el fichero clientes.csv en modo escritura
            $fichero = fopen("facturas.csv", "w");

            // Para cada fila de la tabla
            foreach($facturas->filas as $fila) {
                // Creamos la linea a exportar y
                $cadena = "$fila->id#$fila->cliente_id#$fila->numero#$fila->fecha\n";
            
                // Guardamos la línea en el fichero
                fputs($fichero, $cadena);
            } 
        }
        finally {
            // Cerramos el fichero
            fclose($fichero);
        }

        // Finalmente exportamos el fichero
        $rutaFichero = 'facturas.csv';
        $fichero = basename($rutaFichero);

        header("Content-Type: application/octet-stream");
        header("Content-Length: " . filesize($rutaFichero));
        header("Content-Disposition: attachment; filename=$fichero");

        readfile($rutaFichero);
    }
}