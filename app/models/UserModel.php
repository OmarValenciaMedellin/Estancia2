<?php

// Crear clase del modelo 
class UserModel{

    private $connection;

    // Constructor de la clase 
    public function __construct($connection){
        $this -> connection = $connection;
    }

    public function obtenerUsuario($nombre) {
        // FIX: variable $correo no existe, usamos el mismo parámetro en ambos
        $sql_statement = "SELECT * FROM vendedor WHERE correo = ? OR nombre = ? LIMIT 1";
        $statement = $this->connection->prepare($sql_statement);
        $statement->bind_param("ss", $nombre, $nombre);
        $statement->execute();
        $resultado = $statement->get_result();
        return $resultado->fetch_assoc();
    }

    //************************************** //Cliente ************************************************************

    public function insertarCliente($nombre, $apellido, $telefono, $correo ){
        $sql_statement = "INSERT INTO registro_cliente (nombre, apellido, telefono, correo) VALUES (?, ?, ?, ?)";
        $statement = $this -> connection -> prepare($sql_statement);
        $statement -> bind_param("ssss", $nombre, $apellido, $telefono, $correo );
        return $statement -> execute ();
    } 

    public function insertarCliente2($nombre, $apellido, $telefono, $correo ){
        $sql_statement = "INSERT INTO registro_cliente (nombre, apellido, telefono, correo) VALUES (?, ?, ?, ?)";
        $statement = $this -> connection -> prepare($sql_statement);
        $statement -> bind_param("ssis", $nombre, $apellido, $telefono, $correo );
        return $statement -> execute ();
    }

    public function consultarCliente(){
        $sql_statement = "SELECT * FROM registro_cliente";
        $result = $this -> connection -> query($sql_statement);
        return $result;
    }

    public function consultarPorID($id_Cliente){
        $sql_statemente = "SELECT * FROM registro_cliente WHERE id_Cliente = ?";
        $statement = $this -> connection -> prepare($sql_statemente);
        $statement -> bind_param("i", $id_Cliente);
        $statement -> execute();
        $result = $statement -> get_result();
        return $result -> fetch_assoc();
    }

    // === Clientes: conteo total ===
    public function contarClientes(): int {
        $sql_statement = "SELECT COUNT(*) AS total FROM registro_cliente";
        $res = $this->connection->query($sql_statement);
        if (!$res) return 0;
        $row = $res->fetch_assoc();
        return (int)($row['total'] ?? 0);
    }

    // === Clientes: últimos registrados por ID DESC ===
    public function listarClientesRecientes(int $limit = 5): array {
        $sql_statement = "SELECT id_Cliente, nombre, apellido, correo, telefono
                FROM registro_cliente
                ORDER BY id_Cliente DESC
                LIMIT ?";
        $statement = $this->connection->prepare($sql_statement);
        if (!$statement) return [];
        $statement->bind_param("i", $limit);
        $statement->execute();
        $res = $statement->get_result();
        $items = [];
        while ($row = $res->fetch_assoc()) { $items[] = $row; }
        $statement->close();
        return $items;
    }

    public function actualizarClientes($id_Cliente, $nombre, $apellido, $telefono, $correo){
        $sql_statement = "UPDATE registro_Cliente 
                    SET Nombre = ?,  
                        Apellido = ?,
                        Telefono = ?, 
                        Correo = ?
                    WHERE id_Cliente = ?";
        $statement = $this -> connection -> prepare($sql_statement); 
        if (!$statement) return false;
        if (!$statement->bind_param("ssssi", $nombre, $apellido, $telefono, $correo, $id_Cliente)) return false;
        $ok = $statement -> execute();
        return $ok;
    }

    public function eliminarCliente($id_Cliente){
        $sql_statement = "DELETE FROM registro_Cliente WHERE id_Cliente = ?";
        $statement = $this->connection->prepare($sql_statement);
        if (!$statement) return "Prepare failed: " . $this->connection->error;

        if (!$statement->bind_param("i", $id_Cliente)) {
            $err = $statement->error;
            $statement->close();
            return "bind_param failed: $err";
        }

        if (!$statement->execute()) {
            $err = $statement->error; 
            $statement->close();
            return "Execute failed: $err";
        }

        $rows = $statement->affected_rows;
        $statement->close();

        return ($rows > 0) ? true : "No se encontró el cliente (ID: $id_Cliente).";
    }

    //************************************** VENDEDOR ************************************************************//

