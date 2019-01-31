<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Professeurs extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Professeurs_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('professeurs/professeurs_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Professeurs_model->json();
    }

    public function read($id) 
    {
        $row = $this->Professeurs_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idProf' => $row->idProf,
		'matriculeProf' => $row->matriculeProf,
		'nomProf' => $row->nomProf,
		'postnomProf' => $row->postnomProf,
		'prenomProf' => $row->prenomProf,
		'emailProf' => $row->emailProf,
	    );
            $this->load->view('professeurs/professeurs_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('professeurs'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('professeurs/create_action'),
	    'idProf' => set_value('idProf'),
	    'matriculeProf' => set_value('matriculeProf'),
	    'nomProf' => set_value('nomProf'),
	    'postnomProf' => set_value('postnomProf'),
	    'prenomProf' => set_value('prenomProf'),
	    'emailProf' => set_value('emailProf'),
	);
        $this->load->view('professeurs/professeurs_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'matriculeProf' => $this->input->post('matriculeProf',TRUE),
		'nomProf' => $this->input->post('nomProf',TRUE),
		'postnomProf' => $this->input->post('postnomProf',TRUE),
		'prenomProf' => $this->input->post('prenomProf',TRUE),
		'emailProf' => $this->input->post('emailProf',TRUE),
	    );

            $this->Professeurs_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('professeurs'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Professeurs_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('professeurs/update_action'),
		'idProf' => set_value('idProf', $row->idProf),
		'matriculeProf' => set_value('matriculeProf', $row->matriculeProf),
		'nomProf' => set_value('nomProf', $row->nomProf),
		'postnomProf' => set_value('postnomProf', $row->postnomProf),
		'prenomProf' => set_value('prenomProf', $row->prenomProf),
		'emailProf' => set_value('emailProf', $row->emailProf),
	    );
            $this->load->view('professeurs/professeurs_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('professeurs'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idProf', TRUE));
        } else {
            $data = array(
		'matriculeProf' => $this->input->post('matriculeProf',TRUE),
		'nomProf' => $this->input->post('nomProf',TRUE),
		'postnomProf' => $this->input->post('postnomProf',TRUE),
		'prenomProf' => $this->input->post('prenomProf',TRUE),
		'emailProf' => $this->input->post('emailProf',TRUE),
	    );

            $this->Professeurs_model->update($this->input->post('idProf', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('professeurs'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Professeurs_model->get_by_id($id);

        if ($row) {
            $this->Professeurs_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('professeurs'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('professeurs'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('matriculeProf', 'matriculeprof', 'trim|required');
	$this->form_validation->set_rules('nomProf', 'nomprof', 'trim|required');
	$this->form_validation->set_rules('postnomProf', 'postnomprof', 'trim|required');
	$this->form_validation->set_rules('prenomProf', 'prenomprof', 'trim|required');
	$this->form_validation->set_rules('emailProf', 'emailprof', 'trim|required');

	$this->form_validation->set_rules('idProf', 'idProf', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "professeurs.xls";
        $judul = "professeurs";
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
	xlsWriteLabel($tablehead, $kolomhead++, "MatriculeProf");
	xlsWriteLabel($tablehead, $kolomhead++, "NomProf");
	xlsWriteLabel($tablehead, $kolomhead++, "PostnomProf");
	xlsWriteLabel($tablehead, $kolomhead++, "PrenomProf");
	xlsWriteLabel($tablehead, $kolomhead++, "EmailProf");

	foreach ($this->Professeurs_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->matriculeProf);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomProf);
	    xlsWriteLabel($tablebody, $kolombody++, $data->postnomProf);
	    xlsWriteLabel($tablebody, $kolombody++, $data->prenomProf);
	    xlsWriteLabel($tablebody, $kolombody++, $data->emailProf);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Professeurs.php */
/* Location: ./application/controllers/Professeurs.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-14 11:45:34 */
/* http://harviacode.com */