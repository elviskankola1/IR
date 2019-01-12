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
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'etudiant/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'etudiant/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'etudiant/index.html';
            $config['first_url'] = base_url() . 'etudiant/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Etudiant_model->total_rows($q);
        $etudiant = $this->Etudiant_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'etudiant_data' => $etudiant,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('etudiant/etudiant_list', $data);
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

}

/* End of file Etudiant.php */
/* Location: ./application/controllers/Etudiant.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-12 18:48:02 */
/* http://harviacode.com */