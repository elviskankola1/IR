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
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'recours/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'recours/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'recours/index.html';
            $config['first_url'] = base_url() . 'recours/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Recours_model->total_rows($q);
        $recours = $this->Recours_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'recours_data' => $recours,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('recours/recours_list', $data);
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

}

/* End of file Recours.php */
/* Location: ./application/controllers/Recours.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-12 18:48:03 */
/* http://harviacode.com */