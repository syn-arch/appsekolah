<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kelas_model');
        $this->load->model('jurusan/jurusan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'kelas/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kelas/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kelas/index.html';
            $config['first_url'] = base_url() . 'kelas/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kelas_model->total_rows($q);
        $kelas = $this->Kelas_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kelas_data' => $kelas,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $data['judul'] = 'Data Kelas';

        $this->load->view('templates/header', $data);
        $this->load->view('kelas/kelas_list', $data);
        $this->load->view('templates/footer', $data);
    }

    public function read($id) 
    {
        $row = $this->Kelas_model->get_by_id($id);
        if ($row) {
            $data = array(
              'id_kelas' => $row->id_kelas,
              'nama_jurusan' => $row->nama_jurusan,
              'nama_kelas' => $row->nama_kelas,
          );

            $data['judul'] = 'Detail Kelas';

            $this->load->view('templates/header', $data);
            $this->load->view('kelas/kelas_read', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('kelas'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kelas/create_action'),
            'id_kelas' => set_value('id_kelas'),
            'id_jurusan' => set_value('id_jurusan'),
            'nama_kelas' => set_value('nama_kelas'),
        );

        $data['judul'] = 'Tambah Kelas';
        $data['jurusan'] = $this->jurusan_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('kelas/kelas_form', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
              'id_jurusan' => $this->input->post('id_jurusan',TRUE),
              'nama_kelas' => $this->input->post('nama_kelas',TRUE),
          );

            $this->Kelas_model->insert($data);
            $this->session->set_flashdata('success', 'Ditambah');
            redirect(site_url('kelas'));
        }
    }

    public function update($id) 
    {
        $row = $this->Kelas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kelas/update_action'),
                'id_kelas' => set_value('id_kelas', $row->id_kelas),
                'id_jurusan' => set_value('id_jurusan', $row->id_jurusan),
                'nama_kelas' => set_value('nama_kelas', $row->nama_kelas),
            );

            $data['judul'] = 'Ubah Kelas';
            $data['jurusan'] = $this->jurusan_model->get_all();

            $this->load->view('templates/header', $data);
            $this->load->view('kelas/kelas_form', $data);
            $this->load->view('templates/footer', $data);

        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('kelas'));
        }
    }

    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kelas', TRUE));
        } else {
            $data = array(
              'id_jurusan' => $this->input->post('id_jurusan',TRUE),
              'nama_kelas' => $this->input->post('nama_kelas',TRUE),
          );

            $this->Kelas_model->update($this->input->post('id_kelas', TRUE), $data);
            $this->session->set_flashdata('success', 'Diubah');
            redirect(site_url('kelas'));
        }
    }

    public function delete($id) 
    {
        $row = $this->Kelas_model->get_by_id($id);

        if ($row) {
            $this->Kelas_model->delete($id);
            $this->session->set_flashdata('success', 'Dihapus');
            redirect(site_url('kelas'));
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('kelas'));
        }
    }

    public function _rules() 
    {
     $this->form_validation->set_rules('id_jurusan', 'id jurusan', 'trim|required|numeric');
     $this->form_validation->set_rules('nama_kelas', 'nama kelas', 'trim|required');

     $this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim');
     $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
 }

}

/* End of file Kelas.php */
/* Location: ./application/controllers/Kelas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-02-01 16:04:49 */
                        /* http://harviacode.com */