<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("model/recibos.php");

class RecibosControlador
{
    /** Muestra la lista de clientes */
    static function index()
    {
        $recibos = new RecibosModelo();
        $recibos->Seleccionar();

        require_once("view/recibos.php");
    }

    /** Formulario para nuevo cliente */
    static function Nuevo()
    {
        $recibos = new RecibosModelo();
        $recibos->Seleccionar();
        $facturas = new FacturasModelo(); // Modelo
        $facturas->Seleccionar();

        $opcion = 'NUEVO'; // Opción de insertar un cliente
        require_once("view/recibosmantenimiento.php");
    }

    /** Inserta un nuevo cliente */
    static function Insertar()
    {
        $recibos = new RecibosModelo();
        $recibos->factura_id = $_POST['factura_id'];
        $recibos->fecha  = $_POST['fecha'];
        $recibos->importe  = $_POST['importe'];

        if ($recibos->Insertar() == 1) {
            header("Location: " . URLSITE . '?c=recibos');
            exit;
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $recibos->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }

    /** Edita un cliente existente */
    static function Editar()
    {
        $facturas = new FacturasModelo(); // Modelo
        $facturas->Seleccionar();
        $recibos = new RecibosModelo();
        $recibos->recibo_id = $_GET['recibo_id'];
        $opcion = 'EDITAR'; // Opción de modificar un cliente

        if ($recibos->Seleccionar()) {
            require_once("view/recibosmantenimiento.php");
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $recibos->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }

    /** Modifica los datos del cliente */
    static function Modificar()
    {
        $recibos = new FacturasModelo();
        $recibos->cliente_id = $_GET['cliente_id'];
        $recibos->numero = $_POST['numero'];
        $recibos->fecha  = $_POST['fecha'];

        // Si no hay cambios, Modificar puede devolver 0, por lo que solo mostramos error si realmente hay uno
        if (($recibos->Modificar() == 1) || ($recibos->GetError() == '')) {
            header("Location: " . URLSITE . '?c=facturas');
            exit;
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $recibos->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }

    /** Borra una factura */
    static function Borrar()
    {
        $recibos = new RecibosModelo();
        $recibos->recibo_id = $_GET['recibo_id'];

        if ($recibos->Borrar() == 1) {
            header("Location: " . URLSITE . '?c=facturas');
            exit;
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $recibos->GetError();
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
    static function Exportar()
    {

        // Nos creamos el objeto clientes para acceder
        // a la tabla clientes de la BBDD
        $recibos = new RecibosModelo();

        // Seleccionamos todos los clientes
        $recibos->Seleccionar();

        try {
            // Abirmos el fichero clientes.csv en modo escritura
            $fichero = fopen("facturas.csv", "w");

            // Para cada fila de la tabla
            foreach ($recibos->filas as $fila) {
                // Creamos la linea a exportar y
                $cadena = "$fila->id#$fila->cliente_id#$fila->numero#$fila->fecha\n";

                // Guardamos la línea en el fichero
                fputs($fichero, $cadena);
            }
        } finally {
            // Cerramos el fichero
            fclose($fichero);
        }

        // Finalmente exportamos el fichero
        $rutaFichero = 'recibos.csv';
        $fichero = basename($rutaFichero);

        header("Content-Type: application/octet-stream");
        header("Content-Length: " . filesize($rutaFichero));
        header("Content-Disposition: attachment; filename=$fichero");

        readfile($rutaFichero);
    }
}
