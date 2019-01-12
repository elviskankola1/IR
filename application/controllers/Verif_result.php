<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Verif_result extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Verif_result_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'verif_result/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'verif_result/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'verif_result/index.html';
            $config['first_url'] = base_url() . 'verif_result/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Verif_result_model->total_rows($q);
        $verif_result = $this->Verif_result_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'verif_result_data' => $verif_result,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('verif_result/verif_result_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Verif_result_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idVr' => $row->idVr,
		'idEtd' => $row->idEtd,
		'dateConnexion' => $row->dateConnexion,
		'etat' => $row->etat,
		'nbV' => $row->nbV,
		'nbTele' => $row->nbTele,
	    );
            $this->load->view('verif_result/verif_result_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('verif_result'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('verif_result/create_action'),
	    'idVr' => set_value('idVr'),
	    'idEtd' => set_value('idEtd'),
	    'dateConnexion' => set_value('dateConnexion'),
	    'etat' => set_value('etat'),
	    'nbV' => set_value('nbV'),
	    'nbTele' => set_value('nbTele'),
	);
        $this->load->view('verif_result/verif_result_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'idEtd' => $this->input->post('idEtd',TRUE),
		'dateConnexion' => $this->input->post('dateConnexion',TRUE),
		'etat' => $this->input->post('etat',TRUE),
		'nbV' => $this->input->post('nbV',TRUE),
		'nbTele' => $this->input->post('nbTele',TRUE),
	    );

            $this->Verif_result_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('verif_result'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Verif_result_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('verif_result/update_action'),
		'idVr' => set_value('idVr', $row->idVr),
		'idEtd' => set_value('idEtd', $row->idEtd),
		'dateConnexion' => set_value('dateConnexion', $row->dateConnexion),
		'etat' => set_value('etat', $row->etat),
		'nbV' => set_value('nbV', $row->nbV),
		'nbTele' => set_value('nbTele', $row->nbTele),
	    );
            $this->load->view('verif_result/verif_result_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('verif_result'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idVr', TRUE));
        } else {
            $data = array(
		'idEtd' => $this->input->post('idEtd',TRUE),
		'dateConnexion' => $this->input->post('dateConnexion',TRUE),
		'etat' => $this->input->post('etat',TRUE),
		'nbV' => $this->input->post('nbV',TRUE),
		'nbTele' => $this->input->post('nbTele',TRUE),
	    );

            $this->Verif_result_model->update($this->input->post('idVr', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('verif_result'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Verif_result_model->get_by_id($id);

        if ($row) {
            $this->Verif_result_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('verif_result'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('verif_result'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('idEtd', 'idetd', 'trim|required');
	$this->form_validation->set_rules('dateConnexion', 'dateconnexion', 'trim|required');
	$this->form_validation->set_rules('etat', 'etat', 'trim|required');
	$this->form_validation->set_rules('nbV', 'nbv', 'trim|required');
	$this->form_validation->set_rules('nbTele', 'nbtele', 'trim|required');

	$this->form_validation->set_rules('idVr', 'idVr', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Verif_result.php */
/* Location: ./application/controllers/Verif_result.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-12 18:48:03 */
/* http://harviacode.com */