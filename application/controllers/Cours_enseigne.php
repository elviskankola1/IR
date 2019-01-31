<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cours_enseigne extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cours_enseigne_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('cours_enseigne/cours_enseigne_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Cours_enseigne_model->json();
    }

    public function read($id) 
    {
        $row = $this->Cours_enseigne_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idCe' => $row->idCe,
		'idPe' => $row->idPe,
		'idProf' => $row->idProf,
		'idCours' => $row->idCours,
	    );
            $this->load->view('cours_enseigne/cours_enseigne_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cours_enseigne'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('cours_enseigne/create_action'),
	    'idCe' => set_value('idCe'),
	    'idPe' => set_value('idPe'),
	    'idProf' => set_value('idProf'),
	    'idCours' => set_value('idCours'),
	);
        $this->load->view('cours_enseigne/cours_enseigne_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'idPe' => $this->input->post('idPe',TRUE),
		'idProf' => $this->input->post('idProf',TRUE),
		'idCours' => $this->input->post('idCours',TRUE),
	    );

            $this->Cours_enseigne_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('cours_enseigne'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Cours_enseigne_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('cours_enseigne/update_action'),
		'idCe' => set_value('idCe', $row->idCe),
		'idPe' => set_value('idPe', $row->idPe),
		'idProf' => set_value('idProf', $row->idProf),
		'idCours' => set_value('idCours', $row->idCours),
	    );
            $this->load->view('cours_enseigne/cours_enseigne_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cours_enseigne'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idCe', TRUE));
        } else {
            $data = array(
		'idPe' => $this->input->post('idPe',TRUE),
		'idProf' => $this->input->post('idProf',TRUE),
		'idCours' => $this->input->post('idCours',TRUE),
	    );

            $this->Cours_enseigne_model->update($this->input->post('idCe', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('cours_enseigne'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Cours_enseigne_model->get_by_id($id);

        if ($row) {
            $this->Cours_enseigne_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('cours_enseigne'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cours_enseigne'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('idPe', 'idpe', 'trim|required');
	$this->form_validation->set_rules('idProf', 'idprof', 'trim|required');
	$this->form_validation->set_rules('idCours', 'idcours', 'trim|required');

	$this->form_validation->set_rules('idCe', 'idCe', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "cours_enseigne.xls";
        $judul = "cours_enseigne";
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
	xlsWriteLabel($tablehead, $kolomhead++, "IdPe");
	xlsWriteLabel($tablehead, $kolomhead++, "IdProf");
	xlsWriteLabel($tablehead, $kolomhead++, "IdCours");

	foreach ($this->Cours_enseigne_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->idPe);
	    xlsWriteNumber($tablebody, $kolombody++, $data->idProf);
	    xlsWriteNumber($tablebody, $kolombody++, $data->idCours);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Cours_enseigne.php */
/* Location: ./application/controllers/Cours_enseigne.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-14 11:45:33 */
/* http://harviacode.com */