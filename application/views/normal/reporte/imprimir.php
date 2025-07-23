<?php
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
       $this->SetY(10);
        $this->SetFont('dejavusans', 'B', 8);
        $this->Image(K_PATH_IMAGES.'logo.png', 220, 5, 60, 15, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
        $this->Cell(2, 5, '');
        $this->Cell(0, 5, 'Gobierno Autónomo Municipal de Cochabamba', 0, 1);
        $this->Cell(2, 5, '');
        $this->Cell(0, 5, 'Reporte General de Ítems', 0, 1);
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
$pdf->SetTitle('REPORTE GENERAL DE ÍTEMS PUBLICADOS');

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
$pdf->SetFont('dejavusans', 'B', 15, '', true);
$pdf->setXY(20, 23);
$pdf->Write(10, 'REPORTE GENERAL DE ÍTEMS PUBLICADOS', null, false, 'L', true);
$style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
$pdf->Line(16, 34, 200, 34, $style);
$pdf->ln(15);

$pdf->SetFont('dejavusans', 'B', 15, '', true);
$pdf->setXY(20, 23);
$pdf->Write(10, 'REPORTE GENERAL DE ÍTEMS PUBLICADOS', null, false, 'L', true);
$style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
$pdf->Line(16, 34, 200, 34, $style);
$pdf->ln(15);

$pdf->SetFont('helvetica', 'B', 8, '', true);
$pdf->Cell(0, 8, 'GRUPO', 1, 1, 'C', 0, '', 0);
if(isset($grupo->nombre_grupo))
    $pdf->MultiCell(0, 9, $grupo->nombre_grupo."\n", 1, 'C', 0, 1, '' ,'', true);
else
    $pdf->MultiCell(0, 9, 'TODOS LOS GRUPOS'."\n", 1, 'C', 0, 1, '' ,'', true);
$pdf->SetFont('helvetica', 'B', 8, '', true);
$pdf->Cell(50, 8, 'FECHA DE PUBLICACÍON INICIAL:', 1, 0, 'C', 0, '', 0);
$pdf->SetFont('helvetica', '', 8, '', true);
$pdf->Cell(40, 8, $inicial, 1, 0, 'C', 0, '', 0);

$pdf->SetFont('helvetica', 'B', 8, '', true);
$pdf->Cell(50, 8, 'FECHA DE PUBLICACÍON FINAL:', 1, 0, 'C', 0, '', 0);
$pdf->SetFont('helvetica', '', 8, '', true);
$pdf->Cell(40, 8, $final, 1, 0, 'C', 0, '', 0);

$pdf->ln(15);

$pdf->SetFont('dejavusans', '', 6, '', true);

$html = '';

$html.='
<table cellpadding="4" cellspacing="2" border="1">
	<tr>
        <th width="5%"><b>Nº</b></th>
        <th width="7%"><b>CÓDIGO</b></th>
        <th width="27%"><b>ÍTEM</b></th>
        <th width="10%"><b>CANTIDAD REQUERIDA</b></th>
        <th width="10%"><b>UNIDAD DE MEDIDA</b></th>
        <th width="12%"><b>Nº DE PROPONENTES</b></th>
        <th width="11%"><b>FECHA DE PUBLICACIÓN</b></th>
        <th width="10%"><b>FECHA LIMITE</b></th>
        <th width="8%"><b>ESTADO</b></th>
	</tr>';

$bg = 0;
$color= 'background-color:#DFDFDF';

$numero = 1;
$date = date('Y-m-d');
foreach ($reporte as $row) {

    
    if($row->limite <= $date)
    {
        $estado = 'ACTIVO';
    }
    else{
        $estado = 'VENCIDO';
    }

    $html.= '<tr style="text-align:justify; '. (($bg) ? $color : "").'">
				<td>'.$row->row.'</td>
                <td>'.$row->codigo.'</td>
                <td>'.$row->nombre_item.'</td>
                <td>'.$row->cantidad.'</td>
				<td>'.$row->unidad_medida.'</td>
				<td>'.$row->proponentes.'</td>
                <td>'.$row->publicacion.'</td>
                <td>'.$row->limite.'</td>
                <td>'.$estado.'</td>
			 </tr>';
	$bg = !$bg;
    $numero++;
}

$html.='</table>';

$pdf->writeHTML($html, true, true, true, true, '');


// ---------------------------------------------------------


$js = <<<EOD
            
            function Regresar() {
               window.location.href = "http://www.w3schools.com";
            }
EOD;

$pdf->IncludeJS($js);

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

