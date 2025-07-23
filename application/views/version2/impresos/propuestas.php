<?php
class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        //$fecha = date('d-m-Y h:i:s A');
        setlocale(LC_ALL,"es_ES@euro","es_ES","esp");    
                
        $fecha = date('d-m-Y');

        $this->SetY(10);        
        $this->SetFont('helvetica', 'B', 8);
        //$this->Write(1,'Cochabamba, '.iconv('ISO-8859-2', 'UTF-8', strftime("%d de %B del %Y", strtotime($fecha))), '', false, 'R');
        $this->Write(1,'Cochabamba, '.$fecha, '', false, 'R');
        $this->ln(1);
        $this->Image(K_PATH_IMAGES . 'firma.png', 15, 5, 80, 20, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
        /* $this->Cell(18, 5, '');
        $this->Cell(0, 2, 'Gobierno Autónomo Municipal de Cochabamba', 0, 1);
        $this->Cell(18, 5, '');
        $this->Cell(0, 5, 'Reporte de Propuestas Realizadas', 0, 1);
        $this->Cell(18, 5, '', 0, 1);         */
        $style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
        $this->Line(16, 28, 200, 28, $style);
    }

    // Page footer
    public function Footer()
    {
        //$this->Rect(0, 280, 2000, 20,'F',array(),array(114, 245, 234));
        // Position at 15 mm from bottom
        $this->SetY(-18);
        // Set font
        $this->SetFont('helvetica', 'B', 7);
        // Page number
        /* $style = array('width' => 0.5, 'color' => array(240, 51, 44), 'cap' => 'butt');
        $this->Line(16, 280, 190, 280, $style); */
        setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");
        $this->Write(1, 'GOBIERNO AUTÓNOMO MUNICIPAL DE COCHABAMBA', '', false, 'L');
        $this->ln(1);
        $this->Write(6, 'Plaza 14 de septiembre N° 210 esquina General Achá', '', false, 'L');
        $this->ln(1);
        $this->Write(10, 'Telf: 4258030', '', false, 'L');
        $this->ln(1);
        $this->Write(14, 'www.cochabamba.bo', '', false, 'L');
        $this->ln(1);
        $this->Write(20, 'Pagina ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), '', false, 'L');
        $this->Image(K_PATH_IMAGES . 'adorno.png', 165, 273, 45, 27, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);     
    }
}


// create new PDF document
$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetTitle('REPORTE DE PROPUESTAS RECEPCIONADAS');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 25), array(0, 64, 128));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

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
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
$pdf->SetFont('helvetica', 'B', 15, '', true);
$pdf->setXY(20, 26);
$pdf->Write(10, 'REPORTE DE PROPUESTAS RECEPCIONADAS', null, false, 'C', true);
$style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
$pdf->Line(16, 34, 200, 34, $style);
$pdf->ln(10);

$pdf->SetFont('helvetica', 'B', 10, '', true);

$pdf->Write(8, 'DATOS DEL ÍTEM REQUERIDO', null, false, 'C', true);
/*******************************************************************************/

$pdf->SetFont('helvetica', 'B', 8, '', true);

$cuerpo = $this->load->view('version2/impresos/body/general', '', TRUE);

$pdf->writeHTML($cuerpo, true, false, true, false, 'C');

$pdf->SetFont('helvetica', 'B', 10, '', true);

$pdf->Write(8, 'PROPUESTAS RECEPCIONADAS', null, false, 'C', true);

$pdf->SetFont('helvetica', 'B', 7, '', true);

$cuerpo = $this->load->view('version2/impresos/body/tabla_general', '', TRUE);

$pdf->writeHTML($cuerpo, true, false, true, false, 'C');

$pdf->Output('PropuestaRecepcionadas.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+