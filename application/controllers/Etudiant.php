<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Etudiant extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Etudiant_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('etudiant/etudiant_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Etudiant_model->json();
    }

    public function read($id) 
    {
        $row = $this->Etudiant_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idEtd' => $row->idEtd,
		'matriculeEtd' => $row->matriculeEtd,
		'nomEtd' => $row->nomEtd,
		'postnomEtd' => $row->postnomEtd,
		'prenomEtd' => $row->prenomEtd,
		'emailEtd' => $row->emailEtd,
		'genreEtd' => $row->genreEtd,
		'pwdEtd' => $row->pwdEtd,
	    );
            $this->load->view('etudiant/etudiant_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('etudiant'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('etudiant/create_action'),
	    'idEtd' => set_value('idEtd'),
	    'matriculeEtd' => set_value('matriculeEtd'),
	    'nomEtd' => set_value('nomEtd'),
	    'postnomEtd' => set_value('postnomEtd'),
	    'prenomEtd' => set_value('prenomEtd'),
	    'emailEtd' => set_value('emailEtd'),
	    'genreEtd' => set_value('genreEtd'),
	    'pwdEtd' => set_value('pwdEtd'),
	);
        $this->load->view('etudiant/etudiant_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'matriculeEtd' => $this->input->post('matriculeEtd',TRUE),
		'nomEtd' => $this->input->post('nomEtd',TRUE),
		'postnomEtd' => $this->input->post('postnomEtd',TRUE),
		'prenomEtd' => $this->input->post('prenomEtd',TRUE),
		'emailEtd' => $this->input->post('emailEtd',TRUE),
		'genreEtd' => $this->input->post('genreEtd',TRUE),
		'pwdEtd' => $this->input->post('pwdEtd',TRUE),
	    );

            $this->Etudiant_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('etudiant'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Etudiant_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('etudiant/update_action'),
		'idEtd' => set_value('idEtd', $row->idEtd),
		'matriculeEtd' => set_value('matriculeEtd', $row->matriculeEtd),
		'nomEtd' => set_value('nomEtd', $row->nomEtd),
		'postnomEtd' => set_value('postnomEtd', $row->postnomEtd),
		'prenomEtd' => set_value('prenomEtd', $row->prenomEtd),
		'emailEtd' => set_value('emailEtd', $row->emailEtd),
		'genreEtd' => set_value('genreEtd', $row->genreEtd),
		'pwdEtd' => set_value('pwdEtd', $row->pwdEtd),
	    );
            $this->load->view('etudiant/etudiant_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('etudiant'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idEtd', TRUE));
        } else {
            $data = array(
		'matriculeEtd' => $this->input->post('matriculeEtd',TRUE),
		'nomEtd' => $this->input->post('nomEtd',TRUE),
		'postnomEtd' => $this->input->post('postnomEtd',TRUE),
		'prenomEtd' => $this->input->post('prenomEtd',TRUE),
		'emailEtd' => $this->input->post('emailEtd',TRUE),
		'genreEtd' => $this->input->post('genreEtd',TRUE),
		'pwdEtd' => $this->input->post('pwdEtd',TRUE),
	    );

            $this->Etudiant_model->update($this->input->post('idEtd', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('etudiant'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Etudiant_model->get_by_id($id);

        if ($row) {
            $this->Etudiant_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('etudiant'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('etudiant'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('matriculeEtd', 'matriculeetd', 'trim|required');
	$this->form_validation->set_rules('nomEtd', 'nometd', 'trim|required');
	$this->form_validation->set_rules('postnomEtd', 'postnometd', 'trim|required');
	$this->form_validation->set_rules('prenomEtd', 'prenometd', 'trim|required');
	$this->form_validation->set_rules('emailEtd', 'emailetd', 'trim|required');
	$this->form_validation->set_rules('genreEtd', 'genreetd', 'trim|required');
	$this->form_validation->set_rules('pwdEtd', 'pwdetd', 'trim|required');

	$this->form_validation->set_rules('idEtd', 'idEtd', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "etudiant.xls";
        $judul = "etudiant";
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
	xlsWriteLabel($tablehead, $kolomhead++, "MatriculeEtd");
	xlsWriteLabel($tablehead, $kolomhead++, "NomEtd");
	xlsWriteLabel($tablehead, $kolomhead++, "PostnomEtd");
	xlsWriteLabel($tablehead, $kolomhead++, "PrenomEtd");
	xlsWriteLabel($tablehead, $kolomhead++, "EmailEtd");
	xlsWriteLabel($tablehead, $kolomhead++, "GenreEtd");
	xlsWriteLabel($tablehead, $kolomhead++, "PwdEtd");

	foreach ($this->Etudiant_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->matriculeEtd);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomEtd);
	    xlsWriteLabel($tablebody, $kolombody++, $data->postnomEtd);
	    xlsWriteLabel($tablebody, $kolombody++, $data->prenomEtd);
	    xlsWriteLabel($tablebody, $kolombody++, $data->emailEtd);
	    xlsWriteLabel($tablebody, $kolombody++, $data->genreEtd);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pwdEtd);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Etudiant.php */
/* Location: ./application/controllers/Etudiant.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-14 11:45:34 */
/* http://harviacode.com */