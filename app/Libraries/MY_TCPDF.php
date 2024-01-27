<?php

namespace App\Libraries;

use TCPDF;

class MY_TCPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = ROOTPATH.'public/assets/img/logo desasa.png';

        $this->Image($image_file, '20', '0', 30);
        // Set font
        $this->SetFont('helvetica', 'B', 11);
        $this->SetX(70);
        $this->Cell(0, 2, 'Desasa Home Decor', 0, 1, '', 0, '', 0);
        // Title
        $this->SetFont('helvetica', '', 9);
        $this->SetX(70);
        $this->Cell(0, 2, 'Jl. Gajah Mada Gg.Punai, No. 17, Bandar Lampung.', 0, 1, '', 0, '', 0);
        $this->SetX(70);
        $this->Cell(0, 2, 'Telp. 0852 6923 5577', 0, 1, '', 0, '', 0);
        $this->SetX(70);
        $this->Cell(0, 2, 'https://linktr.ee/desasa.official', 0, 1, '', 0, '', 0);
        
        // QRCODE,H : QR-CODE Best error correction
        $this->write2DBarcode('https://linktr.ee/desasa.official', 'QRCODE,H', 0, 3, 20, 20, ['position' => 'R'], 'N');

        $style = array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
        $this->Line(15, 25, 195, 25, $style);

    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}