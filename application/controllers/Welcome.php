<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function index()
    {
        echo PHP_VERSION;
        die;
        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('welcome_message', [], true);
        var_dump($mpdf);
        //$mpdf->WriteHTML($html);
        //$mpdf->Output(); // opens in browser
            //$mpdf->Output('arjun.pdf','D'); // it downloads the file into the user system, with give name
    }
}
