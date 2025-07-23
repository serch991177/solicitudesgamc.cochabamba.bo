<?php
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
       $this->SetY(10);
        $this->SetFont('helvetica', 'B', 8);
        $this->Image(K_PATH_IMAGES.'logo.png', 220, 5, 60, 15, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
        $this->Cell(2, 5, '');
        $this->Cell(0, 5, 'Gobierno Autónomo Municipal de Cochabamba', 0, 1);
        $this->Cell(2, 5, '');
        $this->Cell(0, 5, 'Propuesta Recepcionada', 0, 1);
        $this->Cell(0, 5, '', 0, 1);
        $style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
        $this->Line(16, 22, 200, 22, $style);
        
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('dejavusans', 'I', 8);
        // Page number
        $style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
        $this->Line(16, 280, 190, 280, $style);
        setlocale(LC_ALL, 'es_MX');
        $fecha = date('d-m-Y h:i:s A');
        $this->Cell(50, 10, $fecha, 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}


// create new PDF document
$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetTitle('PROPUESTA');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,25), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 25);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
$pdf->SetFont('helvetica', 'B', 15, '', true);
$pdf->setXY(20, 23);
$pdf->Write(10, 'PROPUESTA', null, false, 'C', true);
$style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
$pdf->Line(16, 34, 200, 34, $style);
$pdf->ln(10);

$pdf->SetFont('helvetica', 'B', 11, '', true);
$pdf->Cell(0, 8, 'DATOS DEL ÍTEM SOLICTADO', 0, 1, 'C', 0, '', 0);
$pdf->ln(5);
$pdf->SetFont('helvetica', 'B', 8, '', true);
$pdf->Cell(0, 8, 'ÍTEM', 1, 1, 'C', 0, '', 0);
$pdf->MultiCell(0, 9, $item->nombre_item."\n", 1, 'C', 0, 1, '' ,'', true);


$pdf->SetFont('helvetica', 'B', 8, '', true);
$pdf->Cell(55, 8, 'TIEMPO DE ENTREGA:', 1, 0, 'C', 0, '', 0);
$pdf->SetFont('helvetica', '', 8, '', true);
$pdf->Cell(125, 8, $item->tiempo_entrega, 1, 1, 'C', 0, '', 0);

$pdf->SetFont('helvetica', 'B', 8, '', true);
$pdf->Cell(55, 8, 'VALIDEZ DE LA PROPUESTA:', 1, 0, 'C', 0, '', 0);
$pdf->SetFont('helvetica', '', 8, '', true);
$pdf->Cell(125, 8, $item->validez, 1, 1, 'C', 0, '', 0);

$pdf->SetFont('helvetica', 'B', 8, '', true);
$pdf->Cell(55, 8, 'FORMA ENTREGA:', 1, 0, 'C', 0, '', 0);
$pdf->SetFont('helvetica', '', 8, '', true);
$pdf->MultiCell(125, 8, $item->forma_entrega."\n", 1, 'C', 0, 1, '' ,'', true);

$pdf->SetFont('helvetica', 'B', 8, '', true);
$pdf->Cell(20, 8, 'CANTIDAD:', 1, 0, 'C', 0, '', 0);
$pdf->SetFont('helvetica', '', 8, '', true);
$pdf->Cell(20, 8, $item->cantidad, 1, 0, 'C', 0, '', 0);

$pdf->SetFont('helvetica', 'B', 8, '', true);
$pdf->Cell(30, 8, 'UNIDAD DE MEDIDA:', 1, 0, 'C', 0, '', 0);
$pdf->SetFont('helvetica', '', 8, '', true);
$pdf->Cell(30, 8, $item->unidad_medida, 1, 0, 'C', 0, '', 0);

$pdf->SetFont('helvetica', 'B', 8, '', true);
$pdf->Cell(30, 8, 'PROCEDENCIA:', 1, 0, 'C', 0, '', 0);
$pdf->SetFont('helvetica', '', 8, '', true);
$pdf->Cell(50, 8, $item->procedencia, 1, 1, 'C', 0, '', 0);

