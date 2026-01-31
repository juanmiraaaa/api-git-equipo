<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("model/clientes.php");

require_once("controller/crypt.php");

require_once("pdfs/clientes.php");

class ClientesControlador
{
    /** Muestra la lista de clientes */
    static function index()
    {
        $clientes = new ClientesModelo();
        $clientes->Seleccionar();

        require_once("view/clientes.php");
    }

    /** Formulario para nuevo cliente */
    static function Nuevo()
    {
        $opcion = 'NUEVO'; // Opción de insertar un cliente
        require_once("view/clientesmantenimiento.php");
    }

    /** Inserta un nuevo cliente */
    static function Insertar()
    {
        $cliente = new ClientesModelo();
        $cliente->nombre = $_POST['nombre'];
        $cliente->email  = $_POST['email'];
        $cliente->apellidos  = $_POST['apellidos'];
        $cliente->password  = Crypt::Encriptar($_POST['password']);
        $cliente->direccion  = $_POST['direccion'];
        $cliente->cp  = $_POST['cp'];
        $cliente->poblacion  = $_POST['poblacion'];
        $cliente->provincia  = $_POST['provincia'];
        $cliente->fechaNac  = $_POST['fechaNac'];
        $cliente->formaPago  = $_POST['formaPago'];

        if ($cliente->Insertar() == 1) {
            header("Location: " . URLSITE . '?c=clientes');
            exit;
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }

    /** Edita un cliente existente */
    static function Editar()
    {
        $cliente = new ClientesModelo();
        $cliente->id = $_GET['id'];
        $opcion = 'EDITAR'; // Opción de modificar un cliente

        if ($cliente->Seleccionar()) {
            require_once("view/clientesmantenimiento.php");
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }

    /** Modifica los datos del cliente */
    static function Modificar()
    {
        $cliente = new ClientesModelo();
        $cliente->id     = $_GET['id'];
        $cliente->nombre = $_POST['nombre'];
        $cliente->email  = $_POST['email'];
        $cliente->apellidos  = $_POST['apellidos'];
        $cliente->password  = $_POST['password'];
        $cliente->direccion  = $_POST['direccion'];
        $cliente->cp  = $_POST['cp'];
        $cliente->poblacion  = $_POST['poblacion'];
        $cliente->provincia  = $_POST['provincia'];
        $cliente->fechaNac  = $_POST['fechaNac'];
        $cliente->formaPago  = $_POST['formaPago'];

        // Si no hay cambios, Modificar puede devolver 0, por lo que solo mostramos error si realmente hay uno
        if (($cliente->Modificar() == 1) || ($cliente->GetError() == '')) {
            header("Location: " . URLSITE . '?c=clientes');
            exit;
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }

    /** Borra un cliente */
    static function Borrar()
    {
        $cliente = new ClientesModelo();
        $cliente->id = $_GET['id'];

        if ($cliente->Borrar() == 1) {
            header("Location: " . URLSITE . '?c=clientes');
            exit;
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("Location: " . URLSITE . "view/error.php");
            exit;
        }
    }

    static function Exportar() {

        // Nos creamos el objeto clientes para acceder
        // a la tabla clientes de la BBDD
        $clientes = new ClientesModelo();

        // Seleccionamos todos los clientes
        $clientes->Seleccionar();

        try {
            // Abirmos el fichero clientes.csv en modo escritura
            $fichero = fopen("clientes.csv", "w");

            // Para cada fila de la tabla
            foreach($clientes->filas as $fila) {
                // Creamos la linea a exportar y
                $cadena = "$fila->id#$fila->nombre#$fila->email#$fila->apellidos#$fila->password#$fila->direccion#$fila->cp#$fila->poblacion#$fila->provincia#$fila->fechaNac\n";
            
                // Guardamos la línea en el fichero
                fputs($fichero, $cadena);
            } 
        }
        finally {
            // Cerramos el fichero
            fclose($fichero);
        }

        // Finalmente exportamos el fichero
        $rutaFichero = 'clientes.csv';
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
        $clientes = new ClientesModelo();
 
        // Seleccionamos todos los clientes.
        $clientes->Seleccionar();
 
        // Creamos el PDF de clientes.
        $pdf = new ClientesPDF();
 
        // Añadimos un página.
        $pdf->AddPage();
 
        // Indicamos el tamaño de letra.
        $pdf->SetFont('Arial','',14);
 
        // Establecemos el tamaño de cada celda.
        $pdf->SetWidths(array(75,75,40));
 
        // Pasamos la filas obtenidas.
        $pdf->filas = $clientes->filas;
       
        // Imprimirmos
        $pdf->Imprimir();
       
        // Mostramos
        $pdf->Output();
    }
}


