<?php
class Admin_model_Julien extends CI_Model{

    private $TableAdmin = 'admin';
    function __construct(){

        parent :: __construct();
    }
    public function get_data($nom,$pwd,$level){
        
        $this->db->set('username',$nom);
        $this->db->set('pwd',$pwd);
        $this->db->set('level',$level);
        return $this->db->insert($this->TableAdmin);

    }
    public function checking($username,$pwd){
        return $this->db->where(array('username'=>$username,'pwd'=>$pwd))->get($this->TableAdmin)->result();

    }
    public function voir_admin(){
        return $this->db->select()
        ->get($this->TableAdmin)
        ->result();


    }

}

?>