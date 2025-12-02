<?php

// Incluye la conexión a la BD y el modelo
include_once "config/db_connection.php";
include_once "app/models/UserModel.php";

class UserController
{
    private $model; // Variable para usar el modelo

    public function __construct($connection)
    {
        // Crea el modelo con la conexión recibida
        $this->model = new UserModel($connection);
    }

    // ----------------- VENDEDOR -----------------

    public function insertarVendedor()
    {
        // Si el formulario de registro fue enviado
        if (isset($_POST['registro'])) {

            // Toma y limpia los datos del formulario
            $nombre    = trim($_POST['nombre']);
            $apellido  = trim($_POST['apellido']);
            $matricula = trim($_POST['matricula']);
            $cargo     = trim($_POST['cargo']);
            $correo    = trim($_POST['correo']);
            $pass      = $_POST['pass'];

            // Inserta el vendedor en la BD
            $this->model->insertarVendedor($nombre, $apellido, $matricula, $cargo, $correo, $pass);

            // Redirige después de guardar
            header("Location: index.php?action=insertVendedor");
            exit;
        }

        // Muestra la vista del registro
        include_once "app/views/RegistroVendedor.php";
    }

    public function login()
    {
        // Solo procesa si es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Verifica que vengan usuario y contraseña
            if (!empty($_POST['nombre']) && !empty($_POST['pass'])) {

                // Limpia datos recibidos
                $nombre = trim($_POST['nombre']);
                $pass   = trim($_POST['pass']);

                // Busca el usuario en la BD
                $insert = $this->model->obtenerUsuario($nombre);

                if ($insert) {

                    // Compara contraseñas
                    if ($insert['pass'] == $pass) {

                        // Inicia sesión
                        session_start();

                        // Obtiene el cargo del usuario
                        $cargoDB = $insert['Cargo'] ?? '';

                        // Redirige según el cargo
                        switch ($cargoDB) {

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

                            // Si no coincide, por defecto es vendedor
                            default:
                                $_SESSION['Cargo'] = 'vendedor';
                                header("Location: index.php?action=inicioVendedor");
                                break;
                        }

                        exit;

                    } else {
                        // Mensaje si contraseña no coincide
                        echo "<h3 style='color:red;text-align:center;'>Contraseña incorrecta.</h3>";
                    }

                } else {
                    // Mensaje si no existe el usuario
                    echo "<h3 style='color:red;text-align:center;'>Usuario no encontrado.</h3>";
                }

            } else {
                // Mensaje si no escribieron ambos campos
                echo "<h3 style='color:red;text-align:center;'>Completa usuario y contraseña.</h3>";
            }
        }

