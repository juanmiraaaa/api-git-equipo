<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("model/articulos.php");

require_once("controller/crypt.php");

require_once("pdfs/articulos.php");

class ArticulosControlador
{
    /** Muestra la lista de clientes */
    static function index()
    {
        $articulos = new ArticulosModelo();
        $articulos->Seleccionar();

        require_once("view/articulos.php");
    }

    /** Formulario para nuevo cliente */
    static function Nuevo()
    {
        $opcion = 'NUEVO'; // Opción de insertar un cliente
        require_once("view/articulosmantenimiento.php");
    }

    /** Inserta un nuevo cliente */
    static function Insertar()
    {
        $articulo = new ArticulosModelo();
        $articulo->referencia = $_POST['referencia'];
        $articulo->descripcion  = $_POST['descripcion'];
        $articulo->precio  = $_POST['precio'];
        $articulo->iva  = $_POST['tipo_iva'];

        if ($articulo->Insertar() == 1) {
            header("Location: " . URLSITE . '?c=articulos');
            exit;
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $articulo->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }

    /** Edita un cliente existente */
    static function Editar()
    {
        $articulo = new ArticulosModelo();
        $articulo->id = $_GET['id'];
        $opcion = 'EDITAR'; // Opción de modificar un cliente

        if ($articulo->Seleccionar()) {
            require_once("view/articulosmantenimiento.php");
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $articulo->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }

    /** Modifica los datos del cliente */
    static function Modificar()
    {
        $articulo = new ArticulosModelo();
        $articulo->referencia = $_POST['referencia'];
        $articulo->descripcion  = $_POST['descripcion'];
        $articulo->precio  = $_POST['precio'];
        $articulo->iva  = $_POST['tipo_iva'];

        // Si no hay cambios, Modificar puede devolver 0, por lo que solo mostramos error si realmente hay uno
        if (($articulo->Modificar() == 1) || ($articulo->GetError() == '')) {
            header("Location: " . URLSITE . '?c=articulos');
            exit;
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $articulo->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }

    /** Borra un cliente */
    static function Borrar()
    {
        $articulo = new ClientesModelo();
        $articulo->id = $_GET['id'];

        if ($articulo->Borrar() == 1) {
            header("Location: " . URLSITE . '?c=articulos');
            exit;
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $articulo->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }


    static function Exportar() {

        // Nos creamos el objeto clientes para acceder
        // a la tabla clientes de la BBDD
        $articulos = new ClientesModelo();

        // Seleccionamos todos los clientes
        $articulos->Seleccionar();

        try {
            // Abirmos el fichero clientes.csv en modo escritura
            $fichero = fopen("articulos.csv", "w");

            // Para cada fila de la tabla
            foreach($articulos->filas as $fila) {
                // Creamos la linea a exportar y
                $cadena = "$fila->id#$fila->referencia#$fila->descripcion#$fila->precio#$fila->tipo_iva\n";
            
                // Guardamos la línea en el fichero
                fputs($fichero, $cadena);
            } 
        }
        finally {
            // Cerramos el fichero
            fclose($fichero);
        }

        // Finalmente exportamos el fichero
        $rutaFichero = 'articulos.csv';
        $fichero = basename($rutaFichero);

        header("Content-Type: application/octet-stream");
        header("Content-Length: " . filesize($rutaFichero));
        header("Content-Disposition: attachment; filename=$fichero");

        readfile($rutaFichero);
    }

   /* static function ExportarJSON() {
        <?php
            $json_profesores = file_get_contents('profesores.json');
            $json_decodificado = json_decode($json_profesores, true);
            $profesores = $json_decodificado['profesores'];
            foreach($profesores as $profesor)
            {
            $nombre = $profesor['nombre'];
            $email = $profesor['email'];
            echo 'Profesor: ' . $nombre . '. Email: ' . $email . '.<br>';
            $asignaturas = $profesor['asignaturas'];
            foreach($asignaturas as $asignatura)
            {
            echo 'Asignatura: ' . $asignatura['nombre'] . '. Ciclo: ' . $asignatura ['ciclo'] .
            '.<br>';
            }
            echo '<hr>';
            }
        ?>

    }*/


    static function Imprimir()
    {
        // Creamos el modelo de clientes.
        $articulos = new ArticulosModelo();
 
        // Seleccionamos todos los clientes.
        $articulos->Seleccionar();
 
        // Creamos el PDF de clientes.
        $pdf = new ArticulosPDF();
 
        // Añadimos un página.
        $pdf->AddPage();
 
        // Indicamos el tamaño de letra.
        $pdf->SetFont('Arial','',14);
 
        // Establecemos el tamaño de cada celda.
        $pdf->SetWidths(array(75,75,40));
 
        // Pasamos la filas obtenidas.
        $pdf->filas = $articulos->filas;
       
        // Imprimirmos
        $pdf->Imprimir();
       
        // Mostramos
        $pdf->Output();
    }
}


