<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Materi_model extends CI_Model
{

    public $table = 'materi';
    public $id = 'id_materi';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->join('kelas', 'id_kelas', 'left');
        $this->db->join('guru', 'id_guru', 'left');
        $this->db->join('pelajaran', 'id_pelajaran', 'left');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->join('kelas', 'id_kelas', 'left');
        $this->db->join('guru', 'id_guru', 'left');
        $this->db->join('pelajaran', 'id_pelajaran', 'left');
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_materi', $q);
        $this->db->or_like('id_kelas', $q);
        $this->db->or_like('id_guru', $q);
        $this->db->or_like('id_pelajaran', $q);
        $this->db->or_like('judul', $q);
        $this->db->or_like('deskripsi', $q);
        $this->db->or_like('lampiran', $q);
        $this->db->or_like('tahun_angkatan', $q);
        $this->db->from($this->table);
        $this->db->join('kelas', 'id_kelas', 'left');
        $this->db->join('guru', 'id_guru', 'left');
        $this->db->join('pelajaran', 'id_pelajaran', 'left');
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_materi', $q);
        $this->db->or_like('id_kelas', $q);
        $this->db->or_like('id_guru', $q);
        $this->db->or_like('id_pelajaran', $q);
        $this->db->or_like('judul', $q);
        $this->db->or_like('deskripsi', $q);
        $this->db->or_like('lampiran', $q);
        $this->db->or_like('tahun_angkatan', $q);
        $this->db->limit($limit, $start);
        $this->db->join('kelas', 'id_kelas', 'left');
        $this->db->join('guru', 'id_guru', 'left');
        $this->db->join('pelajaran', 'id_pelajaran', 'left');
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

/* End of file Materi_model.php */
/* Location: ./application/models/Materi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-01 16:05:37 */
/* http://harviacode.com */