    public function insertarVendedor($nombre, $apellido, $matricula, $cargo, $correo, $pass){
        $sql_statement = "INSERT INTO vendedor (nombre, apellido, matricula, cargo, correo, pass) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $this -> connection -> prepare($sql_statement);
        $statement -> bind_param("ssssss", $nombre, $apellido, $matricula, $cargo, $correo, $pass );
        return $statement -> execute ();
    }

    public function consultarVendedor(){
        $sql_statement = "SELECT * FROM vendedor";
        $result = $this -> connection -> query($sql_statement);
        return $result;
    }

    public function consultarPorIDVen($id_Usuario){
        $sql_statemente = "SELECT * FROM vendedor WHERE id_Usuario = ?";
        $statement = $this -> connection -> prepare($sql_statemente);
        $statement -> bind_param("i", $id_Usuario);
        $statement -> execute();
        $result = $statement -> get_result();
        return $result -> fetch_assoc();
    }

    public function actualizarVendedor($id_Usuario, $nombre, $apellido, $matricula, $correo, $contrasena){
        $sql_statement = "UPDATE vendedor 
                    SET nombre = ?,  
                        apellido = ?,
                        matricula = ?, 
                        correo = ?,
                        pass = ?
                    WHERE id_Usuario = ?";
        $statement = $this -> connection -> prepare($sql_statement); 
        if (!$statement) return false;
        if (!$statement->bind_param("sssssi", $nombre, $apellido, $matricula, $correo, $contrasena, $id_Usuario)) return false;
        $ok = $statement -> execute();
        return $ok;
    }

    public function eliminarVendedor($id_Usuario){
        $sql_statement = "DELETE FROM vendedor WHERE id_Usuario = ?";
        $statement = $this->connection->prepare($sql_statement);
        if (!$statement) return "Prepare failed: " . $this->connection->error;

        if (!$statement->bind_param("i", $id_Usuario)) {
            $err = $statement->error;
            $statement->close();
            return "bind_param failed: $err";
        }

        if (!$statement->execute()) {
            $err = $statement->error; 
            $statement->close();
            return "Execute failed: $err";
        }

        $rows = $statement->affected_rows;
        $statement->close();

        return ($rows > 0) ? true : "No se encontró el cliente (ID: $id_Usuario).";
    }

    //************************************** //Materiales ************************************************************
    // Materiales más usados en cotizaciones
    public function listarMaterialesMasUsados(int $limit = 5): array {
        $sql = "
            SELECT 
                rm.id_material,
                rm.Nombre,
                rm.Categoria,
                SUM(cd.cantidad) AS total_usada
            FROM cotizacion_detalle cd
            INNER JOIN registro_material rm 
                ON rm.id_material = cd.id_material
            GROUP BY rm.id_material, rm.Nombre, rm.Categoria
            ORDER BY total_usada DESC
            LIMIT ?
        ";

        $stmt = $this->connection->prepare($sql);
        if (!$stmt) return [];
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $res = $stmt->get_result();

        $items = [];
        while ($row = $res->fetch_assoc()) {
            $items[] = $row;
        }
        $stmt->close();
        return $items;
    }

    public function insertarMaterial($Nombre, $Categoria, $UnidadMedida, $Costo, $Cantidad, $Descripcion) {
        $sql_statement = "INSERT INTO registro_material (Nombre, Categoria, UnidadMedida, Costo, Cantidad, Descripcion) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $this->connection->prepare($sql_statement);
        if (!$statement) return false;
        $statement->bind_param("sssdis", $Nombre, $Categoria, $UnidadMedida, $Costo, $Cantidad, $Descripcion);
        return $statement->execute();
    }

    public function consultarMaterial() {
        $sql_statement = "SELECT * FROM registro_material ORDER BY id_material DESC";
        return $this->connection->query($sql_statement);
    }

    public function consultarPorIdMaterial($id_material) {
        $sql_statement = "SELECT * FROM registro_material WHERE id_material = ?";
        $statement = $this->connection->prepare($sql_statement);
        if (!$statement) return false;
        $statement->bind_param("i", $id_material);
        $statement->execute();
        $res = $statement->get_result();
        return $res->fetch_assoc();
    }

    public function actualizarMaterial($id_material, $Nombre, $Categoria, $UnidadMedida, $Costo, $Cantidad, $Descripcion) {
        $sql_statement = "UPDATE registro_material
                SET Nombre = ?, Categoria = ?, UnidadMedida = ?, Costo = ?, Cantidad = ?, Descripcion = ?
                WHERE id_material = ?";
        $statement = $this->connection->prepare($sql_statement);
        if (!$statement) return false;
        $statement->bind_param("sssdisi", $Nombre, $Categoria, $UnidadMedida, $Costo, $Cantidad, $Descripcion, $id_material);
        return $statement->execute();
    }
    
