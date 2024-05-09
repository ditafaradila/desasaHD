<?php

namespace App\Libraries;

use TCPDF;

class struk_tcpdf extends TCPDF {
    public function __construct() {
        parent::__construct('P', 'mm', array(80, 200), true, 'UTF-8', false); // Atur ukuran halaman dengan lebar 80mm dan panjang 200mm
        // Atur margin
        $this->SetMargins(0, 0, 0);
        // Atur pemisah halaman otomatis
        $this->SetAutoPageBreak(true, 10);
    }
    
    //Page header
    public function Header() {
        $image_file = ROOTPATH.'public/assets/img/logo desasa.png';
        $this->Image($image_file, 25, 10, 30);

        // Judul dan informasi perusahaan
        $this->SetFont('helvetica', 'B', 12);
        $this->SetXY(15, 45);
        $this->Cell(0, 5, 'Desasa Home Decor', 0, 1, 'C');

        $this->SetFont('helvetica', '', 9);
        $this->SetXY(15, 50);
        $this->Cell(0, 5, 'Jl. Gajah Mada Gg.Punai, No. 17, Bandar Lampung.', 0, 1, 'C');
        $this->SetXY(15, 55);
        $this->Cell(0, 5, 'Telp. 0852 6923 5577', 0, 1, 'C');
        $this->SetXY(15, 60);
        $this->Cell(0, 5, 'https://linktr.ee/desasa.official', 0, 1, 'C');

        // Garis pemisah
        $this->SetLineWidth(0.2);
        $this->Line(10, 70, 70, 70);
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Terima kasih telah berbelanja di Desasa Home Decor ><', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}