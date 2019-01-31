<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promo_encours_model extends CI_Model
{

    public $table = 'promo_encours';
    public $id = 'idPe';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('idPe,idPromo,idEtd,annee');
        $this->datatables->from('promo_encours');
        //add this line for join
        //$this->datatables->join('table2', 'promo_encours.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('promo_encours/read/$1'),'Read')." | ".anchor(site_url('promo_encours/update/$1'),'Update')." | ".anchor(site_url('promo_encours/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'idPe');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('idPe', $q);
	$this->db->or_like('idPromo', $q);
	$this->db->or_like('idEtd', $q);
	$this->db->or_like('annee', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('idPe', $q);
	$this->db->or_like('idPromo', $q);
	$this->db->or_like('idEtd', $q);
	$this->db->or_like('annee', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Promo_encours_model.php */
/* Location: ./application/models/Promo_encours_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-01-14 11:45:35 */
/* http://harviacode.com */