    public function eliminarMaterial($id_material) {
        $sql_statement = "DELETE FROM registro_material WHERE id_material = ?";
        $statement = $this->connection->prepare($sql_statement);
        if (!$statement) return "Prepare failed: " . $this->connection->error;

        if (!$statement->bind_param("i", $id_material)) {
            $err = $statement->error;
            $statement->close();
            return "bind_param failed: $err";
        }

        if (!$statement->execute()) {
            $err = $statement->error;
            $statement->close();
            return "Execute failed: $err";
        }

        $rows = $statement->affected_rows;
        $statement->close();
        return ($rows > 0) ? true : "No se encontró el material (ID: $id_material).";
    }

    // === NUEVO: REPORTE INVENTARIO ===

    public function listarMaterialesReporte(?string $search, int $limit, int $offset) {
        if ($search !== null && $search !== '') {
            $sql_statement = "
                SELECT id_material, Nombre, Cantidad
                FROM registro_material
                WHERE (CAST(id_material AS CHAR) = ? OR Nombre LIKE ?)
                ORDER BY id_material DESC
                LIMIT ? OFFSET ?
            ";
            $statement = $this->connection->prepare($sql_statement);
            if (!$statement) { throw new Exception("Prepare failed: ".$this->connection->error); }
            $like = '%'.$search.'%';
            $statement->bind_param("ssii", $search, $like, $limit, $offset);
        } else {
            $sql_statement = "
                SELECT id_material, Nombre, Cantidad
                FROM registro_material
                ORDER BY id_material DESC
                LIMIT ? OFFSET ?
            ";
            $statement = $this->connection->prepare($sql_statement);
            if (!$statement) { throw new Exception("Prepare failed: ".$this->connection->error); }
            $statement->bind_param("ii", $limit, $offset);
        }
        $statement->execute();
        return $statement->get_result(); 
    }

    public function contarMaterialesReporte(?string $search): int {
        if ($search !== null && $search !== '') {
            $sql_statement = "
                SELECT COUNT(*) AS total
                FROM registro_material
                WHERE (CAST(id_material AS CHAR) = ? OR Nombre LIKE ?)
            ";
            $stmt = $this->connection->prepare($sql_statement);
            if (!$stmt) { throw new Exception("Prepare failed: ".$this->connection->error); }
            $like = '%'.$search.'%';
            $stmt->bind_param("ss", $search, $like);
        } else {
            $sql_statement = "SELECT COUNT(*) AS total FROM registro_material";
            $stmt = $this->connection->prepare($sql_statement);
            if (!$stmt) { throw new Exception("Prepare failed: ".$this->connection->error); }
        }
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        return (int)($res['total'] ?? 0);
    }

    public function aumentarStock(int $id_material, int $cantidad_sumar) {
        if ($cantidad_sumar <= 0) return "Cantidad a sumar inválida.";

        $sql_statement = "UPDATE registro_material SET Cantidad = Cantidad + ? WHERE id_material = ?";
        $statement = $this->connection->prepare($sql_statement);
        if (!$statement) return "Prepare failed: " . $this->connection->error;

        if (!$statement->bind_param("ii", $cantidad_sumar, $id_material)) {
            $err = $statement->error;
            $statement->close();
            return "bind_param failed: $err";
        }

        if (!$statement->execute()) {
            $err = $statement->error;
            $statement->close();
            return "Execute failed: $err";
        }

        $rows = $statement->affected_rows;
        $statement->close();
        return ($rows > 0) ? true : "No se encontró el material (ID: $id_material).";
    }

    public function contarMateriales(): int {
        $sql_statement = "SELECT COUNT(*) AS total FROM registro_material";
        $res = $this->connection->query($sql_statement);
        if (!$res) return 0;
        $row = $res->fetch_assoc();
        return (int)($row['total'] ?? 0);
    }

    public function contarMaterialesBajoStock(int $umbral = 10): int {
        $sql_statement = "SELECT COUNT(*) AS total FROM registro_material WHERE Cantidad <= ?";
        $statement = $this->connection->prepare($sql_statement);
        if (!$statement) return 0;
        $statement->bind_param("i", $umbral);
        $statement->execute();
        $res = $statement->get_result()->fetch_assoc();
        $statement->close();
        return (int)($res['total'] ?? 0);
    }

