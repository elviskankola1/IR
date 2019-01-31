<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Verif_result extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Verif_result_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('verif_result/verif_result_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Verif_result_model->json();
    }

    public function read($id) 
    {
        $row = $this->Verif_result_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idVr' => $row->idVr,
		'idEtd' => $row->idEtd,
		'dateConnexion' => $row->dateConnexion,
		'etat' => $row->etat,
		'nbV' => $row->nbV,
		'nbTele' => $row->nbTele,
	    );
            $this->load->view('verif_result/verif_result_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('verif_result'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('verif_result/create_action'),
	    'idVr' => set_value('idVr'),
	    'idEtd' => set_value('idEtd'),
	    'dateConnexion' => set_value('dateConnexion'),
	    'etat' => set_value('etat'),
	    'nbV' => set_value('nbV'),
	    'nbTele' => set_value('nbTele'),
	);
        $this->load->view('verif_result/verif_result_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'idEtd' => $this->input->post('idEtd',TRUE),
		'dateConnexion' => $this->input->post('dateConnexion',TRUE),
		'etat' => $this->input->post('etat',TRUE),
		'nbV' => $this->input->post('nbV',TRUE),
		'nbTele' => $this->input->post('nbTele',TRUE),
	    );

            $this->Verif_result_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('verif_result'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Verif_result_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('verif_result/update_action'),
		'idVr' => set_value('idVr', $row->idVr),
		'idEtd' => set_value('idEtd', $row->idEtd),
		'dateConnexion' => set_value('dateConnexion', $row->dateConnexion),
		'etat' => set_value('etat', $row->etat),
		'nbV' => set_value('nbV', $row->nbV),
		'nbTele' => set_value('nbTele', $row->nbTele),
	    );
            $this->load->view('verif_result/verif_result_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('verif_result'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idVr', TRUE));
        } else {
            $data = array(
		'idEtd' => $this->input->post('idEtd',TRUE),
		'dateConnexion' => $this->input->post('dateConnexion',TRUE),
		'etat' => $this->input->post('etat',TRUE),
		'nbV' => $this->input->post('nbV',TRUE),
		'nbTele' => $this->input->post('nbTele',TRUE),
	    );

            $this->Verif_result_model->update($this->input->post('idVr', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('verif_result'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Verif_result_model->get_by_id($id);

        if ($row) {
            $this->Verif_result_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('verif_result'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('verif_result'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('idEtd', 'idetd', 'trim|required');
	$this->form_validation->set_rules('dateConnexion', 'dateconnexion', 'trim|required');
	$this->form_validation->set_rules('etat', 'etat', 'trim|required');
	$this->form_validation->set_rules('nbV', 'nbv', 'trim|required');
	$this->form_validation->set_rules('nbTele', 'nbtele', 'trim|required');

	$this->form_validation->set_rules('idVr', 'idVr', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "verif_result.xls";
        $judul = "verif_result";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "IdEtd");
	xlsWriteLabel($tablehead, $kolomhead++, "DateConnexion");
	xlsWriteLabel($tablehead, $kolomhead++, "Etat");
	xlsWriteLabel($tablehead, $kolomhead++, "NbV");
	xlsWriteLabel($tablehead, $kolomhead++, "NbTele");

	foreach ($this->Verif_result_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->idEtd);
	    xlsWriteLabel($tablebody, $kolombody++, $data->dateConnexion);
	    xlsWriteNumber($tablebody, $kolombody++, $data->etat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nbV);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nbTele);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Verif_result.php */
/* Location: ./application/controllers/Verif_result.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-14 11:45:37 */
/* http://harviacode.com */