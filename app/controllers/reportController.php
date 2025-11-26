<?php

include_once "app/models/reportModel.php";
include_once __DIR__ . "/../../Public/libraries/fpdf/fpdf.php";
// OJO: ya no usamos PHPlot aquí porque tu gráfica la hacemos a mano
// include_once __DIR__ . "/../../Public/libraries/phplot/phplot.php";

class reportController {

    private $model;

    public function __construct($connection){
        $this->model = new reportModel($connection);
    }

    // 1) PDF individual por cotización
    public function pdfCotizacion($id){

        $general = $this->model->consultarCotizacionPorId($id);
        $detalle = $this->model->consultarDetalle($id);

        $pdf = new FPDF();
        $pdf->AddPage();

        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(0,10,'Cotizacion #'.$id,0,1,'C');

        $pdf->SetFont('Arial','',12);
        $pdf->Ln(4);
        $pdf->Cell(0,8,'Cliente: '.$general['id_Cliente'],0,1);
        $pdf->Cell(0,8,'Fecha: '.$general['Fecha'],0,1); 
        $pdf->Ln(4);

        // Tabla detalle
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(40,8,'Material',1);
        $pdf->Cell(25,8,'Ancho',1);
        $pdf->Cell(25,8,'Alto',1);
        $pdf->Cell(20,8,'Cant.',1);
        $pdf->Cell(40,8,'P.Unit',1);
        $pdf->Cell(40,8,'Subtotal',1);
        $pdf->Ln();

        $pdf->SetFont('Arial','',11);
        while($d = $detalle->fetch_assoc()){
            $pdf->Cell(40,8,$d['id_material'],1);
            $pdf->Cell(25,8,$d['ancho_cm'],1);
            $pdf->Cell(25,8,$d['alto_cm'],1);
            $pdf->Cell(20,8,$d['cantidad'],1);
            $pdf->Cell(40,8,$d['precio_unitario'],1);
            $pdf->Cell(40,8,$d['subtotal'],1);
            $pdf->Ln();
        }

        // Totales
        $pdf->Ln(6);
        $pdf->Cell(0,8,'Subtotal: $'.$general['Subtotal'],0,1);
        $pdf->Cell(0,8,'Descuento: $'.$general['Descuento'],0,1);
        $pdf->Cell(0,8,'Mano de obra: $'.$general['Mano_obra'],0,1);
        $pdf->Cell(0,8,'Impuestos: $'.$general['Impuestos'],0,1);

        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(0,10,'TOTAL: $'.$general['Total'],0,1);

        $pdf->Output();
        exit;
    }