    public function valorTotalInventario(): float {
        $sql_statement = "SELECT SUM(Costo * Cantidad) AS total FROM registro_material";
        $res = $this->connection->query($sql_statement);
        if (!$res) return 0.0;
        $row = $res->fetch_assoc();
        return (float)($row['total'] ?? 0);
    }

    public function listarMaterialesRecientes(int $limit = 5): array {
        $sql_statement = "SELECT id_material, Nombre, Categoria, Cantidad FROM registro_material ORDER BY id_material DESC LIMIT ?";
        $statement = $this->connection->prepare($sql_statement);
        if (!$statement) return [];
        $statement->bind_param("i", $limit);
        $statement->execute();
        $res = $statement->get_result();
        $items = [];
        while ($row = $res->fetch_assoc()) { $items[] = $row; }
        $statement->close();
        return $items;
    }

    public function listarMaterialesBajoStock(int $limit = 5, int $umbral = 10): array {
        $sql_statement = "SELECT id_material, Nombre, Categoria, Cantidad 
                FROM registro_material 
                WHERE Cantidad <= ? 
                ORDER BY Cantidad ASC, id_material DESC 
                LIMIT ?";
        $statement = $this->connection->prepare($sql_statement);
        if (!$statement) return [];
        $statement->bind_param("ii", $umbral, $limit);
        $statement->execute();
        $res = $statement->get_result();
        $items = [];
        while ($row = $res->fetch_assoc()) { $items[] = $row; }
        $statement->close();
        return $items;
    }

    public function buscarClientes(?string $search) {
        if ($search !== null && $search !== '') {
            $sql = "SELECT * FROM registro_cliente
                    WHERE nombre LIKE ? 
                       OR apellido LIKE ?
                       OR correo LIKE ?
                       OR CAST(id_Cliente AS CHAR) = ?";
            $stmt = $this->connection->prepare($sql);
            if (!$stmt) return false;
            $like = '%'.$search.'%';
            $stmt->bind_param("ssss", $like, $like, $like, $search);
        } else {
            $sql = "SELECT * FROM registro_cliente ORDER BY id_Cliente DESC";
            $stmt = $this->connection->prepare($sql);
            if (!$stmt) return false;
        }
        $stmt->execute();
        return $stmt->get_result();
    }

    public function obtenerMaterialPorId(int $id_material) {
        $sql = "SELECT * FROM registro_material WHERE id_material = ?";
        $stmt = $this->connection->prepare($sql);
        if (!$stmt) return false;
        $stmt->bind_param("i", $id_material);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc();
    }

    //************************************** //Cotizacion ************************************************************

   
// Guardar una cotización con detalles
public function guardarCotizacion(array $data) {
    return $this->registrarCotizacion(
        $data['id_Cliente'],
        $data['fecha'],        // fecha que mandas desde el controlador
        $data['subtotal'],
        $data['descuento'],
        $data['mano_obra'],
        $data['impuestos'],
        $data['total'],
        $data['notas'],        //mandamos notas
        $data['detalles']
    );
}


    
    // ===================== COTIZACIONES (LISTAR EN PÁGINA PRINCIPAL) =====================

       public function listarCotizacionesConDetalles() {
            $sql = "
                SELECT 
                    c.id_cotizacion,
                    c.Subtotal,
                    c.Descuento,
                    c.Mano_obra,
                    c.Impuestos,
                    c.Total,
                    cl.Nombre,
                    cl.Apellido,

                    GROUP_CONCAT(
                        CONCAT(
                            m.Nombre,
                            ' — ',
                            d.ancho_cm, 'x', d.alto_cm, ' cm',
                            ' — Cant: ', d.cantidad
                        )
                        SEPARATOR ' | '
                    ) AS DetallesMateriales

                FROM cotizacion AS c
                LEFT JOIN registro_cliente AS cl 
                    ON cl.id_Cliente = c.id_Cliente
                LEFT JOIN cotizacion_detalle AS d 
                    ON d.id_cotizacion = c.id_cotizacion
                LEFT JOIN registro_material AS m 
                    ON m.id_material = d.id_material
                
                GROUP BY c.id_cotizacion
                ORDER BY c.id_cotizacion DESC
            ";

            return $this->connection->query($sql);
        }



