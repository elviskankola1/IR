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
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'professeurs/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'professeurs/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'professeurs/index.html';
            $config['first_url'] = base_url() . 'professeurs/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Professeurs_model->total_rows($q);
        $professeurs = $this->Professeurs_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'professeurs_data' => $professeurs,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('professeurs/professeurs_list', $data);
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

}

/* End of file Professeurs.php */
/* Location: ./application/controllers/Professeurs.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-12 18:48:02 */
/* http://harviacode.com */