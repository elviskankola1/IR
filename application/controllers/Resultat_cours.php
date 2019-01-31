<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Resultat_cours extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Resultat_cours_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('resultat_cours/resultat_cours_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Resultat_cours_model->json();
    }

    public function read($id) 
    {
        $row = $this->Resultat_cours_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idRc' => $row->idRc,
		'idCe' => $row->idCe,
		'idEtd' => $row->idEtd,
		'td' => $row->td,
		'tp' => $row->tp,
		'interro' => $row->interro,
		'examen' => $row->examen,
	    );
            $this->load->view('resultat_cours/resultat_cours_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('resultat_cours'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('resultat_cours/create_action'),
	    'idRc' => set_value('idRc'),
	    'idCe' => set_value('idCe'),
	    'idEtd' => set_value('idEtd'),
	    'td' => set_value('td'),
	    'tp' => set_value('tp'),
	    'interro' => set_value('interro'),
	    'examen' => set_value('examen'),
	);
        $this->load->view('resultat_cours/resultat_cours_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'idCe' => $this->input->post('idCe',TRUE),
		'idEtd' => $this->input->post('idEtd',TRUE),
		'td' => $this->input->post('td',TRUE),
		'tp' => $this->input->post('tp',TRUE),
		'interro' => $this->input->post('interro',TRUE),
		'examen' => $this->input->post('examen',TRUE),
	    );

            $this->Resultat_cours_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('resultat_cours'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Resultat_cours_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('resultat_cours/update_action'),
		'idRc' => set_value('idRc', $row->idRc),
		'idCe' => set_value('idCe', $row->idCe),
		'idEtd' => set_value('idEtd', $row->idEtd),
		'td' => set_value('td', $row->td),
		'tp' => set_value('tp', $row->tp),
		'interro' => set_value('interro', $row->interro),
		'examen' => set_value('examen', $row->examen),
	    );
            $this->load->view('resultat_cours/resultat_cours_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('resultat_cours'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idRc', TRUE));
        } else {
            $data = array(
		'idCe' => $this->input->post('idCe',TRUE),
		'idEtd' => $this->input->post('idEtd',TRUE),
		'td' => $this->input->post('td',TRUE),
		'tp' => $this->input->post('tp',TRUE),
		'interro' => $this->input->post('interro',TRUE),
		'examen' => $this->input->post('examen',TRUE),
	    );

            $this->Resultat_cours_model->update($this->input->post('idRc', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('resultat_cours'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Resultat_cours_model->get_by_id($id);

        if ($row) {
            $this->Resultat_cours_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('resultat_cours'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('resultat_cours'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('idCe', 'idce', 'trim|required');
	$this->form_validation->set_rules('idEtd', 'idetd', 'trim|required');
	$this->form_validation->set_rules('td', 'td', 'trim|required');
	$this->form_validation->set_rules('tp', 'tp', 'trim|required');
	$this->form_validation->set_rules('interro', 'interro', 'trim|required');
	$this->form_validation->set_rules('examen', 'examen', 'trim|required');

	$this->form_validation->set_rules('idRc', 'idRc', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "resultat_cours.xls";
        $judul = "resultat_cours";
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
	xlsWriteLabel($tablehead, $kolomhead++, "IdCe");
	xlsWriteLabel($tablehead, $kolomhead++, "IdEtd");
	xlsWriteLabel($tablehead, $kolomhead++, "Td");
	xlsWriteLabel($tablehead, $kolomhead++, "Tp");
	xlsWriteLabel($tablehead, $kolomhead++, "Interro");
	xlsWriteLabel($tablehead, $kolomhead++, "Examen");

	foreach ($this->Resultat_cours_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->idCe);
	    xlsWriteNumber($tablebody, $kolombody++, $data->idEtd);
	    xlsWriteLabel($tablebody, $kolombody++, $data->td);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->interro);
	    xlsWriteLabel($tablebody, $kolombody++, $data->examen);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Resultat_cours.php */
/* Location: ./application/controllers/Resultat_cours.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-14 11:45:36 */
/* http://harviacode.com */