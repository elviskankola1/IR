<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Departement extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Departement_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('departement/departement_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Departement_model->json();
    }

    public function read($id) 
    {
        $row = $this->Departement_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idDep' => $row->idDep,
		'nomDep' => $row->nomDep,
		'idFac' => $row->idFac,
		'detailsDep' => $row->detailsDep,
	    );
            $this->load->view('departement/departement_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('departement'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('departement/create_action'),
	    'idDep' => set_value('idDep'),
	    'nomDep' => set_value('nomDep'),
	    'idFac' => set_value('idFac'),
	    'detailsDep' => set_value('detailsDep'),
	);
        $this->load->view('departement/departement_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nomDep' => $this->input->post('nomDep',TRUE),
		'idFac' => $this->input->post('idFac',TRUE),
		'detailsDep' => $this->input->post('detailsDep',TRUE),
	    );

            $this->Departement_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('departement'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Departement_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('departement/update_action'),
		'idDep' => set_value('idDep', $row->idDep),
		'nomDep' => set_value('nomDep', $row->nomDep),
		'idFac' => set_value('idFac', $row->idFac),
		'detailsDep' => set_value('detailsDep', $row->detailsDep),
	    );
            $this->load->view('departement/departement_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('departement'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idDep', TRUE));
        } else {
            $data = array(
		'nomDep' => $this->input->post('nomDep',TRUE),
		'idFac' => $this->input->post('idFac',TRUE),
		'detailsDep' => $this->input->post('detailsDep',TRUE),
	    );

            $this->Departement_model->update($this->input->post('idDep', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('departement'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Departement_model->get_by_id($id);

        if ($row) {
            $this->Departement_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('departement'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('departement'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nomDep', 'nomdep', 'trim|required');
	$this->form_validation->set_rules('idFac', 'idfac', 'trim|required');
	$this->form_validation->set_rules('detailsDep', 'detailsdep', 'trim|required');

	$this->form_validation->set_rules('idDep', 'idDep', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "departement.xls";
        $judul = "departement";
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
	xlsWriteLabel($tablehead, $kolomhead++, "NomDep");
	xlsWriteLabel($tablehead, $kolomhead++, "IdFac");
	xlsWriteLabel($tablehead, $kolomhead++, "DetailsDep");

	foreach ($this->Departement_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomDep);
	    xlsWriteNumber($tablebody, $kolombody++, $data->idFac);
	    xlsWriteLabel($tablebody, $kolombody++, $data->detailsDep);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Departement.php */
/* Location: ./application/controllers/Departement.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-14 11:45:34 */
/* http://harviacode.com */