        public function valorTotalCotizaciones() {
            $sql = "SELECT COALESCE(SUM(Total), 0) AS total_cotizado FROM cotizacion";

            $result = $this->connection->query($sql);

            if (!$result) {
                // Opcional: debug si hay error
                // die("Error en valorTotalCotizaciones(): " . $this->connection->error);
                return 0;
            }

            $row = $result->fetch_assoc();
            return (float)($row['total_cotizado'] ?? 0);
        }

        public function registrarCotizacion(
            $idCliente,
            $fecha,
            $subtotal,
            $descuento,
            $manoObra,
            $impuestos,
            $total,
            $notas,
            $detalles
        ){
    $this->connection->begin_transaction();

    try {
        $sqlCot = "
            INSERT INTO cotizacion
            (id_Cliente, Fecha, Subtotal, Descuento, Mano_obra, Impuestos, Total, Notas)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ";

        $stmtCot = $this->connection->prepare($sqlCot);
        $stmtCot->bind_param(
            "isddddds",
            $idCliente,
            $fecha,        // ✅ fecha desde controlador (YYYY-mm-dd)
            $subtotal,
            $descuento,
            $manoObra,
            $impuestos,
            $total,
            $notas         // ✅ ahora sí se guarda en BD
        );

        $stmtCot->execute();
        $idCotizacion = $stmtCot->insert_id;
        $stmtCot->close();

        foreach ($detalles as $det) {

            $sqlDet = "
                INSERT INTO cotizacion_detalle
                (id_cotizacion, id_material, ancho_cm, alto_cm, cantidad, precio_unitario, subtotal)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ";

            $stmtDet = $this->connection->prepare($sqlDet);
            $stmtDet->bind_param(
                "iiddidd",
                $idCotizacion,
                $det['id_material'],
                $det['ancho_cm'],   // <-- antes: ancho
                $det['alto_cm'],    // <-- antes: alto
                $det['cantidad'],
                $det['precio_unitario'],
                $det['subtotal']
            );
            $stmtDet->execute();
            $stmtDet->close();

            // RESTAR STOCK
            $sqlStock = "
                UPDATE registro_material
                SET Cantidad = Cantidad - ?
                WHERE id_material = ?
            ";
            $stmtStock = $this->connection->prepare($sqlStock);
            $stmtStock->bind_param("ii", $det['cantidad'], $det['id_material']);
            $stmtStock->execute();
            $stmtStock->close();
        }

        $this->connection->commit();
        return $idCotizacion;

    } catch (Exception $e) {
        $this->connection->rollback();
        throw $e;
    }
}


        public function descontarMaterialesPorCotizacion($idCotizacion)
            {
                $idCotizacion = (int)$idCotizacion;

                // Debug 1: ver que la función se está llamando
                // *** QUITA este echo/exit cuando ya funcione ***
                // echo "Entró a descontarMaterialesPorCotizacion con ID = $idCotizacion";
                // exit;

                $this->connection->begin_transaction();

                try {
                    // 1) Leer detalles
                    $sqlDet = "
                        SELECT id_Material, Cantidad
                        FROM detalle_cotizacion
                        WHERE id_cotizacion = $idCotizacion
                    ";

                    $resDet = $this->connection->query($sqlDet);

                    if (!$resDet) {
                        throw new Exception("Error al leer detalles: " . $this->connection->error);
                    }

                    if ($resDet->num_rows === 0) {
                        throw new Exception("No hay detalles para la cotización $idCotizacion");
                    }

                    // 2) Restar stock
                    while ($row = $resDet->fetch_assoc()) {
                        $idMaterial = (int)$row['id_Material'];
                        $cantUsada  = (float)$row['Cantidad'];

                        // Debug 2: ver qué valores se van a restar
                        // echo "Material $idMaterial - restar $cantUsada<br>";

                        $sqlUpd = "
                            UPDATE material
                            SET Cantidad = Cantidad - $cantUsada
                            WHERE id_Material = $idMaterial
                        ";

                        if (!$this->connection->query($sqlUpd)) {
                            throw new Exception("Error al actualizar stock: " . $this->connection->error);
                        }
                    }

                    $this->connection->commit();

                } catch (Exception $e) {
                    $this->connection->rollback();
                    die("Error en descontarMaterialesPorCotizacion(): " . $e->getMessage());
                }
            }

