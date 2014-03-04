<?php
/** BASED FROM TUTORIAL 5 OF FPDF **/
define('FPDF_FONTPATH',APPPATH .'plugins/FPDF17/font/');
require(APPPATH .'plugins/FPDF17/fpdf.php');

class LogsPDF extends FPDF
{
    var $COLUMN_WIDTH = 30;

    function Header()
    {
        if($this->PageNo() == 1){
            // Logo
            $this->Image(base_url().'images/icon/logo_icon2_b.png',10,6,30);
            // Arial bold 15
            $this->SetFont('Arial','B',15);
            // Move to the right
            $this->Cell(65);
            // Title
            $this->Cell(60,10,'Transaction Log',0,0,'C');
            $this->Ln(20);
            $this->SetFont('Arial','',10);
            $this->Cell(60,10,'Date Generated: '.date("F d, Y"),0,0,'C');

            // Line break
            $this->Ln(10);
        }
    }

    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
    }


// Simple table
    function BasicTable($header, $data)
    {
        // Header
        foreach($header as $col)
            $this->Cell($this->COLUMN_WIDTH,7,$col,1);
        $this->Ln();
        // Data
        foreach($data as $row)
        {
            foreach($row as $col){
                $this->Cell($this->COLUMN_WIDTH,6,iconv('UTF-8', 'windows-1252', $col),1);
            }
            $this->Ln();
        }
    }

}
