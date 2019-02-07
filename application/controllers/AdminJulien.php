<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminJulien extends CI_Controller {

	/**
	 * 								Tout sur l'admin
	 */
	public function index()
	{
		$this->load->view('connect_admin');
		
	}
	public function add()
	{
		$this->form_validation->set_rules('username','ici votre nom','trim|required|max_length[8]|min_length[3]');
		$this->form_validation->set_rules('pwd','ici votre pwd','trim|required|max_length[8]|min_length[4]');
		$this->form_validation->set_rules('level','ici votre niveau','trim|required|max_length[1]|min_length[1]');
		if ($this->form_validation->run()){
			$nomUser=$this->input->post('username');
			$Passwrd=$this->input->post('pwd');
			$lvl=$this->input->post('level');
			$this->admin_model->get_data($nomUser,$Passwrd,$lvl);
			$data['nom']=$nomUser;

			$this->load->view('connect_admin_success',$data);
		}
		else{

			$this->load->view('add_admin');
		}
	}
	public function log(){

		$this->form_validation->set_rules('username','ici votre nom','trim|required|max_length[8]|min_length[3]');
		$this->form_validation->set_rules('pwd','ici votre pwd','trim|required|max_length[8]|min_length[4]');
		if ($this->form_validation->run()){
			$nomUser=$this->input->post('username');
			$Passwrd=$this->input->post('pwd');
			
			$data= $this->admin_model->checking($nomUser,$Passwrd);
			if(count($data)>0){

				$user=$data[0];
				$tab=array(
					'username'=>$user->username,
					'etat'=>true

				);
				$this->session->set_userdata($tab);
				redirect('admin/panel');
			}else{
				$data['erreur'] = "mot de pass incorrect";
				$this->session->set_flashdata($data);
				$this->load->view('connect_admin');
			}
		}
		else{

			$this->load->view('connect_admin');
		}
	}

	public function panel(){
		if($this->session->etat){
			$this->load->view('admin/connect_admin_success',$username);
		}else{
			redirect('admin/connect_admin');
		}
	}
	public function voir(){

		$data['x']=$this->admin_model_Julien->voir_admin();
		$this->load->view('admin_list',$data);
		
	}
	public function deconnection(){
		
	}
}
