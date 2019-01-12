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
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'cours_enseigne/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'cours_enseigne/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'cours_enseigne/index.html';
            $config['first_url'] = base_url() . 'cours_enseigne/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Cours_enseigne_model->total_rows($q);
        $cours_enseigne = $this->Cours_enseigne_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'cours_enseigne_data' => $cours_enseigne,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('cours_enseigne/cours_enseigne_list', $data);
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

}

/* End of file Cours_enseigne.php */
/* Location: ./application/controllers/Cours_enseigne.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-12 18:48:01 */
/* http://harviacode.com */