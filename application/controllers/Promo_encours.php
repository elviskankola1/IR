<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promo_encours extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Promo_encours_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'promo_encours/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'promo_encours/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'promo_encours/index.html';
            $config['first_url'] = base_url() . 'promo_encours/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Promo_encours_model->total_rows($q);
        $promo_encours = $this->Promo_encours_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'promo_encours_data' => $promo_encours,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('promo_encours/promo_encours_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Promo_encours_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idPe' => $row->idPe,
		'idPromo' => $row->idPromo,
		'idEtd' => $row->idEtd,
		'annee' => $row->annee,
	    );
            $this->load->view('promo_encours/promo_encours_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('promo_encours'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('promo_encours/create_action'),
	    'idPe' => set_value('idPe'),
	    'idPromo' => set_value('idPromo'),
	    'idEtd' => set_value('idEtd'),
	    'annee' => set_value('annee'),
	);
        $this->load->view('promo_encours/promo_encours_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'idPromo' => $this->input->post('idPromo',TRUE),
		'idEtd' => $this->input->post('idEtd',TRUE),
		'annee' => $this->input->post('annee',TRUE),
	    );

            $this->Promo_encours_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('promo_encours'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Promo_encours_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('promo_encours/update_action'),
		'idPe' => set_value('idPe', $row->idPe),
		'idPromo' => set_value('idPromo', $row->idPromo),
		'idEtd' => set_value('idEtd', $row->idEtd),
		'annee' => set_value('annee', $row->annee),
	    );
            $this->load->view('promo_encours/promo_encours_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('promo_encours'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idPe', TRUE));
        } else {
            $data = array(
		'idPromo' => $this->input->post('idPromo',TRUE),
		'idEtd' => $this->input->post('idEtd',TRUE),
		'annee' => $this->input->post('annee',TRUE),
	    );

            $this->Promo_encours_model->update($this->input->post('idPe', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('promo_encours'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Promo_encours_model->get_by_id($id);

        if ($row) {
            $this->Promo_encours_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('promo_encours'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('promo_encours'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('idPromo', 'idpromo', 'trim|required');
	$this->form_validation->set_rules('idEtd', 'idetd', 'trim|required');
	$this->form_validation->set_rules('annee', 'annee', 'trim|required');

	$this->form_validation->set_rules('idPe', 'idPe', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Promo_encours.php */
/* Location: ./application/controllers/Promo_encours.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-12 18:48:02 */
/* http://harviacode.com */