    // 2) PDF general de cotizaciones (FILTRADO) ✅ CORREGIDO MEDIDAS
    public function pdfGeneralCotizaciones(){

        // filtros
        $inicio    = $_GET['inicio'] ?? date("Y-m-01");
        $fin       = $_GET['fin'] ?? date("Y-m-d");
        $clienteId = $_GET['cliente'] ?? null;

        $cotizaciones = $this->model->consultarCotizacionesFiltradas($inicio, $fin, $clienteId);

        // totales
        $totalCotizaciones = 0;
        $sumaSubtotal = 0;
        $sumaDescuento = 0;
        $sumaImpuestos = 0;
        $sumaTotal = 0;

        $pdf = new FPDF("P","mm","A4");
        $pdf->AddPage();

        // Encabezado
        $pdf->SetFont("Arial","B",14);
        $pdf->Cell(0,8,"Coti Express",0,1,"C");
        $pdf->SetFont("Arial","B",12);
        $pdf->Cell(0,8,"Reporte de Cotizaciones",0,1,"C");
        $pdf->Ln(2);

        $pdf->SetFont("Arial","",10);
        $pdf->Cell(0,6,"Periodo consultado: $inicio al $fin",0,1);
        $pdf->Cell(0,6,"Fecha de generacion: ".date("Y-m-d H:i"),0,1);

        $filtroClienteTxt = $clienteId ? "Cliente filtrado: ID $clienteId" : "Cliente filtrado: TODOS";
        $pdf->Cell(0,6,$filtroClienteTxt,0,1);
        $pdf->Ln(3);

        // ====== MEDIDAS FIJAS (TOTAL 190mm) ======
        $wID       = 10;
        $wFecha    = 22;
        $wCliente  = 38;
        $wConcepto = 45;
        $wSub      = 20;
        $wDesc     = 15;
        $wImp      = 15;
        $wTotal    = 25;
        // 10+22+38+45+20+15+15+25 = 190 ✅

        // Tabla header
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell($wID,8,'ID',1,0,'C');
        $pdf->Cell($wFecha,8,'Fecha',1,0,'C');
        $pdf->Cell($wCliente,8,'Cliente',1,0,'C');
        $pdf->Cell($wConcepto,8,'Concepto (Notas)',1,0,'C');
        $pdf->Cell($wSub,8,'Subtotal',1,0,'C');
        $pdf->Cell($wDesc,8,'Desc.',1,0,'C');
        $pdf->Cell($wImp,8,'Imp.',1,0,'C');
        $pdf->Cell($wTotal,8,'Total',1,1,'C');

        $pdf->SetFont("Arial","",9);

        while($row = $cotizaciones->fetch_assoc()){
            $totalCotizaciones++;

            $sumaSubtotal  += (float)$row['Subtotal'];
            $sumaDescuento += (float)$row['Descuento'];
            $sumaImpuestos += (float)$row['Impuestos'];
            $sumaTotal     += (float)$row['Total'];

            $clienteNombre = trim(($row['Nombre'] ?? '')." ".($row['Apellido'] ?? ''));

            // Fecha solo YYYY-MM-DD para que no se encime
            $fechaSolo = substr($row['Fecha'], 0, 10);

            // Concepto/Notas (máx 35 chars)
            $concepto = $row['Notas'] ?? '';
            $concepto = mb_substr($concepto, 0, 35);

            // Filas con los MISMOS anchos
            $pdf->Cell($wID,7,$row['id_cotizacion'],1,0,"C");
            $pdf->Cell($wFecha,7,$fechaSolo,1,0,"C");
            $pdf->Cell($wCliente,7,utf8_decode($clienteNombre),1,0);
            $pdf->Cell($wConcepto,7,utf8_decode($concepto),1,0);
            $pdf->Cell($wSub,7,"$".number_format($row['Subtotal'],2),1,0,"R");
            $pdf->Cell($wDesc,7,"$".number_format($row['Descuento'],2),1,0,"R");
            $pdf->Cell($wImp,7,"$".number_format($row['Impuestos'],2),1,0,"R");
            $pdf->Cell($wTotal,7,"$".number_format($row['Total'],2),1,1,"R");
        }

        // Resumen final
        $pdf->Ln(5);
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(0,7,"Resumen del periodo",0,1);

        $pdf->SetFont("Arial","",10);
        $pdf->Cell(0,6,"Total de cotizaciones: $totalCotizaciones",0,1);
        $pdf->Cell(0,6,"Suma Subtotal: $".number_format($sumaSubtotal,2),0,1);
        $pdf->Cell(0,6,"Suma Descuento: $".number_format($sumaDescuento,2),0,1);
        $pdf->Cell(0,6,"Suma Impuestos: $".number_format($sumaImpuestos,2),0,1);
        $pdf->Cell(0,6,"Suma Total Cotizada: $".number_format($sumaTotal,2),0,1);

        $pdf->Output("I","Reporte_Cotizaciones.pdf");
        exit;
    }


   // 3) PDF sencillo de materiales más usados (sin gráfica)
public function pdfGraficaMateriales(){

    $data = $this->model->obtenerTotalesPorMaterial();

    $pdf = new FPDF("P","mm","A4");
    $pdf->AddPage();

    // Encabezado
    $pdf->SetFont("Arial","B",14);
    $pdf->Cell(0,8,"Coti Express",0,1,"C");
    $pdf->SetFont("Arial","B",12);
    $pdf->Cell(0,8,"Reporte de Materiales Utilizados",0,1,"C");
    $pdf->Ln(4);

    $pdf->SetFont("Arial","",10);
    $pdf->Cell(0,6,"Fecha de generacion: ".date("Y-m-d H:i"),0,1);
    $pdf->Ln(4);

    // Tabla
    $pdf->SetFont("Arial","B",10);
    $pdf->Cell(120,8,"Material",1,0,"C");
    $pdf->Cell(60,8,"Total vendido",1,1,"C");

    $pdf->SetFont("Arial","",10);

    $suma = 0;
    foreach($data as $row){
        $material = $row[0];
        $total    = (float)$row[1];
        $suma += $total;

        $pdf->Cell(120,7,utf8_decode($material),1,0);
        $pdf->Cell(60,7,"$".number_format($total,2),1,1,"R");
    }

    // Resumen
    $pdf->Ln(5);
    $pdf->SetFont("Arial","B",11);
    $pdf->Cell(0,7,"Resumen",0,1);

    $pdf->SetFont("Arial","",10);
    $pdf->Cell(0,6,"Materiales distintos: ".count($data),0,1);
    $pdf->Cell(0,6,"Suma total vendida: $".number_format($suma,2),0,1);

    $pdf->Output("I","Reporte_Materiales.pdf");
    exit;
}
}