        public function eliminarCotizacionConStock($idCotizacion)
        {
            $idCotizacion = (int)$idCotizacion;

            $this->connection->begin_transaction();

            try {
                $sqlDet = "
                    SELECT id_material, cantidad
                    FROM cotizacion_detalle
                    WHERE id_cotizacion = $idCotizacion
                ";
                $resDet = $this->connection->query($sqlDet);

                if (!$resDet) {
                    throw new Exception("Error al obtener detalles: " . $this->connection->error);
                }

                while ($row = $resDet->fetch_assoc()) {
                    $idMaterial = (int)$row['id_material'];
                    $cantidad   = (float)$row['cantidad'];

                    $sqlUpd = "
                        UPDATE registro_material
                        SET Cantidad = Cantidad + $cantidad
                        WHERE id_material = $idMaterial
                    ";

                    if (!$this->connection->query($sqlUpd)) {
                        throw new Exception("Error al devolver stock: " . $this->connection->error);
                    }
                }

                $this->connection->query("DELETE FROM cotizacion_detalle WHERE id_cotizacion = $idCotizacion");
                $this->connection->query("DELETE FROM cotizacion WHERE id_cotizacion = $idCotizacion");

                $this->connection->commit();

            } catch (Exception $e) {
                $this->connection->rollback();
                die("Error en eliminarCotizacionConStock(): " . $e->getMessage());
            }
        }

        public function listarCotizacionesRecientes(int $limit = 5): array {
            $sql = "
                SELECT 
                    c.id_cotizacion,
                    c.Fecha,
                    c.Total,
                    cl.Nombre,
                    cl.Apellido
                FROM cotizacion c
                INNER JOIN registro_cliente cl 
                    ON cl.id_Cliente = c.id_Cliente
                ORDER BY c.id_cotizacion DESC
                LIMIT ?
            ";

            $stmt = $this->connection->prepare($sql);
            if (!$stmt) return [];

            $stmt->bind_param("i", $limit);
            $stmt->execute();
            $res = $stmt->get_result();

            $items = [];
            while ($row = $res->fetch_assoc()) {
                $items[] = $row;
            }
            $stmt->close();

            return $items;
        }

         // Cuenta cuántas cotizaciones hay (puedes llamarlas "activas")
        public function contarCotizaciones(): int {
            $sql = "SELECT COUNT(*) AS total FROM cotizacion";
            $res = $this->connection->query($sql);
            if (!$res) return 0;
            $row = $res->fetch_assoc();
            return (int)($row['total'] ?? 0);
        }

    
            // ============================================
    //  RESPALDO DE BASE DE DATOS
    // ============================================
    public function backup_tables($host,$user,$pass,$name,$tables = '*'){
        $return='';
        $link = new mysqli($host,$user,$pass,$name);
        
        if($tables == '*') {
            $tables = [];
            $result = $link->query('SHOW TABLES');

            while($row = mysqli_fetch_row($result)) {
                $tables[] = $row[0];
            }
        } else {
            $tables = is_array($tables) ? $tables : explode(',',$tables);
        }
        
        foreach($tables as $table) {
            $result = $link->query('SELECT * FROM '.$table);
            $num_fields = mysqli_num_fields($result);

            $row2 = mysqli_fetch_row($link->query('SHOW CREATE TABLE '.$table));

            $return .= "\n\nDROP TABLE IF EXISTS `$table`;\n";
            $return.= "\n\n".$row2[1].";\n\n";
            
            for ($i = 0; $i < $num_fields; $i++) {
                while($row = mysqli_fetch_row($result)) {
                    $return.= 'INSERT INTO '.$table.' VALUES(';
                    for($j=0; $j<$num_fields; $j++) {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = preg_replace("/\n/","\\n",$row[$j]);

                        if (isset($row[$j])) { 
                            $return.= '"'.$row[$j].'"' ; 
                        } else { 
                            $return.= '""'; 
                        }

                        if ($j<($num_fields-1)) { $return.= ','; }
                    }
                    $return.= ");\n";
                }
            }
            $return.="\n\n\n";
        }

        $fecha=date("Y-m-d");

        if (!file_exists("config/backups/")) {
            mkdir("config/backups/", 0777, true);
        }

        $ruta = 'config/backups/db-backup-'.$fecha.'.sql';
        $handle = fopen($ruta,'w+');
        fwrite($handle,$return);
        fclose($handle);

        return $ruta;
    }


    // ============================================
    //  RESTAURAR BASE DE DATOS
    // ============================================
    public function restaurarBD($ruta){
        $query_archivo = file_get_contents($ruta);

        if($this->connection->multi_query($query_archivo)) {
            do {
                if($result = $this->connection->store_result()){
                    $result->free();
                }
            } while($this->connection->more_results() && $this->connection->next_result());

            return "restauracion exitosa";
        } else {
            return "Error en la restauracion";
        }
    }


}
