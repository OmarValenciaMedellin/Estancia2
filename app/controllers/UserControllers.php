<?php

include_once "config/db_connection.php";
include_once "app/models/UserModel.php";

class UserController {

    private $model;

    public function __construct($connection){
        $this->model = new UserModel($connection);
    }

    // ----------------- VENDEDOR -----------------
    public function insertarVendedor(){
        if (isset($_POST['registro'])) {
            $nombre    = trim($_POST['nombre']);
            $apellido  = trim($_POST['apellido']);
            $matricula = trim($_POST['matricula']);
            $cargo     = trim($_POST['cargo']);
            $correo    = trim($_POST['correo']);
            $pass      = $_POST['pass'];

            $this->model->insertarVendedor($nombre, $apellido, $matricula, $cargo, $correo, $pass);
            header("Location: index.php?action=insertVendedor");
            exit;
        }
        include_once "app/views/RegistroVendedor.php";
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['nombre']) && !empty($_POST['pass'])) {
                $nombre = trim($_POST['nombre']);
                $pass   = trim($_POST['pass']);
                $insert = $this->model->obtenerUsuario($nombre);

                if ($insert) {
                    if ($insert['pass'] == $pass) {
                        session_start();

                        $cargoDB = $insert['Cargo'] ?? $insert['Cargo'] ?? '';

                        switch($cargoDB){
                            case 'vendedor':
                            case 'Vendedor':
                                $_SESSION['Cargo'] = 'vendedor';
                                header("Location: index.php?action=inicioVendedor");
                                break;

                            case 'Administrador':
                            case 'administrador':
                                $_SESSION['Cargo'] = 'administrador';
                                header("Location: index.php?action=inicio");
                                break;

                            default:
                                $_SESSION['Cargo'] = 'vendedor';
                                header("Location: index.php?action=inicioVendedor");
                                break;
                        }
                        exit;
                    } else {
                        echo "<h3 style='color:red;text-align:center;'>Contraseña incorrecta.</h3>";
                    }
                } else {
                    echo "<h3 style='color:red;text-align:center;'>Usuario no encontrado.</h3>";
                }
            } else {
                echo "<h3 style='color:red;text-align:center;'>Completa usuario y contraseña.</h3>";
            }
        }
        include "app/views/InicioSesion.php";
    }

    public function Inicio(){ include "app/views/InicioSesion.php"; }
    public function catalogo(){ include "app/views/Catalogo.php"; }

    public function inicioVendedor(){
        include "app/views/PaginaPrincipalVendedor.php";
    }

    // ----------------- CLIENTE -----------------
    public function insertarCliente(){
        if (isset($_POST['registroCliente'])) {
            $nombre   = trim($_POST['nombre']);
            $apellido = trim($_POST['apellido']);
            $telefono = trim($_POST['telefono']);
            $correo   = trim($_POST['correo']);

            $this->model->insertarCliente($nombre, $apellido, $telefono, $correo);
            header("Location: index.php?action=insertCliente");
            exit;
        }
        include_once "app/views/RegistroCliente.php";
    }

    public function insertarCliente2(){
        if (isset($_POST['registroCliente'])) {
            $nombre   = trim($_POST['nombre']);
            $apellido = trim($_POST['apellido']);
            $telefono = trim($_POST['telefono']);
            $correo   = trim($_POST['correo']);

            $this->model->insertarCliente2($nombre, $apellido, $telefono, $correo);
            header("Location: index.php?action=consultCliente");
            exit;
        }
        include_once "app/views/RegistroCliente2.php";
    }

    public function consultarCliente(){
        $clientes = $this->model->consultarCliente();
        include "app/views/GestionCliente.php";
    }

    public function actualizarCliente(){
        if(isset($_GET['id']) && is_numeric ($_GET['id'])){
            $id_Cliente = (int) $_GET['id'];
            $row = $this->model->consultarPorID($id_Cliente);

            if (!$row) {
                echo "<h3 style='color:red;text-align:center;'>Cliente no encontrado.</h3>";
                include "app/views/GestionCliente.php";
                return;
            }
            include_once "app/views/EditarCliente.php";
            return;
        }

        if (isset($_POST['editar'])) {
            $id_Cliente = isset($_POST['id_Cliente']) ? (int) $_POST['id_Cliente'] : 0;
            $nombre   = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $telefono = $_POST['telefono'];
            $correo   = $_POST['correo'];

            $ok = $this->model->actualizarClientes($id_Cliente, $nombre, $apellido, $telefono, $correo);
            if ($ok) {
                header('Location: index.php?action=consultCliente');
            } else {
                header('Location: index.php?action=actuCliente&id='.$id_Cliente.'&error=1');
            }
            exit;
        }

        include "app/views/EditarCliente.php";
    }

    public function eliminarCliente(){
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id_Cliente = (int) $_GET['id'];
            $result = $this->model->eliminarCliente($id_Cliente);

            if ($result === true) {
                header('Location: index.php?action=consultCliente&deleted=1');
                exit;
            } else {
                echo "<h3 style='color:red;text-align:center;'>Error al eliminar cliente: $result</h3>";
            }
        } else {
            echo "<h3 style='color:red;text-align:center;'>No se recibió un ID válido de cliente.</h3>";
        }
    }

    // ----------------- VENDEDOR CRUD -----------------
    public function consultarVendedor(){
        $vendedor = $this->model->consultarVendedor();
        include "app/views/GestionVendedor.php";
    }

    public function actualizarVendedor(){
        if(isset($_GET['id']) && is_numeric ($_GET['id'])){
            $id_Usuario = (int) $_GET['id'];
            $row = $this->model->consultarPorIDVen($id_Usuario);

            if (!$row) {
                echo "<h3 style='color:red;text-align:center;'>Vendedor no encontrado.</h3>";
                include "app/views/GestionVendedor.php";
                return;
            }
            include_once "app/views/EditarVendedor.php";
            return;
        }

        if (isset($_POST['editar'])) {
            $id_Usuario = isset($_POST['id_Usuario']) ? (int) $_POST['id_Usuario'] : 0;

            $nombre     = $_POST['Nombre'];
            $apellido   = $_POST['Apellido'];
            $matricula  = $_POST['Matricula'];
            $correo     = $_POST['Correo'];
            $contrasena = $_POST['pass'];

            $ok = $this->model->actualizarVendedor($id_Usuario, $nombre, $apellido, $matricula, $correo, $contrasena);
            if ($ok) {
                header('Location: index.php?action=consultVendedor');
            } else {
                header('Location: index.php?action=actuVendedor&id='.$id_Usuario.'&error=1');
            }
            exit;
        }

        include "app/views/EditarVendedor.php";
    }

    public function eliminarVendedor(){
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id_Usuario = (int) $_GET['id'];
            $result = $this->model->eliminarVendedor($id_Usuario);

            if ($result === true) {
                header('Location: index.php?action=consultVendedor&deleted=1');
                exit;
            } else {
                echo "<h3 style='color:red;text-align:center;'>Error al eliminar vendedor: $result</h3>";
            }
        } else {
            echo "<h3 style='color:red;text-align:center;'>No se recibió un ID válido de vendedor.</h3>";
        }
    }

    // ----------------- MATERIALES -----------------
    public function consultarMaterial(){
        $materiales = $this->model->consultarMaterial();
        include "app/views/RegistroMaterial.php";
    }

    public function insertarMaterial(){
        if (isset($_POST['registroMaterial'])) {
            $Nombre       = trim($_POST['Nombre']);
            $Categoria    = trim($_POST['Categoria']);
            $UnidadMedida = trim($_POST['UnidadMedida']);
            $Costo        = (float)$_POST['Costo'];
            $Cantidad     = (int)$_POST['Cantidad'];
            $Descripcion  = trim($_POST['Descripcion']);

            $this->model->insertarMaterial($Nombre, $Categoria, $UnidadMedida, $Costo, $Cantidad, $Descripcion);
            header("Location: index.php?action=consultMaterial");
            exit;
        }
        include_once "app/views/RegistroMaterial.php";
    }

    public function actualizarMaterial() {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id_material = (int)$_GET['id'];
            $row = $this->model->consultarPorIdMaterial($id_material);

            if (!$row) {
                header("Location: index.php?action=consultMaterial&error=not_found");
                exit;
            }
            include "app/views/EditarMaterial.php";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['id_material'])) {
                header("Location: index.php?action=consultMaterial&error=missing_id");
                exit;
            }

            $id_material   = (int)$_POST['id_material'];
            $Nombre        = $_POST['nombre'];
            $Categoria     = $_POST['Categoria'] ?? '';
            $UnidadMedida  = $_POST['UnidadMedida'] ?? '';
            $Costo         = (float) str_replace(',', '.', $_POST['Costo'] ?? '0');
            $Cantidad      = (int)($_POST['Cantidad'] ?? 0);
            $Descripcion   = $_POST['Descripcion'] ?? '';

            $this->model->actualizarMaterial($id_material, $Nombre, $Categoria, $UnidadMedida, $Costo, $Cantidad, $Descripcion);
            header("Location: index.php?action=consultMaterial");
            exit;
        }

        exit;
    }

    public function eliminarMaterial(){
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id_material = (int) $_GET['id'];
            $result = $this->model->eliminarMaterial($id_material);
            header('Location: index.php?action=consultMaterial'.($result === true ? '&deleted=1' : '&error=1'));
            exit;
        } else {
            echo "<h3 style='color:red;text-align:center;'>No se recibió un ID válido de Material.</h3>";
        }
    }

    public function agregarStock() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_material    = isset($_POST['id_material']) ? (int)$_POST['id_material'] : 0;
            $cantidad_sumar = isset($_POST['cantidad_sumar']) ? (int)$_POST['cantidad_sumar'] : 0;

            $q    = isset($_POST['q']) ? trim($_POST['q']) : '';
            $page = (isset($_POST['page']) && is_numeric($_POST['page'])) ? (int)$_POST['page'] : 1;

            if ($id_material > 0 && $cantidad_sumar > 0) {
                $result = $this->model->aumentarStock($id_material, $cantidad_sumar);
                $suffix = ($result === true) ? '&stock_added=1' : '&error_stock=' . urlencode($result);
            } else {
                $suffix = '&error_stock=' . urlencode('Datos inválidos.');
            }

            $backToInventario = isset($_POST['from_inventario']) ? (bool)$_POST['from_inventario'] : false;
            if ($backToInventario) {
                header('Location: index.php?action=inventario&page='.$page.'&q='.urlencode($q).$suffix);
                exit;
            }

            header('Location: index.php?action=consultMaterial'.$suffix);
            exit;
        }

        header('Location: index.php?action=inventario&error_stock='.urlencode('Método no permitido'));
        exit;
    }

    // ----------------- REPORTE INVENTARIO -----------------
    public function inventario(){
        $q     = isset($_GET['q']) ? trim($_GET['q']) : '';
        $page  = (isset($_GET['page']) && is_numeric($_GET['page']) && (int)$_GET['page'] > 0) ? (int)$_GET['page'] : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $total       = $this->model->contarMaterialesReporte($q);
        $materiales  = $this->model->listarMaterialesReporte($q, $limit, $offset);
        $total_pages = max(1, (int)ceil($total / $limit));

        if (!function_exists('estadoStock')) {
            function estadoStock(int $cantidad): string {
                if ($cantidad <= 0) return 'Agotado';
                if ($cantidad <= 10) return 'Bajo';
                return 'Óptimo';
            }
        }

        include "app/views/Inventario.php";
    }

    // =====================================================
    //  HELPER UNICO PARA ARMAR DATA DE COTIZACION
    // =====================================================
    private function buildCotizacionDataFromSession(): ?array {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $cot = $_SESSION['cotizacion'] ?? null;

        if (
            !$cot ||
            empty($cot['cliente_id']) ||
            empty($cot['detalles'])
        ) {
            return null;
        }

        return [
            'id_Cliente' => $cot['cliente_id'],
            'fecha'      => $cot['fecha'] ?? date('Y-m-d'),
            'subtotal'   => (float)$cot['subtotal'],
            'descuento'  => (float)($cot['descuento_monto'] ?? 0),
            'mano_obra'  => (float)($cot['mano_obra'] ?? 0),
            'impuestos'  => (float)($cot['impuestos_monto'] ?? 0),
            'total'      => (float)($cot['total'] ?? 0),
            'notas'      => $cot['notas'] ?? '',
            'detalles'   => $cot['detalles'],
        ];
    }

    // ----------------- COTIZACIÓN -----------------
    public function cotizacion() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $step = isset($_GET['step']) ? (int)$_GET['step'] : 1;

        switch ($step) {

            case 1:
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cliente_id'])) {
                    $id = (int)$_POST['cliente_id'];
                    $cliente = $this->model->consultarPorID($id);

                    if ($cliente) {
                        $_SESSION['cotizacion'] = [
                            'cliente_id' => $cliente['id_Cliente'],
                            'cliente'    => $cliente,
                        ];
                        header('Location: index.php?action=cotizacion&step=2');
                        exit;
                    }
                }

                $q = isset($_GET['q']) ? trim($_GET['q']) : '';
                $clientes = $this->model->buscarClientes($q);
                include "app/views/Coti1.php";
                break;

            case 2:
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_material'])) {

                    $ids        = $_POST['id_material'];
                    $anchos     = $_POST['ancho'];
                    $altos      = $_POST['alto'];
                    $cantidades = $_POST['cantidad'];

                    $detalles = [];
                    $subtotal = 0;
                    $errores  = [];

                    $n = count($ids);

                    for ($i = 0; $i < $n; $i++) {
                        $id_mat   = (int)$ids[$i];
                        $ancho_cm = (float)($anchos[$i] ?? 0);
                        $alto_cm  = (float)($altos[$i]  ?? 0);
                        $cant     = (int)($cantidades[$i] ?? 0);

                        if ($cant <= 0) continue;

                        $mat = $this->model->consultarPorIdMaterial($id_mat);
                        if (!$mat) continue;

                        $stock_disponible = (int)$mat['Cantidad'];

                        if ($cant > $stock_disponible) {
                            $errores[] = "No hay suficiente stock de {$mat['Nombre']}. Disponible: {$stock_disponible}, solicitado: {$cant}.";
                            continue;
                        }

                        $precio_unit = (float)$mat['Costo'];
                        $sub         = $precio_unit * $cant;

                        $detalles[] = [
                            'id_material'     => $id_mat,
                            'nombre'          => $mat['Nombre'],
                            'ancho_cm'        => $ancho_cm,
                            'alto_cm'         => $alto_cm,
                            'cantidad'        => $cant,
                            'precio_unitario' => $precio_unit,
                            'subtotal'        => $sub,
                        ];

                        $subtotal += $sub;
                    }

                    if (!empty($errores)) {
                        $_SESSION['cotizacion_error'] = implode("<br>", $errores);
                        header('Location: index.php?action=cotizacion&step=2');
                        exit;
                    }

                    if (empty($detalles)) {
                        $_SESSION['cotizacion_error'] = "No seleccionaste ningún material válido.";
                        header('Location: index.php?action=cotizacion&step=2');
                        exit;
                    }

                    $_SESSION['cotizacion']['detalles'] = $detalles;
                    $_SESSION['cotizacion']['subtotal'] = $subtotal;

                    unset(
                        $_SESSION['cotizacion']['descuento_porc'],
                        $_SESSION['cotizacion']['descuento_monto'],
                        $_SESSION['cotizacion']['impuestos_porc'],
                        $_SESSION['cotizacion']['impuestos_monto'],
                        $_SESSION['cotizacion']['mano_obra'],
                        $_SESSION['cotizacion']['notas'],
                        $_SESSION['cotizacion']['total']
                    );

                    header('Location: index.php?action=cotizacion&step=3');
                    exit;
                }

                $materiales = $this->model->consultarMaterial();
                include "app/views/Coti2.php";
                break;

            case 3:
                $cot = $_SESSION['cotizacion'] ?? null;
                if (!$cot || empty($cot['detalles'])) {
                    header('Location: index.php?action=cotizacion&step=2');
                    exit;
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $subtotal = (float)($cot['subtotal'] ?? 0);
                    $errores = [];

                    if (!isset($_POST['descuento']) || $_POST['descuento'] === '') {
                        $errores[] = "El descuento es obligatorio.";
                    }
                    $descuento_porc = (float)($_POST['descuento'] ?? 0);
                    if ($descuento_porc < 0 || $descuento_porc > 100) {
                        $errores[] = "El descuento debe estar entre 0 y 100.";
                    }

                    if (!isset($_POST['impuestos']) || $_POST['impuestos'] === '') {
                        $errores[] = "Los impuestos son obligatorios.";
                    }
                    $impuestos_porc = (float)($_POST['impuestos'] ?? 0);
                    if ($impuestos_porc < 0 || $impuestos_porc > 100) {
                        $errores[] = "Los impuestos deben estar entre 0 y 100.";
                    }

                    if (!isset($_POST['mano_obra']) || $_POST['mano_obra'] === '') {
                        $errores[] = "La mano de obra es obligatoria.";
                    }
                    $mano_obra = (float)($_POST['mano_obra'] ?? 0);
                    if ($mano_obra < 0) {
                        $errores[] = "La mano de obra no puede ser negativa.";
                    }

                    $notas = isset($_POST['notas']) ? trim($_POST['notas']) : '';

                    if (!empty($errores)) {
                        $_SESSION['cotizacion_error'] = implode("<br>", $errores);
                        header('Location: index.php?action=cotizacion&step=3');
                        exit;
                    }

                    $descuento_monto = $subtotal * ($descuento_porc / 100.0);
                    $base            = $subtotal - $descuento_monto + $mano_obra;
                    $impuestos_monto = $base * ($impuestos_porc / 100.0);
                    $total           = $base + $impuestos_monto;

                    $_SESSION['cotizacion']['descuento_porc']   = $descuento_porc;
                    $_SESSION['cotizacion']['descuento_monto']  = $descuento_monto;
                    $_SESSION['cotizacion']['impuestos_porc']   = $impuestos_porc;
                    $_SESSION['cotizacion']['impuestos_monto']  = $impuestos_monto;
                    $_SESSION['cotizacion']['mano_obra']        = $mano_obra;
                    $_SESSION['cotizacion']['notas']            = $notas;
                    $_SESSION['cotizacion']['total']            = $total;

                    header('Location: index.php?action=cotizacion&step=4');
                    exit;
                }

                include "app/views/Coti3.php";
                break;

            case 4:
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $data = $this->buildCotizacionDataFromSession();
                    if (!$data) {
                        $_SESSION['cotizacion_error'] = "No hay datos suficientes para guardar la cotización.";
                        header("Location: index.php?action=cotizacion&step=4");
                        exit;
                    }

                    $id_cot = $this->model->guardarCotizacion($data);

                    if ($id_cot !== false) {
                        unset($_SESSION['cotizacion']);
                        $_SESSION['cotizacion_ok'] = "La cotización #$id_cot se guardó correctamente.";
                        header("Location: index.php?action=cotizaciones");
                        exit;
                    } else {
                        $_SESSION['cotizacion_error'] = "Ocurrió un error al guardar la cotización.";
                        header("Location: index.php?action=cotizacion&step=4");
                        exit;
                    }
                }

                include "app/views/Coti4.php";
                break;
        }
    }

    // ----------------- LISTA PRINCIPAL COTIZACIONES -----------------
    public function cotizaciones() {
        $materiales   = $this->model->consultarMaterial();
        $cotizaciones = $this->model->listarCotizacionesConDetalles();
        require 'app/views/Cotizacion.php';
    }

    // =====================================================
    //  ACCIÓN ROUTER GUARDAR COTIZACIÓN (YA NO DUPLICA)
    // =====================================================
    public function guardarCotizacion() {

        $data = $this->buildCotizacionDataFromSession();

        if (!$data) {
            echo "No hay datos en sesión para guardar.";
            return;
        }

        try {
            $idCotizacion = $this->model->guardarCotizacion($data);

            if ($idCotizacion !== false) {
                unset($_SESSION['cotizacion']);
                header("Location: index.php?action=cotizaciones&saved=1");
                exit;
            }

            echo "Error al guardar la cotización.";

        } catch (Exception $e) {
            echo "Error al guardar la cotización: " . $e->getMessage();
        }
    }

    public function eliminarCotizacion() {

        $id = $_GET['id'] ?? null;

        if (!$id) {
            header("Location: index.php?action=cotizaciones");
            exit;
        }

        try {
            $this->model->eliminarCotizacionConStock($id);
            header("Location: index.php?action=cotizaciones&deleted=1");
            exit;
        } catch (Exception $e) {
            echo "Error al eliminar: " . $e->getMessage();
        }
    }

    // ----------------- RESPALDO BD -----------------
    public function realizarRespaldoBD(){
        $server = "localhost";
        $user = "root";
        $password = "";
        $db = "bonanza_cotizaciones";

        $ruta = $this->model->backup_tables($server, $user, $password, $db);
        $fecha = date("Y-m-d");

        header("Content-disposition: attachment; filename=db-backup-".$fecha.".sql");
        header("Content-type: application/sql");

        readfile($ruta);
        exit;
    }

    public function restaurarBD(){
        $fecha = date("Y-m-d");
        $ruta  = "config/backups/db-backup-" . $fecha . ".sql";

        $mensaje = $this->model->restaurarBD($ruta);

        echo "<h2>$mensaje</h2>";
    }

}
