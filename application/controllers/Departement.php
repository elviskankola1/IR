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
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'departement/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'departement/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'departement/index.html';
            $config['first_url'] = base_url() . 'departement/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Departement_model->total_rows($q);
        $departement = $this->Departement_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'departement_data' => $departement,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('departement/departement_list', $data);
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

}

/* End of file Departement.php */
/* Location: ./application/controllers/Departement.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-12 18:48:02 */
/* http://harviacode.com */