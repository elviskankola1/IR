<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Recours extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Recours_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('recours/recours_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Recours_model->json();
    }

    public function read($id) 
    {
        $row = $this->Recours_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idRecours' => $row->idRecours,
		'idEtd' => $row->idEtd,
		'dateRec' => $row->dateRec,
		'txtRecours' => $row->txtRecours,
	    );
            $this->load->view('recours/recours_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('recours'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('recours/create_action'),
	    'idRecours' => set_value('idRecours'),
	    'idEtd' => set_value('idEtd'),
	    'dateRec' => set_value('dateRec'),
	    'txtRecours' => set_value('txtRecours'),
	);
        $this->load->view('recours/recours_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'idEtd' => $this->input->post('idEtd',TRUE),
		'dateRec' => $this->input->post('dateRec',TRUE),
		'txtRecours' => $this->input->post('txtRecours',TRUE),
	    );

            $this->Recours_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('recours'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Recours_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('recours/update_action'),
		'idRecours' => set_value('idRecours', $row->idRecours),
		'idEtd' => set_value('idEtd', $row->idEtd),
		'dateRec' => set_value('dateRec', $row->dateRec),
		'txtRecours' => set_value('txtRecours', $row->txtRecours),
	    );
            $this->load->view('recours/recours_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('recours'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idRecours', TRUE));
        } else {
            $data = array(
		'idEtd' => $this->input->post('idEtd',TRUE),
		'dateRec' => $this->input->post('dateRec',TRUE),
		'txtRecours' => $this->input->post('txtRecours',TRUE),
	    );

            $this->Recours_model->update($this->input->post('idRecours', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('recours'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Recours_model->get_by_id($id);

        if ($row) {
            $this->Recours_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('recours'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('recours'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('idEtd', 'idetd', 'trim|required');
	$this->form_validation->set_rules('dateRec', 'daterec', 'trim|required');
	$this->form_validation->set_rules('txtRecours', 'txtrecours', 'trim|required');

	$this->form_validation->set_rules('idRecours', 'idRecours', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "recours.xls";
        $judul = "recours";
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
	xlsWriteLabel($tablehead, $kolomhead++, "DateRec");
	xlsWriteLabel($tablehead, $kolomhead++, "TxtRecours");

	foreach ($this->Recours_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->idEtd);
	    xlsWriteLabel($tablebody, $kolombody++, $data->dateRec);
	    xlsWriteLabel($tablebody, $kolombody++, $data->txtRecours);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Recours.php */
/* Location: ./application/controllers/Recours.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-14 11:45:36 */
/* http://harviacode.com */