$pdf->ln(2);


$pdf->SetFont('helvetica', 'B', 11, '', true);
$pdf->Cell(0, 8, 'PROPUESTA', 0, 1, 'C', 0, '', 0);
$pdf->ln(2);



$pdf->SetFont('helvetica', 'B', 7, '', true);

$pdf->Cell(90, 8, 'Razón Social/Nombre Empresa/Persona', 1, 0, 'C', 0, '', 0);
$pdf->Cell(25, 8, 'Precio Propuesto', 1, 0, 'C', 0, '', 0);
$pdf->Cell(40, 8, 'Fecha de Registro de Propuesta', 1, 0, 'C', 0, '', 0);
$pdf->Cell(25, 8, 'Adjunto Propuesta', 1, 1, 'C', 0, '', 0);

$pdf->SetFont('helvetica', '', 6, '', true);

$date = date('Y-m-d');

/*if ($item->fecha_limite >= $date)
{
    $precio = "OCULTO";
}*/
//else{
    $precio = $propuesta->precio_propuesto;
//}
$pdf->SetFont('helvetica', 'B', 7, '', true); 
$pdf->Cell(90, 8, $propuesta->nombre_completo, 1, 0, 'C', 0, '', 0);
$pdf->Cell(25, 8, $precio, 1, 0, 'C', 0, '', 0);
$pdf->SetFont('helvetica', '', 6, '', true);
$pdf->Cell(40, 8, $propuesta->fecha_format, 1, 0, 'C', 0, '', 0);
$pdf->Cell(25, 8, ($propuesta->file_cotizacion) ? 'SI' : 'NO', 1, 1, 'C', 0, '', 0);

$pdf->SetFont('helvetica', 'B', 9, '', true);
$pdf->Cell(0, 8, 'DATOS DE CONTACTO', 1, 1, 'C', 0, '', 0);

$pdf->SetFont('helvetica', 'B', 8, '', true);
$pdf->Cell(40, 8, 'NÚMERO DE CELULAR', 1, 0, 'C', 0, '', 0);
$pdf->SetFont('helvetica', '', 8, '', true);
$pdf->Cell(40, 8, $propuesta->celular, 1, 0, 'C', 0, '', 0);

$pdf->SetFont('helvetica', 'B', 8, '', true);
$pdf->Cell(45, 8, 'CORREO ELECTRÓNICO', 1, 0, 'C', 0, '', 0);
$pdf->SetFont('helvetica', '', 8, '', true);
$pdf->Cell(55, 8, $propuesta->correo_electronico, 1, 1, 'C', 0, '', 0);

$pdf->SetFont('helvetica', 'B', 8, '', true);
$pdf->Cell(40, 8, 'N° NIT', 1, 0, 'C', 0, '', 0);
$pdf->SetFont('helvetica', '', 8, '', true);
$pdf->Cell(40, 8, $propuesta->nit, 1, 0, 'C', 0, '', 0);

$pdf->SetFont('helvetica', 'B', 8, '', true);
$pdf->Cell(45, 8, 'REPRESENTANTE LEGAL', 1, 0, 'C', 0, '', 0);
$pdf->SetFont('helvetica', '', 8, '', true);
$pdf->Cell(55, 8, $propuesta->representante, 1, 1, 'C', 0, '', 0);


$pdf->SetFont('helvetica', 'B', 7, '', true);
$pdf->Cell(0, 8, 'DETALLE DE PROPUESTA', 1, 1, 'C', 0, '', 0);
$pdf->SetFont('helvetica', '', 7, '', true);
$pdf->writeHTMLCell(0, 0, '', '', html_entity_decode($propuesta->descripcion_propuesta)."\n", 'LRTB', 1, 0, true, 'L', true);    


$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

