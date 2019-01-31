<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cours extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cours_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('cours/cours_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Cours_model->json();
    }

    public function read($id) 
    {
        $row = $this->Cours_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idCours' => $row->idCours,
		'nomCours' => $row->nomCours,
		'detailsCours' => $row->detailsCours,
	    );
            $this->load->view('cours/cours_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cours'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('cours/create_action'),
	    'idCours' => set_value('idCours'),
	    'nomCours' => set_value('nomCours'),
	    'detailsCours' => set_value('detailsCours'),
	);
        $this->load->view('cours/cours_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nomCours' => $this->input->post('nomCours',TRUE),
		'detailsCours' => $this->input->post('detailsCours',TRUE),
	    );

            $this->Cours_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('cours'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Cours_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('cours/update_action'),
		'idCours' => set_value('idCours', $row->idCours),
		'nomCours' => set_value('nomCours', $row->nomCours),
		'detailsCours' => set_value('detailsCours', $row->detailsCours),
	    );
            $this->load->view('cours/cours_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cours'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idCours', TRUE));
        } else {
            $data = array(
		'nomCours' => $this->input->post('nomCours',TRUE),
		'detailsCours' => $this->input->post('detailsCours',TRUE),
	    );

            $this->Cours_model->update($this->input->post('idCours', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('cours'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Cours_model->get_by_id($id);

        if ($row) {
            $this->Cours_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('cours'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cours'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nomCours', 'nomcours', 'trim|required');
	$this->form_validation->set_rules('detailsCours', 'detailscours', 'trim|required');

	$this->form_validation->set_rules('idCours', 'idCours', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "cours.xls";
        $judul = "cours";
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
	xlsWriteLabel($tablehead, $kolomhead++, "NomCours");
	xlsWriteLabel($tablehead, $kolomhead++, "DetailsCours");

	foreach ($this->Cours_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomCours);
	    xlsWriteLabel($tablebody, $kolombody++, $data->detailsCours);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Cours.php */
/* Location: ./application/controllers/Cours.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-14 11:45:33 */
/* http://harviacode.com */