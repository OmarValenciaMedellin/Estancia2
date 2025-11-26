<?php

class reportModel {

    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    // ===============================
    // 1. OBTENER TODAS LAS COTIZACIONES
    // ===============================
    public function consultarCotizaciones(){
        $sql = "SELECT * FROM cotizacion";
        $result = $this->connection->query($sql);
        return $result;
    }

    // ====================================
    // 1.1 OBTENER UNA COTIZACION POR ID
    // ====================================
    public function consultarCotizacionPorId($id){
        $id = (int)$id; 
        $sql = "SELECT * FROM cotizacion WHERE id_cotizacion = $id";
        $result = $this->connection->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }

    // ====================================
    // 2. OBTENER DETALLES DE UNA COTIZACIÓN
    // ====================================
    public function consultarDetalle($id_cotizacion){
        $id_cotizacion = (int)$id_cotizacion;
        $sql = "SELECT * FROM cotizacion_detalle WHERE id_cotizacion = $id_cotizacion";
        $result = $this->connection->query($sql);
        return $result;
    }

    public function consultarCotizacionesFiltradas($inicio, $fin, $clienteId = null){
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

    if (!empty($clienteId)) {
        $sql .= " AND c.id_Cliente = ? ";
    }

    $stmt = $this->connection->prepare($sql);

    if (!empty($clienteId)) {
        $stmt->bind_param("ssi", $inicio, $fin, $clienteId);
    } else {
        $stmt->bind_param("ss", $inicio, $fin);
    }

    $stmt->execute();
    return $stmt->get_result();
}


    // ====================================
    // 3. DATOS PARA LA GRÁFICA POR MATERIAL 
    // ====================================
    public function obtenerTotalesPorMaterial(){

        $sql = "
            SELECT 
                id_material,
                SUM(subtotal) AS total_vendido
            FROM cotizacion_detalle
            GROUP BY id_material
        ";

        $result = $this->connection->query($sql);

        $data = [];

        while($row = $result->fetch_assoc()){
            $data[] = [
                "Material " . $row['id_material'],
                (float) $row['total_vendido']
            ];
        }

        return $data;
    }

}

?>
