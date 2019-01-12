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
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'promotion/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'promotion/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'promotion/index.html';
            $config['first_url'] = base_url() . 'promotion/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Promotion_model->total_rows($q);
        $promotion = $this->Promotion_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'promotion_data' => $promotion,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('promotion/promotion_list', $data);
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

}

/* End of file Promotion.php */
/* Location: ./application/controllers/Promotion.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-12 18:48:02 */
/* http://harviacode.com */