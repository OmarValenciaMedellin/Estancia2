<?php

class reportModel
{
    private $connection; // Guarda la conexión a la BD

    public function __construct($connection)
    {
        // Recibe la conexión y la asigna
        $this->connection = $connection;
    }

    // ===============================
    // 1. OBTENER TODAS LAS COTIZACIONES
    // ===============================
    public function consultarCotizaciones()
    {
        // Consulta todas las cotizaciones
        $sql = "SELECT * FROM cotizacion";
        $result = $this->connection->query($sql);

        return $result; // Retorna el resultado (mysqli_result)
    }

    // ====================================
    // 1.1 OBTENER UNA COTIZACION POR ID
    // ====================================
    public function consultarCotizacionPorId($id)
    {
        // Convierte a entero para evitar inyección SQL básica
        $id = (int) $id;

        // Consulta por ID
        $sql = "SELECT * FROM cotizacion WHERE id_cotizacion = $id";
        $result = $this->connection->query($sql);

        // Si existe resultado, devuelve el arreglo; si no, null
        return $result ? $result->fetch_assoc() : null;
    }

    // ====================================
    // 2. OBTENER DETALLES DE UNA COTIZACIÓN
    // ====================================
    public function consultarDetalle($id_cotizacion)
    {
        // Convierte a entero
        $id_cotizacion = (int) $id_cotizacion;

        // Consulta los detalles de esa cotización
        $sql = "SELECT * FROM cotizacion_detalle WHERE id_cotizacion = $id_cotizacion";
        $result = $this->connection->query($sql);

        return $result; // Retorna el resultado para recorrerlo
    }

    // ====================================
    // 2.1 OBTENER COTIZACIONES FILTRADAS
    // ====================================
    public function consultarCotizacionesFiltradas($inicio, $fin, $clienteId = null)
    {
        // SQL base con JOIN a clientes y filtro por fechas
        $sql = "
            SELECT 
                c.id_cotizacion,
                c.Fecha,
                c.Subtotal,
                c.Descuento,
                c.Mano_obra,
                c.Impuestos,
                c.Total,
                c.Notas,
                cl.Nombre,
                cl.Apellido
            FROM cotizacion c
            INNER JOIN registro_cliente cl ON cl.id_Cliente = c.id_Cliente
            WHERE c.Fecha BETWEEN ? AND ?
        ";

        // Si hay cliente, agrega condición extra
        if (!empty($clienteId)) {
            $sql .= " AND c.id_Cliente = ? ";
        }

        // Prepara el statement
        $stmt = $this->connection->prepare($sql);

        // Asigna los parámetros según exista cliente o no
        if (!empty($clienteId)) {
            $stmt->bind_param("ssi", $inicio, $fin, $clienteId);
        } else {
            $stmt->bind_param("ss", $inicio, $fin);
        }

        // Ejecuta y devuelve resultados
        $stmt->execute();
        return $stmt->get_result();
    }

    // ====================================
    // 3. DATOS PARA LA GRÁFICA POR MATERIAL
    // ====================================
    public function obtenerTotalesPorMaterial()
    {
        // Agrupa por material y suma subtotal vendido
        $sql = "
            SELECT 
                id_material,
                SUM(subtotal) AS total_vendido
            FROM cotizacion_detalle
            GROUP BY id_material
        ";

        $result = $this->connection->query($sql);

        $data = []; // Arreglo final para la gráfica/tabla

        // Recorre resultados y arma un array simple
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                "Material " . $row['id_material'],  // Etiqueta
                (float) $row['total_vendido']       // Total vendido
            ];
        }

        return $data; // Retorna array listo para usar
    }
}

?>
