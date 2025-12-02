<?php

// Llamar al controlador y conexión
include_once "app/controllers/UserControllers.php";
include_once "app/controllers/reportController.php";
include_once "config/db_connection.php";

$controller = new UserController($connection);

// Validar la accion desde la ruta
if (isset($_GET['action'])) {

    $action = $_GET['action'];

    // Dependiendo de la acción se ejecuta un método diferente
    switch ($action) {

        case 'insertVendedor':
            $controller->insertarVendedor();
            break;

        case 'insertCliente':
            $controller->insertarCliente();
            break;

        case 'insertCliente2':
            $controller->insertarCliente2();
            break;

        case 'consultCliente':
            $controller->consultarCliente();
            break;

        case 'actuCliente':
            $controller->actualizarCliente();
            break;

        case 'actuMaterial':
            $controller->actualizarMaterial();
            break;

        case 'deleteCliente':
            $controller->EliminarCliente();
            break;

        case 'deleteMaterial':
            $controller->eliminarMaterial();
            break;

        case 'consultVendedor':
            $controller->consultarVendedor();
            break;

        case 'GestionCliente':
            include "app/views/GestionCliente.php";
            break;

        case 'actuVendedor':
            $controller->actualizarVendedor();
            break;

        case 'deleteVendedor':
            $controller->eliminarVendedor();
            break;

        case 'insertMaterial':
            $controller->insertarMaterial();
            break;

        case 'consultMaterial':
            $controller->consultarMaterial();
            break;

        case 'login':
            $controller->login();
            break;

        case 'inventario':
            $controller->inventario();
            break;

        case 'agregarStock':
            $controller->agregarStock();
            break;

        case 'cotizaciones': // LISTA principal
            $controller->cotizaciones();
            break;

        case 'cotizacion':
            $controller->cotizacion();
            break;

        case 'guardarCotizacion':
            $controller->guardarCotizacion();
            break;
        case "pdfClientesMasCotizaciones":
            $controller = new reportController($connection);
            $controller->pdfClientesMasCotizaciones();
            break;
        case 'eliminarCotizacion':
            $controller->eliminarCotizacion();
            break;

        case 'inicioVendedor':
            header("Location: index.php?action=cotizaciones");
            break;

        case 'inicio':
            include "app/views/PaginaPrincipal.php";
            break;

        case 'catalogo':
            include "app/views/Catalogo.php";
            break;

        case 'pdfCotizacion':
            include_once "app/controllers/reportController.php";
            $report = new reportController($connection);
            $report->pdfCotizacion($_GET['id']);
            break;

        case 'pdfGeneralCotizaciones':
            include_once "app/controllers/reportController.php";
            $reportController = new reportController($connection);
            $reportController->pdfGeneralCotizaciones();
            break;

        case 'pdfGraficaMateriales':
            include_once "app/controllers/reportController.php";
            $report = new reportController($connection);
            $report->pdfGraficaMateriales();
            break;

        case 'respaldoBD':
            $controller->realizarRespaldoBD();
            break;

        case 'restaurarBD':
            $controller->restaurarBD();
            break;

        default:
            include "app/views/RegistroCliente.php";
            break;
    }
}
