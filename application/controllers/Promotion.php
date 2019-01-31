<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promotion extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Promotion_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('promotion/promotion_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Promotion_model->json();
    }

    public function read($id) 
    {
        $row = $this->Promotion_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idPromo' => $row->idPromo,
		'nomPromo' => $row->nomPromo,
		'idDept' => $row->idDept,
		'detailsPromo' => $row->detailsPromo,
	    );
            $this->load->view('promotion/promotion_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('promotion'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('promotion/create_action'),
	    'idPromo' => set_value('idPromo'),
	    'nomPromo' => set_value('nomPromo'),
	    'idDept' => set_value('idDept'),
	    'detailsPromo' => set_value('detailsPromo'),
	);
        $this->load->view('promotion/promotion_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nomPromo' => $this->input->post('nomPromo',TRUE),
		'idDept' => $this->input->post('idDept',TRUE),
		'detailsPromo' => $this->input->post('detailsPromo',TRUE),
	    );

            $this->Promotion_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('promotion'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Promotion_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('promotion/update_action'),
		'idPromo' => set_value('idPromo', $row->idPromo),
		'nomPromo' => set_value('nomPromo', $row->nomPromo),
		'idDept' => set_value('idDept', $row->idDept),
		'detailsPromo' => set_value('detailsPromo', $row->detailsPromo),
	    );
            $this->load->view('promotion/promotion_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('promotion'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idPromo', TRUE));
        } else {
            $data = array(
		'nomPromo' => $this->input->post('nomPromo',TRUE),
		'idDept' => $this->input->post('idDept',TRUE),
		'detailsPromo' => $this->input->post('detailsPromo',TRUE),
	    );

            $this->Promotion_model->update($this->input->post('idPromo', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('promotion'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Promotion_model->get_by_id($id);

        if ($row) {
            $this->Promotion_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('promotion'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('promotion'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nomPromo', 'nompromo', 'trim|required');
	$this->form_validation->set_rules('idDept', 'iddept', 'trim|required');
	$this->form_validation->set_rules('detailsPromo', 'detailspromo', 'trim|required');

	$this->form_validation->set_rules('idPromo', 'idPromo', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "promotion.xls";
        $judul = "promotion";
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
	xlsWriteLabel($tablehead, $kolomhead++, "NomPromo");
	xlsWriteLabel($tablehead, $kolomhead++, "IdDept");
	xlsWriteLabel($tablehead, $kolomhead++, "DetailsPromo");

	foreach ($this->Promotion_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomPromo);
	    xlsWriteNumber($tablebody, $kolombody++, $data->idDept);
	    xlsWriteLabel($tablebody, $kolombody++, $data->detailsPromo);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Promotion.php */
/* Location: ./application/controllers/Promotion.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-14 11:45:36 */
/* http://harviacode.com */