        // Muestra la vista de inicio de sesión
        include "app/views/InicioSesion.php";
    }

    // Carga vista de inicio de sesión
    public function Inicio()
    {
        include "app/views/InicioSesion.php";
    }

    // Carga catálogo
    public function catalogo()
    {
        include "app/views/Catalogo.php";
    }

    // Carga página principal del vendedor
    public function inicioVendedor()
    {
        include "app/views/PaginaPrincipalVendedor.php";
    }

    // ----------------- CLIENTE -----------------

    public function insertarCliente()
    {
        // Si el formulario de cliente fue enviado
        if (isset($_POST['registroCliente'])) {

            // Limpia datos
            $nombre   = trim($_POST['nombre']);
            $apellido = trim($_POST['apellido']);
            $telefono = trim($_POST['telefono']);
            $correo   = trim($_POST['correo']);

            // Inserta cliente
            $this->model->insertarCliente($nombre, $apellido, $telefono, $correo);

            // Redirige
            header("Location: index.php?action=insertCliente");
            exit;
        }

        // Muestra vista
        include_once "app/views/RegistroCliente.php";
    }

    public function insertarCliente2()
    {
        // Si el formulario fue enviado
        if (isset($_POST['registroCliente'])) {

            // Limpia datos
            $nombre   = trim($_POST['nombre']);
            $apellido = trim($_POST['apellido']);
            $telefono = trim($_POST['telefono']);
            $correo   = trim($_POST['correo']);

            // Inserta cliente (otra ruta)
            $this->model->insertarCliente2($nombre, $apellido, $telefono, $correo);

            // Redirige a consulta
            header("Location: index.php?action=consultCliente");
            exit;
        }

        // Muestra vista alterna
        include_once "app/views/RegistroCliente2.php";
    }

    public function consultarCliente()
    {
        // Obtiene todos los clientes
        $clientes = $this->model->consultarCliente();

        // Muestra vista de gestión
        include "app/views/GestionCliente.php";
    }

    public function actualizarCliente()
    {
        // Si viene ID por GET, se carga el formulario
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {

            $id_Cliente = (int) $_GET['id'];

            // Busca al cliente por ID
            $row = $this->model->consultarPorID($id_Cliente);

            if (!$row) {
                // Si no existe
                echo "<h3 style='color:red;text-align:center;'>Cliente no encontrado.</h3>";
                include "app/views/GestionCliente.php";
                return;
            }

            // Muestra formulario con datos
            include_once "app/views/EditarCliente.php";
            return;
        }

        // Si se envía el formulario de editar
        if (isset($_POST['editar'])) {

            // Recupera datos
            $id_Cliente = isset($_POST['id_Cliente']) ? (int) $_POST['id_Cliente'] : 0;
            $nombre     = $_POST['nombre'];
            $apellido   = $_POST['apellido'];
            $telefono   = $_POST['telefono'];
            $correo     = $_POST['correo'];

            // Actualiza en BD
            $ok = $this->model->actualizarClientes($id_Cliente, $nombre, $apellido, $telefono, $correo);

            // Redirige según resultado
            if ($ok) {
                header('Location: index.php?action=consultCliente');
            } else {
                header('Location: index.php?action=actuCliente&id=' . $id_Cliente . '&error=1');
            }

            exit;
        }

        // Si no hay nada, muestra vista por defecto
        include "app/views/EditarCliente.php";
    }

    public function eliminarCliente()
    {
        // Valida ID
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {

            $id_Cliente = (int) $_GET['id'];

            // Elimina cliente
            $result = $this->model->eliminarCliente($id_Cliente);

            if ($result === true) {
                // Redirige si sale bien
                header('Location: index.php?action=consultCliente&deleted=1');
                exit;
            } else {
                // Muestra error
                echo "<h3 style='color:red;text-align:center;'>Error al eliminar cliente: $result</h3>";
            }

        } else {
            echo "<h3 style='color:red;text-align:center;'>No se recibió un ID válido de cliente.</h3>";
        }
    }

    // ----------------- VENDEDOR CRUD -----------------

    public function consultarVendedor()
    {
        // Obtiene vendedores
        $vendedor = $this->model->consultarVendedor();

        // Muestra vista
        include "app/views/GestionVendedor.php";
    }

    public function actualizarVendedor()
    {
        // Si viene ID, carga formulario
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {

            $id_Usuario = (int) $_GET['id'];

            // Busca vendedor
            $row = $this->model->consultarPorIDVen($id_Usuario);

            if (!$row) {
                echo "<h3 style='color:red;text-align:center;'>Vendedor no encontrado.</h3>";
                include "app/views/GestionVendedor.php";
                return;
            }

            // Muestra formulario con datos
            include_once "app/views/EditarVendedor.php";
            return;
        }

        // Si se envía el formulario
        if (isset($_POST['editar'])) {

            $id_Usuario = isset($_POST['id_Usuario']) ? (int) $_POST['id_Usuario'] : 0;

            // Recupera campos
            $nombre     = $_POST['Nombre'];
            $apellido   = $_POST['Apellido'];
            $matricula  = $_POST['Matricula'];
            $correo     = $_POST['Correo'];
            $contrasena = $_POST['pass'];

            // Actualiza en BD
            $ok = $this->model->actualizarVendedor($id_Usuario, $nombre, $apellido, $matricula, $correo, $contrasena);

            // Redirige según resultado
            if ($ok) {
                header('Location: index.php?action=consultVendedor');
            } else {
                header('Location: index.php?action=actuVendedor&id=' . $id_Usuario . '&error=1');
            }

            exit;
        }

        // Vista por defecto
        include "app/views/EditarVendedor.php";
    }

    public function eliminarVendedor()
    {
        // Valida ID
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {

            $id_Usuario = (int) $_GET['id'];

            // Elimina vendedor
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

    public function consultarMaterial()
    {
        // Obtiene materiales
        $materiales = $this->model->consultarMaterial();

        // Muestra vista de registro/lista
        include "app/views/RegistroMaterial.php";
    }

    public function insertarMaterial()
    {
        // Si se envía el formulario
        if (isset($_POST['registroMaterial'])) {

            // Recupera y limpia valores
            $Nombre       = trim($_POST['Nombre']);
            $Categoria    = trim($_POST['Categoria']);
            $UnidadMedida = trim($_POST['UnidadMedida']);
            $Costo        = (float) $_POST['Costo'];
            $Cantidad     = (int) $_POST['Cantidad'];
            $Descripcion  = trim($_POST['Descripcion']);

            // Inserta material
            $this->model->insertarMaterial($Nombre, $Categoria, $UnidadMedida, $Costo, $Cantidad, $Descripcion);

            // Redirige
            header("Location: index.php?action=consultMaterial");
            exit;
        }

        // Muestra vista
        include_once "app/views/RegistroMaterial.php";
    }

    public function actualizarMaterial()
    {
        // Si viene ID, carga formulario
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {

            $id_material = (int) $_GET['id'];

            // Busca material
            $row = $this->model->consultarPorIdMaterial($id_material);

            if (!$row) {
                header("Location: index.php?action=consultMaterial&error=not_found");
                exit;
            }

            include "app/views/EditarMaterial.php";
            return;
        }

        // Si se envía el POST de edición
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (empty($_POST['id_material'])) {
                header("Location: index.php?action=consultMaterial&error=missing_id");
                exit;
            }

            // Recupera y normaliza datos
            $id_material   = (int) $_POST['id_material'];
            $Nombre        = $_POST['nombre'];
            $Categoria     = $_POST['Categoria'] ?? '';
            $UnidadMedida  = $_POST['UnidadMedida'] ?? '';
            $Costo         = (float) str_replace(',', '.', $_POST['Costo'] ?? '0');
            $Cantidad      = (int) ($_POST['Cantidad'] ?? 0);
            $Descripcion   = $_POST['Descripcion'] ?? '';

            // Actualiza material
            $this->model->actualizarMaterial($id_material, $Nombre, $Categoria, $UnidadMedida, $Costo, $Cantidad, $Descripcion);

            header("Location: index.php?action=consultMaterial");
            exit;
        }

        // Si llega aquí, termina
        exit;
    }

    public function eliminarMaterial()
    {
        // Valida ID
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {

            $id_material = (int) $_GET['id'];

            // Elimina material
            $result = $this->model->eliminarMaterial($id_material);

            // Redirige con bandera de éxito o error
            header('Location: index.php?action=consultMaterial' . ($result === true ? '&deleted=1' : '&error=1'));
            exit;

        } else {
            echo "<h3 style='color:red;text-align:center;'>No se recibió un ID válido de Material.</h3>";
        }
    }

    public function agregarStock()
    {
        // Solo acepta POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Recupera datos del formulario
            $id_material    = isset($_POST['id_material']) ? (int) $_POST['id_material'] : 0;
            $cantidad_sumar = isset($_POST['cantidad_sumar']) ? (int) $_POST['cantidad_sumar'] : 0;

            // Datos opcionales para volver a inventario
            $q    = isset($_POST['q']) ? trim($_POST['q']) : '';
            $page = (isset($_POST['page']) && is_numeric($_POST['page'])) ? (int) $_POST['page'] : 1;

            // Si los datos son válidos, suma stock
            if ($id_material > 0 && $cantidad_sumar > 0) {
                $result = $this->model->aumentarStock($id_material, $cantidad_sumar);
                $suffix = ($result === true) ? '&stock_added=1' : '&error_stock=' . urlencode($result);
            } else {
                $suffix = '&error_stock=' . urlencode('Datos inválidos.');
            }

            // Si viene desde inventario, regresa ahí
            $backToInventario = isset($_POST['from_inventario'])
                ? (bool) $_POST['from_inventario']
                : false;

            if ($backToInventario) {
                header('Location: index.php?action=inventario&page=' . $page . '&q=' . urlencode($q) . $suffix);
                exit;
            }

            // Si no, regresa a materiales
            header('Location: index.php?action=consultMaterial' . $suffix);
            exit;
        }

        // Si no es POST, manda error
        header('Location: index.php?action=inventario&error_stock=' . urlencode('Método no permitido'));
        exit;
    }

    // ----------------- REPORTE INVENTARIO -----------------

    public function inventario()
    {
        // Filtro de búsqueda y paginación
        $q      = isset($_GET['q']) ? trim($_GET['q']) : '';
        $page   = (isset($_GET['page']) && is_numeric($_GET['page']) && (int) $_GET['page'] > 0)
            ? (int) $_GET['page']
            : 1;

        $limit  = 10;
        $offset = ($page - 1) * $limit;

        // Cuenta total y lista según paginación
        $total       = $this->model->contarMaterialesReporte($q);
        $materiales  = $this->model->listarMaterialesReporte($q, $limit, $offset);
        $total_pages = max(1, (int) ceil($total / $limit));

        // Función auxiliar para estado del stock
        if (!function_exists('estadoStock')) {
            function estadoStock(int $cantidad): string
            {
                if ($cantidad <= 0) {
                    return 'Agotado';
                }
                if ($cantidad <= 10) {
                    return 'Bajo';
                }
                return 'Óptimo';
            }
        }

        // Muestra vista de inventario
        include "app/views/Inventario.php";
    }

    // =====================================================
    //  HELPER UNICO PARA ARMAR DATA DE COTIZACION
    // =====================================================

    private function buildCotizacionDataFromSession(): ?array
    {
        // Asegura sesión activa
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $cot = $_SESSION['cotizacion'] ?? null;

        // Valida que exista cliente y detalles
        if (
            !$cot ||
            empty($cot['cliente_id']) ||
            empty($cot['detalles'])
        ) {
            return null;
        }

        // Arma arreglo listo para guardar en BD
        return [
            'id_Cliente' => $cot['cliente_id'],
            'fecha'      => $cot['fecha'] ?? date('Y-m-d'),
            'subtotal'   => (float) $cot['subtotal'],
            'descuento'  => (float) ($cot['descuento_monto'] ?? 0),
            'mano_obra'  => (float) ($cot['mano_obra'] ?? 0),
            'impuestos'  => (float) ($cot['impuestos_monto'] ?? 0),
            'total'      => (float) ($cot['total'] ?? 0),
            'notas'      => $cot['notas'] ?? '',
            'detalles'   => $cot['detalles'],
        ];
    }

    // ----------------- COTIZACIÓN -----------------

    public function cotizacion()
    {
        // Asegura sesión
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Paso actual del proceso
        $step = isset($_GET['step']) ? (int) $_GET['step'] : 1;

        switch ($step) {

            // Paso 1: elegir cliente
            case 1:

                // Si se mandó el cliente por POST
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cliente_id'])) {

                    $id      = (int) $_POST['cliente_id'];
                    $cliente = $this->model->consultarPorID($id);

                    // Si existe el cliente, lo guarda en sesión
                    if ($cliente) {
                        $_SESSION['cotizacion'] = [
                            'cliente_id' => $cliente['id_Cliente'],
                            'cliente'    => $cliente,
                        ];
                        header('Location: index.php?action=cotizacion&step=2');
                        exit;
                    }
                }

                // Búsqueda de clientes
                $q        = isset($_GET['q']) ? trim($_GET['q']) : '';
                $clientes = $this->model->buscarClientes($q);

                include "app/views/Coti1.php";
                break;

            // Paso 2: elegir materiales
            case 2:

                // Si se mandaron materiales por POST
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_material'])) {

                    $ids        = $_POST['id_material'];
                    $anchos     = $_POST['ancho'];
                    $altos      = $_POST['alto'];
                    $cantidades = $_POST['cantidad'];

                    $detalles = [];
                    $subtotal = 0;
                    $errores  = [];

                    $n = count($ids);

                    // Recorre todos los materiales seleccionados
                    for ($i = 0; $i < $n; $i++) {

                        $id_mat   = (int) $ids[$i];
                        $ancho_cm = (float) ($anchos[$i] ?? 0);
                        $alto_cm  = (float) ($altos[$i] ?? 0);
                        $cant     = (int) ($cantidades[$i] ?? 0);

                        // Si no pidió cantidad, ignora
                        if ($cant <= 0) {
                            continue;
                        }

                        // Busca material
                        $mat = $this->model->consultarPorIdMaterial($id_mat);
                        if (!$mat) {
                            continue;
                        }

                        // Verifica stock disponible
                        $stock_disponible = (int) $mat['Cantidad'];

                        if ($cant > $stock_disponible) {
                            $errores[] = "No hay suficiente stock de {$mat['Nombre']}. Disponible: {$stock_disponible}, solicitado: {$cant}.";
                            continue;
                        }

                        // Calcula subtotal por material
                        $precio_unit = (float) $mat['Costo'];
                        $sub         = $precio_unit * $cant;

                        // Guarda detalle
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

                    // Si hubo errores, los guarda en sesión
                    if (!empty($errores)) {
                        $_SESSION['cotizacion_error'] = implode("<br>", $errores);
                        header('Location: index.php?action=cotizacion&step=2');
                        exit;
                    }

                    // Si no se eligió nada válido
                    if (empty($detalles)) {
                        $_SESSION['cotizacion_error'] = "No seleccionaste ningún material válido.";
                        header('Location: index.php?action=cotizacion&step=2');
                        exit;
                    }

                    // Guarda detalles y subtotal en sesión
                    $_SESSION['cotizacion']['detalles'] = $detalles;
                    $_SESSION['cotizacion']['subtotal'] = $subtotal;

                    // Limpia datos calculados previos (por si regresa)
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

                // Lista materiales para la vista
                $materiales = $this->model->consultarMaterial();
                include "app/views/Coti2.php";
                break;

            // Paso 3: descuento, impuestos y mano de obra
            case 3:

                $cot = $_SESSION['cotizacion'] ?? null;

                // Si no hay detalles, regresa al paso 2
                if (!$cot || empty($cot['detalles'])) {
                    header('Location: index.php?action=cotizacion&step=2');
                    exit;
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $subtotal = (float) ($cot['subtotal'] ?? 0);
                    $errores  = [];

                    // Valida descuento
                    if (!isset($_POST['descuento']) || $_POST['descuento'] === '') {
                        $errores[] = "El descuento es obligatorio.";
                    }
                    $descuento_porc = (float) ($_POST['descuento'] ?? 0);
                    if ($descuento_porc < 0 || $descuento_porc > 100) {
                        $errores[] = "El descuento debe estar entre 0 y 100.";
                    }

                    // Valida impuestos
                    if (!isset($_POST['impuestos']) || $_POST['impuestos'] === '') {
                        $errores[] = "Los impuestos son obligatorios.";
                    }
                    $impuestos_porc = (float) ($_POST['impuestos'] ?? 0);
                    if ($impuestos_porc < 0 || $impuestos_porc > 100) {
                        $errores[] = "Los impuestos deben estar entre 0 y 100.";
                    }

                    // Valida mano de obra
                    if (!isset($_POST['mano_obra']) || $_POST['mano_obra'] === '') {
                        $errores[] = "La mano de obra es obligatoria.";
                    }
                    $mano_obra = (float) ($_POST['mano_obra'] ?? 0);
                    if ($mano_obra < 0) {
                        $errores[] = "La mano de obra no puede ser negativa.";
                    }

                    // Notas opcionales
                    $notas = isset($_POST['notas']) ? trim($_POST['notas']) : '';

                    // Si hay errores, regresa
                    if (!empty($errores)) {
                        $_SESSION['cotizacion_error'] = implode("<br>", $errores);
                        header('Location: index.php?action=cotizacion&step=3');
                        exit;
                    }

                    // Calcula totales
                    $descuento_monto = $subtotal * ($descuento_porc / 100.0);
                    $base            = $subtotal - $descuento_monto + $mano_obra;
                    $impuestos_monto = $base * ($impuestos_porc / 100.0);
                    $total           = $base + $impuestos_monto;

                    // Guarda todo en sesión
                    $_SESSION['cotizacion']['descuento_porc']  = $descuento_porc;
                    $_SESSION['cotizacion']['descuento_monto'] = $descuento_monto;
                    $_SESSION['cotizacion']['impuestos_porc']  = $impuestos_porc;
                    $_SESSION['cotizacion']['impuestos_monto'] = $impuestos_monto;
                    $_SESSION['cotizacion']['mano_obra']       = $mano_obra;
                    $_SESSION['cotizacion']['notas']           = $notas;
                    $_SESSION['cotizacion']['total']           = $total;

                    // Siguiente paso
                    header('Location: index.php?action=cotizacion&step=4');
                    exit;
                }

                include "app/views/Coti3.php";
                break;

            // Paso 4: confirmar y guardar
            case 4:

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    // Arma data final desde sesión
                    $data = $this->buildCotizacionDataFromSession();

                    if (!$data) {
                        $_SESSION['cotizacion_error'] = "No hay datos suficientes para guardar la cotización.";
                        header("Location: index.php?action=cotizacion&step=4");
                        exit;
                    }

                    // Guarda en BD
                    $id_cot = $this->model->guardarCotizacion($data);

                    if ($id_cot !== false) {
                        // Limpia sesión y manda ok
                        unset($_SESSION['cotizacion']);
                        $_SESSION['cotizacion_ok'] = "La cotización #$id_cot se guardó correctamente.";
                        header("Location: index.php?action=cotizaciones");
                        exit;
                    }

                    // Si falla, manda error
                    $_SESSION['cotizacion_error'] = "Ocurrió un error al guardar la cotización.";
                    header("Location: index.php?action=cotizacion&step=4");
                    exit;
                }

                include "app/views/Coti4.php";
                break;
        }
    }

    // ----------------- LISTA PRINCIPAL COTIZACIONES -----------------

    public function cotizaciones()
    {
        // Trae materiales y cotizaciones con sus detalles
        $materiales   = $this->model->consultarMaterial();
        $cotizaciones = $this->model->listarCotizacionesConDetalles();

        // Carga vista principal
        require 'app/views/Cotizacion.php';
    }

    // =====================================================
    //  ACCIÓN ROUTER GUARDAR COTIZACIÓN (YA NO DUPLICA)
    // =====================================================

    public function guardarCotizacion()
    {
        // Obtiene data desde sesión
        $data = $this->buildCotizacionDataFromSession();

        if (!$data) {
            echo "No hay datos en sesión para guardar.";
            return;
        }

        try {
            // Guarda cotización
            $idCotizacion = $this->model->guardarCotizacion($data);

            if ($idCotizacion !== false) {
                // Si sale bien, limpia sesión y redirige
                unset($_SESSION['cotizacion']);
                header("Location: index.php?action=cotizaciones&saved=1");
                exit;
            }

            echo "Error al guardar la cotización.";

        } catch (Exception $e) {
            // Error inesperado
            echo "Error al guardar la cotización: " . $e->getMessage();
        }
    }

    public function eliminarCotizacion()
    {
        // Recupera ID de la cotización
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header("Location: index.php?action=cotizaciones");
            exit;
        }

        try {
            // Elimina cotización y ajusta stock
            $this->model->eliminarCotizacionConStock($id);
            header("Location: index.php?action=cotizaciones&deleted=1");
            exit;

        } catch (Exception $e) {
            echo "Error al eliminar: " . $e->getMessage();
        }
    }

    // ----------------- RESPALDO BD -----------------

    public function realizarRespaldoBD()
    {
        // Datos de conexión para backup
        $server   = "localhost";
        $user     = "root";
        $password = "";
        $db       = "bonanza_cotizaciones";

        // Genera el backup y devuelve ruta
        $ruta  = $this->model->backup_tables($server, $user, $password, $db);
        $fecha = date("Y-m-d");

        // Fuerza descarga del archivo sql
        header("Content-disposition: attachment; filename=db-backup-" . $fecha . ".sql");
        header("Content-type: application/sql");

        readfile($ruta);
        exit;
    }

    public function restaurarBD()
    {
        // Nombre del backup de hoy
        $fecha = date("Y-m-d");
        $ruta  = "config/backups/db-backup-" . $fecha . ".sql";

        // Restaura BD desde el archivo
        $mensaje = $this->model->restaurarBD($ruta);

        echo "<h2>$mensaje</h2>";
    }

   
}
