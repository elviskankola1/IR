<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pdf extends CI_Controller
{
    public function index()
    {
        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('welcome_message', [], true);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
