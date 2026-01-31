<?php

if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once("config.php");
require_once("controller/app.php");
require_once("controller/clientes.php");
require_once("controller/facturas.php");
require_once("controller/factura_lineas.php");
require_once("controller/articulos.php");
require_once("controller/recibos.php");

$controlador = '';
if (isset($_GET['c'])) :
    $controlador = $_GET['c'];

    $metodo = '';
    if (isset($_GET['m']))
        $metodo = $_GET['m'];

    switch ($controlador):
        case 'clientes':
            if (method_exists('ClientesControlador', $metodo)) :
                ClientesControlador::{$metodo}();
            else:
                ClientesControlador::index();
            endif;
            break;

        case 'facturas':
            if (method_exists('FacturasControlador', $metodo)) :
                FacturasControlador::{$metodo}();
            else:
                FacturasControlador::index();
            endif;
            break;

        case 'factura_lineas':
            if (method_exists('FacturaLineasControlador', $metodo)) :
                FacturaLineasControlador::{$metodo}();
            else:
                FacturaLineasControlador::index();
            endif;
            break;

        case 'articulos':
            if (method_exists('ArticulosControlador', $metodo)) :
                ArticulosControlador::{$metodo}();
            else:
                ArticulosControlador::index();
            endif;
            break;

            case 'recibos':
            if (method_exists('RecibosControlador', $metodo)) :
                RecibosControlador::{$metodo}();
            else:
                RecibosControlador::index();
            endif;
            break;

        default:
            AppControlador::index();
    endswitch;

else :
    AppControlador::index();
endif;
